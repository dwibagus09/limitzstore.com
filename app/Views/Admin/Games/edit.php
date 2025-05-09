				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Edit Games</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Games</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="games" value="<?= $games['games']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Banner</label>
										<div class="col-md-8">
											<img src="<?= $games['banner'] ?>" alt="" width="140" class="mb-3 rounded">
											<div class="custom-file">
											    <input type="file" class="custom-file-input" id="games-banner" name="banner">
											    <label class="custom-file-label" for="games-banner">Choose file</label>
											</div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Gambar</label>
										<div class="col-md-8">
											<img src="<?= $games['image'] ?>" alt="" width="140" class="mb-3 rounded">
											<div class="custom-file">
											    <input type="file" class="custom-file-input" id="games-image" name="image">
											    <label class="custom-file-label" for="games-image">Choose file</label>
											</div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Slug</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="slug" value="<?= $games['slug']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kategori</label>
										<div class="col-md-8">
											<select name="category" class="form-control">
												<?php foreach ($category as $loop): ?>
												<option value="<?= $loop['id']; ?>" <?= $loop['id'] == $games['category'] ? 'selected' : ''; ?>><?= $loop['category']; ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
										<div class="mb-3 row">
										<label class="col-form-label col-md-4">Subs Title</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="subs_title" value="<?= $games['subs_title']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Urutan</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="sort" value="<?= $games['sort']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Deskripsi</label>
										<div class="col-md-8">
											<textarea name="content" id="" cols="30" rows="5" class="form-control"><?= $games['content']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Sistem Target</label>
										<div class="col-md-8">
											<select name="target" class="form-control">
												<option value="">Pilih salah satu</option>
												<option value="default" <?= 'default' == $games['target'] ? 'selected' : ''; ?>>default</option>
												<?php foreach ($target as $loop): ?>
												<option value="<?= $loop['id']; ?>" <?= $loop['id'] == $games['target'] ? 'selected' : ''; ?>><?= $loop['target']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Model Produk</label>
										<div class="col-md-8">
											<select name="product_type" class="form-control">
												<option value="1" <?= $games['product_type'] == '1' ? 'selected' : ''; ?>>1 Kolom</option>
												<option value="2" <?= $games['product_type'] == '2' ? 'selected' : ''; ?>>2 Kolom</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Validasi Player</label>
										<div class="col-md-8">
											<select name="check_status" class="form-control">
												<option value="Y" <?= $games['check_status'] == 'Y' ? 'selected' : ''; ?>>Ya</option>
												<option value="N" <?= $games['check_status'] == 'N' ? 'selected' : ''; ?>>Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Provider Kode Validasi</label>
										<div class="col-md-8">
											<select name="cek_id_provider" class="form-control">
											    <option value="no" <?= $games['cek_id_provider'] == 'no' ? 'selected' : ''; ?>>Tidak pakai</option>
											    <option value="apigame" <?= $games['cek_id_provider'] == 'apigame' ? 'selected' : ''; ?>>Apigame</option>
											    <!--<option value="voca" <?= $games['cek_id_provider'] == 'voca' ? 'selected' : ''; ?>>VocaGames</option>-->
											    <option value="pln" <?= $games['cek_id_provider'] == 'pln' ? 'selected' : ''; ?>>PLN</option>
												<option value="omega" <?= $games['cek_id_provider'] == 'omega' ? 'selected' : ''; ?>>Private</option>
												<option value="kuropedia" <?= $games['cek_id_provider'] == 'kuropedia' ? 'selected' : ''; ?>>Private 2</option>
												<option value="kenzo" <?= $games['cek_id_provider'] == 'kenzo' ? 'selected' : ''; ?>>Kenzo</option>
											</select>
										</div>
										<small>Kosongkan jika tidak menggunakan sistem validasi player</small>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kode Validasi</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="check_code" value="<?= $games['check_code']; ?>">
												<small>
												Kosongkan jika tidak menggunakan sistem validasi player. 
												&nbsp;<a href="<?= base_url(); ?>/daftar-slug" target="_blank"><u>Check Disini</u></a> untuk melihat kode validasi player game untuk provider <strong>'Private'</strong>.
												</small>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Popup Status</label>
										<div class="col-md-8">
											<select name="popup_status" class="form-control">
												<option value="On" <?= $games['popup_status'] == 'On' ? 'selected' : ''; ?>>On</option>
												<option value="Off" <?= $games['popup_status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Popup Konten</label>
										<div class="col-md-8">
										    <textarea name="popup_content"><?= $games['popup_content']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Status</label>
										<div class="col-md-8">
											<select name="status" class="form-control">
												<option value="On" <?= $games['status'] == 'On' ? 'selected' : ''; ?>>On</option>
												<option value="Off" <?= $games['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
											</select>
										</div>
									</div>
										<div class="mb-3 row">
										<label class="col-form-label col-md-4">Populer</label>
										<div class="col-md-8">
											<select name="populer" class="form-control">
												<option value="Y" <?= $games['populer'] == 'Y' ? 'selected' : ''; ?>>Ya</option>
												<option value="N" <?= $games['populer'] == 'N' ? 'selected' : ''; ?>>Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Urutan Populer</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="sort_populer" value="<?= $games['sort_populer']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Footer</label>
								<div class="col-md-8">
									<textarea name="footer"><?= $games['footer']; ?></textarea>
								</div>
							</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games" class="btn btn-warning float-start">Kembali</a>
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
					CKEDITOR.replace('content');
					CKEDITOR.replace('popup_content');
					CKEDITOR.replace('footer');
				</script>
				<?php $this->endSection(); ?>