<?php
    $errMsg = '';
    try {
        require_once('connectSquid.php');
        $cmt_no = $_REQUEST["cmt_no"];
        $sql =
        "DELETE FROM board_comment
        WHERE cmt_no = :cmt_no;
        ";
        $deleteCmt = $pdo->prepare($sql);
        $deleteCmt->bindValue(':cmt_no', $cmt_no);
        $deleteCmt->execute();
        echo "刪除成功";
    } catch(PDOException $e) {
        // $errMsg .= $e->getMessage()."<br>";
        // $errMsg .= $e->getLine()."<br>";
        // echo $errMsg;
    }
?>