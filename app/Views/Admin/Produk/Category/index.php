				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title"><?= $title; ?></h4>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk" class="btn btn-warning"><i class="fa fa-arrow-left"></i></a>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/category/add" class="btn btn-primary">Tambah Kategori</a>
					</div>
					<div class="table-responsive">
						<table class="no-border-last mb-0 table table-striped border-top">
							<tr>
								<th width="10">No</th>
								<th>ID</th>
								<th>Kategori</th>
								<th>Icon Image</th>
								<th>Urutan</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($category as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><span class="badge bg-primary"><?= $loop['id']; ?></span></td>
								<td><?= $loop['category']; ?></td>
								<td><img src="<?= $loop['image']; ?>" style="height: 30px;" /></td>
								<td><?= $loop['sort']; ?></td>
								<td width="10" nowrap>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/category/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/category/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>