$(".createRoleBtn").click(function() {
  // html 創角資料
  //   填入的資料
  const mem_name = document.getElementById("create_mem_name").value;
  const mem_pwd = document.getElementById("create_mem_pwd").value;
  const mem_email = document.getElementById("create_mem_email").value;
  const mem_gender = document.getElementById("create_mem_gender").value;
  const mem_dob = document.getElementById("create_mem_dob").value;
  //   自動給值
  const mem_lv = 1;
  const highest_lv = 1;
  const squid_qty = 1000;
  const dobObj = new Date(mem_dob);
  const month = dobObj.getMonth() + 1;
  const date = dobObj.getDate();
  const mem_sign = getZodiacSign(date, month);
  const mem_avatar = "img/avatar.png";

  const textXHR = new XMLHttpRequest();

  textXHR.onload = function() {
    if (textXHR.status == 200) {
      console.log(textXHR.responseText);
      console.log("資料匯入成功");
    } else {
      console.log(textXHR.responseText);
    }
  };

  const url = "sendRoleData.php";
  textXHR.open("post", url, true);
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
  &mem_avatar=${mem_avatar}`;
  textXHR.send(data);

  const drawingCanvas = document.querySelector("#roleCanvas");
  const dataURL = drawingCanvas.toDataURL("image/png");
  document.querySelector("#createdSquid").value = dataURL;
  const formData = new FormData(document.getElementById("creatingForm"));

  const graphXHR = new XMLHttpRequest();

  graphXHR.onload = () => {
    if (graphXHR.status == 200) {
      if (graphXHR.responseText == "error") {
        alert("Error");
      } else {
        alert("創角成功");
        $(".createBox").css({ display: "none" });
      }
    } else {
      alert(graphXHR.status);
    }
  };

  graphXHR.open("POST", "sendRoleData.php", true);
  graphXHR.send(formData);
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
