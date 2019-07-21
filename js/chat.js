

// 即時聊天
//vuejs & websocket
var conn_chat;
var chat_app = new Vue({
  el: '#app',
  data: {
    user_id: '',
    friends: [],
    pending_friends: [],
    waiting_friends: [],
    online_users: [],
    chat_to_all: true,
    chat_to_who: '',
    messages: [],//存server回傳的物件
    chat_send_text: '',
    style_no:'',
    mem_lv:'',
    mem_avatar:'',
    squid_qty:'',
    online_users_info: [] //[{"mem_name":"a","style_no":"/a.png"},{"mem_name":"b","style_no":"/b.png"}]
  },
  methods: {
    //是否為登入狀態
    is_login: function(){
      return this.user_id!='';
    },
    //addFriend function
    add_friend: function(friend_name){
      const xhr = new XMLHttpRequest();
      xhr.onload = () => {
          if (xhr.status == 200) {
              console.log('addFriend OK');
          } else {
              console.error(xhr.responseText);
          }
      };
      const url = `addFriend.php?mem_name=${this.user_id}&friend_name=${friend_name}`;
      xhr.open("get", url, true);
      xhr.send(null);
    },
    //confirmFriend function
    confirm_friend: function(friend_name){
      const xhr = new XMLHttpRequest();
      xhr.onload = () => {
          if (xhr.status == 200) {
              console.log('confirmFriend OK');
              chat_app.refresh_friends();
          } else {
              console.error(xhr.responseText);
          }
      };
      const url = `confirmFriend.php?mem_name=${this.user_id}&friend_name=${friend_name}`;
      xhr.open("get", url, true);
      xhr.send(null);
    },
    user_online: function (user) {
      this.online_users.push(user);
      var xhr = new XMLHttpRequest();
        xhr.onload=function (e){
          if(e.currentTarget.status == 200){
            var resp = JSON.parse(e.currentTarget.responseText);
            chat_app.online_users_info.push(resp);
          }else{
              console.error( '有人上線 error.', e );
          }
        }
        
        var url = "getRole.php?mem_name="+user;
        xhr.open("Get", url, true);
        xhr.send( null );
    },
    others_online_users_info:function(){
      return this.online_users_info.filter(function (e) { return e.mem_name != chat_app.user_id });
    },
    user_offline: function (user) {
      this.online_users = this.online_users.filter(function (e) { return e != user });
      this.online_users_info = this.online_users_info.filter(function (e) { return e.mem_name != user });
    },
    public_chat: function () {
      this.chat_to_who = '';
      this.chat_to_all = true;
    },
    private_chat: function (who) {
      this.chat_to_who = who;
      this.chat_to_all = false;
      this.mark_read_messages_from_someone(who);
    },
    chat_send: function () {
      if (this.chat_to_all == true) {
        chat_to_all(this.user_id, this.chat_send_text);
      } else {
        chat_to_someone(this.user_id, this.chat_to_who, this.chat_send_text);
      }
    },
    online_friends: function () {
      // this.friends.filter( function(e){ return this.online_users.includes(e); } );
      return $(this.friends).filter(this.online_users).toArray();//jq 兩個array的交集
    },
    offline_friends: function () {
      // this.friends.filter( function(e){ return !this.online_users.includes(e); } );
      return $(this.friends).not(this.online_users).toArray();//jq 兩個array的差集
    },
    messages_to_all: function () {
      return this.messages.filter(function (msg) { //msg代表messages陣列裡的每一個物件 filter讓接到的物件跑一遍
        return msg.chat_type == "ALL";
      });
    },
    messages_to_someone: function (who) {
      return this.messages.filter(function (msg) {
        return msg.chat_type == "USER" && (msg.user_id == who || msg.chat_to == who);
      });
    },
    unread_messages_from_someone: function (who) {
      return this.messages.filter(function (msg) {
        return msg.chat_type == "USER" && msg.user_id == who && msg.is_read == false;
      });
    },
    mark_read_messages_from_someone: function (who) {
      this.unread_messages_from_someone(who).forEach(function (msg) { msg.is_read = true });
    },
    refresh_friends: function() {
      // call myFriend
      const xhr = new XMLHttpRequest();
      xhr.onload = () => {
        if (xhr.status == 200) {
          var resp = JSON.parse(xhr.responseText);
          console.log("got friend list.", resp);
          var pending_friends = [];
          var waiting_friends = [];
          var friends = [];
          resp.forEach(function(e){
            if(e.status == "0"){
              if(e.requester == chat_app.user_id){
                waiting_friends.push(e.mem_name);
              }else{
                pending_friends.push(e.mem_name);
              }
            } else {
              friends.push(e.mem_name);
            }
          });
          chat_app.friends = friends;
          chat_app.pending_friends = pending_friends;
          chat_app.waiting_friends = waiting_friends;
        } else {
          console.error("refresh_friends failed.", xhr.status);
        }
      };
      const url = `myFriend.php?mem_name=${this.user_id}`;
      xhr.open("get", url, true);
      xhr.send(null);
    },
    // 登入 增加登入成功&錯誤功能
    login_btn: function() {
      const xhr = new XMLHttpRequest();
      xhr.onload = () => {
        if (xhr.status == 200) {
          var resp = JSON.parse(xhr.responseText);
          $(".loginBox").css({ display: "none" });
          const loginSquid = document.querySelector(".loginSquid #myRole");
          login(resp.mem_name,resp.style_no,resp.mem_lv,resp.mem_avatar,resp.squid_qty);
          //console.log(resp);
          //登入後清空表單
          $("#login_mem_name").val('');
          $("#login_mem_pwd").val('');
        } else {
          if(xhr.status == 401){
            $("#login_failMsg").html("帳號密碼錯誤");
          }else{
            alert(xhr.status);
          }
        }
      };
    
      const mem_name = $("#login_mem_name").val();
      const mem_pwd = $("#login_mem_pwd").val();
      const url = `login.php?mem_name=${mem_name}&mem_pwd=${mem_pwd}`;
      xhr.open("get", url, true);
      xhr.send(null);
    },
    //loginBtn enter後登入
    login_enter: function(e){
      if(e.keyCode== 13 ){
        this.login_btn();
      }
    },
    //登出按鈕
    logout:function(){
      this.user_id="";
      $(".loginBox").css({ display: "flex" });
      if(conn_chat.readyState === WebSocket.OPEN){
        conn_chat.close();
      }
      initWebsocketServer();
      $.get("logout.php");
    },
    // 上帝模式
    god_mode: function() {
      $(".loginBox").css({ display: "none" });
    },
    // 創角
    create_role: function() {
      $(".loginBox").css({ display: "none" });
      $(".createBox").css({ display: "flex" });
    },
    calcPosition() {
      const { innerWidth, innerHeight } = window;
      return {
        top : 100 + Math.random() * (innerHeight - 300) + 'px',
        left: Math.random() * (innerWidth - 200) + 'px'
      }
    }
  }
});
var onMessageListener = function (e) {
  // 收到server傳過來的訊息
  // console.log(e)裡面好多東西喔~;
  var resp_obj = JSON.parse(e.data); //字串轉json
  // console.log("回傳的JSON物件",resp_obj);
  console.log("收到訊息，訊息類型", resp_obj.msg_type);
  switch (resp_obj.msg_type) {
    case 'CHAT': //聊天的訊息
      console.log('把資料塞到泡泡裡', resp_obj);
      console.log('把資料更新到聊天視窗', resp_obj);
      chat_app.messages.push(resp_obj);
      break;
    case 'ONLINE_USERS':
      console.log('更新目前有哪些人在線上', resp_obj.users);
      chat_app.online_users = resp_obj.users;
      for(online_user in chat_app.online_users){
        var xhr = new XMLHttpRequest();
        xhr.onload=function (e){
          if(e.currentTarget.status == 200){
            var resp = JSON.parse(e.currentTarget.responseText);
            chat_app.online_users_info.push(resp);
          }else{
              console.error( '更新目前有哪些人在線上 error.', e );
          }
        }
        
        var url = "getRole.php?mem_name="+chat_app.online_users[online_user];
        xhr.open("Get", url, true);
        xhr.send( null );
      }
      break;
    case 'USER_OFFLINE':
      console.log('把使用者狀態改成下線', resp_obj.user_id);
      chat_app.user_offline(resp_obj.user_id);
      break;
    case 'USER_ONLINE':
      console.log('有人上線了', resp_obj.user_id);
      chat_app.user_online(resp_obj.user_id);
      break;

    default:
      console.error('收到不認得的msg_type', resp_obj);
  }
};
function initWebsocketServer() {
  conn_chat = new WebSocket('ws://35.229.227.58/chat');
  conn_chat.onopen = function (e) {
    console.log('已連到伺服器');
    if(chat_app.is_login()){
      conn_chat.send(
        JSON.stringify(
          { "msg_type": "LOGIN", "user_id": chat_app.user_id }
        )
      );
    
      conn_chat.send(
        JSON.stringify(
          {
            "msg_type": "GET_ONLINE_USERS",
            "user_id": chat_app.user_id
          }
        )
      )
    }
  };
  conn_chat.onclose = function (e) {
    console.log('已close伺服器');
  };
  conn_chat.onmessage = onMessageListener;
}
function login(user_id,style_no,mem_lv,mem_avatar,squid_qty) {
  // 告訴server我的user_id
  console.log(user_id);
  chat_app.user_id = user_id;
  chat_app.style_no = style_no;
  chat_app.mem_lv = mem_lv;
  chat_app.mem_avatar = mem_avatar;
  chat_app.squid_qty = squid_qty;

  chat_app.refresh_friends();

  if(conn_chat.readyState === WebSocket.OPEN) {
    conn_chat.send(
      JSON.stringify(
        { "msg_type": "LOGIN", "user_id": user_id }
      )
    );
  
    conn_chat.send(
      JSON.stringify(
        {
          "msg_type": "GET_ONLINE_USERS",
          "user_id": user_id
        }
      )
    )
  }
}
function chat_to_someone(user_id, to, msg) {
  conn_chat.send(
    JSON.stringify(
      {
        "msg_type": "CHAT",
        "user_id": user_id,
        "chat_type": "USER",
        "chat_to": to,
        "chat_msg": msg,
        "is_read": false
      }
    )
  );
}
function chat_to_all(user_id, msg) {
  conn_chat.send(
    JSON.stringify(
      {
        "msg_type": "CHAT",
        "user_id": user_id,
        "chat_type": "ALL",
        "chat_msg": msg
      }
    )
  );
}

$(document).ready(function () {
  initWebsocketServer();
});