				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Edit Admin</h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Username</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" value="<?= $account['username']; ?>">
											<small>Username tidak dapat diganti</small>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Status</label>
										<div class="col-md-8">
											<select name="status" class="form-control">
												<option value="On" <?= $account['status'] == 'On' ? 'selected' : ''; ?>>On</option>
												<option value="Off" <?= $account['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
											</select>
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
				<script>
					function btn_reset() {
						Swal.fire({
		                    title: 'Reset password?',
		                    text: "Password akan direset",
		                    icon: 'warning',
		                    showCancelButton: true,
		                    confirmButtonColor: '#3085d6',
		                    cancelButtonColor: '#d33',
		                    cancelButtonText: 'Batal',
		                    confirmButtonText: 'Reset password'
		                }).then((result) => {
		                    if (result.isConfirmed) {
		                        window.location.href = '<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin/reset/<?= $account['id']; ?>';
		                    }
		                });
					}
				</script>
				<?php $this->endSection(); ?>