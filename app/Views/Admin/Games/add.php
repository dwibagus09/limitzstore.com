				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tambah Games</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Games</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="games">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Banner</label>
										<div class="col-md-8">
											<div class="custom-file">
											    <input type="file" class="custom-file-input" id="banner-image" name="banner">
											    <label class="custom-file-label" for="banner-image">Choose file</label>
											</div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Gambar</label>
										<div class="col-md-8">
											<div class="custom-file">
											    <input type="file" class="custom-file-input" id="games-image" name="image">
											    <label class="custom-file-label" for="games-image">Choose file</label>
											</div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kategori</label>
										<div class="col-md-8">
											<select name="category" class="form-control">
												<?php foreach ($category as $loop): ?>
												<option value="<?= $loop['id']; ?>"><?= $loop['category']; ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
										<div class="mb-3 row">
										<label class="col-form-label col-md-4">Subs Title</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="subs_title">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Urutan</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="sort">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Deskripsi</label>
										<div class="col-md-8">
											<textarea name="content" id="" cols="30" rows="5" class="form-control"></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Sistem Target</label>
										<div class="col-md-8">
											<select name="target" class="form-control">
												<option value="">Pilih salah satu</option>
												<option value="default">default</option>
												<?php foreach ($target as $loop): ?>
												<option value="<?= $loop['id']; ?>"><?= $loop['target']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Model Produk</label>
										<div class="col-md-8">
											<select name="product_type" class="form-control">
												<option value="1">1 Kolom</option>
												<option value="2">2 Kolom</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Validasi Player</label>
										<div class="col-md-8">
											<select name="check_status" class="form-control">
												<option value="Y">Ya</option>
												<option value="N">Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Provider Kode Validasi</label>
										<div class="col-md-8">
											<select name="cek_id_provider" class="form-control">
											    <option value="no">Tidak pakai</option>
											    <option value="apigame">Apigame</option>
											    <!--<option value="voca">VocaGames</option>-->
											    <option value="pln">PLN</option>
												<option value="omega">Private</option>
												<option value="kuropedia">Private 2</option>
												<option value="kenzo">Kenzo</option>
											</select>
										</div>
										<small>Kosongkan jika tidak menggunakan sistem validasi player</small>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kode Validasi</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="check_code">
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
												<option value="On">On</option>
												<option value="Off">Off</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Popup Konten</label>
										<div class="col-md-8">
										    <textarea name="popup_content"></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Populer</label>
										<div class="col-md-8">
											<select name="populer" class="form-control">
												<option value="Y">Ya</option>
												<option value="N">Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Urutan Populer</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="sort_populer">
										</div>
									</div>
									<div class="mb-3 row">
								        <label class="col-md-4 col-form-label ">Footer</label>
								        <div class="col-md-8">
									        <textarea name="footer"></textarea>
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