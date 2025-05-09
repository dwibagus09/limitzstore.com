				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Target</h6>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/target/add" class="btn btn-primary">Tambah Target</a>
					</div>
					<div class="table-responsive">
						<table class="table border-top">
							<tr>
								<th>No</th>
								<th>Judul</th>
                                <th>Teks Header</th>
                                <th>Data Kolom</th>
                                <th>Sparator</th>
                                <th>Alert Error</th>
								<th>Action</th>
							</tr>
							<?php $no = 1; foreach ($target as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $loop['target']; ?></td>
                                <td><?= $loop['text']; ?></td>
                                <td>
                                    <?php 
                                    $show = 'Data tidak valid';

                                    $decode = json_decode($loop['col'], true);
                                    if ($decode) {
                                        if (is_array($decode)) {
                                            $show = count($decode) . ' kolom';
                                        }
                                    }

                                    echo $show;
                                    ?>
                                </td>
                                <td><?= $loop['sparator']; ?></td>
                                 <td><?= $loop['error']; ?></td>
								<td width="10" nowrap="">
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/target/edit/<?= $loop['id']; ?>" class="btn btn-primary "><i class="fa fa-pen me-1"></i>Edit</a>
									<button onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/target/delete/<?= $loop['id']; ?>');" class="btn btn-danger "><i class="fa fa-trash me-1"></i>Hapus</button>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>