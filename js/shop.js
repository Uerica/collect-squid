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

  TweenMax.to("#bed", 1, {
    scaleY: 1.2,
    scaleX: .8,
    repeat: -1,
    yoyo: true,
    delay: .1,
    ease: Back.easeOut,
  });

  TweenMax.fromTo("#squid", 1,
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

  TweenMax.fromTo("#squid_head", 1,
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

  TweenMax.fromTo(["#squid_foot1", "#squid_foot2", "#squid_foot3"], 1,
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
}

for (var i = 0; i < document.querySelectorAll("#bed_row .try").length; i++) {
  document.querySelectorAll("#bed_row .try")[i].addEventListener("click", bedAnimation);
}

$("#bed_row .try").click(function () {
  $("#bed").css("display", "block");
  $("#table").css("display", "none");
  $("#chair").css("display", "none");
  $("#bed").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
});
// bedAnimation----------------------------------------


// chairAnimation----------------------------------------
let chairRunning = false;
function chairAnimation() {



  if (chairRunning) {
    return;
  }
  chairRunning = true;

  tl = new TimelineMax({
    repeat: -1,
    yoyo: true,
  });
  tl.to("#squid_foot1", 1, {
    scaleY: 1.8,
    repeatDelay: 1,
  }),
    tl.to("#squid_foot1", 1, {
      scaleY: .6,
      repeatDelay: 1,
    })
}

for (var i = 0; i < document.querySelectorAll("#chair_row .try").length; i++) {
  document.querySelectorAll("#chair_row .try")[i].addEventListener("click", chairAnimation);
}

$("#chair_row .try").click(function () {
  $("#bed").css("display", "none");
  $("#table").css("display", "none");
  $("#chair").css("display", "block");
  $("#chair").attr("src", $(this).parent().parent().siblings(".img_wrap").children().attr("src"));
});
// chairAnimation();
// chairAnimation----------------------------------------