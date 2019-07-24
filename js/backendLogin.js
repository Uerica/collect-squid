function backendLogin() {
    $('body').on('submit', '.lightBox_login', function(e){
        e.preventDefault();
        let mng_name = $('#login_mng_name').val();
        let mng_psw = $('#login_mng_psw').val();
        if ((mng_name) && (mng_psw)) {
            let data = {
                table_name: `managerLogin`,
                mng_name: mng_name,
                mng_psw: mng_psw,
            };
            let jsonStr = JSON.stringify(data);
            $.ajax({
                type: "POST",
                url: `POST.php?jsonStr=${jsonStr}`,
                success: function (result) {
                    if(result === "1") {
                        window.location.href="backend.php";
                    } else {
                        alert('帳號密碼錯誤，請重試');
                    }
                },
                error: (e) => handleAjaxError(e, '帳號密碼錯誤')
            });
        } else {
            alert('暱稱及密碼不能為空白');
        }
        return false;
    });
};

function backendLogout() {
    $('body').on('click', '#btn_logout', function(e){
        console.log('123');
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: `backendLogout.php`,
            success: function(result) {
                // console.log(result);
                if(result === "1") {
                    window.location.href="backendLogin.php";
                } else {
                    alert('系統忙線中');
                }
            },
            error: (e) => handleAjaxError(e, '系統忙線中')
        })
        return false;
    });
};


// 共用 - 報錯訊息
function handleAjaxError(e, message) {
    try {
        let json = JSON.parse(e);
        console.log(json.responseText || json.message || json);
    }
    catch (exception) {
        console.log(e);
    }
    message && alert(message);
}



$(document).ready(function(){
    backendLogin();
    backendLogout();
})
