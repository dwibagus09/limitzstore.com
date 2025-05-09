				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
				    <div class="col-md-10">
				        <div class="card">
        					<div class="card-body">
        						<h4 class="card-title"><?= $title; ?></h4>
        						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i></a>
        						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review/template/add" class="btn btn-primary btn-sm">Tambah</a>
        					</div>
        					<div class="table-responsive">
        						<table class="mb-0 no-border-last table table-striped">
        							<tr>
        								<th width="10">No</th>
        								<th>Teks</th>
        								<th>Action</th>
        							</tr>
        							<?php $no = 1; foreach ($template as $loop): ?>
        							<tr>
        								<td><?= $no++; ?></td>
        								<td><?= $loop['text']; ?></td>
        								<td width="10" nowrap>
        									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review/template/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
        								</td>
        							</tr>
        							<?php endforeach ?>
        							<?php if (count($template) == 0): ?>
        							<tr>
        							    <td colspan="3" align="center">Tidak ada data</td>
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