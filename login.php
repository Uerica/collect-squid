<?php
    ob_start();
    session_start();
    header('Content-Type: application/json');
    $errMsg = '';
    $mem_name = $_REQUEST["mem_name"];
    $mem_pwd = $_REQUEST["mem_pwd"];
    try {
        require_once('connectSquid.php');
        $sql = "SELECT * FROM member
                WHERE mem_name = :mem_name AND mem_pwd = :mem_pwd";
        $member = $pdo->prepare($sql);
        $member->bindValue(":mem_name", $mem_name);
        $member->bindValue(":mem_pwd", $mem_pwd);
        $member->execute();
        if($member->rowCount() > 0) {
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
            //抓出來存session
            $_SESSION["mem_no"] =  $memRow["mem_no"];
            $_SESSION["mem_name"] =  $memRow["mem_name"];
            $_SESSION["style_no"] =  $memRow["style_no"];
            $_SESSION["mem_lv"] =  $memRow["mem_lv"];
            $_SESSION["mem_avatar"] =  $memRow["mem_avatar"];
            $_SESSION["squid_qty"] =  $memRow["squid_qty"];
            
            $resp = array();
            $resp["mem_name"] =  $memRow["mem_name"];
            $resp["style_no"] =  $memRow["style_no"];
            $resp["mem_lv"] =  $memRow["mem_lv"];
            $resp["mem_avatar"] =  $memRow["mem_avatar"];
            $resp["squid_qty"] =  $memRow["squid_qty"];
            
            echo json_encode($resp);
        }else{
            // account or password incorrect
            http_response_code(401);
        }

    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
    }
?>