			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="eniv-content">
                <div class="container">
            		<div class="eniv-body">
            			<div class="row">
            				
                            <?= $this->Include('users'); ?>
    
            				<div class="col-md-9">
            					<div class="card">
            						<div class="card-body">
            							<h6 class="card-title">
                                            <a href="<?= base_url(); ?>/user/topup/riwayat">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                            Detail #<?= $topup['topup_id']; ?>
                                        </h6>
                                        <table class="w-100">
                                            <tr>
                                                <td class="pb-2">Topup ID</td>
                                                <th class="text-end">
                                                    #<?= $topup['topup_id']; ?>
                                                    <div class="eniv-copy" onclick="salin('<?= $topup['topup_id']; ?>', 'Topup ID berhasil disalin');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                            <path d="M18.0549 7.82617H11.8049C11.0378 7.82617 10.416 8.47503 10.416 9.27545V15.7972C10.416 16.5976 11.0378 17.2465 11.8049 17.2465H18.0549C18.822 17.2465 19.4438 16.5976 19.4438 15.7972V9.27545C19.4438 8.47503 18.822 7.82617 18.0549 7.82617Z" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M3.472 10.8695H2.77756C2.4092 10.8695 2.05594 10.7168 1.79547 10.445C1.535 10.1732 1.38867 9.80461 1.38867 9.42023V2.89849C1.38867 2.51412 1.535 2.14549 1.79547 1.8737C2.05594 1.60191 2.4092 1.44922 2.77756 1.44922H9.02756C9.39592 1.44922 9.74919 1.60191 10.0097 1.8737C10.2701 2.14549 10.4164 2.51412 10.4164 2.89849V3.62313" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class="pb-2">Jumlah</td>
                                                <th class="text-end">Rp <?= number_format($topup['amount'] - $topup['fee'],0,',','.'); ?></th>
                                            </tr>
                                            <tr>
                                                <td class="pb-2">Biaya Admin</td>
                                                <th class="text-end">Rp <?= number_format($topup['fee'],0,',','.'); ?></th>
                                            </tr>
                                            <tr>
                                                <td class="pb-2">Pembayaran</td>
                                                <th class="text-end"><?= $topup['method']; ?></th>
                                            </tr>
                                            <tr>
                                                <td class="pb-2">Status</td>
                                                <th class="text-end">
                                                    <span class="fw-500 text-<?= badge($topup['status']); ?>"><?= $topup['status']; ?></span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class="pb-2">Tanggal Transaksi</td>
                                                <th class="text-end"><?= $topup['date_create']; ?></th>
                                            </tr>
                                        </table>
                                        <?php if ($topup['status'] == 'Pending'): ?>
                                        <div class="mt-4">
                                            <p class="fw-600 mb-0 fs-16">Detail Pembayaran</p>
                                            <p>Selesaikan pembayaranmu untuk menghindari pembatalan otomatis</p>
                                            <div class="eniv-timer">
                                                <div class="eniv-hour">
                                                    <div class="eniv-timer-big">0</div>
                                                    <div class="eniv-timer-small">jam</div>
                                                </div>
                                                <div class="eniv-minutes">
                                                    <div class="eniv-timer-big">0</div>
                                                    <div class="eniv-timer-small">menit</div>
                                                </div>
                                                <div class="eniv-second">
                                                    <div class="eniv-timer-big">0</div>
                                                    <div class="eniv-timer-small">detik</div>
                                                </div>
                                            </div>
                                            <div class="eniv-card-payment">
                                                <table class="w-100">
                                                    <tr>
                                                        <td class="pt-2 pb-3">Pembayaran</td>
                                                        <th class="text-end">
                                                            <?php if (filter_var($topup['payment_code'], FILTER_VALIDATE_URL)): ?>
        					                                <?php if (in_array('dana', explode('.', $topup['payment_code'])) OR in_array('airpay', explode('.', $topup['payment_code'])) OR in_array('xendit', explode('.', $topup['payment_code']))): ?>
        					                                <p>Klik tombol dibawah untuk melakukan pembayaran</p>
        					                                <a href="<?= $topup['payment_code']; ?>" class="btn btn-success mt-2 mb-2">Bayar Sekarang</a>
        					                                <?php else: ?>
        					                                <img src="<?= $topup['payment_code']; ?>" width="180" class="mt-3">
        					                                <?php endif; ?>
        					                                <?php else: ?>
        					                                <?php if (strlen($topup['payment_code']) > 100): ?>
        					                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= $topup['payment_code']; ?>" width="180">
        					                                <?php else: ?>
        					                                <b class="d-block mt-2"><?= $topup['payment_code']; ?></b>
        					                                <?php endif ?>
        					                                <?php endif ?>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <p class="fw-600 mb-2 fs-16">Instruksi Pembayaran</p>
                                            <?= htmlspecialchars_decode($topup['instruksi']); ?>
                                        </div>
                                        <?php endif; ?>
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
                </div>
            </div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<?php if ($topup['status'] == 'Pending'): ?>
            <script>
                var second_expired = new Date("<?= date('M d, Y G:i:s', strtotime($topup['date_create']) + 60*60*24); ?>").getTime();
    
                var x = setInterval(function() {
    
                    var now = new Date().getTime();
    
                    var distance = second_expired - now;
    
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
                    if (hours == 0) {
                        $(".eniv-hour").addClass('d-none');
                    }
    
                    $(".eniv-hour .eniv-timer-big").text(hours);
                    $(".eniv-minutes .eniv-timer-big").text(minutes);
                    $(".eniv-second .eniv-timer-big").text(seconds);
    
                    if (distance < 0) {
                        window.location.reload();
                    }
                }, 1000);
            </script>
            <?php endif ?>
			<?php $this->endSection(); ?>