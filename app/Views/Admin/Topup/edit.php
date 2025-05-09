				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Edit Topup</h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Topup ID</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" value="<?= $topup['topup_id']; ?>">
											<small>Topup ID tidak dapat diganti</small>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Username</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="username" value="<?= $topup['username']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Metode</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="method" value="<?= $topup['method']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Jumlah</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="amount" value="<?= $topup['amount']; ?>">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Status</label>
										<div class="col-md-8">
											<select name="status" class="form-control">
												<option value="Pending" <?= $topup['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
												<option value="Success" <?= $topup['status'] == 'Success' ? 'selected' : ''; ?>>Success</option>
												<option value="Canceled" <?= $topup['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
											</select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Google Authenticator</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/topup" class="btn btn-warning float-start">Kembali</a>
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
				<script>
					function terima() {
						Swal.fire({
		                    title: 'Terima topup?',
		                    text: "Saldo akan dikirim ke pengguna",
		                    icon: 'warning',
		                    showCancelButton: true,
		                    confirmButtonColor: '#3085d6',
		                    cancelButtonColor: '#d33',
		                    cancelButtonText: 'Batal',
		                    confirmButtonText: 'Terima'
		                }).then((result) => {
		                    if (result.isConfirmed) {
		                        window.location.href = '<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/topup/accept/<?= $topup['id']; ?>';
		                    }
		                });
					}
				</script>
				<?php $this->endSection(); ?>