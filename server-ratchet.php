<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

// Make sure composer dependencies have been installed
require __DIR__ . '/vendor/autoload.php';

/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class MyChat implements MessageComponentInterface {
    protected $clients;//存所有的$conn

    public function __construct() {
        echo "WebSocket Server is running...\r\n";
        // 使用SplObjectStorage，當作儲存所有連線($conn)的容器
        $this->clients = new \SplObjectStorage;
    }

    /**
     * 當有用戶連線進來時...(這時還不知道user_id，只是網路連線通了)
     */
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);//連線存起來
    }

    /**
     * 當有用戶傳訊息進來時...
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        $json_msg = json_decode($msg, true); //一律使用Json來傳訊息
        $msg_type = $json_msg['msg_type'];
        $user_id = $json_msg['user_id'];
        echo "收到 msg_type:[$msg_type] user_id:[$user_id]\r\n";
        
        switch ($msg_type)
        {
            case "LOGIN":
                //一但拿到user_id時，記錄進去，方便之後使用"conn"就能從"clients"查找到UserId
                $this->clients[$from] = $user_id;
                // 通知其他人我上線了
                $msg = array();
                $msg['msg_type'] = "USER_ONLINE";
                $msg['user_id'] = $user_id;
                $this->msgToOthers($from, json_encode($msg));
                break;
            case "CHAT":
                //聊天
                $chat_type = $json_msg['chat_type'];
                $chat_msg = $json_msg['chat_msg'];
                echo "使用者:[$user_id] 發送聊天 類型:[$chat_type] 訊息:[$chat_msg]\r\n";
                if($chat_type == 'ALL'){
                    $this->msgToAll($msg);
                }else if($chat_type == 'USER'){
                    $chat_to = $json_msg['chat_to']; //要傳給哪個user的user_id
                    $this->msgToUser($from, $chat_to, $msg);
                }
                break;
            case "GET_ONLINE_USERS":
                // 取得目前所有已連線的使用者，回傳給目前連線的人
                $resp_obj = array();
                // 把資料放在users裡，比較方便存取
                $resp_obj['msg_type'] = "ONLINE_USERS";
                $resp_obj['users'] = array();
                foreach ($this->clients as $client) {
                    $user_id = $this->clients[$client];
                    if($user_id != NULL){
                        array_push($resp_obj['users'], $user_id);
                    } 
                }
                // 去掉重覆的人
                $resp_obj['users'] = array_values(array_unique($resp_obj['users']));
                $this->msgBack($from, json_encode($resp_obj));
                break;
        }
    }

    /**
     * 當有用戶斷線時...
     */
    public function onClose(ConnectionInterface $conn) {
        $user_id = $this->clients[$conn];
        echo "$user_id 離線\r\n";
        $this->clients->detach($conn);
        // 通知大家有人離線了
        if($user_id != NULL) {
            $msg = array();
            $msg['msg_type'] = "USER_OFFLINE";
            $msg['user_id'] = $user_id;
            $this->msgToAll(json_encode($msg));
        }
    }

    /**
     * 當有用戶連線發生錯誤時...
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        $user_id = $this->clients[$from];
        $err_msg = $e->getMessage();
        echo "發生錯誤 使用者:[$user_id] 錯誤:[$err_msg]\r\n";
        $conn->close();
    }

    /**
     * 把訊息回傳給目前連線的來源
     */
    public function msgBack(ConnectionInterface $from, String $msg) {
        $from->send($msg);
    }

    /**
     * 把訊息傳給所有人
     */
    public function msgToAll(String $msg) {
        echo "傳訊息給所有人\r\n";
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    /**
     * 把訊息傳給所有非自己的人
     */
    public function msgToOthers(ConnectionInterface $from, String $msg) {
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    /**
     * 把訊息傳給特定的人
     * (需考慮同個user_id可能同時有多個connection)
     */
    public function msgToUser(ConnectionInterface $from, String $to_user_id, String $msg) {
        $user_id = $this->clients[$from];
        foreach ($this->clients as $client) {
            // 所有的clients都找一遍，只要user_id是一樣的，通通傳
            if ($to_user_id == $this->clients[$client]) {
                echo "傳訊息給特定的人 from:[$user_id] to:[$to_user_id] msg:[$msg]\r\n";
                $client->send($msg);
            }
        }
        $from->send($msg);
    }
}

// Run the server application through the WebSocket protocol on port 8080
$app = new Ratchet\App('35.229.227.58', 80, "0.0.0.0");
$app->route('/chat', new MyChat, array('*'));
$app->run();
