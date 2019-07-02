// 商店頁籤
$(window).resize(tab);
$(window).load(tab);
function tab() {
  var $li = $('ul.tab_title li');

  $($li.eq(0).addClass('active').find('a').attr('href')).siblings('.tab_inner').show();

  if ($(window).width() <= 768) {
    $(function () {
      $($li.eq(0).addClass('active').find('a').attr('href')).siblings('.tab_inner').hide();

      $li.click(function () {
        $($(this).find('a').attr('href')).show().siblings('.tab_inner').hide();
        $(this).addClass('active').siblings('.active').removeClass('active');
      });
    });
  }
}

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


