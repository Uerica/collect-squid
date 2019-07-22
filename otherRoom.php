<?php 
  session_start();
  $msg = "";

  $dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
  $user = "dd101g2";
  $psw = "dd101g2";
  $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  $pdo = new PDO($dsn, $user, $psw, $options);
?>

<?php  
    $errMsg = "";
    try{
        $dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
        $user = "dd101g2";
        $psw = "dd101g2";
        $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn, $user, $psw, $options);
        
        $mem_no = 1;
        $other_mem_no = 20;

        //房間主人會員資料
        $memberSQL = 
        "SELECT * 
        FROM `member` 
        WHERE `mem_no` = :mem_no";
        $otherInfo = $pdo->prepare($memberSQL);
        $otherInfo->bindValue(':mem_no', $other_mem_no);
        $otherInfo->execute();
        $otherRow = $otherInfo->fetch(PDO::FETCH_ASSOC);

        // 我使用的椅子
        $chairSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type AND mf.is_using = :is_using";
        $myRoomChair = $pdo->prepare($chairSQL);
        $myRoomChair->bindValue(':mem_no', $other_mem_no);
        $myRoomChair->bindValue(':furn_type', 1);
        $myRoomChair->bindValue(':is_using', 1);
        $myRoomChair->execute();
        $usingChair = $myRoomChair->fetch(PDO::FETCH_ASSOC);
        
        // 我使用的桌子
        $deskSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type AND mf.is_using = :is_using";
        $myRoomDesk = $pdo->prepare($deskSQL);
        $myRoomDesk->bindValue(':mem_no', $other_mem_no);
        $myRoomDesk->bindValue(':furn_type', 2);
        $myRoomDesk->bindValue(':is_using', 1);
        $myRoomDesk->execute();
        $usingDesk = $myRoomDesk->fetch(PDO::FETCH_ASSOC);
        
        // 我使用的床
        $bedSQL = 
        "SELECT *
        FROM mem_furniture mf JOIN product_furniture pf 
        ON mf.furn_no = pf.furn_no 
        WHERE mf.mem_no = :mem_no AND pf.furn_type = :furn_type AND mf.is_using = :is_using";
        $myRoomBed = $pdo->prepare($bedSQL);
        $myRoomBed->bindValue(':mem_no', $other_mem_no);
        $myRoomBed->bindValue(':furn_type', 3);
        $myRoomBed->bindValue(':is_using', 1);
        $myRoomBed->execute();
        $usingBed = $myRoomBed->fetch(PDO::FETCH_ASSOC);

        // 有沒有被給愛心
        $heartSQL =
        "SELECT *
        FROM heart_record
        WHERE send_mem_no = :mem_no
            AND rcv_mem_no = :other_mem_no
        ";
        $heart = $pdo->prepare($heartSQL);
        $heart->bindValue(':mem_no', $mem_no);
        $heart->bindValue(':other_mem_no', $other_mem_no);
        $heart->execute();
        
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
                    <img id="picUploadImg">
                    <a href="#" id="msgBoard" class="messageBoard">
                        <span>留言板</span><br>
                        <img src="images/messageBoard.png">
                    </a>
                    <!-- <div class="addPhotoBtn">
                        <form id="uploadForm" method="post" action="myRoom.php" enctype="multipart/form-data">
                            <input type="hidden" name="imagestring">
                            <input type="file" id="selectPicInput" name="selectPicInput" capture style="display:none">
                            <img src="images/camera.png" id="selectPic" style="cursor:pointer">
                            <input type="button" name="submitPic" id="submitPic" value="確定上傳">
                        </form>
                    </div> -->
                </div>
            </div>
            <div class="rightWall">
                <div class="roomIntro">
                    <h3><span><?php echo $otherRow["mem_name"] ;?></span>的房間</h3>
                    <p>
                        暱稱：<?php echo $otherRow["mem_name"] ;?><br>
                        等級：
                        <?php 
                            if($otherRow["mem_lv"] == 1){echo "平民";}
                            if($otherRow["mem_lv"] == 2){echo "貴族";}
                            if($otherRow["mem_lv"] == 3){echo "皇族";} 
                        ?><br>
                        性別：<?php echo $otherRow["mem_gender"] ?><br>
                        星座：<?php echo $otherRow["mem_sign"] ?><br>
                        自我介紹：<?php echo $otherRow["mem_intro"] ?><br>
                    </p>
                    <div class="getHeart">
                        <img src="images/getHeart.png">
                        <span>100</span>
                    </div>
                    <div class="btns">
                        <form action="" id="heartForm">
                            <input type="hidden" name="other_mem_no" value="<?php echo $other_mem_no; ?>">
                            <input type="hidden" name="mem_no" value="<?php echo $mem_no; ?>">
                            <input type="hidden" name="isLove" id="isLove" 
                            value="<?php echo $heart->rowCount() == 0 ? "giving" : "retrieving"  ?>">
                            <a href="javascript:;" id="giveHeart">
                                <?php echo $heart->rowCount() == 0 ? "給我你的愛" : "我不愛你了" ?>
                            </a>
                        </form>
                        <a href="javascript:;" id="addFriend">加我好友嘛</a>
                    </div>
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
                <img src="<?php echo $usingBed["furn_img_url"]; ?>">
            </div>
            <div class="chair">
                <img src="<?php echo $usingChair["furn_img_url"]; ?>">
            </div>
            <div class="desk">
                <img src="<?php echo $usingDesk["furn_img_url"]; ?>"> 
            </div>
            <div class="character">
                <img src="<?php echo $otherRow["style_no"]; ?>">
            </div>
        </div>

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/629062769a.js"></script>
    <script src="js/otherRoom.js"></script>
</body>

</html>