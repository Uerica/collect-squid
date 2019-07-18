<?php
        $dsn = 'mysql:host=localhost;port=3306;dbname=dd101g2;charset=utf8';
        $user = 'root';
        $password = 'tibame';
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE => PDO::CASE_NATURAL);
        $pdo = new PDO($dsn, $user, $password, $options);
?>