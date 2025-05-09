				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Kategori Metode</h4>
								<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/category/add" class="btn btn-primary">Tambah Kategori</a>
							</div>
							<div class="table-responsive">
								<table class="table table-striped mb-0 no-border-last border-top">
									<tr>
										<th width="10">No</th>
										<th>Kategori</th>
										<th>Urutan</th>
										<th>Action</th>
									</tr>
									<?php $no = 1; foreach ($category as $loop): ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $loop['category']; ?></td>
										<td><?= $loop['sort']; ?></td>
										<td width="10" nowrap>
											<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/category/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
											<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/category/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
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