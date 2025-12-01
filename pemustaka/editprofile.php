<?php 
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");

    $idUser = $_SESSION['id_user'];
    $dataPemustaka = getDataPemustaka($idUser);
    $error_username = $error_nomor = $error_email = $error_alamat = $error_ttl = $error_jenkel =  $error_register ='';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username']?? '';
        $email = $_POST['email'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $nomor = $_POST['tlp'] ?? '';
        $btn = $_POST['btn'] ?? '';

        if ($btn == 'simpan') {
            $succses = TRUE;
            if(!wajib_isi($username)){
                $error_username = 'Username wajib di isi';
                $succses = FALSE;
            }elseif(!minusn($username)){
                $error_username = 'Username minimal 3 karakter';
                $succses = FALSE;
                $username = '';
            }elseif(!Alfanumerik($username)){
                $error_username = 'username hanya karakter';
                $succses = FALSE;
                $username = '';
            }elseif ($username !== $_SESSION['username']) {
                if (cekUsernamePemustaka($_POST)) {
                    $error_username = 'username sudah digunakan!';
                    $succses = FALSE;
                    $username = '';
                }
            }
            
            //validasi email
            if(!wajib_isi($email)){
                $error_email = 'Email wajib di isi';
                $succses = FALSE;
            }elseif(!Email($email)){
                $error_email = 'Masukkan format email dengan benar';
                $succses = FALSE;
                $email = '';
            }
            
            // validasi telephone
            if(!wajib_isi($nomor)){
                $error_nomor = 'Nomor wajib di isi';
                $succses = FALSE;
            }elseif(!maxtlp($nomor)){
                $error_nomor = 'Nomor minimal 12 angka';
                $succses = FALSE;
                $nomor = '';
            }
            
            //validasi alamat
            if(!wajib_isi($alamat)){
                $error_alamat = 'Wajib di isi ';
                $succses = FALSE;
            }elseif(!Alamat($alamat)){
                $error_alamat = 'Alamat tidak valid';
                $succses = FALSE;
                $alamat = '';
            }
            
            if($succses == TRUE){
                if (!empty($_FILES['profil']['name'])) {
                    updateProfile($idUser);
                }
                updateUser($idUser, $_POST);
                header('location:'.BASE_URL.'/pemustaka/profile.php');
            }
        }elseif ($btn == 'batal') {
            header('location:'.BASE_URL.'/pemustaka/profile.php');
        }
    };

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
        <div class="card">
            <h2 class="title">Edit Profile</h2>

            <form action="<?= BASE_URL.'/pemustaka/editprofile.php'?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Foto Profile</label>
                    <input type="file" name="profil">
                </div>

                <div class="form-group">
                    <label>Username: </label>
                    <input type="text" name="username" value="<?=$username??$dataPemustaka['Username']; ?>">
                     <p class="error"><?= $error_username?></p>
                </div>

                <div class="form-group">
                    <label>Email: </label>
                    <input type="text" name="email" value="<?=$email??$dataPemustaka['Email']; ?>">
                     <p class="error"><?= $error_email?></p>
                </div>

                <div class="form-group">
                    <label>No Telepon: </label>
                    <input type="text" name="tlp" value="<?=$nomor??$dataPemustaka['Nomor_Telpon']; ?>">
                     <p class="error"><?= $error_nomor?></p>
                </div>

                <div class="form-group">
                    <label>Alamat: </label>
                    <textarea name="alamat"><?=$alamat??$dataPemustaka['Alamat']; ?></textarea>
                    <p class="error"><?= $error_alamat?></p>
                </div>

                <div class="form-btn">
                    <button type="submit" name="btn" class="btn cancel" value="batal">Batal</button>
                    <button type="submit" name="btn" class="btn save" value="simpan">Simpan</button>
                </div>
            </form>
        </div>


    </main>
</body>
</html>