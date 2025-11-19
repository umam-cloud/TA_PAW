<?php
    require_once("base.php");
    require_once(BASE_PATH."/database.php");
    $bukuTerbaru = getBukuTerbaru();
    // var_dump($bukuTerbaru);
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
        <?php
        require_once(BASE_PATH."/component/nav.php");
        require_once(BASE_PATH."/component/sidebar.php");
        
        ?>
        <main>
            <h1>Haiiii,  <?= $_SESSION['username']??'Welcome in PerpusKids'?></h1>
            <table border='1'>
                <tr>
                    <th>judul</th>
                    <th>penulis</th>
                    <th>penerbit</th>
                    <th>tahun penulis</th>
                </tr>
                <?php foreach ($bukuTerbaru as $newBook):?>
                    <tr>
                        <td><?= $newBook['Judul'] ?></td>
                        <td><?= $newBook['Penulis'] ?></td>
                        <td><?= $newBook['Penerbit'] ?></td>
                        <td><?= $newBook['Tahun_Terbit'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </main>
    </body>
</html>