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
//   換臉型
$(".facialFeatures img").click(function() {
  const faceSrc = $(this).attr("src");
  $(".faceFeature").attr("src", faceSrc);
});

//   返回登錄鈕
$("#backToLoginBtn").click(function() {
  $(".newCharacter").css({ display: "none" });
  $(".loginBox").css({ display: "flex" });
});

//   創建鈕
$("#createRoleBtn").click(function() {
  $(".newCharacter").css({ display: "none" });
});

function active(item) {
  item.siblings().removeClass("active");
  item.addClass("active");
}