<?php
	$dsn = "mysql:host=localhost;port=3306;dbname=dd101g2;charset=utf8";
	$user = "Alvin";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
	$pdo = new PDO($dsn, $user, $password, $options);
?>