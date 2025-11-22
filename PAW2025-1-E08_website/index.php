<?php
    require_once("base.php");
    require_once(BASE_PATH."/database.php");
    $bukuTerbaru = getBukuTerbaru();
    $active = 'beranda';
    
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
            <?php if (isset($_SESSION['login'])):?>
                <div class="welcome">
                    <h1>Hi,<?=$_SESSION['username']?></h1>
                    <p>The library serves as a welcoming home for knowledge seekers and avid readers alike</p>
                    <img src="<?= BASE_URL.'/assets/img/hero.png'?>" alt="">
                </div>
            <?php elseif (!isset($_SESSION['login'])):?>
                <div class="welcome">
                    <h1>Hi, Welcome to PerpusKids</h1>
                    <p>The library serves as a welcoming home for knowledge seekers and avid readers alike</p>
                    <img src="<?= BASE_URL.'/assets/img/hero.png'?>" alt="">
                </div>
            <?php endif?>
                
                <div class="menu_dafbuk">
                <?php foreach ($bukuTerbaru as $newBook):?>
                    <div class="dafbuk">
                    <img src="<?= BASE_URL.'/assets/covbuk/'.$newBook['Cover'] ?>" alt="" class="cover">
                    <div class="buku">
                            <h3><?= $newBook['Judul'] ?></h3>
                            <p>Penulis : <?= $newBook['Penulis'] ?></p>
                            <p>Penerbit : <?= $newBook['Penerbit'] ?></p>
                            <p>Terbit : <?= $newBook['Tahun_Terbit'] ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </main>
    </body>
</html>