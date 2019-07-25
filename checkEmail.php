<?php
    $errMsg = '';
    $newEmail = trim($_REQUEST["email"]);
    // echo $newEmail;
    try {
        require_once('connectSquid.php');
        $sql = "SELECT * FROM member";
        $members = $pdo->prepare($sql);
        $members->execute();
        while($memRow = $members->fetch(PDO::FETCH_ASSOC)) {
            // echo $memRow["mem_email"]."<br>";
            if($newEmail == trim($memRow["mem_email"])) {
                echo 'exist';
                return;
            }
        }
    } catch(PDOException $e) {
        // $errMsg .= $e->getMessage()."<br>";
        // $errMsg .= $e->getLine()."<br>";
    }

?>