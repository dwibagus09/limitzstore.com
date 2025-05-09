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
    					                <h5 class="card-title">Reset Password</h5>
    					                <form action="" method="POST">
										<?= csrf_field(); ?> 
					                        <div class="mb-3">
					                            <label>Username</label>
					                            <input type="text" name="username" class="form-control" required autocomplete="off">
					                        </div>
					                        <div class="mb-3">
					                            <label>No. Whatsapp</label>
					                            <input type="number" name="wa" class="form-control" placeholder="62812345678"required autocomplete="off">
					                        </div>
					                        <button type="submit" name="tombol" value="submit" class="btn btn-primary w-100 btn-auth">Reset Password</button>
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