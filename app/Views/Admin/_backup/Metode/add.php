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
												<h5 class="mb-3">Tambah Metode</h5>
												<?= alert(); ?>
												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Nama Metode</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="method">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Gambar</label>
														<div class="col-md-8">
															<div class="custom-file">
															    <input type="file" class="custom-file-input" id="method-image" name="image">
															    <label class="custom-file-label" for="method-image">Choose file</label>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Kode Unik</label>
														<div class="col-md-8">
															<select name="uniq" class="form-control">
																<option value="Y">Ya</option>
																<option value="N">Tidak</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Provider</label>
														<div class="col-md-8">
															<select name="provider" class="form-control">
																<option value="Manual">Manual</option>
																<option value="Tripay">Tripay</option>
																<option value="Xendit">Xendit</option>
																<option value="Xcash">Xcash</option>
															</select>
														</div>
													</div>
													<div class="form-group row" id="tipe-manual">
														<label class="col-form-label col-md-4 text-white">Rekening</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="rek">
														</div>
													</div>
													<div class="form-group row d-none" id="tipe-tripay">
														<label class="col-form-label col-md-4 text-white">Kode Metode</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="code">
															<small>Kode metode bisa di cek <a href="https://tripay.co.id/developer?tab=channels" class="text-warning" target="_blank">disini</a></small>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Instruksi</label>
														<div class="col-md-8">
															<textarea name="instruksi"></textarea>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Kategori</label>
														<div class="col-md-8">
															<select name="type" class="form-control">
															    <option value="">Pilih Kategori</option>
																<option value="BT">Bank Transfer</option>
																<option value="WALLET">E-Wallet</option>
																<option value="VA">Virtual Akun</option>
																<option value="CS">Minimarket</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Biaya Admin</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="fee">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Biaya Admin (Persen)</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="percent">
															<small>Biaya Admin bisa di cek <a href="https://tripay.co.id/developer?tab=channels" class="text-warning" target="_blank">disini</a>. Untuk penulisan persen tanpa huruf '%' dan tanda koma(",") diganti dengan tanda titik(".").</small>
														</div>
													</div>
													<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode" class="btn btn-warning float-left">Kembali</a>
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
				<script>
					$("select[name=provider]").on('change', function() {
						if ($(this).val() == 'Manual') {
							$("#tipe-manual").removeClass('d-none');
							$("#tipe-tripay").addClass('d-none');
						} else {
							$("#tipe-manual").addClass('d-none');
							$("#tipe-tripay").removeClass('d-none');
						}
					});
					$(".custom-file-input").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
					});
				</script>
				<script>
					CKEDITOR.replace('instruksi');
				</script>
				<?php $this->endSection(); ?>