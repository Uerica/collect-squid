<?php
  // phpinfo();
  // exit();
    ob_start();
    session_start();
    if(!isset($_SESSION["mem_name"])||($_SESSION["mem_name"] == "")){
        //沒登入 導到首頁
        header("Location: /index.php");
        die();
    } else {
        //有登入存阿
        $mem_no = $_SESSION["mem_no"];
        $mem_name = $_SESSION["mem_name"];
        $style_no = $_SESSION["style_no"];
        $mem_lv = $_SESSION["mem_lv"];
        $mem_avatar = $_SESSION["mem_avatar"];
        $squid_qty = $_SESSION["squid_qty"];
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="sass/style.css" />
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <title>find</title>
</head>
<body>
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
                                    <span>{{squid_qty}}</span>
                                </a>
                            </li>
                            <li class="logo">
                                <a href="index.php">
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
                            <li><a href="myRoom.php"> <img src="imgs/homePage/icon/room.png" alt="我的房間icon">
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
                        <a href="myRoom.php">
                            <img src="imgs/homePage/icon/room.png" alt="我的房間icon">
                            <span>我的房間</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow">
                        <a href="dressingRoom.php">
                            <img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                            <span>換衣間</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow">
                        <a href="findfriend.php">
                            <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                            <span>找朋友</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow">
                        <a href="events.php">
                            <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                            <span>揪團活動</span>
                        </a>
                    </li>
                    <li class="logo hvr-pulse-grow">
                        <a href="index.php">
                            <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                            <span>尋找友誼</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow">
                        <a href="shop.php">
                            <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                            <span>虛擬商城</span>
                        </a>
                    </li>
                    <li class="hvr-pulse-grow">
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
                                <span>{{squid_qty}}</span>
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

    <div class="findFriend">
        <embed class="findFriend_embed" src="img/find_bg.svg" type="">
        <!-- 篩選燈箱 -->
        <div class="fromBox_wrap">
            <!-- 燈箱黃色背景 -->
            <div class="fromBox_bg">
                <!-- 燈箱白色背景 -->
                <div class="fromBox">
                    <!-- 篩選區 標題+篩選欄 -->
                    <div class="fromSelect">
                        <h1>搜尋好友</h1>
                        <form action="">
                            
                            <div>
                                <!-- 選擇性別 -->
                                <select id="gender" name="gender">
                                    <option selected disabled>選擇性別</option>
                                    <option value="M">男</option>
                                    <option value="F">女</option>
                                    <option value="allgender">性別全選</option>
                                </select>
                            </div>

                            <div>
                                <!-- 選擇星座 -->
                                <select id="sign" name="sign">
                                    <option selected disabled>選擇星座</option>
                                    <option value="牡羊座">牡羊座</option>
                                    <option value="金牛座">金牛座</option>
                                    <option value="雙子座">雙子座</option>
                                    <option value="巨蟹座">巨蟹座</option>
                                    <option value="獅子座">獅子座</option>
                                    <option value="處女座">處女座</option>
                                    <option value="天秤座">天秤座</option>
                                    <option value="天蠍座">天蠍座</option>
                                    <option value="射手座">射手座</option>
                                    <option value="摩羯座">摩羯座</option>
                                    <option value="水瓶座">水瓶座</option>
                                    <option value="扣扣看">扣扣看</option>
                                    <option value="allsign">星座全選</option>
                                </select>
                            </div>

                            <div>
                                <!-- 選擇興趣 -->
                                <select id="interest" name="interest">
                                    <option selected disabled>選擇興趣</option>
                                    <option value="1">我愛php</option>
                                    <option value="2">套套看</option>
                                    <option value="3">找相機</option>
                                    <option value="4">設計頭型</option>
                                    <option value="5">打魚翔拳</option>
                                    <option value="6">摳摳看"</option>
                                    <option value="7">修冷氣</option>
                                    <option value="8">寫書法</option>
                                    <option value="9">逛夜市</option>
                                    <option value="10">吃美食</option>
                                    <option value="11">運動</option>
                                    <option value="12">踏踏青</option>
                                    <option value="13">看看海</option>
                                    <option value="allinterest">興趣全選</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- 按鈕在這 -->
                <div class="selectBtn">
                    <input onclick="startSearch()" type="button" value="開始搜尋" />
                </div>
            </div>
        </div>

        <div class="showFriend_wrap">
            <!-- 朋友角色與輪盤 -->
            <div class="showFriend_interact">
                <!-- 找朋友檔案 -->
                <div class="profileBox_bg">
                    <div class="profileBox">
                        <div class="profile">
                            <p>ID:<span id="userid"></span></p>
                            <p>暱稱:<span id="nickname"></span></p>
                            <p>性別:<span id="gender"></span></p>
                            <p>星座:<span id="constellation"></span></p>
                            <p>興趣:<span id="habit"></span></p>
                        </div> 
                    </div>
                    <!-- 按鈕底加 -->
                    <div class="btns">
                        <input type="submit" value="拜訪房間" id="visitRoom" />
                        <input type="submit" value="加好友" id="addFriend" />
                    </div>
                </div>
                <!-- 阿魷底加 -->
                <div class="Role">
                    <div class="role_container">
                        <img class="role_img" src="" alt="role" >
                    </div>
                </div>
                <!-- 輪盤區 -->
                <div class="prizeWheel">
                    <img class="pw_prev" src="img/prev.png" alt="上一步">            
                    <img class="pw_body" src="img/pwBody.png" alt="我是輪盤">
                    <img class="pw_next" src="img/next.png" alt="上一步">
                </div>
            </div>
        </div>

        
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js'></script>
    <script src="js/chat.js"></script>
    <script src="js/addFriend.js"></script>
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
       

        function startSearch() {
            var gender = $("#gender").val();
            var sign = $("#sign").val();
            var interest = $("#interest").val();
            if(gender == null) {
                gender = "allgender";
            }
            if(sign == null) {
                sign = "allsign";
            }
            if(interest == null) {
                interest = "allinterest";
            }
            const xhr = new XMLHttpRequest();
            xhr.onload = () => {
                if (xhr.status == 200) {
                    var resp = JSON.parse(xhr.responseText);
                    console.debug("findFriend", resp);
                    profiles = resp;
                    change_profile();
                    $(".fromBox_wrap").css("display","none");
                    $(".showFriend_wrap").css("display","block");
                } else {
                console.error("startSearch failed.", xhr);
                }
            };
            const url = `findFriendApi.php?mem_no=${mem_no}&mem_gender=${gender}&mem_sign=${sign}&interest_no=${interest}`;
            xhr.open("get", url, true);
            xhr.send(null);
        }

        var degree = 0;
        var profile_index = 0;
        var profiles = [];

        $(".prizeWheel .pw_prev").click(function (e) {
            degree = degree - 45;
            spin(degree);
            profile_index = profile_index - 1;
            if (profile_index < 0) {
                profile_index = profiles.length - 1;
            }
            change_profile();
        });

        $(".prizeWheel .pw_next").click(function (e) {
            degree = degree + 45;
            spin(degree);
            profile_index = profile_index + 1;
            if (profile_index >= profiles.length) {
                profile_index = 0;
            }
            change_profile();
        });

        $("#addFriend").click(function (e){
            var profile = profiles[profile_index];
            if(confirm('是否確認加'+profile.mem_name+'好友?')){
                //call addFriend.js
                addFriend(mem_name, profile.mem_name);
            }
        });

        function spin(degree) {
            $(".prizeWheel .pw_body").animate(
                {
                    degrees: degree
                },
                {
                    step: function (now, fx) {
                        $(this).css({
                            "-webkit-transform": "rotate(" + now + "deg)",
                            "-moz-transform": "rotate(" + now + "deg)",
                            transform: "rotate(" + now + "deg)"
                        });
                    }
                }
            );
        }

        function change_profile() {
            var profile = profiles[profile_index];
            var profile_elem = $(".profileBox .profile")[0];
            profile_elem.querySelector("#userid").innerHTML = profile.mem_no;
            profile_elem.querySelector("#nickname").innerHTML = profile.mem_name;
            // profile_elem.querySelector("#gender").innerHTML = profile.mem_gender;
            if(profile.mem_gender=="F"){
                profile_elem.querySelector("#gender").innerHTML = '女';
            }else{
                profile_elem.querySelector("#gender").innerHTML = '男';
            }
            profile_elem.querySelector("#constellation").innerHTML = profile.mem_sign;
            profile_elem.querySelector("#habit").innerHTML = profile.interest_names;
            $(".role_img").attr('src', profile.style_no);
            $(".Role .cls-3").css("fill", profile.avatar_color);
        }
    </script>
</body>
</html>