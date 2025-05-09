				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Games</h5>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games/add" class="btn btn-primary btn-sm">Tambah Games</a>
					</div>
					<div class="table-responsive">
						<table class="table table-striped mb-0 border-top no-border-last">
							<tr>
								<th width="10">No</th>
								<th width="10">ID</th>
								<th>Games</th>
								<th>Kategori</th>
								<th>Produk</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($games as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><span class="badge bg-primary"><?= $loop['id']; ?></span></td>
								<td>
									<img src="<?= $loop['image']; ?>" alt="" width="28" class="me-1 rounded">
									<?= $loop['games']; ?>
								</td>
								<td><?= $loop['category']; ?></td>
								<td><?= $loop['product']; ?> Produk</td>
								<td><?= $loop['status']; ?></td>
								<td width="10" nowrap>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>