				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<div class="row justify-content-center">
									<div class="col-md-10">
										<div class="card">
											<div class="card-body">
												<h5 class="mb-3">Update Harga - By Rate Coin</h5>

												<?= alert(); ?>

												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Games</label>
														<div class="col-md-8">
														    <select class="form-control" name="games">
														        <option value="all">Semua Games</option>
														        <?php foreach($games as $loop): ?>
														        <option value="<?= $loop['id']; ?>"><?= $loop['games']; ?></option>
														        <?php endforeach; ?>
														    </select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Rate Modal</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="rate_modal">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Rate Publik</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="rate">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Rate Silver</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="rate_silver">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Rate Gold</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="rate_gold">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Rate Bisnis</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="rate_bisnis">
														</div>
													</div>
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk" class="btn btn-warning float-left">Kembali</a>
													<div class="text-right">
														<button class="btn text-white" type="reset">Batal</button>
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
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>