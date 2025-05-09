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
										<h5 class="mb-0">Games</h5>
										<div class="card-tools">
											<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games/add" class="btn btn-primary btn-sm">Tambah Games</a>
										</div>

										<?= alert(); ?>

									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr>
												<th width="10">No</th>
												<th>Games</th>
												<th>Kategori</th>
												<th>Produk</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($games as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td>
													<img src="<?= base_url(); ?>/assets/images/games/<?= $loop['image']; ?>" alt="" width="40" class="mr-1 rounded">
													<?= $loop['games']; ?>
												</td>
												<td><?= $loop['category']; ?></td>
												<td><?= $loop['product']; ?> Produk</td>
												<td><?= $loop['status']; ?></td>
												<td width="10">
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
													<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
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