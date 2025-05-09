				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
				    <div class="col-md-10">
				        <div class="card">
        					<div class="card-body">
        						<h4 class="card-title">Admin</h4>
        						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin/add" class="btn btn-primary">Tambah Akun</a>
        					</div>
        					<div class="table-responsive">
        						<table class="table border-top">
        							<tr>
        								<th width="10">No</th>
        								<th>Username</th>
        								<th>Status</th>
        								<th>Terdaftar</th>
        								<th>Action</th>
        							</tr>
        							<?php $no = 1; foreach ($account as $loop): ?>
        							<tr>
        								<td><?= $no++; ?></td>
        								<td><?= $loop['username']; ?></td>
        								<td><?= $loop['status']; ?></td>
        								<td><?= $loop['date_create']; ?></td>
        								<td width="10" nowrap>
        									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
											<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin/reset/<?= $loop['id']; ?>" class="btn btn-warning btn-sm">Reset</a>
        									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
        								</td>
        							</tr>
        							<?php endforeach ?>
        						</table>
        					</div>
        				</div>
				    </div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>