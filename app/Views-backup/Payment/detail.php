<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<style>
        @import  url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
        @import  url("https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css");

        .cus-accordion {
            transform: translateZ(0);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            /* background: #fff; */
        }

        .cus-accordion>.accordion-toggle {
            position: absolute;
            opacity: 0;
            display: none;
        }

        .cus-accordion>label {
            position: relative;
            display: block;
            height: 50px;
            line-height: 50px;
            padding: 0 20px;
            font-size: 14px;
            font-weight: 700;
            border-top: 1px solid #ddd;
            /* background: #fff; */
            cursor: pointer;
        }

        .cus-accordion>label:after {
            content: '\f078';
            position: absolute;
            top: 0px;
            right: 20px;
            font-family: fontawesome;
            transform: rotate(90deg);
            transition: .3s transform;
        }

        .cus-accordion>section {
            height: 0;
            transition: .3s all;
            overflow: hidden;
        }

        .cus-accordion>.accordion-toggle:checked~label:after {
            transform: rotate(0deg);
        }

        .cus-accordion>.accordion-toggle:checked~section {
            height: 200px;
        }

        .cus-accordion>section p {
            margin: 15px 0;
            padding: 0 20px;
            font-size: 12px;
            line-height: 1.5;
        }
		.float-end{
			float: right!important;
			color: white;
		}

    </style>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
			    <div class="container">
			        <div class="row justify-content-center">
					    <div class="col-lg-12">
					    	<div class="pt-3 pb-4">
					            <h5 id="detailPesanan">Detail Pesanan</h5>
					            <span class="strip-primary"></span>
					        </div>

                            <div class="pb-3">
							<button class="btn btn-warning btn-sm mb-3" onclick="print_invoice()"><i class="fa fa-print"></i>
							Print</button>
								<div class="card shadow" id="invoice">
								<div class="card-header">
								<span class="h4">
								Invoice Number <strong>#<?= $orders['order_id']; ?> <i class="fa fa-clone pl-2 clip" onclick="copy_trx()" data-clipboard-text="<?= $orders['order_id']; ?>"></i></strong>
								</span>
								<span class="float-end">
								Status: <?php if ($orders['status'] == 'Success' OR $orders['status'] == 'Sukses') { ?><span class="badge text-uppercase bg-success text-dark">SUKSES</span><?php }else{ ?><span class="badge text-uppercase bg-warning text-dark">PENDING</span><?php } ?>
								</span>
								</div>
								<div class="card-body">
								<?php if ($orders['status'] != 'Success') : ?>
								<div class="row">
								<div class="col-12">
								<span class="h6"><b>Tanggal dibuat</b>: <?= $orders['date_create']; ?></span>
								</div>
								<div class="col-12">
								<span class="h6 text-danger"><b>Tanggal expired</b>: <?php echo date("Y-m-d H:i:s", strtotime('+3 hours', strtotime($orders['date_create']))); ?></span>
								</div>
								</div>
								<div class="row mt-2">
								<div class="col-lg-12">
								<blockquote class="blockquote border bg-gradient rounded shadow p-4" style="background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));">
								<b>Harap Dibayar Sebelum 3 Jam!</b><br>
								Segera lakukan pembayaran sesuai "Total Yang Harus Dibayar" tekan tombol Copy Nominal yg
								berwarna hijau
								</blockquote>
								</div>
								</div>
								<?php endif ?>
								<div class="row mt-3">
								<div class="col-12">
								<div class="table-responsive" style="font-size:12px !important;">
								<table class="table table-clear table-dark" style="background-color: #212529">
								<thead>
								<tr>
								<td style="text-align: center; vertical-align: middle;">Nama Layanan</td>
								<td style="text-align: center; vertical-align: middle;">ID</td>
								<td style="text-align: center; vertical-align: middle;">Metode Pembayaran
								</td>
								</tr>
								</thead>
								<tbody>
								<tr>
								<td style="text-align: center; vertical-align: middle;">
								<?= $orders['games']; ?> ( <?= $orders['product']; ?> )
								</td>
								<td style="text-align: center; vertical-align: middle;">
								<?php 
																					echo $orders['user_id'];

																					if (!empty($orders['zone_id']) AND $orders['zone_id'] !== '1') {
																						echo ' ('.$orders['zone_id'].') ';
																					}

																					if (!empty($orders['nickname'])) {
																						echo $orders['nickname'];
																					}
								?>
								</td>
								<td style="text-align: center; vertical-align: middle;">
								<?= $orders['method']; ?>
								</td>
								</tr>
								</tbody>
								</table>
								</div>
								</div>
								</div>
								<div class="row mt-2">
								<div class="col-lg-7 d-print-none">
								<div class="card shadow">
								<div class="card-body">
								<?php if (filter_var($orders['payment_code'], FILTER_VALIDATE_URL)): ?>
								<?php if (in_array('xendit', explode('.', $orders['payment_code'])) OR in_array('dana', explode('.', $orders['payment_code'])) OR in_array('airpay', explode('.', $orders['payment_code']))): ?>
								    <p class="text-center">
								        Klik tombol dibawah untuk melakukan pembayaran
								        <a href="<?= $orders['payment_code']; ?>" class="btn btn-success mt-2 mb-2" >Bayar Sekarang</a>
								    </p>
								    <h4>Instruksi:</h4>
									<div class="cus-accordion">
										<input type="radio" class="accordion-toggle" name="toggle" id="toggle1">
										<label for="toggle1" style="color: #fff">
										Pembayaran via <?= $orders['method']; ?>
									</label>
									<section>
									<?php echo htmlspecialchars_decode(stripslashes($orders['instruksi'])); ?>
									</section>
									</div>
								<?php else: ?>
								    <?php $explode = explode("qr/", $orders['payment_code']); ?>
									<center><strong><p>Scan QR</p></strong>
									<img src="<?= $orders['payment_code']; ?>" width="180" class="mt-3">
									<br />
									<a href="https://tripay.co.id/qr/<?= $explode[1]; ?>" class="btn btn-success mt-2 mb-2" download ><i class="fa fa-download"></i> Unduh QR</a>
									</center>
									<h4>Instruksi:</h4>
									<div class="cus-accordion">
										<input type="radio" class="accordion-toggle" name="toggle" id="toggle1">
										<label for="toggle1" style="color: #fff">
										Pembayaran via <?= $orders['method']; ?>
									</label>
									<section>
									<?php echo htmlspecialchars_decode(stripslashes($orders['instruksi'])); ?>
									</section>
									</div>
								<?php endif; ?>
								<?php elseif ($orders['method'] == 'Bank BCA'): ?>
									<h5>No. Rekening : <kbd data-toggle="tooltip" data-placement="bottom" id="paycode" title="Click to copy"><?= $orders['payment_code']; ?></kbd></h5>
									<!--<center><strong><p>Scan QR BCA</p></strong>-->
									<!--<img src="<?= base_url(); ?>/assets/images/QR.jpg" width="180" class="mt-3">-->
									<!--<br/>-->
									<!--<a href="<?= base_url(); ?>/assets/images/QR.jpg" class="btn btn-success mt-2 mb-2" download ><i class="fa fa-download"></i> Unduh QR</a>-->
									<!--</center>-->
									<!--<br/>-->
									<h4>Instruksi:</h4>
									<div class="cus-accordion">
										<input type="radio" class="accordion-toggle" name="toggle" id="toggle1">
										<label for="toggle1" style="color: #fff">
										Pembayaran via <?= $orders['method']; ?>
									</label>
									<section>
									<?php echo htmlspecialchars_decode(stripslashes($orders['instruksi'])); ?>
									</section>
									</div>
								<?php else: ?>
								    <?php if (strlen($orders['payment_code']) < 100): ?>
									<h5>Kode Pembayaran / No. Virtual Account: <kbd data-toggle="tooltip" data-placement="bottom" id="paycode" title="Click to copy"><?= $orders['payment_code']; ?></kbd></h5>
									<h4>Instruksi:</h4>
									<div class="cus-accordion">
										<input type="radio" class="accordion-toggle" name="toggle" id="toggle1">
										<label for="toggle1" style="color: #fff">
										Pembayaran via <?= $orders['method']; ?>
									</label>
									<section>
									<?php echo htmlspecialchars_decode(stripslashes($orders['instruksi'])); ?>
									</section>
									</div>
								    <?php else: ?>
									<center><strong><p>Scan QR</p></strong>
									<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= $orders['payment_code']; ?>" width="180" class="mt-3">
									</center>
									<h4>Instruksi:</h4>
									<div class="cus-accordion">
										<input type="radio" class="accordion-toggle" name="toggle" id="toggle1">
										<label for="toggle1" style="color: #fff">
										Pembayaran via <?= $orders['method']; ?>
									</label>
									<section>
									<?php echo htmlspecialchars_decode(stripslashes($orders['instruksi'])); ?>
									</section>
									</div>
								    <?php endif ?>
								<?php endif ?>
								</div>
								</div>
								</div>
								<div class="col-lg-5">
								<div class="table-responsive" style="font-size:12px !important;">
								<table class="table table-clear table-dark" style="background-color: #212529">
								<tbody>
								<tr>
								<td class="left">
								Harga
								</td>
								<td class="right text-right">
								IDR
								<?= number_format($orders['price'] - $orders['fee'],0,',','.'); ?>
								</td>
								</tr>
								<tr>
								<td class="left">
								Biaya Admin
								</td>
								<td class="right text-right">
								IDR <?= number_format($orders['fee'],0,',','.'); ?>
								</td>
								</tr>
								<tr>
								<td class="left">
								<strong>Total Yang Harus Di Bayar</strong>
								</td>
								<td class="right text-right">
								<strong style="color:lime;">
								<span type="button" title="Click to copy" id="totPriceBayar" onclick="copy_price()" data-clipboard-text="<?= $orders['price']; ?>">
								IDR <?= number_format($orders['price'],0,',','.'); ?>
								</span>
								<i class="fa fa-copy" type="button" onclick="copy_price()" data-clipboard-text="<?= $orders['price']; ?>"></i>
								</strong>
								</td>
								</tr>
								</tbody>
								</table>
								</div>
								</div>
								</div>
								</div>
								</div>
							</div>
					    </div>
					</div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<script>
				function copy_trx() {
					navigator.clipboard.writeText('<?= $orders['order_id']; ?>');

					Swal.fire('Berhasil', 'No Transaksi berhasil di salin', 'success');
				}
				function copy_price() {
					navigator.clipboard.writeText('<?= $orders['price']; ?>');

					Swal.fire('Berhasil', 'Total tagihan berhasil di salin', 'success');
				}
				function print_invoice() {
					var printContents = document.getElementById('invoice').innerHTML;
					var originalContents = document.body.innerHTML;
					document.body.innerHTML = printContents;
					window.print();
					document.body.innerHTML = originalContents;
					window.onafterprint = function() {
						location.reload()
					}
				}
			</script>
			<?php $this->endSection(); ?>