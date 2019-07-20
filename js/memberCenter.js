//手機版 基本資訊欄_點擊按鈕換編輯欄
        //點首頁的編輯(Edit_phone),form表單出現,資訊欄隱藏
    var memInfo_phone = document.getElementById("memInfo_phone");
    var memForm_phone = document.getElementById("memForm_phone");
    var Edit_phone = document.getElementById("Edit_phone"); //編輯的按鈕

    Edit_phone.addEventListener("click",function(){
        memInfo_phone.style.display="none";
        memForm_phone.style.display="block";
    });

         //點(form表單的)確認或取消,資訊欄出現,form表單隱藏
     var confirm_phone = document.getElementById("confirm_phone"); //確認
     var cancel_phone = document.getElementById("cancel_phone"); //取消
     confirm_phone.addEventListener("click",showInfo_phone);
     cancel_phone.addEventListener("click",showInfo_phone);
 
     function showInfo_phone(){
        memInfo_phone.style.display="block";
        memForm_phone.style.display="none";
     };
 



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




    //桌機版 基本資訊欄_點擊按鈕換編輯欄
        //點首頁的編輯(Edit_web),form表單出現,資訊欄隱藏
    var memInfo_web = document.getElementById("memInfo_web");
    var memForm_web = document.getElementById("memForm_web");
    var Edit_web = document.getElementById("Edit_web"); //編輯的按鈕
    
    Edit_web.addEventListener("click",function(){
        memInfo_web.style.display="none";
        memForm_web.style.display="block";
    });

        //點(form表單的)確認或取消,資訊欄出現,form表單隱藏
    var confirm_web = document.getElementById("confirm_web"); //確認
    var cancel_web = document.getElementById("cancel_web"); //取消
    confirm_web.addEventListener("click",showInfo);
    cancel_web.addEventListener("click",showInfo);

    function showInfo(){
        memInfo_web.style.display="block";
        memForm_web.style.display="none";
    };


    //桌機版 資訊&表單欄的暱稱區 Vue
    

    
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

//msgEdit_web的部分等下要刪掉
    // 桌機版 記錄區的欄位 編輯和show出記錄
    var msgBlock_web = document.getElementById("msgBlock_web");
    var msgInput_web = document.getElementById("msgInput_web");
    var msgDelete_web = document.getElementById("msgDelete_web"); //編輯

    msgDelete_web.addEventListener("click",EditMsg);

    function EditMsg(){
        msgBlock_web.style.display="none";
        msgInput_web.style.display="block";
    };

        // 點確認或取消,記錄出現,input輸入框隱藏
    var msgConfirm_web = document.getElementById("msgConfirm_web"); //確認
    var msgCanncel_web = document.getElementById("msgCanncel_web"); //取消
    msgConfirm_web.addEventListener("click",showRecord);
    msgCanncel_web.addEventListener("click",showRecord);

    function showRecord(){
        msgBlock_web.style.display="block";
        msgInput_web.style.display="none";
    };
})

//.. ajax .........................
window.addEventListener("load", function(){
    // document.getElementById("confirm_web").onclick = function(){
    //     //update member data
    //     let xhr = new XMLHttpRequest();
    //     xhr.onload = function(){
    //         alert(xhr.responseText);
    //     }
    //     xhr.open("post", "memUpdate.php", true);
    //     let myForm = new FormData( document.getElementById("myForm_web"));
    //     xhr.send(myForm);
    // };
})
//.................................


