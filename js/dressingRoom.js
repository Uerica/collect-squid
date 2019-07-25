let style_no;
let style_moving_no;

function init() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (xhr.status == 200) {
      style_no = xhr.responseText;
      style_moving_no = xhr.responseText.replace("myRole", "myRole_moving");
      console.log(style_no);
    } else {
      alert(xhr.status);
    }
  };

  const url = "prepareToDress.php";
  xhr.open("get", url, true);
  xhr.send(null);

  // RWD
  window.addEventListener("resize", gameSizing);

  // 按鈕
  $(".lightBox").css({ display: "none" });
  $("#startBtn").click(startDraw);
  $(".whiteShirt").click(startDraw);
  $("#cancelBtn").click(cancel);
  $("#confirmBtn").click(saveImg);
  $("#confirmDressing").click(saveDressing);
  $("#confirmDressing").click(function() {
    setTimeout(saveDressingMoving, 10);
  });
  activeOwl();
  // displayBar();
  targetCaro();
  menuMobileTransform();
  drawingClothes();

  let hatSrc = "imgs/dressingRoom/furHat.png";
  let clothSrc = "imgs/dressingRoom/cowBoyClo.png";
  let shoesSrc = "imgs/dressingRoom/whiteShoes.png";

  // 換服裝
  // 帽子
  $(".changeHat img").click(function() {
    hatSrc = $(this).attr("src");
    $(".changedHat").attr("src", hatSrc);
    dressingCanvas(shoesSrc, clothSrc, hatSrc);
    dressingCanvasMoving(shoesSrc, clothSrc, hatSrc);
  });
  // 衣服
  $(".changeClo img").click(function() {
    clothSrc = $(this).attr("src");
    $(".changedClo").attr("src", clothSrc);
    dressingCanvas(shoesSrc, clothSrc, hatSrc);
    dressingCanvasMoving(shoesSrc, clothSrc, hatSrc);
  });
  // 鞋子
  $(".changeShoes img").click(function() {
    shoesSrc = $(this).attr("src");
    $(".changedShoes").attr("src", shoesSrc);
    dressingCanvas(shoesSrc, clothSrc, hatSrc);
    dressingCanvasMoving(shoesSrc, clothSrc, hatSrc);
  });

  // dressingCanvas();
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

function dressingCanvas(inShoes, inClo, inHat) {
  const dressingZone = document.querySelector("#dressingCanvas");
  dressingZone.width = 286;
  dressingZone.height = 613;
  const dW = dressingZone.width;
  const dH = dressingZone.height;
  const dressingCtx = dressingZone.getContext("2d");
  // dressingCtx.globalCompositeOperation = "destination-over";
  let shoes = new Image();
  // shoes.src = "imgs/dressingRoom/whiteShoes.png";
  shoes.src = inShoes;
  shoes.addEventListener("load", function() {
    dressingCtx.drawImage(shoes, 0, dH * 0.928, dW, dH * 0.0685);
  });
  setTimeout(function() {
    let squid = new Image();
    // squid.src = "imgs/dressingRoom/squid_center.png";
    squid.src = style_no;
    squid.addEventListener("load", function() {
      dressingCtx.drawImage(squid, 0, dH * 0.165, dW, dH * 0.795);
    });
  }, 10);
  setTimeout(function() {
    let clo = new Image();
    clo.src = inClo;
    clo.addEventListener("load", function() {
      dressingCtx.drawImage(clo, dW * 0.158, dH * 0.66, dW * 0.685, dH * 0.185);
    });
  }, 20);
  setTimeout(function() {
    let hat = new Image();
    hat.src = inHat;
    hat.addEventListener("load", function() {
      dressingCtx.drawImage(hat, dW * 0.077, 0, dW * 0.846, dH * 0.303);
    });
  }, 20);
}

