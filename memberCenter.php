<?php
$errMsg = "";
try {
	require_once("connectDB.php");

	$sql = "select * from member";
	$products = $pdo->query($sql); 
	$prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="sass/style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script> -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- <script src="js/vue.js"></script> -->
    
    <title>會員中心</title>
</head>

<body>

<?php
$errMsg = "";
try {
	require_once("connectDB.php");

	$sql = "select * from member where mem_email=:email and mem_pwd=:mem_pwd";
    $members = $pdo->prepare($sql); 
    $members->bindValue(":email","111@abc.com");
    $members->bindValue(":mem_pwd","111");
    $members->execute();
    // $found = false;

} catch (PDOException $e) {
	echo "錯誤 : ", $e -> getMessage(), "<br>";
	echo "行號 : ", $e -> getLine(), "<br>";
}
 
?>


    <!-- Navbar  -->
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
                        <a href="javascript:;">魚翔</a>
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
                        <span class="name"><a href="javascript:;">魚翔</a></span>
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





    <!-- 通知&客服機器人 -->






    <!-- 會員中心  -->
    <div class="memBg">

        <!-- 雲 -->
        <div class="cloud_1 cloud">
            <img src="imgs/memberCenter/cloud1.png" alt="cloud_1">
        </div>
        <div class="cloud_2 cloud">
            <img src="imgs/memberCenter/cloud2.png" alt="cloud_2">
        </div>
        <div class="cloud_3 cloud">
            <img src="imgs/memberCenter/cloud3.png" alt="cloud_3">
        </div>
        <div class="cloud_4 cloud">
            <img src="imgs/memberCenter/cloud4.png" alt="cloud_4">
        </div>
        <div class="cloud_5 cloud">
            <img src="imgs/memberCenter/cloud5.png" alt="cloud_5">
        </div>
        <div class="cloud_6 cloud">
            <img src="imgs/memberCenter/cloud6.png" alt="cloud_6">
        </div>



        <div class="memArea">
            <div class="memAreaMiddlebox">
                <div class="memPhoto_phone">
                    <img src="imgs/memberCenter/memCenter_photo.png" alt="會員魷魚圖">
                </div>
                <!-- <div class="memFileMidbox"> *****-->
                <div class="memFile">
                    <!--手機版用-->
                    <center>基本資訊</center>
                    
                    <!-- 會員資訊欄 -->
                    <div id="memInfo_phone" class="memFileWrapInfo">
                        <!-- <form action=""> -->
                        <div class="memInfoWrapTable">
                            <table>
                                <tr>
                                    <th>編號:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>暱稱:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>性別:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>生日:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>星座:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>帳號:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>密碼:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>信箱:</th>
                                    <td></td>
                                </tr><!-- -->
                            </table>
                        
                            <div class="memFileInfoBtn">
                                <button id="Edit_phone" class="btnEdit">編輯基本資料</button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                    
                    
                    <!-- form表單,input輸入 -->
                    <div id="memForm_phone" class="memFileWrapFrom">
                        <!-- <form action=""> -->
                        <div class="memFileWrapTable">
                            <table>
                                <tr>
                                    <th>編號:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>暱稱:</th>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th>性別:</th>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th>生日:</th>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th>星座:</th>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th>帳號:</th>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th>密碼:</th>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th>信箱:</th>
                                    <td><input type="text"></td>
                                </tr><!-- -->
                            </table>


                            <!-- </div> *****-->
                            <div class="memFileBtn">
                                <input type="submit" id="confirm_phone" class="btnConfirm" value="確認修改">
                                <!-- <button></button> -->
                                <button id="cancel_phone" class="btnCanncel">取消</button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>



                <div class="memFile_web">
                    <!-- 電腦版用 -->
                    <center>基本資訊</center>

                    <!-- 會員資訊欄 -->
                    <div id="memInfo_web" class="memFileWrapInfo">
                        <!-- <form action=""> -->
                        <?php
                            if($members->rowCount() != 0){
                                $member = $members->fetch();
                                $found = true;
                                // echo "<pre>";
                                // print_r($member); 
                                // echo "</pre>";

                        ?>
                            <table>
                                <tr>
                                    <th>編號:</th>
                                    <td><?php echo $member["mem_no"]; ?></td>
                                    <th>星座:</th>
                                    <td><?php echo $member["mem_sign"]; ?></td>
                                </tr>
                                <tr>
                                    <th>暱稱:</th>
                                    <td><?php echo $member["mem_name"]; ?></td>
                                    <th>帳號:</th>
                                    <td><?php echo $member["mem_name"]; ?></td>
                                </tr>
                                <tr>
                                    <th>性別:</th>
                                    <td><?php echo $member["mem_gender"]; ?></td>
                                    <th>密碼:</th>
                                    <td><!--<button>修改密碼</button>--></td>
                                </tr>
                                <tr>
                                    <th>生日:</th>
                                    <td><?php echo $member["mem_dob"]; ?></td>
                                    <th>信箱:</th>
                                    <td><?php echo $member["mem_email"]; ?></td>
                                </tr>
                            </table>
                            <?php 
                             }else{
                                echo "no";
                             }
                            ?>


                            <!-- </div> *****-->
                            <div class="memFileInfoBtn">
                                <button id="Edit_web" class="btnEdit">編輯基本資料</button>
                            </div>
                        <!-- </form> -->
                    </div>

                    <!-- form表單,input輸入 -->
                    <div id="memForm_web" class="memFileWrapFrom">
                        <div class="memFileForm_web">
                            <form id="myForm_web">
                            <table>
                                <tr>
                                    <th>編號:</th>
                                    <td></td>
                                    <th>星座:</th>
                                    <td><input type="text" name="mem_sign" value="<?php echo $member["mem_sign"]; ?>"></td>
                                </tr>
                                <tr>
                                    <th>暱稱:</th>
                                    <td><input type="text" name="mem_name" value="<?php echo $member["mem_name"]; ?>"></td>
                                    <th>&nbsp;<!--帳號:--></th>
                                    <td>&nbsp;<!--<input type="text">--></td>
                                </tr>
                                <tr>
                                    <th>性別:</th>
                                    <td>
                
                                        <input type="radio" value="男" name="gender" <?php if ($member["mem_gender"]=="男") {
                                            echo "checked";}?>>男 
                                        <input type="radio" value="女" name="gender" <?php if ($member["mem_gender"]=="女") {
                                            echo "checked";}?>>女
                                    </td>
                                    <th>密碼:</th>
                                    <td><input type="password" name="mem_pwd" value="<?php echo $member["mem_pwd"]; ?>"></td>
                                </tr>
                                <tr>
                                    <th>生日:</th>
                                    <td><input type="date" name="mem_dob" value="<?php echo $member["mem_dob"]; ?>"></td>
                                    <th>信箱:</th>
                                    <td><input type="email" name="mem_pwd" value="<?php echo $member["mem_pwd"]; ?>"></td>
                                </tr>
                            </table>
                            </form>


                            <!-- </div> *****-->
                            <div class="memFileBtn">
                                <input type="submit" id="confirm_web" class="btnConfirm" value="確認修改">
                                <!-- <button></button> -->
                                <button id="cancel_web" class="btnCanncel">取消</button>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>


        <div id="msgRecord" class="msgRecord">
            <div class="msgRecordInnerBG">
                <div class="msgRecordText">

                    <div class="msgRecordText_img">
                        <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                    </div>
                    <div class="msgRecordText_words">
                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                            的家也能有她一半那麼辣就好了，希望她
                            能加我好友。</p>
                    </div>

                </div>
                <div class="msgRecordText">

                    <div class="msgRecordText_img">
                        <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                    </div>
                    <div class="msgRecordText_words">
                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                            的家也能有她一半那麼辣就好了，希望她
                            能加我好友。</p>
                    </div>

                </div>
                <div class="msgRecordText"></div>
                <div class="msgRecordText"></div>
                <div class="msgRecordText"></div>

            </div>
        </div>
        

        <div id="grpRecord" class="groupRecord">

            <div class="groupRecordInnerBG">
                <div class="groupRecordText">

                    <div class="groupRecordText_img">
                        <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                    </div>
                    <div class="groupRecordText_words">
                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                            的家也能有她一半那麼辣就好了，希望她
                            能加我好友。參加揪團。</p>
                    </div>

                </div>
                <div class="groupRecordText">

                    <div class="groupRecordText_img">
                        <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                    </div>
                    <div class="groupRecordText_words">
                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                            的家也能有她一半那麼辣就好了，希望她
                            能加我好友。參加揪團。</p>
                    </div>

                </div>
                <div class="groupRecordText"></div>
                <div class="groupRecordText"></div>
                <div class="groupRecordText"></div>

            </div>

        </div>
        <div id="shopRecord" class="shopRecord">

            <div class="shopRecordInnerBG">
                <div class="shopRecordText">

                    <div class="shopRecordText_img">
                        <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                    </div>
                    <div class="shopRecordText_words">
                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                            的家也能有她一半那麼辣就好了，希望她
                            能加我好友。購物購物記錄。</p>
                    </div>

                </div>
                <div class="shopRecordText">

                    <div class="shopRecordText_img">
                        <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                    </div>
                    <div class="shopRecordText_words">
                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                            的家也能有她一半那麼辣就好了，希望她
                            能加我好友。購物購物記錄。</p>
                    </div>

                </div>
                <div class="shopRecordText"></div>
                <div class="shopRecordText"></div>
                <div class="shopRecordText"></div>

            </div>

        </div>


        <div class="recordArea">
            <div id="msgRecordBtn" class="recordBtn">留言記錄</div>
            <div id="grpRecordBtn" class="recordBtn">揪團記錄</div>
            <div id="shopRecordBtn" class="recordBtn">購物記錄</div>
        </div>

        <script>
            // $(window).onload(funciton(){
            // $("#msgRecordBtn").click(function () {
            //     $("#msgRecord").toggle();
            //     $("#grpRecord").hide();
            //     $("#shopRecord").hide();
            // });

            // $("#grpRecordBtn").click(function () {
            //     $("#msgRecord").hide();
            //     $("#grpRecord").toggle();
            //     $("#shopRecord").hide();
            // });

            // $("#shopRecordBtn").click(function () {
            //     $("#msgRecord").hide();
            //     $("#grpRecord").hide();
            //     $("#shopRecord").toggle();
            // });
            // });
        </script>



        

        <!-- 電腦版 記錄區 -->
        <div class="recordArea_web">
            <ul class="recordAreaUl_web">
                <li id="msgLi" class="yellow">留言記錄</li>
                <li id="grpLi" class="white">揪團記錄</li>
                <li id="shopLi" class="white">購物記錄</li>
            </ul>

        <!-- 留言記錄 抓MySQL內容 -->
        <?php
            $errMsg = "";
            try {
            	require_once("connectDB.php");
            
            	$sql = "select * from board_comment where cmt_cnt=:cmt_cnt";
                $msgRecords = $pdo->prepare($sql); 
                $msgRecords->bindValue(":cmt_cnt","小魷你家好漂亮!!"); //???
                // $msgRecords->bindValue(":mem_pwd","111");
                $msgRecords->execute();
                // $found = false;
            
            } catch (PDOException $e) {
            	echo "錯誤 : ", $e -> getMessage(), "<br>";
            	echo "行號 : ", $e -> getLine(), "<br>";
            }
        
        ?>

        <?php
            if($msgRecords->rowCount() != 0){
                $msgRecord = $msgRecords->fetch();
                $found = true;
                // echo "<pre>";
                // print_r($member); 
                // echo "</pre>";
            
        ?>

            <div id="msgRecord_web"class="msgRecord_web">

                <!-- 留言記錄 電腦版 -->

                <!-- 會員記錄的資訊內容 -->
                <div id="msgBlock_web" class="msgRecordWrapforrecord">
                    <div class="msgRecordWrap">
                        <div class="msgRecordWrapforflex">
                            <div class="msgRecordImg">
                                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                            </div>
                            <div class="msgRecordRightWrap">
                                <div class="msgRecordText">
                                        <p><?php echo $msgRecord["cmt_cnt"]; ?> <!--魷魚好辣跟她的家都超辣的，希望我或我
                                        的家也能有她一半那麼辣就好了，希望她
                                        能加我好友。留言記錄--></p>
                                </div>

                                <div class="msgRecordEditBtn_web">
                                    <!-- <input type="submit" id="msgEdit_web" class="btnEdit_web" value="編輯"> -->
                                    <input type="submit" id="msgDelete_web" class="btnDelete_web" value="刪除">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- 示意&測試用區塊,不需要了 -->
                <!-- <div class="msgRecordWrapforrecord">
                    <div class="msgRecordWrap">

                    </div>
                </div>
                <div class="msgRecordWrapforrecord">
                    <div class="msgRecordWrap">

                    </div>
                </div>
                <div class="msgRecordWrapforrecord">
                    <div class="msgRecordWrap">

                    </div>
                </div> -->

        <?php 
             }else{
                echo "no";
             }
        ?>



                <!-- form表單,input輸入 -->
                <div id="msgInput_web" class="msgRecordWrapforinput">
                    <div class="msgRecordWrap">
                        <div class="msgRecordWrapforflex">
                            <div class="msgRecordImg">
                                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                            </div>
                            <div class="msgRecordRightWrap">
                                <div class="msgRecordText">
                                    <input type="text">
                                </div>

                                <div class="msgRecordEditBtn_web">
                                    <input type="submit" id="msgConfirm_web" class="btnConfirm_web" value="確認">
                                    <input type="submit" id="msgCanncel_web" class="btnCancel_web" value="取消">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- 揪團記錄 抓MySQL內容 -->
        <?php
            $errMsg = "";
            try {
            	require_once("connectDB.php");
            
            	$sql = "select * from event where evt_name=:evt_name";
                $grpRecords = $pdo->prepare($sql); 
                $grpRecords->bindValue(":evt_name","太魯閣一日遊"); //???
                // $grpRecords->bindValue(":mem_pwd","111");
                $grpRecords->execute();
                // $found = false;
            
            } catch (PDOException $e) {
            	echo "錯誤 : ", $e -> getMessage(), "<br>";
            	echo "行號 : ", $e -> getLine(), "<br>";
            }
        
        ?>

        <?php
            if($grpRecords->rowCount() != 0){
                $grpRecord = $grpRecords->fetch();
                $found = true;
                // echo "<pre>";
                // print_r($member); 
                // echo "</pre>";
            
        ?>

                <!-- 揪團記錄 電腦版 -->
            <div id="grpRecord_web" class="grpRecord_web">
                <div id="msgBlock_web" class="msgRecordWrapforrecord">
                    <div class="msgRecordWrap">
                        <div class="msgRecordWrapforflex">
                            <div class="msgRecordImg">
                                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                            </div>
                            <div class="msgRecordRightWrap">
                                <div class="msgRecordText">
                                        <p><?php echo $grpRecord["evt_name"]; ?><!--魷魚好辣跟她的家都超辣的，希望我或我
                                        的家也能有她一半那麼辣就好了，希望她
                                        能加我好友。揪團紀錄--></p>
                                </div>

                                <div class="msgRecordEditBtn_web">
                                    <!-- <input type="submit" id="msgEdit_web" class="btnEdit_web" value="編輯"> -->
                                    <input type="submit" id="msgDelete_web" class="btnDelete_web" value="刪除">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        <?php 
             }else{
                echo "no";
             }
        ?>
                


                <!-- form表單,input輸入 -->
                <div id="msgInput_web" class="msgRecordWrapforinput">
                    <div class="msgRecordWrap">
                        <div class="msgRecordWrapforflex">
                            <div class="msgRecordImg">
                                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                            </div>
                            <div class="msgRecordRightWrap">
                                <div class="msgRecordText">
                                    <input type="text">
                                </div>

                                <div class="msgRecordEditBtn_web">
                                    <input type="submit" id="msgConfirm_web" class="btnConfirm_web" value="確認">
                                    <input type="submit" id="msgCanncel_web" class="btnCancel_web" value="取消">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <!-- 購物記錄 電腦版 -->
            <div id="shopRecord_web" class="shopRecord_web">
                <div id="msgBlock_web" class="msgRecordWrapforrecord">
                    <div class="msgRecordWrap">
                        <div class="msgRecordWrapforflex">
                            <div class="msgRecordImg">
                                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                            </div>
                            <div class="msgRecordRightWrap">
                                <div class="msgRecordText">
                                        <p>魷魚好辣跟她的家都超辣的，希望我或我
                                        的家也能有她一半那麼辣就好了，希望她
                                        能加我好友。購物紀錄</p>
                                </div>

                                <div class="msgRecordEditBtn_web">
                                    <!-- <input type="submit" id="msgEdit_web" class="btnEdit_web" value="編輯"> -->
                                    <input type="submit" id="msgDelete_web" class="btnDelete_web" value="刪除">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                


                <!-- form表單,input輸入 -->
                <div id="msgInput_web" class="msgRecordWrapforinput">
                    <div class="msgRecordWrap">
                        <div class="msgRecordWrapforflex">
                            <div class="msgRecordImg">
                                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                            </div>
                            <div class="msgRecordRightWrap">
                                <div class="msgRecordText">
                                    <input type="text">
                                </div>

                                <div class="msgRecordEditBtn_web">
                                    <input type="submit" id="msgConfirm_web" class="btnConfirm_web" value="確認">
                                    <input type="submit" id="msgCanncel_web" class="btnCancel_web" value="取消">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <!-- 原版_錯的 -->
                <!-- <div class="msgRecordWrapFor2_web"> -->
                    <!-- <div class="msgRecordBox_web"> -->
                        <!-- <div class="msgRecordImg_web"> -->
                            <!-- <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90"> -->
                        <!-- </div> -->
                        <!-- <div class="msgRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。</p>
                            <br>

                        </div> -->
                        <!-- <div class="msgRecordEditBtn_web"> -->
                            <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                        <!-- </div> -->

                    <!-- </div> -->
                    <!--  -->
                    <!-- <div class="msgRecordBox_web"> -->
                        <!-- <div class="msgRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="msgRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。</p>
                            <br>

                        </div> -->

                    <!-- 按鈕按鈕 -->
                        <!-- <div class="msgRecordEditBtn_web"> -->
                            <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                        <!-- </div> -->

                    <!-- </div> -->
                <!-- </div> -->


                <!-- <div class="msgRecordWrapFor2_web"> -->
                    <!-- <div class="msgRecordBox_web"> -->
                        <!-- <div class="msgRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="msgRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。</p>
                            <br>

                        </div> -->
                        <!-- <div class="msgRecordEditBtn_web"> -->
                            <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                        <!-- </div> -->

                    <!-- </div> -->
                    <!--  -->
                    <!-- <div class="msgRecordBox_web"> -->
                        <!-- <div class="msgRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="msgRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。</p>
                            <br>

                        </div> -->
                        <!-- <div class="msgRecordEditBtn_web"> -->
                            <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                        <!-- </div> -->

                    <!-- </div> -->
                <!-- </div> -->

            </div>

        <!-- 原版_錯的 -->
            <!-- 揪團記錄 電腦版 -->
            <!-- <ul class="recordAreaUl_web">
                    <li id="msgLi" class="yellow">留言記錄</li>
                    <li id="grpLi" class="white">揪團記錄</li>
                    <li id="shopLi" class="white">購物記錄</li>
                </ul> -->

             <!--<div id="grpRecord_web" class="grpRecord_web">

                <div class="grpRecordWrapFor2_web">
                    <div class="grpRecordBox_web">
                        <div class="grpRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="grpRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。參加揪團。</p>
                            <br>

                        </div>
                        <div class="grpRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div> -->
                    <!--  -->
                    <!-- <div class="grpRecordBox_web">
                        <div class="grpRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="grpRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。參加揪團。</p>
                            <br>

                        </div>
                        <div class="grpRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div>
                </div> -->


                <!-- <div class="grpRecordWrapFor2_web">
                    <div class="grpRecordBox_web">
                        <div class="grpRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="grpRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。參加揪團。</p>
                            <br>

                        </div>
                        <div class="grpRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div> -->
                    <!--  -->
                    <!-- <div class="grpRecordBox_web">
                        <div class="grpRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="grpRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。參加揪團。</p>
                            <br>

                        </div>
                        <div class="grpRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div>
                </div>
            </div> -->

        <!-- 原版_錯的 -->
            <!-- 購物記錄 電腦版 -->
            <!-- <ul class="recordAreaUl_web">
                    <li id="msgLi" class="yellow">留言記錄</li>
                    <li id="grpLi" class="white">揪團記錄</li>
                    <li id="shopLi" class="white">購物記錄</li>
                </ul> -->

            <!-- <div id="shopRecord_web" class="shopRecord_web">
                

                <div class="shopRecordWrapFor2_web">
                    <div class="shopRecordBox_web">
                        <div class="shopRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="shopRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。購物購物記錄。</p>
                            <br>

                        </div>
                        <div class="shopRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div> -->
                    <!--  -->
                    <!-- <div class="shopRecordBox_web">
                        <div class="shopRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="shopRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。購物購物記錄。</p>
                            <br>

                        </div>
                        <div class="shopRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div>
                </div>


                <div class="shopRecordWrapFor2_web">
                    <div class="shopRecordBox_web">
                        <div class="shopRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="shopRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。購物購物記錄。</p>
                            <br>

                        </div>
                        <div class="shopRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div> -->
                    <!--  -->
                    <!-- <div class="shopRecordBox_web">
                        <div class="shopRecordImg_web">
                            <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
                        </div>
                        <div class="shopRecordText_web">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。購物購物記錄。</p>
                            <br>

                        </div>
                        <div class="shopRecordEditBtn_web">
                            <input type="submit" class="btnEdit_web" value="編輯"> -->
                            <!-- <button></button> -->
                            <!-- <input type="submit" class="btnDelete_web" value="刪除">
                        </div>

                    </div>
                </div>
            </div> -->


        </div>
    </div>

    <!-- 電腦版 -->
    <!-- <div class="memArea">
            <div class="memPhoto"></div>
            <div class="memFile"></div>
        </div>

        <div class="recordArea">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <div class="recordMsg"></div>
            <div class="recordGroup"></div> <!-點選變換-->
    <!--<div class="recordShop"></div>-->
    <!--點選變換
        </div>
    </div 多的> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
    <script src="js/memberCenter.js"></script>
</body>

</html>