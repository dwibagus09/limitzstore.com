				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="eniv-content">
					<div class="container">
						<div class="eniv-body">
								
							<?= $this->include('header-admin'); ?>

							<div class="row justify-content-center">
								<div class="col-md-10">
									<div class="card">
										<div class="card-body">
											<h5 class="mb-3">Harga Pendaftaran Member</h5>
											<?= alert(); ?>
										</div>
										<form action="" method="POST">
										<?= csrf_field(); ?> 
											<table class="table table-white">
												<tr>
													<th>Metode</th>
													<th>Harga</th>
													<th>Note</th>
												</tr>
												<?php foreach ($method as $loop): ?>
												<tr>
													<td><img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="" width="100" class="rounded"></td>
													<td>
														<input type="number" class="form-control" autocomplete="off" value="<?= $loop['price']; ?>" name="price[<?= $loop['id']; ?>]">
													</td>
													<td>
														<input type="text" class="form-control" autocomplete="off" value="<?= $loop['note']; ?>" name="note[<?= $loop['id']; ?>]">
													</td>
												</tr>
												<?php endforeach ?>
											</table>
											<div class="card-body">
												<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna" class="btn btn-warning float-left">Kembali</a>
												<div class="text-end">
													<button class="btn " type="reset">Batal</button>
													<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>