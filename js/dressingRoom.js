function init() {
  // RWD
  window.addEventListener("resize", gameSizing);

  // 按鈕
  $(".lightBox").css({ display: "none" });
  $("#startBtn").click(startDraw);
  $(".whiteShirt").click(startDraw);
  $("#cancelBtn").click(cancel);
  $("#confirmBtn").click(confirm);
  activeOwl();
  displayBar();
  targetCaro();
  menuMobileTransform();

  // 換服裝
  // 帽子
  $(".changeHat img").click(function() {
    let hatSrc = $(this).attr("src");
    $(".changedHat").attr("src", hatSrc);
  });
  // 衣服
  $(".changeClo img").click(function() {
    let clothSrc = $(this).attr("src");
    $(".changedClo").attr("src", clothSrc);
  });
  // 鞋子
  $(".changeShoes img").click(function() {
    let shoesSrc = $(this).attr("src");
    $(".changedShoes").attr("src", shoesSrc);
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

// 貓頭鷹幻燈片
function activeOwl() {
  $(".owl-carousel").owlCarousel({
    loop: false,
    nav: true,
    responsive: {
      0: {
        items: 2
      },
      1000: {
        items: 3
      }
    },
    dots: false
  });
}

// 幻燈片動畫
function targetCaro() {
  // 向左
  $(".hats .owl-prev").click(() => caroAnima(".hats img", -20));
  $(".clothes .owl-prev").click(() => caroAnima(".clothes img", -20));
  $(".shoes .owl-prev").click(() => caroAnima(".shoes img", -20));
  // 向右
  $(".hats .owl-next").click(() => caroAnima(".hats img", 20));
  $(".clothes .owl-next").click(() => caroAnima(".clothes img", 20));
  $(".shoes .owl-next").click(() => caroAnima(".shoes img", 20));
}

function caroAnima(className, skewX) {
  const imgs = document.querySelectorAll(className);
  for (let i = 0; i < imgs.length; i++) {
    TweenMax.from(imgs[i], 2, {
      skewX,
      ease: Elastic.easeOut.config(1, 0.2),
      transformOrigin: "bottom"
    });
  }
}

// 顏色選擇器
function displayBar() {
  let r = 255;
  let g = 0;
  let b = 0;

  while (b < 255) {
    b++;
    addColor(r, g, b);
  }
  while (r > 0) {
    r--;
    addColor(r, g, b);
  }
  while (g < 255) {
    g++;
    addColor(r, g, b);
  }
  while (b > 0) {
    b--;
    addColor(r, g, b);
  }
  while (r < 255) {
    r++;
    addColor(r, g, b);
  }
  while (g > 0) {
    g--;
    addColor(r, g, b);
  }
}

function addColor(r, g, b) {
  const hex = dechex(r) + dechex(g) + dechex(b);
  $("#colorPicker").append(
    `<span id="${hex}" style="background-color:#${hex}"</span>`
  );
}

// 換服裝
function changeSuit(suitSrc) {
  let src = $(this).attr("src");
  $(suitSrc).attr("src", src);
}

function startDraw() {
  $(".lightBox").css({ display: "flex" });
}

function cancel() {
  $(".lightBox").css({ display: "none" });
}

function confirm() {
  $(".lightBox").css({ display: "none" });
}

function dechex(dec) {
  var hex = dec.toString(16);
  if (hex.length == 1) hex = "0" + hex;
  return hex;
}

// 手機選單動畫
function menuMobileTransform() {
  $(".menuMobile_link").click(function(e) {
    e.preventDefault();

    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

window.onload = init;
