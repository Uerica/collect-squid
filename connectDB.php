<?php
<<<<<<< HEAD
	$dsn = "mysql:host=localhost;port=3306;dbname=dd101g2;charset=utf8";//
	$user = "Alvin";//dd101g2
	$password = "root";//dd101g2
=======
	$dsn = "mysql:host=localhost;port=3306;dbname=dd101g2;charset=utf8";
	$user = "Alvin";
	$password = "root";
>>>>>>> 25148cea57e12471e261d9fc16fe8809f60003e3
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
	$pdo = new PDO($dsn, $user, $password, $options);
?>