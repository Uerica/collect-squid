<?php
    $errMsg = '';
    $mem_no = $_REQUEST["mem_no"];
    $cmt_cnt = $_REQUEST["cmt_cnt"];
    try {
        require_once('connectSquid.php');
        $sql = 
        "INSERT INTO `board_comment`(`cmt_no`, `send_mem_no`, `rcv_mem_no`, `cmt_cnt`, `cmt_date`) 
        VALUES (NULL ,:send_mem_no, :rcv_mem_no, :cmt_cnt, :cmt_date)
        ";
        $addComment = $pdo->prepare($sql);
        $addComment->bindValue(":send_mem_no", $mem_no);
        $addComment->bindvalue(":rcv_mem_no", $mem_no);
        $addComment->bindvalue(":cmt_cnt", $cmt_cnt);
        $addComment->bindvalue(":cmt_date", date('Y-m-d'));
        $addComment->execute();
        echo "傳送成功";
    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>