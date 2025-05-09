				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content" style="min-height: 580px;">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Pengguna</h5>
										<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Konfigurasi</button>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/add" class="btn btn-primary">Tambah Akun</a>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/regist" class="btn btn-warning">Setting Metode Pembayaran Registrasi</a>
										<?= alert(); ?>
										<div class="collapse" id="collapseExample">
										    <div class="row">
										        <div class="col-md-6">
										            <form action="" method="POST">
        										        <div class="mb-3 mt-3">
        										            <label class="text-white">Harga Silver</label>
        										            <input type="number" class="form-control" autocomplete="off" name="harga_silver" value="<?= $harga_upgrade['silver']; ?>">
        										        </div>
        										        <div class="mb-3">
        										            <label class="text-white">Harga Gold</label>
        										            <input type="number" class="form-control" autocomplete="off" name="harga_gold" value="<?= $harga_upgrade['gold']; ?>">
        										        </div>
														<div class="mb-3">
        										            <label class="text-white">Harga Bisnis</label>
        										            <input type="number" class="form-control" autocomplete="off" name="harga_gold" value="<?= $harga_upgrade['bisnis']; ?>">
        										        </div>
        										        <button class="btn btn-primary btn-block" type="submit" name="tombol" value="submit">Simapn</button>
        										    </form>
										        </div>
										    </div>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
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
												<td><?= $loop['upgrade_membership']; ?></td>
												<td width="10">
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
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
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>