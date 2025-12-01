<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }
    $active = 'dafpemin';
    $hari_ini = date('Y-m-d');
    $peminjaman = daftarPeminjaman();

    if (isset($_POST['terima'])) {
        updatePeminjaman($_POST['terima'],$_POST['buku']);
        header('Location: daftarpeminjaman.php');
        exit();
    }

    // if (isset($_POST['btn'])) {
    //     $btn = $_POST['btn']
    //     if ($btn == 'terima') {
            
    //     }
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL.'/assets/css/style.css' ?>">
    <title>Document</title>
</head>
<body>
     <?php
    require_once(BASE_PATH."/component/nav.php");
    require_once(BASE_PATH."/component/sidebar.php");
    ?>
    <main>    
        <table >
        <tr>
            <th>Judul Buku</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pemngembalian</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($peminjaman as $peminjam):?>
                <tr>
                    <td><?= $peminjam['judul_buku'] ?></td>
                    <td><?= $peminjam['username_pemustaka'] ?></td>
                    <td><?= date('Y-m-d', strtotime($peminjam['tgl_peminjaman'])) ?></td>
                    <td><?= $peminjam['tgl_pengembalian'] ?></td>
                    <td><?= $peminjam['status'] ?></td>
                    <?php if ($peminjam['status'] === 'Diproses' ):?>
                        <form action="<?= BASE_URL.'/admin/daftarpeminjaman.php'?>" method='POST'><td>
                            <input type="hidden" value= '<?= $peminjam ['id_buku']?>' name="buku">
                            <button name='terima' value='<?= $peminjam['id_peminjaman'] ?>' class="btn-edit">Terima</button>
                        </td></form>
                    <?php endif; ?>
                </tr>
        <?php endforeach?>
            
        </table>
    </main>
</body>
</html>