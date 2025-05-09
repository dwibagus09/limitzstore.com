				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title"><?= $title; ?></h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Order ID</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" value="<?= $review['order_id']; ?>" readonly>
											<small>Order ID tidak dapat diganti</small>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Jumlah Star</label>
										<div class="col-md-8">
										    <select class="form-control" name="star">
										        <?php for ($i = 1; $i <= 5; $i++): ?>
										        <option value="<?= $i; ?>" <?= $i == $review['star'] ? 'selected' : ''; ?>><?= $i; ?> Star</option>
										        <?php endfor; ?>
										    </select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Isi Pesan</label>
										<div class="col-md-8">
										    <textarea name="message" class="form-control" rows="4"><?= $review['message']; ?></textarea>
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review" class="btn btn-warning float-start">Kembali</a>
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
				<?php $this->endSection(); ?>