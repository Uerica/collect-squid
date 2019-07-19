<?php
$errMsg = "";
try {
    $dns = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
    $user = "dd101g2";
    $psw = "dd101g2";
    $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dns, $user, $psw, $options);

    $mem_no = "1"; //from session

    $sql = "update member set squid_qty = squid_qty - :furn_price where mem_no=:mem_no";
    $countMoney = $pdo->prepare($sql);
    $countMoney->bindValue(":furn_price", $_REQUEST["furn_price"]);
    $countMoney->bindValue(":mem_no", $mem_no);
    $countMoney->execute();


    $sql = "INSERT INTO `mem_furniture`(`mem_no`, `furn_no`, `pur_time`, `is_using`) VALUES (:mem_no,:furn_no,:pur_time,0)";
    $addFur = $pdo->prepare($sql);
    $addFur->bindValue(":mem_no", $mem_no);
    $addFur->bindValue(":furn_no", $_REQUEST["furn_no"]);
    $addFur->bindValue(":pur_time", date("Y-m-d"));
    $addFur->execute();


    $sql = "select * from mem_furniture where mem_no=:mem_no";
    $mem_furns = $pdo->prepare($sql);
    $mem_furns->bindValue(":mem_no", $mem_no);
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
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}
?>
