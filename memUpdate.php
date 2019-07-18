<?php
$errMsg = "";

try {
	require_once("connectDB.php");
	
	$sql = "update member set mem_name=:mem_name,mem_gender=:mem_gender,mem_dob=:mem_dob,mem_sign=:mem_sign,mem_pwd=:mem_pwd,mem_email=:mem_email";
    $members = $pdo->prepare($sql); 
    $members->bindValue(":mem_email",$_REQUEST["mem_email"]);
	$members->bindValue(":mem_name",$_REQUEST["mem_name"]);
	$members->bindValue(":mem_gender",$_REQUEST["mem_gender"]);
	$members->bindValue(":mem_dob",$_REQUEST["mem_dob"]);
	$members->bindValue(":mem_sign",$_REQUEST["mem_sign"]);
	$members->bindValue(":mem_pwd",$_REQUEST["mem_pwd"]);
    $members->execute();

} catch (PDOException $e) {
	echo "錯誤 : ", $e -> getMessage(), "<br>";
	echo "行號 : ", $e -> getLine(), "<br>";
}
 
?>