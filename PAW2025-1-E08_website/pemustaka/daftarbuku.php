<?php
    require_once("../database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

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

        <table border='1'>
            <tr>
                <th>judul</th>
                <th>penulis</th>
                <th>penerbit</th>
                <th>tahun penulis</th>
                <th>aksi</th>
            </tr>
            <?php foreach ($buku as $book):?>
                <tr>
                    <td><?= $book['Judul'] ?></td>
                    <td><?= $book['Penulis'] ?></td>
                    <td><?= $book['Penerbit'] ?></td>
                    <td><?= $book['Tahun_Terbit'] ?></td>
                    <?php if ($book['Status'] == 'tersedia'):?>
                         <td><form action="" method='POST'><button name='pinjam' value='<?= $book['id_buku']?>'>pinjam</button></form></td>
                    <?php elseif ($book['Status'] == 'permintaan' or $book['Status'] == 'dipinjam'):?>
                        <td><a href=""><button class="dipinjam">dipinjam</button></a></td>
                    <?php endif?>
                </tr>
            <?php endforeach ?>
        </table>
    </main>
    </body>
</html>