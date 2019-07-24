<?php
    $errMsg = '';
    $mem_no = $_REQUEST["mem_no"];
    $cmt_cnt = $_REQUEST["cmt_cnt"];
    if(isset($_REQUEST["rcv_mem_no"]) == true){
        $rcv_mem_no = $_REQUEST["rcv_mem_no"];
    }
    // if(isset($_REQUEST["send_mem_name"]) == true){
    //     $send_mem_name = $_REQUEST["send_mem_name"];
    // }

    try {
        require_once('connectSquid.php');
        $sql = 
        "INSERT INTO `board_comment`(`cmt_no`, `send_mem_no`, `rcv_mem_no`, `cmt_cnt`, `cmt_date`) 
        VALUES (NULL ,:send_mem_no, :rcv_mem_no, :cmt_cnt, :cmt_date)
        ";


        $addComment = $pdo->prepare($sql);
        $addComment->bindValue(":send_mem_no", $mem_no);
        if(isset($_REQUEST["rcv_mem_no"]) == true){
            $addComment->bindValue(":rcv_mem_no", $rcv_mem_no);
        } else {
            $addComment->bindValue(":rcv_mem_no", $mem_no);
        }
        // if(isset($_REQUEST["send_mem_name"]) == true){
        //     $addComment->bindValue(":send_mem_name", $send_mem_name);
        // } else {
        //     // $addComment->bindValue(":rcv_mem_name", $mem_name);
        // }
        // $addComment->bindvalue(":rcv_mem_no", $mem_no);
        $addComment->bindvalue(":cmt_cnt", $cmt_cnt);
        $addComment->bindvalue(":cmt_date", date('Y-m-d'));
        $addComment->execute();
        // echo "傳送成功";
        

        $sql = 
            'SELECT * 
            FROM board_comment 
            WHERE  cmt_no =(SELECT max(cmt_no) FROM board_comment)';
        $lastCmt = $pdo->query($sql);
        $lastCmtRow = $lastCmt->fetch(PDO::FETCH_ASSOC);
        $lastCmtID = $lastCmtRow["cmt_no"];
        echo $lastCmtID;

    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>