let head = "head1";
let face = "face1";
let color = "rgb(255, 141, 141)";
let boxHead = $(".headWrapper");
let boxBody = $(".bodyWrapper");
let boxFace = $(".faceWrapper");
createSquid(head, face, color);
setTimeout(() => createSquidMoving(head, face, color), 100);
// setTimeout(() => createSquidMoving(head, face, color), 100);

// 換 Canvas 和燈箱內頭型
const headImgs = document.querySelectorAll(".headItems img");
for (let i = 0; i < headImgs.length; i++) {
  headImgs[i].addEventListener("click", function(e) {
    const { src } = e.target;
    strIndex = src.indexOf("head");
    head = src.substr(strIndex, 5);
    createSquid(head, face, color);
    setTimeout(() => createSquidMoving(head, face, color), 100);
    boxHead.css({ maskImage: `url(imgs/createBox/${head}.svg)` });
  });
}

console.log("hello");

// 換 Canvas 和燈箱內臉型
const faceImgs = document.querySelectorAll(".faceItems img");
for (let i = 0; i < faceImgs.length; i++) {
  faceImgs[i].addEventListener("click", function(e) {
    const { src } = e.target;
    strIndex = src.indexOf("face");
    face = src.substr(strIndex, 5);
    createSquid(head, face, color);
    setTimeout(() => createSquidMoving(head, face, color), 100);
    document.querySelector(".faceWrapper img").src = src;
  });
}

// console.log(screen.orientation);
// 隱藏其他選單，顯示頭型/顏色/臉部選單
// 改頁籤顏色
$("#headStyle").click(function() {
  $(".changeStyle div").css({ visibility: "hidden" });
  $(".heads").css({ visibility: "visible" });
  active($(this));
});
$("#skinStyle").click(function() {
  $(".changeStyle div").css({ visibility: "hidden" });
  $(".skinColor").css({ visibility: "visible" });
  active($(this));
});
$("#faceStyle").click(function() {
  $(".changeStyle div").css({ visibility: "hidden" });
  $(".facialFeatures").css({ visibility: "visible" });
  active($(this));
});

let redNum = 255;
let greenNum = 141;
let blueNum = 141;

document.getElementById("redNum").oninput = function() {
  redNum = $("#redNum").val();
  color = `rgb(${redNum}, ${greenNum}, ${blueNum})`;
  createSquid(head, face, color);
  setTimeout(() => createSquidMoving(head, face, color), 100);
  boxHead.css({ backgroundColor: color });
  boxBody.css({ backgroundColor: color });
};
document.getElementById("greenNum").oninput = () => {
  greenNum = $("#greenNum").val();
  color = `rgb(${redNum}, ${greenNum}, ${blueNum})`;
  createSquid(head, face, color);
  setTimeout(() => createSquidMoving(head, face, color), 100);
  boxHead.css({ backgroundColor: color });
  boxBody.css({ backgroundColor: color });
};
document.getElementById("blueNum").oninput = () => {
  blueNum = $("#blueNum").val();
  color = `rgb(${redNum}, ${greenNum}, ${blueNum})`;
  createSquid(head, face, color);
  setTimeout(() => createSquidMoving(head, face, color), 100);
  boxHead.css({ backgroundColor: color });
  boxBody.css({ backgroundColor: color });
};

// 點圖換造型
// 換頭型
$(".headItems").click(function() {});
// 換臉型
$(".facialFeatures img").click(function() {
  const faceSrc = $(this).attr("src");
  $(".faceFeature").attr("src", faceSrc);
});

// 返回登錄鈕
$(".backToLoginBtn").click(function() {
  $(".createBox").css({ display: "none" });
  $(".loginBox").css({ display: "flex" });
});

function active(item) {
  item.siblings().removeClass("active");
  item.addClass("active");
}

// 手機橫向測試
// function reorient() {
//   var portrait = window.orientation % 180 == 0;
//   $("body > div").css(
//     "-webkit-transform",
//     !portrait ? "rotate(0deg)" : "rotate(90deg)"
//   );
//   $("header").css(
//     "-webkit-transform",
//     !portrait ? "rotate(0deg)" : "rotate(90deg)"
//   );
// }
// window.onorientationchange = reorient;
// window.setTimeout(reorient, 0);
// function reorient() {
//   var portrait = window.orientation % 180 == 0;
//   $("body > div").css(
//     "-webkit-transform",
//     !portrait ? "rotate(0deg)" : "rotate(90deg)"
//   );
//   $("header").css(
//     "-webkit-transform",
//     !portrait ? "rotate(0deg)" : "rotate(90deg)"
//   );
// }
// window.onorientationchange = reorient;
// window.setTimeout(reorient, 0);

// console.log(screen.orientation);
// console.log(screen.orientation.angle);

// window.onorientationchange = () => {
//   var portrait = window.orientation % 180 == 0;
//   $("body > div").css(
//     "-webkit-transform",
//     !portrait ? "rotate(0deg)" : "rotate(90deg)"
//   );
// };

function reorient() {
  var portrait = window.orientation % 180 == 0;
  $("body > div").css("-webkit-transform", !portrait ? "" : "rotate(-90deg)");
}
window.onorientationchange = reorient;
window.setTimeout(reorient, 0);

