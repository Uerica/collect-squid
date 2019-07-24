<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["mem_name"])||($_SESSION["mem_name"] == "")){
      //沒登入
    } else {
      //有登入存阿
      $mem_no = $_SESSION["mem_no"];
      $mem_name = $_SESSION["mem_name"];
      $style_no = $_SESSION["style_no"];
      // 偵測穿衣服了沒
      // code 先拿了
      $mem_lv = $_SESSION["mem_lv"];
      $mem_avatar = $_SESSION["mem_avatar"];
      $squid_qty = $_SESSION["squid_qty"];
      $errMsg = '';
      try {
          require_once('connectSquid.php');
          $sql = "SELECT * FROM member WHERE mem_name NOT IN(:mem_name) ORDER BY RAND() LIMIT 1"; 
          $member = $pdo->prepare($sql);
          $member->bindValue(":mem_name", $mem_name);
          $member->execute(); 
          $memRow = $member->fetch(PDO::FETCH_ASSOC);
  
          // 排行榜會員資料
          $sqlMember= "SELECT mem_no, mem_name, heart_qty FROM member ORDER BY heart_qty DESC LIMIT 9";
          $allMember = $pdo->prepare($sqlMember);
          $allMember->execute();
          $allMemberRows = $allMember->fetchAll(PDO::FETCH_ASSOC);
  
          // 通知
          $sqlNoti = "SELECT * FROM `notification` WHERE rcv_mem_no = " . $_SESSION["mem_no"] . " AND is_read = 0";
          $noti = $pdo->prepare($sqlNoti);
          $noti->execute();
          $notiRows = $noti->fetchAll(PDO::FETCH_ASSOC);
  
  
      } catch(PDOException $e) {
          $errMsg .= $e->getMessage()."<br>";
          $errMsg .= $e->getLine()."<br>";
      }
    };
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
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="sass/style.css">
    <title>收集友誼</title>
</head>

