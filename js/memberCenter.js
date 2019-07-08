// 手機版下方 記錄區
$(window).ready(function(){
    $("#msgRecordBtn").click(function () {
        $("#msgRecord").toggle();
        $("#grpRecord").hide();
        $("#shopRecord").hide();
    });

    $("#grpRecordBtn").click(function () {
        $("#msgRecord").hide();
        $("#grpRecord").toggle();
        $("#shopRecord").hide();
    });

    $("#shopRecordBtn").click(function () {
        $("#msgRecord").hide();
        $("#grpRecord").hide();
        $("#shopRecord").toggle();
    });
});


// 桌機版 記錄區頁籤
$('#msgLi').click(function () {
    $('#msgRecord_web').show();
    $('#grpRecord_web').hide();
    $('#shopRecord_web').hide();
    $('#msgLi').removeClass('white');
    $('#msgLi').addClass('yellow');
    $('#grpLi').removeClass('yellow');
    $('#grpLi').addClass('white');
    $('#shopLi').removeClass('yellow');
    $('#shopLi').addClass('white');
});

$('#grpLi').click(function () {
    $('#msgRecord_web').hide();
    $('#grpRecord_web').show();
    $('#shopRecord_web').hide();
    $('#msgLi').removeClass('yellow');
    $('#msgLi').addClass('white');
    $('#grpLi').removeClass('white');
    $('#grpLi').addClass('yellow');
    $('#shopLi').removeClass('yellow');
    $('#shopLi').addClass('white');
});

$('#shopLi').click(function () {
    $('#msgRecord_web').hide();
    $('#grpRecord_web').hide();
    $('#shopRecord_web').show();
    $('#msgLi').removeClass('yellow');
    $('#msgLi').addClass('white');
    $('#grpLi').removeClass('yellow');
    $('#grpLi').addClass('white');
    $('#shopLi').removeClass('white');
    $('#shopLi').addClass('yellow');
});
