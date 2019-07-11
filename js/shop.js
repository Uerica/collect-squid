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


// squid animation

function bedAnimation() {
  TweenMax.fromTo("#squid", 1,
    {
      y: 150,
      repeat: -1,
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

  TweenMax.to("#bed", .7, {
    scaleY: 1.2,
    scaleX: .8,
    repeat: -1,
    yoyo: true,
    repeatDelay: .3,
    ease: Back.easeOut,
  });
}

for (var i = 0; i < document.querySelectorAll("#bed_row .try").length; i++) {
  document.querySelectorAll("#bed_row .try")[i].addEventListener("click", bedAnimation);
}