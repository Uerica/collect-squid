<?php
    $jsonStr = $_REQUEST["jsonStr"];
    $tableRow = json_decode( $jsonStr );

    require_once("connectSquid.php");
    $error = array();
    // $latestData = array();
    switch($tableRow->table_name) {
        case 'manager': {
            $query = "UPDATE `manager` SET `mng_name` = :mng_name, `mng_psw` = :mng_psw WHERE `mng_no` = :mng_no";
            $editManager = $pdo->prepare($query);
            $editManager->bindValue(":mng_no", $tableRow->mng_no);
            $editManager->bindValue(":mng_name", $tableRow->mng_name);
            $editManager->bindValue(":mng_psw", $tableRow->mng_psw);
            try {
                $editManager->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'robot_keyword': {
            $query = "UPDATE `robot_keyword` SET `key_cnt` = :key_cnt, `res_cnt` = :res_cnt WHERE `key_no` = :key_no";
            $editManager = $pdo->prepare($query);
            $editManager->bindValue(":key_no", $tableRow->key_no);
            $editManager->bindValue(":key_cnt", $tableRow->key_cnt);
            $editManager->bindValue(":res_cnt", $tableRow->res_cnt);
            try {
                $editManager->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'member': {
            $query = "UPDATE `member` SET `mem_status` = :mem_status WHERE `mem_no` = :mem_no";
            $editMemberStatus = $pdo->prepare($query);
            $editMemberStatus->bindValue(":mem_status", $tableRow->mem_status_boolean);
            $editMemberStatus->bindValue(":mem_no", $tableRow->mem_no);
            try {
                $editMemberStatus->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'product_furniture': {
            $query = "UPDATE `product_furniture` SET `is_onboard` = :furn_status WHERE `furn_no` = :furn_no";
            $editFurnStatus = $pdo->prepare($query);
            $editFurnStatus->bindValue(":furn_status", $tableRow->furn_status_boolean);
            $editFurnStatus->bindValue(":furn_no", $tableRow->furn_no);
            try {
                $editFurnStatus->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'product_furniture_M': {
            $query = "UPDATE `product_furniture` SET `furn_name` = :furn_name, `furn_price` = :furn_price WHERE `furn_no` = :furn_no";
            $editFurn = $pdo->prepare($query);
            $editFurn->bindValue(":furn_name", $tableRow->furn_name);
            $editFurn->bindValue(":furn_price", $tableRow->furn_price);
            $editFurn->bindValue(":furn_no", $tableRow->furn_no);
            try {
                $editFurn->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'product_clothing': {
            $query = "UPDATE `product_clothing` SET `clo_name` = :clo_name WHERE `clo_no` = :clo_no";
            $editClo = $pdo->prepare($query);
            $editClo->bindValue(":clo_name", $tableRow->clo_name);
            $editClo->bindValue(":clo_no", $tableRow->clo_no);
            try {
                $editClo->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }

            break;
        }
        case 'events': {
            $query = "UPDATE `event` SET `is_banner` = :bannerStatus WHERE `evt_no` = :evt_no";
            $editEvent = $pdo->prepare($query);
            $editEvent->bindValue(":bannerStatus", $tableRow->bannerStatus);
            $editEvent->bindValue(":evt_no", $tableRow->evt_no);
            try {
                $editEvent->execute();
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