<?php
    require_once"../database.php";
    require_once"../account/validasi.php";

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
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="" >judul</label>
        <input type="text" name='judul'>
        <font><?=$error_judul?></font>
        <br>
        <label for="" >Penulis</label>
        <input type="text" name='penulis'>
        <font><?=$error_penulis?></font>
        <br>
        <label for="" >Penerbit</label>
        <input type="text" name='penerbit'>
        <font><?=$error_penerbit?></font>
        <br>
        <label for="">Tahun_Terbit</label>
        <input type="text" name='tahun_terbit'>
        <font><?=$error_tahun_terbit?></font>
        <br>
        <button name='submit'>tambah</button>
    </form>
</body>
</html>