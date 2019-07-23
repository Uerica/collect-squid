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
?>
<?php
$errMsg = "";
try {
    require_once("connectDB.php");

    $sql = "select * from member";  //...............
    $products = $pdo->query($sql);
    $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "錯誤 : ", $e->getMessage(), "<br>";
    echo "行號 : ", $e->getLine(), "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="sass/style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <!-- <script src="js/jquery-3.4.1.min.js"></script> -->
    <!-- <script src="js/vue.js"></script> -->

    <title>會員中心</title>
</head>

<body>

    <?php
    $errMsg = "";
    try {
        require_once("connectDB.php");

        $sql = "select * from member where mem_no = :mem_no";
        $members = $pdo->prepare($sql);
        $members->bindValue(":mem_no", $_SESSION["mem_no"]); //寫session時改
        // $members->bindValue(":mem_pwd","111");
        $members->execute();
        // $found = false;
        if ($members->rowCount() != 0) {
            $memberArr = $members->fetchAll();
        }
    } catch (PDOException $e) {
        echo "錯誤 : ", $e->getMessage(), "<br>";
        echo "行號 : ", $e->getLine(), "<br>";
    }

    ?>


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




    <!-- 通知&客服機器人 -->






    <!-- 會員中心  -->
    <div class="member_center">
        <div class="memBg">

            <!-- 雲 -->
            <div class="cloud_1 cloud">
                <img src="imgs/memberCenter/cloud1.png" alt="cloud_1">
            </div>
            <div class="cloud_2 cloud">
                <img src="imgs/memberCenter/cloud2.png" alt="cloud_2">
            </div>
            <div class="cloud_3 cloud">
                <img src="imgs/memberCenter/cloud3.png" alt="cloud_3">
            </div>
            <div class="cloud_4 cloud">
                <img src="imgs/memberCenter/cloud4.png" alt="cloud_4">
            </div>
            <div class="cloud_5 cloud">
                <img src="imgs/memberCenter/cloud5.png" alt="cloud_5">
            </div>
            <div class="cloud_6 cloud">
                <img src="imgs/memberCenter/cloud6.png" alt="cloud_6">
            </div>



            <div class="memArea">
                <div class="memAreaMiddlebox">
                    <div class="memPhoto_phone">
                        <img src="imgs/memberCenter/memCenter_photo.png" alt="會員魷魚圖">
                    </div>
                    <!-- <div class="memFileMidbox"> *****-->
                    <div class="memFile">
                        <!--手機版用-->
                        <center>基本資訊</center>

                        <!-- 會員資訊欄 -->
                        <div id="memInfo_phone" class="memFileWrapInfo">
                            <!-- <form action=""> -->
                            <div class="memInfoWrapTable">
                                <?php
                                if ($members->rowCount() != 0) {
                                    // $member = $members->fetch();
                                    $member = $memberArr[0];
                                    $found = true;
                                    // echo "<pre>";
                                    // print_r($member);
                                    // echo "</pre>";

                                    ?>
                                    <table>
                                        <tr>
                                            <th>編號:</th>
                                            <td><?php echo $member["mem_no"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>暱稱:</th>
                                            <td><?php echo $member["mem_name"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>性別:</th>
                                            <td><?php echo ($member["mem_gender"] == "M") ? "男" : "女"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>生日:</th>
                                            <td><?php echo $member["mem_dob"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>星座:</th>
                                            <td><?php echo $member["mem_sign"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>帳號:</th>
                                            <td><?php echo $member["mem_name"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>密碼:</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>信箱:</th>
                                            <td><?php echo $member["mem_email"]; ?></td>
                                        </tr><!-- -->
                                    </table>
                                <?php
                                } else {
                                    //echo "no";
                                }
                                ?>

                                <div class="memFileInfoBtn">
                                    <button id="Edit_phone" class="btnEdit">編輯基本資料</button>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>


                        <!-- form表單,input輸入 -->
                        <div id="memForm_phone" class="memFileWrapForm">
                            <!-- <form action=""> -->
                            <div class="memFileWrapTable">
                                <form id="myForm_phone" action="memUpdate.php">
                                    <table>
                                        <tr>
                                            <th>編號:</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>暱稱:</th>
                                            <td><input type="text" name="mem_name" value="<?php echo $member["mem_name"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>性別:</th>
                                            <td>
                                                <select name="mem_gender">
                                                    <option value="M" <?php if ($member["mem_gender"] == "M") {
                                                                            echo "selected";
                                                                        } ?>>男</option>
                                                    <option value="F" <?php if ($member["mem_gender"] == "F") {
                                                                            echo "selected";
                                                                        } ?>>女</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>生日:</th>
                                            <td><input type="date" name="mem_dob" value="<?php echo $member["mem_dob"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>星座:</th>
                                            <td><span><?php echo $member["mem_sign"]; ?></span><input type="hidden" name="mem_sign" value="<?php echo $member["mem_sign"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;
                                                <!--帳號:-->
                                            </th>
                                            <td>&nbsp;
                                                <!--<input type="text">-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>密碼:</th>
                                            <td><input type="password" name="mem_pwd" value="<?php echo $member["mem_pwd"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>信箱:</th>
                                            <td><input type="email" name="mem_email" value="<?php echo $member["mem_email"]; ?>"></td>
                                        </tr><!-- -->
                                    </table>


                                    <!-- </div> *****-->
                                    <div class="memFileBtn">
                                        <input type="submit" id="confirm_phone" class="btnConfirm" value="確認修改">
                                        <!-- <button></button> -->
                                        <button id="cancel_phone" class="btnCanncel">取消</button>
                                    </div>
                            </div>
                            </form>
                            <!-- </form> -->

                        </div>
                    </div>



                    <div class="memFile_web">
                        <!-- 電腦版用 -->
                        <center>基本資訊</center>

                        <!-- 會員資訊欄 -->
                        <div id="memInfo_web" class="memFileWrapInfo">
                            <!-- <form action=""> -->
                            <?php
                            if ($members->rowCount() != 0) {
                                // $member = $members->fetch();
                                $member = $memberArr[0];
                                $found = true;
                                // echo "<pre>";
                                // print_r($member);
                                // echo "</pre>";

                                ?>
                                <table>
                                    <tr>
                                        <th>編號:</th>
                                        <td><?php echo $member["mem_no"]; ?></td>
                                        <th>星座:</th>
                                        <td><?php echo $member["mem_sign"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>暱稱:</th>
                                        <td><?php echo $member["mem_name"]; ?></td>
                                        <th>帳號:</th>
                                        <td><?php echo $member["mem_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>性別:</th>
                                        <td><?php echo ($member["mem_gender"] == "M") ? "男" : "女"; ?></td>
                                        <th>密碼:</th>
                                        <td>
                                            <!--<button>修改密碼</button>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>生日:</th>
                                        <td><?php echo $member["mem_dob"]; ?></td>
                                        <th>信箱:</th>
                                        <td><?php echo $member["mem_email"]; ?></td>
                                    </tr>
                                </table>
                            <?php
                            } else {
                                // echo "no";
                            }
                            ?>


                            <!-- </div> *****-->
                            <div class="memFileInfoBtn">
                                <button id="Edit_web" class="btnEdit">編輯基本資料</button>
                            </div>
                            <!-- </form> -->
                        </div>

                        <!-- form表單,input輸入 -->
                        <div id="memForm_web" class="memFileWrapForm">
                            <div class="memFileForm_web">
                                <form id="myForm_web" action="memUpdate.php">
                                    <table>
                                        <tr>
                                            <th>編號:</th>
                                            <td></td>
                                            <th>星座:</th>
                                            <td><span><?php echo $member["mem_sign"]; ?></span><input type="hidden" name="mem_sign" value="<?php echo $member["mem_sign"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>暱稱:</th>
                                            <td><input type="text" name="mem_name" value="<?php echo $member["mem_name"]; ?>"></td>
                                            <th>&nbsp;
                                                <!--帳號:-->
                                            </th>
                                            <td>&nbsp;
                                                <!--<input type="text">-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>性別:</th>
                                            <td>
                                                <select name="mem_gender">
                                                    <option value="M" <?php if ($member["mem_gender"] == "M") {
                                                                            echo "selected";
                                                                        } ?>>男</option>
                                                    <option value="F" <?php if ($member["mem_gender"] == "F") {
                                                                            echo "selected";
                                                                        } ?>>女</option>
                                                </select>

                                            </td>
                                            <th>密碼:</th>
                                            <td><input type="password" name="mem_pwd" value="<?php echo $member["mem_pwd"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>生日:</th>
                                            <td><input type="date" name="mem_dob" value="<?php echo $member["mem_dob"]; ?>"></td>
                                            <th>信箱:</th>
                                            <td><input type="email" name="mem_email" value="<?php echo $member["mem_email"]; ?>"></td>
                                        </tr>
                                    </table>



                                    <!-- </div> *****-->
                                    <div class="memFileBtn">
                                        <input type="submit" id="confirm_web" class="btnConfirm" value="確認修改">
                                        <!-- <button></button> -->
                                        <button id="cancel_web" class="btnCanncel">取消</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>




                </div>

            </div>


            <!-- 手機版 記錄區 -->

            <!-- (手機)留言記錄 抓MySQL內容 -->
            <?php
            $errMsg = "";
            try {
                require_once("connectDB.php");

                $sql = "select * from board_comment where cmt_cnt=:cmt_cnt";
                $msgRecords = $pdo->prepare($sql);
                $msgRecords->bindValue(":cmt_cnt", "小魷你家好漂亮!!"); //???
                // $msgRecords->bindValue(":mem_pwd","111");
                $msgRecords->execute();
                // $found = false;

            } catch (PDOException $e) {
                echo "錯誤 : ", $e->getMessage(), "<br>";
                echo "行號 : ", $e->getLine(), "<br>";
            }

            ?>

            <?php
            if ($msgRecords->rowCount() != 0) {
                $msgRecord = $msgRecords->fetch();
                $found = true;
                // echo "<pre>";
                // print_r($member);
                // echo "</pre>";

                ?>

                <div id="msgRecord" class="msgRecord">
                    <div class="msgRecordInnerBG">
                        <div class="msgRecordText">

                            <div class="msgRecordText_img">
                                <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                            </div>
                            <div class="msgRecordText_words">
                                <p><?php echo $msgRecord["cmt_cnt"]; ?>
                                    <!--魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。-->
                                </p>
                            </div>

                        </div>
                        <div class="msgRecordText">

                            <div class="msgRecordText_img">
                                <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                            </div>
                            <div class="msgRecordText_words">
                                <p>魷魚好辣跟她的家都超辣的，希望我或我
                                    的家也能有她一半那麼辣就好了，希望她
                                    能加我好友。</p>
                            </div>

                        </div>
                        <div class="msgRecordText"></div>
                        <div class="msgRecordText"></div>
                        <div class="msgRecordText"></div>

                    </div>
                </div>
            <?php
            } else {
                // echo "no";
            }
            ?>



            <!-- (手機)揪團記錄 抓MySQL內容 -->
            <?php
            $errMsg = "";
            try {
                require_once("connectDB.php");

                $sql = "select * from event where evt_name=:evt_name";
                $grpRecords = $pdo->prepare($sql);
                $grpRecords->bindValue(":evt_name", "太魯閣一日遊"); //???
                // $grpRecords->bindValue(":mem_pwd","111");
                $grpRecords->execute();
                // $found = false;

            } catch (PDOException $e) {
                echo "錯誤 : ", $e->getMessage(), "<br>";
                echo "行號 : ", $e->getLine(), "<br>";
            }

            ?>

            <?php
            if ($grpRecords->rowCount() != 0) {
                $grpRecord = $grpRecords->fetch();
                $found = true;
                // echo "<pre>";
                // print_r($member);
                // echo "</pre>";

                ?>
                <div id="grpRecord" class="groupRecord">

                    <div class="groupRecordInnerBG">
                        <div class="groupRecordText">

                            <div class="groupRecordText_img">
                                <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                            </div>
                            <div class="groupRecordText_words">
                                <p><?php echo $grpRecord["evt_name"]; ?>
                                    <!--魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。參加揪團。-->
                                </p>
                            </div>

                        </div>
                        <div class="groupRecordText">

                            <div class="groupRecordText_img">
                                <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                            </div>
                            <div class="groupRecordText_words">
                                <p>魷魚好辣跟她的家都超辣的，希望我或我
                                    的家也能有她一半那麼辣就好了，希望她
                                    能加我好友。參加揪團。</p>
                            </div>

                        </div>
                        <div class="groupRecordText"></div>
                        <div class="groupRecordText"></div>
                        <div class="groupRecordText"></div>

                    </div>
                <?php
                } else {
                    // echo "no";
                }
                ?>


            </div>
            <div id="shopRecord" class="shopRecord">

                <div class="shopRecordInnerBG">
                    <div class="shopRecordText">

                        <div class="shopRecordText_img">
                            <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                        </div>
                        <div class="shopRecordText_words">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。購物購物記錄。</p>
                        </div>

                    </div>
                    <div class="shopRecordText">

                        <div class="shopRecordText_img">
                            <img src="imgs/memberCenter/member.jpg" alt="人物圖">
                        </div>
                        <div class="shopRecordText_words">
                            <p>魷魚好辣跟她的家都超辣的，希望我或我
                                的家也能有她一半那麼辣就好了，希望她
                                能加我好友。購物購物記錄。</p>
                        </div>

                    </div>
                    <div class="shopRecordText"></div>
                    <div class="shopRecordText"></div>
                    <div class="shopRecordText"></div>

                </div>

            </div>


            <div class="recordArea">
                <div id="msgRecordBtn" class="recordBtn">留言記錄</div>
                <div id="grpRecordBtn" class="recordBtn">揪團記錄</div>
                <div id="shopRecordBtn" class="recordBtn">購物記錄</div>
            </div>

            <script>
                // $(window).onload(funciton(){
                // $("#msgRecordBtn").click(function () {
                //     $("#msgRecord").toggle();
                //     $("#grpRecord").hide();
                //     $("#shopRecord").hide();
                // });

                // $("#grpRecordBtn").click(function () {
                //     $("#msgRecord").hide();
                //     $("#grpRecord").toggle();
                //     $("#shopRecord").hide();
                // });

                // $("#shopRecordBtn").click(function () {
                //     $("#msgRecord").hide();
                //     $("#grpRecord").hide();
                //     $("#shopRecord").toggle();
                // });
                // });
            </script>





            <!-- 電腦版 記錄區 -->
            <div class="recordArea_web">
                <ul class="recordAreaUl_web">
                    <li id="msgLi" class="yellow">留言記錄</li>
                    <li id="grpLi" class="white">揪團記錄</li>
                    <li id="shopLi" class="white">購物記錄</li>
                </ul>

                <!-- 留言記錄 抓MySQL內容 -->
                <?php
                $errMsg = "";
                try {
                    require_once("connectDB.php");

                    $sql = "select * from board_comment where cmt_cnt=:cmt_cnt";
                    $msgRecords = $pdo->prepare($sql);
                    $msgRecords->bindValue(":cmt_cnt", "小魷你家好漂亮!!"); //???
                    // $msgRecords->bindValue(":mem_pwd","111");
                    $msgRecords->execute();
                    // $found = false;

                } catch (PDOException $e) {
                    echo "錯誤 : ", $e->getMessage(), "<br>";
                    echo "行號 : ", $e->getLine(), "<br>";
                }

                ?>

                <?php
                if ($msgRecords->rowCount() != 0) {
                    $msgRecord = $msgRecords->fetch();
                    $found = true;
                    // echo "<pre>";
                    // print_r($member);
                    // echo "</pre>";

                    ?>

                    <div id="msgRecord_web" class="msgRecord_web">

                        <!-- 留言記錄 電腦版 -->

                        <!-- 會員記錄的資訊內容 -->
                        <div id="msgBlock_web" class="msgRecordWrapforrecord">
                            <div class="msgRecordWrap">
                                <div class="msgRecordWrapforflex">
                                    <div class="msgRecordImg">
                                        <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                                    </div>
                                    <div class="msgRecordRightWrap">
                                        <div class="msgRecordText">
                                            <p><?php echo $msgRecord["cmt_cnt"]; ?>
                                                <!--魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。留言記錄-->
                                            </p>
                                        </div>

                                        <div class="msgRecordEditBtn_web">
                                            <!-- <input type="submit" id="msgEdit_web" class="btnEdit_web" value="編輯"> -->
                                            <input type="submit" id="msgDelete_web" class="btnDelete_web" value="刪除">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 示意&測試用區塊,不需要了 -->
                        <!-- <div class="msgRecordWrapforrecord">
    <div class="msgRecordWrap">
    
    </div>
    </div>
    <div class="msgRecordWrapforrecord">
    <div class="msgRecordWrap">
    
    </div>
    </div>
    <div class="msgRecordWrapforrecord">
    <div class="msgRecordWrap">
    
    </div>
    </div> -->

                    <?php
                    } else {
                        // echo "no";
                    }
                    ?>



                    <!-- form表單,input輸入 -->
                    <div id="msgInput_web" class="msgRecordWrapforinput">
                        <div class="msgRecordWrap">
                            <div class="msgRecordWrapforflex">
                                <div class="msgRecordImg">
                                    <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                                </div>
                                <div class="msgRecordRightWrap">
                                    <div class="msgRecordText">
                                        <input type="text">
                                    </div>

                                    <div class="msgRecordEditBtn_web">
                                        <input type="submit" id="msgConfirm_web" class="btnConfirm_web" value="確認">
                                        <input type="submit" id="msgCanncel_web" class="btnCancel_web" value="取消">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- 揪團記錄 抓MySQL內容 -->
                <?php
                $errMsg = "";
                try {
                    require_once("connectDB.php");

                    $sql = "select * from event where evt_name=:evt_name";
                    $grpRecords = $pdo->prepare($sql);
                    $grpRecords->bindValue(":evt_name", "太魯閣一日遊"); //???
                    // $grpRecords->bindValue(":mem_pwd","111");
                    $grpRecords->execute();
                    // $found = false;

                } catch (PDOException $e) {
                    echo "錯誤 : ", $e->getMessage(), "<br>";
                    echo "行號 : ", $e->getLine(), "<br>";
                }

                ?>

                <?php
                if ($grpRecords->rowCount() != 0) {
                    $grpRecord = $grpRecords->fetch();
                    $found = true;
                    // echo "<pre>";
                    // print_r($member);
                    // echo "</pre>";

                    ?>

                    <!-- 揪團記錄 電腦版 -->
                    <div id="grpRecord_web" class="grpRecord_web">
                        <div id="msgBlock_web" class="msgRecordWrapforrecord">
                            <div class="msgRecordWrap">
                                <div class="msgRecordWrapforflex">
                                    <div class="msgRecordImg">
                                        <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                                    </div>
                                    <div class="msgRecordRightWrap">
                                        <div class="msgRecordText">
                                            <p><?php echo $grpRecord["evt_name"]; ?>
                                                <!--魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。揪團紀錄-->
                                            </p>
                                        </div>

                                        <div class="msgRecordEditBtn_web">
                                            <!-- <input type="submit" id="msgEdit_web" class="btnEdit_web" value="編輯"> -->
                                            <input type="submit" id="msgDelete_web" class="btnDelete_web" value="刪除">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        // echo "no";
                    }
                    ?>



                    <!-- form表單,input輸入 -->
                    <div id="msgInput_web" class="msgRecordWrapforinput">
                        <div class="msgRecordWrap">
                            <div class="msgRecordWrapforflex">
                                <div class="msgRecordImg">
                                    <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                                </div>
                                <div class="msgRecordRightWrap">
                                    <div class="msgRecordText">
                                        <input type="text">
                                    </div>

                                    <div class="msgRecordEditBtn_web">
                                        <input type="submit" id="msgConfirm_web" class="btnConfirm_web" value="確認">
                                        <input type="submit" id="msgCanncel_web" class="btnCancel_web" value="取消">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- 購物記錄 電腦版 -->
                <div class="member_center"><div id="shopRecord_web" class="shopRecord_web">
                <div id="msgBlock_web" class="msgRecordWrapforrecord">
                <div class="msgRecordWrap">
                <div class="msgRecordWrapforflex">
                <div class="msgRecordImg">
                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                </div>
                <div class="msgRecordRightWrap">
                <div class="msgRecordText">
                <p>魷魚好辣跟她的家都超辣的，希望我或我
                的家也能有她一半那麼辣就好了，希望她
                能加我好友。購物紀錄</p>
                </div>
                
                <div class="msgRecordEditBtn_web">
                <!-- <input type="submit" id="msgEdit_web" class="btnEdit_web" value="編輯"> -->
                <input type="submit" id="msgDelete_web" class="btnDelete_web" value="刪除">
                </div>
                
                </div>
                </div>
                </div>
                </div>
                
                
                
                <!-- form表單,input輸入 -->
                <div id="msgInput_web" class="msgRecordWrapforinput">
                <div class="msgRecordWrap">
                <div class="msgRecordWrapforflex">
                <div class="msgRecordImg">
                <img src="imgs/memberCenter/memCenter_photo.png" alt="memberPhoto">
                </div>
                <div class="msgRecordRightWrap">
                <div class="msgRecordText">
                <input type="text">
                </div>
                
                <div class="msgRecordEditBtn_web">
                <input type="submit" id="msgConfirm_web" class="btnConfirm_web" value="確認">
                <input type="submit" id="msgCanncel_web" class="btnCancel_web" value="取消">
                </div>
                
                </div>
                </div>
                </div>
                </div>
                </div></div>


                <!-- 原版_錯的 -->
                <!-- <div class="msgRecordWrapFor2_web"> -->
                <!-- <div class="msgRecordBox_web"> -->
                <!-- <div class="msgRecordImg_web"> -->
                <!-- <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90"> -->
                <!-- </div> -->
                <!-- <div class="msgRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。</p>
    <br>
    
    </div> -->
                <!-- <div class="msgRecordEditBtn_web"> -->
                <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                <!-- <button></button> -->
                <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                <!-- </div> -->

                <!-- </div> -->
                <!--  -->
                <!-- <div class="msgRecordBox_web"> -->
                <!-- <div class="msgRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="msgRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。</p>
    <br>
    
    </div> -->

                <!-- 按鈕按鈕 -->
                <!-- <div class="msgRecordEditBtn_web"> -->
                <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                <!-- <button></button> -->
                <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                <!-- </div> -->

                <!-- </div> -->
                <!-- </div> -->


                <!-- <div class="msgRecordWrapFor2_web"> -->
                <!-- <div class="msgRecordBox_web"> -->
                <!-- <div class="msgRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="msgRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。</p>
    <br>
    
    </div> -->
                <!-- <div class="msgRecordEditBtn_web"> -->
                <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                <!-- <button></button> -->
                <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                <!-- </div> -->

                <!-- </div> -->
                <!--  -->
                <!-- <div class="msgRecordBox_web"> -->
                <!-- <div class="msgRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="msgRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。</p>
    <br>
    
    </div> -->
                <!-- <div class="msgRecordEditBtn_web"> -->
                <!-- <input type="submit" class="btnEdit_web" value="編輯"> -->
                <!-- <button></button> -->
                <!-- <input type="submit" class="btnDelete_web" value="刪除"> -->
                <!-- </div> -->

                <!-- </div> -->
                <!-- </div> -->

            </div>

            <!-- 原版_錯的 -->
            <!-- 揪團記錄 電腦版 -->
            <!-- <ul class="recordAreaUl_web">
    <li id="msgLi" class="yellow">留言記錄</li>
    <li id="grpLi" class="white">揪團記錄</li>
    <li id="shopLi" class="white">購物記錄</li>
    </ul> -->

            <!--<div id="grpRecord_web" class="grpRecord_web">
    
    <div class="grpRecordWrapFor2_web">
    <div class="grpRecordBox_web">
    <div class="grpRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="grpRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。參加揪團。</p>
    <br>
    
    </div>
    <div class="grpRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div> -->
            <!--  -->
            <!-- <div class="grpRecordBox_web">
    <div class="grpRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="grpRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。參加揪團。</p>
    <br>
    
    </div>
    <div class="grpRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div>
    </div> -->


            <!-- <div class="grpRecordWrapFor2_web">
    <div class="grpRecordBox_web">
    <div class="grpRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="grpRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。參加揪團。</p>
    <br>
    
    </div>
    <div class="grpRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div> -->
            <!--  -->
            <!-- <div class="grpRecordBox_web">
    <div class="grpRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="grpRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。參加揪團。</p>
    <br>
    
    </div>
    <div class="grpRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div>
    </div>
    </div> -->

            <!-- 原版_錯的 -->
            <!-- 購物記錄 電腦版 -->
            <!-- <ul class="recordAreaUl_web">
    <li id="msgLi" class="yellow">留言記錄</li>
    <li id="grpLi" class="white">揪團記錄</li>
    <li id="shopLi" class="white">購物記錄</li>
    </ul> -->

            <!-- <div id="shopRecord_web" class="shopRecord_web">
    
    
    <div class="shopRecordWrapFor2_web">
    <div class="shopRecordBox_web">
    <div class="shopRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="shopRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。購物購物記錄。</p>
    <br>
    
    </div>
    <div class="shopRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div> -->
            <!--  -->
            <!-- <div class="shopRecordBox_web">
    <div class="shopRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="shopRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。購物購物記錄。</p>
    <br>
    
    </div>
    <div class="shopRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div>
    </div>
    
    
    <div class="shopRecordWrapFor2_web">
    <div class="shopRecordBox_web">
    <div class="shopRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="shopRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。購物購物記錄。</p>
    <br>
    
    </div>
    <div class="shopRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div> -->
            <!--  -->
            <!-- <div class="shopRecordBox_web">
    <div class="shopRecordImg_web">
    <img src="imgs/memberCenter/member.jpg" alt="會員魷魚圖" width="80" height="90">
    </div>
    <div class="shopRecordText_web">
    <p>魷魚好辣跟她的家都超辣的，希望我或我
    的家也能有她一半那麼辣就好了，希望她
    能加我好友。購物購物記錄。</p>
    <br>
    
    </div>
    <div class="shopRecordEditBtn_web">
    <input type="submit" class="btnEdit_web" value="編輯"> -->
            <!-- <button></button> -->
            <!-- <input type="submit" class="btnDelete_web" value="刪除">
    </div>
    
    </div>
    </div>
    </div> -->


        </div>
    </div>
    </div>

    <!-- 電腦版 -->
    <!-- <div class="memArea">
            <div class="memPhoto"></div>
            <div class="memFile"></div>
        </div>

        <div class="recordArea">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <div class="recordMsg"></div>
            <div class="recordGroup"></div> <!-點選變換-->
    <!--<div class="recordShop"></div>-->
    <!--點選變換
        </div>
    </div 多的> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
    <script src="js/main.js"></script>
    <script src="js/memberCenter.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js'></script>
    <script src="js/chat.js"></script>

     <!-- 串navbar 登入功能 -->
     <script>
      <?php 
          if(isset($_SESSION["mem_name"])){
              echo "var mem_no='" . $_SESSION["mem_no"] . "';";
              echo "var mem_name='" . $_SESSION["mem_name"] . "';";
              echo "var style_no='" . $_SESSION["style_no"] . "';";
              echo "var mem_lv='" . $_SESSION["mem_lv"] . "';";
              echo "var mem_avatar='" . $_SESSION["mem_avatar"] . "';";
              echo "var squid_qty='" . $_SESSION["squid_qty"] . "';";
          }
      ?>
      $(document).ready(function(){
          <?php 
              if(isset($_SESSION["mem_name"])){
                  echo "login(mem_name,style_no,mem_lv,mem_avatar,squid_qty);";
              }
          ?>
      });
    </script>
    

</html>