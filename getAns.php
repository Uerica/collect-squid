<?php
$errMsg = "";

try{
    require_once('connectSquid.php');
    if($_REQUEST["type"] == "text"){
        $sql = "select * from robot_keyword where LOCATE(key_cnt, :chatInput)>0"; //??
        $qa = $pdo->prepare($sql);
        $qa->bindValue(":chatInput",$_REQUEST["chatInput"]); //??
    }else{
        $sql = "select * from robot_keyword where key_cnt = :keyword"; //??
        $qa = $pdo->prepare($sql);
        $qa->bindValue(":keyword", $_REQUEST["keyword"]); //??
    };

    $qa->execute();
    if( $qa->rowCount()==0){ //沒有符合的關鍵字
        echo "notFound";
    }else{
        $qaRow = $qa->fetch(PDO::FETCH_ASSOC);
   	    // $question = $qaRow["question"];
   	    $answer = $qaRow["res_cnt"];
   	    
   	    echo $answer;
    };
}catch(PDOException $e){
    $errMsg .=  $e->getMessage(). "<br>"; 
    $errMsg .=  $e->getLine(). "<br>";
};
?>