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
    <link rel="stylesheet" href="<?= BASE_URL.'/asset/css/style.css' ?>">
    <title>Document</title>
</head>
<body>
     <?php
    require_once(BASE_PATH."/component/nav.php");
    require_once(BASE_PATH."/component/sidebar.php");
    ?>
    <main>    
        <h1>Daftar Peminjam</h1>
        <table border='1'>
        <tr>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Status</th>
            <th></th>
        </tr>
            
        </table>
    </main>
</body>
</html>