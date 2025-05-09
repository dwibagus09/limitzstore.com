			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
			    <div class="container">
			        <div class="row">
					    <div class="col-lg-3">
					        <div class="pt-3 pb-4">
					            <h5>Pembayaran</h5>
					            <span class="strip-primary"></span>
					        </div>
					    </div>
					    <div class="col-lg-9">
					        <div class="pb-3">
					            <div class="section">
					                <div class="card-body">
					                    <h4>Terima Kasih</h4> Topup anda berhasil dibuat. Masa berlaku untuk No. Transaksi ini 24 jam, segera lakukan pembayaran agar pesanan segera diproses. <br>
					                    <br> Simpan No. Transaksi anda untuk Cek Status Topup!
					                </div>
					            </div>
					        </div>
					        <div class="pb-3">
					            <div class="section">
					                <div class="card-body">
					                    <div class="row">
					                        <div class="col-sm-6">
					                            <div class="pb-4"> Waktu Transaksi <h5><?= $topup['date_create']; ?></h5>
					                            </div>
					                            <div class="pb-4"> Metode Pembayaran <h5><?= $topup['method']; ?></h5>
					                            </div>
					                            <div class="pb-4"> Kode Pembayaran / No. Virtual Account <br>
					                                <?php if (filter_var($topup['payment_code'], FILTER_VALIDATE_URL)): ?>
					                                <?php if (in_array('dana', explode('.', $topup['payment_code'])) OR in_array('airpay', explode('.', $topup['payment_code'])) OR in_array('xendit', explode('.', $topup['payment_code']))): ?>
					                                <p>Klik tombol dibawah untuk melakukan pembayaran</p>
					                                <a href="<?= $topup['payment_code']; ?>" class="btn btn-success mt-2 mb-2">Bayar Sekarang</a>
					                                <?php else: ?>
					                                <img src="<?= $topup['payment_code']; ?>" width="180" class="mt-3">
					                                <?php endif; ?>
					                                <?php else: ?>
					                                <?php if (strlen($topup['payment_code']) > 100): ?>
					                                <img src="https://chart.googleapis.com/chart?chs=280x280&cht=qr&choe=UTF-8&chl=<?= $topup['payment_code']; ?>" width="180">
					                                <?php else: ?>
					                                <b class="d-block mt-2"><?= $topup['payment_code']; ?></b>
					                                <?php endif ?>
					                                <?php endif ?>
					                            </div>
					                        </div>
					                        <div class="col-sm-6">
					                            <div class="pb-4"> No. Transaksi 
					                            	<h5>
					                            		TP<?= $topup['topup_id']; ?> <i class="fa fa-clone pl-2 clip" onclick="copy_trxaku()" data-clipboard-text="TP<?= $topup['topup_id']; ?>"></i>
					                                </h5>
					                            </div>
					                            <div class="pb-4"> 
					                            	Nominal <h5>Rp. <?= number_format($topup['amount'] - $topup['fee'],0,',','.'); ?></h5>
					                            </div>
					                            <div class="pb-4"> 
					                            	Biaya Admin <h5>Rp. <?= number_format($topup['fee'],0,',','.'); ?></h5>
					                            </div>
					                            <div class="pb-4"> 
					                            	Jumlah Pembayaran <h5>Rp. <?= number_format($topup['amount'],0,',','.'); ?></h5>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="pb-3">
					            <div class="section">
					                <div class="card-body">
					                    <h4>Informasi Cara Pembayaran</h4>
					                    <?= htmlspecialchars_decode($topup['instruksi']); ?>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>