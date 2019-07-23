function backendLogin() {
    $('body').on('click', '#btn-login', function(){
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
                success: function (data) {
                    // window.location.href="backend.php";
                    console.log(data);
                },
                error: (e) => handleAjaxError(e, '發生錯誤，請聯絡系統管理員')
            });
        } else {
            alert('暱稱及密碼不能為空白');
        }
    });
};


// 共用 - 報錯訊息
function handleAjaxError(e, message) {
    let json;
    try {
        json = JSON.parse(e);
    }
    catch (exception) {
        json = e;
    }
    console.log(json);
    message && alert(message);
}



$(document).ready(function(){
    backendLogin();
})
