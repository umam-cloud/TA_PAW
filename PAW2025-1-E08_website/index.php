<?php
	require_once 'base.php';

 	include_once './component/header.php'; 
 ?>
<main>
	<?php include_once'./component/sidebar.php' ?>
	<section class="nav">
		<div class="search-box">
            <input type="text" placeholder="Cari buku...">
            <button>Cari</button>
        </div>
        <div class="auth-links">
                <a href="auth/login.php" class="btn-login">Login</a>
                <a href="auth/register.php" class="btn-register">Register</a>
        </div>
	</section>
	
</main>
<?php include_once './component/footer.php' ?>

