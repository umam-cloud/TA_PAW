<div class="nav">
	<div class="nav-container">
		<div class="logo"><img src="<?= BASE_URL .'/assets/img/logo.png'?>" alt="">PerpusKids</div>
		<div class="nav-button">
			<?php if (!isset($_SESSION['login'])):?>
				<div class="auth-links">
					<a href="<?= BASE_URL.'/account/login.php' ?>" class="btn-login">Login</a>
				</div>
				<?php else:?>
					<?php if ($_SESSION['role'] == 'pemustaka'):?>
						<div class="auth-links">
							<a href="<?= BASE_URL.'/pemustaka/profile.php' ?>" class="btn-setting">Setting</a>
						</div>		
					<?php endif?>		
				<div class="auth-links">
					<a href="<?= BASE_URL.'/account/logout.php' ?>" class="btn-logout">Logout</a>
				</div>		
			<?php endif?>		
		</div>
	</div>
</div>