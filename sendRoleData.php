<?php
    session_start();
    $errMsg = '';
    try {
        require_once('connectSquid.php');
        
        if(isset($_REQUEST["mem_name"]) == true) {
            // 進入 member 表格的資料
            $sql = 
            'SELECT * 
            FROM member 
            WHERE  mem_no=(SELECT max(mem_no) FROM member)';
            $lastMember = $pdo->query($sql);
            $lastRow = $lastMember->fetch(PDO::FETCH_ASSOC);
            $lastID = $lastRow["mem_no"] + 1;
            
            $style_no = "imgs/createBox/myRole".$lastID.".png";
            $style_moving_no = "imgs/createBox/myRole_moving".$lastID.".png";
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
            $mem_status = trim($_REQUEST["mem_status"]);
            $pdo->beginTransaction();
            
            // 匯入測試
    //         $sql = "INSERT INTO `member` (`mem_no`, `style_no`,  `head_no`, `face_no`, `mem_name`, `mem_pwd`, `mem_email`, `mem_lv`, `highest_lv`, `squid_qty`, `mem_gender`, `mem_dob`, `mem_sign`, `mem_avatar`, `skin`, `poster_img_url`, `mem_intro`) VALUES
    // (2,'img/avatar.png', NULL, NULL, '魷魚軟軟', '12345', 'softsoft@gmail.com', 1, 1, 1000, 'M', '2019-02-08', '水瓶座', 'img/avatar.png', NULL, NULL, NULL)";
    //         $pdo->exec($sql);
            $sql = "INSERT INTO `member` (`mem_no`, `style_no`, `style_moving_no`,  `head_no`, `face_no`, `mem_name`, `mem_pwd`, `mem_email`, `mem_lv`, `highest_lv`, `squid_qty`, `mem_gender`, `mem_dob`, `mem_sign`, `mem_avatar`, `skin`, `poster_img_url`, `mem_intro`, `mem_status`) VALUES
    (:mem_no , :style_no, :style_moving_no, :head_no, :face_no, :mem_name, :mem_pwd, :mem_email, :mem_lv, :highest_lv, :squid_qty, :mem_gender, :mem_dob, :mem_sign, :mem_avatar, :skin, :poster_img_url, :mem_intro, :mem_status)";
            $member = $pdo->prepare($sql);
            $mem_no = $pdo->lastInsertId();
            $member->bindValue(":mem_no", $mem_no);
            $member->bindValue(":style_no", $style_no);
            $member->bindValue(":style_moving_no", $style_moving_no);
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
            $member->bindValue(":mem_status", $mem_status);
            $member->execute();

            //存session
            $_SESSION["mem_no"] =  $mem_no;
            $_SESSION["mem_name"] =  $mem_name;
            $_SESSION["style_no"] =  $style_no;
            $_SESSION["mem_lv"] =  trim((string)$mem_lv);
            $_SESSION["mem_avatar"] =  $mem_avatar;
            $_SESSION["squid_qty"] =  trim((string)$squid_qty);

            // 取得id
            $sql = 
            'SELECT * 
            FROM member 
            WHERE  mem_no=(SELECT max(mem_no) FROM member)';
            $lastMember = $pdo->query($sql);
            $lastRow = $lastMember->fetch(PDO::FETCH_ASSOC);
            $lastID = $lastRow["mem_no"] + 1;
            
            // 進入 member 表格的資料
            // 椅子
            $sql =
            "INSERT INTO `mem_furniture`(`mem_no`, `furn_no`, `pur_time`, `is_using`) 
            VALUES (:mem_no, :furn_no, :pur_time, :is_using)";
            $memChair = $pdo->prepare($sql);
            $memChair->bindValue(':mem_no', $lastID);
            $randChair = '1010'.rand(1,3);
            $memChair->bindValue(':furn_no', $randChair);
            $memChair->bindValue(':pur_time', date('Y-m-d'));
            $memChair->bindValue(':is_using', 1);
            $memChair->execute();
            
            // 桌子
            $sql =
            "INSERT INTO `mem_furniture`(`mem_no`, `furn_no`, `pur_time`, `is_using`) 
            VALUES (:mem_no, :furn_no, :pur_time, :is_using)";
            $memDesk = $pdo->prepare($sql);
            $memDesk->bindValue(':mem_no', $lastID);
            $randDesk = '2010'.rand(1,3);
            $memDesk->bindValue(':furn_no', $randDesk);
            $memDesk->bindValue(':pur_time', date('Y-m-d'));
            $memDesk->bindValue(':is_using', 1);
            $memDesk->execute();
            
            // 床
            $sql =
            "INSERT INTO `mem_furniture`(`mem_no`, `furn_no`, `pur_time`, `is_using`) 
            VALUES (:mem_no, :furn_no, :pur_time, :is_using)";
            $memBed = $pdo->prepare($sql);
            $memBed->bindValue(':mem_no', $lastID);
            $randBed = '3010'.rand(1,3);
            $memBed->bindValue(':furn_no', $randBed);
            $memBed->bindValue(':pur_time', date('Y-m-d'));
            $memBed->bindValue(':is_using', 1);
            $memBed->execute();
            
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
            
            $_SESSION["mem_no"] = $lastID;
            $_SESSION["myRole"] = $file;
            echo $success ? $file : 'error';
        }
        elseif(isset($_REQUEST["createdSquid_moving"]) == true) {
            $sql = 
            'SELECT * 
            FROM member 
            WHERE  mem_no=(SELECT max(mem_no) FROM member)';
            $lastMember = $pdo->query($sql);
            $lastRow = $lastMember->fetch(PDO::FETCH_ASSOC);
            $lastID = $lastRow["mem_no"];

            $upload_dir = "imgs//createBox//";
        
            $imgDataStr = $_POST['createdSquid_moving'];
            $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr);
        
            $data = base64_decode($imgDataStr);
        
            $fileName = 'myRole_moving'.$lastID;
            $file = $upload_dir.$fileName.".png";
            $success = file_put_contents($file, $data);
            
            $_SESSION["mem_no"] = $lastID;
            $_SESSION["myRole_moving"] = $file;
            echo $success ? $file : 'error';
        }
        // echo "創角成功~";
    } catch (PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>