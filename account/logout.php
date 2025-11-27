<?php
    require_once('../base.php');
    session_start();
    $_SESSION = [];
    // sesssion_unset();
    session_destroy();
    
    header('location:'.BASE_URL.'/index.php');
    exit;

?>