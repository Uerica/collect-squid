<?php
    session_start();
    try {
        require_once('connectSquid.php');
        $mem_no = $_SESSION["mem_no"];

        $upload_dir = "imgs/dressingRoom/";

        $imgDataStr = $_POST['dressedSquid'];
        $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr);

        $data = base64_decode($imgDataStr);

        $fileName = 'dressedSquid'.$mem_no;
        $file = $upload_dir.$fileName.".png";
        $success = file_put_contents($file, $data);
        $_SESSION["dressed_no"] = $file;
        // update to style_no as general charactor dress code.
        $_SESSION["style_no"] = $file;

        $sql = 
        "UPDATE member
        SET dressed_no = :dressed_no
        WHERE mem_no = :mem_no
        ";
        $updateClo = $pdo->prepare($sql);
        $updateClo->bindValue(":dressed_no", $file);
        $updateClo->bindValue(":mem_no", $mem_no);
        $updateClo->execute();

        echo $file;
    } catch (PDOException $e) {

        echo $success ? $file : 'error';
    }

?>