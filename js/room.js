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
    var $li = $('.tabTitle li');
    $($('.tabTitle li').eq(0).addClass('active').find('a').attr('href')).siblings('.tabContent').hide();
    
    $('.tabTitle li').click(function(){
        $($(this).find('a').attr('href')).show().siblings('.tabContent').hide();
        $(this).addClass('active').siblings('.active').removeClass('active');
        
    });

    $('#openFurniture').click(function(){
    	$('#chairTabTitle').toggleClass('show2');
    	$('#deskTabTitle').toggleClass('show2');
    	$('#bedTabTitle').toggleClass('show2');
    	$('#furnitureTab').toggleClass('open');
    });
    
});

//上傳圖片，圖片預覽
function fileChange(){
  var file = document.getElementById('selectPicInput').files[0];

  var readFile = new FileReader();
  readFile.readAsDataURL(file);
  readFile.addEventListener('load',function(){
    var image = document.getElementById('picUploadImg');
    image.src = this.result;
    $("input[name='imagestring']").val(this.result);
  });

  document.getElementById('submitPic').style.display = 'block';
}

$(document).ready(function() {

	//換椅子
    $(".chairSmallChange img").click(function() {
	    let chairSrc = $(this).attr("src");
	    $(".chair img").attr("src", chairSrc);
  	});

    //換桌子K
  	$(".deskSmallChange img").click(function() {
	    let deskSrc = $(this).attr("src");
	    $(".desk img").attr("src", deskSrc);
	});

	  //換床
  	$(".bedSmallChange img").click(function() {
	    let bedSrc = $(this).attr("src");
	    $(".bed img").attr("src", bedSrc);
	});

  	//留言板打開
	$('.messageBoard').click(function(){
        $('.lightboxBg').css({ 
        	display: "block" 
        });
    });

	  //留言板關閉
    $('#cancel').click(function(){
        $('.lightboxBg').css({ 
        	display: "none" 
        });
    }); 

    //點選上傳圖片按鈕
    $("#selectPic").click(function(){
        $("#selectPicInput").trigger('click');
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
          if(xhr.status == 200) {
            
          } else {
            alert(xhr.status);
          }
        }
        const url = 'wallPicUpload.php';
        xhr.open('post', url, true);
        const pic = new FormData();
        xhr.send()
    });

});



window.addEventListener('load', function() {
  menuMobileTransform();
  document.getElementById('selectPicInput').onchange = fileChange;
});
