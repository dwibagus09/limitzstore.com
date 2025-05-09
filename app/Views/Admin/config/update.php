<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="eniv-content">
					<div class="container">
						<div class="eniv-body">

							<div class="row justify-content-center">
								<div class="col-md-10">
									<div class="card">
										<div class="card-body">
											<h5 class="mb-3">Update</h5>

											<?= alert(); ?>
											
											<form action="" method="POST">
											<?= csrf_field(); ?> 
											<div class="mb-3 row">
													<label class="col-form-label col-md-4">Value</label>
													<div class="col-md-8">
													   <select class="form-control" name="value">
															<?php foreach ($config as $loop): ?>
																<option value="1" <?= ($loop['value'] == '1') ? 'selected' : ''; ?>>Active</option>
																<option value="0" <?= ($loop['value'] == '0') ? 'selected' : ''; ?>>Inactive</option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/config" class="btn btn-warning float-left">Kembali</a>
												<div class="text-end">
													<button class="btn " type="reset">Batal</button>
													<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
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