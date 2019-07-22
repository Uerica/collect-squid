<?php 
  session_start();
  $msg = "";

  $dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
  $user = "dd101g2";
  $psw = "dd101g2";
  $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  $pdo = new PDO($dsn, $user, $psw, $options);

  //上傳圖片
  if (isset($_POST['submitPic'])) {
    
    $image = $_FILES['selectPicInput']['name'];

    $target = "images/".basename($image);

    $sql = "UPDATE `member` SET `poster_img_url` = :poster_img_url WHERE mem_no = :mem_no";
  
    $uploadPic = $pdo->prepare($sql);
    $uploadPic->bindValue(":poster_img_url", $target);
    $uploadPic->bindValue(":mem_no", '24');
    $uploadPic->execute();
    
    //用move_uploaded_file() 出現問題
    if (@move_uploaded_file($_FILES['selectPicInput']['tmp_name'], $target)) {
        $msg = "success";
    }else{
        $msg = "failed";
    }
  }
?>

<?php  
    $errMsg = "";
    try{
        $dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
        $user = "dd101g2";
        $psw = "dd101g2";
        $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn, $user, $psw, $options);
        
        $_SESSION["mem_no"] = 20;
        $mem_no = $_SESSION["mem_no"];

        //會員資料
        $memberSQL = "SELECT * FROM `member` WHERE `mem_no` = :mem_no";
        $memberInfo = $pdo->prepare($memberSQL);
        $memberInfo->bindValue(':mem_no', $mem_no);
        $memberInfo->execute();

        //椅子
        // $chairSQL = "SELECT * FROM `product_furniture` WHERE `furn_type` = :furn_type";
        // $roomChair = $pdo->prepare($chairSQL);
        // $roomChair->bindValue(':furn_type', 1);
        // $roomChair->execute();

        // 我的椅子
        $chairSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type;";
        $myRoomChair = $pdo->prepare($chairSQL);
        $myRoomChair->bindValue(':mem_no', $mem_no);
        $myRoomChair->bindValue(':furn_type', 1);
        $myRoomChair->execute();

        //桌子
        // $deskSQL = "SELECT * FROM `product_furniture` WHERE `furn_type` = :furn_type";
        // $roomDesk = $pdo->prepare($deskSQL);
        // $roomDesk->bindValue(':furn_type', 2);
        // $roomDesk->execute();

        // 我的桌子
        $deskSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type;";
        $myRoomDesk = $pdo->prepare($deskSQL);
        $myRoomDesk->bindValue(':mem_no', $mem_no);
        $myRoomDesk->bindValue(':furn_type', 2);
        $myRoomDesk->execute();

        //床
        // $bedSQL = "SELECT * FROM `product_furniture` WHERE `furn_type` = :furn_type";
        // $roomBed = $pdo->prepare($bedSQL);
        // $roomBed->bindValue(':furn_type', 3);
        // $roomBed->execute();

        // 我的床
        $bedSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type;";
        $myRoomBed = $pdo->prepare($bedSQL);
        $myRoomBed->bindValue(':mem_no', $mem_no);
        $myRoomBed->bindValue(':furn_type', 3);
        $myRoomBed->execute();

    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css">
    <!-- <link rel="stylesheet" href="sass/_room.css"> -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="sass/style.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/629062769a.js"></script>
    <script src="js/room.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="roomPage">
    </div>
    <!-- 導覽列 -->
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

        <div class="menuHandheld">
            <div class="menuMobile_overlay">
                <div class="menuMobile_menu">
                    <ul class="memberInfo">
                        <li class="coin">
                            <a href="javascript:;">
                                <img src="imgs/homePage/icon/coin.png" alt="持有金額icon">
                                <span>1500</span>
                            </a>
                        </li>
                        <li class="logo">
                            <a href="index.html">
                                <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                                <span>尋找友誼</span>
                            </a>
                        </li>
                        <li class="login">
                            <img src="imgs/homePage/icon/avatar.png" alt="角色頭像icon">
                            <span class="name">
                                <a href="javascript:;">魚翔</a>
                            </span>
                            <span>
                                <a href="javascript:;">登出</a>
                            </span>
                        </li>
                    </ul>
                    <nav class="menuMobile_nav">
                        <li><a href="myRoom.html"> <img src="imgs/homePage/icon/room.png" alt="我的房間icon">
                                <span>我的房間</span></a></li>
                        <li><a href="dressingRoom.html"><img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                                <span>換衣間</span></a></li>
                        <li><a href="findfriend.html"> <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                                <span>找朋友</span></a></li>
                        <li><a href="javascript:;"> <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                                <span>揪團活動</span></a></li>
                        <li><a href="shop.html"> <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                                <span>虛擬商城</span></a></li>
                        <li><a href="memberCenter.html"> <img src="imgs/homePage/icon/member.png" alt="會員中心icon">
                                <span>會員中心</span></a></li>
                        <li><a href="javascript:;"> <img src="imgs/homePage/icon/robot.png" alt="客服機器人_icon">
                                <span>客服機器人</span></a></li>
                        <li><a href="javascript:;"> <img src="imgs/homePage/icon/notice02.png" alt="通知_icon">
                                <span>通知</span></a></li>
                    </nav>
                </div>
            </div>
        </div>

        <nav class="menuDesktop">
            <ul>
                <li class="hvr-pulse-grow">
                    <a href="myRoom.html">
                        <img src="imgs/homePage/icon/room.png" alt="我的房間icon">
                        <span>我的房間</span>
                    </a>
                </li>
                <li class="hvr-pulse-grow">
                    <a href="dressingRoom.html">
                        <img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                        <span>換衣間</span>
                    </a>
                </li>
                <li class="hvr-pulse-grow">
                    <a href="findfriend.html">
                        <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                        <span>找朋友</span>
                    </a>
                </li>
                <li class="hvr-pulse-grow">
                    <a href="javascript:;">
                        <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                        <span>揪團活動</span>
                    </a>
                </li>
                <li class="logo hvr-pulse-grow">
                    <a href="index.html">
                        <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                        <span>尋找友誼</span>
                    </a>
                </li>
                <li class="hvr-pulse-grow">
                    <a href="shop.html">
                        <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                        <span>虛擬商城</span>
                    </a>
                </li>
                <li class="hvr-pulse-grow">
                    <a href="memberCenter.html">
                        <img src="imgs/homePage/icon/member.png" alt="會員中心icon">
                        <span>會員中心</span>
                    </a>
                </li>
                <div class="memberInfo">
                    <li class="login">
                        <img src="imgs/homePage/icon/avatar.png" alt="角色頭像icon">
                        <span class="name"><a href="javascript:;">魚翔</a></span>
                        <span><a href="javascript:;">登出</a></span>
                    </li>
                    <li class="coin">
                        <a href="javascript:;">
                            <img src="imgs/homePage/icon/coin.png" alt="持有金額icon">
                            <span>1500</span>
                        </a>
                    </li>
                    <li class="level">
                        <a href="javascript:;">
                            <img src="imgs/homePage/icon/civilian.png" alt="平民等級icon">
                            <span>平民</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>

    <content>
        <div class="myRoomBg">
            <div class="leftWall">
                <img src="images/window.png">
            </div>
            <div class="middleWall">
                
                <div class="picUpload"> 

                <?php

                    // $dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
                    // $user = "dd101g2";
                    // $psw = "dd101g2";
                    // $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
                    // $pdo = new PDO($dsn, $user, $psw, $options);

                    // $sql = "SELECT * FROM `member` WHERE `mem_no` = ':mem_no'";

                    // $result = $pdo->prepare($sql);
                    // while($uploadPicRow = $result->fetchObject()){
                ?>       

                    <img id="picUploadImg">

                 <?php
                    // }
                ?>
                    <a href="#" id="msgBoard" class="messageBoard">
                        <span>留言板</span><br>
                        <img src="images/messageBoard.png">
                    </a>
                    <div class="addPhotoBtn">
                        <form id="uploadForm" method="post" action="myRoom.php" enctype="multipart/form-data">
                            <input type="hidden" name="imagestring">
                            <input type="file" id="selectPicInput" name="selectPicInput" capture style="display:none">
                            <img src="images/camera.png" id="selectPic" style="cursor:pointer">
                            <input type="submit" name="submitPic" id="submitPic" value="確定上傳">
                        </form>
                    </div>
                </div>
            </div>
            <div class="rightWall">
                <div class="roomIntro">
                    <?php 
                      while($memberArr = $memberInfo->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <h3><span><?php echo $memberArr["mem_name"] ;?></span>的房間</h3>
                        <p>暱稱：<?php echo $memberArr["mem_name"] ;?><br>
                        等級：<?php 
                        if($memberArr["mem_lv"] == 1){echo "平民";}
                        if($memberArr["mem_lv"] == 2){echo "貴族";}
                        if($memberArr["mem_lv"] == 3){echo "皇族";} 
                        ?>
                        <br>
                        性別：<?php echo $memberArr["mem_gender"] ?><br>
                        星座：<?php echo $memberArr["mem_sign"] ?><br>
                        自我介紹：<?php echo $memberArr["mem_intro"] ?>
                        <br>
                        </p>
                    <?php 
                        }
                    ?>
                    <div class="getHeart">
                        <img src="images/getHeart.png">
                        <span>100</span>
                    </div>
                    <!-- <div class="btns">
                        <a href="#">給我你的愛</a>
                        <a href="#">加我好友嘛</a>
                    </div> -->
                </div>
                
            </div>
        </div>

        <div class="lightboxBg">
            <div class="lightbox">
                <a href="#">
                    <img id="cancel" src="images/cancelBtn.png">
                </a>
                <h2>留言板</h2>
                <div class="message">
                    <ul>
                        <li>
                            <img src="images/squid_avatar.png">
                            <span>#魚翔你的家敲口愛的</span>
                        </li>
                        <li>
                            <img src="images/squid_avatar.png">
                            <span>＃魚翔你家超...超漂亮的，害我忍不住都濕了</span>
                        </li>
                        <li>
                            <img src="images/squid_avatar.png">
                            <span>#魚翔你下次滷味要吃大辣嗎？</span>
                        </li>
                    </ul>
                </div>
                <div class="msgInputArea">
                    <input type="text" class="msgInput">
                    <span class="textCount">20/50</span>
                    <div class="msgBtn">
                        <input type="submit" class="msgSend" value="傳送留言">
                    </div>
                </div>
            </div>
        </div>

        <div class="myRoomFurniture">
            <div class="bed">
                <img src="images/bed_LV1_01.png">
            </div>
            <div class="chair">
                <img src="images/chair_LV1_01.png">
            </div>
            <div class="desk">
                <img src="images/desk_LV1_01.png"> 
            </div>
            <div class="character">
                <img src="images/squid.png">
            </div>
        </div>

        <section id="furnitureTab">
            <ul class="tabTitle">
                <li id="chairTabTitle"><a href="#chairTab">椅子</a></li>
                <li id="deskTabTitle"><a href="#deskTab">桌子</a></li>
                <li id="bedTabTitle"><a href="#bedTab">床</a></li>
                <li><a href="#" id="openFurniture">家具更換</a></li>
            </ul>
            <div id="chairTab" class="tabContent swiper-container">
                
                <div class="swiper-wrapper">
                    <?php 
                    $chairCount = 0;
                    while ($myChairRow = $myRoomChair->fetch(PDO::FETCH_ASSOC)) {
                        $chairCount++;
                    ?>
                        <div class="swiper-slide">
                            <a href="#" class="chairSmallChange">
                                <img src="<?php 
                                    echo $myChairRow["furn_img_url"];
                                ?>">
                                <span><?php 
                                    echo $myChairRow["furn_name"];
                                ?></span>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                    <?php 
                    while ($chairCount < 9) {
                        $chairCount++;
                    ?>
                        <div class="toMall swiper-slide">
                            <a href="#">
                                <img src="images/cart.png">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                
            </div>

            <div id="deskTab" class="tabContent swiper-container">
                <div class="swiper-wrapper">
                <?php 
                    $deskCount = 0;
                    while ($myDeskRow = $myRoomDesk->fetch(PDO::FETCH_ASSOC)) {
                        $deskCount++;
                    ?>
                        <div class="swiper-slide">
                            <a href="#" class="chairSmallChange">
                                <img src="<?php 
                                    echo $myDeskRow["furn_img_url"];
                                ?>">
                                <span><?php 
                                    echo $myDeskRow["furn_name"];
                                ?></span>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                    <?php 
                    while ($deskCount < 9) {
                        $deskCount++;
                    ?>
                        <div class="toMall swiper-slide">
                            <a href="#">
                                <img src="images/cart.png">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            
            <div id="bedTab" class="tabContent swiper-container">
                <div class="swiper-wrapper">
                <?php 
                    $bedCount = 0;
                    while ($myBedRow = $myRoomBed->fetch(PDO::FETCH_ASSOC)) {
                        $bedCount++;
                    ?>
                        <div class="swiper-slide">
                            <a href="#" class="chairSmallChange">
                                <img src="<?php 
                                    echo $myBedRow["furn_img_url"];
                                ?>">
                                <span><?php 
                                    echo $myBedRow["furn_name"];
                                ?></span>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                    <?php 
                    while ($bedCount < 9) {
                        $bedCount++;
                    ?>
                        <div class="toMall swiper-slide">
                            <a href="#">
                                <img src="images/cart.png">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>  
    </content>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>

    <script>
        var swiper = new Swiper('.swiper-container', {
          slidesPerView: 9,
          spaceBetween: 10,
          slidesPerGroup: 9,
          loop: false,
          loopFillGroupWithBlank: false,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },

          breakpoints: {
            768: {
              slidesPerView: 5,
              spaceBetween: 10,
              slidesPerGroup: 5,
            }
          }
        });
    </script>
    
</body>

</html>