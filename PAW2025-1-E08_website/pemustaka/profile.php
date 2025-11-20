<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <label for="username">Username</label>
        <input type="text" name="username" >
        <font></font>

        <label for="password">Username</label>
        <input type="text" name="password" >
        <font></font>

        <label for="email">Username</label>
        <input type="text" name="email" >
        <font></font>

        <label for="alamat">Username</label>
        <input type="text" name="alamat" >
        <font></font>

        <label for="username">Username</label>
        <input type="text" name="username" >
        <font></font>

        <label for="username">Username</label>
        <input type="text" name="username" >
        <font></font>

        <label for="username">Username</label>
        <input type="text" name="username" >
        <font></font>
    </form>
</body>
</html>