// 有動作穿衣服
function dressingCanvasMoving(inShoes, inClo, inHat) {
  const dressingZone = document.querySelector("#dressingCanvas_moving");
  dressingZone.width = 286;
  dressingZone.height = 613;
  const dW = dressingZone.width;
  const dH = dressingZone.height;
  const dressingCtx = dressingZone.getContext("2d");
  // dressingCtx.globalCompositeOperation = "destination-over";
  // dressingCtx.translate(30, 0);
  // dressingCtx.rotate((30 * Math.PI) / 180);
  // dressingCtx.translate(-30, 0);
  // dressingCtx.rotate((-30 * Math.PI) / 180);
  let shoes = new Image();
  // shoes.src = "imgs/dressingRoom/whiteShoes.png";
  shoes.src = inShoes.replace(".png", "Moving.png");
  shoes.addEventListener("load", function() {
    dressingCtx.drawImage(shoes, 4, dH * 0.93, dW, dH * 0.0685);
  });
  setTimeout(function() {
    let squid = new Image();
    // squid.src = "imgs/dressingRoom/squid_center.png";
    squid.src = style_moving_no;
    squid.addEventListener("load", function() {
      dressingCtx.drawImage(squid, 0, dH * 0.165, dW, dH * 0.795);
    });
  }, 10);
  setTimeout(function() {
    let clo = new Image();
    clo.src = inClo;
    clo.addEventListener("load", function() {
      dressingCtx.drawImage(clo, dW * 0.158, dH * 0.66, dW * 0.685, dH * 0.185);
    });
  }, 20);
  setTimeout(function() {
    let hat = new Image();
    hat.src = inHat;
    hat.addEventListener("load", function() {
      dressingCtx.drawImage(hat, dW * 0.077, 0, dW * 0.846, dH * 0.303);
    });
  }, 20);
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

  const drawingCanvas = document.querySelector(".drawingFrame");
  drawingCanvas.width = 420;
  drawingCanvas.height = 250;

  const drawingCtx = drawingCanvas.getContext("2d");

  let whiteShirt = new Image();
  whiteShirt.src = "imgs/dressingRoom/whiteShirt.png";
  whiteShirt.addEventListener("load", function() {
    drawingCtx.drawImage(
      whiteShirt,
      25,
      25,
      drawingCanvas.width - 50,
      drawingCanvas.height - 50
    );
  });

  let painting = false;

  function startPosition(e) {
    painting = true;
    draw(e);
  }

  function finishedPosition() {
    painting = false;
    drawingCtx.beginPath();
  }

  function draw(e) {
    if (!painting) return;
    drawingCtx.lineWidth = strokeWidth;
    drawingCtx.lineCap = "round";
    drawingCtx.strokeStyle = `${strokeColor}`;

    const canLeft = $(".drawingFrame").offset().left + 10;
    const canTop = $(".drawingFrame").offset().top;
    drawingCtx.lineTo(e.clientX - canLeft, e.clientY - canTop);
    drawingCtx.stroke();
    drawingCtx.beginPath();
    drawingCtx.moveTo(e.clientX - canLeft, e.clientY - canTop);
  }

  drawingCanvas.addEventListener("mousedown", startPosition);
  drawingCanvas.addEventListener("mouseup", finishedPosition);
  drawingCanvas.addEventListener("mousemove", draw);

  document.getElementById("clearAll").addEventListener("click", () => {
    drawingCtx.clearRect(0, 0, drawingCanvas.width, drawingCanvas.height);
    let whiteShirt = new Image();
    whiteShirt.src = "imgs/dressingRoom/whiteShirt.png";
    whiteShirt.addEventListener("load", function() {
      drawingCtx.drawImage(
        whiteShirt,
        25,
        25,
        drawingCanvas.width - 50,
        drawingCanvas.height - 50
      );
    });
  });
}

function saveImg() {
  const drawingCanvas = document.querySelector(".drawingFrame");
  const dataURL = drawingCanvas.toDataURL("image/png");
  document.querySelector("#drawnImage").value = dataURL;
  const formData = new FormData(document.getElementById("drawingForm"));

  const xhr = new XMLHttpRequest();

  xhr.onload = () => {
    if (xhr.status == 200) {
      if (xhr.responseText == "error") {
        alert("Error");
      } else {
        // alert("Successfully uploaded");
      }
    } else {
      alert(xhr.status);
    }
  };

  xhr.open("POST", "drawingFinished.php", true);
  xhr.send(formData);
}

function saveDressing() {
  const drawingCanvas = document.querySelector("#dressingCanvas");
  const dataURL = drawingCanvas.toDataURL("image/png");
  document.querySelector("#dressedSquid").value = dataURL;
  const formData = new FormData(document.getElementById("dressedForm"));

  const xhr = new XMLHttpRequest();

  xhr.onload = () => {
    if (xhr.status == 200) {
      if (xhr.responseText == "error") {
        alert("Error");
      } else {
        alert("上傳成功");
        $_SESSION["dressed_no"] = xhr.responseText;
      }
    } else {
      alert(xhr.status);
    }
  };

  xhr.open("POST", "dressedSquid.php", true);
  xhr.send(formData);
}

function saveDressingMoving() {
  const drawingCanvas = document.querySelector("#dressingCanvas_moving");
  const dataURL = drawingCanvas.toDataURL("image/png");
  document.querySelector("#dressedSquid_moving").value = dataURL;
  const formData = new FormData(document.getElementById("dressedForm_moving"));

  const xhr = new XMLHttpRequest();

  xhr.onload = () => {
    if (xhr.status == 200) {
      if (xhr.responseText == "error") {
        alert("Error");
      } else {
        // alert("Successfully uploaded");
        // $_SESSION["dressed_no"] = xhr.responseText;
      }
    } else {
      alert(xhr.status);
    }
  };

  xhr.open("POST", "dressedSquidMoving.php", true);
  xhr.send(formData);
}

window.onload = init;
