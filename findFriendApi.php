<?php
    session_start();
//先連資料庫
//給預備sql
    $errMsg = '';
    $mem_no = $_SESSION["mem_no"];
    $mem_gender = $_REQUEST["mem_gender"];
    $mem_sign = $_REQUEST["mem_sign"];
    $interest_no = $_REQUEST["interest_no"];//先拿mem_no 找mem_interst表格中interst_no interst表格中interst_name
    try {
        require_once('connectSquid.php');
        $sql = "SELECT m.mem_no, m.mem_name, m.mem_gender, m.mem_sign, mem_avatar, GROUP_CONCAT(i.interest_name SEPARATOR ',') interest_names
                FROM member m 
                LEFT JOIN mem_interest mi ON m.mem_no = mi.mem_no 
                LEFT JOIN interest i ON mi.interest_no = i.interest_no
                WHERE (
                       m.mem_no in (SELECT mem_no 
                                    FROM mem_interest smi 
                                    WHERE smi.mem_no = m.mem_no AND (smi.interest_no = :interest_no OR :interest_no = 'allinterest' ) ) 
                      OR
                       m.mem_no not in (SELECT mem_no FROM mem_interest) AND :interest_no = 'allinterest'
                      )
                AND (m.mem_no != :mem_no)
                AND (m.mem_no not in (SELECT friend_no FROM relationship r WHERE r.mem_no = :mem_no ))
                AND (m.mem_no not in (SELECT mem_no FROM relationship r WHERE r.friend_no = :mem_no ))
                AND (mem_sign = :mem_sign OR :mem_sign = 'allsign' )
                AND (mem_gender = :mem_gender OR :mem_gender = 'allgender')
                GROUP BY m.mem_no
                ORDER BY Rand()
                LIMIT 10";
        $member = $pdo->prepare($sql);
        $member->bindValue(":mem_no", $mem_no);
        $member->bindValue(":interest_no", $interest_no);
        $member->bindValue(":mem_gender", $mem_gender);
        $member->bindValue(":mem_sign", $mem_sign);
        $member->execute();
        if($member->rowCount() > 0) {
            $memRows = $member->fetchAll(PDO::FETCH_ASSOC);
            $resp = array();
            foreach($memRows as $memRow)
            {
                $row = array();
                $row["mem_no"] =  $memRow["mem_no"]; 
                $row["mem_name"] = $memRow["mem_name"];
                $row["mem_gender"] = $memRow["mem_gender"];
                $row["mem_sign"] = $memRow["mem_sign"];
                $row["mem_avatar"] = $memRow["mem_avatar"];
                $row["interest_names"] = $memRow["interest_names"];
                $resp[] = $row;
            }   
            echo json_encode($resp);
        }else{
            // account or password incorrect
            echo "[]";
        }

    } catch(PDOException $e) {
        $errMsg .= $e->getMessage()."<br>";
        $errMsg .= $e->getLine()."<br>";
        echo $errMsg;
    }


?>