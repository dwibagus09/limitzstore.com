				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Voucher</h6>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/voucher/add" class="btn btn-primary">Tambah Voucher</a>
					</div>
					<div class="table-responsive">
						<table class="table border-top no-border-last mb-0">
							<tr>
								<th width="10">No</th>
								<th>Voucher</th>
								<th>Diskon</th>
								<th>Max. Potongan</th>
								<th>Min. Transaksi</th>
								<th>Limit</th>
								<th>Judul</th>
								<th>Private</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($voucher as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $loop['voucher']; ?></td>
								<td><?= $loop['diskon_type'] == 'Flat' ? 'Rp ' . number_format($loop['diskon'],0,',','.') : $loop['diskon'] . '%'; ?></td>
								<td>Rp <?= number_format($loop['max'],0,',','.'); ?></td>
								<td>Rp <?= number_format($loop['min'],0,',','.'); ?></td>
								<td><?= $loop['stok']; ?></td>
								<td><?= $loop['title']; ?></td>
								<td><?= $loop['private'] == 'Y' ? 'Yes' : 'No'; ?></td>
								<td width="10" nowrap>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/voucher/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
									<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/voucher/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>