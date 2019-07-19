<?php
    $errMsg = '';
    try {
        require_once('connectSquid.php');
        // echo "連線成功";
    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minmum-scale=0, maximum-scale=10 initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="css/reset.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'/>
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="sass/style.css">
    <title>收集友誼</title>
</head>

<body>
    <div class="loginSquid">
        <div class="onlineFuns">
            <a class="funIcon goRoom" href="javascript:;" class="onlineFunction"><img src="imgs/characters/goRoomIcon.png" alt="看房間"></a >
            <a class="funIcon addFriend" href="javascript:;" class="onlineFunction"><img src="imgs/characters/addFriendIcon.png" alt="加好友"></a >
            <a class="funIcon mute" href="javascript:;" class="onlineFunction"><img src="imgs/characters/muteIcon.png" alt="靜音"></a >
        </div>
        <div class="talkingBubble">
            <p>哈囉哈囉</p>
        </div>
      <img src="imgs/createBox/myRole23.png" alt="Penny">
    </div>

    <div class="common_cursor"></div>

    <!-- <div class="gameWorld_tutorial">
        <div class="tutorial_cover">
            <div class="tutorial_house">
                <div class="cover cover-house">
                    <img src="imgs/homePage/coverHouse.png" alt="">
                </div>
                <div class="desc desc-house"></div>
            </div>
        </div>
    </div> -->

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
                            <a href="index.php">
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
                    <a href="dressingRoom.php">
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
                    <a href="events.html">
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

    <!-- 通知 -->
    <div class="common_notifications disabledScrollOnHover">
        <div class="notifications_actionBox">
            <button class="button button-notifications">
                <img src="imgs/homePage/icon/notice.png" alt="通知按鈕圖片">
                <span>通知</span>
            </button>
            <button class="button button-robot">
                <img src="imgs/homePage/icon/robot.png" alt="客服機器人圖片">
                <span>客服魷魚</span>
            </button>
        </div>
        <div class="notifications_container collapse">
            <div class="notifications_content">
                <div class="notifications notifications_friend">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【好友通知】</span>
                    <p>你現在已經和詩詩成為好友了</p>
                </div>
                <div class="notifications notifications_event">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【活動邀請】</span>
                    <p>好友"詩詩"邀請你參加「與VUE一起浮淺」活動</p>
                </div>
                <div class="notifications notifications_room">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【房間留言】</span>
                    <p>會員"詩詩"在您房間留下了一筆新訊息</p>
                </div>
                <div class="notifications notifications_event">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【活動邀請】</span>
                    <p>好友"詩詩"邀請你參加「與VUE一起浮淺」活動</p>
                </div>
                <div class="notifications notifications_room">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【房間留言】</span>
                    <p>會員"詩詩"在您房間留下了一筆新訊息</p>
                </div>
                <div class="notifications notifications_event">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【活動邀請】</span>
                    <p>好友"詩詩"邀請你參加「與VUE一起浮潛」活動</p>
                </div>
                <div class="notifications notifications_room">
                    <i class="fas fa-times notifications_delete"></i>
                    <span>【房間留言】</span>
                    <p>會員"詩詩"在您房間留下了一筆新訊息</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 客服機器人 -->
    <!-- <div class="commom_robot disabledScrollOnHover">
        <div class="chatBotBox">
            <h3>魷魚機器人</h3>

            <div id="chatContainer" class="chatContainer">
                <div id="chat_A" class="chat_A">
                    <p>Hi! 很高興為您服務，您可以點擊下方關鍵或是直接輸入詢問內容!</p>
                </div>
                <div class="clearfix"></div>

                <div id="chat_Q" class="chat_Q">
                    <p>^^</p>
                </div>
                <div class="clearfix"></div>
            </div>


            <ul class="chatBtn">
                <li id="index">首頁</li>
                <li id="myroom">我的房間</li>
                <li id="dressingRoom">換衣間</li>
                <li id="findFrnd">找朋友</li>
                <li id="group">揪團活動</li>
                <li id="shop">虛擬商城</li>
                <li id="memCenter">會員中心</li>
            </ul>


            <div class="chatWords">
                <input type="text" id="chatInput" class="chatInput">
                <button type="submit" id="chatSubmit" class="chatSubmit">送出</button>
                <div class="clearfix"></div>
            </div>

        </div>
    </div> -->

    <!-- 聊天世界 -->
    <div class="gameWorld">
        <div class="gameWorld_bgImage">
            <img src="imgs/homePage/homepage01.png" alt="" draggable="false" oncontextmenu="return false">
        </div>

        <div class="gameWorld">
            <div class="gameWorld_house gameWorld_object">
                <a href="javascript:;"><img src="imgs/homePage/house_tag.png" alt=""></a>
            </div>
            <div class="gameWorld_fountain gameWorld_object">
                <canvas id="spray"></canvas>
                <a href="javascript:;"><img src="imgs/homePage/fountain.png" alt=""></a>
            </div>
            <div id="busBox" class="gameWorld_bus gameWorld_object">
                <div id="smoke"></div>
                <a href="javascript:;"><img src="imgs/homePage/bus.png" alt="" id="bus"></a>
            </div>
            <div class="gameWorld_cup gameWorld_object">
                <a href="javascript:;">
                    <div class="cup">
                        <img src="imgs/homePage/cup01.png" alt="">
                        <img id="cup_squid" src="imgs/homePage/squid.png" alt="">
                        <div id="cup_hand">
                            <img src="imgs/homePage/hand.png" alt="">
                            <img id="rag" src="imgs/homePage/rag.png" alt="">
                        </div>
                        <img src="imgs/homePage/cup02.png" alt="">
                    </div>
                    <div class="g_apple">
                        <img src="imgs/homePage/cup.png" alt="">
                    </div>
                </a>
            </div>
        </div>

        <div class="gameWorld_arrow">
            <div class="arrow arrow-right">
                <img src="imgs/homePage/arrow-right.png" alt="">
            </div>
            <div class="arrow arrow-left">
                <img src="imgs/homePage/arrow-left.png" alt="">
            </div>
            <div class="arrow arrow-top">
                <img src="imgs/homePage/arrow-top.png" alt="">
            </div>
            <div class="arrow arrow-bottom">
                <img src="imgs/homePage/arrow-bottom.png" alt="">
            </div>
        </div>

        <div class="gameWorld_switchPage">
            <div class="checkBox checkBox-room collapse">
                <div class="checkBox_content">
                    <div class="checkBox_title">
                        <h3>前往我的房間</h3>
                    </div>
                    <div class="checkBox_hint">
                        <p>要前往我的房間嗎?</p>
                    </div>
                    <div class="checkBox_btn">
                        <button class="button button-cancel" id="btnCancel-room">取消</button>
                        <a href="myRoom.html" class="button button-check">確認</a>
                    </div>
                </div>
            </div>

            <div class="checkBox checkBox-event collapse">
                <div class="checkBox_content">
                    <div class="checkBox_title">
                        <h3>前往揪團活動</h3>
                    </div>
                    <div class="checkBox_hint">
                        <p>要前往揪團活動專區嗎?</p>
                    </div>
                    <div class="checkBox_btn">
                        <button class="button button-cancel" id="btnCancel-event">取消</button>
                        <a href="event.html" class="button button-check">確認</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="gameWorld_leaderBoard"></div>
    </div>

    <!-- 聊天群組(1.聊天室 2.好友列表) -->
    <!-- Rou:vue.js #chat_app -->
    <div class="chatGroup disabledScrollOnHover collapse" id="chat_app">
        <i class="fas fa-window-minimize closeBtn"></i>
        <!-- 聊天室 -->
        <!-- 聊天室分成三種訊息 1.官方(messageOfficial) 2.發訊息的人(messageSent) 3.收訊息的人(messageReceived) -->
        <div class="chatRoom">
            <div class="chatRoom_content">
                <!-- Rou:公頻區塊在這裏,如果傳訊息給所有人,並且將訊息印出來 -->
                <ul class="chatRoom_main" v-if="chat_to_all">
                    <!-- 發訊息給... -->
                    <div class="chatRoom_sendTo">
                        <p>公頻</p>
                    </div>
                    <!-- 官方訊息 -->
                    <li class="chatRoom_messageOfficial">
                        <div class="text">
                            <p>在你離線時共有 2 人 造訪你的房間</p>
                        </div>
                    </li>
                    <template v-for="message in messages_to_all()">
                        <!-- 發送訊息者 -->
                        <!-- Rou:檢查收到訊息的userid是不是自己來判斷訊息區塊的樣子,以下userid是自己 -->
                        <!-- Rou:在公頻聊天只有大頭貼沒辦法看到名字,在內容中寫入{{ message.user_id }}可以產生正在講話的人的名字 -->
                        <li class="chatRoom_messageSent" v-if="message.user_id == user_id">
                            <div class="message-sent">
                                <div class="text">
                                    <p>{{ message.chat_msg }}</p>
                                </div>
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/member0.png" alt="大頭貼">{{ message.user_id }}
                                </div>
                            </div>
                        </li>
                        <!-- 接收訊息者 -->
                        <!-- Rou:檢查收到訊息的userid是不是自己來判斷訊息區塊的樣子,以下userid不是自己 -->
                        <!-- Rou:在公頻聊天只有大頭貼沒辦法看到名字,在內容中寫入{{ message.user_id }}可以產生正在講話的人的名字 -->
                        <li class="chatRoom_messageReceived" v-if="message.user_id != user_id">
                            <div class="message-received">
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/member0.png" alt="大頭貼">{{ message.user_id }}
                                </div>
                                <div class="text">
                                    <p>{{ message.chat_msg }}</p>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>

                <!-- Rou:密語區塊在這裏,檢查不是公頻訊息,並且傳入誰傳訊息給我,再印出-->
                <ul class="chatRoom_main" v-if="!chat_to_all">
                    <!-- 發訊息給... -->
                    <div class="chatRoom_sendTo">
                        <p>TO: {{chat_to_who}}</p>
                    </div>
                    <template v-for="message in messages_to_someone(chat_to_who)">
                        <!-- 發送訊息者 -->
                        <!-- Rou:如果發訊息的人是我 -->
                        <li class="chatRoom_messageSent" v-if="message.user_id == user_id">
                            <div class="message-sent">
                                <div class="text">
                                    <p>{{ message.chat_msg }}</p>
                                </div>
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/member0.png" alt="">
                                </div>
                            </div>
                        </li>
                        <!-- 接收訊息者 -->
                        <!-- Rou:如果發訊息的人不是我本人 -->
                        <li class="chatRoom_messageReceived" v-if="message.user_id != user_id">
                            <div class="message-received">
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/member0.png" alt="大頭貼">
                                </div>
                                <div class="text">
                                    <p>{{ message.chat_msg }}</p>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>

                <!-- 訊息輸入區 -->
                <div class="chatRoom_submitMessage">
                    <form action="" class="submitContext form">
                        <!-- Rou:在此用v-model產生動態變數 以及增加事件-->
                        <input type="text" class="messageInput" v-model="chat_send_text">
                        <input type="button" value="傳送" class="submit button-submit" v-on:click="chat_send()">
                    </form>
                </div>

                <!-- 選擇頻道 -->
                <!-- Rou:動作後產生class -->

                <div class="chatRoom_switchChannel button_group">
                    <button class="button button-private" v-bind:class="{ active: !chat_to_all }">私訊</button>
                    <button class="button button-public" v-bind:class="{ active: chat_to_all }"
                        v-on:click="public_chat()">公開</button>
                </div>
            </div>
        </div>

        <div class="friendList">
            <div class="friendList_content">
                <ul class="friendList_main">
                    <!-- 上線的好友 -->
                    <li class="friendList_onlineFriend">
                        <!-- 好友類型(online, offline, requested) -->
                        <button
                            class="friendList_friendStatus button">在線好友({{online_friends().length}}/{{friends.length}})</button>

                        <!-- 好友01 每個 friendList_friend 是一位好友-->
                        <!-- Rou:將有上線的好友跑一遍,如果有抓到產生此區塊 -->
                        <div class="friendList_friend" v-for="friend in online_friends()">
                            <!-- 好友大頭貼、暱稱 -->
                            <div class="friendInfo">
                                <div class="avatar">
                                    <img src="imgs/homePage/tree_04.png" alt="大頭貼">
                                </div>
                                <!-- 點擊user名字可以產生聊天視窗 -->
                                <div class="friendName" v-on:click="private_chat(friend)">
                                    <p>{{ friend }}</p>
                                </div>
                            </div>

                            ({{ unread_messages_from_someone(friend).length }})

                            <!-- 好友連線狀態、去他房間、更多 -->
                            <div class="friendAction">
                                <div class="connectStatus">
                                    <div class="dot dot-online"></div>
                                </div>

                                <div class="roomVisit">
                                    <a href="javascript:;"><img src="imgs/homePage/icon/home.png" alt="房間ICON"></a>
                                </div>

                                <div class="moreAction">
                                    <a href="javavscript:;">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- 離線的好友 -->
                    <li class="friendList_offlineFriend">
                        <button
                            class="friendList_friendStatus button">離線好友({{offline_friends().length}}/{{friends.length}})</button>

                        <!-- Rou:將離線好友跑一遍,如果有抓到產生此區塊 -->
                        <div class="friendList_friend" v-for="friend in offline_friends()">
                            <div class="friendInfo">
                                <div class="avatar">
                                    <img src="imgs/homePage/tree_04.png" alt="大頭貼">
                                </div>
                                <div class="friendName">
                                    <p>{{ friend }}</p>
                                </div>
                            </div>

                            <div class="friendAction">
                                <div class="connectStatus">
                                    <div class="dot dot-offline"></div>
                                </div>

                                <div class="roomVisit">
                                    <a href="javascript:;"><img src="imgs/homePage/icon/home.png" alt="房間ICON"></a>
                                </div>

                                <div class="moreAction">
                                    <a href="javavscript:;">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="friendList_friend">
                            <div class="friendInfo">
                                <div class="avatar">
                                    <img src="imgs/homePage/tree_04.png" alt="大頭貼">
                                </div>
                                <div class="friendName">
                                    <p>佩佩</p>
                                </div>
                            </div>

                            <div class="friendAction">
                                <!-- 上線 / 下線狀態 點 -->
                                <div class="connectStatus">
                                    <div class="dot dot-offline"></div>
                                </div>

                                <div class="roomVisit">
                                    <a href="javascript:;"><img src="imgs/homePage/icon/home.png" alt="房間ICON"></a>
                                </div>

                                <div class="moreAction">
                                    <a href="javavscript:;">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- 好友邀請中 -->
                    <li class="friendList_requestedFriend">
                        <button class="friendList_friendStatus button">好友邀請中</button>
                        <div class="friendList_friend">
                            <div class="friendInfo">
                                <div class="avatar">
                                    <img src="imgs/homePage/tree_04.png" alt="大頭貼">
                                </div>
                                <div class="friendName">
                                    <p>毛筆</p>
                                </div>
                            </div>

                            <div class="friendAction">
                                <!-- 接受好友申請 -->
                                <div class="requestAccept">
                                    <a href="javascript:;"><img src="imgs/homePage/icon/accept.png" alt="接受ICON"></a>
                                </div>
                                <!-- 拒絕好友申請 -->
                                <div class="requestRefuse">
                                    <a href="javascript:;"><img src="imgs/homePage/icon/refuse.png" alt="拒絕ICON"></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="friendList_open disabledScrollOnHover">
        <button class="button friendList_openBtn">開啟聊天室</button>
    </div>

    <!-- 登入 -->
    <div class="loginBox">
      <div class="loginContent">
        <div class="intro">
          <div class="logo">
            <img src="imgs/loginBox/logo.png" alt="Logo" />
            <h2>收集友誼</h2>
          </div>
          <div class="drawing">
            <img src="imgs/loginBox/logingBg.png" alt="Login Background" />
          </div>
          <div class="slogan">
            <p>線上魷魚，即時友誼</p>
          </div>
        </div>
        <div class="loginForm">
          <h3>會員登入</h3>
          <form action="">
            <div class="personalInfo">
              <div class="inputField">
                <label for="mem_name">暱稱</label>
                <input type="text" name="mem_name" id="login_mem_name" />
              </div>
              <div class="inputField">
                <label for="mem_pwd">密碼</label>
                <input type="password" name="mem_pwd" id="login_mem_pwd" />
              </div>
              <a href="javascript:;">忘記密碼？</a>
            </div>
            <div class="submitBtns">
              <input class="createRole" type="button" value="創角" />
              <input id="loginBtn" type="button" value="登入"/>
              <input id="godMode" type="submit" value="上帝模式" />
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- 創角 -->
    <div class="createBox">
      <div class="createContent">
        <div class="createFrame">
          <form action="">
            <div class="inputField">
              <label for="create_mem_gender">性別</label>
              <select name="mem_gender" id="create_mem_gender">
                <option value="M">男</option>
                <option value="L">女</option>
              </select>
              <!-- <input type="text" name="mem_gender" id="create_mem_gender" /> -->
            </div>
            <div class="inputField">
              <label for="create_mem_dob">生日</label
              ><input type="date" name="mem_dob" id="create_mem_dob" />
            </div>
            <div class="inputField">
              <label for="create_mem_name">姓名</label
              ><input type="text" name="mem_name" id="create_mem_name" placeholder="不得超過10個字"/>
            </div>
            <div class="inputField">
              <label for="create_mem_email">信箱</label
              ><input type="email" name="mem_email" id="create_mem_email" placeholder="需包含@和."/>
            </div>
            <div class="inputField">
              <label for="create_mem_pwd">密碼</label
              ><input type="password" name="mem_pwd" id="create_mem_pwd" placeholder="需包含小寫、大寫和數字"/>
            </div>
            <div class="inputField">
              <label for="mem_pwd_checked">確認密碼</label
              ><input type="password" name="mem_pwd_checked" id="mem_pwd_checked" />
            </div>
          </form>
          <div class="styling">
            <div class="shapes">
              <ul class="styles">
                <li id="headStyle" class="active">
                  <a href="javascript:;">頭型</a>
                </li>
                <li id="skinStyle"><a href="javascript:;">膚色</a></li>
                <li id="faceStyle"><a href="javascript:;">五官</a></li>
              </ul>
              <div class="changeStyle">
                <div class="heads">
                  <ul class="headItems">
                    <li>
                      <img src="imgs/createBox/head1.svg" alt="頭型">
                      <img src="imgs/createBox/head2.svg" alt="頭型">
                    </li>
                    <li>
                        <img src="imgs/createBox/head3.svg" alt="頭型">
                        <img src="imgs/createBox/head4.svg" alt="頭型">
                    </li>
                    <li>
                        <img src="imgs/createBox/head5.svg" alt="頭型">
                        <img src="imgs/createBox/head6.svg" alt="頭型">
                    </li>
                  </ul>
                </div>
                <div class="skinColor">
                  <ul>
                    <li class="colorPicker pickRed">
                      R<input
                        type="range"
                        id="redNum"
                        step="1"
                        min="0"
                        max="255"
                        value="255"
                      />
                    </li>
                    <li class="colorPicker pickGreen">
                      G<input
                        type="range"
                        id="greenNum"
                        step="1"
                        min="0"
                        max="255"
                        value="130"
                      />
                    </li>
                    <li class="colorPicker pickBlue">
                      B<input
                        type="range"
                        id="blueNum"
                        step="1"
                        min="0"
                        max="255"
                        value="130"
                      />
                    </li>
                  </ul>
                </div>
                <div class="facialFeatures">
                  <ul class="faceItems">
                    <li>
                      <img src="imgs/createBox/face1.svg" alt="臉型">
                      <img src="imgs/createBox/face2.svg" alt="臉型">
                    </li>
                    <li>
                      <img src="imgs/createBox/face3.svg" alt="臉型">
                      <img src="imgs/createBox/face4.svg" alt="臉型">
                    </li>
                    <li>
                      <img src="imgs/createBox/face5.svg" alt="臉型">
                      <img src="imgs/createBox/face6.svg" alt="臉型">
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="appearance">
              <div class="squidBorn">
                  <div class="bodyWrapper">
                    <img src="imgs/createBox/emptySquid.svg" alt="魷魚身體">
                  </div>
                  <div class="headWrapper">
                    <img src="imgs/createBox/head1.svg" alt="預設頭型">
                  </div>
                  <div class="faceWrapper">
                    <img src="imgs/createBox/face1.svg" alt="預設臉型">
                  </div>
                  <div class="defaultClo">
                    <img src="imgs/createBox/defaultClo.png" alt="預設衣服">
                  </div>
              </div>
            </div>
          </div>
          <div class="btns">
            <a class="backToLoginBtn" href="javascript:;">回登錄頁</a>
            <a class="createRoleBtn" href="javascript:;">創建角色</a>
          </div>
        </div>
        <div class="mobile_btns">
            <a class="backToLoginBtn" href="javascript:;">回登錄頁</a>
            <a class="createRoleBtn" href="javascript:;">創建角色</a>
          </div>
      </div>
    </div>
    <form id="creatingForm" action="post" accept-charset="utf-8">
      <input type="hidden" id="createdSquid" name="createdSquid">
      <canvas id="roleCanvas"></canvas>
    </form>
    <div class="groupSVGs">
      <svg id="emptySquid" xmlns="http://www.w3.org/2000/svg" width="286" height="398.125" viewBox="0 0 286 398.125">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
            }
          </style>
        </defs>
        <rect id="矩形_2_拷貝_26" data-name="矩形 2 拷貝 26" class="cls-1 squidBody" x="45.078" width="195.844" height="322.75" rx="20" ry="20"/>
        <rect id="矩形_3_拷貝_27" data-name="矩形 3 拷貝 27" class="cls-1 squidBody" x="79.766" y="247.437" width="26.844" height="150.688" rx="5.423" ry="5.423"/>
        <rect id="矩形_3_拷貝_27-2" data-name="矩形 3 拷貝 27" class="cls-1 squidBody" x="129.922" y="247.437" width="26.781" height="150.688" rx="5.423" ry="5.423"/>
        <rect id="矩形_3_拷貝_27-3" data-name="矩形 3 拷貝 27" class="cls-1 squidBody" x="180.047" y="247.437" width="26.812" height="150.688" rx="5.423" ry="5.423"/>
      </svg>
      <svg id="head1" xmlns="http://www.w3.org/2000/svg" width="285.969" height="231" viewBox="0 0 285.969 231">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <path class="head1_p" data-name="多邊形 1 拷貝 26" class="cls-1" d="M250.231,94.172q107.24,136.382-107.24,136.379T35.752,94.172Q142.992-42.206,250.231,94.172Z" transform="translate(0 -12.781)"/>
      </svg>
      <svg id="head2" xmlns="http://www.w3.org/2000/svg" width="286" height="231" viewBox="0 0 286 231">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <path id="多邊形_1_拷貝_30" data-name="多邊形 1 拷貝 30" class="cls-1 head2_p" d="M226.236,78.322q83.246,152.691-83.244,152.69T59.747,78.322Q142.992-74.369,226.236,78.322Z" transform="translate(0 -1)"/>
      </svg>
      <svg id="head3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="287" height="231" viewBox="0 0 287 231">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
              fill-rule: evenodd;
            }
          </style>
          <clipPath id="clip-path">
            <rect x="0.5" y="-82.5" width="286" height="231"/>
          </clipPath>
        </defs>
        <g clip-path="url(#clip-path)">
          <g>
            <path class="head3_p" data-name="多邊形 1 拷貝 29" class="cls-1" d="M251.114,187q107.62,44.019-107.619,44.018T35.875,187Q143.5,142.976,251.114,187Z" transform="translate(0.5 -82.5)"/>
          </g>
        </g>
      </svg>
      <svg id="head4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="286" height="231" viewBox="0 0 286 231">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
              fill-rule: evenodd;
            }
          </style>
          <clipPath id="clip-path">
            <rect x="0.5" y="-10" width="286" height="231"/>
          </clipPath>
        </defs>
        <g clip-path="url(#clip-path)">
          <g>
            <path id="多邊形_1_拷貝_39" data-name="多邊形 1 拷貝 39" class="cls-1 head4_p" d="M203.436,118.692Q264.374,231.018,142.5,231.017T81.56,118.692Q142.5,6.368,203.436,118.692Z" transform="translate(0.5 -10)"/>
            <path id="多邊形_1_拷貝_39-2" data-name="多邊形 1 拷貝 39" class="cls-1 head4_p" d="M49.879,132.331Q-42.748,20,142.505,20.006t92.627,112.325Q142.5,244.656,49.879,132.331Z" transform="translate(0.5 -10)"/>
          </g>
        </g>
      </svg>
      <svg id="head5" xmlns="http://www.w3.org/2000/svg" width="286" height="231" viewBox="0 0 286 231">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <path id="多邊形_1_拷貝_31" data-name="多邊形 1 拷貝 31" class="cls-1 head5_p" d="M202.2,104.055c10.941,20.344,19.5,7.587,42.57,34.916C285.534,187.255,226.606,231,143.292,231,60.11,231,2.158,188.232,41.739,139.264c23.055-28.523,31.645-14.741,42.652-35.209,2.989-5.559-11.028-9.252-11.028-35.5,0-88.952,138.218-76.823,138.218-2.67C211.581,72.6,198.664,97.48,202.2,104.055Z" transform="translate(-0.5 -2.984)"/>
      </svg>
      <svg id="head6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="286" height="231" viewBox="0 0 286 231">
        <defs>
          <style>
            .cls-1 {
              fill: #ff8d8d;
              fill-rule: evenodd;
            }
          </style>
          <clipPath id="clip-path">
            <rect sx="0.5" y="-48.75" width="286" height="231"/>
          </clipPath>
        </defs>
        <g clip-path="url(#clip-path)">
          <g>
            <path id="多邊形_1_拷貝_41" data-name="多邊形 1 拷貝 41" class="cls-1 head6_p" d="M254.847,182.874q-20.739,84.755-84.754,20.739t20.739-84.754Q275.587,98.12,254.847,182.874Z" transform="translate(0.5 -48.75)"/>
            <path id="多邊形_1_拷貝_41-2" data-name="多邊形 1 拷貝 41" class="cls-1 head6_p" d="M30.153,182.874q20.739,84.755,84.754,20.739T94.168,118.859Q9.414,98.12,30.153,182.874Z" transform="translate(0.5 -48.75)"/>
            <path id="多邊形_1_拷貝_41-3" data-name="多邊形 1 拷貝 41" class="cls-1 head6_p" d="M204.084,141.926q61.432,88.905-61.431,88.9t-61.431-88.9Q142.653,53.021,204.084,141.926Z" transform="translate(0.5 -48.75)"/>
          </g>
        </g>
      </svg>
      <svg id="face1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="286" height="56.094" viewBox="0 0 286 56.094">
        <defs>
          <style>
            .cls-1, .cls-2 {
              fill: #4b4b4b;
            }

            .cls-2 {
              fill-rule: evenodd;
            }
          </style>
          <clipPath id="clip-path">
            <rect x="0.297" y="0.188" width="286" height="56"/>
          </clipPath>
        </defs>
        <g clip-path="url(#clip-path)">
          <g>
            <ellipse id="橢圓_2_拷貝_24" data-name="橢圓 2 拷貝 24" class="cls-1" cx="100.641" cy="15.969" rx="15.906" ry="16.156"/>
            <circle id="橢圓_2_拷貝_24-2" data-name="橢圓 2 拷貝 24" class="cls-1" cx="185.328" cy="15.969" r="15.938"/>
            <path id="形狀_782_拷貝_5" data-name="形狀 782 拷貝 5" class="cls-2" d="M105.732,48.74V44.551s13.289,6.982,40.055,6.982c25.979,0,34.916-6.982,34.916-6.982V48.74s-8.455,6.982-34.179,6.982C119.522,55.722,105.732,48.74,105.732,48.74Z" transform="translate(0.297 0.188)"/>
          </g>
        </g>
      </svg>
      <svg id="face2" xmlns="http://www.w3.org/2000/svg" width="286" height="56" viewBox="0 0 286 56">
        <defs>
          <style>
            .cls-1, .cls-2 {
              fill: #4b4b4b;
            }

            .cls-1 {
              fill-rule: evenodd;
            }

            .cls-3 {
              fill: #fff;
            }
          </style>
        </defs>
        <path id="橢圓_776_拷貝_2" data-name="橢圓 776 拷貝 2" class="cls-1" d="M106.132,10.2c10.228-.813,18.7.8,18.929,3.6s-7.883,5.733-18.112,6.546-18.7-.8-18.93-3.6S95.9,11.011,106.132,10.2Z" transform="translate(-0.016)"/>
        <path id="矩形_782_拷貝_2" data-name="矩形 782 拷貝 2" class="cls-1" d="M115.319,0.1l9.959,2.413a1.273,1.273,0,1,1-.607,2.473l-9.959-2.413A1.273,1.273,0,1,1,115.319.1Z" transform="translate(-0.016)"/>
        <path id="矩形_782_拷貝_2-2" data-name="矩形 782 拷貝 2" class="cls-1" d="M170.921,0.024L160.706,2.514a1.314,1.314,0,1,0,.623,2.553l10.215-2.491A1.314,1.314,0,1,0,170.921.024Z" transform="translate(-0.016)"/>
        <rect id="矩形_780_拷貝" data-name="矩形 780 拷貝" class="cls-2" x="117.422" y="29.281" width="51.25" height="24.188" rx="9.5" ry="9.5"/>
        <ellipse id="橢圓_781_拷貝" data-name="橢圓 781 拷貝" class="cls-3" cx="143.047" cy="49" rx="21.781" ry="7"/>
        <path id="橢圓_776_拷貝_2-2" data-name="橢圓 776 拷貝 2" class="cls-1" d="M180.219,10.222c10.182,1.271,18.149,4.563,17.8,7.353s-8.893,4.021-19.074,2.75-18.149-4.563-17.8-7.352S170.038,8.951,180.219,10.222Z" transform="translate(-0.016)"/>
        <circle id="橢圓_778_拷貝_2" data-name="橢圓 778 拷貝 2" class="cls-3" cx="100.672" cy="14.469" r="3.844"/>
        <circle id="橢圓_778_拷貝_2-2" data-name="橢圓 778 拷貝 2" class="cls-3" cx="171.453" cy="14.25" r="3.844"/>
      </svg>
      <svg id="face3" xmlns="http://www.w3.org/2000/svg" width="286" height="56" viewBox="0 0 286 56">
        <defs>
          <style>
            .cls-1 {
              fill: #4b4b4b;
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <path id="橢圓_788_拷貝_2" data-name="橢圓 788 拷貝 2" class="cls-1" d="M109.66,0c4.253,0,7.7,6.529,7.7,14.583s-3.447,14.583-7.7,14.583-7.7-6.529-7.7-14.583S105.407,0,109.66,0Z" transform="translate(-7.531)"/>
        <path id="橢圓_788_拷貝_2-2" data-name="橢圓 788 拷貝 2" class="cls-1" d="M186.738,0c4.253,0,7.7,6.529,7.7,14.583s-3.447,14.583-7.7,14.583-7.7-6.529-7.7-14.583S182.485,0,186.738,0Z" transform="translate(-7.531)"/>
        <path id="橢圓_790_拷貝" data-name="橢圓 790 拷貝" class="cls-1" d="M149.747,46.027c11.474,0,16.958,9.973,16.958,9.973H131.248S135.918,46.027,149.747,46.027Z" transform="translate(-7.531)"/>
        <path id="形狀_791_拷貝_4" data-name="形狀 791 拷貝 4" class="cls-1" d="M91.684,36.8l1.131,0.67L86.149,47.581l-1.131-.67Z" transform="translate(-7.531)"/>
        <path id="形狀_791_拷貝_4-2" data-name="形狀 791 拷貝 4" class="cls-1" d="M98.559,36.8l1.131,0.67L93.023,47.581l-1.13-.67Z" transform="translate(-7.531)"/>
        <path id="形狀_791_拷貝_4-3" data-name="形狀 791 拷貝 4" class="cls-1" d="M103.892,36.8l1.131,0.67L98.356,47.581l-1.13-.67Z" transform="translate(-7.531)"/>
        <path id="形狀_791_拷貝_4-4" data-name="形狀 791 拷貝 4" class="cls-1" d="M202.68,36.8l1.13,0.67-6.666,10.108-1.131-.67Z" transform="translate(-7.531)"/>
        <path id="形狀_791_拷貝_4-5" data-name="形狀 791 拷貝 4" class="cls-1" d="M209.554,36.8l1.131,0.67-6.666,10.108-1.131-.67Z" transform="translate(-7.531)"/>
        <path id="形狀_791_拷貝_4-6" data-name="形狀 791 拷貝 4" class="cls-1" d="M214.888,36.8l1.13,0.67-6.666,10.108-1.131-.67Z" transform="translate(-7.531)"/>
      </svg>
      <svg id="face4" xmlns="http://www.w3.org/2000/svg" width="286" height="55.969" viewBox="0 0 286 55.969">
        <defs>
          <style>
            .cls-1, .cls-2 {
              fill: #4b4b4b;
            }

            .cls-2 {
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <circle id="橢圓_799_拷貝_2" data-name="橢圓 799 拷貝 2" class="cls-1" cx="110.844" cy="11.719" r="9.906"/>
        <path id="矩形_800_拷貝_2" data-name="矩形 800 拷貝 2" class="cls-2" d="M75.474,3.346A61.609,61.609,0,0,1,93.789,0,58.98,58.98,0,0,1,111.76,3.346a2.51,2.51,0,0,1,0,5.02,57,57,0,0,0-17.7-3.346A63.709,63.709,0,0,0,75.474,8.366,2.51,2.51,0,0,1,75.474,3.346Z" transform="translate(6.5)"/>
        <circle id="橢圓_799_拷貝_2-2" data-name="橢圓 799 拷貝 2" class="cls-1" cx="196.594" cy="11.719" r="9.906"/>
        <path id="矩形_800_拷貝_2-2" data-name="矩形 800 拷貝 2" class="cls-2" d="M161.24,3.346A61.612,61.612,0,0,1,179.555,0a58.98,58.98,0,0,1,17.971,3.346,2.51,2.51,0,0,1,0,5.02,57,57,0,0,0-17.7-3.346A63.712,63.712,0,0,0,161.24,8.366,2.51,2.51,0,0,1,161.24,3.346Z" transform="translate(6.5)"/>
        <path id="矩形_803_拷貝" data-name="矩形 803 拷貝" class="cls-2" d="M116.325,49.185a95.044,95.044,0,0,0,29.422,1.2c15.077-1.977,31.1-9.139,31.1-9.139a2.509,2.509,0,0,1,.634,4.978s-15.778,7.13-30.728,9.09a98,98,0,0,1-29.795-1.155A2.51,2.51,0,0,1,116.325,49.185Z" transform="translate(6.5)"/>
      </svg>
      <svg id="face5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="286" height="63.031" viewBox="0 0 286 63.031">
        <defs>
          <style>
            .cls-1, .cls-3 {
              fill: #4b4b4b;
            }

            .cls-2 {
              fill: #f3f3f3;
            }

            .cls-3 {
              fill-rule: evenodd;
            }
          </style>
          <clipPath id="clip-path">
            <rect x="-2.594" y="3.516" width="286" height="56"/>
          </clipPath>
        </defs>
        <g clip-path="url(#clip-path)">
          <g>
            <ellipse id="橢圓_806_拷貝_3" data-name="橢圓 806 拷貝 3" class="cls-1" cx="112.25" cy="16.547" rx="13.844" ry="13.938"/>
            <ellipse id="橢圓_806_拷貝_3-2" data-name="橢圓 806 拷貝 3" class="cls-2" cx="112.828" cy="17.141" rx="8.422" ry="8.469"/>
            <ellipse id="橢圓_806_拷貝_3-3" data-name="橢圓 806 拷貝 3" class="cls-1" cx="173.562" cy="16.547" rx="13.844" ry="13.938"/>
            <circle id="橢圓_806_拷貝_3-4" data-name="橢圓 806 拷貝 3" class="cls-2" cx="174.172" cy="17.141" r="8.422"/>
            <path id="矩形_810_拷貝" data-name="矩形 810 拷貝" class="cls-3" d="M158.128,56H132.872a6.636,6.636,0,0,1-6.615-6.658c0-3.677,2.488-3.8,6.615-6.658,0,0,6.214-3.632,12.628-3.632,6.211,0,12.628,3.632,12.628,3.632,3.937,2.475,6.615,2.981,6.615,6.658A6.636,6.636,0,0,1,158.128,56Z" transform="translate(-2.594 3.516)"/>
            <path id="矩形_811_拷貝_2" data-name="矩形 811 拷貝 2" class="cls-3" d="M111.172-4.673a23.581,23.581,0,0,0,7.628.22,49.735,49.735,0,0,0,9.068-2.411A1.806,1.806,0,0,1,129.89-5.3a1.813,1.813,0,0,1-1.555,2.035,47.578,47.578,0,0,1-8.881,2.386,25.107,25.107,0,0,1-7.816-.2,1.806,1.806,0,0,1-2.022-1.566A1.814,1.814,0,0,1,111.172-4.673Z" transform="translate(-2.594 3.516)"/>
            <path id="矩形_811_拷貝_2-2" data-name="矩形 811 拷貝 2" class="cls-3" d="M188.614-4.878a24.517,24.517,0,0,1-7.685.214,51.385,51.385,0,0,1-9.135-2.352,1.81,1.81,0,0,0-2.038,1.528A1.781,1.781,0,0,0,171.324-3.5a49.148,49.148,0,0,0,8.947,2.328,26.1,26.1,0,0,0,7.873-.19,1.809,1.809,0,0,0,2.037-1.528A1.781,1.781,0,0,0,188.614-4.878Z" transform="translate(-2.594 3.516)"/>
          </g>
        </g>
      </svg>
      <svg id="face6" xmlns="http://www.w3.org/2000/svg" width="286" height="56" viewBox="0 0 286 56">
        <defs>
          <style>
            .cls-1 {
              fill: #4b4b4b;
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <path id="矩形_815_拷貝_5" data-name="矩形 815 拷貝 5" class="cls-1" d="M94.579,2.082l21.436-1.428a1.352,1.352,0,0,1,1.428,1.274,1.358,1.358,0,0,1-1.252,1.452L94.754,4.808A1.366,1.366,0,0,1,94.579,2.082Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-2" data-name="矩形 815 拷貝 5" class="cls-1" d="M95.921,4.814l21.437-1.428a1.366,1.366,0,0,1,.175,2.726L96.1,7.54A1.366,1.366,0,0,1,95.921,4.814Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-3" data-name="矩形 815 拷貝 5" class="cls-1" d="M93.236,6.18l21.437-1.428a1.366,1.366,0,0,1,.175,2.726L93.411,8.906A1.366,1.366,0,0,1,93.236,6.18Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-4" data-name="矩形 815 拷貝 5" class="cls-1" d="M95.921,8.912l21.437-1.428a1.366,1.366,0,0,1,.175,2.726L96.1,11.638A1.366,1.366,0,0,1,95.921,8.912Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-5" data-name="矩形 815 拷貝 5" class="cls-1" d="M191.413,2.431l-21.5-1.416a1.355,1.355,0,0,0-.176,2.7l21.5,1.416A1.355,1.355,0,0,0,191.413,2.431Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-6" data-name="矩形 815 拷貝 5" class="cls-1" d="M190.066,4.142l-21.5-1.416a1.355,1.355,0,0,0-.176,2.7l21.5,1.417A1.355,1.355,0,0,0,190.066,4.142Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-7" data-name="矩形 815 拷貝 5" class="cls-1" d="M192.76,5.5l-21.5-1.416a1.355,1.355,0,0,0-.176,2.7l21.5,1.417A1.355,1.355,0,0,0,192.76,5.5Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_6" data-name="矩形 815 拷貝 6" class="cls-1" d="M192.76,8.5l-21.5-1.416a1.355,1.355,0,0,0-.176,2.7l21.5,1.417A1.355,1.355,0,0,0,192.76,8.5Z" transform="translate(0 -0.328)"/>
        <path id="矩形_815_拷貝_5-8" data-name="矩形 815 拷貝 5" class="cls-1" d="M190.066,7.207l-21.5-1.416a1.355,1.355,0,0,0-.176,2.7l21.5,1.416A1.355,1.355,0,0,0,190.066,7.207Z" transform="translate(0 -0.328)"/>
        <path id="矩形_823_拷貝" data-name="矩形 823 拷貝" class="cls-1" d="M143.257,38.244C169.358,38.244,175.2,56,175.2,56H113.441S118.3,38.244,143.257,38.244Z" transform="translate(0 -0.328)"/>
      </svg>
    </div>
    </div>
    <!-- Javascript -->
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js'></script>
    <script src="https://kit.fontawesome.com/629062769a.js"></script>
    <script src="js/main.js"></script>
    <script src="js/loginBox.js"></script>
    <script src="js/createBox.js"></script>
    <script src="js/createRoleData.js"></script>
    <script src="js/newCharacter.js"></script>
    <!-- <script src="js/chatbot.js"></script> -->
    <script src="js/chat.js"></script>
    <script src="js/roleFunctions.js"></script>
</body>

</html>