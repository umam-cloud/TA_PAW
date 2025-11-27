<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");

    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $judul = $penulis = $penerbit = $tahun_terbit = $cover='';
    $error_judul = $error_penulis = $error_penerbit = $error_tahun_terbit =  $error_cover = '';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
    
        if (isset($_POST['btn'])) {
            if ($_POST['btn'] == 'tambah') {
                $succses = TRUE;
                if(empty($_FILES['cover']['name'])){
                    $error_cover ='wajib di isi';
                    $succses = FALSE;
                }
    
                if(!wajib_isi($judul)){
                    $error_judul = 'Wajib di isi';
                    $succses = FALSE;
                }elseif(!Alfanumerik($judul)){
                    $error_judul = 'Judul Tidak Valid';
                    $succses = FALSE;
                }
                
                if(!wajib_isi($penulis)){
                    $succses = FALSE;
                    $error_penulis = "Wajib di isi";
                }elseif(!Alfabet($penulis)){
                    $error_penulis = "Penulis Hanya Alfabet";
                    $succses = FALSE;
                }
                
                if(!wajib_isi($penerbit)){
                    $error_penerbit = 'Wajib di isi';
                    $succses = FALSE;
                }elseif(!Alfanumerik($penerbit)){
                    $error_penerbit = 'Nama Penerbit Tidak Valid';
                    $succses = FALSE;
                }
                
                if(!wajib_isi($tahun_terbit)){
                    $error_tahun_terbit = 'Wajib di isi';
                    $succses = FALSE;
                }elseif(!Numerik($tahun_terbit)){
                    $error_tahun_terbit = 'Tahun Terbit Tidak Valid';
                    $succses = FALSE;
                }
    
                if ($succses == TRUE) {
                    addBuku($_POST);
                    header('location:'.BASE_URL.'/admin/daftarbuku.php');
                }
            }elseif ($_POST['btn'] == 'kembali') {
                header('location:'.BASE_URL.'/admin/daftarbuku.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL.'/assets/css/form.css'?>">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="box">
            <h1>Tambah Buku</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Cover Buku:</label>
                    <input type="file" name="cover">
                </div>
                <font class="error"><?=$error_cover?></font>

                <div class="form-group">
                    <label>Judul:</label>
                    <input type="text" name="judul" value="<?=$judul?>">
                </div>
                <font class="error"><?=$error_judul?></font>
                
                <div class="form-group">
                    <label>Penulis:</label>
                    <input type="text" name="penulis"  value="<?=$penulis?>">
                </div>
                <font class="error"><?=$error_penulis?></font>

                <div class="form-group">
                    <label>Penerbit:</label>
                    <input type="text" name="penerbit"  value="<?=$penerbit?>">
                </div>
                <font class="error"><?=$error_penerbit?></font>

                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="text" name="tahun_terbit"  value="<?=$tahun_terbit?>">
                </div>
                <font class="error"><?=$error_tahun_terbit?></font>
                <div class="btn">
                    <button name="btn" value='tambah'>Tambah</button>
                    <button name="btn" value='kembali'>Kembali</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>