<?php
session_start();
try {
    $dns = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
    $user = "dd101g2";
    $psw = "dd101g2";
    $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dns, $user, $psw, $options);

    $mem_no = $_SESSION["mem_no"]; //from session

    $sql = "select * from member where mem_no=:mem_no";
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_no",$mem_no);
    $member->execute();
    $memberInfo = $member->fetchObject();
    $_SESSION["squid_qty"] = $memberInfo->squid_qty;

    echo $_SESSION["squid_qty"];

} catch (PDOException $e) {
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}
?>
