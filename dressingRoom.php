<?php
  ob_start();
  session_start();
  if(!isset($_SESSION["mem_name"])||($_SESSION["mem_name"] == "")){
      header("Location: /index.php");
      die();
  } else {
      $mem_no = $_SESSION["mem_no"];
      $mem_name = $_SESSION["mem_name"];
      $style_no = $_SESSION["style_no"];
      $mem_lv = $_SESSION["mem_lv"];
      $mem_avatar = $_SESSION["mem_avatar"];
      $squid_qty = $_SESSION["squid_qty"];
  };

  $errMsg = '';
  try {
    require_once('connectSquid.php');

    $sql = 
    "SELECT *
    FROM member
    WHERE mem_no = :mem_no
    ";
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_no", $mem_no);
    $member->execute();
    $memRow = $member->fetch(PDO::FETCH_ASSOC);

    $hatLength = 0;
    $cloLength = 0;
    $shoesLength = 0;

    // 從資料庫抓帽子
    $hatsSQL =
    "SELECT * 
    FROM product_clothing
    WHERE clo_type = :clo_type
    AND mem_lv <= :mem_lv";
    $hats = $pdo->prepare($hatsSQL); 
    $hats->bindValue(':clo_type', 1);
    $hats->bindValue(':mem_lv', $mem_lv);
    $hats->execute();

    // 從資料庫抓衣服
    $clothesSQL =
    "SELECT *
    FROM product_clothing
    WHERE clo_type = :clo_type
    AND mem_lv <= :mem_lv";
    $clothes = $pdo->prepare($clothesSQL);
    $clothes->bindValue(':clo_type', 2);
    $clothes->bindValue(':mem_lv', $mem_lv);
    $clothes->execute();

    // 從資料庫抓鞋子
    $shoesSQL =
    "SELECT *
    FROM product_clothing
    WHERE clo_type = :clo_type
    AND mem_lv <= :mem_lv";
    $shoes = $pdo->prepare($shoesSQL);
    $shoes->bindValue(':clo_type', 3);
    $shoes->bindValue(':mem_lv', $mem_lv);
    $shoes->execute();

  } catch(PDOException $e) {
    $errMsg .= $e->getMessage()."<br>";
    $errMsg .= $e->getLine()."<br>";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="css/reset.css" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
    <link rel="stylesheet" href="sass/style.css" />
    <title>收集友誼</title>
  </head>

  <body>
  <!-- vue -->
  <div id="app">
      <!-- 導覽列 -->
      <header class="common_header disabledScrollOnHover">
          <div class="menuMobile">
              <span class="menuMobile_circle"></span>
              <a href="#" class="menuMobile_link">
                  <span class="menuMobile_icon">
                      <span class="menuMobile_line menuMobile_line-1"></span>
                      <span class="menuMobile_line menuMobile_line-2"></span>
                      <span class="menuMobile_line menuMobile_line-3"></span>
                  </span>
              </a>
          </div>

          <div class="menuHandheld">
              <div class="menuMobile_overlay">
                  <div class="menuMobile_menu">
                      <ul class="memberInfo">
                          <li class="coin">
                              <a href="javascript:;">
                                  <img src="imgs/homePage/icon/coin.png" alt="持有金額icon">
                                  <span>{{squid_qty}}</span>
                              </a>
                          </li>
                          <li class="logo">
                              <a href="index.php">
                                  <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                                  <span>尋找友誼</span>
                              </a>
                          </li>
                          <li class="login">
                              <img src="imgs/homePage/icon/avatar.png" alt="角色頭像icon">
                              <span class="name">
                              <a href="javascript:;">{{user_id}}</a>
                              </span>
                              <span>
                              <a v-if="is_login()" v-on:click="logout">登出</a>
                              <a v-else>登入</a>
                              </span>
                          </li>
                      </ul>
                      <nav class="menuMobile_nav">
                          <li><a href="myRoom.php"> <img src="imgs/homePage/icon/room.png" alt="我的房間icon">
                                  <span>我的房間</span></a></li>
                          <li><a href="dressingRoom.php"><img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                                  <span>換衣間</span></a></li>
                          <li><a href="findfriend.php"> <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                                  <span>找朋友</span></a></li>
                          <li><a href="events.php"> <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                                  <span>揪團活動</span></a></li>
                          <li><a href="shop.php"> <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                                  <span>虛擬商城</span></a></li>
                          <li><a href="memberCenter.php"> <img src="imgs/homePage/icon/member.png" alt="會員中心icon">
                                  <span>會員中心</span></a></li>
                          <li><a href="javascript:;"> <img src="imgs/homePage/icon/robot.png" alt="客服機器人_icon">
                                  <span>客服機器人</span></a></li>
                          <li><a href="javascript:;"> <img src="imgs/homePage/icon/notice02.png" alt="通知_icon">
                                  <span>通知</span></a></li>
                      </nav>
                  </div>
              </div>
          </div>

          <nav class="menuDesktop">
              <ul>
                  <li class="hvr-pulse-grow">
                      <a href="myRoom.php">
                          <img src="imgs/homePage/icon/room.png" alt="我的房間icon">
                          <span>我的房間</span>
                      </a>
                  </li>
                  <li class="hvr-pulse-grow">
                      <a href="dressingRoom.php">
                          <img src="imgs/homePage/icon/fittingRoom.png" alt="換衣間icon">
                          <span>換衣間</span>
                      </a>
                  </li>
                  <li class="hvr-pulse-grow">
                      <a href="findfriend.php">
                          <img src="imgs/homePage/icon/friend.png" alt="找朋友icon">
                          <span>找朋友</span>
                      </a>
                  </li>
                  <li class="hvr-pulse-grow">
                      <a href="events.php">
                          <img src="imgs/homePage/icon/events.png" alt="揪團活動icon">
                          <span>揪團活動</span>
                      </a>
                  </li>
                  <li class="logo hvr-pulse-grow">
                      <a href="index.php">
                          <img src="imgs/homePage/logo.png" alt="尋找友誼網站LOGO">
                          <span>尋找友誼</span>
                      </a>
                  </li>
                  <li class="hvr-pulse-grow">
                      <a href="shop.php">
                          <img src="imgs/homePage/icon/mall.png" alt="虛擬商城icon">
                          <span>虛擬商城</span>
                      </a>
                  </li>
                  <li class="hvr-pulse-grow">
                      <a href="memberCenter.php">
                          <img src="imgs/homePage/icon/member.png" alt="會員中心icon">
                          <span>會員中心</span>
                      </a>
                  </li>
                  <div class="memberInfo">
                      <li class="login">
                          <img src="imgs/homePage/icon/avatar.png" alt="角色頭像icon">
                          <span class="name">
                          <a href="javascript:;">{{user_id}}</a>
                          </span>
                          <span>
                          <a v-if="is_login()" v-on:click="logout">登出</a>
                          <a v-else>登入</a>
                          </span>
                      </li>
                      <li class="coin">
                          <a href="javascript:;">
                              <img src="imgs/homePage/icon/coin.png" alt="持有金額icon">
                              <span>{{squid_qty}}</span>
                          </a>
                      </li>
                      <li class="level">
                          <a href="javascript:;">
                              <img v-if="mem_lv=='1'" src="imgs/homePage/icon/civilian.png" alt="平民等級icon">
                              <img v-if="mem_lv=='2'" src="imgs/homePage/icon/friend.png" alt="貴族等級icon">
                              <img v-if="mem_lv=='3'" src="imgs/homePage/icon/friend.png" alt="皇族等級icon">
                              <span>平民</span>                                                                                    
                          </a>
                      </li>
                  </div>
              </ul>
          </nav>
      </header>
  </div>

    <!-- 包一個大 div ，避免干擾 -->
    <div class="dressingRoom">
      <!-- 繪圖區塊 -->
      <div class="paintArea">
        <div class="customize">
          <h3>我的手繪衣</h3>
          <div class="paintShirt">
            <!-- 開繪圖燈箱區塊 -->
            <div class="startCreate">
              <img
                class="whiteShirt"
                src="imgs/dressingRoom/whiteShirt.png"
                alt="White Shirt"
              />
              <a id="startBtn" href="javascript:;">開始創作</a>
            </div>
            <img
              class="sprayBg"
              src="imgs/dressingRoom/spray.png"
              alt="Spray"
            />
          </div>
        </div>
        <!-- 油漆桶背景 -->
        <img class="paint" src="imgs/dressingRoom/paint.png" alt="Paint" />
      </div>
      <!-- 阿魷換新衣區塊 -->
      <div class="squidArea">
          <button id="confirmDressing">我穿好了</button>
          <div class="dressingZone">
            <img src="<?php echo $memRow["style_no"] ?>" alt="Squid" />
            <img
              class="changedHat"
              src="imgs/dressingRoom/furHat.png"
              alt="Changed Hat"
            />
            <img
              class="changedClo"
              src="imgs/dressingRoom/cowboyClo.png"
              alt="Changed Clothes"
            />
            <img
              class="changedShoes"
              src="imgs/dressingRoom/whiteShoes.png"
              alt="Changed Shoes"
            />
          </div>
          <form action="post" accept-charset="utf-8" id="dressedForm">
            <input type="hidden" id="dressedSquid" name="dressedSquid">
            <canvas id="dressingCanvas"></canvas>
          </form>
          <form action="post" accept-charset="utf-8" id="dressedForm_moving">
            <input type="hidden" id="dressedSquid_moving" name="dressedSquid_moving">
            <canvas id="dressingCanvas_moving"></canvas>
          </form>
      </div>
      <!-- 衣櫃區塊 -->
      <div class="clothesArea" id="clothesArea">
        <div class="wardrobe">
          <h3>我的衣櫃</h3>
          <!-- 衣櫃上蓋 -->
          <div class="top"></div>
          <div class="storages">
            <!-- 帽子區 -->
            <div class="hats storage">
              <div v-if="hatLength > 3" class="leftBtn"></div>
              <div class="owl-carousel owl-theme">
                <?php 
                  while($hatRow = $hats->fetch(PDO::FETCH_ASSOC)) {
                    $hatLength++;
                ?>
                  <div class="myItem">
                    <a class="changeHat" href="javascript:;"
                      ><img src="<?php echo $hatRow["clo_img_url"]; ?>" 
                      alt="Fur Hat"
                    /></a>
                  </div>
                <?php
                }
                ?>
              </div>
              <div v-if="hatLength > 3" class="rightBtn"></div>
            </div>
            <!-- 衣服區 -->
            <div class="clothes storage">
              <div v-if="cloLength > 3" class="leftBtn"></div>
              <div class="owl-carousel owl-theme">
                <?php
                  while($clothRow = $clothes->fetch(PDO::FETCH_ASSOC)) {
                    $cloLength++;
                ?>
                  <div class="myItem">
                    <a class="changeClo" href="javascript:;">
                      <img
                        src="<?php echo $clothRow["clo_img_url"]; ?>"
                        alt="Shirt clothes"
                      />
                    </a>
                  </div>
                <?php
                  }
                ?>
              </div>
              <div v-if="cloLength > 3" class="rightBtn"></div>
            </div>
            <!-- 鞋子區 -->
            <div class="shoes storage">
              <div v-if="shoesLength > 3" class="leftBtn"></div>
              <div class="owl-carousel owl-theme">
                <?php 
                  while($shoeRow = $shoes->fetch(PDO::FETCH_ASSOC)) {
                    $shoesLength++;
                ?>
                  <div class="myItem">
                    <a class="changeShoes" href="javascript:;">
                      <img
                        src="<?php echo $shoeRow["clo_img_url"]; ?>"
                        alt="White Shoes"
                      />
                    </a>
                  </div>
                <?php
                  }
                ?>
              </div>
              <div v-if="shoesLength > 3" class="rightBtn"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- 繪圖燈箱 -->
      <div class="lightBox">
        <div class="drawingBox">
          <span id="cancelBtn" href="javascript:;"></span>
          <h4>繪製衣服</h4>
          <!-- 選擇畫筆顏色＆大小區 -->
          <div class="drawingPart">
            <div class="choosingArea">
              <span>1. 選擇畫筆顏色＆大小</span>
              <ul>
                <li class="strokeSize">
                  <span class="subTitle">大小</span>
                  <!-- 筆畫大小 -->
                  <ul>
                    <li id="2w"></li>
                    <li id="5w"></li>
                    <li id="8w"></li>
                    <li id="12w"></li>
                    <li id="20w"></li>
                  </ul>
                </li>
                <li class="colorBar">
                  <span class="subTitle">顏色</span>
                  <input
                    type="range"
                    class="colorPicker"
                    step="1"
                    min="0"
                    max="360"
                    value="0"
                  />
                </li>
                <li id="clearAll">我要重畫</li>
              </ul>
            </div>
            <!-- 繪製衣服區 -->
            <div class="drawingArea">
              <form id="drawingForm" action="post" accept-charset="utf-8">
                <span>2. 繪製你的衣服</span>
                <input type="hidden" id="drawnImage" name="drawnImage">
                <canvas class="drawingFrame">
                </canvas>
              </form>
            </div>
          </div>
          <a id="confirmBtn" href="javascript:;">確認保存</a>
        </div>
      </div>
    </div>
    <!-- <script src="node_modules/gsap/src/minified/TweenMax.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <!-- <script src="node_modules/owl.carousel/dist/owl.carousel.min.js"></script> -->
    <!-- <script src="node_modules/gsap/src/minified/TweenMax.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js'></script>
    <script src="js/dressingRoom.js"></script>
    <script src="js/chat.js"></script>
    <script>
      new Vue({
        el: '#clothesArea',
        data: {
          hatLength: <?php echo $hatLength; ?>,
          cloLength: <?php echo $cloLength; ?>,
          shoesLength: <?php echo $shoesLength; ?>
        }
      });
    </script>

    <!-- 串navbar 登入功能 -->
    <script>
      $(document).ready(function(){
          <?php 
              if(isset($_SESSION["mem_name"])){
                echo "var mem_no='" . $_SESSION["mem_no"] . "';";
                echo "var mem_name='" . $_SESSION["mem_name"] . "';";
                echo "var style_no='" . $_SESSION["style_no"] . "';";
                echo "var mem_lv='" . $_SESSION["mem_lv"] . "';";
                echo "var mem_avatar='" . $_SESSION["mem_avatar"] . "';";
                echo "var squid_qty='" . $_SESSION["squid_qty"] . "';";
                echo "login(mem_name,style_no,mem_lv,mem_avatar,squid_qty);";
              }
          ?>
      });
    </script>
  </body>
</html>
