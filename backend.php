<?php
$errMsg = "";
try {
	require_once("connectSquid.php");
	$getManager = "SELECT * FROM manager";
	$manager = $pdo->query($getManager); 
    $managerRows = $manager->fetchAll(PDO::FETCH_ASSOC);
    
    $getMember = "SELECT * FROM member";
    $member = $pdo->query($getMember);
    $memberRows = $member->fetchAll(PDO::FETCH_ASSOC);

    $getFurniture = "SELECT * FROM product_furniture";
    $furniture = $pdo->query($getFurniture);
    $furnitureRows = $furniture->fetchAll(PDO::FETCH_ASSOC);

    $getClothing = "SELECT * FROM product_clothing";
    $clothing = $pdo->query($getClothing);
    $clothingRows = $clothing->fetchAll(PDO::FETCH_ASSOC);

    $getEvent = "SELECT * FROM `event`";
    $events = $pdo->query($getEvent);
    $eventsRows = $events->fetchAll(PDO::FETCH_ASSOC);

    $getRobot = "SELECT * FROM robot_keyword";
    $robotKeyword = $pdo->query($getRobot);
    $robotKeywordRows = $robotKeyword->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo "錯誤 : ", $e -> getMessage(), "<br>";
	echo "行號 : ", $e -> getLine(), "<br>";
}
 
?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    </style>
    <link rel="stylesheet" href="sass/style.css">
    <title>收集友誼 後台</title>
    <style>
        * {
            overflow: visible!important;
        }
    </style>
</head>

