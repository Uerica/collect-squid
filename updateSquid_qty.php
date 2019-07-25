<?php
session_start();
try {
    require_once('connectSquid.php');

    $mem_no = $_SESSION["mem_no"]; //from session

    $sql = "select * from member where mem_no=:mem_no";
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_no",$mem_no);
    $member->execute();
    $memberInfo = $member->fetchObject();
    $_SESSION["squid_qty"] = $memberInfo->squid_qty;

    echo $_SESSION["squid_qty"];

} catch (PDOException $e) {
    // echo "錯誤 : ", $e->getMessage(), "<br>";
    // echo "行號 : ", $e->getLine(), "<br>";
}
?>
