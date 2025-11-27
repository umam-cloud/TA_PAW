<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");

    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $buku = getDataBuku($_GET['id_buku']);
    // var_dump($buku);
    // $judul = $penulis = $penerbit = $tahun_terbit = '';
    $error_judul = $error_penulis = $error_penerbit = $error_tahun_terbit = $error_cover='';
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $judul = $_POST['judul'];
        $penerbit = $_POST['penerbit'];
        $penulis = $_POST['penulis'];
        $tahun_terbit = $_POST['tahun_terbit'];

        if (isset($_POST['btn'])) {
            if ($_POST['btn'] == 'simpan') {
                $answer = True;
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
                    if (!empty($_FILES['cover']['name'])) {
                            updateCover($_GET['id_buku']);
                    }
                    updateBuku($_GET['id_buku'],$_POST);
                    header('location:'.BASE_URL.'/admin/daftarbuku.php');
                }  
            }elseif($_POST['btn'] == 'kembali'){
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
            <h1>Edit Buku</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Cover Buku:</label>
                    <input type="file" name="cover">
                </div>
                <font class="error"><?=$error_cover?></font>

                <div class="form-group">
                    <label>Judul:</label>
                    <input type="text" name="judul" value="<?=$judul ?? $buku['Judul']?>">
                </div>
                <font class="error"><?=$error_judul?></font>
                
                <div class="form-group">
                    <label>Penulis:</label>
                    <input type="text" name="penulis"  value="<?=$penulis ?? $buku['Penulis']?>">
                </div>
                <font class="error"><?=$error_penulis?></font>

                <div class="form-group">
                    <label>Penerbit:</label>
                    <input type="text" name="penerbit"  value="<?=$penerbit ?? $buku['Penerbit']?>">
                </div>
                <font class="error"><?=$error_penerbit?></font>

                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="text" name="tahun_terbit"  value="<?=$tahun_terbit ?? $buku['Tahun_Terbit']?>">
                </div>
                <font class="error"><?=$error_tahun_terbit?></font>
                <div class="btn">
                    <button name="btn" value='simpan'>Simpan</button>
                    <button name="btn" value='kembali'>Kembali</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 