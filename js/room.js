// 家具tab切換
$(function() {
  var $li = $(".tabTitle li");
  $(
    $(".tabTitle li")
      .eq(0)
      .addClass("active")
      .find("a")
      .attr("href")
  )
    .siblings(".tabContent")
    .hide();

  $(".tabTitle li").click(function() {
    $(
      $(this)
        .find("a")
        .attr("href")
    )
      .show()
      .siblings(".tabContent")
      .hide();
    $(this)
      .addClass("active")
      .siblings(".active")
      .removeClass("active");
  });

  $("#openFurniture").click(function() {
    $("#chairTabTitle").toggleClass("show2");
    $("#deskTabTitle").toggleClass("show2");
    $("#bedTabTitle").toggleClass("show2");
    $("#furnitureTab").toggleClass("open");
  });
});

//上傳圖片，圖片預覽
function fileChange() {
  var file = document.getElementById("selectPicInput").files[0];

  var readFile = new FileReader();
  readFile.readAsDataURL(file);
  readFile.addEventListener("load", function() {
    var image = document.getElementById("picUploadImg");
    image.src = this.result;
    $("input[name='imagestring']").val(this.result);
  });

  document.getElementById("submitPic").style.display = "block";
}

$(document).ready(function() {
  var image = $.trim($("#picUploadImg").attr("src"));
  console.log(image);
  if (image == "") {
    $(".picUploadImg").css({
      display: "none"
    });
  }
  document.getElementById("selectPicInput").onchange = fileChange;
  removeMsg();
  //換椅子
  $(".chairSmallChange img").click(function() {
    let chairSrc = $(this).attr("src");
    $(".chair img").attr("src", chairSrc);

    const xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status == 200) {
        console.log(xhr.responseText);
        rankBoard();
      } else {
        alert(xhr.status);
      }
    };
    const url = "changeFurn.php";
    xhr.open("post", url, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    const mem_no = $("#mem_no").val();
    const furn_type = $(this)
      .parent()
      .find("input")
      .val();
    const furn_no = $(this)
      .parent()
      .find("input")
      .next()
      .val();
    const data = `mem_no=${mem_no}&furn_type=${furn_type}&furn_no=${furn_no}`;
    xhr.send(data);
  });

  //換桌子
  $(".deskSmallChange img").click(function() {
    let deskSrc = $(this).attr("src");
    $(".desk img").attr("src", deskSrc);

    const xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status == 200) {
        console.log(xhr.responseText);
      } else {
        alert(xhr.status);
      }
    };
    const url = "changeFurn.php";
    xhr.open("post", url, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    const mem_no = $("#mem_no").val();
    const furn_type = $(this)
      .parent()
      .find("input")
      .val();
    const furn_no = $(this)
      .parent()
      .find("input")
      .next()
      .val();
    const data = `mem_no=${mem_no}&furn_type=${furn_type}&furn_no=${furn_no}`;
    xhr.send(data);
  });

  //換床
  $(".bedSmallChange img").click(function() {
    let bedSrc = $(this).attr("src");
    $(".bed img").attr("src", bedSrc);

    const xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status == 200) {
        console.log(xhr.responseText);
      } else {
        alert(xhr.status);
      }
    };
    const url = "changeFurn.php";
    xhr.open("post", url, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    const mem_no = $("#mem_no").val();
    const furn_type = $(this)
      .parent()
      .find("input")
      .val();
    const furn_no = $(this)
      .parent()
      .find("input")
      .next()
      .val();
    const data = `mem_no=${mem_no}&furn_type=${furn_type}&furn_no=${furn_no}`;
    xhr.send(data);
  });

  //留言板打開
  $(".messageBoard").click(function() {
    $(".lightboxBg").css({
      display: "block"
    });
  });

  //留言板關閉
  $("#cancel").click(function() {
    $(".lightboxBg").css({
      display: "none"
    });
  });

  //點選上傳圖片按鈕
  $("#selectPic").click(function() {
    $("#selectPicInput").trigger("click");
  });

  // 點擊確定上傳
  $("#submitPic").click(function() {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
      if (xhr.status == 200) {
        alert(xhr.responseText);
        $("#submitPic").css("display", "none");
      } else {
        alert(xhr.status);
      }
    };
    const url = "wallPicUpload.php";
    xhr.open("post", url, true);
    const pic = new FormData(document.getElementById("uploadForm"));
    xhr.send(pic);
  });

  // 新增留言
  $(".msgSend").click(function() {
    const mem_no = document.getElementById("talking_mem_no").value;
    const cmt_cnt = document.querySelector(".msgInput").value;
    const mem_name = $("#rcv_mem_name").val();
    const cmt_no = $("#cmt_no").val();
    console.log(mem_name);

    const xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status == 200) {
        $("#messageBoard ul").append(`<li>
                  <input type="hidden" name="cmt_no" id="cmt_no" value="${
                    xhr.responseText
                  }"> 
                  <div class="messageMem">
                    <img src="images/squid_avatar.png">
                    <span>${mem_name}</span>
                  </div>
                  <div class="message">${cmt_cnt}</div>
                  <div class="trashPic">
                  <img src="images/trashcan.png" alt="反送中">
                  </div>
        </li>`);
        removeMsg();
        console.log(xhr.responseText);
      } else {
        alert(xhr.status);
      }
    };

    const url = "addMessage.php";
    xhr.open("post", url, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    const data = `mem_no=${mem_no}&cmt_cnt=${cmt_cnt}`;
    xhr.send(data);
  });

  // 刪除留言
  function removeMsg() {
    console.log("delete");
    $(".trashPic img").click(function() {
      const xhr = new XMLHttpRequest();
      var trash = $(this);
      xhr.onload = function() {
        if (xhr.status == 200) {
          trash
            .parent()
            .parent()
            .remove();
          console.log(xhr.responseText);
        } else {
          alert(xhr.status);
        }
      };

      const cmt_no = $(this)
        .parent()
        .parent()
        .find("input")
        .val();
      const url = `deleteMessage.php?cmt_no=${cmt_no}`;
      xhr.open("get", url, true);
      xhr.send(null);
    });
  }

  //
  function rankBoard() {
    html2canvas(document.querySelector(".rankBoard"), {
      onrendered: function(canvas) {
        canvas.setAttribute("id", "thecanvas"); //添加?性
        document.body.appendChild(canvas);
        canvas.style.display = "none";
        // alert("Hi");

        // uploadImage();
      },
      background: "", //canvas的背景?色，如果?有?定默?透明
      logging: true, //在console.log()中?出信息
      width: innerWidth, //?片?
      height: innerHeight, //?片高
      useCORS: true // 【重要】??跨域配置
    });
  }
});
