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
        <div class="menu_dafbuk">
            <?php foreach ($koleksi_buku as $koleksi):?>
                <div class="dafbuk-koleksi">
                    <img src="<?= BASE_URL.'/assets/covbuk/'.$koleksi['Cover'] ?>" alt="" class="cover">
                    <div class="buku">
                            <h3><?= $koleksi['Judul'] ?></h3>
                            <p>Penulis : <?= $koleksi['Penulis'] ?></p>
                            <p>Penerbit : <?= $koleksi['Penerbit'] ?></p>
                            <p>Terbit : <?= $koleksi['Tahun_Terbit'] ?></p>
                            <p>Tanggal_peminjaman : <?= date('Y-m-d', strtotime($koleksi['tgl_peminjaman'])) ?></p>
                            <p>Tanggal_pengmbalian : <?= $koleksi['tgl_pengembalian'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </main>
    </body>
</html>