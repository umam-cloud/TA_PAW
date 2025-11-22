<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");

    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $judul = $penulis = $penerbit = $tahun_terbit = '';
    $error_judul = $error_penulis = $error_penerbit = $error_tahun_terbit = '';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $answer = TRUE;
        
        if(!wajib_isi($judul)){
            $error_judul = 'Wajib di isi';
            $answer = FALSE;
        }elseif(!Alfanumerik($judul)){
            $error_judul = 'Judul Tidak Valid';
            $answer = FALSE;
        }
        
        if(!wajib_isi($penulis)){
            $answer = FALSE;
            $error_penulis = "Wajib di isi";
        }elseif(!Alfabet($penulis)){
            $error_penulis = "Penulis Hanya Alfabet";
            $answer = FALSE;
        }
        
        if(!wajib_isi($penerbit)){
            $error_penerbit = 'Wajib di isi';
            $answer = FALSE;
        }elseif(!Alfanumerik($penerbit)){
            $error_penerbit = 'Nama Penerbit Tidak Valid';
            $answer = FALSE;
        }
        
        if(!wajib_isi($tahun_terbit)){
            $error_tahun_terbit = 'Wajib di isi';
            $answer = FALSE;
        }elseif(!Numerik($tahun_terbit)){
            $error_tahun_terbit = 'Tahun Terbit Tidak Valid';
            $answer = FALSE;
        }

        if ($answer == TRUE) {
            addBuku($_POST);
            header('location:'.BASE_URL.'/admin/daftarbuku.php');
        }

    }
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
    <main>
        <div class="box">
            <h1>Tambah Buku</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Judul:</label>
                    <input type="text" name="judul">
                </div>
                <font><?=$error_judul?></font>

                <div class="form-group">
                    <label>Penulis:</label>
                    <input type="text" name="penulis">
                </div>
                <font><?=$error_penulis?></font>

                <div class="form-group">
                    <label>Penerbit:</label>
                    <input type="text" name="penerbit">
                </div>
                <font><?=$error_penerbit?></font>

                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="text" name="tahun_terbit">
                </div>
                <font><?=$error_tahun_terbit?></font>
                <button name="submit">Tambah</button>
                <a href="<?= BASE_URL.'/admin/daftarbuku.php' ?>"><button name="submit">Kembali</button></a>
            </form>
        </div>
    </main>
</body>
</html>