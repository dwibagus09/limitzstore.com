				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Pengguna</h5>
						<div>
						    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Konfigurasi</button>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/add" class="btn btn-primary">Tambah Akun</a>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/send-balance" class="btn btn-primary">Kirim Saldo</a>
						</div>
						<div class="collapse" id="collapseExample">
						    <div class="row mt-3">
						        <div class="col-md-6">
						            <form action="" method="POST">
									<?= csrf_field(); ?> 
								        <div class="mb-3 mt-3">
								            <label class="">Harga Silver</label>
								            <input type="number" class="form-control" autocomplete="off" name="harga_silver" value="<?= $harga_upgrade['silver']; ?>">
								        </div>
								        <div class="mb-3">
								            <label class="">Harga Gold</label>
								            <input type="number" class="form-control" autocomplete="off" name="harga_gold" value="<?= $harga_upgrade['gold']; ?>">
								        </div>
										<div class="mb-3">
								            <label class="">Harga Bisnis</label>
								            <input type="number" class="form-control" autocomplete="off" name="harga_bisnis" value="<?= $harga_upgrade['bisnis']; ?>">
								        </div>
								        <button class="btn btn-primary w-100" type="submit" name="tombol" value="submit">Simapn</button>
								    </form>
						        </div>
						    </div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="no-border-last table table-striped border-top">
							<tr>
								<th width="10">No</th>
								<th>Username</th>
                                <th>Level Reseller</th>
								<th>Whatsapp</th>
								<th>Saldo</th>
								<th>Status</th>
								<th>Konfirmasi</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($account as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $loop['username']; ?> <?php if ($loop['upgrade_membership'] == 'Pending') {?><a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/upgrademembership/<?= $loop['id']; ?>" class="badge badge-success">Upgrade Member</a><?php } ?></td>
								<td><?= $loop['level']; ?></td>
								<td><?= $loop['wa']; ?></td>
								<td>Rp <?= number_format($loop['balance'],0,',','.'); ?></td>
								<td><?= $loop['status']; ?></td>
								<td><?= $loop['confirm']; ?></td>
								<td width="10" nowrap>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/send-balance/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Kirim Saldo</a>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/reset-sandi/<?= $loop['id']; ?>" class="btn btn-warning btn-sm">Reset</a>
									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
								</td>
							</tr>
							<?php endforeach ?>
							<?php if (count($account) == 0): ?>
							<tr>
								<td colspan="6" align="center">Tidak ada pengguna</td>
							</tr>
							<?php endif ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>