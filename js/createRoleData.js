$(".createRoleBtn").click(function() {
  // html 創角資料
  // 填入的資料
  const mem_name = document.getElementById("create_mem_name").value;
  const mem_pwd = document.getElementById("create_mem_pwd").value;
  const mem_pwd_checked = document.getElementById("mem_pwd_checked").value;
  const mem_email = document.getElementById("create_mem_email").value;
  const mem_gender = document.getElementById("create_mem_gender").value;
  const mem_dob = document.getElementById("create_mem_dob").value;

  // 自動給值
  const mem_lv = 1;
  const highest_lv = 1;
  const squid_qty = 1000;
  const dobObj = new Date(mem_dob);
  const month = dobObj.getMonth() + 1;
  const date = dobObj.getDate();
  const mem_sign = getZodiacSign(date, month);
  const mem_avatar = "img/avatar.png";
  const mem_status = 0;

  // 驗證名字
  if (mem_name.length > 10) {
    alert("名字不得超過10個字");
    return;
  }
  // 驗證信箱格式＆是否重複
  if (!validateEmail(mem_email)) {
    alert("信箱格式不符");
    return;
  }

  if (mem_pwd.length <= 3) {
    alert("密碼格式不符");
    return;
  }
  // 驗證確認密碼
  if (mem_pwd != mem_pwd_checked) {
    alert("兩者密碼不一");
    return;
  }

  // 確認名稱是否重複
  const nameXHR = new XMLHttpRequest();
  nameXHR.onload = function() {
    if (nameXHR.status == 200) {
      if (nameXHR.responseText == "exist") {
        alert("此帳號已用過");
        return;
      } else {
        checkEmailRepeat(
          mem_name,
          mem_pwd,
          mem_email,
          mem_lv,
          highest_lv,
          squid_qty,
          mem_gender,
          mem_dob,
          mem_sign,
          mem_avatar,
          mem_status
        );
      }
    } else {
      alert(nameXHR.status);
    }
  };

  const new_mem_name = $("#create_mem_name").val();
  console.log(new_mem_name);
  const nameURL = `checkName.php?mem_name=${mem_name}`;
  nameXHR.open("get", nameURL, true);
  nameXHR.send(null);
});

// 取得星座
function getZodiacSign(day, month) {
  var zodiacSigns = {
    capricorn: "摩羯座",
    aquarius: "水瓶座",
    pisces: "雙魚座",
    aries: "牡羊座",
    taurus: "金牛座",
    gemini: "雙子座",
    cancer: "巨蟹座",
    leo: "獅子座",
    virgo: "處女座",
    libra: "天秤座",
    scorpio: "天蠍座",
    sagittarius: "射手座"
  };

  if ((month == 1 && day <= 20) || (month == 12 && day >= 22)) {
    return zodiacSigns.capricorn;
  } else if ((month == 1 && day >= 21) || (month == 2 && day <= 18)) {
    return zodiacSigns.aquarius;
  } else if ((month == 2 && day >= 19) || (month == 3 && day <= 20)) {
    return zodiacSigns.pisces;
  } else if ((month == 3 && day >= 21) || (month == 4 && day <= 20)) {
    return zodiacSigns.aries;
  } else if ((month == 4 && day >= 21) || (month == 5 && day <= 20)) {
    return zodiacSigns.taurus;
  } else if ((month == 5 && day >= 21) || (month == 6 && day <= 20)) {
    return zodiacSigns.gemini;
  } else if ((month == 6 && day >= 22) || (month == 7 && day <= 22)) {
    return zodiacSigns.cancer;
  } else if ((month == 7 && day >= 23) || (month == 8 && day <= 23)) {
    return zodiacSigns.leo;
  } else if ((month == 8 && day >= 24) || (month == 9 && day <= 23)) {
    return zodiacSigns.virgo;
  } else if ((month == 9 && day >= 24) || (month == 10 && day <= 23)) {
    return zodiacSigns.libra;
  } else if ((month == 10 && day >= 24) || (month == 11 && day <= 22)) {
    return zodiacSigns.scorpio;
  } else if ((month == 11 && day >= 23) || (month == 12 && day <= 21)) {
    return zodiacSigns.sagittarius;
  }
}

// 驗證信箱格式
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

