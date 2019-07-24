<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sass/style.css">
    <title>收集友誼 後台</title>
</head>

<body>


    <div class="backendLogin">
        <div class="lightBox">
            <div class="lightBox_content">
                <div class="lightBox_info">
                    <div class="lightBox_text">
                        <div class="lightBox_title">
                            <h1>收集友誼</h1>
                            <p>後臺管理系統</p>
                        </div>
                    </div>
                    <div class="lightBox_img">
                        <img src="imgs/backend/manager.png" alt="">
                    </div>
                </div>
                <form class="lightBox_login">
                    <div class="lightBox_thead">
                        <h2>管理員登入</h2>
                    </div>
                    <div class="lightBox_loginForm">
                        <div class="lightBox_inputArea">
                            <div class="lightBox_input lightBox_input-id">
                                <label for="mng_name">暱稱</label>
                                <input type="text" name="mng_name" id="login_mng_name">
                            </div>
                            <div class="lightBox_input lightBox_input-psw">
                                <label for="mng_pwd">密碼</label>
                                <input type="password" name="mng_psw" id="login_mng_psw">
                            </div>
                        </div>
                    </div>
                    <div class="lightBox_submit">
                        <!-- <input id="btn-login" type="button" value="登入" /> -->
                        <button type="submit" id="btn-login">登入</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
    <script src="js/backendLogin.js"></script>
</body>

</html>