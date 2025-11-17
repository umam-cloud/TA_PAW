<?php 
    require_once("../base.php");
    require_once(BASE_PATH.'/account/validasi.php');
    require_once(BASE_PATH."/database.php");

    $username = $nomor = $email = $alamat = $password = $bulan = $tanggal = $tahun = $jenkel = '';
    $error_username = $error_nomor = $error_email = $error_alamat = $error_password = $error_ttl = $error_jenkel = $error_register ='';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username']?? '';
        $password = $_POST['password'] ?? '';
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
            if(cekAkun($_POST)){
                $error_register='akun sudah ada!!';
            }else{
                addUser($_POST);
                header('location:'.BASE_URL.'/account/login.php');
            }
        }
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_URL.'/assets/css/account.css'?>">
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
                    <img src="<?=BASE_URL.'/assets/img/from.png'?>" alt="">
                    <p>Take your little ones on a magical journey filled with wizards and talking animals.</p>
                </div>
                <div class="form">
                    <h1>Create an  account</h1>
                    <form action="" method="POST">
                        <div class="input">
                            <input type="text" placeholder="Username" name="username">
                            <font class="error"><?= $error_username?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="password" name="password">
                            <font class="error"><?= $error_password?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="Email" name="email">
                            <font class="error"><?= $error_email?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="No Telp" name="tlp">
                            <font class="error"><?= $error_nomor?></font>
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
                            <textarea name="alamat" id="" placeholder="Alamat"></textarea> 
                            <font class="error"><?= $error_alamat?></font>
                        </div>   
                        <font class="error"><?= $error_register?></font>
                        <button name="submit">register</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>