<?php
    ob_start();
    session_start();
    
    $jsonStr = $_REQUEST["jsonStr"];
    $tableRow = json_decode( $jsonStr );

    require_once("connectSquid.php");
    $error = array();
    $latestData = array();
    switch($tableRow->table_name) {
        case 'manager': {
            // add New Manager
            $query = "INSERT INTO manager(`mng_name`, `mng_psw`) VALUES (:mng_name, :mng_psw)";
            $addManager = $pdo->prepare($query);
            $addManager->bindValue(":mng_name", $tableRow->mng_name);
            $addManager->bindValue(":mng_psw", $tableRow->mng_psw);
            try {
                $addManager->execute();
                $latestData['latestId'] = $pdo->lastInsertId();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }
            break;
        }
        case 'robot_keyword': {
            // add New robot_keyword
            $query = "INSERT INTO robot_keyword(`key_cnt`, `res_cnt`) VALUES (:key_cnt, :res_cnt)";
            $addRobotKeyword = $pdo->prepare($query);
            $addRobotKeyword->bindValue(":key_cnt", $tableRow->key_cnt);
            $addRobotKeyword->bindValue(":res_cnt", $tableRow->res_cnt);
            try {
                $addRobotKeyword->execute();
                $latestData['latestId'] = $pdo->lastInsertId();
                $resQuery = "UPDATE robot_keyword SET `res_no` = `key_no` WHERE `key_no` = :key_no";
                $updateResNo = $pdo->prepare($resQuery);
                $updateResNo->bindValue(":key_no", $latestData['latestId']);
                $updateResNo->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'managerLogin': {
               $query = "SELECT mng_name, mng_psw FROM manager WHERE mng_name = :mng_name AND mng_psw = :mng_psw";
               $mngRow = $pdo->prepare($query);
               $mngRow->bindValue(":mng_name", $tableRow->mng_name);
               $mngRow->bindValue(":mng_psw", $tableRow->mng_psw);
               try {
                   $mngRow->execute();
                   if($mngRow->rowCount() == 0) {   // 找不到使用者
                        $error['message'] = '帳號密碼錯誤';
                   } else {
                       $manager = $mngRow->fetch(PDO::FETCH_ASSOC);
                       $_SESSION['mng_name'] = $manager['mng_name'];
                    // $_SESSION['mng_name'] = '123';
                   }
               } catch (PDOException $e) {
                   $error['message'] = $e->getMessage();
                   $error['line']=$e->getLine();
               }

            break;
        }
        default: {
            $error['message'] = 'unknown table name';
            break;
        }
    }
    if( isset($error['message']) ) {
        http_response_code(500);
        die(json_encode($error));
    } else {
        http_response_code(200);
        if( isset($latestData['latestId']) ) {
            echo json_encode($latestData);
        } else {
            echo 1;
        }
    }
    



    
?>