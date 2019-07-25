<?php
session_start();
$errMsg = "";

try {
	require_once("connectSquid.php");
	
	$sql = "UPDATE member set mem_name=:mem_name,mem_gender=:mem_gender,mem_dob=:mem_dob,mem_sign=:mem_sign,mem_pwd=:mem_pwd,mem_email=:mem_email where mem_no = :mem_no";//加where + 欄位
    $members = $pdo->prepare($sql); 
    $members->bindValue(":mem_email",$_REQUEST["mem_email"]);
	$members->bindValue(":mem_name",$_REQUEST["mem_name"]);
	$members->bindValue(":mem_gender",$_REQUEST["mem_gender"]);
	$members->bindValue(":mem_dob",$_REQUEST["mem_dob"]);
	$members->bindValue(":mem_sign",$_REQUEST["mem_sign"]);
	$members->bindValue(":mem_pwd",$_REQUEST["mem_pwd"]);
	$members->bindValue(":mem_no",$_SESSION["mem_no"]);//寫session時改
	$members->execute();

} catch (PDOException $e) {
	// echo "錯誤 : ", $e -> getMessage(), "<br>";
	// echo "行號 : ", $e -> getLine(), "<br>";
}
header("location:memberCenter.php");
?>