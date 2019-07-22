<?php
    $jsonStr = $_REQUEST["jsonStr"];
    $tableRow = json_decode( $jsonStr );

    require_once("connectSquid.php");
    $error = array();
    switch($tableRow->table_name) {
        case 'manager': {
            // delete Manager
            $query = "DELETE FROM manager WHERE mng_no = :mng_no";
            $delManager = $pdo->prepare($query);
            $delManager->bindValue(":mng_no", $tableRow->mng_no);
            try {
                $delManager->execute();
            } catch (PDOException $e) {
                $error['message'] = $e->getMessage();
                $error['line']=$e->getLine();
            }
            break;
        }
        case 'robot_keyword': {
            // delete Keyword
            $query = "DELETE FROM robot_keyword WHERE key_no = :key_no";
            $delRobotRes = $pdo->prepare($query);
            $delRobotRes->bindValue(":key_no", $tableRow->key_no);
            try {
                $delRobotRes->execute();
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