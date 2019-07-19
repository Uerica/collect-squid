<?php
    $errMsg = '';
    $mem_name = $_REQUEST["mem_name"];
    $mem_pwd = $_REQUEST["mem_pwd"];
    try {
        require_once('connectSquid.php');
        $sql = 
        "SELECT *
        FROM member
        WHERE mem_name = :mem_name
        AND mem_pwd = :mem_pwd";
        $member = $pdo->prepare($sql);
        $member->bindValue(":mem_name", $mem_name);
        $member->bindValue(":mem_pwd", $mem_pwd);
        $member->execute();
        $memRow = $member->fetch(PDO::FETCH_ASSOC);

        if($memRow["dressed_no"] == '') {
            echo $memRow["style_no"];
        } else {
            echo $memRow["dressed_no"];
        }
    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
    }
?>