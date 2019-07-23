<?php
    session_start();
    // echo $_SESSION["mem_no"]; 
    $errMsg = '';
    try {
        require_once('connectSquid.php');
        $sql = 
        "SELECT *
        FROM member
        WHERE mem_no = :mem_no";
        $member = $pdo->prepare($sql);
        $member->bindValue(':mem_no', $_SESSION["mem_no"]);
        $member->execute();
        $memRow = $member->fetch(PDO::FETCH_ASSOC);
        echo $memRow["style_no"];
    } catch (PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>