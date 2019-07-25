<?php
ob_start();
session_start();
require_once('connectSquid.php');
try {

    $mem_no = $_SESSION["mem_no"]; //from session

    $sql = "update member set squid_qty = squid_qty - :furn_price where mem_no=:mem_no";
    $countMoney = $pdo->prepare($sql);
    $countMoney->bindValue(":furn_price", $_REQUEST["furn_price"]);
    $countMoney->bindValue(":mem_no", $mem_no); //from session
    $countMoney->execute();


    $sql = "INSERT INTO `mem_furniture`(`mem_no`, `furn_no`, `pur_time`, `is_using`) VALUES (:mem_no,:furn_no,:pur_time,0)";
    $addFur = $pdo->prepare($sql);
    $addFur->bindValue(":mem_no", $mem_no); //from session
    $addFur->bindValue(":furn_no", $_REQUEST["furn_no"]);
    $addFur->bindValue(":pur_time", date("Y-m-d"));
    $addFur->execute();


    $sql = "select * from member where mem_no=:mem_no";
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_no",$mem_no);
    $member->execute();
    $memberInfo = $member->fetchObject();
    $_SESSION["squid_qty"] = $memberInfo->squid_qty;

    $sql = "select * from mem_furniture where mem_no=:mem_no";
    $mem_furns = $pdo->prepare($sql);
    $mem_furns->bindValue(":mem_no", $mem_no); //from session
    $mem_furns->execute();
    $mem_furnsArr = array();
    while ($mem_furnRow = $mem_furns->fetchObject()) {
        array_push($mem_furnsArr, $mem_furnRow->furn_no);
    }
    if (in_array($_REQUEST["furn_no"], $mem_furnsArr)) {
        echo "已購買";
    } else {
        echo "購買";
    }
} catch (PDOException $e) {
    // echo "錯誤 : ", $e->getMessage(), "<br>";
    // echo "行號 : ", $e->getLine(), "<br>";
}
?>
