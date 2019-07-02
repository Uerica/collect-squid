// 手機選單動畫
function menuMobileTransform() {
  $(".menuMobile_link").click(function(e) {
    e.preventDefault();

    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

// 家具tab切換
$(function(){
    var $li = $('ul.tabTitle li');
        $($li. eq(0) .addClass('active').find('a').attr('href')).siblings('.tabContent').hide();
    
    $li.click(function(){
        $($(this).find('a'). attr ('href')).show().siblings ('.tabContent').hide();
        $(this).addClass('active'). siblings ('.active').removeClass('active');
    });

    $li.click(function(){
		$('#furnitureTab').toggleClass('open');
	});
});

$(function() {
	$('#chair01').on({
		click:function(){
			$('#chair').attr('src', 'images/chair_L_01.png');
		}
	});
	$('#chair02').on({
		click:function(){
			$('#chair').attr('src', 'images/chair_L_02.png');
		}
	});
	$('#chair03').on({
		click:function(){
			$('#chair').attr('src', 'images/chair_L_03.png');
		}
	});
});






window.addEventListener('load', function() {
  menuMobileTransform();
});
