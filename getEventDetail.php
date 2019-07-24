<?php
$errMsg = "";
try {
    $dsn = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
    $user = "dd101g2";
    $psw = "dd101g2";
    $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn, $user, $psw, $options);

    $sql = "select * from event where evt_no=:evt_no";
    $evtDetail = $pdo->prepare($sql);
    $evtDetail->bindValue(":evt_no",$_REQUEST["evt_no"]);
    $evtDetail->execute();
    $detailContent = $evtDetail->fetchObject();

    $detailHtml = 
        "<div class='regisContent' id='raiseForm'>
            <input type='hidden' name='evt_no' value='$detailContent->evt_no' id='evt_no'>
            <div class='cancelBtn'></div>
                <div class='titleWrapper'>
                    <h4>活動詳情</h4>
                </div>
                <div class='flexWrapper'>
                    <div class='graph'>
                        <div class='pic'>
                            <img src='evt_images/$detailContent->evt_cover_url' alt='Detail Pic' />
                        </div>
                        <div class='map'>
                            <iframe src='https://maps.google.com?output=embed&q=$detailContent->evt_place' width='300' height='450' frameborder='0' style='border:0' allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class='content'>
                        <h3>"."$detailContent->evt_name"."</h3>
                        <div class='item'>
                            <span>活動時間</span>
                            <p>"."$detailContent->evt_date"."</p>
                        </div>
                        <div class='item'>
                            <span>活動地點</span>
                            <p>"."$detailContent->evt_place"."</p>
                        </div>
                        <div class='item'>
                            <span>報名截止時間</span>
                            <p>"."$detailContent->enroll_end_date"."</p>
                        </div>
                        <div class='item'>
                            <span>人數限制</span>
                            <p>"."$detailContent->now_att"." / <span class='limitNum'>"."$detailContent->max_att"."</span></p>
                        </div>
                        <div class='item'>
                            <span>活動描述</span>
                            <p>"."$detailContent->evt_desc"."</p>
                        </div>
                    </div>
                </div>
            <div class='submitWrapper'>
                <input type='submit' value='我要參加' id='regisBtn'/>
            </div>
        </div>";
    echo $detailHtml;
} catch (PDOException $e) {
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}