// 傳送資料
function sendData(
  mem_name,
  mem_pwd,
  mem_email,
  mem_lv,
  highest_lv,
  squid_qty,
  mem_gender,
  mem_dob,
  mem_sign,
  mem_avatar,
  mem_status
) {
  const textXHR = new XMLHttpRequest();

  textXHR.onload = function() {
    if (textXHR.status == 200) {
      $(".createBox").css({ display: "none" });
      const worold = document.getElementsByTagName("body")[0];
      // alert(textXHR.responseText);
      // console.log("world");
      setTimeout(sendGraph, 10);
    } else {
      console.log(textXHR.responseText);
    }
  };

  const textURL = "sendRoleData.php";
  textXHR.open("post", textURL, true);
  textXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  const data = `mem_name=${mem_name}
  &mem_pwd=${mem_pwd}
  &mem_email=${mem_email}
  &mem_lv=${mem_lv}
  &highest_lv=${highest_lv}
  &squid_qty=${squid_qty}
  &mem_gender=${mem_gender}
  &mem_dob=${mem_dob}
  &mem_sign=${mem_sign}
  &mem_avatar=${mem_avatar}
  &mem_status=${mem_status}`;
  textXHR.send(data);
}

// 儲存圖片
function sendGraph() {
  const drawingCanvas = document.querySelector("#roleCanvas");
  const dataURL = drawingCanvas.toDataURL("image/png");
  document.querySelector("#createdSquid").value = dataURL;
  const formData = new FormData(document.getElementById("creatingForm"));

  const graphXHR = new XMLHttpRequest();

  graphXHR.onload = function() {
    if (graphXHR.status == 200) {
      if (graphXHR.responseText == "error") {
        alert("Error");
      } else {
        console.log(graphXHR.responseText);
        $(".createBox").css({ display: "none" });
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
          if (xhr.status == 200) {
            console.log(xhr.responseText);
            alert("創角成功");
            setTimeout(sendGraphMoving, 10);
          } else {
            alert(xhr.status);
          }
        };

        const url = "getRoleBack.php";
        xhr.open("get", url, true);
        xhr.send(null);
      }
    } else {
      alert(graphXHR.status);
    }
  };

  graphXHR.open("POST", "sendRoleData.php", true);
  graphXHR.send(formData);
}

// 儲存圖片_移動
function sendGraphMoving() {
  const drawingCanvas = document.querySelector("#roleCanvas_moving");
  const dataURL = drawingCanvas.toDataURL("image/png");
  document.querySelector("#createdSquid_moving").value = dataURL;
  const formData = new FormData(document.getElementById("creatingForm_moving"));

  const graphXHR = new XMLHttpRequest();

  graphXHR.onload = function() {
    if (graphXHR.status == 200) {
      if (graphXHR.responseText == "error") {
        alert("Error");
      } else {
        console.log(graphXHR.responseText);
        $(".createBox").css({ display: "none" });
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
          if (xhr.status == 200) {
            // document.getElementById("myRole").src = xhr.responseText;
            console.log(xhr.responseText);
            location.reload();
          } else {
            alert(xhr.status);
          }
        };

        const url = "getRoleBack.php";
        xhr.open("get", url, true);
        xhr.send(null);
      }
    } else {
      alert(graphXHR.status);
    }
  };

  graphXHR.open("POST", "sendRoleData.php", true);
  graphXHR.send(formData);
}

// 驗證信箱有沒有重複
function checkEmailRepeat(
  mem_name,
  mem_pwd,
  mem_email,
  mem_lv,
  highest_lv,
  squid_qty,
  mem_gender,
  mem_dob,
  mem_sign,
  mem_avatar,
  mem_status
) {
  const checkXHR = new XMLHttpRequest();
  checkXHR.onload = function() {
    if (checkXHR.status == 200) {
      if (checkXHR.responseText == "exist") {
        alert("此信箱已用過");
        return;
      } else {
        console.log(checkXHR.responseText);
        sendData(
          mem_name,
          mem_pwd,
          mem_email,
          mem_lv,
          highest_lv,
          squid_qty,
          mem_gender,
          mem_dob,
          mem_sign,
          mem_avatar,
          mem_status
        );
      }
    } else {
      alert(checkXHR.status);
      return;
    }
  };
  const checkURL = `checkEmail.php?email=${mem_email}`;
  checkXHR.open("get", checkURL, true);
  checkXHR.send(null);
}
