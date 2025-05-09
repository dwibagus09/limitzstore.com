				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
				    <div class="col-md-12">
				        <div class="card">
        					<div class="card-body">
        						<h4 class="card-title pb-0 mb-0"><?= $title; ?></h4>
        					</div>
        					<div class="table-responsive">
        						<table class="mb-0 no-border-last table table-striped">
        							<tr>
        								<th width="10">No</th>
        								<th>Order ID</th>
        								<th>Produk</th>
        								<th>Star</th>
        								<th>Pesan</th>
        								<th>Tanggal</th>
        								<th>Action</th>
        							</tr>
        							<?php $no = 1; foreach ($review as $loop): ?>
        							<tr>
        								<td><?= $no++; ?></td>
        								<td><?= $loop['order_id']; ?></td>
        								<td><?= $loop['product']; ?></td>
        								<td>
        								    <?php for ($i = 1; $i <= $loop['star']; $i++): ?>
        								    <i class="fa fa-star text-warning"></i>
        								    <?php endfor; ?>
        								</td>
        								<td><?= $loop['message']; ?></td>
        								<td><?= $loop['date_create']; ?></td>
        								<td width="10" nowrap>
        								    <a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
        									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
        								</td>
        							</tr>
        							<?php endforeach ?>
        							<?php if (count($review) == 0): ?>
        							<tr>
        							    <td colspan="7" align="center">Tidak ada data</td>
        							</tr>
        							<?php endif; ?>
        						</table>
        					</div>
        				</div>
				    </div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>