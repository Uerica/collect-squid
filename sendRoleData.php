<?php
    session_start();
    function generateRandomString($length = 13) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $errMsg = '';
    $style_no = "imgs/createBox/myRole".generateRandomString().".png";
    $mem_name = $_REQUEST["mem_name"];
    $mem_pwd = $_REQUEST["mem_pwd"];
    $mem_email = $_REQUEST["mem_email"];
    $mem_lv = $_REQUEST["mem_lv"];
    $highest_lv = $_REQUEST["highest_lv"];
    $squid_qty = $_REQUEST["squid_qty"];
    $mem_gender = $_REQUEST["mem_gender"];
    $mem_dob = $_REQUEST["mem_dob"];
    $mem_sign = $_REQUEST["mem_sign"];
    $mem_avatar = $_REQUEST["mem_avatar"];
    try {
        require_once('connectSquid.php');

        $pdo->beginTransaction();
        
        // 匯入測試
//         $sql = "INSERT INTO `member` (`mem_no`, `style_no`,  `head_no`, `face_no`, `mem_name`, `mem_pwd`, `mem_email`, `mem_lv`, `highest_lv`, `squid_qty`, `mem_gender`, `mem_dob`, `mem_sign`, `mem_avatar`, `skin`, `poster_img_url`, `mem_intro`) VALUES
// (2,'img/avatar.png', NULL, NULL, '魷魚軟軟', '12345', 'softsoft@gmail.com', 1, 1, 1000, 'M', '2019-02-08', '水瓶座', 'img/avatar.png', NULL, NULL, NULL)";
//         $pdo->exec($sql);
        $sql = "INSERT INTO `member` (`mem_no`, `style_no`,  `head_no`, `face_no`, `mem_name`, `mem_pwd`, `mem_email`, `mem_lv`, `highest_lv`, `squid_qty`, `mem_gender`, `mem_dob`, `mem_sign`, `mem_avatar`, `skin`, `poster_img_url`, `mem_intro`) VALUES
(:mem_no , :style_no, :head_no, :face_no, :mem_name, :mem_pwd, :mem_email, :mem_lv, :highest_lv, :squid_qty, :mem_gender, :mem_dob, :mem_sign, :mem_avatar, :skin, :poster_img_url, :mem_intro)";
        $member = $pdo->prepare($sql);
        $mem_no = $pdo->lastInsertId();
        $member->bindValue(":mem_no", $mem_no);
        $member->bindValue(":style_no", $style_no);
        $member->bindValue(":head_no", NULL);
        $member->bindValue(":face_no", NULL);
        $member->bindValue(":mem_name", $mem_name);
        $member->bindValue(":mem_pwd", $mem_pwd);
        $member->bindValue(":mem_email", $mem_email);
        $member->bindValue(":mem_lv", $mem_lv);
        $member->bindValue(":highest_lv", $highest_lv);
        $member->bindValue(":squid_qty", $squid_qty);
        $member->bindValue(":mem_gender", $mem_gender);
        $member->bindValue(":mem_dob", $mem_dob);
        $member->bindValue(":mem_sign", $mem_sign);
        $member->bindValue(":mem_avatar", $mem_avatar);
        $member->bindValue(":skin", NULL);
        $member->bindValue(":poster_img_url", NULL);
        $member->bindValue(":mem_intro", NULL);
        $member->execute();
        $pdo->commit();


        $upload_dir = "imgs//createBox//";
    
        $imgDataStr = $_POST['createdSquid'];
        $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr);
    
        $data = base64_decode($imgDataStr);
    
        $fileName = 'myRole';
        $file = $upload_dir.$fileName.".png";
        $success = file_put_contents($file, $data);
    
        $SESSION["myRole"] = $file;
        echo $success ? $file : 'error';


        echo "創角成功~";
    } catch (PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>