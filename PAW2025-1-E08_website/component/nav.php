<section class="nav">
	<div class="nav-container">
		<?php if (!isset($_SESSION['login'])):?>
			<div class="auth-links">
				<a href="<?= BASE_URL.'/account/login.php' ?>" class="btn-login">Login</a>
				<a href="<?= BASE_URL.'/account/register.php' ?>" class="btn-register">Register</a>
			</div>
		<?php else:?>
			<div class="auth-links">
				<a href="<?= BASE_URL.'/account/logout.php' ?>" class="btn-login">Logout</a>
			</div>		
		<?php endif?>		
	</div>
</section>