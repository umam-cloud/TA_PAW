<?php
    // session_start();
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    $dataPemustaka = getDataPemustaka($_SESSION['id_user']);
    $fotoProfile = $dataPemustaka['Profil']??'profile.png';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_URL.'/assets/css/profile.css'?>">
    <title>Document</title>
</head>
<body>
   <main>
        <div class="left-card">
            <h2>Kelompok 8</h2>
            <span class="role">Pustakawan</span>

            <div class="profile-placeholder">
                <img src="<?= BASE_URL.'/assets/fotoProfile/'.($_SESSION['foto_profile']?? $fotoProfile)?>" class="circle" alt="">
            </div>
        </div>

        <div class="right-card">
            <h2 class="biodata-title">Biodata</h2>

            <div class="container-biodata">

                <div class="biodata">
                    <label>Username :</label>
                    <p><?= $dataPemustaka['Username']; ?></p>
                </div>
                
                <div class="biodata">
                    <label>Email :</label>
                    <p><?= $dataPemustaka['Email']; ?></p>
                </div>
                
                <div class="biodata">
                    <label>Nomor Telepon :</label>
                    <p><?= $dataPemustaka['Nomor_Telpon']; ?></p>
                    
                </div>
                
                <div class="biodata">
                    <label>Alamat :</label>
                    <p><?= $dataPemustaka['Alamat']; ?></p>
                </div>
                <div class="button-holder">
                    <a href="<?=BASE_URL.'/index.php'?>" class="btn back">Kembali</a>
                   <a href="<?=BASE_URL.'/pemustaka/editprofile.php'?>" class="btn edit">Edit</a>
                </div>

            </div>
        </div>
    </main>
</body>
</html>