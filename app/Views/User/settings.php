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
        							<h6 class="card-title">Informasi Akun</h6>
    								<div class="mb-3">
    									<label>Username</label>
    									<input type="text" class="form-control" value="<?= $users['username']; ?>" readonly>
    								</div>
                                    <div class="">
                                        <label>No. Whatsapp</label>
                                        <input type="text" class="form-control" value="<?= $users['wa']; ?>" readonly>
                                    </div>
        						</div>
        					</div>
        					
        					<div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">API KEY</h6>
                                    <form action="<?= base_url('user/reset-apikey') ?>" method="POST">
                                    <?= csrf_field(); ?> 
                                        <div class="mb-3">
                                            <label>Api Key</label>
                                            <input type="text" class="form-control" name="api_key" value="<?= $users['api_key']; ?>">
                                        </div>
                                         <button class="btn btn-primary w-100" type="submit" name="btn_password" value="submit">Reset Api Key</button>
                                    </form>
                                </div>
                            </div>
                            
                            	<div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Callback URL</h6>
                                    <form action="<?= base_url('user/callback-url') ?>" method="POST">
                                    <?= csrf_field(); ?> 
                                        <div class="mb-3">
                                            <label>Callback URL</label>
                                            <input type="text" class="form-control" name="callback_url" value="<?= $users['callback_url']; ?>">
                                        </div>
                                         <div class="mb-3">
                                            <label>Whitelist IP</label>
                                            <input type="text" class="form-control" name="ip_api" value="<?= $users['ip_api']; ?>">
                                        </div>
                                         <button class="btn btn-primary w-100" type="submit" name="btn_password" value="submit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Ganti Password</h6>
                                    <form action="" method="POST">
                                    <?= csrf_field(); ?> 
                                        <div class="mb-3">
                                            <label>Password Lama</label>
                                            <input type="password" class="form-control" name="passwordl">
                                        </div>
                                        <div class="mb-3">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control" name="passwordb">
                                        </div>
                                        <div class="mb-3">
                                            <label>Ulangi Password Baru</label>
                                            <input type="password" class="form-control" name="passwordbb">
                                        </div>
                                        <div class="text-end">
                                            <button class="btn btn-primary" type="submit" name="btn_password" value="submit">Simpan</button>
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