// import { callbackify } from "util";

function init() {
  // show();
  // updateDetails(document.getElementById("button"));

  // RWD
  window.addEventListener("resize", gameSizing);
  menuMobileTransform();
  regis();
  cancelRegis();
  confirmRegis();
  cancelRaise();
  // confirmRaise();

  $(".myEvents .eventDescs").scroll(function () {
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
    $(".rightHand").css({
      top: `${movePercent}%`
    });
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
  $(".menuMobile_link").click(function (e) {
    e.preventDefault();

    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

function regis() {
  $(".eventsWrapper input").click((e) => {
    // console.log(e.target.previousElementSibling.value);
    console.log(e.target);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          document.getElementById("evtDetail").innerHTML = xhr.responseText;
          cancelRegis();
          confirmRegis(e.target);
        } else {
          alert(xhr.status);
        }
      }
    }
    $(".regisBox").css({
      display: "flex"
    });
    xhr.open("post", "getEventDetail.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let evtDetail = `evt_no=${e.target.previousElementSibling.value}`;
    xhr.send(evtDetail);
  });
}

// 關閉報名燈箱
function cancelRegis() {
  $(".regisBox .cancelBtn").click(() =>
    $(".regisBox").css({
      display: "none"
    })
  );
}

// 確認報名
// 我超強
function confirmRegis(target) {
  $("#regisBtn").click(function() {
    // e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange =  () => {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          alert('報名成功');
          target.value = "已報名";
          $('.regisBox').css({ display: 'none' });
          // getMyRaise();
          location.reload();
        } else {
          alert(xhr.status);
        }
      }
    }
    xhr.open("post", "registerEvent.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    let evt_no = document.getElementById('evt_no').value;
    let data = `evt_no=${evt_no}`;
    xhr.send(data);
  });
}

// 取消舉辦活動
function cancelRaise() {
  $(".raiseBox .cancelBtn").click(() => {
    $(".raiseBox").css({
      display: "none"
    });
  });
}

$('#raiseBtn').click(function() {
  $('.raiseBox').css({ display: 'flex' });
});

// 確認舉辦活動
// function confirmRaise() {
//   $(".raiseBox .submitWrapper input").click(() => {
//     console.log($(this));
//     $(".raiseBox").css({
//       display: "none"
//     });
//   });
// }



// 螢幕橫向
// function fullScreenCheck() {
//   if (document.fullscreenElement) return;
//   return document.documentElement.requestFullscreen();
// }

// function updateDetails(lockButton) {
//   const buttonOrientation = getOppositeOrientation();
//   lockButton.textContent = `Lock to ${buttonOrientation}`;
// }

// function getOppositeOrientation() {
//   const {
//     type
//   } = screen.orientation;
//   return type.startsWith("portrait") ? "landscape" : "portrait";
// }


// async function rotate(lockButton) {
//   try {
//     await fullScreenCheck();
//   } catch (err) {
//     console.error(err);
//   }
//   const newOrientation = getOppositeOrientation();
//   await screen.orientation.lock(newOrientation);
//   updateDetails(lockButton);
// }

// function show() {
//   const {
//     type,
//     angle
//   } = screen.orientation;
//   console.log(`Orientation type is ${type} & angle is ${angle}.`);
// }

// screen.orientation.addEventListener("change", () => {
//   show();
//   updateDetails(document.getElementById("button"));
// });
// 螢幕橫向

window.onload = init;


// addEvent----------------------
$(document).ready(function () {

  $("#evt_cover_url").change(function () {
    let file = this.files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function (e) {
      $("#imgPreview").attr("src", this.result);
    });
    reader.readAsDataURL(file);
  });

  $("#evt_init").click(function () {
    if ($("#evt_name").val() == "") {
      alert("活動名稱必填");
      return;
    }
    if ($("#evt_date").val() == "" || $("#evt_date").val() < $("#enroll_end_date").val()) {
      alert("活動時間必填且不能在報名截止時間之前");
      return;
    }
    if ($("#evt_place").val() == "") {
      alert("活動地點必填");
      return;
    }
    if ($("#enroll_end_date").val() == "" || $("#enroll_end_date").val() > $("#evt_date").val()) {
      alert("報名截止時間必填且不能在活動時間之後");
      return;
    }
    if ($("#max_att").val() == "") {
      alert("人數限制必填3~20人");
      return;
    } else if ($("#max_att").val() < 3 || $("#max_att").val() > 20) {
      alert("人數限制必填3~20人");
      return;
    }
    if ($("#evt_desc").val() == "") {
      alert("活動描述必填");
      return;
    }
    if($("#evt_cover_url").val() == ""){
      alert("請選擇檔案");
      return;
    } else {
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            alert(xhr.responseText);
            (function confirmRaise() {
              $(".raiseBox").css({
                display: "none"
              });
            }).call(this);
            // getNewEvt();
            // getMyAttend();
            location.reload();
          } else {
            alert(xhr.status);
          }
        }
      }
      xhr.open("post", "addEvent.php", true);
      let addEvtForm = new FormData(document.getElementById("addEvtForm"));
      xhr.send(addEvtForm);
    }
  });
});


// 頁籤evt
$(function () {
  // 更換頁籤
  var $li = $('ul.evt_title li');
  $($li.eq(0).addClass('active').find('a').attr('href')).siblings('.evt_inner').hide();
  
  // 更換內容
  $li.click(function () {
    $($(this).find('a').attr('href')).show().siblings('.evt_inner').hide();
    $(this).addClass('active').siblings('.active').removeClass('active');
  });
});


// 頁籤myEvt
$(function () {
  var $li = $('ul.myEvt_title li');
  $($li.eq(0).addClass('active').find('a').attr('href')).siblings('.myEvt_inner').hide();

  $li.click(function () {
    $($(this).find('a').attr('href')).show().siblings('.myEvt_inner').hide();
    $(this).addClass('active').siblings('.active').removeClass('active');
  });
});