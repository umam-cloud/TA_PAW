<?php
    // session_start();
    require_once("../database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login');
        exit;
    }

    $active = 'dafbuk';
    $buku = getBuku();
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
        <a href="<?=BASE_URL.'/admin/tambahbuku.php'?>"><button>Tambah</button></a>
        <table border='1'>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($buku as $book):?>
                <tr>
                    <td><?= $book['Judul'] ?></td>
                    <td><?= $book['Penulis'] ?></td>
                    <td><?= $book['Penerbit'] ?></td>
                    <td><?= $book['Tahun_Terbit'] ?></td>
                    <td><?= $book['Stok'] ?></td>
                    <td>
                        <div class="updel-buku">
                            <a href="deletebuku.php ? id_buku=<?= $book['id_buku']?>"><button>Hapus</button></a>
                            <a href="updatebuku.php ? id_buku=<?= $book['id_buku']?>" ><button >Edit</button></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </main>
</body>
</html>