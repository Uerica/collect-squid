<?php
    $errMsg = '';
    $mem_no = $_REQUEST["mem_no"];
    $furn_type = $_REQUEST["furn_type"];
    $furn_no = $_REQUEST["furn_no"];
    try {
        require_once('connectSquid.php');
        // 取消某種家具的所有使用狀態
        if($furn_type == 1) {
            $sql = 
            "UPDATE mem_furniture 
            SET `is_using` = :is_using 
            WHERE `mem_no` = :mem_no AND `furn_no` LIKE '1%'";
            $resetFurn = $pdo->prepare($sql);
            $resetFurn->bindValue(":mem_no", $mem_no);
            $resetFurn->bindValue(":is_using", 0);
            $resetFurn->execute();
        } elseif ($furn_type == 2) {
            $sql = 
            "UPDATE mem_furniture 
            SET `is_using` = :is_using 
            WHERE `mem_no` = :mem_no AND `furn_no` LIKE '2%'";
            $resetFurn = $pdo->prepare($sql);
            $resetFurn->bindValue(":mem_no", $mem_no);
            $resetFurn->bindValue(":is_using", 0);
            $resetFurn->execute();
        } elseif ($furn_type == 3) {
            $sql = 
            "UPDATE mem_furniture 
            SET `is_using` = :is_using 
            WHERE `mem_no` = :mem_no AND `furn_no` LIKE '3%'";
            $resetFurn = $pdo->prepare($sql);
            $resetFurn->bindValue(":mem_no", $mem_no);
            $resetFurn->bindValue(":is_using", 0);
            $resetFurn->execute();
        }
        // 將點到的家具使用狀態更改為使用中
        $sql = 
        "UPDATE mem_furniture 
        SET `is_using` = :is_using 
        WHERE `mem_no` = :mem_no AND `furn_no` = :furn_no";
        $pointFurn = $pdo->prepare($sql);
        $pointFurn->bindValue(":mem_no", $mem_no);
        $pointFurn->bindValue(":furn_no", $furn_no);
        $pointFurn->bindValue(":is_using", 1);
        $pointFurn->execute();
        echo "更換成功";
    } catch (PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>