			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="eniv-content">
                <div class="container">
            		<div class="eniv-body">
    			    	<div class="row justify-content-center">
    					    <div class="col-lg-9">
    					        <div class="card">
    					            <div class="card-body">
    					                <h5 class="card-title">Verifikasi Akun</h5>
    					                <form action="" method="POST">
										<?= csrf_field(); ?> 
					                        <div class="mb-3">
					                            <label>Kode OTP</label>
					                            <input type="number" name="otp" class="form-control" autocomplete="off" required>
					                        </div>
					                        <button type="submit" name="tombol" value="submit" class="btn btn-primary w-100 btn-auth">Verifikasi Akun</button>
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