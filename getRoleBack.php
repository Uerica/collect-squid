<?php
    session_start();
    if(isset($_SESSION["dressed_no"]) == false) {
        echo $_SESSION["myRole"];
    } else {
        echo $_SESSION["dressed_no"];
    }
?>