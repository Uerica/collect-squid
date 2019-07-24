<?php
session_start();
$errMsg = "";
try {
    $evt_no = $_REQUEST["evt_no"];
    require_once('connectSquid.php');
    $sql = 
    "INSERT INTO event_record (mem_no, evt_no, enroll_date) 
    VALUE(:mem_no, :evt_no, :enroll_date)";
    $evtRegister = $pdo->prepare($sql);
    $evtRegister->bindValue(":mem_no", $_SESSION["mem_no"]); //from session
    $evtRegister->bindValue(":evt_no", $evt_no);
    $evtRegister->bindValue(":enroll_date", date('Y-m-d'));
    $evtRegister->execute();

    // 此活動報名人數 +1 (報名的人)
    $sql = 
    "UPDATE event 
    SET now_att = now_att+1 
    WHERE evt_no = :evt_no";
    $updateNowAtt = $pdo->prepare($sql);
    $updateNowAtt->bindValue(":evt_no", $evt_no);
    $updateNowAtt->execute();

    echo $evt_no;
} catch(PDOException $e) {
    $errMsg .= $e->getMessage()."<br>";
    $errMsg .= $e->getLine()."<br>";
    echo $errMsg;
    // echo "錯誤 : ", $e->getMessage(), "<br>";
    // echo "行號 : ", $e->getLine(), "<br>";
}
?>