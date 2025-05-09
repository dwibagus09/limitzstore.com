				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tambah Admin</h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Username</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="username">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Password</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="password">
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin" class="btn btn-warning float-start">Kembali</a>
									<div class="text-end">
										<button class="btn" type="reset">Batal</button>
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