<?php
header('Content-Type: application/json');
$errMsg = '';
$mem_name = $_REQUEST["mem_name"];
try {
    require_once('connectSquid.php');
    $sql = "SELECT m.mem_name m_name, f.mem_name f_name, r.status FROM relationship r INNER JOIN member m ON r.mem_no = m.mem_no INNER JOIN member f on r.friend_no = f.mem_no
            WHERE m.mem_name = :mem_name OR f.mem_name = :mem_name";
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_name", $mem_name);
    $member->execute();
    if($member->rowCount() > 0) {
        $memRows = $member->fetchAll(PDO::FETCH_ASSOC);
        $resp = array();
        foreach($memRows as $memRow)
        {
            $row = array();
            if($memRow["m_name"] == $mem_name){
                $row["mem_name"] =  $memRow["f_name"];
            }else{
                $row["mem_name"] =  $memRow["m_name"];
            }
            $row["status"] =  $memRow["status"]; 
            $row["requester"] = $memRow["m_name"];
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
