<?php
    session_start();
    $upload_dir = "imgs//dressingRoom//";

    $imgDataStr = $_POST['dressedSquid'];
    $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr);

    $data = base64_decode($imgDataStr);

    $fileName = 'dressedSquid';
    $file = $upload_dir.$fileName.".png";
    $success = file_put_contents($file, $data);

    $SESSION["choTmpName"] = $file;
    echo $success ? $file : 'error';
?>