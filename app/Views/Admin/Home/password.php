				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Ganti Password</h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label  col-md-4">Password Lama</label>
										<div class="col-md-8">
											<input type="password" class="form-control" autocomplete="off" name="passwordl">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label  col-md-4">Password Baru</label>
										<div class="col-md-8">
											<input type="password" class="form-control" autocomplete="off" name="passwordb">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label  col-md-4">Ulangi Password Baru</label>
										<div class="col-md-8">
											<input type="password" class="form-control" autocomplete="off" name="passwordbb">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label  col-md-4">Ulangi Password Baru</label>
										<div class="col-md-8">
											<input type="number" class="form-control" name="googleauth" id="googleauth" maxlength="6">
										</div>
									</div>
									<center>
									<div class="g-recaptcha mb-4" 
													data-sitekey="<?= getenv('GOOGLE_RECAPTCHA_SITEKEY') ?>"
											></div></center>
									<div class="text-end">
										<button class="btn " type="reset">Batal</button>
										<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>