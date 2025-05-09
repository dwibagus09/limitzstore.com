<!DOCTYPE html>
<html lang="en">
	<head>
	<?= $this->Include('head'); ?>

	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-admin-login.css">
	
	<style>
		.eniv-admin-login-left {
			background-image: url(<?= base_url(); ?>/assets/images/admin-bg.png);
		}
	</style>
    </head>
	<body>

		<div class="eniv-admin-login">
			<div class="eniv-admin-login-left">
				<img src="<?= base_url(); ?>/assets/images/admin-illustration.png" alt="">
				<h1>Selamat Datang di Admin area</h1>
				<p>Kontrol semua pengaturan website kamu disini</p>
			</div>
			<div class="eniv-admin-login-right">
				<a href="<?= base_url(); ?>">
					<img src="<?= $web['logo']; ?>" alt="">
				</a>
				<h1>Selamat Datang <span>Admin!</span></h1>
				<p>Masukan  username dan password kamu untuk masuk</p>
				<form action="" method="POST">
				<?= csrf_field(); ?> 
					<div class="mb-3">
						<label>Username</label>
						<input type="text" class="form-control" name="username" autocomplete="off">
					</div>
					<div class="mb-4">
						<label>Password</label>
						<input type="password" class="form-control" name="password">
					</div>
					<div class="mb-4">
						<label>Google Authenticator</label>
						<input type="number" class="form-control" name="googleauth" id="googleauth" maxlength="6">
					</div>
					<center>
					<div class="g-recaptcha mb-4" 
                                    data-sitekey="<?= getenv('GOOGLE_RECAPTCHA_SITEKEY') ?>"
                               ></div></center>
					<button class="btn btn-primary btn-auth w-100" type="submit" name="tombol" value="submit">Masuk Sekarang</button>
				</form>
			</div>
		</div>		

		<?= $this->Include('js'); ?>
		<script>
			document.getElementById('googleauth').addEventListener('input', function () {
				this.value = this.value.replace(/[^0-9]/g, ''); // Hanya membiarkan karakter angka
				if (this.value.length > 6) {
					this.value = this.value.slice(0, 6); // Membatasi panjang masukan menjadi 6 digit
				}
			});
		</script>
	</body>
</html>