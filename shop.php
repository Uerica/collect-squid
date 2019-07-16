<?php
$errMsg = "";
try {
    $dns = "mysql:host=localhost;port=3306;dbname=dd101g2;charset=utf8";
    $user = "root";
    $psw = "qazwsxplmokn";
    $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dns, $user, $psw, $options);

    $sql = "select * from product_furniture where furn_type=:furn_type";

    $chairs = $pdo->prepare($sql);
    $chairs->bindValue(":furn_type", 1);
    $chairs->execute();

    $tables = $pdo->prepare($sql);
    $tables->bindValue(":furn_type", 2);
    $tables->execute();

    $beds = $pdo->prepare($sql);
    $beds->bindValue(":furn_type", 3);
    $beds->execute();


    $sql = "select * from member where mem_name=:mem_name and mem_pwd=:mem_pwd";
    $members = $pdo->prepare($sql);
    $members->bindValue(":mem_name", "abc"); //from session
    $members->bindValue(":mem_pwd", "abc"); //from session
    $members->execute();

    if ($members->rowCount() != 0) {
        $member = $members->fetchObject();
    }

    $sql = "select * from product_furniture where mem_no=:mem_no";
    $mem_fur = $pdo->prepare($sql);
    $mem_fur->bindValue(":mem_no","1"); //from session
    $mem_fur->execute();
    // $mem_fur->fetchObject();


} catch (PDOException $e) {
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="sass/style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>

    <title>收集友誼</title>
</head>

<body>
    <header class="common_header disabledScrollOnHover">
        <div class="menuMobile">
            <span class="menuMobile_circle"></span>
            <a href="#" class="menuMobile_link">
                <span class="menuMobile_icon">
                    <span class="menuMobile_line menuMobile_line-1"></span>
                    <span class="menuMobile_line menuMobile_line-2"></span>
                    <span class="menuMobile_line menuMobile_line-3"></span>
                </span>
            </a>
        </div>

        <div class="menuMobile_overlay">
            <ul class="memberInfo">
                <li class="coin">
                    <a href="javascript:;">
                        <img src="imgs/icon/coin.png" alt="持有金額icon">
                        <span>1500</span>
                    </a>
                </li>
                <li class="logo">
                    <a href="index.html">
                        <img src="imgs/logo.png" alt="尋找友誼網站LOGO">
                        <span>尋找友誼</span>
                    </a>
                </li>
                <li class="login">
                    <img src="imgs/icon/avatar.png" alt="角色頭像icon">
                    <span class="name">
                        <a href="javascript:;"><?php echo $member->mem_name ?></a>
                    </span>
                    <span>
                        <a href="javascript:;">登出</a>
                    </span>
                </li>
            </ul>
            <nav class="menuMobile_nav">
                <li><a href="myRoom.html"> <img src="imgs/icon/room.png" alt="我的房間icon">
                        <span>我的房間</span></a></li>
                <li><a href="dressingRoom.html"><img src="imgs/icon/fittingRoom.png" alt="換衣間icon">
                        <span>換衣間</span></a></li>
                <li><a href="findfriend.html"> <img src="imgs/icon/friend.png" alt="找朋友icon">
                        <span>找朋友</span></a></li>
                <li><a href="javascript:;"> <img src="imgs/icon/events.png" alt="揪團活動icon">
                        <span>揪團活動</span></a></li>
                <li><a href="shop.html"> <img src="imgs/icon/mall.png" alt="虛擬商城icon">
                        <span>虛擬商城</span></a></li>
                <li><a href="memberCenter.html"> <img src="imgs/icon/member.png" alt="會員中心icon">
                        <span>會員中心</span></a></li>
                <li><a href="javascript:;"> <img src="imgs/icon/robot.png" alt="客服機器人_icon">
                        <span>客服機器人</span></a></li>
                <li><a href="javascript:;"> <img src="imgs/icon/notice02.png" alt="通知_icon">
                        <span>通知</span></a></li>
            </nav>
        </div>

        <nav class="menuDesktop">
            <ul>
                <li>
                    <a href="myRoom.html">
                        <img src="imgs/icon/room.png" alt="我的房間icon">
                        <span>我的房間</span>
                    </a>
                </li>
                <li><a href="dressingRoom.html">
                        <img src="imgs/icon/fittingRoom.png" alt="換衣間icon">
                        <span>換衣間</span></a>
                </li>
                <li>
                    <a href="findfriend.html">
                        <img src="imgs/icon/friend.png" alt="找朋友icon">
                        <span>找朋友</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <img src="imgs/icon/events.png" alt="揪團活動icon">
                        <span>揪團活動</span>
                    </a>
                </li>
                <li class="logo">
                    <a href="index.html">
                        <img src="imgs/logo.png" alt="尋找友誼網站LOGO">
                        <span>尋找友誼</span>
                    </a>
                </li>
                <li>
                    <a href="shop.html">
                        <img src="imgs/icon/mall.png" alt="虛擬商城icon">
                        <span>虛擬商城</span>
                    </a>
                </li>
                <li>
                    <a href="memberCenter.html">
                        <img src="imgs/icon/member.png" alt="會員中心icon">
                        <span>會員中心</span>
                    </a>
                </li>
                <div class="memberInfo">
                    <li class="login">
                        <img src="imgs/icon/avatar.png" alt="角色頭像icon">
                        <span class="name"><a href="javascript:;"><?php echo $member->mem_name ?></a></span>
                        <span><a href="javascript:;">登出</a></span>
                    </li>
                    <li class="coin">
                        <a href="javascript:;">
                            <img src="imgs/icon/coin.png" alt="持有金額icon">
                            <span>1500</span>
                        </a>
                    </li>
                    <li class="level">
                        <a href="javascript:;">
                            <img src="imgs/icon/civilian.png" alt="平民等級icon">
                            <span>平民</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>

    <div class="shop">
        <div class="shop_area">
            <div class="item_group">
                <ul class="tab_title">
                    <li><a href="#chair_row">椅子</a></li>
                    <li><a href="#table_row">桌子</a></li>
                    <li><a href="#bed_row">床</a></li>
                </ul>
                <div class="chair_type type">
                    <h2>椅子</h2>
                </div>
                <div id="chair_row" class="chair_row tab_inner owl-carousel owl-theme">
                    <?php
                    while ($chairRow = $chairs->fetchObject()) {
                        ?>

                        <div class="item">
                            <div class="wrap">
                                <div class="level_block" 
                                    <?php 
                                        if ($member->mem_lv >= $chairRow->mem_lv){ echo "style='display:none'"; } 
                                    ?>><span id="level_block_text">需要
                                    <span 
                                    <?php
                                        if($chairRow->mem_lv == 2){ echo "style='color:#1e668d'"; }
                                        if($chairRow->mem_lv == 3){ echo "style='color:#9999dd'"; }
                                    ?>>
                                    <?php
                                        if($chairRow->mem_lv == 2){ echo "貴族階級"; }
                                        if($chairRow->mem_lv == 3){ echo "皇族階級"; }
                                    ?>
                                    </span>才能購買<br>前往加入<a href="">認識更多好友</a></span>
                                </div>
                                <div class="item_title">
                                    <h3><?php echo $chairRow->furn_name ?></h3>
                                </div>
                                <div class="img_bg">
                                    <div class="img_wrap">
                                        <img src="imgs/shop/<?php echo $chairRow->furn_img_url ?>" alt="">
                                    </div>
                                    <div class="price_tag">
                                        <img src="imgs/shop/pricetag1.png" alt="">
                                        <span class="price"><?php echo $chairRow->furn_price ?></span>
                                    </div>
                                    <span class="btn_bg">
                                        <div class="btn_wrap">
                                            <span class="try">試用</span>
                                            <form action="buy.php" method="get">
                                                <input type="hidden" value="<?php echo $chairRow->furn_price ?>" name="furn_price">
                                                <input type="hidden" value="<?php echo $chairRow->furn_no ?>" name="furn_no">
                                                <span class="buy">
                                                    <?php 
                                                    while($memRow = $mem_fur->fetchObject()){
                                                        if($memRow->furn_no = $chairRow->furn_no){
                                                            echo "已購買";
                                                        }else {
                                                            echo "購買";
                                                        }
                                                    }
                                                     ?>
                                                </span>
                                            </form>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <div class="table_type type">
                    <h2>桌子</h2>
                </div>
                <div id="table_row" class="table_row tab_inner owl-carousel owl-theme">
                    <?php
                    while ($tableRow = $tables->fetchObject()) {
                        ?>

                        <div class="item">
                            <div class="wrap">
                            <div class="level_block" 
                                    <?php 
                                        if ($member->mem_lv >= $tableRow->mem_lv){ echo "style='display:none'"; } 
                                    ?>><span id="level_block_text">需要
                                    <span 
                                    <?php
                                        if($tableRow->mem_lv == 2){ echo "style='color:#1e668d'"; }
                                        if($tableRow->mem_lv == 3){ echo "style='color:#9999dd'"; }
                                    ?>>
                                    <?php
                                        if($tableRow->mem_lv == 2){ echo "貴族階級"; }
                                        if($tableRow->mem_lv == 3){ echo "皇族階級"; }
                                    ?>
                                    </span>才能購買<br>前往加入<a href="">認識更多好友</a></span>
                                </div>
                                <div class="item_title">
                                    <h3><?php echo $tableRow->furn_name ?></h3>
                                </div>
                                <div class="img_bg">
                                    <div class="img_wrap">
                                        <img src="imgs/shop/<?php echo $tableRow->furn_img_url ?>" alt="">
                                    </div>
                                    <div class="price_tag">
                                        <img src="imgs/shop/pricetag2.png" alt="">
                                        <span class="price"><?php echo $tableRow->furn_price ?></span>
                                    </div>
                                    <span class="btn_bg">
                                        <div class="btn_wrap">
                                            <span class="try">試用</span>
                                            <form action="buy.php" method="get">
                                                <input type="hidden" value="<?php echo $tableRow->furn_price ?>" name="furn_price">
                                                <input type="hidden" value="<?php echo $tableRow->furn_no ?>" name="furn_no">
                                                <span class="buy">購買</span>
                                            </form>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <div class="bed_type type">
                    <h2>床</h2>
                </div>
                <div id="bed_row" class="bed_row tab_inner owl-carousel owl-theme">
                    <?php
                    while ($bedRow = $beds->fetchObject()) {
                        ?>

                        <div class="item">
                            <div class="wrap">
                            <div class="level_block" 
                                    <?php 
                                        if ($member->mem_lv >= $bedRow->mem_lv){ echo "style='display:none'"; } 
                                    ?>><span id="level_block_text">需要
                                    <span 
                                    <?php
                                        if($bedRow->mem_lv == 2){ echo "style='color:#1e668d'"; }
                                        if($bedRow->mem_lv == 3){ echo "style='color:#9999dd'"; }
                                    ?>>
                                    <?php
                                        if($bedRow->mem_lv == 2){ echo "貴族階級"; }
                                        if($bedRow->mem_lv == 3){ echo "皇族階級"; }
                                    ?>
                                    </span>才能購買<br>前往加入<a href="">認識更多好友</a></span>
                                </div>
                                <div class="item_title">
                                    <h3><?php echo $bedRow->furn_name ?></h3>
                                </div>
                                <div class="img_bg">
                                    <div class="img_wrap">
                                        <img src="imgs/shop/<?php echo $bedRow->furn_img_url ?>" alt="">
                                    </div>
                                    <div class="price_tag">
                                        <img src="imgs/shop/pricetag1.png" alt="">
                                        <span class="price"><?php echo $bedRow->furn_price ?></span>
                                    </div>
                                    <span class="btn_bg">
                                        <div class="btn_wrap">
                                            <span class="try">試用</span>
                                            <form action="buy.php" method="get">
                                                <input type="hidden" value="<?php echo $bedRow->furn_price ?>" name="furn_price">
                                                <input type="hidden" value="<?php echo $bedRow->furn_no ?>" name="furn_no">
                                                <span class="buy">購買</span>
                                            </form>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
            <img src="imgs/shop/shed.png" class="shed" alt="">
        </div>
        <div class="show">
            <div class="light">
                <img src="imgs/shop/light.png" alt="">
            </div>
            <div class="show_title">
                <h2>展示區</h2>
            </div>
            <div class="try_area">
                <div id="chair_squid" class="squid"></div>
                <div id="table_squid" class="squid"></div>
                <div id="bed_squid" class="squid">
                    <div id="head_box">
                        <img src="imgs/shop/squid_head.png" alt="" id="squid_head">
                    </div>
                    <img src="imgs/shop/squid_body.png" alt="" id="squid_body">
                    <div class="foots">
                        <img src="imgs/shop/squid_foot.png" alt="" id="squid_foot1">
                        <img src="imgs/shop/squid_foot.png" alt="" id="squid_foot2">
                        <img src="imgs/shop/squid_foot.png" alt="" id="squid_foot3">
                    </div>
                </div>
                <div class="show_item">
                    <img id="bed" src="imgs/shop/bed_01.png" alt="">
                    <img id="table" src="imgs/shop/desk_L_01.png" alt="">
                    <img id="chair" src="imgs/shop/chair_L_01.png" alt="">
                </div>
                <img src="imgs/shop/stage.png" alt="" class="stage">
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/shop.js"></script>
</body>

</html>