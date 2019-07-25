
<?php  
    session_start();
    if(!isset($_SESSION["mem_name"])||($_SESSION["mem_name"] == "")){
        header("Location: /homePage.php");
        die();
    } else {
        $mem_no = $_SESSION["mem_no"];
        $mem_name = $_SESSION["mem_name"];
        $style_no = $_SESSION["style_no"];
        $mem_lv = $_SESSION["mem_lv"];
        $mem_avatar = $_SESSION["mem_avatar"];
        $squid_qty = $_SESSION["squid_qty"];
    };
    $errMsg = "";
    try{
        require_once('connectSquid.php');
        
        //登入者
        //$mem_no = 1;
        $mem_no = $_SESSION["mem_no"];

        //被拜訪者
        //$other_mem_no = 20;
        $other_mem_name = $_REQUEST["other_user"];
        

        //使用者,拜訪人會員資料
        $memberSQL = 
        "SELECT * 
        FROM `member` 
        WHERE `mem_no` = :mem_no";
        $memInfo = $pdo->prepare($memberSQL);
        $memInfo->bindValue(':mem_no', $mem_no);
        $memInfo->execute();
        $memRow = $memInfo->fetch(PDO::FETCH_ASSOC);

        //房間主人會員資料
        $memberSQL = 
        "SELECT * 
        FROM `member` 
        WHERE `mem_name` = :mem_name";
        $otherInfo = $pdo->prepare($memberSQL);
        $otherInfo->bindValue(':mem_name',$other_mem_name);
        $otherInfo->execute();
        $otherRow = $otherInfo->fetch(PDO::FETCH_ASSOC);
        $other_mem_no = $otherRow["mem_no"];
        // echo $other_mem_no;
        //確認好友狀態
        $friendSQL = 
        "SELECT * 
        FROM `relationship` 
        WHERE `mem_no` = :mem_no AND friend_no = :friend_no";
        $friendConfirm = $pdo->prepare($friendSQL);
        $friendConfirm->bindValue(':mem_no', $mem_no);
        $friendConfirm->bindValue(':friend_no', $other_mem_no);
        $friendConfirm->execute();
        $friendConfirmRow = $friendConfirm->fetch(PDO::FETCH_ASSOC);

        // 房間主人的愛心數量
        $heartSQL = 
        "SELECT *
        FROM heart_record
        WHERE `rcv_mem_no` = :mem_no";
        $heart = $pdo->prepare($heartSQL);
        $heart->bindValue(':mem_no', $other_mem_no);
        $heart->execute();
        $heartCount = $heart->rowCount();

        // 留言
        $cmtSQL =
        "SELECT *
        FROM board_comment bc JOIN member m
        ON bc.send_mem_no = m.mem_no
        WHERE bc.rcv_mem_no = :rcv_mem_no;
        ";
        $comments = $pdo->prepare($cmtSQL);
        $comments->bindValue(':rcv_mem_no', $other_mem_no);
        $comments->execute();

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
        // $errMsg .= $e->getMessage()."<br>";
        // $errMsg .= $e->getLine()."<br>";
        // echo $errMsg;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="icon" href="imgs/homePage/logo02.png">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="sass/style.css">
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
  <div class="roomPage">
    </div>
    <!-- vue -->
    <div id="app">
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
                                    <span class="squid_qty">{{squid_qty}}</span>
                                </a>
                            </li>
                            <li class="logo">
                                <a href="homePage.php">
                                    <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                                    <span>尋找友誼</span>
                                </a>
                            </li>
                            <li class="login">
                                <img src="imgs/homePage/icon/avatar.png" alt="角色頭像icon">
                                <span class="name">
                                <a href="javascript:;">{{user_id}}</a>
                                </span>
                                <span>
                                <a v-if="is_login()" v-on:click="logout">登出</a>
                                <a v-else>登入</a>
                                </span>
                            </li>
                        </ul>
                        <nav class="menuMobile_nav">
                            <li><a href="myRoom.php"> <img src="imgs/homePage/icon/room_selected.png" alt="我的房間icon">
                                    <span>我的房間</span></a></li>
                            <li><a href="dressingRoom.php"><img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                                    <span>換衣間</span></a></li>
                            <li><a href="findfriend.php"> <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                                    <span>找朋友</span></a></li>
                            <li><a href="events.php"> <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                                    <span>揪團活動</span></a></li>
                            <li><a href="shop.php"> <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                                    <span>虛擬商城</span></a></li>
                            <li><a href="memberCenter.php"> <img src="imgs/homePage/icon/member.png" alt="會員中心icon">
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
                        <a href="myRoom.php nav_myRoom">
                            <img src="imgs/homePage/icon/room_selected.png" alt="我的房間icon">
                            <span style="color: #fffdfd">我的房間</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow nav_dressingRoom">
                        <a href="dressingRoom.php">
                            <img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                            <span>換衣間</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow nav_findFriend">
                        <a href="findfriend.php">
                            <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                            <span>找朋友</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow nav_events">
                        <a href="events.php">
                            <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                            <span>揪團活動</span>
                        </a>
                    </li>
                    <li class="logo hvr-pulse-grow nav_logo">
                        <a href="homePage.php">
                            <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                            <span>尋找友誼</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow nav_shop">
                        <a href="shop.php">
                            <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                            <span>虛擬商城</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow nav_member">
                        <a href="memberCenter.php">
                            <img src="imgs/homePage/icon/member.png" alt="會員中心icon">
                            <span>會員中心</span>
                        </a>
                    </li>
                    <div class="memberInfo">
                        <li class="login">
                            <img src="imgs/homePage/icon/avatar.png" alt="角色頭像icon">
                            <span class="name">
                            <a href="javascript:;">{{user_id}}</a>
                            </span>
                            <span>
                            <a v-if="is_login()" v-on:click="logout">登出</a>
                            <a v-else>登入</a>
                            </span>
                        </li>
                        <li class="coin">
                            <a href="javascript:;">
                                <img src="imgs/homePage/icon/coin.png" alt="持有金額icon">
                                <span class="squid_qty">{{squid_qty}}</span>
                            </a>
                        </li>
                        <li class="level">
                            <a href="javascript:;">
                                <img v-if="mem_lv=='1'" src="imgs/homePage/icon/civilian.png" alt="平民等級icon">
                                <img v-if="mem_lv=='2'" src="imgs/homePage/icon/friend.png" alt="貴族等級icon">
                                <img v-if="mem_lv=='3'" src="imgs/homePage/icon/friend.png" alt="皇族等級icon">
                                <span>平民</span>                                                                                    
                            </a>
                        </li>
                    </div>
                </ul>
            </nav>
        </header>
    </div>

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
                    <p class="intro">  
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
                        <span><?php echo $heartCount;?></span>
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
                        <form action="">
                            <input type="hidden" name="other_mem_name" value="<?php echo $otherRow["mem_name"]; ?>">
                            <input type="hidden" name="mem_name" value="<?php echo $memRow["mem_name"]; ?>">  
                            <a href="javascript:;" id="addFriend">
                                <?php 
                                if(isset($friendConfirmRow["status"]) == true){
                                    if($friendConfirmRow["status"] == 1){
                                        echo "已成為好友";
                                    } else {
                                        echo "好友確認中";
                                    }
                                } else {
                                    echo "加我好友嘛";
                                }
                             
                                ?>
                            </a>
                        </form>
                    </div>
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
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="msgInputArea">
                    <input type="hidden" id="send_mem_no" name="send_mem_no" value="<?php echo $memRow['mem_no']; ?>">
                    <input type="text" class="msgInput">
                    <!-- <span class="textCount">20/50</span> -->
                    <div class="msgBtn">
                        <input type="hidden" name="send_mem_name" id="send_mem_name" value="<?php echo $memRow["mem_name"] ?>">
                        <input type="hidden" name="rcv_mem_no" id="rcv_mem_no" value="<?php echo $otherRow["mem_no"] ?>">
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
                <img src="<?php 
                     echo $otherRow["dressed_no"] == ""? $otherRow["style_no"] : $otherRow["dressed_no"]; 
                    ?>">
            </div>
        </div>

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/addFriend.js"></script>
    <script src="https://kit.fontawesome.com/629062769a.js"></script>
    <script src="js/otherRoom.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js'></script>
    <script src="js/chat.js"></script>
    <script src="js/nav.js"></script>
    <!-- 串navbar 登入功能 -->
    <script>
      <?php 
          if(isset($_SESSION["mem_name"])){
              echo "var mem_no='" . $_SESSION["mem_no"] . "';";
              echo "var mem_name='" . $_SESSION["mem_name"] . "';";
              echo "var style_no='" . $_SESSION["style_no"] . "';";
              echo "var mem_lv='" . $_SESSION["mem_lv"] . "';";
              echo "var mem_avatar='" . $_SESSION["mem_avatar"] . "';";
              echo "var squid_qty='" . $_SESSION["squid_qty"] . "';";
          }
      ?>
      $(document).ready(function(){
          <?php 
              if(isset($_SESSION["mem_name"])){
                  echo "login(mem_name,style_no,mem_lv,mem_avatar,squid_qty);";
              }
          ?>
      });
    </script>
</body>

</html>