<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

?>