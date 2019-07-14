<?php
    session_start();
    $upload_dir = "imgs//dressingRoom//";
    // if(!file_exists($upload_dir)) {
    //     mkdir($upload_dir);
    // }

    $imgDataStr = $_POST['drawnImage'];
    $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr);

    $data = base64_decode($imgDataStr);

    $fileName = date('Ymd');
    $file = $upload_dir.$fileName.".png";
    $success = file_put_contents($file, $data);

    $SESSION["choTmpName"] = $file;
    echo $success ? $file : 'error';
?>