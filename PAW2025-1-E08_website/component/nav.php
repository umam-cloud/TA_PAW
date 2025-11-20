<section class="nav">
	<div class="nav-container">
		<div class="logo"><img src="<?= BASE_URL .'./assets/img/logo.png'?>">PerpusKids</div>
		<div class="nav-button">
			<?php if (!isset($_SESSION['login'])):?>
				<div class="auth-links">
					<a href="<?= BASE_URL.'/account/login.php' ?>" class="btn-login">login</a>
				</div>
				<?php else:?>
				<div class="auth-links">
					<a href="<?= BASE_URL.'/pemustaka/editprofile.php' ?>" class="btn-logout">Setting</a>
				</div>		
				<div class="auth-links">
					<a href="<?= BASE_URL.'/account/logout.php' ?>" class="btn-logout">Logout</a>
				</div>		
			<?php endif?>		
		</div>
	</div>
</section>