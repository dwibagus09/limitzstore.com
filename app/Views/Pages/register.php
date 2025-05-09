		<?php $this->extend('template'); ?>
		
		<?php $this->section('css'); ?>
		<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/jquery.ccpicker.css">
		<?php $this->endSection(); ?>
		
		<?php $this->section('content'); ?>
        <div class="eniv-content">
            <div class="container">
        		<div class="eniv-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-auth">
                                <div class="card-body">
                                    <h6 class="text-primary fw-600 fs-14">Daftar Akun</h6>
                                    <h5 class="fs-18">Daftarkan Akunmu!</h5>
                                    <p class="mb-4">Daftar akun <?= $web['title']; ?> dengan mengisi form dibawah ini</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="" method="POST">
                                            <?= csrf_field(); ?> 
                                                <div class="mb-3">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" autocomplete="off">
                                                </div>
                                                <div class="mb-3">
                                                    <label>No. Whatsapp</label>
                                                    <div class="input-group mb-2">
                                                    <input type="text" id="phoneField" name="wa" class="phone-field form-control" placeholder="81200000000" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="password">
                                                        <span class="input-group-text right">
                                                            <i class="fa fa-eye-slash" id="toggle-pw"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <center>
                                                <div class="g-recaptcha mb-4" 
                                                                data-sitekey="<?= getenv('GOOGLE_RECAPTCHA_SITEKEY') ?>"
                                                        ></div></center>

                                                <div class="mb-4">
                                                    <button class="btn btn-primary btn-auth w-100" type="submit" name="tombol" value="submit">Daftar Sekarang</button>
                                                </div>
                                                <div class="text-center">
                                                    <p class="mb-1"><span class="text-muted">Sudah punya akun?</span> <a href="<?= base_url(); ?>/login" class="text-primary text-decoration-none ms-1">Login sekarang</a></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        		</div>
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
        <script src="<?= base_url(); ?>/assets/js/jquery.ccpicker.js"></script>
        <script type="text/javascript">
        $("#phoneField").CcPicker({
            countryCode:"id",
            dataUrl:"<?= base_url(); ?>/assets/data.json"
        });
        </script>
        <script>
			document.getElementById('pin').addEventListener('input', function () {
				this.value = this.value.replace(/[^0-9]/g, ''); // Hanya membiarkan karakter angka
				if (this.value.length > 6) {
					this.value = this.value.slice(0, 6); // Membatasi panjang masukan menjadi 6 digit
				}
			});
		</script>
		<?php $this->endSection(); ?>