<?php 
    require_once"validasi.php";
    require_once"../database.php";

    $username = $password = '';
    $error_username = $error_password = '';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username']?? '';
        $password = $_POST['password'] ?? '';

        if(!wajib_isi($username)){
            $error_username = 'Username wajib di isi';
        }elseif(!minusn($username)){
            $error_username = 'Username minimal 3 karakter';
        }elseif(!Alfabet($username)){
            $error_username = 'username hanya karakter';
        }

        if (!wajib_isi($password)){
            $error_password = 'Password wajib di isi';
        }elseif(!Password($password)){
            $error_password = 'Password minimal dari 8 karakter dan harus ada kombinasi simbol, angka, huruf besar';
        }
        
        $user =login($_POST);
        var_dump($user);

        if($user == 'pemustaka'){
            echo'kamu pemustaka';
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="container-form">
            <div class="header-form">
                <img src="../assets/img/logo.png" alt=""><h2>PerpusKids</h2>
            </div>
            <div class="box-form">
                <div>
                    <img src="../assets/img/from.png" alt="">
                    <p>Take your little ones on a magical journey filled with wizards and talking animals.</p>
                </div>
                <div class="form">
                    <h1>Login account</h1>
                    <form action="" method="POST">
                        <div class="input">
                            <input type="text" placeholder="Username" name="username">
                            <font class="error"><?= $error_username?></font>
                        </div>
                        <div class="input">
                            <input type="text"  placeholder="password" name="password">
                            <font class="error"><?= $error_password?></font>
                        </div>
                        <button>login</button>
                        <font>Don’t have an account? <a href="register.php">register</a></font>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>