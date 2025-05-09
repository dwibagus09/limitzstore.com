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
												<h5 class="mb-3">Edit Produk</h5>

												<?= alert(); ?>

												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Games</label>
														<div class="col-md-8">
															<select name="games_id" class="form-control">
																<?php foreach ($games as $loop): ?>
																<option value="<?= $loop['id']; ?>" <?= $loop['id'] == $product['games_id'] ? 'selected' : ''; ?>><?= $loop['games']; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Produk</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="product" value="<?= $product['product']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Koin</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="coin" value="<?= $product['coin']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Harga Modal</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="price_modal" value="<?= $product['price_modal']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Harga Publik</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="price" value="<?= $product['price']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Harga Silver</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="price_silver" value="<?= $product['price_silver']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Harga Gold</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="price_gold" value="<?= $product['price_gold']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Harga Bisnis</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="price_bisnis" value="<?= $product['price_bisnis']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Provider</label>
														<div class="col-md-8">
															<select name="provider" class="form-control">
																<option value="DF" <?= $product['provider'] == 'DF' ? 'selected' : ''; ?>>Digiflazz</option>
																<option value="AG" <?= $product['provider'] == 'AG' ? 'selected' : ''; ?>>Api Games</option>
																<option value="Manual" <?= $product['provider'] == 'Manual' ? 'selected' : ''; ?>>Manual</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Kode Produk</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="sku" value="<?= $product['sku']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Logo URL</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="logo_url" value="<?= $product['logo_url']; ?>">
														    <small>Tulis Logo URL sebagai berikut : assets/images/nama_icon.png</small>
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