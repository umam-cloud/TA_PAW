<?php
    require_once("../database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }
    $active = 'dafbuk';

    if(isset($_POST['pinjam'])){
        addPeminjam($_POST['pinjam'], $_SESSION['id_user']);
        updateStatusBuku($_POST['pinjam'], 'permintaan');
    }

    $buku = getBuku();
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
        <div class="input">
        <select name="kategori" id="">
            <option value="">Kategori</option>
            <option value="dongeng">Dongeng</option>
            <option value="cerita_rakyat">Cerita Rakyat</option>
            <option value="komik">Komik</option>
            <option value="novel">Novel</option>
            <option value="horror">Horror</option>
            <option value="komedi">Komedi</option>
            <option value="fantasy">Fantay</option>
            <option value="sejarah">Sejarah</option>
        </select>
        </div>

        <div class="menu_dafbuk">
            <?php foreach ($buku as $book):?>
                <div class="dafbuk">
                    <img src="<?= BASE_URL.'/assets/covbuk/'.$book['Cover'] ?>" alt="" class="cover">
                    <div class="buku">
                            <h3><?= $book['Judul'] ?></h3>
                            <p>Penulis : <?= $book['Penulis'] ?></p>
                            <p>Penerbit : <?= $book['Penerbit'] ?></p>
                            <p>Terbit : <?= $book['Tahun_Terbit'] ?></p>
                            <?php if ($book['Status'] == 'tersedia'):?>
                                 <form action="" method='POST'><button name='pinjam' value='<?= $book['id_buku']?>'>pinjam</button></form>
                            <?php elseif ($book['Status'] == 'permintaan' or $book['Status'] == 'dipinjam'):?>
                                <a href=""><button class="dipinjam">dipinjam</button></a>
                            <?php endif?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </main>
    </body>
</html>