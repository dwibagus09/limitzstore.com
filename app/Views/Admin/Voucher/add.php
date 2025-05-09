				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title"><?= $title; ?></h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kode Voucher</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="voucher">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Tipe</label>
										<div class="col-md-8">
											<select name="diskon_type" class="form-control">
												<option value="Flat">Flat</option>
												<option value="Percent">Persen</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Jumlah Diskon</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="diskon">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Max. Potongan</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="max">
											<small class="text-muted">Hanya berlaku di tipe diskon Persen</small>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Min. Transaksi</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="min">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Judul</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="title">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Konten</label>
										<div class="col-md-8">
										    <textarea name="content"></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Limit</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="stok">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Private</label>
										<div class="col-md-8">
											<select name="private" class="form-control">
												<option value="Y">Ya</option>
												<option value="N">Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Pengguna</label>
										<div class="col-md-8">
										    <?php foreach (['Guest', 'Member', 'Silver', 'Gold', 'Bisnis'] as $l): ?>
										    <div class="form-check">
										        <input class="form-check-input" type="checkbox" id="cl-<?= strtolower($l); ?>" name="level[]" value="<?= $l; ?>">
										        <label class="form-check-label" for="cl-<?= strtolower($l); ?>"><?= $l; ?></label>
										    </div>
										    <?php endforeach; ?>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Google Authenticator</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/voucher" class="btn btn-warning float-start">Kembali</a>
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
				<script>
				    CKEDITOR.replace('content');
				</script>
				<?php $this->endSection(); ?>