<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../base.php');
    require_once(BASE_PATH."/database.php");

    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $judul = $penulis = $penerbit = $tahun_terbit = $cover= $stok ='';
    $error_judul = $error_penulis = $error_penerbit = $error_tahun_terbit =  $error_cover = $error_stok = $error_kategori ='';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $kategori = $_POST['kategori'];
        $stok = $_POST['stok'];
    
        if (isset($_POST['btn'])) {
            if ($_POST['btn']=='tambah') {
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
                    $judul = '';
                }
                
                if(!wajib_isi($penulis)){
                    $succses = FALSE;
                    $error_penulis = "Wajib di isi";
                }elseif(!Alfabet($penulis)){
                    $error_penulis = "Penulis Hanya Alfabet";
                    $succses = FALSE;
                    $penulis = '';
                }
                
                if(!wajib_isi($penerbit)){
                    $error_penerbit = 'Wajib di isi';
                    $succses = FALSE;
                }elseif(!Alfanumerik($penerbit)){
                    $error_penerbit = 'Nama Penerbit Tidak Valid';
                    $succses = FALSE;
                    $penerbit = '';
                }
                
                if(!wajib_isi($tahun_terbit)){
                    $error_tahun_terbit = 'Wajib di isi';
                    $succses = FALSE;
                }elseif(!TahunTerbit($tahun_terbit)){
                    $error_tahun_terbit = 'Tahun Terbit Tidak Valid';
                    $succses = FALSE;
                    $tahun_terbit = '';
                }
                if(!wajib_isi($stok)){
                    $error_stok = 'Wajib di isi';
                    $succses = FALSE;
                }elseif (!Numerik($stok)) {
                    $error_stok = 'Isi stok dengan benar!';
                    $succses = FALSE;
                    $stok = '';
                }elseif(!stok($stok)){
                    $error_stok = 'Stok tidak boleh lebih dari 5';
                    $succses = FALSE;
                    $stok = '';
                }
                
                if (!wajib_isi($kategori)){
                    $error_kategori = 'Wajib di isi';
                    $succses = FALSE;
                }
                
                if ($succses == TRUE) {
                    addBuku($_POST);
                    header('location:'.BASE_URL.'/admin/daftarbuku.php');
                    exit();
                }
            }elseif ($_POST['btn'] == 'kembali') {
                header('location:'.BASE_URL.'/admin/daftarbuku.php');
                exit();
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
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Cover Buku:</label>
                    <input type="file" name="cover">
                </div>
                <div class="error"><?=$error_cover?></div>

                <div class="form-group">
                    <label>Judul:</label>
                    <input type="text" name="judul" value="<?=$judul?>">
                </div>
                <div class="error"><?=$error_judul?></div>
                
                <div class="form-group">
                    <label>Penulis:</label>
                    <input type="text" name="penulis"  value="<?=$penulis?>">
                </div>
                <div class="error"><?=$error_penulis?></div>

                <div class="form-group">
                    <label>Penerbit:</label>
                    <input type="text" name="penerbit"  value="<?=$penerbit?>">
                </div>
                <div class="error"><?=$error_penerbit?></div>

                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="text" name="tahun_terbit"  value="<?=$tahun_terbit?>">
                </div>
                <div class="error"><?=$error_tahun_terbit?></div>
                
                <div class="form-group">
                    <label>Stok:</label>
                    <input type="text" name="stok"  value="<?=$stok?>">
                </div>
                <div class="error"><?=$error_stok?></div>
                
                <div class="form-group">
                    <label>Kategori :</label>
                    <select name="kategori" id="kategori">
                        <option Value="">kategori</option>
                        <option Value="Pendidikan" <?= ($kategori == 'Pendidikan') ? 'selected': '' ?>>Pendidikan</option>
                        <option value="Fiksi" <?= ($kategori == 'Fiksi') ? 'selected': '' ?>>Fiksi</option>
                        <option value="Non Fiksi" <?= ($kategori == 'Non Fiksi') ? 'selected': '' ?>>Non Fiksi</option>
                        <option value="Sejarah" <?= ($kategori == 'Sejarah') ? 'selected': '' ?>>Sejarah</option>
                    </select>
                </div>
                <div class="error"><?=$error_kategori?></div>
                
                <div class="btn">
                    <button name="btn" value='tambah' class="simpan">Tambah</button>
                    <button name="btn" value='kembali' class="cancel">Batal</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>