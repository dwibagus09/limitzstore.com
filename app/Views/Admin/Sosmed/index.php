				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Sosmed</h4>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/sosmed/add" class="btn btn-primary">Tambah Sosmed</a>
					</div>
					<div class="table-responsive">
						<table class="table border-top mb-0 no-border-last">
							<tr>
								<th width="10">No</th>
								<th>Gambar</th>
								<th>Teks</th>
								<th>Link</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($sosmed as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td>
									<img src="<?= base_url(); ?>/assets/images/sosmed/<?= $loop['image']; ?>" alt="" width="36" class="me-2 rounded">
								</td>
								<td><?= $loop['text']; ?></td>
								<td><?= $loop['link']; ?></td>
								<td width="10" nowrap>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/sosmed/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/sosmed/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>