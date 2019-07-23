<?php
    $jsonStr = $_REQUEST["jsonStr"];
    $tableRow = json_decode( $jsonStr );

    require_once("connectSquid.php");
    $error = array();
    $latestData = array();
    switch($tableRow->table_name) {
        case 'managerLogin': {
        $query = "SELECT mng_name, mng_psw FROM manager WHERE mng_name = :mng_name AND mng_psw = :mng_psw";
        $mngRow = $pdo->prepare($query);
        $mngRow->bindValue(":mng_name", $tableRow->mng_name);
        $mngRow->bindValue(":mng_psw", $tableRow->mng_psw);
        try {
            $mngRow->execute();
        } catch (PDOException $e) {
            $error['message'] = $e->getMessage();
            $error['line']=$e->getLine();
        }

     break;
 }
 default: {
     $error['message'] = 'unknown table name';
     break;
 }
}