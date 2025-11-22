<?php
    require_once("../database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $active = 'koleksi';
    $koleksi_buku = koleksi();
    // var_dump($buku);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL.'/assets/css/style.css'?>">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once(BASE_PATH."/component/nav.php");
        require_once(BASE_PATH."/component/sidebar.php");
    ?>
    <main>
        <table border='1'>
            <tr>
                <th>judul</th>
                <th>penulis</th>
                <th>penerbit</th>
                <th>tahun penulis</th>
                <th>aksi</th>
            </tr>
            <?php foreach ($koleksi_buku as $koleksi):?>
                <tr>
                    <td><?= $koleksi['Judul'] ?></td>
                    <td><?= $koleksi['Penulis'] ?></td>
                    <td><?= $koleksi['Penerbit'] ?></td>
                    <td><?= $koleksi['Tahun_Terbit'] ?></td> 
                </tr>
            <?php endforeach ?>
        </table>
    </main>
    </body>
</html>