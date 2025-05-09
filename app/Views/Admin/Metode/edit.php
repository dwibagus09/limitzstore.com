				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Edit Metode</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Nama Metode</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="method" value="<?= $method['method']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Sub Teks</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="sub_title" value="<?= $method['sub_title']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kategori</label>
										<div class="col-md-8">
											<select name="category_id" class="form-control">
												<option value="">Pilih salah satu</option>
												<?php foreach ($category as $loop): ?>
												<option value="<?= $loop['id']; ?>" <?= $loop['id'] == $method['category_id'] ? 'selected' : ''; ?>><?= $loop['category']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Gambar</label>
										<div class="col-md-8">
											<img src="<?= base_url(); ?>/assets/images/method/<?= $method['image']; ?>" alt="" class="mb-3 rounded" width="140">
											<input type="file" class="form-control" id="method-image" name="image">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Kode Unik</label>
										<div class="col-md-8">
											<select name="uniq" class="form-control">
												<option value="Y" <?= $method['uniq'] == 'Y' ? 'selected' : ''; ?>>Ya</option>
												<option value="N" <?= $method['uniq'] == 'N' ? 'selected' : ''; ?>>Tidak</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Provider</label>
										<div class="col-md-8">
											<select name="provider" class="form-control">
												<option value="Manual" <?= $method['provider'] == 'Manual' ? 'selected' : ''; ?>>Manual</option>
												<option value="Tripay" <?= $method['provider'] == 'Tripay' ? 'selected' : ''; ?>>Tripay</option>
												<option value="Xendit" <?= $method['provider'] == 'Xendit' ? 'selected' : ''; ?>>Xendit</option>
												<option value="Tokopay" <?= $method['provider'] == 'Tokopay' ? 'selected' : ''; ?>>Tokopay</option>
												<option value="DuitKu" <?= $method['provider'] == 'DuitKu' ? 'selected' : ''; ?>>DuitKu</option>
											</select>
										</div>
									</div>
									<div class="form-group row <?= in_array($method['provider'], ['Tripay', 'Xendit', 'Tokopay', 'DuitKu']) ? 'd-none' : ''; ?>" id="tipe-manual">
										<label class="col-form-label col-md-4">Rekening</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="rek" value="<?= $method['rek']; ?>">
										</div>
									</div>
									<div class="form-group row <?= !in_array($method['provider'], ['Tripay', 'Xendit', 'Tokopay', 'DuitKu']) ? 'd-none' : ''; ?>" id="tipe-tripay">
										<label class="col-form-label col-md-4">Kode Metode</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="code" value="<?= $method['code']; ?>">
											<small>Kode metode bisa di cek <a href="https://tripay.co.id/developer?tab=channels" class="text-warning" target="_blank">disini</a></small>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Instruksi</label>
										<div class="col-md-8">
											<textarea name="instruksi"><?= $method['instruksi']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Status</label>
										<div class="col-md-8">
											<select name="status" class="form-control">
												<option value="On" <?= $method['status'] == 'On' ? 'selected' : ''; ?>>On</option>
												<option value="Off" <?= $method['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row d-none">
										<label class="col-form-label col-md-4">Kategori</label>
										<div class="col-md-8">
											<select name="type" class="form-control">
											    <option value="">Pilih Kategori</option>
												<option value="BT" <?= $method['type'] == 'BT' ? 'selected' : ''; ?>>Bank Transfer</option>
												<option value="WALLET" <?= $method['type'] == 'WALLET' ? 'selected' : ''; ?>>E-Wallet</option>
												<option value="VA" <?= $method['type'] == 'VA' ? 'selected' : ''; ?>>Virtual Akun</option>
												<option value="CS" <?= $method['type'] == 'CS' ? 'selected' : ''; ?>>Minimarket</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Biaya Admin</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="fee" value="<?= $method['fee']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Biaya Admin (Persen)</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="percent" value="<?= $method['percent']; ?>">
											<small>Biaya Admin bisa di cek <a href="https://tripay.co.id/developer?tab=channels" class="text-warning" target="_blank">disini</a>. Untuk penulisan persen tanpa huruf '%' dan tanda koma(",") diganti dengan tanda titik("."). <br> NB : Jika kosong makan tulis "-".</small>
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode" class="btn btn-warning float-start">Kembali</a>
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
					$("select[name=provider]").on('change', function() {
						if ($(this).val() == 'Manual') {
							$("#tipe-manual").removeClass('d-none');
							$("#tipe-tripay").addClass('d-none');
						} else {
							$("#tipe-manual").addClass('d-none');
							$("#tipe-tripay").removeClass('d-none');
						}
					});
					
					CKEDITOR.replace('instruksi');
				</script>
				<?php $this->endSection(); ?>