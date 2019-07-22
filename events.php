<?php
$errMsg = "";
try {
  $dns = "mysql:host=sql.uerica.com;port=3307;dbname=dd101g2;charset=utf8";
  $user = "dd101g2";
  $psw = "dd101g2";
  $options = array(PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  $pdo = new PDO($dns, $user, $psw, $options);

  // 取得最新的 5 筆活動
  $sql =
    "SELECT * 
  FROM event 
  ORDER BY evt_no 
  DESC LIMIT 5";
  $events = $pdo->prepare($sql);
  $events->execute();

  // 取得熱門的 5 筆活動
  $sql =
  "SELECT * 
  FROM event
  ORDER BY max_att / now_att  
  LIMIT 5";
  $popEvents = $pdo->prepare($sql);
  $popEvents->execute();

  // 取得 banner 活動
  $sql = "SELECT *
  FROM event
  WHERE is_banner = 1";
  $BannerEvt = $pdo->prepare($sql);
  $BannerEvt->execute();
  $BannerRow = $BannerEvt->fetchObject();

  // 取得最新活動的好友人數
  $sql = "select DISTINCT er.evt_no ,COUNT(*) AS 'all'
  from relationship r , event_record er
  where er.mem_no = r.friend_no and r.status=1 and r.mem_no = :mem_no GROUP BY evt_no";
  $friendsOfEvt = $pdo->prepare($sql);
  $friendsOfEvt->bindValue(":mem_no", "112"); // from session
  $friendsOfEvt->execute();

  // 取得熱門活動的好友人數
  $sql = "select DISTINCT er.evt_no ,COUNT(*) AS 'all'
  from relationship r , event_record er
  where er.mem_no = r.friend_no and r.status=1 and r.mem_no = :mem_no GROUP BY evt_no";
  $friendsOfPopEvt = $pdo->prepare($sql);
  $friendsOfPopEvt->bindValue(":mem_no", "112"); // from session
  $friendsOfPopEvt->execute();

  // 判斷是否已報名
  $sql = "
  SELECT * 
  FROM event_record
  WHERE mem_no = :mem_no
  ";
  $alreadyRegis = $pdo->prepare($sql);
  $alreadyRegis->bindValue(':mem_no', '112');  // from SESSION
  $alreadyRegis->execute();

  $alreadyRegisArr = array();
  while($alreadyRow = $alreadyRegis->fetchObject()) {
    array_push($alreadyRegisArr, $alreadyRow->evt_no);
  }



} catch (PDOException $e) {
  echo "錯誤 : ", $e->getMessage(), "<br>";
  echo "行號 : ", $e->getLine(), "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="sass/style.css" />
  <title>收集友誼</title>
</head>

<body>
  <div class="events">

    <img class="squidPlaying" src="eventsImg/squidPlaying.png" alt="Squid Playing" />
    <div id="canvas" width="200" height="200"></div>
    <svg id="bbqSquid" xmlns="http://www.w3.org/2000/svg" width="247" height="252" viewBox="0 0 247 252">
      <defs>
        <style>
          .cls-1 {
            fill: #615667;
          }

          .cls-2 {
            fill: #ff8282;
          }

          .cls-2,
          .cls-3,
          .cls-6 {
            fill-rule: evenodd;
          }

          .cls-3,
          .cls-5 {
            fill: #fff;
          }

          .cls-4 {
            fill: #606060;
          }

          .cls-6 {
            fill: #b93434;
          }
        </style>
      </defs>
      <rect id="矩形_3_拷貝_18" data-name="矩形 3 拷貝 18" class="cls-1" y="46" width="247" height="6" rx="1.402" ry="1.402" />
      <rect id="矩形_3_拷貝_19" data-name="矩形 3 拷貝 19" class="cls-1" x="230" y="46" width="7" height="206" rx="1.402" ry="1.402" />
      <rect id="矩形_3_拷貝_20" data-name="矩形 3 拷貝 20" class="cls-1" x="13" y="46" width="7" height="206" rx="1.402" ry="1.402" />
      <path id="矩形_2_拷貝_25" data-name="矩形 2 拷貝 25" class="cls-2" d="M214.134,70.172h85.95a10.244,10.244,0,0,1,10.244,10.244V125.8a10.243,10.243,0,0,1-10.244,10.244h-85.95A10.243,10.243,0,0,1,203.891,125.8V80.416A10.243,10.243,0,0,1,214.134,70.172Z" transform="translate(-124 -56)" />
      <path id="多邊形_1_拷貝_33" data-name="多邊形 1 拷貝 33" class="cls-2" d="M314.532,139.989q-44.985,36-44.984-36t44.984-36Q359.514,103.994,314.532,139.989Z" transform="translate(-124 -56)" />
      <path id="矩形_3_拷貝_17" data-name="矩形 3 拷貝 17" class="cls-2" d="M180.417,82.609h46.916a1.4,1.4,0,0,1,1.4,1.4v6.228a1.4,1.4,0,0,1-1.4,1.4H180.417a1.4,1.4,0,0,1-1.4-1.4V84.011A1.4,1.4,0,0,1,180.417,82.609Z" transform="translate(-124 -56)" />
      <path id="矩形_3_拷貝_17-2" data-name="矩形 3 拷貝 17" class="cls-2" d="M180.417,99.484h46.916a1.4,1.4,0,0,1,1.4,1.4v6.2a1.4,1.4,0,0,1-1.4,1.4H180.417a1.4,1.4,0,0,1-1.4-1.4v-6.2A1.4,1.4,0,0,1,180.417,99.484Z" transform="translate(-124 -56)" />
      <path id="矩形_3_拷貝_17-3" data-name="矩形 3 拷貝 17" class="cls-2" d="M180.417,116.391h46.916a1.4,1.4,0,0,1,1.4,1.4v6.072a1.4,1.4,0,0,1-1.4,1.4H180.417a1.4,1.4,0,0,1-1.4-1.4v-6.072A1.4,1.4,0,0,1,180.417,116.391Z" transform="translate(-124 -56)" />
      <path id="橢圓_2_拷貝_28" data-name="橢圓 2 拷貝 28" class="cls-3" d="M255.328,81.609A5.391,5.391,0,1,1,250.016,87,5.352,5.352,0,0,1,255.328,81.609Z" transform="translate(-124 -56)" />
      <circle id="橢圓_2_拷貝_28-2" data-name="橢圓 2 拷貝 28" class="cls-4" cx="132.219" cy="32.844" r="3.969" />
      <circle id="橢圓_2_拷貝_28-3" data-name="橢圓 2 拷貝 28" class="cls-5" cx="131.344" cy="59.438" r="5.313" />
      <circle id="橢圓_2_拷貝_28-4" data-name="橢圓 2 拷貝 28" class="cls-4" cx="132.219" cy="62.062" r="3.969" />
      <path id="橢圓_3_拷貝_25" data-name="橢圓 3 拷貝 25" class="cls-6" d="M229.563,92.391c3.425,0,6.2,4.351,6.2,9.718s-2.778,9.719-6.2,9.719-6.2-4.351-6.2-9.719S226.137,92.391,229.563,92.391Z" transform="translate(-124 -56)" />
    </svg>

    <div id="fireFigure">
      <div class="fire">
        <div class="bottom"></div>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
      </div>
      <div class="reverse">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <img id="woods" src="eventsImg/woods.png" alt="Woods" />

    <div class="eventsWrapper">
      <section class="aboutToCloseEvent">
        <img src="eventsImg/hotBallon.png" alt="Hot Ballon" class="hotBallon" />
        <div class="main">
          <div class="eventPic">
            <img src="evt_images/<?php echo $BannerRow->evt_cover_url ?>" alt="Banner Pic" />
          </div>
          <div class="content">
            <div class="title">
              <h3><?php echo $BannerRow->evt_name ?></h3>
              <span class="period"><?php echo $BannerRow->evt_date; ?></span>
            </div>
            <div class="desc">
              <ul>
                <li><?php echo $BannerRow->evt_place ?></li>
                <li>剩餘名額：<?php echo $BannerRow->max_att - $BannerRow->now_att; ?>人</li>
              </ul>
              <div class="submitWrapper">
                <input type="hidden" name="evt_no" value="<?php echo $BannerRow->evt_no ?>">
                <?php
                  if(in_array($BannerRow->evt_no, $alreadyRegisArr)) {
                    echo '<input type="submit" value="已報名" disabled/>';
                  } else {
                    echo '<input type="submit" value="速速報名" />';
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="pronounce">
          <img src="eventsImg/bannerSquid.png" alt="Banner Squid" class="bannerSquid" />
          <div class="bubbles">
            <span class="bubble bubble1"></span>
            <span class="bubble bubble2"></span>
            <span class="bubble bubble3">就缺你一個~</span>
          </div>
        </div>
      </section>
      <div class="flexWrapper">
        <section class="normalEvents">
          <ul class="bookMarks evt_title">
            <li>
              <img src="eventsImg/bookMarkDark.png" alt="Book Mark" /><span><a href="#newEvt">最新活動</a></span>
            </li>
            <li>
              <img src="eventsImg/bookMarkLight.png" alt="Book Mark" /><span><a href="#popEvt">熱門活動</a></span>
            </li>
          </ul>
          <div id="newEvt" class="eventDescs evt_inner">

            <?php
            while ($newEvtRow = $events->fetchObject()) {
              ?>
              <div class="singleEvent">
                <div class="pic">
                  <img src="eventsImg/eventPic.jpg" alt="Event Pic" />
                </div>
                <div class="content">
                  <div class="title">
                    <h3><?php echo $newEvtRow->evt_name ?></h3>
                    <span class="period"><?php echo $newEvtRow->evt_date ?></span>
                  </div>
                  <div class="desc">
                    <ul>
                      <li>地點：<?php echo $newEvtRow->evt_place ?></li>
                      <li>
                        <figure class="friendIcons">
                          <img src="eventsImg/attendFriend1.png" alt="already attended Friend" />
                          <img src="eventsImg/attendFriend2.png" alt="already attended Friend" />
                          <img src="eventsImg/attendFriend3.png" alt="already attended Friend" />
                        </figure>
                        <span>
                          <?php
                          $gotFriend = false;
                          $friendNum = 0;
                          while ($friendCount = $friendsOfEvt->fetchObject()) {
                            if ($friendCount->evt_no == $newEvtRow->evt_no) {
                              $gotFriend = true;
                              $friendNum = $friendCount->all;
                            }
                          }
                          if ($gotFriend) {
                            echo $friendNum;
                          } else {
                            echo 0;
                          }
                          ?>
                          個好友有參加</span>
                      </li>
                    </ul>
                    <div class="submitWrapper">
                      <input type="hidden" name="evt_no" value="<?php echo $newEvtRow->evt_no ?>">
                      <?php
                        if(in_array($newEvtRow->evt_no, $alreadyRegisArr)) {
                          echo '<input type="submit" value="已報名" disabled/>';
                        } else {
                          echo '<input type="submit" value="我要報名" />';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
          <div id="popEvt" class="eventDescs evt_inner">
          <?php 
          while($popRow = $popEvents->fetchObject()) {
          ?>
            <div class="singleEvent">
                <div class="pic">
                  <img src="eventsImg/eventPic.jpg" alt="Event Pic" />
                </div>
                <div class="content">
                  <div class="title">
                    <h3><?php echo $popRow->evt_name ?></h3>
                    <span class="period"><?php echo $popRow->evt_date ?></span>
                  </div>
                  <div class="desc">
                    <ul>
                      <li>地點：<?php echo $popRow->evt_place ?></li>
                      <li>
                        <figure class="friendIcons">
                          <img src="eventsImg/attendFriend1.png" alt="already attended Friend" />
                          <img src="eventsImg/attendFriend2.png" alt="already attended Friend" />
                          <img src="eventsImg/attendFriend3.png" alt="already attended Friend" />
                        </figure>
                        <span>
                          <?php
                          $gotFriend = false;
                          // $friendNum = 0;
                          // echo $popRow->evt_no;
                          while ($friendCount = $friendsOfPopEvt->fetchObject()) {
                            echo print_r($friendCount->all);
                            if ($friendCount->evt_no == $popRow->evt_no) {
                              $gotFriend = true;
                              $friendNum = $friendCount->all;
                            }
                          }
                          if ($gotFriend) {
                            echo $friendNum;
                          } else {
                            echo 0;
                          }
                          ?>
                          個好友有參加</span>
                      </li>
                    </ul>
                    <div class="submitWrapper">
                      <input type="hidden" name="evt_no" value="<?php echo $popRow->evt_no ?>">
                      <?php
                        if(in_array($popRow->evt_no, $alreadyRegisArr)) {
                          echo '<input type="submit" value="已報名" disabled/>';
                        } else {
                          echo '<input type="submit" value="我要報名" />';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
          }
          ?>
          </div>
        </section>
        <section class="myEvents">
          <div class="head">
            <img src="eventsImg/squidHead.png" alt="Squid Head" />
          </div>
          <div class="body">
            <img src="eventsImg/squidLeftHand.png" alt="Left Hand" class="leftHand" />
            <img src="eventsImg/squidRightHand.png" alt="Right Hand" class="rightHand" />
            <div class="bodyContent">
              <ul class="myEvt_title">
                <li><a href="#myAttend">我參加的</a></li>
                <li><a href="#myRaise">我舉辦的</a></li>
              </ul>
              <div class="eventDescs">
                <div id="myAttend" class="myAttend myEvt_inner">
                  <div class="singleEvent">
                    <div class="content">
                      <div class="title">
                        <h3>太魯閣一日遊</h3>
                        <span class="period">7/1 ~ 7/15</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myRaise" class="myRaise myEvt_inner">
                  <div class="singleEvent">
                    <div class="content">
                      <div class="title">
                        <h3>太魯閣五日遊</h3>
                        <span class="period">7/1 ~ 7/15</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="raiseBtnWrapper">
              <span id="raiseBtn">我要舉辦</span>
            </div>
          </div>
        </section>
      </div>
    </div>

    <!-- 報名燈箱 -->
    <div id="evtDetail" class="regisBox">
      <div class="regisContent">
        <div class="cancelBtn"></div>
        <div class="titleWrapper">
          <h4>活動詳情</h4>
        </div>
        <div class="flexWrapper">
          <div class="graph">
            <div class="pic">
              <img src="eventsImg/detailPic.jpg" alt="Detail Pic" />
            </div>
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3616.9493929116593!2d121.18946451500494!3d24.967836384003363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346823c1920a1b7f%3A0x6502863b00922978!2zVGliYU1lIHgg6LOH562W5pyD5pm65oWnQVBQ5pW05ZCI6ZaL55m86aSK5oiQ54-t!5e0!3m2!1szh-TW!2stw!4v1562408130743!5m2!1szh-TW!2stw" width="300" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="content">
            <h3>與昕昕浮潛一日遊</h3>
            <div class="item">
              <span>活動時間</span>
              <p>2019.7.1 ~ 2019.7.15</p>
            </div>
            <div class="item">
              <span>活動地點</span>
              <p>澎湖縣將軍澳160號</p>
            </div>
            <div class="item">
              <span>截止時間</span>
              <p>2019.6.30</p>
            </div>
            <div class="item">
              <span>人數限制</span>
              <p>22 / <span class="limitNum">30</span></p>
            </div>
            <div class="item">
              <span>活動描述</span>
              <p>
                跟著專業的教練悠遊於湛藍的海底 世界，體驗各種輕重裝潛水活動，
                潛入水裡尋找海底郵筒，寄出親筆 書寫的溫馨明信片，輕鬆享受海中
                樂趣也留下難忘的回憶！
              </p>
            </div>
          </div>
        </div>
        <div class="submitWrapper">
          <input type="button" value="我要參加" id="regisBtn" />
        </div>
      </div>
    </div>

    <!-- 舉辦燈箱 -->
    <form id="addEvtForm">
      <div class="raiseBox">
        <div class="raiseContent">
          <div class="cancelBtn"></div>
          <div class="titleWrapper">
            <h4>舉辦活動</h4>
          </div>
          <div class="flexWrapper">
            <div class="graph">
              <span class="raiseData">1.上傳照片</span>
              <div class="picUpload">
                <input id="evt_cover_url" name="evt_cover_url" type="file" value="選擇檔案" />
              </div>
              <div class="pic">
                <img id="imgPreview" src="eventsImg/detailPic.jpg" alt="Detail Pic" />
              </div>
            </div>
            <div class="content">
              <span class="raiseData">2.填寫內容</span>
              <div class="item">
                <span>活動名稱</span>
                <input type="text" id="evt_name" name="evt_name" required />
              </div>
              <div class="item">
                <span>活動時間</span>
                <input type="date" placeholder="開始時間" id="evt_date" name="evt_date" required />
              </div>
              <div class="item">
                <span>活動地點</span>
                <input id="evt_place" name="evt_place" required>
              </div>
              <div class="item">
                <span>報名截止時間</span>
                <input type="date" id="enroll_end_date" name="enroll_end_date" required />
              </div>
              <div class="item">
                <span>人數限制</span>
                <input type="number" id="max_att" min="3" max="20" name="max_att" placeholder="3~20人" required />
              </div>
              <div class="item">
                <span>活動描述</span>
                <textarea cols="30" id="evt_desc" name="evt_desc" required></textarea>
              </div>
            </div>
          </div>
          <div id="evt_init" class="submitWrapper">
            <input type="button" value="確定舉辦" />
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
  <script src="js/events.js"></script>
</body>

</html>