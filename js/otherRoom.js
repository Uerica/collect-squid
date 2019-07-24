function init() {
  // if($("#giveHeart").text() == "給我你的愛") {
  $("#giveHeart").click(giveHeart);
  // }
  // } else {
  //     $('#giveHeart').click(retriveHeart);
  // }
  console.log(document.getElementById("isLove").value);
}

function giveHeart() {
  const xhr = new XMLHttpRequest();

  xhr.onload = function() {
    if (xhr.status == 200) {
      if (document.getElementById("isLove").value == "giving") {
        document.getElementById("isLove").value = "retriving";
        $("#giveHeart").text("我不愛你了");
      } else {
        document.getElementById("isLove").value = "giving";
        $("#giveHeart").text("給我你的愛");
      }

      $(".getHeart span").text(xhr.responseText);
      console.log($(".getHeart span"));
    } else {
      alert(xhr.status);
    }
  };

  const url = `giveHeart.php`;
  xhr.open("post", url, true);

  const heartForm = document.getElementById("heartForm");
  const form = new FormData(heartForm);
  xhr.send(form);
}

$(document).ready(function() {
  $("#addFriend").click(function() {
    const mem_no = $(this)
      .parent()
      .find("input")
      .next()
      .val();
    const other_mem_no = $(this)
      .parent()
      .find("input")
      .val();
    addFriend(mem_no, other_mem_no);
    $("#addFriend").text("好友確認中");
  });
  //留言板打開
  $(".messageBoard").click(function() {
    console.log("hi");
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
});

// 新增留言
$(".msgSend").click(function() {
  const mem_no = document.getElementById("send_mem_no").value;
  const cmt_cnt = document.querySelector(".msgInput").value;
  const rcv_mem_no = $("#rcv_mem_no").val();
  const send_mem_name = $("#send_mem_name").val();
  console.log(mem_no);
  console.log(cmt_cnt);
  console.log(rcv_mem_no);
  console.log(send_mem_name);

  const xhr = new XMLHttpRequest();

  xhr.onload = function() {
    if (xhr.status == 200) {
      $("#messageBoard ul").append(`<li>
                  <input type="hidden" name="cmt_no" id="cmt_no" value="${mem_no}"> 
                  <div class="messageMem">
                    <img src="images/squid_avatar.png">
                    <span>${send_mem_name}</span>
                  </div>
                  <div class="message">${cmt_cnt}</div>
        </li>`);
    } else {
      alert(xhr.status);
    }
  };

  const url = "addMessage.php";
  xhr.open("post", url, true);
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

  const data = `mem_no=${mem_no}&cmt_cnt=${cmt_cnt}&rcv_mem_no=${rcv_mem_no}&send_mem_name=${send_mem_name}`;
  xhr.send(data);
});

// function retriveHeart() {
//     const xhr = new XMLHttpRequest();

//     xhr.onload = function() {
//         if(xhr.status == 200) {
//             console.log(xhr.responseText);
//             $('#giveHeart').text('');
//         } else {
//             alert(xhr.status);
//         }
//     }

//     const url = `giveHeart.php`;
//     xhr.open('post', url, true);

//     const heartForm = document.getElementById('heartForm');
//     const form = new FormData(heartForm);
//     xhr.send(form);
// }

window.onload = init;
