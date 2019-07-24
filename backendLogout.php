<?php
$error = array();

try {
    ob_start();
    session_start();
    session_unset();
    session_destroy();
}catch(PDOException $e) {
    $error['message'] = $e->getMessage();
    $error['line']=$e->getLine();
}

if( isset($error['message']) ) {
    http_response_code(500);
    die(json_encode($error));
} else {
    http_response_code(200);
    echo 1;
}

?>