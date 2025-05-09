			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="content" style="min-height: 580px;">
			    <div class="container">
			        <div class="row">
			            
			            <?= $this->include('header-user'); ?>

			            <div class="col-lg-9">
			            	<div class="pb-4">
			                    <h5 id="infoProfile">Info Profile</h5>
			                    <span class="strip-primary"></span>
			                </div>

			                <?= alert(); ?>

			                <div class="pb-3">
		                    	<div class="row">
		                    	    <div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<p>Hai <?= $users['username']; ?> !</p>
												<p>Level akun : <?= $users['level'] ?> <img src="<?php if ($users['level'] == 'Gold') { echo base_url().'/assets/images/member/gold-member-removebg-preview.png'; }else{ echo base_url().'/assets/images/member/silver-member-removebg-preview.png'; }?>" width='20' style='vertical-align: top;'></p>
												
												<?php if (count($level_av) !== 0): ?>
											    <a href="<?= base_url(); ?>/user/upgrade" class="btn btn-warning">Upgrade Akun</a>
												<?php endif; ?>
											</div>
										</div>
									</div>
	                        		<div class="col-md-6">
										<div class="card" id="saldoSaya">
											<div class="card-body">
												<p>Saldo Saya</p>
												<h4 class="m-0" id="saldoSayaText">Rp <?= number_format($users['balance'],0,',','.'); ?></h4>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-body" id="pesananSaya">
												<p>Pesanan Saya</p>
												<h4 class="m-0" id="pesananSayaText"><?= number_format($orders,0,',','.'); ?></h4>
											</div>
										</div>
									</div>
	                        	</div>
			                    <div class="section mb-4">
			                        <div class="card-body" id="profileDetail">
			                        	<form action="" method="POST">
			                        		<div class="form-group">
			                        			<label class="text-white" id="profileDetailUser">Username</label>
			                        			<input type="text" class="form-control bg-white" readonly="" value="<?= $users['username']; ?>" style="border: 1px solid #ced4da;">
			                        			<small>Username tidak dapat diganti</small>
			                        		</div>
			                        		<div class="form-group">
			                        			<label class="text-white" id="profileDetailWA">Whatsapp</label>
			                        			<input type="number" class="form-control" value="<?= $users['wa']; ?>" name="wa" style="border: 1px solid #ced4da;">
			                        		</div>
			                        		<div class="text-right">
			                        			<button class="btn text-white" type="reset">Batal</button>
			                        			<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
			                        		</div>
			                        	</form>
			                        </div>
			                    </div>
			                    <div class="section">
			                        <div class="card-body" id="gantiPassword">
			                        	<h5 id="gantiPasswordText">Ganti Password</h5>
			                        	<form action="" method="POST">
			                        		<div class="form-group">
			                        			<label class="text-white" id="gantiPasswordOld">Password Lama</label>
			                        			<input type="password" class="form-control bg-white" name="passwordl" style="border: 1px solid #ced4da;">
			                        		</div>
			                        		<div class="form-group">
			                        			<label class="text-white" id="gantiPasswordNew">Password Baru</label>
			                        			<input type="password" class="form-control bg-white" name="passwordb" style="border: 1px solid #ced4da;">
			                        		</div>
			                        		<div class="form-group">
			                        			<label class="text-white" id="gantiPasswordRepeat">Ulangi Password Baru</label>
			                        			<input type="password" class="form-control bg-white" name="passwordbb" style="border: 1px solid #ced4da;">
			                        		</div>
			                        		<div class="text-right">
			                        			<button class="btn text-white" type="reset">Batal</button>
			                        			<button class="btn btn-primary" type="submit" name="btn_password" value="password">Simpan</button>
			                        		</div>
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