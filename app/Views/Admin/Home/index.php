				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
				<style>
				    .daterangepicker {
				        background: #2b2d3d;
				        padding: 12px !important;
				        border: none !important;
				    }
				    .daterangepicker:before {
				        border-bottom-color: #2b2d3d;
				    }
				    .daterangepicker:after {
				        border-bottom-color: #2b2d3d;
				    }
				    .daterangepicker .calendar {
				        float: left;
				    }
				    .daterangepicker .ranges {
				        clear: both;
				    }
				    .daterangepicker .calendar-table {
				        padding: 6px;
				        background: #323548;
				        border: none;
				        margin-right: 12px;
				    }
				    .daterangepicker_input {
				        position: relative;
				        margin-bottom: 12px;
				        margin-right: 12px;
				    }
				    .daterangepicker_input input {
				        padding: 10px 18px;
				        background: #242634 !important;
				    }
				    .daterangepicker_input i {
				        position: absolute;
				        right: 14px;
				        top: 12px;
				    }
				    .daterangepicker td.off, .daterangepicker td.off.start-date, .daterangepicker td.off.in-range {
				        background: transparent;
				    }
				    .daterangepicker td.in-range {
				        color: #fff;
				        background: #40445b;
				    }
				    .daterangepicker td.active, .daterangepicker td.active:hover, .daterangepicker td.available:hover, .daterangepicker th.available:hover {
				        background: var(--warna_3);
				        color: #333;
				    }
				    .range_inputs .btn-success {
				        color: #333 !important;
				        background: var(--warna_3) !important;
				    }
				    .daterangepicker.show-calendar .ranges {
				        width: 100%;
				        text-align: right;
				    }
				    .morris-hover-point {
				        color: #666 !important;
				        font-weight: 600;
				    }
				</style>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
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
									<p>Total Gamess</p>
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
									<p>Total Pembelian Hari ini</p>
									<h4>Rp <?= number_format($total['orders_today'],0,',','.'); ?></h4>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<p>Total Keuntungan Hari ini</p>
									<h4>Rp <?= number_format($total['keuntungan_today'],0,',','.'); ?></h4>
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
									<?= csrf_field(); ?> 
										<div class="mb-3">
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
					<div class="row">
						<div class="col-md-4">
						<div class="card">
					<div class="card-body">
						<h4 class="card-title">GAME POPULER</h4>
					</div>
					<div class="table-responsive">
						<table class="table-white table table-striped border-top">
						    <thead>
						        <tr>
									<th width="10">No</th>
									<th>Nama Games</th>
									<th>Jumlah Click</th>
								</tr>
						    </thead>
							<tbody id="sortable">
								<?php $no = 1; foreach ($total_click as $loop): ?>
								<tr id="<?= $loop['games']; ?>">
									<td><?= $no++; ?></td>
									<td><?= $loop['games']; ?></td>
									<td><?= $loop['jumlah_klik']; ?></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
						</div>
						<div class="col-md-4">
						<div class="card">
						<div class="card-body">
						<center>
                        <img class="mb-4" src="<?= $qr ?>" alt="QR SCAN GOOGLE AUTH" style="width:250px;height:220px;">
                        </center>
						<p class="text-center">
                            <ul>
                                <li>Download "Google Authenticator" Di Playstore/Appstore</li>
                                <li>Pindai Menggunakan Aplikasi Pengautentikasi Pihak Ketiga</li>
                            </ul>
                        Mohon gunakan aplikasi autentikasi Anda, Google Authenticator, untuk melakukan pemindaian.
                        </p>
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
				    var warna_3 = getComputedStyle(document.documentElement).getPropertyValue('--warna_3');
				
					new Morris.Line({
						element: 'myfirstchart',
						data: [
							<?php foreach ($chart as $loop): ?>
							{ tanggal: '<?= $loop['full_date']; ?>', total: <?= $loop['total']; ?> },
							<?php endforeach ?>
						],
						xkey: 'tanggal',
						ykeys: ['total'],
						labels: ['Total'],
						lineColors: [warna_3],
                        resize: true,
                        parseTime: false
					});
				</script>
				<script type="text/javascript">
					$(function() {
						$('input[name="daterange"]').daterangepicker({
                        timePicker: true,
                        dateLimit: {
    						"month": 3
 						},
                        locale: {
                                format: 'MM/DD/YYYY HH:mm:ss' // Specify the date-time format
                            }
                    });
					});
				</script>
				<?php $this->endSection(); ?>