<?php
try {
    $dns = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
    $user = "dd101g2";
    $psw = "dd101g2";
    $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dns, $user, $psw, $options);

    $_SESSION["mem_no"] = 20;
    $mem_no = $_SESSION["mem_no"];

    switch ($_FILES["selectPicInput"]["error"]) {
        case UPLOAD_ERR_OK:{
            if (file_exists("wall_pic") === false) {  //若資料夾不存在
                mkdir("wall_pic"); //make directory
                echo "dir";
            }
            
            $fileName = "$mem_no"."{$_FILES['selectPicInput']['name']}";
            $from = $_FILES["selectPicInput"]["tmp_name"];
            $to = "wall_pic/".$fileName;
            if (copy($from, $to)) {

                // 修改會員海報路徑
                $sql = "UPDATE member SET poster_img_url = :poster_img_url WHERE mem_no = :mem_no";
                $evtAdd = $pdo->prepare($sql);
                $evtAdd->bindValue(":mem_no", $mem_no); //from session
                $evtAdd->bindValue(":poster_img_url", $fileName);
                $evtAdd->execute();
                
                echo "上傳成功~";
            } else {
                echo "上傳失敗~<br>";
            }
            break;
        }
        case UPLOAD_ERR_INI_SIZE:{
            echo "上傳檔案太大, 不可超過", ini_get("upload_max_filesize"), "<br>";
            break;
        }
        case UPLOAD_ERR_FORM_SIZE:{
            echo "上傳檔案太大, 不可超過", $_POST["MAX_FILE_SIZE"], "<br>";
            break;
        }
        case UPLOAD_ERR_PARTIAL:{
            echo "上傳檔案不完整<br>";
            break;
        }
        case UPLOAD_ERR_NO_FILE:{
            echo "没有上傳檔案<br>";
            break;
        }
    }
} catch (PDOException $e) {
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}
?>