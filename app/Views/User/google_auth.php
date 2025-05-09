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
                        <div class="row justify-content-center">
                        	

                        <div class="card card-body">

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
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>