				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Metode</h6>
						<div class="mb-3">
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/add" class="btn btn-primary">Tambah Metode</a>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/category" class="btn btn-primary">Kategori</a>
						</div>
						<form action="" method="POST">
						    <?= csrf_field(); ?>
							<div class="row">
								<div class="col-md-6">
									<label>Pembayaran Saldo</label>
									<div class="input-group">
										<select name="pay_balance" class="form-control">
											<option value="Y" <?= $pay_balance == 'Y' ? 'selected' : ''; ?>>Ya</option>
											<option value="N" <?= $pay_balance == 'N' ? 'selected' : ''; ?>>Tidak</option>
										</select>
										<button class="btn btn-primary" name="tombol" value="tombol_balance" type="submit">Simpan</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table border-top no-border-last mb-0">
							<tr>
								<th width="10">No</th>
								<th>Metode</th>
								<th>Sub Teks</th>
								<th>Kategori</th>
								<th>Provider</th>
								<th>Kode Unik</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($method as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td>
									<img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="" width="70" class="me-2 rounded">
									<?= $loop['method']; ?>
								</td>
								<td><?= $loop['sub_title']; ?></td>
								<td><?= $loop['category']; ?></td>
								<td>
									<?= $loop['provider']; ?>
									<p class="m-0"><?= $loop['code']; ?></p>
								</td>
								<td>
									<?php
									if ($loop['uniq'] == 'Y') {
										echo "Ya";
									} else {
										echo "Tidak";
									}
									?>
								</td>
								<td><?= $loop['status']; ?></td>
								<td width="10" nowrap>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>