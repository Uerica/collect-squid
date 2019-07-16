// 即時聊天
//vuejs & websocket
var conn_chat;
var chat_app = new Vue({
  el: '#chat_app',
  data: {
    user_id: '',
    friends: ['董董', '曲翑', '揉揉', '詩詩', '華姐'],
    online_users: [],
    chat_to_all: true,
    chat_to_who: '',
    messages: [],//存server回傳的物件
    chat_send_text: ''
  },
  methods: {
    user_online: function (user) {
      this.online_users.push(user);
    },
    user_offline: function (user) {
      this.online_users = this.online_users.filter(function (e) { return e != user });
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
  };
  conn_chat.onclose = function (e) {
    console.log('已close伺服器');
  };
  conn_chat.onmessage = onMessageListener;
}
function login() {
  var user_id = $('#memId').val();
  // 告訴server我的user_id
  chat_app.user_id = user_id;
  $('.loginBox').css('display', 'none');
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