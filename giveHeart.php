<?php
    $other_mem_no = $_REQUEST["other_mem_no"];
    $mem_no = $_REQUEST["mem_no"];

    $errMsg = '';
    try {
        require_once('connectSquid.php');
        if($_REQUEST["isLove"] == 'giving') {
            $sql = 
            "INSERT INTO 
            `heart_record`(`send_mem_no`, `rcv_mem_no`, `rcv_date`) 
            VALUES (:mem_no, :other_mem_no, :now_date)";
            $giveHeart = $pdo->prepare($sql);
            $giveHeart->bindValue(':mem_no', $mem_no);
            $giveHeart->bindValue(':other_mem_no', $other_mem_no);
            $giveHeart->bindValue(':now_date', date('Y-m-d'));
            $giveHeart->execute();
            // echo "我收到愛了";

            $sql = 
            "SELECT *
            FROM heart_record
            WHERE `rcv_mem_no` = :mem_no";
            $heart = $pdo->prepare($sql);
            $heart->bindValue(':mem_no', $other_mem_no);
            $heart->execute();
            $heartCount = $heart->rowCount();
            echo $heartCount;

        } else {
            $sql = 
            "DELETE FROM 
            `heart_record` 
            WHERE send_mem_no = :mem_no AND rcv_mem_no = :other_mem_no;";
            $retriveHeart = $pdo->prepare($sql);
            $retriveHeart->bindValue(':mem_no', $mem_no);
            $retriveHeart->bindValue(':other_mem_no', $other_mem_no);
            $retriveHeart->execute();
            // echo "沒血沒淚";

            $sql = 
            "SELECT *
            FROM heart_record
            WHERE `rcv_mem_no` = :mem_no";
            $heart = $pdo->prepare($sql);
            $heart->bindValue(':mem_no', $other_mem_no);
            $heart->execute();
            $heartCount = $heart->rowCount();
            echo $heartCount;
        }
    } catch(PDOException $e) {
        // $errMsg .= $e->getMessage()."<br>";
        // $errMsg .= $e->getLine()."<br>";
        // echo $errMsg;
    }
?>