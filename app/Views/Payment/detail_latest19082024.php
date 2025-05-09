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
						<div class="col-md-5">
							<div class="card">
								<div class="card-body eniv-card">
									<p class="fw-600 mb-3 fs-16">Detail Pesanan</p>
									<hr class="my-2">
									<table class="w-100">
									<tr>
										<td class="pb-2">Order ID</td>
										<th class="text-end">
											<?= $orders['order_id']; ?>
											<div class="eniv-copy" onclick="salin('<?= $orders['order_id']; ?>', 'Order ID berhasil disalin');">
												<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
													<path d="M18.0549 7.82617H11.8049C11.0378 7.82617 10.416 8.47503 10.416 9.27545V15.7972C10.416 16.5976 11.0378 17.2465 11.8049 17.2465H18.0549C18.822 17.2465 19.4438 16.5976 19.4438 15.7972V9.27545C19.4438 8.47503 18.822 7.82617 18.0549 7.82617Z" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M3.472 10.8695H2.77756C2.4092 10.8695 2.05594 10.7168 1.79547 10.445C1.535 10.1732 1.38867 9.80461 1.38867 9.42023V2.89849C1.38867 2.51412 1.535 2.14549 1.79547 1.8737C2.05594 1.60191 2.4092 1.44922 2.77756 1.44922H9.02756C9.39592 1.44922 9.74919 1.60191 10.0097 1.8737C10.2701 2.14549 10.4164 2.51412 10.4164 2.89849V3.62313" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</div>
										</th>
									</tr>
									<tr>
										<td class="pb-2">Tanggal Transaksi</td>
										<th class="text-end"><?= $orders['date_create']; ?></th>
									</tr>
									<tr>
										<td class="pb-2">Status Transaksi</td>
										<th class="text-end"><span class="badge bg-<?= badge($orders['status']); ?>"><?= $orders['status']; ?></span></th>
									</tr>
									<tr>
										<td class="pb-2">Status Pembayaran</td>
										<th class="text-end"><span class="badge bg-<?= badgepembayaran($orders['status']); ?>"><?= status_payment($orders['status']); ?></span></th>
									</tr>
									</table>
									<hr class="my-2">
                    				<table class="w-100">
                    					<tr>
                    						<td class="pb-2">Harga</td>
                    						<th class="text-end">Rp <?= number_format($orders['price'] - $orders['fee'],0,',','.'); ?></th>
                    					</tr>
                    					<tr>
                    						<td class="pb-2">Biaya Admin</td>
                    						<th class="text-end">Rp <?= number_format($orders['fee'],0,',','.'); ?></th>
                    					</tr>
                    				</table>
                    				<hr class="my-2">
                    				<table class="w-100">
                    					<tr>
                    						<td class="pb-2">Total</td>
                    						<th class="text-end text-primary text-italic fw-600">
	                    						Rp <?= number_format($orders['price'],0,',','.'); ?>
	                    						<div class="eniv-copy" onclick="salin('<?= $orders['price']; ?>', 'Total Pembayaran berhasil disalin');">
	                    							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
	                    								<path d="M18.0549 7.82617H11.8049C11.0378 7.82617 10.416 8.47503 10.416 9.27545V15.7972C10.416 16.5976 11.0378 17.2465 11.8049 17.2465H18.0549C18.822 17.2465 19.4438 16.5976 19.4438 15.7972V9.27545C19.4438 8.47503 18.822 7.82617 18.0549 7.82617Z" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
	                    								<path d="M3.472 10.8695H2.77756C2.4092 10.8695 2.05594 10.7168 1.79547 10.445C1.535 10.1732 1.38867 9.80461 1.38867 9.42023V2.89849C1.38867 2.51412 1.535 2.14549 1.79547 1.8737C2.05594 1.60191 2.4092 1.44922 2.77756 1.44922H9.02756C9.39592 1.44922 9.74919 1.60191 10.0097 1.8737C10.2701 2.14549 10.4164 2.51412 10.4164 2.89849V3.62313" stroke="#fff" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
	                    							</svg>
	                    						</div>
	                    					</th>
                    					</tr>
                    				</table>
								</div>
							</div>

							<div class="row mobile-only">
                    			<div class="col-md-12">
                    				<div class="card">
		                    			<div class="card-body eniv-card">
		                    				<p class="fw-600 mb-3 fs-16">Detail Produk</p>
		                    				<hr class="my-2">
		                    				<div class="eniv-invoice-detail-produk">
		                    					<img src="<?= $orders['games_image']; ?>">
		                    					<div class="eniv-invoice-detail-produk-content">
		                    						<h1><?= $orders['games']; ?></h1>
		                    						<span><?= $orders['product']; ?></span>
		                    						<?php if($orders['jumlah'] > 1): ?>
		                    						<br />
		                    						<span style="font-size:10px;">Jumlah: <?= $orders['jumlah']; ?></small>
		                    						<?php endif; ?>
		                    					</div>
		                    				</div>
		                    			</div>
		                    		</div>
                    			</div>
                    			<div class="col-md-12">
                    				<div class="card">
		                    			<div class="card-body eniv-card">
		                    				<p class="fw-600 mb-3 fs-16">Detail Player</p>
		                    				<hr class="my-2">
		                    				<table class="w-100">
		                    					<?php if (!empty($orders['nickname'])): ?>
		                    					<tr>
		                    						<td class="pb-2">Nickname</td>
		                    						<th class="text-end"><?= $orders['nickname']; ?></th>
		                    					</tr>
		                    					<?php endif ?>
		                    					<tr>
		                    						<td class="pb-2">ID Player</td>
		                    						<th class="text-end">
		                    						    <?php
        	                    						    echo $orders['user_id'];
        
        													if (!empty($orders['zone_id']) AND $orders['zone_id'] !== '1') {
        														echo ' ('.$orders['zone_id'].') ';
        													}
		                    						    ?>
		                    						</th>
		                    					</tr>
		                    				</table>
		                    			</div>
		                    		</div>
                    			</div>
                    			<!--<div class="col-md-12">
		                    		<div class="card">
		                    			<div class="card-body eniv-card">
		                    				<p class="fw-600 mb-3 fs-16">Keterangan Pesanan</p>
		                    				<hr class="my-2">
		                    				<p style="font-size:12px"><?= $orders['ket']; ?></p>
		                    	        </div>
		                    	    </div>
                    			</div>-->
                    		</div>

						</div>


						<div class="col-md-7">
                    		<?php if ($orders['status'] == 'Pending'): ?>
                			<div class="card">
                    			<div class="card-body eniv-card">
	                    			<p class="fw-600 mb-0 fs-16">Detail Pembayaran</p>
	                    			<p class="mt-2" style="font-size: 12px;">Ayo Selesaikan Pesanan Kamu Sebelum Waktu Berakhir</p>
	                    			<div class="eniv-card-payment">
	                    				<div class="row">
		                    				<div class="col-6"><span style="font-size: 12px;font-weight: bold;">Metode Pembayaran</span></div>
		                    				<div class="col-6" align="right"><img src="<?= base_url(); ?>/assets/images/method/<?= $orders['method_image']; ?>" class="eniv-method-image" alt="" style="height:25px;"></div>
	                    				</div>

	                    				<div class="row">
		                    				<div class="col-12" align="center">
		                    					<!--<strong><p class="mb-0">Scan QR</p></strong>-->
		                    					<?php if (filter_var($orders['payment_code'], FILTER_VALIDATE_URL)): ?>
	                    					        <?php if (in_array('tripay', explode('.', $orders['payment_code'])) OR in_array('qr', explode('/', $orders['payment_code']))): ?>

														<?php $explode = explode("qr/", $orders['payment_code']); ?>
														<img src="<?= $orders['payment_code']; ?>" width="180" class="mt-3">
														<br />
														<a href="https://tripay.co.id/qr/<?= $explode[1]; ?>" class="btn btn-success" download ><i class="fa fa-download"></i> Unduh Kode QR</a>
                									
													<?php else: ?>
                									
													<?php endif; ?>

												<?php elseif ($orders['method'] == 'Bank BCA'): ?>

													<p class="mb-0">No. Rekening<br><b><?= $orders['payment_code']; ?></b></p>

											   <?php else: ?>
                
                								    <?php if (strlen($orders['payment_code']) < 100): ?>
                									<p class="mb-0">Kode Pembayaran / No. Virtual Account<br><b><?= $orders['payment_code']; ?></b></p>
                								    <?php else: ?>
            										<strong><p class="mb-0">Scan QR</p></strong>
            										<img src="https://api.qrserver.com/v1/create-qr-code/?size=1080x1080&data=<?= $orders['payment_code']; ?>" width="300" class="mt-3">
            										<br />
            										<br />
            										<a href="https://api.qrserver.com/v1/create-qr-code/?size=1080x1080&data=<?= $orders['payment_code']; ?>" class="btn btn-success mt-2 mb-2" download ><i class="fa fa-download"></i> Unduh Kode QR</a>
                								    <?php endif ?>
                
                								<?php endif ?>
		                    				</div>
	                    				</div>
	                    			</div>
	                    			<div class="mt-4">
	                    			    <?php if (in_array('tokopay', explode('.', $orders['payment_code'])) OR in_array('tripay', explode('.', $orders['payment_code'])) OR in_array('xendit', explode('.', $orders['payment_code'])) OR in_array('dana', explode('.', $orders['payment_code'])) OR in_array('duitku', explode('.', $orders['payment_code'])) OR in_array('shp', explode('.', $orders['payment_code'])) OR in_array('airpay', explode('.', $orders['payment_code']))): ?>
								        <p class="mb-2" style="font-size: 12px;text-align: center;">Klik tombol dibawah untuk melakukan pembayaran</p>
								        <a href="<?= $orders['payment_code']; ?>" class="btn btn-success mb-4" style="width:100%">Bayar Sekarang</a>
    									<?php endif ?>

	    								<div class="eniv-timer">
			                    			<div class="eniv-minutes">
			                    				<div class="eniv-timer-big">0</div>
			                    				<div class="eniv-timer-small">menit</div>
			                    			</div>
			                    			<div class="eniv-second">
			                    				<div class="eniv-timer-big">0</div>
			                    				<div class="eniv-timer-small">detik</div>
			                    			</div>
		                    			</div>

    									<?php if(!empty(htmlspecialchars_decode($orders['instruksi']))): ?>
                                        <p class="fw-600 mb-2 fs-16">Instruksi Pembayaran</p>
                                        <?= htmlspecialchars_decode($orders['instruksi']); ?>
                                    	<?php endif; ?>
                                    </div>
                                </div>
                            </div>
                			<?php endif; ?>
                			<?php if ($orders['status'] == 'Processing'): ?>
                			<div class="card">
                    			<div class="card-body eniv-card">
	                    			<div class="text-center">
		                    			<div class="mb-3">
		                    				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
												<path d="M29.2849 19.8453L23.4458 13.9941C22.0914 12.6369 20.2896 11.8896 18.3722 11.8896C16.4548 11.8896 14.6531 12.6371 13.2988 13.9941L9.06616 18.2359C6.28003 21.0275 6.28003 25.5701 9.06616 28.3619L14.9175 34.2254C15.1894 34.4985 15.5126 34.7151 15.8685 34.8627C16.2244 35.0104 16.606 35.0861 16.9914 35.0855C17.74 35.0855 18.489 34.8002 19.0609 34.2297C20.2062 33.0867 28.1371 25.1299 29.2808 23.9885C30.4259 22.8457 30.4279 20.9908 29.2849 19.8453Z" fill="#105C6E"/>
												<path d="M50 0.585938C48.382 0.585938 47.0703 1.89766 47.0703 3.51562V12.8906C47.0703 14.5086 48.382 15.8203 50 15.8203C51.618 15.8203 52.9297 14.5086 52.9297 12.8906V3.51562C52.9297 1.89766 51.618 0.585938 50 0.585938Z" fill="#26879C"/>
												<path d="M57.2266 0H42.7734C41.1555 0 39.8438 1.31172 39.8438 2.92969C39.8438 4.54766 41.1555 5.85938 42.7734 5.85938H57.2266C58.8445 5.85938 60.1562 4.54766 60.1562 2.92969C60.1562 1.31172 58.8445 0 57.2266 0Z" fill="#2CA4FF"/>
												<path d="M50 0H42.7734C41.1555 0 39.8438 1.31172 39.8438 2.92969C39.8438 4.54766 41.1555 5.85938 42.7734 5.85938H50V0Z" fill="#58C6FF"/>
												<path d="M81.7664 23.1669C73.2816 14.6645 62 9.98193 49.9998 9.98193C37.9996 9.98193 26.718 14.6645 18.2332 23.1669C9.75 31.6677 5.07812 42.9698 5.07812 54.9909C5.07812 67.012 9.75 78.3142 18.2332 86.8149C26.718 95.3173 37.9996 99.9999 49.9998 99.9999C62 99.9999 73.2816 95.3173 81.7664 86.8149C90.2496 78.3142 94.9215 67.012 94.9215 54.9909C94.9215 42.9698 90.2496 31.6677 81.7664 23.1669Z" fill="#2CA4FF"/>
												<path d="M49.9998 9.98193C37.9996 9.98193 26.718 14.6645 18.2332 23.1669C9.75 31.6677 5.07812 42.9698 5.07812 54.9909C5.07812 67.012 9.75 78.3142 18.2332 86.8149C26.718 95.3173 37.9996 99.9999 49.9998 99.9999V9.98193Z" fill="#58C6FF"/>
												<path d="M50.0008 21.1987C31.4035 21.1987 16.2734 36.3577 16.2734 54.9907C16.2734 73.6237 31.4035 88.7829 50.0008 88.7829C68.598 88.7829 83.7281 73.6237 83.7281 54.9907C83.7281 36.3577 68.598 21.1987 50.0008 21.1987Z" fill="#CFF9FF"/>
												<path d="M50.0008 21.1987C31.4035 21.1987 16.2734 36.3577 16.2734 54.9907C16.2734 73.6237 31.4035 88.7829 50.0008 88.7829V21.1987Z" fill="#FCFFFF"/>
												<path d="M50.0008 28.5172C51.6187 28.5172 52.9305 27.2055 52.9305 25.5875V21.3281C51.9646 21.2445 50.9879 21.1992 50.0008 21.1992C49.0137 21.1992 48.0369 21.2445 47.0711 21.3281V25.5875C47.0711 27.2055 48.3828 28.5172 50.0008 28.5172ZM50.0008 81.4652C48.3828 81.4652 47.0711 82.777 47.0711 84.3949V88.6543C48.0369 88.7379 49.0137 88.7832 50.0008 88.7832C50.9879 88.7832 51.9646 88.7379 52.9305 88.6543V84.3949C52.9305 82.777 51.6187 81.4652 50.0008 81.4652ZM83.6 52.0615H79.4045C77.7865 52.0615 76.4748 53.3732 76.4748 54.9912C76.4748 56.6092 77.7865 57.9209 79.4045 57.9209H83.6C83.6832 56.9551 83.7281 55.9783 83.7281 54.9912C83.7281 54.0041 83.6832 53.0273 83.6 52.0615ZM23.5268 54.9912C23.5268 53.3732 22.215 52.0615 20.5971 52.0615H16.4016C16.3184 53.0273 16.2734 54.0041 16.2734 54.9912C16.2734 55.9783 16.3184 56.9551 16.4016 57.9209H20.5971C22.215 57.9209 23.5268 56.6092 23.5268 54.9912ZM57.2273 53.3004H53.0941V41.4514C53.0941 39.8334 51.7824 38.5217 50.1645 38.5217C48.5465 38.5217 47.2348 39.8334 47.2348 41.4514V56.2301C47.2348 57.848 48.5465 59.1598 50.1645 59.1598H57.2273C58.8453 59.1598 60.157 57.848 60.157 56.2301C60.157 54.6121 58.8453 53.3004 57.2273 53.3004Z" fill="#105C6E"/>
											</svg>
		                    			</div>
	                    				<h5 class="fs-16 mb-0">Pesanan Dalam Proses</h5>
	                    				<p class="mb-2">Silahkan tunggu hingga status pesanan terupdate</p>
	                    			</div>
	                    		</div>
	                    	</div>
                			<?php endif; ?>
                			<?php if ($orders['status'] == 'Success'): ?>
	                			<div class="card">
	                    			<div class="card-body eniv-card">
		                    			<div class="text-center">
			                    			<div class="mb-3">
			                    				<svg width="81" height="81" viewBox="0 0 81 81" fill="none" xmlns="http://www.w3.org/2000/svg">
													<g clip-path="url(#clip0_74_512)">
													<path d="M40.5 0.5C18.4094 0.5 0.5 18.4031 0.5 40.5C0.5 62.5969 18.4094 80.5 40.5 80.5C62.5906 80.5 80.5 62.5859 80.5 40.5C80.5 18.4141 62.5906 0.5 40.5 0.5Z" fill="#2AD352"/>
													<path d="M0.500037 40.5C0.491008 47.1116 2.12827 53.6215 5.2641 59.4422C9.25922 60.6152 13.4019 61.2092 17.5657 61.2062C41.6125 61.2062 61.1063 41.7125 61.1063 17.6656C61.1099 13.4358 60.4972 9.22811 59.2875 5.17499C53.505 2.09487 47.0518 0.489084 40.5 0.499994C18.4094 0.499994 0.500037 18.4031 0.500037 40.5Z" fill="#74DA7F"/>
													<path d="M63.3128 33.8719L39.2706 59.1203C38.6154 59.8077 37.8282 60.3557 36.9561 60.7316C36.0841 61.1074 35.1452 61.3034 34.1956 61.3078H34.1643C33.22 61.3081 32.2853 61.1186 31.4156 60.7506C30.546 60.3826 29.7591 59.8436 29.1018 59.1656L16.344 46.025C15.6848 45.3633 15.1636 44.5773 14.8107 43.7126C14.4577 42.8479 14.28 41.9216 14.2878 40.9877C14.2957 40.0537 14.489 39.1306 14.8565 38.272C15.224 37.4133 15.7583 36.6362 16.4286 35.9857C17.0988 35.3353 17.8916 34.8244 18.7608 34.4828C19.6301 34.1411 20.5586 33.9755 21.4923 33.9956C22.4261 34.0157 23.3466 34.221 24.2004 34.5997C25.0542 34.9784 25.8242 35.5229 26.4659 36.2016L34.1143 44.0797L53.0971 24.1453C53.733 23.4635 54.4978 22.9144 55.3473 22.53C56.1967 22.1456 57.1139 21.9334 58.0459 21.9058C58.9778 21.8781 59.906 22.0355 60.7768 22.3688C61.6475 22.7021 62.4435 23.2048 63.1188 23.8477C63.794 24.4906 64.3351 25.261 64.7107 26.1144C65.0863 26.9678 65.289 27.8871 65.307 28.8193C65.3251 29.7515 65.1581 30.678 64.8158 31.5453C64.4735 32.4125 63.9626 33.2033 63.3128 33.8719Z" fill="white"/>
													</g>
													<defs>
														<clipPath id="clip0_74_512">
															<rect width="80" height="80" fill="white" transform="translate(0.5 0.5)"/>
														</clipPath>
													</defs>
												</svg>
			                    			</div>
		                    				<h5 class="fs-16 mb-0">Pesanan Telah Berhasil</h5>
		                    				<p class="mb-2">Pesanan kamu telah berhasil diproses, terimakasih telah melakukan pembelian kebutuhan game kamu di <?= $web['title']; ?></p>
		                    			</div>
		                    		</div>
		                    	</div>

		                    	<?php if (count($review) == 0): ?>
		                    	<div class="card">
	                    			<div class="card-body eniv-card">
	                    			    <p class="fw-500 mb-1">Berikan penilaian untuk transaksi ini</p>
	                    			    <div class="eniv-star mb-3">
	                    			        <i class="fa fa-star" onclick="select_star('1');" id="star-1"></i>
	                    			        <i class="fa fa-star" onclick="select_star('2');" id="star-2"></i>
	                    			        <i class="fa fa-star" onclick="select_star('3');" id="star-3"></i>
	                    			        <i class="fa fa-star" onclick="select_star('4');" id="star-4"></i>
	                    			        <i class="fa fa-star" onclick="select_star('5');" id="star-5"></i>
	                    			    </div>
	                    			    <p class="fw-500 mb-1">Berikan pesan Anda</p>
	                    			    <div class="eniv-review mb-2">
	                    			        <?php foreach ($review_template as $loop): ?>
	                    			        <span id="template-<?= $loop['id']; ?>" onclick="select_template('<?= $loop['id']; ?>', '<?= $loop['text']; ?>');"><?= $loop['text']; ?></span>
	                    			        <?php endforeach; ?>
	                    			        <span id="template-custom" onclick="select_template('custom', '');">Custom</span>
	                    			    </div>
	                    			    <form action="" method="POST">
										<?= csrf_field(); ?> 
	                    			        <div class="mb-2 d-none" id="template-text-custom">
	                        			        <input type="hidden" name="star" value="0">
	                        			        <textarea class="form-control" name="message" rows="4"></textarea>
	                        			    </div>
	                        			    <button class="btn btn-primary" type="submit" name="tombol" value="submit">Kirim</button>
	                    			    </form>
	                    			</div>
	                    		</div>
	                    		<?php else: ?>
	                    		<div class="card">
	                    			<div class="card-body eniv-card">
	                    			    <p class="fw-500 mb-2">Penilaian Anda</p>
	                    			    <div class="eniv-star mb-2">
	                    			        <?php for ($i = 1; $i <= $review[0]['star']; $i++): ?>
	                    			        <i class="fa fa-star text-warning"></i>
	                    			        <?php endfor; ?>
	                    			    </div>
	                    			    <i>"<?= $review[0]['message']; ?>"</i>
	                    		    </div>
	                    		</div>
	                			<?php endif; ?>
                			
                			<?php endif; ?>

                			<?php if ($orders['status'] == 'Canceled'): ?>
                			<div class="card">
                    			<div class="card-body eniv-card">
	                    			<div class="text-center">
		                    			<div class="mb-3">
		                    				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
												<path d="M12.6637 47.0459H6.77988C5.16191 47.0459 5.16191 41.1865 6.77988 41.1865H12.6637C14.2816 41.1865 15.5934 42.4982 15.5934 44.1162C15.5934 45.7342 14.2816 47.0459 12.6637 47.0459Z" fill="#414952"/>
												<path d="M50.8965 2.92969V8.8125C50.8965 10.4316 49.584 11.7422 47.9668 11.7422L46.502 5.88711L47.9668 1.7168C49.4316 1.7168 50.8965 2.12109 50.8965 2.92969Z" fill="#23272B"/>
												<path d="M47.9668 1.7168V11.7422C46.3477 11.7422 45.0371 10.4316 45.0371 8.8125V2.92969C45.0371 2.12109 46.502 1.7168 47.9668 1.7168Z" fill="#414952"/>
												<path d="M89.4193 44.1172C89.4193 55.1895 85.1068 65.5977 77.2768 73.4277C69.4486 81.2578 59.0385 85.5684 47.9662 85.5684L32.0938 39.6484L47.9662 2.66406C59.0385 2.66406 69.4486 6.97461 77.2768 14.8047C85.1068 22.6348 89.4193 33.043 89.4193 44.1172Z" fill="#DEDEF4"/>
												<path d="M18.6543 14.8047C10.8262 22.6348 6.51367 33.043 6.51367 44.1172C6.51367 55.1895 10.8262 65.5977 18.6543 73.4277C26.4844 81.2578 36.8945 85.5684 47.9668 85.5684V2.66406C36.8945 2.66406 26.4844 6.97461 18.6543 14.8047Z" fill="#F5F5FC"/>
												<path d="M23.0041 22.0832C22.6192 22.0837 22.2381 22.0082 21.8826 21.8609C21.5271 21.7136 21.2042 21.4975 20.9326 21.225L16.772 17.0646C15.6279 15.9205 19.771 11.7773 20.9152 12.9214L25.0757 17.082C26.2199 18.2261 26.2199 20.081 25.0757 21.2251C24.804 21.4976 24.481 21.7136 24.1255 21.8609C23.77 22.0081 23.3889 22.0837 23.0041 22.0832ZM16.772 71.1681L20.9326 67.0076C22.0765 65.8634 23.9316 65.8634 25.0757 67.0076C26.2199 68.1517 26.2199 70.0066 25.0757 71.1507L20.9152 75.3113C20.3431 75.8833 15.6277 72.3123 16.772 71.1681Z" fill="#414952"/>
												<path d="M89.1529 47.0458H83.2691C81.6512 47.0458 80.3395 45.734 80.3395 44.1161C80.3395 42.4981 81.6512 41.1864 83.2691 41.1864H89.1529C90.7709 41.1864 90.7709 47.0458 89.1529 47.0458ZM72.9293 22.0829C72.5445 22.0834 72.1634 22.0079 71.8079 21.8606C71.4524 21.7133 71.1295 21.4972 70.8578 21.2247C69.7137 20.0805 69.7137 18.2256 70.8578 17.0815L75.0184 12.9209C76.1623 11.7768 80.3057 15.92 79.1615 17.0641L75.001 21.2247C74.7292 21.4972 74.4063 21.7133 74.0508 21.8606C73.6953 22.0078 73.3141 22.0834 72.9293 22.0829ZM60.334 56.4842C59.7637 57.0565 59.0137 57.3417 58.2637 57.3417C57.5137 57.3417 56.7637 57.0565 56.1914 56.4842L47.9668 48.2596L46.502 32.4071L47.9668 20.5936C49.584 20.5936 50.8965 21.9042 50.8965 23.5233V42.9022L60.334 52.3417C61.4785 53.4862 61.4785 55.3397 60.334 56.4842Z" fill="#23272B"/>
												<path d="M92.082 44.1172C92.082 55.9004 87.4941 66.9785 79.1621 75.3105C70.8281 83.6426 59.75 88.2324 47.9668 88.2324L44.5293 85.3027L47.9668 82.373C69.0605 82.373 86.2227 65.2109 86.2227 44.1172C86.2227 23.0215 69.0605 5.85938 47.9668 5.85938L45.0371 2.92969L47.9668 0C59.75 0 70.8281 4.58984 79.1621 12.9219C87.4941 21.2539 92.082 32.332 92.082 44.1172Z" fill="#DE0062"/>
												<path d="M47.9668 5.85938V0C36.1836 0 25.1035 4.58984 16.7715 12.9219C8.43945 21.2539 3.84961 32.332 3.84961 44.1172C3.84961 55.9004 8.43945 66.9785 16.7715 75.3105C25.1035 83.6426 36.1836 88.2324 47.9668 88.2324V82.373C26.8711 82.373 9.70898 65.2109 9.70898 44.1172C9.70898 23.0215 26.8711 5.85938 47.9668 5.85938Z" fill="#FF3344"/>
												<path d="M47.9668 20.5938V48.2598L45.8945 46.1875C45.3457 45.6382 45.0373 44.8936 45.0371 44.1172V23.5234C45.0371 21.9043 46.3477 20.5938 47.9668 20.5938Z" fill="#414952"/>
												<path d="M94.4654 93.8535C92.2311 97.7012 88.2408 100 83.7916 100H51.5084C50.2838 100 49.0943 99.8262 47.9674 99.4922L42.9023 87.1744L47.9674 68.9805L56.9342 53.2891C59.1607 49.3945 63.1646 47.0703 67.651 47.0703C72.1353 47.0703 76.1393 49.3945 78.3658 53.2891L94.5064 81.5352C96.7135 85.4004 96.6998 90.0039 94.4654 93.8535Z" fill="#FCC100"/>
												<path d="M68.3052 75.3726C66.6872 75.3726 65.3755 74.0608 65.3755 72.4429V66.5591C65.3755 64.9411 66.6872 63.6294 68.3052 63.6294C69.9232 63.6294 71.2349 64.9411 71.2349 66.5591V72.4429C71.2349 74.0608 69.9232 75.3726 68.3052 75.3726ZM68.3052 88.2323C69.8376 88.2323 71.3058 86.8849 71.2349 85.3026C71.1638 83.7153 69.9476 82.373 68.3052 82.373C66.7728 82.373 65.3046 83.7204 65.3755 85.3026C65.4466 86.8899 66.6626 88.2323 68.3052 88.2323Z" fill="#23272B"/>
												<path d="M47.9674 68.9805V99.4922C44.9966 98.6172 42.4537 96.6426 40.8345 93.8535C38.6002 90.0039 38.5865 85.4004 40.7935 81.5352L47.9674 68.9805Z" fill="#FFDB6C"/>
											</svg>
		                    			</div>
	                    				<h5 class="fs-16 mb-0">Pesanan Dibatalkan</h5>
	                    				<p class="mb-2">Silahkan hubungi kami untuk informasi lebih lanjut</p>
	                    			</div>
	                    		</div>
	                    	</div>
                			<?php endif ?>


							<div class="row desktop-only">
                    			<div class="col-md-12">
                    				<div class="card">
		                    			<div class="card-body eniv-card">
		                    				<p class="fw-600 mb-3 fs-16">Detail Produk</p>
		                    				<hr class="my-2">
		                    				<div class="eniv-invoice-detail-produk">
		                    					<img src="<?= $orders['games_image']; ?>">
		                    					<div class="eniv-invoice-detail-produk-content">
		                    						<h1><?= $orders['games']; ?></h1>
		                    						<span><?= $orders['product']; ?></span>
		                    						<?php if($orders['jumlah'] > 1): ?>
		                    						<br />
		                    						<span style="font-size:10px;">Jumlah: <?= $orders['jumlah']; ?></small>
		                    						<?php endif; ?>
		                    					</div>
		                    				</div>
		                    			</div>
		                    		</div>
                    			</div>
                    			<div class="col-md-12">
                    				<div class="card">
		                    			<div class="card-body eniv-card">
		                    				<p class="fw-600 mb-3 fs-16">Detail Player</p>
		                    				<hr class="my-2">
		                    				<table class="w-100">
		                    					<?php if (!empty($orders['nickname'])): ?>
		                    					<tr>
		                    						<td class="pb-2">Nickname</td>
		                    						<th class="text-end"><?= $orders['nickname']; ?></th>
		                    					</tr>
		                    					<?php endif ?>
		                    					<tr>
		                    						<td class="pb-2">ID Player</td>
		                    						<th class="text-end">
		                    						    <?php
        	                    						    echo $orders['user_id'];
        
        													if (!empty($orders['zone_id']) AND $orders['zone_id'] !== '1') {
        														echo ' ('.$orders['zone_id'].') ';
        													}
		                    						    ?>
		                    						</th>
		                    					</tr>
		                    				</table>
		                    			</div>
		                    		</div>
                    			</div>
                    			<!--<div class="col-md-12">
		                    		<div class="card">
		                    			<div class="card-body eniv-card">
		                    				<p class="fw-600 mb-3 fs-16">Keterangan Pesanan</p>
		                    				<hr class="my-2">
		                    				<p style="font-size:12px"><?= $orders['ket']; ?></p>
		                    	        </div>
		                    	    </div>
                    			</div>-->
                    		</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
		<?php if ($orders['status'] == 'Pending'): ?>
		<script>
			var second_expired = new Date("<?= date('M d, Y G:i:s', strtotime($date_expired)); ?>").getTime();

			var x = setInterval(function() {

				var now = new Date().getTime();

                var sec = '<?php echo $order_timer[0]; ?>';
                var min = '<?php echo $order_timer[1]; ?>';
                var hr = '<?php echo $order_timer[2]; ?>';
				var distance = second_expired - now;

				var days = Math.floor(distance / (1000 * parseInt(sec) * parseInt(min) * parseInt(hr)));
				var hours = Math.floor((distance % (1000 * parseInt(sec) * parseInt(min) * parseInt(hr))) / (1000 * 60 * 60));
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
		
		<?php if ($confeti == true): ?>
		<script>
		    const start = () => {
                setTimeout(function() {
                    confetti.start()
                }, 1000);
            };
    
            const stop = () => {
                setTimeout(function() {
                    confetti.stop()
                }, 5000);
            };
            
            start();
            stop();
		</script>
		<?php endif; ?>
		
		<?php if (in_array($orders['status'], ['Pending', 'Processing'])): ?>
		<script>
		    setInterval(function() {
		        
		        $.ajax({
		            url: '<?= base_url(); ?>/payment/check/status/<?= $orders['order_id']; ?>',
		            success: function(result) {
		                
		                if (result !== '<?= $orders['status']; ?>') {
		                    window.location.reload();
		                }
		            }
		        });
		    }, 1000);
		</script>
		<?php endif; ?>
		
		<?php if ($orders['status'] == 'Success'): ?>
		<script>
		    function select_star(quantity) {
                    		        
		        $(".eniv-star i").removeClass('text-warning');
		        
		        for (var i = 1; i <= quantity; i++) {
		            $("#star-" + i).addClass('text-warning');
		        }
		        
		        $("input[name=star]").val(quantity);
		    }
		    
		    function select_template(id, text) {
		        
		        $(".eniv-review span").removeClass('active');
		        $("#template-" + id).addClass('active');
		        
		        $("textarea[name=message]").val(text);
		        
		        if (id == 'custom') {
		            $("#template-text-custom").removeClass('d-none');
		        } else {
		            $("#template-text-custom").addClass('d-none');
		        }
		    }
		</script>
		<?php endif; ?>
		<?php $this->endSection(); ?>