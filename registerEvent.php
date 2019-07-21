<?php
$errMsg = "";
require_once('connectSquid.php');
try {
    $sql = "insert into event_record (mem_no,evt_no) value(:mem_no,:evt_no)";
    $evtRegister = $pdo->prepare($sql);
    $evtRegister->bindValue(":mem_no","112"); //from session
    $evtRegister->bindValue(":evt_no",$_REQUEST["evt_no"]);
    $evtRegister->execute();
    echo "報名成功";
} catch(PDOException $e) {
    $errMsg .= $e->getMessage()."<br>";
    $errMsg .= $e->getLine()."<br>";
    echo $errMsg;
    // echo "錯誤 : ", $e->getMessage(), "<br>";
    // echo "行號 : ", $e->getLine(), "<br>";
}
?>