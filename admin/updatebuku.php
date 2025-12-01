<?php
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");

    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $buku = getDataBuku($_GET['id_buku']);
    $error_judul = $error_penulis = $error_penerbit = $error_tahun_terbit = $error_stok = $error_cover='';
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $judul = $_POST['judul'];
        $penerbit = $_POST['penerbit'];
        $penulis = $_POST['penulis'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $stok = $_POST['stok'];

        if (isset($_POST['btn'])) {
            if ($_POST['btn']=='simpan') {
                $answer = TRUE;
                if(empty($_FILES['cover']['name'])){
                    $error_cover ='wajib di isi';
                    $answer = FALSE;
                }
    
                if(!wajib_isi($judul)){
                    $error_judul = 'Wajib di isi';
                    $answer = FALSE;
                }elseif(!Alfanumerik($judul)){
                    $error_judul = 'Judul Tidak Valid';
                    $answer = FALSE;
                    $judul = '';
                }
                
                if(!wajib_isi($penulis)){
                    $answer = FALSE;
                    $error_penulis = "Wajib di isi";
                }elseif(!Alfabet($penulis)){
                    $error_penulis = "Penulis Hanya Alfabet";
                    $answer = FALSE;
                    $penulis = '';
                }
                
                if(!wajib_isi($penerbit)){
                    $error_penerbit = 'Wajib di isi';
                    $answer = FALSE;
                }elseif(!Alfanumerik($penerbit)){
                    $error_penerbit = 'Nama Penerbit Tidak Valid';
                    $answer = FALSE;
                    $penerbit = '';
                }
                
                if(!wajib_isi($tahun_terbit)){
                    $error_tahun_terbit = 'Wajib di isi';
                    $answer = FALSE;
                }elseif(!TahunTerbit($tahun_terbit)){
                    $error_tahun_terbit = 'Tahun Terbit Tidak Valid';
                    $answer = FALSE;
                    $tahun_terbit = '';
                }
                if(!wajib_isi($stok)){
                    $error_stok = 'Wajib di isi';
                    $answer = FALSE;
                }elseif (!Numerik($stok)) {
                    $error_stok = 'Isi stok dengan benar!';
                    $answer = FALSE;
                    $stok = '';
                }elseif(!stok($stok)){
                    $error_stok = 'Stok tidak boleh lebih dari 5';
                    $answer = FALSE;
                    $stok = '';
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
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Cover Buku:</label>
                    <input type="file" name="cover">
                </div>
                <div class="error"><?=$error_cover?></div>

                <div class="form-group">
                    <label>Judul:</label>
                    <input type="text" name="judul" value="<?=$judul ?? $buku['Judul']?>">
                </div>
                <div class="error"><?=$error_judul?></div>
                
                <div class="form-group">
                    <label>Penulis:</label>
                    <input type="text" name="penulis"  value="<?=$penulis ?? $buku['Penulis']?>">
                </div>
                <div class="error"><?=$error_penulis?></div>

                <div class="form-group">
                    <label>Penerbit:</label>
                    <input type="text" name="penerbit"  value="<?=$penerbit ?? $buku['Penerbit']?>">
                </div>
                <div class="error"><?=$error_penerbit?></div>

                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="text" name="tahun_terbit"  value="<?=$tahun_terbit ?? $buku['Tahun_Terbit']?>">
                </div>
                <div class="error"><?=$error_tahun_terbit?></div>

                 <div class="form-group">
                    <label>Stok:</label>
                    <input type="text" name="stok"  value="<?=$stok ?? $buku['Stok']?>">
                </div>
                <div class="error"><?=$error_stok?></div>

                <div class="form-group">
                    <label>Kategori :</label>
                    <select name="kategori" id="kategori">
                        <option Value="Pendidikan" <?= (($kategori?? $buku['kategori'] ) == 'Pendidikan') ? 'selected': '' ?>>Pendidikan</option>
                        <option value="Fiksi" <?= (($kategori?? $buku['kategori'] )  == 'Fiksi') ? 'selected': '' ?>>Fiksi</option>
                        <option value="Non Fiksi" <?= (($kategori?? $buku['kategori'] )  == 'Non Fiksi') ? 'selected': '' ?>>Non Fiksi</option>
                        <option value="Sejarah" <?= (($kategori?? $buku['kategori'] )  == 'Sejarah') ? 'selected': '' ?>>Sejarah</option>
                    </select>
                </div>

                <div class="btn">
                    <button name="btn" value='simpan' class="simpan">Simpan</button>
                    <button name="btn" value='kembali' class="cancel">Batal</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 