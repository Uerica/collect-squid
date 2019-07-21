<?php
	$dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
	$user = "dd101g2";
	$password = "dd101g2";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
	$pdo = new PDO($dsn, $user, $password, $options);
?>