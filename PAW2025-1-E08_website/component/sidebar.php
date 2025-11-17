<div class="sidebar">
  <div class="sidebar-container">
    <div>
      <div class="logo"><img src="<?= BASE_URL .'./assets/img/logo.png'?>">PerpusKids</div>
      <div class="menu">
        <?php if (!isset($_SESSION['role']) or $_SESSION['role']=='pemustaka'):?>
          <a href="<?= BASE_URL .'/index.php'?>" class="<?= ($active == 'beranda') ? 'active' : '' ?>"><img src="<?= BASE_URL .'./assets/img/home.png'?>"> beranda</a>
          <a href="<?= BASE_URL .'/pemustaka/daftarbuku.php'?>" class='<?= ($active == 'dafbuk') ? 'active' : '' ?>'><img src="<?= BASE_URL .'./assets/img/daftar_buku.png'?>"> Daftar Buku</a>
          <a href="#"><img src="<?= BASE_URL .'/assets/img/koleksi.png'?>"> Koleksi</a>
        <?php elseif ($_SESSION['role']=='admin'):?>
          <a href="<?= BASE_URL .'/index.php'?>" class="<?= ($active == 'beranda') ? 'active' : '' ?>"><img src="<?= BASE_URL .'./assets/img/home.png'?>"> beranda</a>
          <a href="<?= BASE_URL .'/pemustaka/daftarbuku.php'?>" class='<?= ($active == 'dafbuk') ? 'active' : '' ?>'><img src="<?= BASE_URL .'./assets/img/daftar_buku.png'?>"> Daftar Buku</a>
          <a href="#"><img src="<?= BASE_URL .'/assets/img/koleksi.png'?>"> daftar Pemustaka</a>
          <a href="#"><img src="<?= BASE_URL .'/assets/img/koleksi.png'?>"> daftar Peminjaman</a>
        <?php endif?>
      </div>
    </div>
  </div>
</div>