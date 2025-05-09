			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="content" style="min-height: 580px;">
			    <div class="container">
			    	<div class="row justify-content-center">
					    <div class="col-lg-9">
					    	<div class="pt-3 pb-4">
					            <h5>Verifikasi Akun</h5>
					            <span class="strip-primary"></span>
					        </div>
					        <div class="pb-3">
					            <div class="section">
					                <div class="card-body">

					                	<?= alert(); ?>

					                    <form role="form" action="" method="POST">
					                        <div class="form-group mb-3">
					                            <p class="text-white">Kode OTP</p>
					                            <input type="number" name="otp" class="form-control" required autocomplete="off">
					                        </div>
					                        <button type="submit" name="tombol" value="submit" class="btn btn-primary">Verifikasi Akun</button>
					                    </form>
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