<?php
    header('Content-Type: application/json');
    $errMsg = '';
    $mem_name = $_REQUEST["mem_name"];
    try {
        require_once('connectSquid.php');
        $sql = "SELECT * FROM member
                WHERE mem_name = :mem_name";
        $member = $pdo->prepare($sql);
        $member->bindValue(":mem_name", $mem_name);
        $member->execute();
        if($member->rowCount() > 0) {
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
            //抓出來存session
            $resp = array();
            $resp["mem_name"] =  $memRow["mem_name"];
            $resp["style_no"] =  $memRow["style_no"];      
            echo json_encode($resp);
        }else{
            // account or password incorrect
            echo "";
        }

    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>