<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card mb-4">
					<div class="card-body">
						<h4 class="card-title">Tata Cara Menu</h4>
						<div class="mb-3">
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/add-menu" class="btn btn-primary btn-sm">Tambah Menu</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table-white table table-striped border-top">
						    <thead>
						        <tr>
									<th width="10">No</th>
									<th>Nama</th>
									<th>Slug</th>
                                    <th>Action</th>
								</tr>
						    </thead>
							<tbody id="sortable">
								<?php $no = 1; foreach ($data as $loop): ?>
								<tr id="<?= $loop['id']; ?>">
									<td><?= $no++; ?></td>
									<td><?= $loop['nama']; ?></td>
									<td><?= $loop['slug']; ?></td>
									<td width="10" nowrap>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/edit-menu/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
										<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/delete-menu/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>

                <div class="card mb-4">
					<div class="card-body">
						<h4 class="card-title">Langkah - Langkah</h4>
						<div class="mb-3">
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/add-langkah" class="btn btn-primary btn-sm">Tambah Langkah Langkah</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table-white table table-striped border-top">
						    <thead>
						        <tr>
									<th width="10">No</th>
									<th>Category</th>
									<th>Sort</th>
                                    <th>Title</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
								</tr>
						    </thead>
							<tbody id="sortable">
								<?php $no = 1; foreach ($datahead as $loop): ?>
								<tr id="<?= $loop['id']; ?>">
									<td><?= $no++; ?></td>
									<td><?= $loop['nama']; ?></td>
									<td><?= $loop['sort']; ?></td>
                                    <td><?= $loop['title']; ?></td>
                                    <td><?= $loop['deskripsi']; ?></td>
									<td width="10" nowrap>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/edit-langkah/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
										<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/delete-langkah/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>

                <div class="card mb-4">
					<div class="card-body">
						<h4 class="card-title">Content dari Langkah - Langkah</h4>
						<div class="mb-3">
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/add-content" class="btn btn-primary btn-sm">Tambah Content</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table-white table table-striped border-top">
						    <thead>
						        <tr>
									<th width="10">No</th>
									<th>Category</th>
									<th>Title</th>
                                    <th>Deskripsi</th>
                                    <th>Type</th>
                                    <th>Isi</th>
                                    <th>Action</th>
								</tr>
						    </thead>
							<tbody id="sortable">
								<?php $no = 1; foreach ($databody as $loop): ?>
								<tr id="<?= $loop['id']; ?>">
									<td><?= $no++; ?></td>
									<td><?= $loop['nama']; ?></td>
                                    <td><?= $loop['title']; ?></td>
                                    <td><?= $loop['deskripsi']; ?></td>
									<td><?= $loop['type']; ?></td>
                                    <td><?= $loop['isi']; ?></td>
									<td width="10" nowrap>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/edit-content/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
										<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara/delete-content/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
				
				<?php $this->endSection(); ?>