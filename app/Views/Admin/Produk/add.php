				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tambah Produk</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Games</label>
										<div class="col-md-8">
											<select name="games_id" class="form-control">
												<option value="">Pilih salah satu</option>
												<?php foreach ($games as $loop): ?>
												<option value="<?= $loop['id']; ?>"><?= $loop['games']; ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kategori</label>
										<div class="col-md-8">
											<select name="category_id" class="form-control">
												<option value="">Pilih salah satu</option>
												<?php foreach ($category as $loop): ?>
												<option value="<?= $loop['id']; ?>"><?= $loop['category']; ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Produk</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="product">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Label</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="label">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Koin</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="coin">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga Modal</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price_modal">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga <del>Coret</del></label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price_cut">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga Publik</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga Silver</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price_silver">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga Gold</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price_gold">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga Bisnis</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price_bisnis">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Harga Seller Digiflazz</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="price_seller">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Flash Sale</label>
										<div class="col-md-8">
											<select name="fs" class="form-control">
												<option value="Y">Ya</option>
												<option value="N">Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Provider</label>
										<div class="col-md-8">
											<select name="provider" class="form-control">
												<option value="DF">Digiflazz</option>
												<option value="AG">Api Games</option>
												<option value="BangJeff">BangJeff</option>
												<option value="VocaGame">VocaGame</option>
												<option value="MooGold">MooGold</option>
												<option value="GP">GamePoint</option>
												<option value="Manual">Manual</option>
												<option value="Unipin">Unipin</option>
												<option value="Tokogar">Tokogar</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Product Count</label>
										<div class="col-md-8">
											<select name="product_count" class="form-control">
												<option value="N">Tidak</option>
												<option value="Y">Ya</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Product Combo</label>
										<div class="col-md-8">
											<select name="product_combo" class="form-control">
												<option value="N">Tidak</option>
												<option value="Y">Ya</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Combo Product</label>
										<div class="col-md-8">
											<select name="combo_product" class="form-control">
												<option value="N">Tidak</option>
												<option value="Y">Ya</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kode Produk</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="sku">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">ID Region</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="region_id">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Logo URL</label>
										<div class="col-md-8">
											<input type="url" class="form-control" autocomplete="off" name="logo_url">
										    <small>Tulis Logo URL sebagai berikut : assets/images/nama_icon.png</small>
										</div>
									</div>
									<!--<div class="mb-3 row">
										<label class="col-form-label col-md-4">Google Authenticator</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
										</div>
									</div>-->
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk" class="btn btn-warning float-start">Kembali</a>
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