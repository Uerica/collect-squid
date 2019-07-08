function init() {
  // RWD
  window.addEventListener("resize", gameSizing);
  menuMobileTransform();
  regis();
  cancelRegis();
  confirmRegis();
  cancelRaise();
  confirmRaise();

  $(".myEvents .eventDescs").scroll(function() {
    let s = $(this).scrollTop();
    let h = $(this).height();
    let ratio = (s / h) * 100;
    let movePercent;
    if (innerWidth < 737) {
      movePercent = 10 + ratio / 10;
    } else if (innerWidth < 1500) {
      movePercent = 15 + ratio / 5;
    } else {
      movePercent = 15 + ratio / 3;
    }
    $(".rightHand").css({ top: `${movePercent}%` });
  });
}

// 一屏畫面 RWD
function gameSizing() {
  let bodySize = [];
  let htmlSize = [];
  if (innerWidth / innerHeight > 1.75) {
    bodySize[0] = document.body.clientWidth;
    bodySize[1] = document.body.clientHeight;
    htmlSize[0] = document.documentElement.clientWidth;
    htmlSize[1] = document.documentElement.clientHeight;
    querySize("body", htmlSize[0], htmlSize[1]);
  } else {
    querySize("body", bodySize[0], bodySize[1]);
  }
}

function querySize(tag, w, h) {
  document.querySelector(tag).style.width = w + "px";
  document.querySelector(tag).style.height = h + "px";
}

// 手機選單動畫
function menuMobileTransform() {
  $(".menuMobile_link").click(function(e) {
    e.preventDefault();

    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

function regis() {
  $(".eventsWrapper input").click(() =>
    $(".regisBox").css({ display: "flex" })
  );
}

function cancelRegis() {
  $(".regisBox .cancelBtn").click(() =>
    $(".regisBox").css({ display: "none" })
  );
}

function confirmRegis() {
  $(".regisBox input").click(() => {
    $(".regisBox").css({ display: "none" });
  });
}

function cancelRaise() {
  $(".raiseBox .cancelBtn").click(() => {
    $(".raiseBox").css({ display: "none" });
  });
}

function confirmRaise() {
  $(".raiseBox .submitWrapper input").click(() => {
    console.log($(this));
    $(".raiseBox").css({ display: "none" });
  });
}

window.onload = init;