<body>
  <!-- vue -->
  <div id="app">
      <!-- 我自己的魷魚 -->
      <div class="loginSquid" v-if="is_login()">
      <div class="talkingBubble" v-if="get_latest_message(user_id) != ''">
          <p>{{get_latest_message(user_id)}}</p>
      </div>
          <span class="roleName">{{user_id}}</span>
          <img id="myRole" :src="style_no" alt="自己的外型">
      </div>
    
    <!-- 別的魷魚,線上有幾隻產生幾隻 -->

    <template v-for="others_online_user_info in others_online_users_info()">
      <div class="otherSquid" :style="others_online_user_info.position" >
        <div class="onlineFuns">
          <a class="funIcon goRoom" v-on:click="go_room(others_online_user_info.mem_name)" class="onlineFunction"><img src="imgs/characters/goRoomIcon.png" alt="看房間"></a >
          <a class="funIcon addFriend" v-on:click="add_friend(others_online_user_info.mem_name)" href="javascript:;" class="onlineFunction">
            <img v-if="is_friend(others_online_user_info.mem_name)" src="imgs/characters/alreadyAddFriendIcon.png" alt="加好友">
            <img v-else src="imgs/characters/addFriendIcon.png" alt="加好友">
          </a >
          <a class="funIcon mute" v-on:click="toggle_mute_user(others_online_user_info.mem_name)" href="javascript:;" class="onlineFunction">
            <img v-if="is_muted_user(others_online_user_info.mem_name)" src="imgs/characters/unmuteIcon.png" alt="取消靜音">
            <img v-else src="imgs/characters/muteIcon.png" alt="靜音">
          </a >
        </div>
        <div class="talkingBubble" v-if="get_latest_message(others_online_user_info.mem_name) != ''">
          <p>{{get_latest_message(others_online_user_info.mem_name)}}</p>
        </div>
        <span class="roleName">{{others_online_user_info.mem_name}}</span>
        <img :src="others_online_user_info.style_no">
      </div>
    </template>

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

    <!-- 聊天群組(1.聊天室 2.好友列表) -->
    <!-- Rou:vue.js #chat_app -->
    <div class="chatGroup disabledScrollOnHover" id="chat_app">
       <div class="chatGroup_closeBtn">
          <i class="fas fa-window-minimize closeBtn"></i>
          <div class="closeBtn_text">縮小</div>
       </div>
       <div class="chatGroup_opacitySlider">
          <input type="range" name="bgopacity" id="bgopacity" value="100" min="30" max="100" step="1">
          <div class="sliderText">拖曳改變透明度</div>
       </div>
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
                            <p>歡迎來到收集友誼的世界，馬上發送訊息開始聊天吧！</p>
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
                                    <img src="imgs/homePage/icon/avatar.png" alt="大頭貼">{{ message.user_id }}
                                </div>
                            </div>
                        </li>
                        <!-- 接收訊息者 -->
                        <!-- Rou:檢查收到訊息的userid是不是自己來判斷訊息區塊的樣子,以下userid不是自己 -->
                        <!-- Rou:在公頻聊天只有大頭貼沒辦法看到名字,在內容中寫入{{ message.user_id }}可以產生正在講話的人的名字 -->
                        <li class="chatRoom_messageReceived" v-if="message.user_id != user_id">
                            <div class="message-received">
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/avatar.png" alt="大頭貼">{{ message.user_id }}
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
                                    <img src="imgs/homePage/icon/avatar.png" alt="">
                                </div>
                            </div>
                        </li>
                        <!-- 接收訊息者 -->
                        <!-- Rou:如果發訊息的人不是我本人 -->
                        <li class="chatRoom_messageReceived" v-if="message.user_id != user_id">
                            <div class="message-received">
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/avatar.png" alt="大頭貼">
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
                    <div class="submitContext form">
                        <!-- Rou:在此用v-model產生動態變數 以及增加事件-->
                        <input type="text" class="messageInput" v-model="chat_send_text" v-on:keyup.enter="chat_send()">
                        <input type="button" value="傳送" class="submit button-submit" v-on:click="chat_send()">
                    </div>
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
                                    <img src="imgs/homePage/icon/avatar_F.png" alt="大頭貼">
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

                                <!-- <div class="moreAction">
                                    <a href="javavscript:;">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </a>
                                </div> -->
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
                                    <img src="imgs/homePage/icon/avatar_F.png" alt="大頭貼">
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
                                    <div class="roomVisit_text">去房間</div>
                                </div>

                                <!-- <div class="moreAction">
                                    <a href="javavscript:;">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </li>

                    <!-- 好友邀請中 -->
                    <li class="friendList_requestedFriend">
                        <button class="friendList_friendStatus button">好友邀請中</button>
                        <div class="friendList_friend" v-for="friend in pending_friends">
                            <div class="friendInfo">
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/avatar_F.png" alt="大頭貼">
                                </div>
                                <div class="friendName">
                                    <p>{{friend}}</p>
                                </div>
                            </div>

                            <div class="friendAction">
                                <!-- 接受好友申請 -->
                                <div class="requestAccept">
                                    <a href="javascript:;" v-on:click="confirm_friend(friend)"><img src="imgs/homePage/icon/accept.png" alt="接受ICON"></a>
                                    <div class="requestAccept_text">同意</div>
                                </div>
                                <!-- 拒絕好友申請 -->
                                <div class="requestRefuse">
                                    <a href="javascript:;" v-on:click="del_friend(friend)"><img src="imgs/homePage/icon/refuse.png" alt="拒絕ICON"></a>
                                    <div class="requestRefuse_text">拒絕</div>
                                </div>
                            </div>
                        </div>
                    </li> 

                    
                    <!-- waiting好友agree中 -->
                    <li class="friendList_waitingFriend">
                        <button class="friendList_friendStatus button">等待好友同意中</button>
                        <div class="friendList_friend" v-for="friend in waiting_friends">
                            <div class="friendInfo">
                                <div class="avatar">
                                    <img src="imgs/homePage/icon/avatar_F.png" alt="大頭貼">
                                </div>
                                <div class="friendName">
                                    <p>{{friend}}</p>
                                </div>
                            </div>
                        </div>
                    </li> 
                </ul>
            </div>
        </div>
    </div>

    <!-- 登入 -->
    <div v-if="is_login() == false" class="loginBox">
      <div class="loginContent">
        <div class="intro">
          <div class="logo">
            <img src="imgs/homePage/logo.png" alt="Logo" />
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
          <!-- 登入錯誤訊息 -->
          <span id="login_failMsg"></span>
          <div class="loginForm_form">
            <div class="personalInfo">
              <div class="inputField">
                <label for="mem_name">暱稱</label>
                <input type="text" name="mem_name" id="login_mem_name" v-on:keyup="login_enter" />
              </div>
              <div class="inputField">
                <label for="mem_pwd">密碼</label>
                <input type="password" name="mem_pwd" id="login_mem_pwd" v-on:keyup="login_enter" />
              </div>
              <a href="javascript:;">忘記密碼？</a>
            </div>
            <div class="submitBtns">
              <input class="createRole" type="button" value="創角" v-on:click="create_role" />
              <input id="loginBtn" type="button" v-on:click="login_btn" value="登入"/>
              <input id="godMode" type="submit" value="上帝模式" v-on:click="god_mode" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- vue -->
  
  <!-- 聊天群組click -->
  <div class="friendList_open disabledScrollOnHover">
      <button class="button friendList_openBtn">開啟聊天室</button>
  </div>

    <!-- 通知&客服機器人 -->
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

      <!-- 通知 -->
      <div class="notifications_container collapse">
          <div class="notifications_content">
          <?php
            foreach ($notiRows as $i=>$notiRow) {
              $notiType = '新消息';
              $notiClassName = 'notifications notifications_';
              switch($notiRow['noti_type']) {
                // 房間留言
                case 1:
                  $notiType = '留言通知';
                  $notiClassName .= 'room';
                  break;
                // 好友邀請
                case 2:
                  $notiType = '好友邀請';
                  $notiClassName .= 'friend';
                  break;
                // 活動分享
                case 3:
                  $notiType = '活動分享';
                  $notiClassName .= 'event';
                  break;
                default:
                  break;
              }
            ?>
              <div class="<?php echo $notiClassName; ?>">
                  <i class="notifications_time"><?php echo $notiRow['noti_date'] ?></i>
                  <i class="fas fa-times notifications_delete"></i>
                  <span>【<?php echo $notiType ?>】</span>
                  <p><?php echo $notiRow['noti_cnt']; ?></p>
              </div>
          <?php } ?>
          </div>
      </div>

      <!-- 客服機器人 -->
      <div class="robot_container disabledScrollOnHover collapse">
        <div id="chatBotBox" class="chatBotBox">
            <h3>魷魚機器人</h3>
            <div class="chatBot_wrapper">
                <div class="chatContainer" style="display:none">

                    <div id="chat_Q" class="chat_Q">
                        <p>^_^</p>
                    </div>
                    <div class="clearfix"></div>

                    <div id="chat_A" class="chat_A">
                        <p>Hi! 很高興為您服務，您可以點擊下方關鍵字或是直接輸入詢問內容!</p>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <!-- ............................................................. -->
                <div id="chatContainer" class="chatContainer">

                    <div id="chat_Q" class="chat_Q">
                        <p>^_^</p>
                    </div>
                    <div class="clearfix"></div>

                    <div id="chat_A" class="chat_A">
                        <p>Hi! 很高興為您服務，您可以點擊下方關鍵字或是直接輸入詢問內容!</p>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>


            <ul class="chatBtn">
                <li id="index" class="questionTag">首頁</li>
                <li id="myroom" class="questionTag">我的房間</li>
                <li id="dressingRoom" class="questionTag">換衣間</li>
                <li id="findFrnd" class="questionTag">找朋友</li>
                <li id="group" class="questionTag">揪團活動</li>
                <li id="shop" class="questionTag">虛擬商城</li>
                <li id="memCenter" class="questionTag">會員中心</li>
            </ul>


            <div class="chatWords">
                <input type="text" id="chatInput" class="chatInput">
                <button type="button" id="chatSubmit" class="chatSubmit">送出</button>
                <div class="clearfix"></div>
            </div>
        </div>
      </div>
  </div>

    <!-- 聊天世界 -->
  <div class="gameWorld">
      <div class="gameWorld_bgImage">
          <img src="imgs/homePage/homepage01.png" alt="" draggable="false" oncontextmenu="return false">
      </div>

      <div class="gameWorld_mapItem">
          <div class="gameWorld_house gameWorld_object">
              <a href="javascript:;"><img src="imgs/homePage/house_tag.png" alt=""></a>
          </div>
          <div class="gameWorld_fountain gameWorld_object">
              <canvas id="spray"></canvas>
              <img src="imgs/homePage/fountain.png" alt="">
          </div>
          <div id="busBox" class="gameWorld_bus gameWorld_object">
              <div id="smoke"></div>
              <a href="javascript:;"><img src="imgs/homePage/bus.png" alt="" id="bus"></a>
          </div>
          <div class="gameWorld_cup gameWorld_object">
            <a href="javascript:;">
              <div class="gameWorld_cupImg">
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
              </div>
              <div class="gameWorld_cupText">
                  <img src="imgs/homePage/cup-text.png" alt="">
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

      <div class="gameWorld_leaderBoard disabledScrollOnHover">
        <div class="checkBox checkBox-leaderBoard collapse">
          <div class="leaderBoard_content">
            <div class="leaderBoard_closeArea">
              <i class="fas fa-times closeIcon" aria-hidden="true"></i>
              <div class="closeText">關閉</div>              
            </div>
            <div class="leaderBoard_title">
                <h2>排行榜</h2>
            </div>
                <div class="owl-carousel owl-theme leaderBoard_carousel">
                  <?php foreach ($allMemberRows as $i=>$allMemberRow) { 
                    // 排行榜顯示
                    $friendNo = $allMemberRow['mem_no'];
                    $leaderBoardClassname = 'leaderBoard_showcase showcase-';
                    $medalImagePath = 'imgs/homePage/leaderBoard/medal_';
                    switch($i) {
                      case 0: 
                        $leaderBoardClassname .= '1st';
                        $medalImagePath .= '1st.png';
                        break;
                      case 1: 
                        $leaderBoardClassname .= '2nd';
                        $medalImagePath .= '2nd.png';
                        break;
                      case 2: 
                        $leaderBoardClassname .= '3rd';
                        $medalImagePath .= '3rd.png';
                        break;
                      default: 
                        $leaderBoardClassname .= $i+1 . 'th';
                        $medalImagePath .= $i+1 . 'th.png';
                        break;
                    }

                    // 拿家具
                    $sqlmemFurniture = 
                    "SELECT mem_furniture.mem_no, product_furniture.furn_no, product_furniture.furn_type, product_furniture.furn_img_url
                      FROM product_furniture
                      JOIN mem_furniture
                      ON product_furniture.furn_no = mem_furniture.furn_no
                      WHERE mem_furniture.mem_no = " . $allMemberRow['mem_no'] .
                      " AND mem_furniture.is_using = 1";
                    $memFurniture = $pdo->prepare($sqlmemFurniture);
                    $memFurniture->execute();
                    $memFurnitureRows = $memFurniture->fetchAll(PDO::FETCH_ASSOC);
                    

                    $bedImg = 'images/bed_LV1_01.png';
                    $chairImg = 'images/chair_LV1_01.png';
                    $deskImg = 'images/desk_LV1_01.png';

                    foreach($memFurnitureRows as $i=>$memFurnitureRow) {
                      switch($memFurnitureRow['furn_type']) {
                        case 1: //椅子
                          $chairImg = $memFurnitureRow['furn_img_url'];
                          break;
                        case 2: //桌子
                          $deskImg = $memFurnitureRow['furn_img_url'];
                          break;
                        case 3: //床
                          $bedImg = $memFurnitureRow['furn_img_url'];
                          break;
                        default:
                          break;
                      }
                    }

                    // 拿衣服
                    $sqlmemClothing = 
                    "SELECT mem_clothing.mem_no, product_clothing.clo_no, product_clothing.clo_type, product_clothing.clo_img_url
                      FROM product_clothing
                      JOIN mem_clothing
                      ON product_clothing.clo_no = mem_clothing.clo_no
                      WHERE mem_clothing.mem_no = " . $allMemberRow['mem_no'] .
                      " AND mem_clothing.is_using = 1";
                    $memClothing = $pdo->prepare($sqlmemClothing);
                    $memClothing->execute();
                    $memClothingRows = $memClothing->fetchAll(PDO::FETCH_ASSOC);
                    

                    $hatImg = 'imgs/dressingRoom/bearHat.png';
                    $shirtImg = 'imgs/dressingRoom/nobleCloBrown.png';
                    $shoesImg = 'imgs/dressingRoom/whiteShoes.png';

                    foreach($memClothingRows as $i=>$memClothingRow) {
                      switch($memClothingRow['clo_type']) {
                        case 1: //帽子
                          $hatImg = $memClothingRow['clo_img_url'];
                          break;
                        case 2: //衣服
                          $shirtImg = $memClothingRow['clo_img_url'];
                          break;
                        case 3: //鞋子
                          $shoesImg = $memClothingRow['clo_img_url'];
                          break;
                        default:
                          break;
                      }
                    } 
                  ?>
                    <div class="<?php echo $leaderBoardClassname; ?>" data-memno="<?php echo $friendNo; ?>">
                        <div class="leaderBoard_medal">
                          <img src="<?php echo $medalImagePath; ?>" alt="排行榜排名獎牌">
                        </div>
                        <div class="chosen_player">
                          <div class="memRoomItem">
                            <div class="memRoomItem_bg">
                              <img src="imgs/homePage/leaderBoard/room.jpg" alt="房間圖片">
                            </div>
                            <div class="memRoomItem_chair">
                              <img src="<?php echo $chairImg; ?>" alt="圖片">
                            </div>
                            <div class="memRoomItem_desk">
                              <img src="<?php echo $deskImg; ?>" alt="桌子圖片">
                            </div>
                            <div class="memRoomItem_bed">
                              <img src="<?php echo $bedImg; ?>" alt="床圖片">
                            </div>
                            <div class="memRoomItem_player">
                              <img src="imgs/homePage/squid2.png" alt="人物圖片">
                            </div>
                          </div>
                          <div class="memInfo">
                            <span id="playerName" class="playerName"><?php echo $allMemberRow["mem_name"];?></span>
                            <i class="fas fa-heart playerHeartSum"><b><?php echo $allMemberRow["heart_qty"];?></b></i>
                          </div>
                        </div>
                        <div class="leaderBoard_playerImage">
                          <div class="playerImage_style">
                            <div class="playerImage_default">
                              <img src="imgs/homePage/squid2.png" alt="玩家角色圖">
                              <div class="playerImage_hat">
                                <img src="<?php echo $hatImg; ?>" alt="帽子圖片">
                              </div>
                              <div class="playerImage_shirt">
                                <img src="<?php echo $shirtImg; ?>" alt="上衣圖片">
                              </div>
                              <div class="playerImage_shoes">
                                <img src="<?php echo $shoesImg; ?>" alt="鞋子圖片">
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                  <?php } ?>
                </div>
            <div class="leaderBoard_btn">
              <button class="button btn-visit">拜訪房間</button>
              <button class="button btn-addFriend" id="leaderBoard_addfriend" >加朋友</button>
            </div>
          </div>
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
  <form id="creatingForm_moving" action="post" accept-charset="utf-8">
    <input type="hidden" id="createdSquid_moving" name="createdSquid_moving">
    <canvas id="roleCanvas_moving"></canvas>
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
      <rect id="矩形_3_拷貝_27" data-name="矩形 3 拷貝 27" class="cls-1 squidBody" x="73.266" y="247.437" width="25.2" height="150" rx="5.423" ry="5.423"/>
      <rect id="矩形_3_拷貝_27-2" data-name="矩形 3 拷貝 27" class="cls-1 squidBody" x="129.922" y="247.437" width="25.2" height="150" rx="5.423" ry="5.423"/>
      <rect id="矩形_3_拷貝_27-3" data-name="矩形 3 拷貝 27" class="cls-1 squidBody" x="186.047" y="247.437" width="25.2" height="150" rx="5.423" ry="5.423"/>
    </svg>
    <svg id="emptySquid_moving" xmlns="http://www.w3.org/2000/svg" width="286" height="398.125" viewBox="0 0 286 398.125">
      <defs>
        <style>
          .cls-1, .cls-2 {
            fill: #ff8d8d;
          }

          .cls-2, .cls-3 {
            fill-rule: evenodd;
          }

          .cls-3 {
            fill: #f3f3f3;
          }

          .cls-4 {
            fill: #5d8bae;
          }

          .cls-5 {
            fill: #58c7cb;
          }
        </style>
      </defs>
      <rect id="矩形_2_拷貝_26" data-name="矩形 2 拷貝 26" class="cls-1 squidBody_moving" x="45.063" y="0.781" width="195.844" height="322.75" rx="20" ry="20"/>
      <path id="矩形_3_拷貝_27" data-name="矩形 3 拷貝 27" class="cls-2 squidBody_moving" d="M191.463,361.31h14.354a5.423,5.423,0,0,1,5.423,5.423V471.251C211.24,491.5,218,497,218,497c1.2,3.855.964,4.421-1,7l-14,5c-2.48,1.2-8-1-8-4,0,0-8.96-13.5-8.96-33.749V366.733A5.423,5.423,0,0,1,191.463,361.31Z" transform="translate(0.313 -112.094)"/>
      <path id="矩形_3_拷貝_29" data-name="矩形 3 拷貝 29" class="cls-2 squidBody_moving" d="M135.463,361.31h14.354a5.423,5.423,0,0,1,5.423,5.423V471.251C155.24,491.5,162,497,162,497c1.2,3.855.964,4.421-1,7l-14,5c-2.48,1.2-8-1-8-4,0,0-8.96-13.5-8.96-33.749V366.733A5.423,5.423,0,0,1,135.463,361.31Z" transform="translate(0.313 -112.094)"/>
      <path id="矩形_3_拷貝_30" data-name="矩形 3 拷貝 30" class="cls-2 squidBody_moving" d="M78.463,361.31H92.817a5.423,5.423,0,0,1,5.423,5.423V471.251C98.24,491.5,105,497,105,497c1.2,3.855.964,4.421-1,7l-14,5c-2.48,1.2-8-1-8-4,0,0-8.96-13.5-8.96-33.749V366.733A5.423,5.423,0,0,1,78.463,361.31Z" transform="translate(0.313 -112.094)"/>
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
  <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js'></script>
  <script src="https://kit.fontawesome.com/629062769a.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/createBox.js"></script>
  <script src="js/createRoleData.js"></script>
  <script src="js/newCharacter.js"></script>
  <script src="js/chatBot.js"></script>
  <script src="js/roleFunctions.js"></script>
  <script src="js/rolePosition.js"></script>
  <script src="js/leaderBoard.js"></script>
  <script src="js/addFriend.js"></script>
  <script src="js/leaderBoardAddFriend.js"></script>
  <script src="js/chat.js"></script>
  <script src="js/movingAction.js"></script>
  <script>
    <?php
    if(isset($_SESSION["mem_name"])){
      echo "var mem_name='" . $_SESSION["mem_name"] . "';\r\n";
      echo "var style_no='" . $_SESSION["style_no"] . "';\r\n";
      echo "var mem_lv='" . $_SESSION["mem_lv"] . "';\r\n";
      echo "var mem_avatar='" . $_SESSION["mem_avatar"] . "';\r\n";
      echo "var squid_qty='" . $_SESSION["squid_qty"] . "';\r\n";
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
  <script>
    $("#leaderBoard_addfriend").click(function(){
      var name = $(".active #playerName").html();
      if(confirm('是否確認加'+name+'好友?')){
        addFriend(mem_name, name);
      }
    });
  </script>
</body>
</html>