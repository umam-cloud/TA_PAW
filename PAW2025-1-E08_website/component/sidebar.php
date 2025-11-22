<?php 
    if (isset($_SESSION['id_user'])) {
      $dataPemustaka = getDataPemustaka($_SESSION['id_user']);
      $fotoProfile = $dataPemustaka['Profil']??'profile.png';
    }else {
      $fotoProfile = 'profile.png';
    }
?>
<div class="sidebar">
  <div class="sidebar-container">
    <?php if (!isset($_SESSION['role']) or $_SESSION['role'] == 'pemustaka'):?>
      <img src="<?= BASE_URL.'/assets/fotoProfile/'.($_SESSION['foto_profile']??$fotoProfile) ?>" alt="" class="profile">
    <?php elseif ($_SESSION['role'] == 'admin'):?>
      <img src="<?= BASE_URL.'/assets/fotoProfile/profile.png'?>" alt="" class="profile">
    <?php endif?>
    <div>
      <div class="menu">
        <?php if (!isset($_SESSION['role']) or $_SESSION['role']=='pemustaka'):?>
          <a href="<?= BASE_URL .'/index.php'?>" class="<?= ($active == 'beranda') ? 'active' : '' ?>"><img src="<?= BASE_URL .'./assets/img/home.png'?>"> beranda</a>
          <a href="<?= BASE_URL .'/pemustaka/daftarbuku.php'?>" class='<?= ($active == 'dafbuk') ? 'active' : '' ?>'><img src="<?= BASE_URL .'./assets/img/daftar_buku.png'?>"> Daftar Buku</a>
          <a href="<?= BASE_URL .'/pemustaka/koleksi.php'?>" class='<?= ($active == 'koleksi') ? 'active' : '' ?>'><img src="<?= BASE_URL .'/assets/img/koleksi.png'?>"> Koleksi</a>
        <?php elseif ($_SESSION['role']=='admin'):?>
          <a href="<?= BASE_URL .'/index.php'?>" class="<?= ($active == 'beranda') ? 'active' : '' ?>"><img src="<?= BASE_URL .'./assets/img/home.png'?>"> beranda</a>
          <a href="<?= BASE_URL .'/admin/daftarbuku.php'?>" class='<?= ($active == 'dafbuk') ? 'active' : '' ?>'><img src="<?= BASE_URL .'./assets/img/daftar_buku.png'?>"> Daftar Buku</a>
          <a href="<?= BASE_URL .'/admin/daftarpemustaka.php'?>" class='<?= ($active == 'dafpemus') ? 'active' : '' ?>'><img src="<?= BASE_URL .'/assets/img/daftarPemustaka.png'?>"> daftar Pemustaka</a>
          <a href="<?= BASE_URL .'/admin/daftarpeminjaman.php'?>" class='<?= ($active == 'dafpemin') ? 'active' : '' ?>'><img src="<?= BASE_URL .'/assets/img/daftarPeminjaman.png'?>"> daftar Peminjaman</a>
        <?php endif?>
      </div>
    </div>
  </div>
</div>