<body>
    <div class="backend">
        <!-- nav bar -->
        <nav class="navbar navbar-bg navbar-font">
            <a class="navbar-brand" href="#">
                <img src="imgs/backend/megumi.png" width="30" height="30"
                    class="d-inline-block align-top" alt="">
                收集魷魚 後台
            </a>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">name </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="logoutBtn">登出</a>
            </div>
        </nav>

        <div class="row">
            <div class="col-2">
                <div class="nav flex-column nav-pills navColor sidebar sidebar-fixed" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active sidebar-list" id="v-pills-manager-tab" data-toggle="pill" href="#v-pills-manager"
                        role="tab" aria-controls="v-pills-manager" aria-selected="true">管理員帳號管理</a>
                    <a class="nav-link sidebar-list" id="v-pills-member-tab" data-toggle="pill" href="#v-pills-member" role="tab"
                        aria-controls="v-pills-member" aria-selected="false">會員帳號管理</a>
                    <a class="nav-link sidebar-list" id="v-pills-furniture-tab" data-toggle="pill" href="#v-pills-furniture"
                        role="tab" aria-controls="v-pills-furniture" aria-selected="false">家具管理</a>
                    <a class="nav-link sidebar-list" id="v-pills-clothing-tab" data-toggle="pill" href="#v-pills-clothing" role="tab"
                        aria-controls="v-pills-clothing" aria-selected="false">服裝管理</a>
                    <a class="nav-link sidebar-list" id="v-pills-event-tab" data-toggle="pill" href="#v-pills-event" role="tab"
                        aria-controls="v-pills-event" aria-selected="false">活動圖片管理</a>
                    <a class="nav-link sidebar-list" id="v-pills-robot-tab" data-toggle="pill" href="#v-pills-robot" role="tab"
                        aria-controls="v-pills-robot" aria-selected="false">機器人管理</a>
                </div>
            </div>
            <div class="col-9 right-side">
                <div class="tab-content" id="v-pills-tabContent">

                    <!-- 管理員 -->
                    <div class="tab-pane fade show active" id="v-pills-manager" role="tabpanel"
                        aria-labelledby="v-pills-manager-tab">
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary btn-new" id="btn-newManager">新增管理員</button>
                        </div>
                        <table class="table table-hover table-location table-manager">
                            <thead>
                                <tr>
                                    <th scope="col">管理員編號</th>
                                    <th scope="col">管理員名稱</th>
                                    <!-- <th scope="col">管理員帳號</th> -->
                                    <th scope="col">管理員密碼</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="manager">
                            <?php foreach($managerRows as $i=>$managerRow) {?>
                                <tr>
                                    <td><?php echo $managerRow["mng_no"];?></td>
                                    <td><input class="form-control mng_name" type="text" value="<?php echo $managerRow["mng_name"];?>" name="mng" readonly></td>
                                    <td><input class="form-control mng_psw" type="text" value="<?php echo $managerRow["mng_psw"];?>" name="mng" readonly></td>
                                    <!-- <td><input class="form-control" type="text" value="guest" name="mng" readonly></td> -->
                                    <td>
                                        <button type="button" class="btn btn-outline-secondary btn-edit btn-editMng">編輯</button>
                                        <button type="button" class="btn btn-outline-danger btn-del btn-delMng">刪除</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- 會員 -->
                    <div class="tab-pane fade show" id="v-pills-member" role="tabpanel"
                        aria-labelledby="v-pills-member-tab">
                        <div class="input-group mb-3 btn-search">
                            <input type="text" class="form-control" id="search-member" placeholder="會員暱稱"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">搜尋
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover table-location" id="table-member">
                            <thead>
                                <tr>
                                    <th scope="col">會員編號</th>
                                    <th scope="col">會員暱稱</th>
                                    <th scope="col">會員密碼</th>
                                    <th scope="col">會員信箱</th>
                                    <th scope="col">最高等級</th>
                                    <th scope="col">魷魚數量</th>
                                    <th scope="col">權限</th>
                                </tr>
                            </thead>
                            <tbody id="member">
                            <?php foreach($memberRows as $i=>$memberRow) {?>
                                <tr>
                                    <td><?php echo $memberRow["mem_no"];?></td>
                                    <td><?php echo $memberRow["mem_name"];?></td>
                                    <td><?php echo $memberRow["mem_pwd"];?></td>
                                    <td><?php echo $memberRow["mem_email"];?></td>
                                    <td><?php echo $memberRow["highest_lv"];?></td>
                                    <td><?php echo $memberRow["squid_qty"];?></td>
                                    <td>
                                        <?php
                                            $isActive = $memberRow["mem_status"] == 0;
                                            $status = $isActive ? '正常' : '停權';
                                            $className = 'btn btn-memStatus ' . ($isActive ? 'btn-avaliable' : 'btn-banned');
                                            echo (
                                                "<button type=\"button\" class=\"{$className}\">
                                                    {$status}
                                                </button>"
                                            );
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- 家具 -->
                    <div class="tab-pane fade show furniture" id="v-pills-furniture" role="tabpanel"
                        aria-labelledby="v-pills-furniture-tab">
                        <div class="input-group mb-3 btn-search">
                            <input type="text" class="form-control" id="search-furniture" placeholder="傢具名稱"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">搜尋
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover table-location" id="table-furniture">
                            <thead>
                                <tr>
                                    <th scope="col">傢具編號</th>
                                    <th scope="col">傢具名稱</th>
                                    <th scope="col">傢具圖片</th>
                                    <th scope="col">傢具價格</th>
                                    <th scope="col">傢具等級</th>
                                    <th scope="col">傢具類別</th>
                                    <th scope="col">商品狀態</th>
                                </tr>
                            </thead>
                            <tbody id="furniture">
                            <?php foreach($furnitureRows as $i=>$furnitureRow) {?>
                                <tr>
                                    <td><?php echo $furnitureRow["furn_no"];?></td>
                                    <td><input class="form-control furn_name" type="text" value="<?php echo $furnitureRow["furn_name"];?>" readonly></td>
                                    <td><img src="<?php echo $furnitureRow["furn_img_url"];?>" alt="家具圖片"></td>
                                    <td><input class="form-control furn_price" type="text" value="<?php echo $furnitureRow["furn_price"];?>" readonly></td>
                                    <td class="mem_lvl">
                                        <?php
                                            switch ($furnitureRow["mem_lv"]) 
                                            {
                                                case "1": {
                                                    echo "平民";
                                                    break;
                                                }
                                                case "2": {
                                                    echo "貴族";
                                                    break;
                                                }
                                                case "3": {
                                                    echo "皇族";
                                                    break;
                                                }
                                                default: {
                                                    echo "未定義";
                                                    break;
                                                }
                                            };
                                        ?>
                                    </td>
                                    <td class="fur_type">                                        
                                        <?php
                                            switch ($furnitureRow["furn_type"]) 
                                            {
                                                case "1": {
                                                    echo "椅子";
                                                    break;
                                                }
                                                case "2": {
                                                    echo "桌子";
                                                    break;
                                                }
                                                case "3": {
                                                    echo "床";
                                                    break;
                                                }
                                                default: {
                                                    echo "未定義";
                                                    break;
                                                }
                                            };
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $isOnboard = $furnitureRow["is_onboard"] == 0;
                                            $status = $isOnboard ? '上架' : '下架';
                                            $className = 'btn btn-furnStatus ' . ($isOnboard ? 'btn-furnOn' : 'btn-furnOff');
                                            echo (
                                                "<button type=\"button\" class=\"{$className}\">
                                                    {$status}
                                                </button>"
                                            );
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-secondary btn-edit btn-editFurn">編輯</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- 服裝 -->
                    <div class="tab-pane fade show clothing" id="v-pills-clothing" role="tabpanel"
                        aria-labelledby="v-pills-clothing-tab">
                        <div class="input-group mb-3 btn-search">
                            <input type="text" class="form-control" id="search-clothing" placeholder="服裝名稱"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">搜尋
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover table-location" id="table-clothing">
                            <thead>
                                <tr>
                                    <th scope="col">服裝編號</th>
                                    <th scope="col">服裝名稱</th>
                                    <th scope="col">服裝圖片</th>
                                    <th scope="col">服裝等級</th>
                                    <th scope="col">服裝類別</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="clothing">
                                <?php foreach($clothingRows as $i=>$clothingRow) {?>
                                    <tr>
                                        <td><?php echo $clothingRow["clo_no"];?></td>
                                        <td><input class="form-control clo_name" type="text" value="<?php echo $clothingRow["clo_name"];?>" readonly></td>
                                        <td><img src="<?php echo $clothingRow["clo_img_url"] ;?>" alt=""></td>
                                        <td class="mem_lvl">
                                            <?php
                                                switch ($clothingRow["mem_lv"]) 
                                                {
                                                    case "1": {
                                                        echo "平民";
                                                        break;
                                                    }
                                                    case "2": {
                                                        echo "貴族";
                                                        break;
                                                    }
                                                    case "3": {
                                                        echo "皇族";
                                                        break;
                                                    }
                                                    default: {
                                                        echo "未定義";
                                                        break;
                                                    }
                                                };
                                            ?>
                                        </td>
                                        <td class="clo_type">
                                            <?php
                                                switch ($clothingRow["clo_type"]) 
                                                {
                                                    case "1": {
                                                        echo "帽子";
                                                        break;
                                                    }
                                                    case "2": {
                                                        echo "衣服";
                                                        break;
                                                    }
                                                    case "3": {
                                                        echo "鞋子";
                                                        break;
                                                    }
                                                    default: {
                                                        echo "未定義";
                                                        break;
                                                    }
                                                };
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-secondary btn-edit btn-editClo">編輯</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- 活動圖片管理 -->
                    <div class="tab-pane fade show event" id="v-pills-event" role="tabpanel"
                        aria-labelledby="v-pills-event-tab">
                        <div class="input-group mb-3 btn-search">
                            <input type="text" class="form-control" id="search-event" placeholder="活動名稱"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">搜尋
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover table-location" id="table-event">
                            <thead>
                                <tr>
                                    <th scope="col">活動編號</th>
                                    <th scope="col">活動名稱</th>
                                    <th scope="col">活動圖片</th>
                                    <th scope="col">設為活動BANNER</th>
                                </tr>
                            </thead>
                            <tbody id="event">
                            <?php foreach($eventsRows as $i=>$eventRow) {?>
                                <tr class="newEvent">
                                    <td><?php echo $eventRow["evt_no"]; ?></td>
                                    <td><?php echo $eventRow["evt_name"]; ?></td>
                                    <td><img src="<?php echo $eventRow["evt_cover_url"]; ?>" alt=""></td>
                                    <td>
                                        <?php
                                            $isBanner = $eventRow["is_banner"] == 0;
                                            $status = $isBanner ? '是' : '否';
                                            $className = 'btn btn-banner ' . ($isBanner ? 'btn-isBanner' : 'btn-isNotBanner');
                                            echo (
                                                "<button type=\"button\" class=\"{$className}\">
                                                    {$status}
                                                </button>"
                                            );
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- 機器人 -->
                    <div class="tab-pane fade show robot" id="v-pills-robot" role="tabpanel"
                        aria-labelledby="v-pills-robot-tab">
                        <button type="button" class="btn btn-outline-primary btn-new" id="btn-newResp">新增辭庫</button>
                        <table class="table table-hover table-location" id="table-robot">
                            <thead>
                                <tr>
                                    <th scope="col">關鍵字編號</th>
                                    <th scope="col">回答編號</th>
                                    <th scope="col">關鍵字內容</th>
                                    <th scope="col">回答內容</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="robot">
                            <?php foreach($robotKeywordRows as $i=>$robotKeywordRow) {?>
                                <tr>
                                    <td class="key_no"><?php echo $robotKeywordRow['key_no']; ?></td>
                                    <td class="res_no"><?php echo $robotKeywordRow['res_no']; ?></td>
                                    <td><input class="form-control key_cnt" type="text" value="<?php echo $robotKeywordRow['key_cnt']; ?>" readonly></td>
                                    <td><input class="form-control res_cnt" type="text" value="<?php echo $robotKeywordRow['res_cnt']; ?>" readonly></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-secondary btn-edit btn-editRobotKeyword">編輯</button>
                                        <button type="button" class="btn btn-outline-danger btn-del btn-delRobotKeyword">刪除</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
        <script src="js/backend.js"></script>
</body>

</html>