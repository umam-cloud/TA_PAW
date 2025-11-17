<?php
    require_once("../base.php");
    require_once(BASE_PATH."/database.php");
    require_once(BASE_PATH."/component/nav.php");
    require_once(BASE_PATH."/component/sidebar.php");
    
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }
    $pemustaka = getPemustaka();
    // var_dump($buku);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL.'/assets/css/style.css'?>">
    <title>Document</title>
</head>
<body>
    <table border='1'>
        <tr>
            <th>username</th>
            <th>email</th>
            <th>jenkel</th>
            <th>nomor</th>
            <th>alamat</th>
        </tr>
        <?php foreach ($pemustaka as $user):?>
            <tr>
                <td><?= $user['Username'] ?></td>
                <td><?= $user['Email'] ?></td>
                <td><?= $user['Jenis_Kelamin'] ?></td>
                <td><?= $user['Nomor_Telpon'] ?></td>
                <td><?= $user['Alamat'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    </body>
</html>