// 魷魚創角
function createSquid(head, face, color) {
  const roleCanvas = document.getElementById("roleCanvas");
  roleCanvas.width = 286;
  roleCanvas.height = 511;
  const fW = roleCanvas.width;
  const fH = roleCanvas.height;

  roleCtx = roleCanvas.getContext("2d");
  roleCtx.clearRect(0, 0, fW, fH);

  const bodyImg = new Image();
  const headImg = new Image();
  const faceImg = new Image();
  const cloImg = new Image();

  const body_p = document.getElementsByClassName("squidBody");
  for (let i = 0; i < body_p.length; i++) {
    body_p[i].style.fill = color;
  }
  const head_p = document.getElementsByClassName(`${head}_p`);
  for (let i = 0; i < head_p.length; i++) {
    head_p[i].style.fill = color;
  }

  const svgXML_b = new XMLSerializer().serializeToString(
    document.getElementById("emptySquid")
  );
  const svgXML_h = new XMLSerializer().serializeToString(
    document.getElementById(head)
  );
  const svgXML_f = new XMLSerializer().serializeToString(
    document.getElementById(face)
  );

  const image64_b =
    "data:image/svg+xml;base64," +
    window.btoa(unescape(encodeURIComponent(svgXML_b)));
  const image64_h =
    "data:image/svg+xml;base64," +
    window.btoa(unescape(encodeURIComponent(svgXML_h)));
  const image64_f =
    "data:image/svg+xml;base64," +
    window.btoa(unescape(encodeURIComponent(svgXML_f)));

  bodyImg.src = image64_b;
  headImg.src = image64_h;
  faceImg.src = image64_f;
  cloImg.src = "imgs/createBox/defaultClo.png";

  headImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(headImg, 0, 0), 10);
  };
  faceImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(faceImg, 0, 243), 10);
  };
  cloImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(cloImg, 45, 320), 10);
  };
  bodyImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(bodyImg, 0, 113), 0);
  };
}

// 魷魚創角_走路
function createSquidMoving(head, face, color) {
  const roleCanvas = document.getElementById("roleCanvas_moving");
  roleCanvas.width = 286;
  roleCanvas.height = 511;
  const fW = roleCanvas.width;
  const fH = roleCanvas.height;

  roleCtx = roleCanvas.getContext("2d");
  roleCtx.clearRect(0, 0, fW, fH);

  const bodyImg = new Image();
  const headImg = new Image();
  const faceImg = new Image();
  const cloImg = new Image();

  const body_p = document.getElementsByClassName("squidBody_moving");
  for (let i = 0; i < body_p.length; i++) {
    body_p[i].style.fill = color;
  }
  const head_p = document.getElementsByClassName(`${head}_p`);
  for (let i = 0; i < head_p.length; i++) {
    head_p[i].style.fill = color;
  }

  const svgXML_b = new XMLSerializer().serializeToString(
    document.getElementById("emptySquid_moving")
  );
  const svgXML_h = new XMLSerializer().serializeToString(
    document.getElementById(head)
  );
  const svgXML_f = new XMLSerializer().serializeToString(
    document.getElementById(face)
  );

  const image64_b =
    "data:image/svg+xml;base64," +
    window.btoa(unescape(encodeURIComponent(svgXML_b)));
  const image64_h =
    "data:image/svg+xml;base64," +
    window.btoa(unescape(encodeURIComponent(svgXML_h)));
  const image64_f =
    "data:image/svg+xml;base64," +
    window.btoa(unescape(encodeURIComponent(svgXML_f)));

  bodyImg.src = image64_b;
  headImg.src = image64_h;
  faceImg.src = image64_f;
  cloImg.src = "imgs/createBox/defaultClo.png";

  headImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(headImg, 0, 0), 10);
  };
  faceImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(faceImg, 0, 243), 10);
  };
  cloImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(cloImg, 45, 320), 10);
  };
  bodyImg.onload = () => {
    setTimeout(() => roleCtx.drawImage(bodyImg, 0, 113), 0);
  };
}

// console.log(document.getElementById("roleCanvas"));
// const context = document.getElementById("roleCanvas").getContext("2d");
// context.fillStyle = "#f00";
// context.fillRect(50, 50, 100, 100);
// context.clearRect(0, 0, 1000, 1000);

// $(".createRoleBtn").click(saveRole);

// function saveRole() {
//   const drawingCanvas = document.querySelector("#roleCanvas");
//   const dataURL = drawingCanvas.toDataURL("image/png");
//   document.querySelector("#createdSquid").value = dataURL;
//   const formData = new FormData(document.getElementById("creatingForm"));

//   const xhr = new XMLHttpRequest();

//   xhr.onload = () => {
//     if (xhr.status == 200) {
//       if (xhr.responseText == "error") {
//         alert("Error");
//       } else {
//         alert("創角成功");
//         $(".createBox").css({ display: "none" });
//       }
//     } else {
//       alert(xhr.status);
//     }
//   };

//   xhr.open("POST", "sendRoleData.php", true);
//   xhr.send(formData);
// }
