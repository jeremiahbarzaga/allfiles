<?php

session_start();
if ( !isset( $_SESSION['userid'])|| $_SESSION['userid'] !== true){
    echo header("location:login.php");
    die();

   
}



?>