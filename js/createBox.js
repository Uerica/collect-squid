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

// 點圖換造型
// 換頭型
$(".heads img").click(function() {
  const headSrc = $(this).attr("src");
  $(".headFeature").attr("src", headSrc);
});
// 換臉型
$(".facialFeatures img").click(function() {
  const faceSrc = $(this).attr("src");
  $(".faceFeature").attr("src", faceSrc);
});

// 返回登錄鈕
$("#backToLoginBtn").click(function() {
  $(".createBox").css({ display: "none" });
  $(".loginBox").css({ display: "flex" });
});

// 創建鈕
$("#createRoleBtn").click(function() {
  $(".createBox").css({ display: "none" });
});

function active(item) {
  item.siblings().removeClass("active");
  item.addClass("active");
}

let redNum = 0;
let greenNum = 0;
let blueNum = 0;
const bodyPart = document.getElementsByClassName("cls-1")[0];

document.getElementById("redNum").oninput = function() {
  redNum = $("#redNum").val();
  console.log(`redNum: ${redNum}`);
  $("#squidBody .cls-1").css({
    fill: `rgb(${redNum}, ${greenNum}, ${blueNum})`
  });
};
document.getElementById("greenNum").oninput = () => {
  greenNum = $("#greenNum").val();
  $("#squidBody .cls-1").css({
    fill: `rgb(${redNum}, ${greenNum}, ${blueNum})`
  });
};
document.getElementById("blueNum").oninput = () => {
  blueNum = $("#blueNum").val();
  $("#squidBody .cls-1").css({
    fill: `rgb(${redNum}, ${greenNum}, ${blueNum})`
  });
};
