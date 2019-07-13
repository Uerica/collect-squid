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
let greenNum = 130;
let blueNum = 130;
const bodyPart = document.getElementsByClassName("cls-1")[0];

document.getElementById("redNum").oninput = function() {
  redNum = $("#redNum").val();
  $(".cls-1").css({
    fill: `rgb(${redNum}, ${greenNum}, ${blueNum})`
  });
};
document.getElementById("greenNum").oninput = () => {
  greenNum = $("#greenNum").val();
  $(".cls-1").css({
    fill: `rgb(${redNum}, ${greenNum}, ${blueNum})`
  });
};
document.getElementById("blueNum").oninput = () => {
  blueNum = $("#blueNum").val();
  $(".cls-1").css({
    fill: `rgb(${redNum}, ${greenNum}, ${blueNum})`
  });
};

// 點圖換造型
// 換頭型
$(".heads svg").click(function() {
  $(".appearanceHead").empty();
  $(".appearanceHead").append(
    `${$("<div>")
      .append(
        $(this)
          .clone()
          .addClass("head")
          .css({ fill: `rgb(0, 0, 0)` })
      )
      .html()}`
  );
});
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

// 創建鈕
$(".createRoleBtn").click(function() {
  $(".createBox").css({ display: "none" });
});

function active(item) {
  item.siblings().removeClass("active");
  item.addClass("active");
}

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
