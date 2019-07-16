// 聊天室移動畫面
const SCROLLAREA = {
  width: 120,
  height: 120,
  minSpeed: 1.2,
  maxSpeed: 6,
  currentSpeed: 0,
};

let chatHover;

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

// 登入視窗不捲動
function loginBoxNoScroll() {
  var elems = document.body.getElementsByClassName("loginBox");
  // console.log(elems);
  var len = elems.length

  for (var i = 0; i < len; i++) {

    if (window.getComputedStyle(elems[i], null).getPropertyValue('position') == 'fixed') {
      // console.log(elems[i])
    }

  }
}

// 我的房間&活動巴士換頁
function switchPage() {
  $(".gameWorld_house").click(function (e) {
    e.preventDefault();
    $(".checkBox-room").toggleClass("collapse");
  });

  $(".gameWorld_bus").click(function (e) {
    e.preventDefault();
    $(".checkBox-event").toggleClass("collapse");
  });

  $("#btnCancel-room").click(function (e) {
    e.preventDefault();
    $(".checkBox-room").toggleClass("collapse");
  });

  $("#btnCancel-event").click(function (e) {
    e.preventDefault();
    $(".checkBox-event").toggleClass("collapse");
  });
}

// 聊天室按鈕動畫
function chatBtnMousemove() {
  $('.friendList_open').mouseenter(function () {
    if (isMobileDevice()) {
      return false;
    }
    $('.friendList_openBtn').css('transform', 'translateY(0)');
    clearTimeout(chatHover);
  })
  $('.friendList_open').mouseleave(function () {
    chatHover = setTimeout(() => {
      $('.friendList_openBtn').css('transform', 'translateY(100%)');
    }, 600);
  })
}

// 判斷是否為行動裝置
function isMobileDevice() {
  try {
    document.createEvent('TouchEvent');
    return true;
  } catch {
    return false;
  }
}

// 游標
function cursorAnimated() {
  let cursor = document.querySelector(".common_cursor");
  document.addEventListener('mousemove', c => {
    cursor.setAttribute('style', 'top:' + c.pageY + 'px;' + 'left:' + c.pageX + 'px;')
  })
}

function animation() {
  // smoke------------------------------------------------
  var smoke = document.getElementById("smoke");
  for (var i = 0; i < 20; i++) {//煙的數量
    var smokeDiv = document.createElement("div");
    smoke.appendChild(smokeDiv);
    smokeDiv.setAttribute("class", "particle");
  }
  // smoke------------------------------------------------
  // spray------------------------------------------------
  function spray() {
    var Particle, canvas, colors, createParticle, ctx, gravity, height, initParticles, particles, render, width;
    canvas = document.getElementById('spray');
    ctx = canvas.getContext('2d');
    width = canvas.width = 600;
    height = canvas.height = 600;
    particles = [];
    colors = ['#029DAF', '#E5D599', '#FFC219', '#F07C19', '#E32551'];
    gravity = 0.04;

    initParticles = function () {
      var i = 0;
      while (i < 200) {
        setTimeout(createParticle, 20 * i, i);
        i++;
      }
    }

    createParticle = function (i) {
      var color, opacity, p, size, vx, vy, x, y;
      x = width * 0.5;
      y = height * 0.5;
      vx = -2 + Math.random() * 4;
      vy = Math.random() * -3;
      size = 5 + Math.random() * 5;
      color = colors[i % colors.length];
      opacity = 0.5 + Math.random() * 0.5;
      p = new Particle(x, y, vx, vy, size, color, opacity);
      particles.push(p);
    }

    Particle = function (x, y, vx, vy, size, color, opacity) {
      function reset() {
        x = width * 0.5;
        y = height * 0.5;
        opacity = 0.5 + Math.random() * 0.5;
        vx = -2 + Math.random() * 4;
        vy = Math.random() * -3;
      }
      this.update = function () {
        if (opacity - 0.005 > 0) {
          opacity -= 0.005;
        } else {
          reset();
        }
        vy += gravity;
        x += vx;
        y += vy;
      };
      this.draw = function () {
        ctx.globalAlpha = opacity;
        ctx.fillStyle = color;
        ctx.fillRect(x, y, size, size);
      }
    }

    render = function () {
      ctx.clearRect(0, 0, width, height);
      var i = 0;
      while (i < particles.length) {
        particles[i].update();
        particles[i].draw();
        i++;
      }
      requestAnimationFrame(render);
    }

    initParticles();
    render();

    sprayTimer();

    function sprayTimer() {
      var time = 2000;
      a = setTimeout(sprayOpacity, time);
      function sprayOpacity() {
        canvas.style.opacity = 0;
        setTimeout(() => canvas.style.opacity = 1, time);
        setTimeout(sprayOpacity, time * 2);
      }
    }
  }
  spray();
  // spray------------------------------------------------
}


window.addEventListener('load', function () {
  menuMobileTransform();
  chooseFriend();
  collapseChatGroup();
  scrollLeftTimer();
  collaseNotifications();
  loginBoxNoScroll();
  switchPage();
  chatBtnMousemove();
  cursorAnimated();
  animation();
});

window.addEventListener('mousemove', function (e) {
  // moveScene(e);
});




// function gameSizing(tag, w, h) {
//   document.querySelector(tag).style.width = w + "px";
//   document.querySelector(tag).style.height = h + "px";
// }

// function gameObject(tag, w, h) {
//   let mapItems = document.querySelectorAll('.gameWorld_object');
//   var mapItemsLength = mapItems.length;
//   for (var i = 0; i < mapItemsLength; i++) {
//     document.querySelectorAll(tag).style.width = w + "px";
//     document.querySelectorAll(tag).style.height = h + "px";
//   }
// }
