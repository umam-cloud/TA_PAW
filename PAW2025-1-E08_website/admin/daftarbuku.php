<?php
    require_once("../database.php");
    require_once(BASE_PATH."/component/nav.php");
    require_once(BASE_PATH."/component/sidebar.php");
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
    <a href="<?=BASE_URL.'/admin/tambahbuku.php'?>"><button>Tambah</button></a>
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
                <td><a href="deletebuku.php ? id_buku=<?= $book['id_buku']?>"><button>hapus</button></a></td>
                <td><a href="updatebuku.php ? id_buku=<?= $book['id_buku']?>"><button>edit</button></a></td>
            </tr>
        <?php endforeach ?>
    </table>
    </body>
</html>