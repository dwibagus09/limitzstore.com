				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<div class="card">
									<div class="card-body">
										<h5 class="mb-0">Produk</h5>
										<div class="card-tools">
											<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/add" class="btn btn-primary btn-sm">Tambah Produk</a>
											<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/update" class="btn btn-primary btn-sm">Update Harga</a>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr>
												<th width="10">No</th>
												<th>Games</th>
												<th>Produk</th>
												<th>Koin</th>
												<th>Harga Modal</th>
												<th>Harga Publik</th>
												<th>Harga Silver</th>
												<th>Harga Gold</th>
												<th>Harga Bisnis</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($product as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $loop['games']; ?></td>
												<td><?= $loop['product']; ?></td>
												<td><?= number_format($loop['coin'],0,',','.'); ?> <i class="fa fa-bitcoin"></i></td>
												<td>Rp <?= number_format($loop['price_modal'],0,',','.'); ?></td>
												<td>Rp <?= number_format($loop['price'],0,',','.'); ?></td>
												<td>Rp <?= number_format($loop['price_silver'],0,',','.'); ?></td>
												<td>Rp <?= number_format($loop['price_gold'],0,',','.'); ?></td>
												<td>Rp <?= number_format($loop['price_bisnis'],0,',','.'); ?></td>
												<td><?= $loop['status']; ?></td>
												<td width="10">
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/price/<?= $loop['id']; ?>" class="btn btn-success btn-sm d-none">Kostum Harga</a>
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
													<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
												</td>
											</tr>
											<?php endforeach ?>
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