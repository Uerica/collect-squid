<?php 
    session_start();
    $msg = "";
    $errMsg = "";
    try{
        require_once('connectSquid.php');

        $_SESSION["mem_no"] = 1;
        $mem_no = $_SESSION["mem_no"];

        //會員資料
        $memberSQL = "SELECT * FROM `member` WHERE `mem_no` = :mem_no";
        $memberInfo = $pdo->prepare($memberSQL);
        $memberInfo->bindValue(':mem_no', $mem_no);
        $memberInfo->execute();
        $memRow = $memberInfo->fetch(PDO::FETCH_ASSOC);

        // 留言
        $cmtSQL =
        "SELECT *
        FROM board_comment bc JOIN member m
        ON bc.send_mem_no = m.mem_no
        WHERE bc.rcv_mem_no = :rcv_mem_no;
        ";
        $comments = $pdo->prepare($cmtSQL);
        $comments->bindValue(':rcv_mem_no', $mem_no);
        $comments->execute();

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

        // 我使用的椅子
        $chairSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type AND mf.is_using = :is_using";
        $myUsingChair = $pdo->prepare($chairSQL);
        $myUsingChair->bindValue(':mem_no', $mem_no);
        $myUsingChair->bindValue(':furn_type', 1);
        $myUsingChair->bindValue(':is_using', 1);
        $myUsingChair->execute();
        $usingChair = $myUsingChair->fetch(PDO::FETCH_ASSOC);
        
        // 我使用的桌子
        $deskSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type AND mf.is_using = :is_using";
        $myUsingDesk = $pdo->prepare($deskSQL);
        $myUsingDesk->bindValue(':mem_no', $mem_no);
        $myUsingDesk->bindValue(':furn_type', 2);
        $myUsingDesk->bindValue(':is_using', 1);
        $myUsingDesk->execute();
        $usingDesk = $myUsingDesk->fetch(PDO::FETCH_ASSOC);
        
        // 我使用的床
        $bedSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type AND mf.is_using = :is_using";
        $myUsingBed = $pdo->prepare($bedSQL);
        $myUsingBed->bindValue(':mem_no', $mem_no);
        $myUsingBed->bindValue(':furn_type', 3);
        $myUsingBed->bindValue(':is_using', 1);
        $myUsingBed->execute();
        $usingBed = $myUsingBed->fetch(PDO::FETCH_ASSOC);

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

    <div class="myRoomPage">
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
                    <img id="picUploadImg" src="wall_pic/<?php echo $memRow["poster_img_url"] ?>">
                 <?php
                    // }
                ?>
                    <a href="javascript:;" id="msgBoard" class="messageBoard">
                        <span>留言板</span><br>
                        <img src="images/messageBoard.png">
                    </a>
                    <div class="addPhotoBtn">
                        <form id="uploadForm" method="post" action="myRoom.php" enctype="multipart/form-data">
                            <!-- <input type="hidden" name="imagestring"> -->
                            <input type="file" id="selectPicInput" name="selectPicInput" capture style="display:none">
                            <img src="images/camera.png" id="selectPic" style="cursor:pointer">
                            <input type="button" name="submitPic" id="submitPic" value="確定上傳">
                        </form>
                    </div>
                </div>
            </div>
            <div class="rightWall">
                <div class="roomIntro">
                        <h3><span><?php echo $memRow["mem_name"] ;?></span>的房間</h3>
                        <p>暱稱：<?php echo $memRow["mem_name"] ;?><br>
                        等級：<?php 
                        if($memRow["mem_lv"] == 1){echo "平民";}
                        if($memRow["mem_lv"] == 2){echo "貴族";}
                        if($memRow["mem_lv"] == 3){echo "皇族";} 
                        ?>
                        <br>
                        性別：<?php echo $memRow["mem_gender"] ?><br>
                        星座：<?php echo $memRow["mem_sign"] ?><br>
                        自我介紹：<?php echo $memRow["mem_intro"] ?>
                        <br>
                        </p>
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
                <a href="javascript:;">
                    <img id="cancel" src="images/cancelBtn.png">
                </a>
                <h2>留言板</h2>
                <div class="messageBoard" id="messageBoard">
                    <ul>
                        <?php 
                        while($cmtRow = $comments->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <li>
                                <input type="hidden" name="cmt_no" id="cmt_no" value="<?php echo $cmtRow["cmt_no"] ?>"> 
                                <div class="messageMem">
                                    <img src="images/squid_avatar.png">
                                    <span><?php echo $cmtRow["mem_name"]; ?></span>
                                </div>
                                <div class="message"><?php echo $cmtRow["cmt_cnt"] ?></div>
                                <div class="trashPic">
                                    <img src="images/trashcan.png" alt="反送中">
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="msgInputArea">
                    <input type="hidden" id="talking_mem_no" name="talking_mem_no" value="<?php echo $memRow['mem_no']; ?>">
                    <input type="text" class="msgInput">
                    <span class="textCount">20/50</span>
                    <div class="msgBtn">
                        <input type="hidden" name="me_mem_no" id="me_mem_no" value="<?php echo $memRow["mem_name"] ?>">
                        <input type="submit" class="msgSend" value="傳送留言">
                    </div>
                </div>
            </div>
        </div>

        <div class="myRoomFurniture">
            <input type="hidden" name="mem_no" id="mem_no" value="<?php echo $memRow["mem_no"]; ?>">
            <div class="bed">
                <img src="<?php echo $usingBed["furn_img_url"]; ?>">
            </div>
            <div class="chair">
                <img src="<?php echo $usingChair["furn_img_url"]; ?>">
            </div>
            <div class="desk">
                <img src="<?php echo $usingDesk["furn_img_url"]; ?>"> 
            </div>
            <div class="character">
                <img src="<?php echo $memRow["style_no"]; ?>">
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
                            <a href="javascript:;" class="chairSmallChange">
                                <input type="hidden" name="furn_type" id="furn_type" value="1">
                                <input type="hidden" name="furn_no" id="furn_no" value="<?php echo $myChairRow["furn_no"] ?>">
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
                            <a href="javascript:;s">
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
                            <a href="#" class="deskSmallChange">
                                <input type="hidden" name="furn_type" id="furn_type" value="2">
                                <input type="hidden" name="furn_no" id="furn_no" value="<?php echo $myDeskRow["furn_no"] ?>">
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
                            <a href="#" class="bedSmallChange">
                                <input type="hidden" name="furn_type" id="furn_type" value="3">
                                <input type="hidden" name="furn_no" id="furn_no" value="<?php echo $myBedRow["furn_no"] ?>">
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
    </div>

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