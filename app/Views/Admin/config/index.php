<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">CONFIG</h4>
					</div>
					<div class="table-responsive">
						<table class="table-white table table-striped border-top">
						    <thead>
						        <tr>
									<th width="10">No</th>
									<th>Nama</th>
									<th>Value</th>
                                    <th>Action</th>
								</tr>
						    </thead>
							<tbody id="sortable">
								<?php $no = 1; foreach ($config as $loop): ?>
								<tr id="<?= $loop['nama']; ?>">
									<td><?= $no++; ?></td>
									<td><?= $loop['nama']; ?></td>
									<td><?= $loop['value']; ?></td>
                                    <td width="10" nowrap>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/config/update/<?= $loop['nama']; ?>" class="btn btn-primary btn-sm">Edit</a>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
			
				<?php $this->endSection(); ?>