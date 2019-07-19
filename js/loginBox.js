$(".loginForm form").submit(function(e) {
  e.preventDefault();
});

// 創角
$(".createRole").click(function() {
  $(".loginBox").css({ display: "none" });
  $(".createBox").css({ display: "flex" });
});

// 登入
$("#loginBtn").click(function() {
  const xhr = new XMLHttpRequest();

  xhr.onload = () => {
    if (xhr.status == 200) {
      $(".loginBox").css({ display: "none" });
      const loginSquid = document.querySelector(".loginSquid #myRole");
      loginSquid.src = xhr.responseText;
      console.log(xhr.responseText);
    } else {
      alert(xhr.status);
    }
  };

  const mem_name = document.getElementById("login_mem_name").value;
  const mem_pwd = document.getElementById("login_mem_pwd").value;
  const url = `getRole.php?mem_name=${mem_name}&mem_pwd=${mem_pwd}`;
  xhr.open("get", url, true);

  xhr.send(null);
});

// 上帝模式
$("#godMode").click(function() {
  $(".loginBox").css({ display: "none" });
});
