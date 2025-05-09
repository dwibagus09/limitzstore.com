		<?php $this->extend('template'); ?>
		
		<?php $this->section('css'); ?>
		<?php $this->endSection(); ?>
		
		<?php $this->section('content'); ?>
        <div class="eniv-content">
            <div class="container">
        		<div class="eniv-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-auth">
                                <div class="card-body">
                                    <h6 class="text-primary fw-600 fs-14">Masuk Akun</h6>
                                    <h5 class="fs-18">Selamat Datang!</h5>
                                    <p class="mb-4">Masukan username dan password kamu untuk masuk</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="" method="POST">
                                            <?= csrf_field(); ?> 
                                                <div class="mb-3">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" autocomplete="off">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="password">
                                                        <span class="input-group-text right">
                                                            <i class="fa fa-eye-slash" id="toggle-pw"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <center>
                                                    <div class="g-recaptcha mb-4" 
                                                                    data-sitekey="<?= getenv('GOOGLE_RECAPTCHA_SITEKEY') ?>"
                                                            ></div></center>


                                                <div class="mb-4">
                                                    <button class="btn btn-primary btn-auth w-100" type="submit" name="tombol" value="submit">Masuk Sekarang</button>
                                                </div>
                                                <div class="text-center">
                                                    <p class="mb-1"><span class="text-muted">Belum punya akun?</span> <a href="<?= base_url(); ?>/register" class="text-primary text-decoration-none ms-1">Daftar sekarang</a></p>
                                                    <p class="mb-0"><span class="text-muted">Lupa Password?</span> <a href="<?= base_url(); ?>/reset" class="text-primary text-decoration-none ms-1">Reset</a></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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