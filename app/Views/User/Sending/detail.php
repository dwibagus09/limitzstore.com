<?php $this->extend('template'); ?>

<?php $this->section('css'); ?>
<style>
    .eniv-star i {
        font-size: 16px;
        margin-right: 2px;
    }
    .eniv-review span {
        background: #393c4e;
        padding: 6px 12px;
        display: inline-block;
        margin-right: 4px;
        margin-bottom: 8px;
        border-radius: 8px;
        cursor: pointer;
    }
    .eniv-review span.active, .eniv-review span:hover {
        background: var(--warna_3);
        color: #333;
    }
    table{
    	font-size: 12px;
    }
    @media only screen and (max-width: 767px) {
        .mobile-only {
            display: none !important;
        }
    }

    @media only screen and (min-width: 768px) {
        .desktop-only {
            display: none !important;
        }
    }
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="eniv-content">
	<div class="container">
		<div class="eniv-body">
			<div class="row">
				<div class="col-md-12">

					<div class="card">
						<div class="card-body eniv-card">
							<p class="fw-600 mb-3 fs-16">Detail Pengiriman Saldo Akun</p>
							<hr class="my-2">
							<table class="w-100">
							<tr>
								<td class="pb-2">TRX ID</td>
								<th class="text-end">
									<?= $receipt['trx_id']; ?>
									<div class="eniv-copy" onclick="salin('<?= $receipt['trx_id']; ?>', 'Order ID berhasil disalin');">
										<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
											<path d="M18.0549 7.82617H11.8049C11.0378 7.82617 10.416 8.47503 10.416 9.27545V15.7972C10.416 16.5976 11.0378 17.2465 11.8049 17.2465H18.0549C18.822 17.2465 19.4438 16.5976 19.4438 15.7972V9.27545C19.4438 8.47503 18.822 7.82617 18.0549 7.82617Z" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M3.472 10.8695H2.77756C2.4092 10.8695 2.05594 10.7168 1.79547 10.445C1.535 10.1732 1.38867 9.80461 1.38867 9.42023V2.89849C1.38867 2.51412 1.535 2.14549 1.79547 1.8737C2.05594 1.60191 2.4092 1.44922 2.77756 1.44922H9.02756C9.39592 1.44922 9.74919 1.60191 10.0097 1.8737C10.2701 2.14549 10.4164 2.51412 10.4164 2.89849V3.62313" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</th>
							</tr>
							<tr>
								<td class="pb-2">Tanggal Transaksi</td>
								<th class="text-end"><?= $receipt['created']; ?></th>
							</tr>
							<tr>
								<td class="pb-2">Status Transaksi</td>
								<?php 
								$status = "info";
								if($receipt['status'] == "success"){
									$status = "success";
								}
								if($receipt['status'] == "failed" || $receipt['status'] == "canceled"){
								    $status = "danger";
								} 
								?>
								<th class="text-end"><span class="badge bg-<?= $status; ?>"><?= $receipt['status']; ?></span></th>
							</tr>
							</table>
							<hr class="my-2">
            				<table class="w-100">
            					<tr>
            						<td class="pb-2">Pengirim</td>
            						<th class="text-end"><?= $receipt['username_sender']; ?></th>
            					</tr>
            					<tr>
            						<td class="pb-2">Penerima</td>
            						<th class="text-end"><?= $receipt['username_recipient']; ?></th>
            					</tr>
            					<tr>
            						<td class="pb-2">WhatsApp Penerima</td>
            						<th class="text-end"><?= $receipt['wa_recipient']; ?></th>
            					</tr>
            					<tr>
            						<td class="pb-2">Harga</td>
            						<th class="text-end">Rp <?= number_format($receipt['amount'],0,',','.'); ?></th>
            					</tr>
            				</table>
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