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
  } else {
    $($li.find('a').attr('href')).siblings('.tab_inner').show();
  }
}


// 商店owl.carousel
$('.owl-carousel').owlCarousel({
  loop: false,
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

// chairAnimation--------------------------------------
$("#chair_row .try").click(function () {
  $("#bed,#table,#bed_squid,#table_squid").css("display", "none");
  $("#chair,#chair_squid").css("display", "block");
  $("#chair").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
});
// chairAnimation--------------------------------------


// tableAnimation--------------------------------------
$("#table_row .try").click(function () {
  $("#bed,#chair,#bed_squid,#chair_squid").css("display", "none");
  $("#table,#table_squid").css("display", "block");
  $("#table").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
});
// tableAnimation--------------------------------------


// bedAnimation----------------------------------------
let bedRunning = false;

function bedAnimation() {

  if (jQuery(window).width() < 768) {
    $("#bed_squid").css({
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
    $("#bed_squid").css({
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
  } else {
    $("#bed_squid").css({
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

  var bed2 = TweenMax.fromTo("#bed_squid", 1, {
    y: 150,
    rotation: 55.7,
    repeat: -1,
    yoyo: true,
  }, {
    y: 0,
    rotation: 70.7,
    ease: Power4.easeOut,
    repeat: -1,
    yoyo: true,
  });

  var bed3 = TweenMax.fromTo("#squid_head", 1, {
    x: 0,
    rotation: 0,
    transformOrigin: "right,bottom",
  }, {
    x: 10,
    rotation: 10,
    repeat: -1,
    yoyo: true,
  });

  var bed4 = TweenMax.fromTo(["#squid_foot1", "#squid_foot2", "#squid_foot3"], 1, {
    y: -20,
    rotation: 20,
  }, {
    rotation: -20,
    repeat: -1,
    yoyo: true,
    ease: Power4.easeOut,
  });

  $("#bed_row .try").click(function () {
    bed1.play();
    bed2.play();
    bed3.play();
    bed4.play();
  });

  $("#chair_row .try").click(function () {
    bed1.kill();
    bed2.kill();
    bed3.kill();
    bed4.kill();
  });

  $("#table_row .try").click(function () {
    bed1.kill();
    bed2.kill();
    bed3.kill();
    bed4.kill();
  });
}

$("#bed_row .try").click(function () {
  $("#chair,#table,#chair_squid,#table_squid").css("display", "none");
  $("#bed,#bed_squid").css("display", "block");
  $("#bed").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
  bedAnimation();
});
// bedAnimation----------------------------------------


// buy-------------------------------------------------
$(document).ready(function () {

  $(".buy").click(function () {
    if (this.innerText != "已購買") {
      $("#confirmBox").attr("style", "display:block");
      buyItem = this;
    }
  });

  $("#confirm_btn").click(function () {
    // console.log(buyItem);
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          buyItem.innerText = xhr.responseText;
        } else {
          alert(xhr.status);
        }
      }
    }
    let url = "buy.php";
    xhr.open("post", url, true);
    let buyForm = new FormData(buyItem.parentNode);
    xhr.send(buyForm);
    $("#confirmBox").attr("style", "display:none");
  });

  $("#cancel_btn").click(function () {
    $("#confirmBox").attr("style", "display:none");
  });

});
// buy-------------------------------------------------