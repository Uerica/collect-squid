<?php
    header('Content-Type: application/json');
    $errMsg = '';
    $mem_name = $_REQUEST["mem_name"];
    $friend_name = $_REQUEST["friend_name"];
    $mem_no = 0;
    $friend_no = 0;
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
        }else{
            // member not found
            http_response_code(400);
            echo "friend_name not found: ". $friend_name;
            exit();
        }

        // check if already friend
        $sql3 = "SELECT * FROM relationship
            WHERE (mem_no = :mem_no AND friend_no = :friend_no) OR (mem_no = :friend_no AND friend_no = :mem_no)";
        $check = $pdo->prepare($sql3);
        $check->bindValue(":mem_no", $mem_no);
        $check->bindValue(":friend_no", $friend_no);
        $check->execute();
        if($check->rowCount() > 0) {
            // already friend
            http_response_code(400);
            echo "already friend";
            exit();
        }

        // create relationship
        $sql = "INSERT INTO relationship (mem_no, friend_no, status) VALUES (:mem_no, :friend_no, 0)";
        $stmt= $pdo->prepare($sql);
        $stmt->bindValue(":friend_no", $friend_no);
        $stmt->bindValue(":mem_no", $mem_no);
        $stmt->execute();
        echo "OK";
        
    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>