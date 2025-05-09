				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content" style="min-height: 590px;">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Pesanan</h5>
										<b class="d-block mb-1">Keterangan Status</b>
										<ul class="mb-0 pl-4">
											<li><b>Pending</b> : Pesanan belum dibayar / menunggu pembayaran</li>
											<li><b>Processing</b> : Pesanan dalam proses oleh provider / manual</li>
											<li><b>Success</b> : Pesanan telah berhasil diproses</li>
											<li><b>Canceled</b> : Pesanan gagal diproses</li>
											<li><b>Expired</b> : Pesanan gagal / expired</li>
										</ul>
										<?= alert(); ?>
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr>
												<th>No</th>
												<th>No Transaksi</th>
												<th>Produk</th>
												<th>Metode</th>
												<th>Provider</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($orders as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><b class="cursor-pointer" onclick="detail('<?= $loop['order_id']; ?>');"><?= $loop['order_id']; ?></b></td>
												<td>
													<p class="mb-1"><?= $loop['product']; ?></p>
													<?php 
													if (!empty($loop['zone_id']) AND $loop['zone_id'] != 1) {
														echo $loop['user_id'] . ' ('.$loop['zone_id'].')';
													} else {
														echo $loop['user_id'];
													}
													?>
												</td>
												<td><?= $loop['method']; ?></td>
												<td><?= $loop['provider']; ?></td>
												<td><?= $loop['status']; ?></td>
												<td>
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
													<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
												</td>
											</tr>
											<?php endforeach ?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content" style="background: var(--warna_2);">
				            <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body p-0">
				            	
				            </div>
				        </div>
				    </div>
				</div>
				<script>
					function detail(order_id) {
						$.ajax({
							url: '<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/detail/' + order_id,
							success: function(result) {
								$("#modal-detail div div .modal-body").html(result);

								$("#modal-detail").modal('show');
							}
						});
					}
				</script>
				<?php $this->endSection(); ?>