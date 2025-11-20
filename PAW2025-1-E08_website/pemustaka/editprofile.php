<?php
    // session_start();
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    // if (!isset($_SESSION['login'])) {
    //     header('location:'.BASE_URL.'/account/login.php');
    //     exit;
    // }


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
                    <h2><?=$_SESSION['username']?></h2>
                    <h3><?=$_SESSION['role']?></h3>
                    <img src="<?=BASE_URL.'/assets/img/profile.png'?>" alt="">
                </div>
                <!-- <div class="form">
                    <h1>Create an  account</h1>
                    <form action="" method="POST">
                        <div class="input">
                            <label for="Username">Username</label>
                            <input type="text" placeholder="Username" name="username">
                            <font class="error"><?=$_SESSION['Username']?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="Email" name="email">
                            <font class="error"><?=$_SESSION['email']?></font>
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
                </div> -->
            </div>
        </div>
    </main>
</body>
</html>