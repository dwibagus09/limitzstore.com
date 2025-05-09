				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content" style="min-height: 580px;">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<div class="row">
									<div class="col-md-4">
										<div class="card">
											<div class="card-body">
												<p>Total Admin</p>
												<h4><?= $total['admin']; ?></h4>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="card">
											<div class="card-body">
												<p>Total Games</p>
												<h4><?= $total['games']; ?></h4>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="card">
											<div class="card-body">
												<p>Total Produk</p>
												<h4><?= $total['product']; ?></h4>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<p>Total Pembelian</p>
												<h4>Rp <?= number_format($total['orders'],0,',','.'); ?></h4>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<p>Total Keuntungan</p>
												<h4>Rp <?= number_format($total['keuntungan'],0,',','.'); ?></h4>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Grafik Pembelian</h5>
										<div class="row">
											<div class="col-md-5">
												<form action="" method="POST">
													<div class="form-group">
														<div class="input-group">
															<input type="text" class="form-control" name="daterange" value="<?= $date_range; ?>">
															<button class="btn btn-primary" type="submit">Filter</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										<div id="myfirstchart" style="height: 250px;"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
				<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
				<script>
					new Morris.Line({
						element: 'myfirstchart',
						data: [
							<?php foreach ($chart as $loop): ?>
							{ tanggal: '<?= $loop['tanggal']; ?>', total: <?= $loop['total']; ?> },
							<?php endforeach ?>
						],
						xkey: 'tanggal',
						ykeys: ['total'],
						labels: ['Tanggal'],
						// lineColors: ['#fff'],
                        resize: true,
                        parseTime: false
					});
				</script>
				<script type="text/javascript">
					$(function() {
						$('input[name="daterange"]').daterangepicker();
					});
				</script>
				<?php $this->endSection(); ?>