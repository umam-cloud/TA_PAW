<?php
    require_once("base.php");
    require_once(BASE_PATH."/database.php");
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
        <h1>Haiiii <?= $_SESSION['username']??''?></h1>
        <form action="">
            <label for="">judul</label>
            <input type="text">
            <br>
            <label for="">Penulis</label>
            <input type="text">
            <br>
            <label for="">Penerbit</label>
            <input type="text">
            <br>
            <label for="">Tahun_Penulis</label>
            <input type="text">
            <br>
        </form>
        <table border='1'>
            <tr>
                <th>judul</th>
                <th>penulis</th>
                <th>penerbit</th>
                <th>tahun penulis</th>
            </tr>
            <?php foreach ($buku as $book):?>
                <tr>
                    <td><?= $book['Judul'] ?></td>
                    <td><?= $book['Penulis'] ?></td>
                    <td><?= $book['Penerbit'] ?></td>
                    <td><?= $book['Tahun_Terbit'] ?></td>
                </tr>
            <?php endforeach ?>
            </table>
    </body>
</html>