				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<?= alert(); ?>

								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Umum</h5>
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Nama Website</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $web['name']; ?>" name="name" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Judul</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $web['title']; ?>" name="title" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Logo</label>
												<div class="col-md-8">
													<img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" alt="" class="mb-3 rounded" width="100">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFile" name="logo">
														<label class="custom-file-label" for="customFile">Choose file</label>
													</div>
													<small>Ukuran 512 x 512px</small>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Keywords</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $web['keywords']; ?>" name="keywords" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Deskripsi</label>
												<div class="col-md-8">
													<textarea name="descriptiona"><?= $web['description']; ?></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Upgrade Membership</label>
												<div class="col-md-8">
													<input type="number" class="form-control" value="<?= $web['upgrade-membership']; ?>" name="upgrade-membership" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="umum">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Banner</h5>
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Tambah Banner</label>
												<div class="col-md-8">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFile-banner" name="image">
														<label class="custom-file-label" for="customFile-banner">Choose file</label>
													</div>
													<small>Ukuran 1280 × 586px</small>
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="banner">Simpan</button>
											</div>
										</form>
									</div>
									<table class="table table-striped table-white m-0">
										<tr>
											<th>No</th>
											<th>Banner</th>
											<th>Action</th>
										</tr>
										<?php $no = 1; foreach ($banner as $loop): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
												<img src="<?= base_url(); ?>/assets/images/banner/<?= $loop['image']; ?>" alt="" width="120">
											</td>
											<td>
												<button class="btn btn-danger btn-sm" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/konfigurasi/banner/delete/<?= $loop['id']; ?>');">Hapus</button>
											</td>
										</tr>
										<?php endforeach ?>

										<?php if (count($banner) == 0): ?>
										<tr>
											<td colspan="3" align="center">Tidak ada banner</td>
										</tr>
										<?php endif ?>
									</table>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Digiflazz</h5>
										<form action="" method="POST">
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Username</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $digi['user']; ?>" name="user" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Api Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $digi['key']; ?>" name="key" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="digi">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Api Games</h5>
										<form action="" method="POST">
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Merchant ID</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $ag['merchant']; ?>" name="merchant" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Secret Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $ag['secret']; ?>" name="secret" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="ag">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Tripay</h5>
										<form action="" method="POST">
											<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/tripay</code></p>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Api Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $tripay['key']; ?>" name="key" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Private Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $tripay['private']; ?>" name="private" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Kode Merchant</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $tripay['merchant']; ?>" name="merchant" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="tripay">Simpan</button>
											</div>
										</form>
									</div>
								</div>
									<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Tripay</h5>
										<form action="" method="POST">
											<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/xcash</code></p>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Api Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $tripay['key']; ?>" name="key" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Secret Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $tripay['private']; ?>" name="private" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Key Callback</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $tripay['merchant']; ?>" name="merchant" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="tripay">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
								    <div class="card-body">
								        <h5 class="mb-3">Xendit</h5>
								        <form action="" method="POST">
											<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/xendit</code></p>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Secret Key</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $xendit['secret_key']; ?>" name="secret_key" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="xendit">Simpan</button>
											</div>
										</form>
								    </div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Moota</h5>
										<form action="" method="POST">
										    <p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/moota</code></p>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Secret Token</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $moota_secret; ?>" name="moota_secret" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="moota">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Api Enivay</h5>
										<form action="" method="POST">
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Lisensi</label>
												<div class="col-md-8">
													<input type="text" class="form-control" value="<?= $enivay; ?>" name="enivay" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="enivay">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Sosial Media</h5>
										<form action="" method="POST">
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Whatsapp</label>
												<div class="col-md-8">
													<input type="url" class="form-control" value="<?= $sm['wa']; ?>" name="wa" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Instagram</label>
												<div class="col-md-8">
													<input type="url" class="form-control" value="<?= $sm['ig']; ?>" name="ig" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">YouTube</label>
												<div class="col-md-8">
													<input type="url" class="form-control" value="<?= $sm['yt']; ?>" name="yt" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Facebook</label>
												<div class="col-md-8">
													<input type="url" class="form-control" value="<?= $sm['fb']; ?>" name="fb" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-4 col-form-label text-white">Twitter</label>
												<div class="col-md-8">
													<input type="url" class="form-control" value="<?= $sm['tw']; ?>" name="tw" autocomplete="off">
												</div>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="sm">Simpan</button>
											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="mb-3">Syarat & Ketentuan</h5>
										<form action="" method="POST">
											<div class="form-group">
												<textarea name="page_sk"><?= $page_sk; ?></textarea>
											</div>
											<div class="text-right">
												<button class="btn text-white" type="reset">Batal</button>
												<button class="btn btn-primary" type="submit" name="tombol" value="sk">Simpan</button>
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
				<script>
					$("#customFile").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings("label[for=customFile]").addClass("selected").html(fileName);
					});

					$("#customFile-banner").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings("label[for=customFile-banner]").addClass("selected").html(fileName);
					});

					CKEDITOR.replace('descriptiona');
					CKEDITOR.replace('page_sk', {
						height: 500,
					});
				</script>
				<?php $this->endSection(); ?>