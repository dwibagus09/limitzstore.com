				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tambah Pengguna</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Username</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="username">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Password</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="password">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Saldo</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="balance">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Whatsapp</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="wa">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Level Akun</label>
										<div class="col-md-8">
											<select name="level" class="form-control">
												<option value="">Pilih level akun</option>
												<?php if($arr_level): ?>
												<?php foreach($arr_level as $level): ?>
													<option value="<?= $level['level'] ?>"><?= $level['level'] ?></option>
												<?php endforeach; ?>
												<?php endif; ?>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Google Authenticator</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna" class="btn btn-warning float-start">Kembali</a>
									<div class="text-end">
										<button class="btn " type="reset">Batal</button>
										<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
			document.getElementById('googleauth').addEventListener('input', function () {
				this.value = this.value.replace(/[^0-9]/g, ''); // Hanya membiarkan karakter angka
				if (this.value.length > 6) {
					this.value = this.value.slice(0, 6); // Membatasi panjang masukan menjadi 6 digit
				}
			});
		</script>
				<?php $this->endSection(); ?>