<?php
$errMsg = "";
try {
    switch ($_FILES["evt_cover_url"]["error"]) {
        case UPLOAD_ERR_OK:
            if (file_exists("evt_images") === false) {  //若資料夾不存在
                mkdir("evt_images"); //make directory
            }
            $fileName = rand()."{$_FILES['evt_cover_url']['name']}";
            $from = $_FILES["evt_cover_url"]["tmp_name"];
            $to = "evt_images/".$fileName;
            echo $from, $to;
            if (copy($from, $to)) {
                echo "上傳成功~<br>";
            } else {
                echo "上傳失敗~<br>";
            }
            break;
        case UPLOAD_ERR_INI_SIZE:
            echo "上傳檔案太大, 不可超過", ini_get("upload_max_filesize"), "<br>";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo "上傳檔案太大, 不可超過", $_POST["MAX_FILE_SIZE"], "<br>";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "上傳檔案不完整<br>";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "没有上傳檔案<br>";
            break;
    }


    $dns = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
    $user = "dd101g2";
    $psw = "dd101g2";
    $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dns, $user, $psw, $options);

    $sql = "INSERT INTO `event` (`evt_no`, `org_mem_no`, `evt_name`, `evt_date`, `enroll_end_date`, `max_att`, `evt_place`, `evt_desc`, `evt_cover_url`) VALUES (NULL, :mem_no, :evt_name, :evt_date, :enroll_end_date, :max_att, :evt_place, :evt_desc, :evt_cover_url)";

    $evtAdd = $pdo->prepare($sql);
    $evtAdd->bindValue(":mem_no", "1"); //from session
    $evtAdd->bindValue(":evt_name", $_REQUEST["evt_name"]);
    $evtAdd->bindValue(":evt_date", $_REQUEST["evt_date"]);
    $evtAdd->bindValue(":enroll_end_date", $_REQUEST["enroll_end_date"]);
    $evtAdd->bindValue(":max_att", $_REQUEST["max_att"]);
    $evtAdd->bindValue(":evt_place", $_REQUEST["evt_place"]);
    $evtAdd->bindValue(":evt_desc", $_REQUEST["evt_desc"]);
    $evtAdd->bindValue(":evt_cover_url", $fileName);
    $evtAdd->execute();



    $sql = "INSERT INTO `event_record`(`mem_no`, `evt_no`, `enroll_date`) VALUES (:mem_no,:evt_no,:enroll_date)";

    $evt_no = $pdo->lastInsertId();
    $joinEvt = $pdo->prepare($sql);
    $joinEvt->bindValue(":mem_no", "1"); //from session
    $joinEvt->bindValue(":evt_no", $evt_no);
    $joinEvt->bindValue(":enroll_date", date("Y-m-d"));
    $joinEvt->execute();

    echo "舉辦活動成功";
} catch (PDOException $e) {
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}
