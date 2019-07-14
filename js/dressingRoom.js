function init() {
  // RWD
  window.addEventListener("resize", gameSizing);

  // 按鈕
  $(".lightBox").css({ display: "none" });
  $("#startBtn").click(startDraw);
  $(".whiteShirt").click(startDraw);
  $("#cancelBtn").click(cancel);
  $("#confirmBtn").click(saveImg);
  activeOwl();
  // displayBar();
  targetCaro();
  menuMobileTransform();
  drawingClothes();

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

// function confirm() {
//   $(".lightBox").css({ display: "none" });
// }

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

function setColor() {
  var hue = document.querySelector(".colorPicker").value;
  return `hsl(${hue}, 100%, 50%)`;
}

function drawingClothes() {
  let strokeColor;
  $(".colorPicker").change(() => (strokeColor = setColor()));

  let strokeWidth;
  $("#2w").click(() => (strokeWidth = 2));
  $("#5w").click(() => (strokeWidth = 5));
  $("#8w").click(() => (strokeWidth = 8));
  $("#12w").click(() => (strokeWidth = 12));
  $("#20w").click(() => (strokeWidth = 20));

  const canvas = document.querySelector(".drawingFrame");
  canvas.width = 420;
  canvas.height = 250;

  const context = canvas.getContext("2d");

  let whiteShirt = new Image();
  whiteShirt.src = "imgs/dressingRoom/whiteShirt.png";
  whiteShirt.addEventListener("load", function() {
    context.drawImage(
      whiteShirt,
      25,
      25,
      canvas.width - 50,
      canvas.height - 50
    );
  });

  let painting = false;

  function startPosition(e) {
    painting = true;
    draw(e);
  }

  function finishedPosition() {
    painting = false;
    context.beginPath();
  }

  function draw(e) {
    if (!painting) return;
    context.lineWidth = strokeWidth;
    context.lineCap = "round";
    context.strokeStyle = `${strokeColor}`;

    const canLeft = $(".drawingFrame").offset().left + 10;
    const canTop = $(".drawingFrame").offset().top;
    context.lineTo(e.clientX - canLeft, e.clientY - canTop);
    context.stroke();
    context.beginPath();
    context.moveTo(e.clientX - canLeft, e.clientY - canTop);
  }

  canvas.addEventListener("mousedown", startPosition);
  canvas.addEventListener("mouseup", finishedPosition);
  canvas.addEventListener("mousemove", draw);

  document.getElementById("clearAll").addEventListener("click", () => {
    context.clearRect(0, 0, canvas.width, canvas.height);
    let whiteShirt = new Image();
    whiteShirt.src = "imgs/dressingRoom/whiteShirt.png";
    whiteShirt.addEventListener("load", function() {
      context.drawImage(
        whiteShirt,
        25,
        25,
        canvas.width - 50,
        canvas.height - 50
      );
    });
  });
}

function saveImg() {
  const canvas = document.querySelector(".drawingFrame");
  const dataURL = canvas.toDataURL("image/png");
  document.querySelector("#drawnImage").value = dataURL;
  const formData = new FormData(document.getElementById("drawingForm"));

  const xhr = new XMLHttpRequest();

  xhr.onload = () => {
    if (xhr.status == 200) {
      if (xhr.responseText == "error") {
        alert("Error");
      } else {
        alert("Successfully uploaded");
      }
    } else {
      alert(xhr.status);
    }
  };

  xhr.open("POST", "drawingFinished.php", true);
  xhr.send(formData);
}

window.onload = init;
