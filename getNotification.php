<?php
    require_once('connectSquid.php');

    if (isset($_SESSION["mem_no"])) {
        // 通知
        $sqlNoti = "SELECT * FROM `notification` WHERE rcv_mem_no = " . $_SESSION["mem_no"] . " AND is_read = 0";
        $noti = $pdo->prepare($sqlNoti);
        $noti->execute();
        $state_notification['notiRows'] = $noti->fetchAll(PDO::FETCH_ASSOC);
        $state_notification['nRows'] = count($state_notification['notiRows']);
    }
?>