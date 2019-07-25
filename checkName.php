<?php
    $errMsg = '';
    $newName = trim($_REQUEST["mem_name"]);
    try {
        require_once('connectSquid.php');
        $sql = "SELECT * FROM member";
        $members = $pdo->prepare($sql);
        $members->execute();
        while($memRow = $members->fetch(PDO::FETCH_ASSOC)) {
            if($newName == trim($memRow["mem_name"])) {
                echo 'exist';
                return;
            }
        }
    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
    }
?>