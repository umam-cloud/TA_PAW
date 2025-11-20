<?php
    // session_start();
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    // if (!isset($_SESSION['login'])) {
    //     header('location:'.BASE_URL.'/account/login.php');
    //     exit;
    // }
    $dataPemustaka = getDataPemustaka($_SESSION['id_user']);

    $username = $nomor = $email = $alamat = $bulan = $tanggal = $tahun = $jenkel = '';
    $error_username = $error_nomor = $error_email = $error_alamat = $error_ttl = $error_jenkel =  $error_register ='';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username']?? '';
        $email = $_POST['email'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $nomor = $_POST['tlp'] ?? '';
        $jenkel = $_POST['jenkel'] ?? '';
        $bulan = $_POST['bulan'] ?? '';
        $tahun = $_POST['tahun'] ?? '';
        $tanggal = $_POST['tanggal'] ?? '';
        $_POST['ttl'] = "$tahun-$bulan-$tanggal "??'';
        $succses = TRUE;
        
        
        
        if(!wajib_isi($username)){
            $error_username = 'Username wajib di isi';
            $succses = FALSE;
        }elseif(!minusn($username)){
            $error_username = 'Username minimal 3 karakter';
            $succses = FALSE;
        }elseif(!Alfabet($username)){
            $error_username = 'username hanya karakter';
            $succses = FALSE;
        }
        
        // validasi tanggal
        if(!wajib_isi($tanggal)){
            $error_ttl = 'Tanggal wajib di isi';
            $succses = FALSE;
        }elseif(!wajib_isi($bulan)){
            $error_ttl = 'Bulan wajib di isi';
            $succses = FALSE;
        }elseif(!wajib_isi($tahun)){
            $error_ttl = 'Tahun wajib di isi';
            $succses = FALSE;
        }elseif(!tanggal($tahun, $bulan, $tanggal)){
            $error_ttl = 'Anda tidak cukup umur!';
            $succses = FALSE;
        }
        
        //validasi password
        if (!wajib_isi($password)){
            $error_password = 'Password wajib di isi';
            $succses = FALSE;
        }elseif(!Password($password)){
            $error_password = 'minimal dari 8 karakter dan harus ada kombinasi simbol, angka, huruf besar';
            $succses = FALSE;
        }
        
        //validasi email
        if(!wajib_isi($email)){
            $error_email = 'Email wajib di isi';
            $succses = FALSE;
        }elseif(!Email($email)){
            $error_email = 'Masukkan format email dengan benar';
            $succses = FALSE;
        }
        
        // validasi telephone
        if(!wajib_isi($nomor)){
            $error_nomor = 'Nomor wajib di isi';
            $succses = FALSE;
        }elseif(!maxtlp($nomor)){
            $error_nomor = 'Nomor minimal 12 angka';
            $succses = FALSE;
        }
        
        //validasi alamat
        if(!wajib_isi($alamat)){
            $error_alamat = 'Wajib di isi ';
            $succses = FALSE;
        }elseif(!Alamat($alamat)){
            $error_alamat = 'Alamat tidak valid';
            $succses = FALSE;
        }
        
        if(!wajib_isi($jenkel)){
            $succses = FALSE;
            $error_jenkel = 'jenis kelamin wajib di pilih';
        }

        if($succses == TRUE){
             updateUser($_POST);
             header('location:'.BASE_URL.'/account/login.php');
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
   <main class="account">
        <div class="container-form">
            <div class="header-form">
                <img src="<?=BASE_URL.'/assets/img/logo.png'?>" alt=""><h2>PerpusKids</h2>
            </div>
            <div class="box-form">
                <div>
                    <h2><?=$dataPemustaka['Username']?></h2>
                    <h3><?=$_SESSION['role']?></h3>
                    <img src="<?=BASE_URL.'/assets/img/profile.png'?>" alt="">
                </div>
                <div class="form">
                    <h1>Create an  account</h1>
                    <form action="" method="POST">
                        <div class="input">
                            <label for="Username">Username</label>
                            <input type="text" placeholder="Username" name="username" value="<?=$dataPemustaka['Username']?>">
                            <font class="value"><?=$error_username?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="Email" name="email" value="<?=$dataPemustaka['Email']?>">
                            <font class="value"><?=$error_email?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="No Telp" name="tlp" value="<?=$dataPemustaka['Nomor_Telpon']?>">
                            <font class="value><?=$error_nomor?></font>
                        </div>
                        <div class="input">
                            <select name="jenkel" id="">
                                <option value="">---Jenis Kelamin---</option>
                                <option value="Laki-laki">---laki---</option>
                                <option value="Perempuan">---per---</option>
                            </select>
                            <font class="error"><?= $error_jenkel?></font>
                        </div>
                        <div>
                            <label for="">Tanggal lahir :</label>
                            <div class="ttl">
                                <select name="tahun" id="">
                                    <option value="">---Tahun---</option>
                                    <option value="2024">2024</option>
                                    <option value="2017">2017</option>
                                </select>
                                <select name="bulan" id="">
                                    <option value="">---Bulan---</option>
                                    <option value="09">09</option>
                                </select><select name="tanggal" id="">
                                    <option value="">---Tanggal---</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                            <font class="error"><?= $error_ttl?></font>
                        </div>
                        <div class="input">
                            <textarea name="alamat" id="" placeholder="Alamat" value="<?=$dataPemustaka['Alamat']?>"></textarea> 
                            <font class="error"><?= $error_alamat?></font>
                        </div>   
                        <font class="error"><?= $error_register?></font>
                        <button name="batal">Batal</button>
                        <button name="simpan">Simpan</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>