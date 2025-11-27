<?php
    require_once("../database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }
    $active = 'dafbuk';

    if(isset($_POST['pinjam'])){
        addPeminjam($_POST['pinjam'], $_SESSION['id_user']);
        updateStokBuku($_POST['pinjam']);
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
        <div class="menu_dafbuk">
            <?php foreach ($buku as $book):?>
                <div class="dafbuk">
                    <img src="<?= BASE_URL.'/assets/covbuk/'.$book['Cover'] ?>" alt="" class="cover">
                    <div class="buku">
                            <h3><?= $book['Judul'] ?></h3>
                            <p>Penulis : <?= $book['Penulis'] ?></p>
                            <p>Penerbit : <?= $book['Penerbit'] ?></p>
                            <p>Terbit : <?= $book['Tahun_Terbit'] ?></p>
                            <p>Stok : <?= $book['Stok'] ?></p>
                            <form action="<?= BASE_URL.'/pemustaka/daftarbuku.php'?>" method='POST'><button name='pinjam' value='<?= $book['id_buku']?>'>Pinjam</button></form>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </main>
    </body>
</html>