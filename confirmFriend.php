<?php
    header('Content-Type: application/json');
    $errMsg = '';
    $mem_name = $_REQUEST["mem_name"];
    $friend_name = $_REQUEST["friend_name"];
    $mem_no = 0;
    $mem_lv = 0;
    $friend_no = 0;
    $friend_lv = 0;
    try {
        require_once('connectSquid.php');
        // find my mem_no
        $sql1 = "SELECT mem_no FROM member
                WHERE mem_name = :mem_name";
        $member = $pdo->prepare($sql1);
        $member->bindValue(":mem_name", $mem_name);
        $member->execute();
        if($member->rowCount() > 0) {
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
            //抓出來存session
            $resp = array();
            $mem_no = $memRow["mem_no"];
            $mem_lv = $memRow["mem_lv"];
        }else{
            // member not found
            http_response_code(400);
            echo "mem_name not found";
            exit();
        }

        // find frined's mem_no
        $sql2 = "SELECT mem_no FROM member
                WHERE mem_name = :friend_name";
        $friend = $pdo->prepare($sql2);
        $friend->bindValue(":friend_name", $friend_name);
        $friend->execute();
        if($friend->rowCount() > 0) {
            $friendRow = $friend->fetch(PDO::FETCH_ASSOC);
            //抓出來存session
            $resp = array();
            $friend_no = $friendRow["mem_no"];
            $friend_lv = $friendRow["mem_lv"];
        }else{
            // member not found
            http_response_code(400);
            echo "friend_name not found: ". $friend_name;
            exit();
        }

        // check status
        $sql3 = "SELECT * FROM relationship
            WHERE (mem_no = :friend_no AND friend_no = :mem_no AND status = 0)";
        $check = $pdo->prepare($sql3);
        $check->bindValue(":mem_no", $mem_no);
        $check->bindValue(":friend_no", $friend_no);
        $check->execute();
        if($check->rowCount() == 0) {
            // no application or status not match
            http_response_code(400);
            echo "no application or status not match.";
            exit();
        }

        // create relationship
        $sql = "UPDATE relationship SET status=1 WHERE (mem_no = :friend_no AND friend_no = :mem_no)";
        $confirm= $pdo->prepare($sql);
        $confirm->bindValue(":mem_no", $mem_no);
        $confirm->bindValue(":friend_no", $friend_no);
        $confirm->execute();

        // check if mem level up
        $sql_mylevel = "SELECT COUNT(*) count FROM relationship
            WHERE ((mem_no = :mem_no OR friend_no = :mem_no) AND status = 1)";
        $mylevel = $pdo->prepare($sql_mylevel);
        $mylevel->bindValue(":mem_no", $mem_no);
        $mylevel->execute();
        $myFriendCount = $mylevel->fetch(PDO::FETCH_ASSOC)["count"];
        $mem_new_lv = $mem_lv;
        if($myFriendCount >= 5){
            $mem_new_lv = 3;
        }else if($myFriendCount >= 3){
            $mem_new_lv = 2;
        }else {
            $mem_new_lv = 1;
        }
        if($mem_new_lv != $mem_lv){
            $sql = "UPDATE member SET mem_lv=:mem_lv WHERE (mem_no = :mem_no)";
            $update_mem_lv= $pdo->prepare($sql);
            $update_mem_lv->bindValue(":mem_no", $mem_no);
            $update_mem_lv->bindValue(":mem_lv", $mem_new_lv);
            $update_mem_lv->execute();
        }
        $_SESSION["mem_lv"] = $mem_new_lv;

        // check if friend level up
        $sql_friendlevel = "SELECT COUNT(*) count FROM relationship
            WHERE ((mem_no = :mem_no OR friend_no = :mem_no) AND status = 1)";
        $friendlevel = $pdo->prepare($sql_friendlevel);
        $friendlevel->bindValue(":mem_no", $friend_no);
        $friendlevel->execute();
        $frinedsFriendCount = $friendlevel->fetch(PDO::FETCH_ASSOC)["count"];
        $friend_new_lv = $friend_lv;
        if($frinedsFriendCount >= 5){
            $friend_new_lv = 3;
        }else if($frinedsFriendCount >= 3){
            $friend_new_lv = 2;
        }else {
            $friend_new_lv = 1;
        }
        if($friend_new_lv != $friend_lv){
            $sql = "UPDATE member SET mem_lv=:mem_lv WHERE (mem_no = :mem_no)";
            $update_mem_lv= $pdo->prepare($sql);
            $update_mem_lv->bindValue(":mem_no", $friend_no);
            $update_mem_lv->bindValue(":mem_lv", $friend_new_lv);
            $update_mem_lv->execute();
        }

        echo "OK";
        
    } catch(PDOException $e) {
        // $errMsg .= $e->getMessage()."<br>";
        // $errMsg .= $e->getLine()."<br>";
        // echo $errMsg;
    }
?>