<?php
    session_start();
    $errMsg = '';
    try {
        require_once('connectSquid.php');
        
        if(isset($_REQUEST["mem_name"]) == true) {
            $sql = 
            'SELECT * 
            FROM member 
            WHERE  mem_no=(SELECT max(mem_no) FROM member)';
            $lastMember = $pdo->query($sql);
            $lastRow = $lastMember->fetch(PDO::FETCH_ASSOC);
            $lastID = $lastRow["mem_no"] + 1;
            
            $style_no = "imgs/createBox/myRole".$lastID.".png";
            $mem_name = trim($_REQUEST["mem_name"]);
            $mem_pwd = trim($_REQUEST["mem_pwd"]);
            $mem_email = trim($_REQUEST["mem_email"]);
            $mem_lv = $_REQUEST["mem_lv"];
            $highest_lv = $_REQUEST["highest_lv"];
            $squid_qty = $_REQUEST["squid_qty"];
            $mem_gender = $_REQUEST["mem_gender"];
            $mem_dob = $_REQUEST["mem_dob"];
            $mem_sign = trim($_REQUEST["mem_sign"]);
            $mem_avatar = trim($_REQUEST["mem_avatar"]);
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
        }
        elseif(isset($_REQUEST["createdSquid"]) == true) {
            $sql = 
            'SELECT * 
            FROM member 
            WHERE  mem_no=(SELECT max(mem_no) FROM member)';
            $lastMember = $pdo->query($sql);
            $lastRow = $lastMember->fetch(PDO::FETCH_ASSOC);
            $lastID = $lastRow["mem_no"];

            $upload_dir = "imgs//createBox//";
        
            $imgDataStr = $_POST['createdSquid'];
            $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr);
        
            $data = base64_decode($imgDataStr);
        
            $fileName = 'myRole'.$lastID;
            $file = $upload_dir.$fileName.".png";
            $success = file_put_contents($file, $data);
        
            $_SESSION["myRole"] = $file;
            echo $success ? $file : 'error';
        }
        echo "創角成功~";
    } catch (PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>