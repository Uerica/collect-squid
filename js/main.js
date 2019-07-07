// 聊天室移動畫面
const SCROLLAREA = {
  width: 120,
  height: 120,
  minSpeed: 1.2,
  maxSpeed: 6,
  currentSpeed: 0,
};

let needToScrollLeft = false;
let needToScrollRight = false;
let needToScrollBottom = false;
let needToScrollTop = false;



// 手機選單動畫
function menuMobileTransform() {
  $(".menuMobile_link").click(function (e) {
    e.preventDefault();

    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

// 好友點擊切換
function chooseFriend() {
  document.querySelectorAll('.friendList_friend').forEach(e => {
    e.addEventListener('mouseover', e => {
      e.target.style = "cursor: pointer";
      e.stopPropagation();
    });
    e.addEventListener('click', e => {
      e.stopPropagation();
    })
  });
}

// 開關聊天室
function collapseChatGroup() {
  $(".friendList_open").click(function (e) {
    e.preventDefault();

    $(".chatGroup").toggleClass("collapse");
  })

  $(".closeBtn").click(function (el) {
    el.preventDefault();
    $(".closeBtn").css('cursor', 'pointer');
    $(".chatGroup").toggleClass("collapse");
  })
}

// 開關通知
function collaseNotifications() {
  let actionBox = $(".notifications_actionBox");
  $(".button-notifications").click(function (e) {
    $(".notifications_container").toggleClass("collapse");
    if (actionBox.css('border-radius') == '0px 10px 10px 0px') {
      $(".notifications_actionBox").css('border-radius', '0');
    } else {
      $(".notifications_actionBox").css('border-radius', '0px 10px 10px 0px');
    }
  })
}

// 聊天室視窗移動
function moveScene(e) {
  // console.log(e.target);
  if (!e.target) { return; }
  let rootElement = e.target;
  while (true) {
    if (!rootElement) { return false; }
    if (rootElement === document.body || rootElement.parentElement === document.body) { break; }
    rootElement = rootElement.parentElement;
  }
  if (rootElement.classList.contains("disabledScrollOnHover")) {
    needToScrollLeft = false;
    needToScrollRight = false;
    needToScrollBottom = false;
    needToScrollTop = false;
    return false;
  }
  const x = e.clientX;
  const y = e.clientY;
  // console.log(x, y);

  const { innerWidth, innerHeight } = window;
  // console.log(innerWidth);
  if (x < SCROLLAREA.width) {
    const currentRatio = (SCROLLAREA.width - x) / SCROLLAREA.width; //比例
    const speed = (SCROLLAREA.maxSpeed * currentRatio);
    SCROLLAREA.currentSpeed = (speed < SCROLLAREA.minSpeed) ? SCROLLAREA.minSpeed : speed;
    needToScrollLeft = true;
  } else {
    needToScrollLeft = false;
  }


  if (x > innerWidth - SCROLLAREA.width) {
    // const currentRatio = (innerWidth - x) / SCROLLAREA.width; // 120的幾分之幾 -> 比例
    const currentRatio = 1 - (innerWidth - x) / SCROLLAREA.width;
    const speed = (SCROLLAREA.maxSpeed * currentRatio);
    SCROLLAREA.currentSpeed = (speed < SCROLLAREA.minSpeed) ? SCROLLAREA.minSpeed : speed;
    needToScrollRight = true;
  } else {
    needToScrollRight = false;
  }


  if (y > innerHeight - SCROLLAREA.height) {
    const currentRatio = 1 - (innerHeight - y) / SCROLLAREA.height;
    const speed = (SCROLLAREA.maxSpeed * currentRatio);
    SCROLLAREA.currentSpeed = (speed < SCROLLAREA.minSpeed) ? SCROLLAREA.minSpeed : speed;
    needToScrollBottom = true;
  } else {
    needToScrollBottom = false;
  }


  let navHeight = document.querySelector('.common_header').offsetHeight;
  const lowerBound = SCROLLAREA.height + navHeight;
  if (y > navHeight && y < lowerBound) {
    const currentRatio = (lowerBound - y) / SCROLLAREA.height; //比例
    const speed = (SCROLLAREA.maxSpeed * currentRatio);
    SCROLLAREA.currentSpeed = (speed < SCROLLAREA.minSpeed) ? SCROLLAREA.minSpeed : speed;
    needToScrollTop = true;
  } else {
    needToScrollTop = false;
  }
}

// 聊天室視窗移動計時器
function scrollLeftTimer() {
  setInterval(() => {
    if (needToScrollLeft) {
      document.scrollingElement.scrollLeft -= SCROLLAREA.currentSpeed;
    }
    if (needToScrollRight) {
      document.scrollingElement.scrollLeft += SCROLLAREA.currentSpeed;
    }
    if (needToScrollBottom) {
      document.scrollingElement.scrollTop += SCROLLAREA.currentSpeed;
    }
    if (needToScrollTop) {
      document.scrollingElement.scrollTop -= SCROLLAREA.currentSpeed;
    }
  }, 12);
}

function loginBoxNoScroll() {
  var elems = document.body.getElementsByClassName("loginBox");
  // console.log(elems);
  var len = elems.length

  for (var i = 0; i < len; i++) {

    if (window.getComputedStyle(elems[i], null).getPropertyValue('position') == 'fixed') {
      console.log(elems[i])
    }

  }
}


function resizeScreen() {
  let bodySize = [];
  let htmlSize = [];
  window.addEventListener("resize", function () {
    if (innerWidth / innerHeight > 1.75) {
      bodySize[0] = document.body.clientWidth;
      bodySize[1] = document.body.clientHeight;
      htmlSize[0] = document.documentElement.clientWidth;
      htmlSize[1] = document.documentElement.clientHeight;
      gameSizing("body", htmlSize[0], htmlSize[1]);
      // gameObject("gameObject", htmlSize[0], htmlSize[1]);
    } else {
      gameSizing("body", bodySize[0], bodySize[1]);
      // gameObject("gameObject", bodySize[0], bodySize[1]);
    }
  });
}

function gameSizing(tag, w, h) {
  document.querySelector(tag).style.width = w + "px";
  document.querySelector(tag).style.height = h + "px";
}

function gameObject(tag, w, h) {
  let mapItems = document.querySelectorAll('.gameWorld_object');
  var mapItemsLength = mapItems.length;
  for (var i = 0; i < mapItemsLength; i++) {
    document.querySelectorAll(tag).style.width = w + "px";
    document.querySelectorAll(tag).style.height = h + "px";
  }
}


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


$(document).ready(function () {
  resizeScreen();
});


window.addEventListener('load', function () {
  menuMobileTransform();
  chooseFriend();
  collapseChatGroup();
  scrollLeftTimer();
  collaseNotifications();
  loginBoxNoScroll();
});

window.addEventListener('mousemove', function (e) {
  // moveScene(e);
});

