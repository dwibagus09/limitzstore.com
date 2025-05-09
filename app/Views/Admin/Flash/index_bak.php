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
										<label class="col-form-label col-md-4">Tanggal Expired</label>
										<div class="col-md-8">
										    <div class="input-group">
										        <?php $fs_date = explode(' ', $fs['date']); ?>
										        <input type="date" class="form-control left" autocomplete="off" name="fs_date" value="<?= $fs_date[0]; ?>">
												<input type="time" class="form-control right" autocomplete="off" name="fs_date_time" value="<?= $fs_date[1]; ?>">
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Status</label>
										<div class="col-md-8">
											<select name="fs_status" class="form-control">
												<option value="On" <?= $fs['status'] == 'On' ? 'selected' : ''; ?> ?>On</option>
												<option value="Off" <?= $fs['status'] == 'Off' ? 'selected' : ''; ?> ?>Off</option>
											</select>
										</div>
									</div>
									<div class="text-end mb-3">
										<button class="btn " type="reset">Batal</button>
										<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
									</div>
								</form>
								<div class="table-responsive">
								    <table class="table border">
								        <tr>
								            <th>Produk</th>
								            <th>Harga</th>
								        </tr>
								        <?php foreach ($fs['product'] as $loop): ?>
								        <tr>
								            <td><?= $loop['product']; ?></td>
								            <td>Rp <?= number_format($loop['price_cut'],0,',','.'); ?></td>
								        </tr>
								        <?php endforeach; ?>
								    </table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>