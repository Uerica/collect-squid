<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, minmum-scale=0, maximum-scale=10 initial-scale=1.0"
    />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="css/reset.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="sass/style.css" />
    <title>收集友誼</title>
  </head>

  <body>
    <div class="gameWorld_bgImage">
      <img
        src="imgs/homepage01.png"
        alt=""
        draggable="false"
        oncontextmenu="return false"
      />
    </div>

    <!-- gameWorld -->
    <!-- <div class="gameWorld">
        <div class="house">
        </div>
    </div> -->

    <div class="gameWorld">
      <!-- <div class="gameWorld_bgImage">
                    <img src="imgs/homepage01.png" alt="" draggable="false" oncontextmenu="return false">
                </div> -->
      <div class="gameWorld_house gameWorld_object">
        <img src="imgs/house_tag.png" alt="" />
      </div>
      <div class="gameWorld_fountain gameWorld_object">
        <img src="imgs/fountain.png" alt="" />
      </div>
      <div class="gameWorld_bus gameWorld_object">
        <img src="imgs/bus.png" alt="" />
      </div>
      <div class="gameWorld_cup gameWorld_object">
        <img src="imgs/cup.png" alt="" />
      </div>
    </div>

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
              <img src="imgs/icon/coin.png" alt="持有金額icon" />
              <span>1500</span>
            </a>
          </li>
          <li class="logo">
            <a href="index.html">
              <img src="imgs/logo.png" alt="尋找友誼網站LOGO" />
              <span>尋找友誼</span>
            </a>
          </li>
          <li class="login">
            <img src="imgs/icon/avatar.png" alt="角色頭像icon" />
            <span class="name">
              <a href="javascript:;">魚翔</a>
            </span>
            <span>
              <a href="javascript:;">登出</a>
            </span>
          </li>
        </ul>
        <nav class="menuMobile_nav">
          <li>
            <a href="myRoom.html">
              <img src="imgs/icon/room.png" alt="我的房間icon" />
              <span>我的房間</span></a
            >
          </li>
          <li>
            <a href="dressingRoom.html"
              ><img src="imgs/icon/fittingRoom.png" alt="換衣間icon" />
              <span>換衣間</span></a
            >
          </li>
          <li>
            <a href="findfriend.html">
              <img src="imgs/icon/friend.png" alt="找朋友icon" />
              <span>找朋友</span></a
            >
          </li>
          <li>
            <a href="javascript:;">
              <img src="imgs/icon/events.png" alt="揪團活動icon" />
              <span>揪團活動</span></a
            >
          </li>
          <li>
            <a href="shop.html">
              <img src="imgs/icon/mall.png" alt="虛擬商城icon" />
              <span>虛擬商城</span></a
            >
          </li>
          <li>
            <a href="memberCenter.html">
              <img src="imgs/icon/member.png" alt="會員中心icon" />
              <span>會員中心</span></a
            >
          </li>
          <li>
            <a href="javascript:;">
              <img src="imgs/icon/robot.png" alt="客服機器人_icon" />
              <span>客服機器人</span></a
            >
          </li>
          <li>
            <a href="javascript:;">
              <img src="imgs/icon/notice02.png" alt="通知_icon" />
              <span>通知</span></a
            >
          </li>
        </nav>
      </div>

      <nav class="menuDesktop">
        <ul>
          <li>
            <a href="myRoom.html">
              <img src="imgs/icon/room.png" alt="我的房間icon" />
              <span>我的房間</span>
            </a>
          </li>
          <li>
            <a href="dressingRoom.html">
              <img src="imgs/icon/fittingRoom.png" alt="換衣間icon" />
              <span>換衣間</span></a
            >
          </li>
          <li>
            <a href="findfriend.html">
              <img src="imgs/icon/friend.png" alt="找朋友icon" />
              <span>找朋友</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="imgs/icon/events.png" alt="揪團活動icon" />
              <span>揪團活動</span>
            </a>
          </li>
          <li class="logo">
            <a href="index.html">
              <img src="imgs/logo.png" alt="尋找友誼網站LOGO" />
              <span>尋找友誼</span>
            </a>
          </li>
          <li>
            <a href="shop.html">
              <img src="imgs/icon/mall.png" alt="虛擬商城icon" />
              <span>虛擬商城</span>
            </a>
          </li>
          <li>
            <a href="memberCenter.html">
              <img src="imgs/icon/member.png" alt="會員中心icon" />
              <span>會員中心</span>
            </a>
          </li>
          <div class="memberInfo">
            <li class="login">
              <img src="imgs/icon/avatar.png" alt="角色頭像icon" />
              <span class="name"><a href="javascript:;">魚翔</a></span>
              <span><a href="javascript:;">登出</a></span>
            </li>
            <li class="coin">
              <a href="javascript:;">
                <img src="imgs/icon/coin.png" alt="持有金額icon" />
                <span>1500</span>
              </a>
            </li>
            <li class="level">
              <a href="javascript:;">
                <img src="imgs/icon/civilian.png" alt="平民等級icon" />
                <span>平民</span>
              </a>
            </li>
          </div>
        </ul>
      </nav>
    </header>

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
              <li
                class="chatRoom_messageSent"
                v-if="message.user_id == user_id"
              >
                <div class="message-sent">
                  <div class="text">
                    <p>{{ message.chat_msg }}</p>
                  </div>
                  <div class="avatar">
                    <img src="imgs/icon/member0.png" alt="大頭貼" />{{
                      message.user_id
                    }}
                  </div>
                </div>
              </li>
              <!-- 接收訊息者 -->
              <!-- Rou:檢查收到訊息的userid是不是自己來判斷訊息區塊的樣子,以下userid不是自己 -->
              <!-- Rou:在公頻聊天只有大頭貼沒辦法看到名字,在內容中寫入{{ message.user_id }}可以產生正在講話的人的名字 -->
              <li
                class="chatRoom_messageReceived"
                v-if="message.user_id != user_id"
              >
                <div class="message-received">
                  <div class="avatar">
                    <img src="imgs/icon/member0.png" alt="大頭貼" />{{
                      message.user_id
                    }}
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
              <p>TO: {{ chat_to_who }}</p>
            </div>
            <template v-for="message in messages_to_someone(chat_to_who)">
              <!-- 發送訊息者 -->
              <!-- Rou:如果發訊息的人是我 -->
              <li
                class="chatRoom_messageSent"
                v-if="message.user_id == user_id"
              >
                <div class="message-sent">
                  <div class="text">
                    <p>{{ message.chat_msg }}</p>
                  </div>
                  <div class="avatar">
                    <img src="imgs/icon/member0.png" alt="" />
                  </div>
                </div>
              </li>
              <!-- 接收訊息者 -->
              <!-- Rou:如果發訊息的人不是我本人 -->
              <li
                class="chatRoom_messageReceived"
                v-if="message.user_id != user_id"
              >
                <div class="message-received">
                  <div class="avatar">
                    <img src="imgs/icon/member0.png" alt="大頭貼" />
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
              <input
                type="text"
                class="messageInput"
                v-model="chat_send_text"
              />
              <input
                type="button"
                value="傳送"
                class="submit button-submit"
                v-on:click="chat_send()"
              />
            </form>
          </div>

          <!-- 選擇頻道 -->
          <!-- Rou:動作後產生class -->

          <div class="chatRoom_switchChannel button_group">
            <button
              class="button button-private"
              v-bind:class="{ active: !chat_to_all }"
            >
              私訊
            </button>
            <button
              class="button button-public"
              v-bind:class="{ active: chat_to_all }"
              v-on:click="public_chat()"
            >
              公開
            </button>
          </div>
        </div>
      </div>

      <div class="friendList">
        <div class="friendList_content">
          <ul class="friendList_main">
            <!-- 上線的好友 -->
            <li class="friendList_onlineFriend">
              <!-- 好友類型(online, offline, requested) -->
              <button class="friendList_friendStatus button">
                在線好友({{ online_friends().length }}/{{ friends.length }})
              </button>

              <!-- 好友01 每個 friendList_friend 是一位好友-->
              <!-- Rou:將有上線的好友跑一遍,如果有抓到產生此區塊 -->
              <div class="friendList_friend" v-for="friend in online_friends()">
                <!-- 好友大頭貼、暱稱 -->
                <div class="friendInfo">
                  <div class="avatar">
                    <img src="imgs/tree_04.png" alt="大頭貼" />
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
                    <a href="javascript:;"
                      ><img src="imgs/icon/home.png" alt="房間ICON"
                    /></a>
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
              <button class="friendList_friendStatus button">
                離線好友({{ offline_friends().length }}/{{ friends.length }})
              </button>

              <!-- Rou:將離線好友跑一遍,如果有抓到產生此區塊 -->
              <div
                class="friendList_friend"
                v-for="friend in offline_friends()"
              >
                <div class="friendInfo">
                  <div class="avatar">
                    <img src="imgs/tree_04.png" alt="大頭貼" />
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
                    <a href="javascript:;"
                      ><img src="imgs/icon/home.png" alt="房間ICON"
                    /></a>
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
                    <img src="imgs/tree_04.png" alt="大頭貼" />
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
                    <a href="javascript:;"
                      ><img src="imgs/icon/home.png" alt="房間ICON"
                    /></a>
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
                    <img src="imgs/tree_04.png" alt="大頭貼" />
                  </div>
                  <div class="friendName">
                    <p>毛筆</p>
                  </div>
                </div>

                <div class="friendAction">
                  <!-- 接受好友申請 -->
                  <div class="requestAccept">
                    <a href="javascript:;"
                      ><img src="imgs/icon/accept.png" alt="接受ICON"
                    /></a>
                  </div>
                  <!-- 拒絕好友申請 -->
                  <div class="requestRefuse">
                    <a href="javascript:;"
                      ><img src="imgs/icon/refuse.png" alt="拒絕ICON"
                    /></a>
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

    <!-- 通知&客服機器人 -->
    <div class="common_notifications disabledScrollOnHover">
      <div class="notifications_actionBox">
        <button class="button button-notifications">
          <img src="imgs/icon/notice.png" alt="通知按鈕圖片" />
          <span>通知</span>
        </button>
        <button class="button button-robot">
          <img src="imgs/icon/robot.png" alt="客服機器人圖片" />
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
                <label for="memId">暱稱</label>
                <input type="text" name="memId" id="memId" />
              </div>
              <div class="inputField">
                <label for="memPsw">密碼</label>
                <input type="text" name="memPsw" id="memPsw" />
              </div>
              <a href="javascript:;">忘記密碼？</a>
            </div>
            <div class="submitBtns">
              <input class="createRole" type="submit" value="創角" />
              <input type="button" value="登入" onclick="login()" />
              <input class="godMode" type="submit" value="上帝模式" />
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="createBox">
      <div class="createContent">
        <div class="createFrame">
          <form action="">
            <div class="inputField">
              <label for="gender">性別</label
              ><input type="text" name="gender" id="gender" />
            </div>
            <div class="inputField">
              <label for="birthday">生日</label
              ><input type="text" name="birthday" id="birthday" />
            </div>
            <div class="inputField">
              <label for="memName">姓名</label
              ><input type="text" name="memName" id="memName" />
            </div>
            <div class="inputField">
              <label for="email">信箱</label
              ><input type="email" name="email" id="email" />
            </div>
            <div class="inputField">
              <label for="memPsw">密碼</label
              ><input type="password" name="memPsw" id="memPsw" />
            </div>
            <div class="inputField">
              <label for="checkMemPsw">確認密碼</label
              ><input type="password" name="checkMemPsw" id="checkMemPsw" />
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
                  <ul>
                    <li>
                      <svg id="head1" xmlns="http://www.w3.org/2000/svg" width="208" height="178" viewBox="0 0 208 178">
                        <defs>
                          <style>
                            .cls-1 {
                              fill: #ff8282;
                              fill-rule: evenodd;
                            }
                          </style>
                        </defs>
                        <path id="多邊形_1_拷貝_23" data-name="多邊形 1 拷貝 23" class="cls-1" d="M172.862,65.95q69.951,88.077-69.95,88.076T32.962,65.95Q102.913-22.126,172.862,65.95Z" transform="translate(1.078 1.031)"/>
                      </svg>
                      <svg  id="head2" xmlns="http://www.w3.org/2000/svg" width="208" height="178" viewBox="0 0 208 178">
                        <defs>
                          <style>
                            .cls-1 {
                              fill: #ff8282;
                              fill-rule: evenodd;
                            }
                          </style>
                        </defs>
                        <path id="多邊形_1_拷貝_25" data-name="多邊形 1 拷貝 25" class="cls-1" d="M167.739,58.982q63.747,118-63.745,118t-63.746-118Q103.994-59.018,167.739,58.982Z" transform="translate(0 0.516)"/>
                      </svg>
                    </li>
                    <li>
                        <svg id="head3" xmlns="http://www.w3.org/2000/svg" width="208" height="178" viewBox="0 0 208 178">
                          <defs>
                            <style>
                              .cls-1 {
                                fill: #ff8282;
                                fill-rule: evenodd;
                              }
                            </style>
                          </defs>
                          <path id="多邊形_1_拷貝_26" data-name="多邊形 1 拷貝 26" class="cls-1" d="M181.269,80.632Q258.543,111.987,104,111.986T26.723,80.632Q104,49.276,181.269,80.632Z" transform="translate(0 0.516)"/>
                        </svg>
                        <svg  id="head4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="208" height="178.031" viewBox="0 0 208 178.031">
                          <defs>
                            <style>
                              .cls-1 {
                                fill: #ff8282;
                                fill-rule: evenodd;
                              }
                            </style>
                            <clipPath id="clip-path">
                              <rect x="-0.016" y="0.016" width="208" height="178"/>
                            </clipPath>
                          </defs>
                          <g clip-path="url(#clip-path)">
                            <g>
                              <path id="多邊形_1_拷貝_27" data-name="多邊形 1 拷貝 27" class="cls-1" d="M150.651,77.567c8.695,16.1,15.5,6,33.833,27.624,32.4,38.2-14.436,72.806-80.651,72.806-66.11,0-112.168-33.832-80.71-72.574,18.323-22.567,25.15-11.663,33.9-27.856,2.376-4.4-8.765-7.32-8.765-28.086,0-70.377,109.851-60.781,109.851-2.112C158.107,52.677,147.84,72.364,150.651,77.567Z" transform="translate(-0.016 0.016)"/>
                            </g>
                          </g>
                        </svg>
                    </li>
                    <li>
                        <svg id="head5" xmlns="http://www.w3.org/2000/svg" width="208" height="178" viewBox="0 0 208 178">
                          <defs>
                            <style>
                              .cls-1 {
                                fill: #ff8282;
                                fill-rule: evenodd;
                              }
                            </style>
                          </defs>
                          <path id="多邊形_1_拷貝_34" data-name="多邊形 1 拷貝 34" class="cls-1" d="M151.372,91.069q47.371,86.918-47.37,86.917T56.631,91.069Q104,4.154,151.372,91.069Z"/>
                          <path id="多邊形_1_拷貝_34-2" data-name="多邊形 1 拷貝 34" class="cls-1" d="M32,86.921Q-40,0,104.007,0t72,86.916Q104.007,173.837,32,86.921Z"/>
                        </svg>
                        <svg id="head6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="208" height="178.031" viewBox="0 0 208 178.031">
                          <defs>
                            <style>
                              .cls-1 {
                                fill: #ff8282;
                                fill-rule: evenodd;
                              }
                            </style>
                            <clipPath id="clip-path">
                              <rect x="-0.5" y="0.016" width="208" height="178"/>
                            </clipPath>
                          </defs>
                          <g clip-path="url(#clip-path)">
                            <g>
                              <path id="多邊形_1_拷貝_34" data-name="多邊形 1 拷貝 34" class="cls-1" d="M141.421,119.744q35.238,58.248-35.239,58.248T70.943,119.744Q106.182,61.5,141.421,119.744Z" transform="translate(-0.5 0.016)"/>
                              <path id="多邊形_1_拷貝_34-2" data-name="多邊形 1 拷貝 34" class="cls-1" d="M154.005,85.02q47.825,69.423-47.824,69.423T58.357,85.02Q106.181,15.6,154.005,85.02Z" transform="translate(-0.5 0.016)"/>
                              <path id="多邊形_1_拷貝_34-3" data-name="多邊形 1 拷貝 34" class="cls-1" d="M161.136,41.4q56.636,82.867-56.634,82.866T47.869,41.4Q104.5-41.47,161.136,41.4Z" transform="translate(-0.5 0.016)"/>
                            </g>
                          </g>
                        </svg>
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
                  <ul>
                    <li>
                      <img src="imgs/createBox/face1.png" alt="Head 1" /><img
                        src="imgs/createBox/face2.png"
                        alt="Head 2"
                      />
                    </li>
                    <li>
                      <img src="imgs/createBox/face3.png" alt="Head 3" /><img
                        alt="Head 4"
                        src="imgs/createBox/face4.png"
                      />
                    </li>
                    <li>
                      <img src="imgs/createBox/face5.png" alt="Head 5" /><img
                        src="imgs/createBox/face6.png"
                        alt="Head 6"
                      />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="appearance">
              <div class="squidBorn">
                <svg id="squidBody" xmlns="http://www.w3.org/2000/svg" width="128.344" height="257.125" viewBox="0 0 128.344 257.125">
                  <defs>
                    <style>
                      .cls-1 {
                        fill: #ff8282;
                      }
                
                      .cls-1, .cls-2, .cls-4 {
                        fill-rule: evenodd;
                      }
                
                      .cls-2 {
                        fill: #f1f1f1;
                      }
                
                      .cls-3 {
                        fill: #5280a4;
                      }
                
                      .cls-4 {
                        fill: #4dc0c4;
                      }
                    </style>
                  </defs>
                  <path id="矩形_2_拷貝_26" data-name="矩形 2 拷貝 26" class="cls-1" d="M156.335,47.114H260.069a12,12,0,0,1,12,12V243.6a12,12,0,0,1-12,12H156.335a12,12,0,0,1-12-12V59.114A12,12,0,0,1,156.335,47.114Z" transform="translate(-144 -47.125)"/>
                  <path id="矩形_3_拷貝_25" data-name="矩形 3 拷貝 25" class="cls-1" d="M173.862,206.936H180.5a5.423,5.423,0,0,1,5.423,5.424v86.474a5.423,5.423,0,0,1-5.423,5.424h-6.637a5.423,5.423,0,0,1-5.423-5.424V212.36A5.423,5.423,0,0,1,173.862,206.936Z" transform="translate(-144 -47.125)"/>
                  <path id="矩形_3_拷貝_25-2" data-name="矩形 3 拷貝 25" class="cls-1" d="M206.608,206.936h6.637a5.423,5.423,0,0,1,5.423,5.424v86.474a5.423,5.423,0,0,1-5.423,5.424h-6.637a5.423,5.423,0,0,1-5.423-5.424V212.36A5.423,5.423,0,0,1,206.608,206.936Z" transform="translate(-144 -47.125)"/>
                  <path id="矩形_3_拷貝_25-3" data-name="矩形 3 拷貝 25" class="cls-1" d="M239.315,206.936h6.636a5.423,5.423,0,0,1,5.424,5.424v86.474a5.423,5.423,0,0,1-5.424,5.424h-6.636a5.424,5.424,0,0,1-5.424-5.424V212.36A5.424,5.424,0,0,1,239.315,206.936Z" transform="translate(-144 -47.125)"/>
                  <path id="矩形_44_拷貝_2" data-name="矩形 44 拷貝 2" class="cls-2" d="M144.007,181.734h45.066c6.278,0,12.559,7.471,19.1,7.471,5.407,0,11.076-7.471,16.324-7.471h47.844V241.5a14.932,14.932,0,0,1-14.923,14.941h-98.49A14.931,14.931,0,0,1,144.007,241.5V181.734Z" transform="translate(-144 -47.125)"/>
                  <circle id="橢圓_15_拷貝_3" data-name="橢圓 15 拷貝 3" class="cls-3" cx="66.656" cy="155.516" r="4.469"/>
                  <circle id="橢圓_15_拷貝_3-2" data-name="橢圓 15 拷貝 3" class="cls-3" cx="66.656" cy="170.469" r="4.469"/>
                  <path id="矩形_45_拷貝_4" data-name="矩形 45 拷貝 4" class="cls-4" d="M234.565,198.172H259.9v17.553a7.868,7.868,0,0,1-7.867,7.868h-9.6a7.868,7.868,0,0,1-7.868-7.868V198.172Z" transform="translate(-144 -47.125)"/>
                  <circle id="橢圓_15_拷貝_3-3" data-name="橢圓 15 拷貝 3" class="cls-3" cx="66.656" cy="185.422" r="4.469"/>
                </svg>
                <div class="appearanceHead">
                    <svg class="head" id="head1" xmlns="http://www.w3.org/2000/svg" width="208" height="178" viewBox="0 0 208 178">
                      <defs>
                        <style>
                          .cls-1 {
                            fill: #ff8282;
                            fill-rule: evenodd;
                          }
                        </style>
                      </defs>
                      <path id="多邊形_1_拷貝_23" data-name="多邊形 1 拷貝 23" class="cls-1" d="M172.862,65.95q69.951,88.077-69.95,88.076T32.962,65.95Q102.913-22.126,172.862,65.95Z" transform="translate(1.078 1.031)"/>
                    </svg>
                </div>
                <img
                  class="faceFeature"
                  src="imgs/createBox/face1.png"
                  alt="Face Feature"
                />
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
    <!-- 到這裡 -->
    <script>
    screen.orientation.lock('landscape-primary');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
    <script src="https://kit.fontawesome.com/629062769a.js"></script>
    <script src="js/main.js"></script>
    <script src="js/loginBox.js"></script>
    <script src="js/createBox.js"></script>
  </body>
</html>
