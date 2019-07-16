
// 手機選單動畫
function menuMobileTransform() {
  $(".menuMobile_link").click(function (e) {
    e.preventDefault();

    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

$(document).ready(function () {
  menuMobileTransform();
});



// 商店頁籤
$(window).resize(tab);
$(window).load(tab);
function tab() {
  var $li = $('ul.tab_title li');

  if ($(window).width() <= 768) {
    $(function () {
      $($li.eq(0).addClass('active').find('a').attr('href')).siblings('.tab_inner').hide();

      $li.click(function () {
        $($(this).find('a').attr('href')).show().siblings('.tab_inner').hide();
        $(this).addClass('active').siblings('.active').removeClass('active');
      });
    });
  }
  else {
    $($li.find('a').attr('href')).siblings('.tab_inner').show();
  }
}


// 商店owl.carousel
$('.owl-carousel').owlCarousel({
  loop: true,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    908: {
      items: 2
    },
    1321: {
      items: 3
    },
  }
});


// 試用動畫

// bedAnimation----------------------------------------
let bedRunning = false;
function bedAnimation() {

  if (jQuery(window).width() < 768) {
    $("#squid").css({
      left: "45%",
      bottom: "600%",
    });
    $("#head_box").css({
      width: "135%",
      transform: "translate(-57%,-72%)",
    });
    $(".foots").css({
      bottom: "-120%",
    });
  } else if (jQuery(window).width() < 1025) {
    $("#squid").css({
      left: "45%",
      bottom: "500%",
    });
    $("#head_box").css({
      width: "140%",
      transform: "translate(-53%,-72%)",
    });
    $(".foots").css({
      bottom: "-100%",
    });
  }
  else {
    $("#squid").css({
      left: "45%",
      bottom: "400%",
    });
  }

  if (bedRunning) {
    return;
  }
  bedRunning = true

  var bed1 = TweenMax.to("#bed", 1, {
    scaleY: 1.2,
    scaleX: .8,
    repeat: -1,
    yoyo: true,
    delay: .1,
    ease: Back.easeOut,
  });

  var bed2 = TweenMax.fromTo("#bed_squid", 1,
    {
      y: 150,
      rotation: 55.7,
      repeat: -1,
      yoyo: true,
    },
    {
      y: 0,
      rotation: 70.7,
      ease: Power4.easeOut,
      repeat: -1,
      yoyo: true,
    });

  var bed3 = TweenMax.fromTo("#squid_head", 1,
    {
      x: 0,
      rotation: 0,
      transformOrigin: "right,bottom",
    },
    {
      x: 10,
      rotation: 10,
      repeat: -1,
      yoyo: true,
    });

  var bed4 = TweenMax.fromTo(["#squid_foot1", "#squid_foot2", "#squid_foot3"], 1,
    {
      y: -20,
      rotation: 20,
    },
    {
      rotation: -20,
      repeat: -1,
      yoyo: true,
      ease: Power4.easeOut,
    });

  $("#bed_row .try").click(function () {
    // bed1.play();
    // bed2.play();
    // bed3.play();
    // bed4.play();
  });

  $("#chair_row .try").click(function () {
    // bed1.kill();
    // bed2.kill();
    // bed3.kill();
    // bed4.kill();
  });
  $("#table_row .try").click(function () {
    bed1.restart();
    bed2.restart();
    bed3.restart();
    bed4.restart();
    // bed1.kill();
    // bed2.kill();
    // bed3.kill();
    // bed4.kill();
  });
}

$("#bed_row .try").click(function () {
  $("#bed").css("display", "block");
  $("#table").css("display", "none");
  $("#chair").css("display", "none");
  $("#bed").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
  bedAnimation();
});
// bedAnimation----------------------------------------


// chairAnimation----------------------------------------
let chairRunning = false;
function chairAnimation() {

  if (jQuery(window).width() < 768) {
    $("#squid").css({
      left: "45%",
      bottom: "600%",
    });
    $("#head_box").css({
      width: "135%",
      transform: "translate(-57%,-72%)",
    });
    $(".foots").css({
      bottom: "-120%",
    });
  } else if (jQuery(window).width() < 1025) {
    $("#squid").css({
      left: "45%",
      bottom: "500%",
    });
    $("#head_box").css({
      width: "140%",
      transform: "translate(-53%,-72%)",
    });
    $(".foots").css({
      bottom: "-100%",
    });
  }
  else {
    $("#squid_head").css({

    });
  }

  if (chairRunning) {
    return;
  }
  chairRunning = true;

  // tl = new TimelineMax({
  //   repeat: -1,
  //   yoyo: true,
  // });
  // tl.to("#squid_foot1", 1, {
  //   scaleY: 1.8,
  //   repeatDelay: 1,
  // }),
  //   tl.to("#squid_foot1", 1, {
  //     scaleY: .6,
  //     repeatDelay: 1,
  //   })
}

$("#chair_row .try").click(function () {
  $("#bed").css("display", "none");
  $("#table").css("display", "none");
  $("#chair").css("display", "block");
  $("#chair").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
  chairAnimation();
});

// chairAnimation();
// chairAnimation----------------------------------------


// buy------------------
$(document).ready(function () {
  $(".buy").click(function () {
    console.log(this);
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          // document.getElementById("showPanel").innerHTML = xhr.responseText;
          // alert(xhr.responseText);
        } else {
          alert(xhr.status);
        }
      }
    }

    let url = "buy.php";
    xhr.open("post", url, true);
    let buyForm = new FormData(this.parentNode);
    xhr.send(buyForm);
  });
});

