				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Umum</h4>
						<form action="" method="POST" enctype="multipart/form-data">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Nama Website</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['name']; ?>" name="name" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Judul</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['title']; ?>" name="title" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Deskripsi</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['deskripsi']; ?>" name="deskripsi" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Logo</label>
								<div class="col-md-8">
									<img src="<?= $web['logo']; ?>" alt="" class="mb-3 rounded" width="100">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="logo">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
									<small>Ukuran 512 x 512px</small>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Logo Invoice</label>
								<div class="col-md-8">
									<img src="<?= $web['logoinvoice']; ?>" alt="" class="mb-3 rounded" width="100">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="logoinvoice">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
									<small>Ukuran 512 x 512px</small>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Favicon</label>
								<div class="col-md-8">
									<img src="<?= $web['favicon']; ?>" alt="" class="mb-3 rounded" width="100">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="favicon">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Keywords</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['keywords']; ?>" name="keywords" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Deskripsi</label>
								<div class="col-md-8">
									<textarea name="descriptiona"><?= $web['description']; ?></textarea>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Kode Store</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['kode-store']; ?>" name="kode-store" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">limit populer</label>
								<div class="col-md-8">
									<input type="number" class="form-control" value="<?= $web['limit-populer']; ?>" name="limit-populer" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">End TOP</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['end-top']; ?>" name="end-top" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">URL Footer Image</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['image_footer']; ?>" name="image_footer" autocomplete="off">
									<small>&ensp; contoh: https://client-cdn.bangjeff.com/veinstore.id/meta/Tak berjudul136_20240805165637.webp</small>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Footer</label>
								<div class="col-md-8">
									<textarea name="description_footer"><?= $web['description_footer']; ?></textarea>
								</div>
							</div>
								<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Tawkto</label>
								<div class="col-md-8">
									<textarea name="tawkto" class="form-control" rows="5"><?= $web['tawkto']; ?></textarea>
								</div>
								</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="umum">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Whitelist IP</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">IP</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $web['ip']; ?>" name="ip" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-form-label col-md-4">Google Authenticator</label>
								<div class="col-md-8">
									<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="ip">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Cloudinary</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
						<div class="mb-3 row">
							<label class="col-md-4 col-form-label ">Cloudname</label>
							<div class="col-md-8">
								<input type="text" class="form-control" value="<?= $cloudinary['cloudname']; ?>" name="cloudname" autocomplete="off">
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-md-4 col-form-label ">Api Key</label>
							<div class="col-md-8">
								<input type="text" class="form-control" value="<?= $cloudinary['key']; ?>" name="key" autocomplete="off">
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-md-4 col-form-label ">Api Secret</label>
							<div class="col-md-8">
								<input type="text" class="form-control" value="<?= $cloudinary['secret']; ?>" name="secret" autocomplete="off">
							</div>
						</div>
						<div class="text-end">
							<button class="btn " type="reset">Batal</button>
							<button class="btn btn-primary" type="submit" name="tombol" value="cloudinary">Simpan</button>
						</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Tambah/Kelola Banner</h4>
						<form action="" method="POST" enctype="multipart/form-data">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Banner</label>
								<div class="col-md-8">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile-banner" name="image">
										<label class="custom-file-label" for="customFile-banner">Choose file</label>
									</div>
									<small>Ukuran 1280 × 586px</small>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">URL Link</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="url" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">ALT Text</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="alt" value="Default Banner" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="banner">Simpan</button>
							</div>
						</form>
					</div>
					<table class="table table-striped no-border-last border-top m-0">
						<tr>
							<th>No</th>
							<th class="text-center">Banner</th>
							<th class="text-center">URL Link</th>
							<th class="text-center">ALT Text</th>
							<th class="text-center">Action</th>
						</tr>
						<?php $no = 1; foreach ($banner as $loop): ?>
						<form action="" method="POST" enctype="multipart/form-data">
						<?= csrf_field(); ?> 
						<input type="hidden" class="form-control" name="id" value="<?= $loop['id']; ?>" />
						<tr>
							<td><?= $no++; ?></td>
							<td>
								<img src="<?= $loop['image']; ?>" alt="" width="120">
								<input type="hidden" class="form-control" name="image" value="<?= $loop['image']; ?>" />
							</td>
							<td>
								<input type="text" class="form-control" name="url" value="<?= $loop['url']; ?>" />
							</td>
							<td>
								<input type="text" class="form-control" name="alt" value="<?= $loop['alt']; ?>" />
							</td>
							<td>
								<button class="btn btn-warning btn-sm" type="submit" name="tombol" value="banner">Update</button>
								<button class="btn btn-danger btn-sm" type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/konfigurasi/banner/delete/<?= $loop['id']; ?>');">Hapus</button>
							</td>
						</tr>
						</form>
						<?php endforeach ?>

						<?php if (count($banner) == 0): ?>
						<tr>
							<td colspan="3" align="center">Tidak ada banner</td>
						</tr>
						<?php endif ?>
					</table>
				</div>
				
				<!--Tambahan Bagus-->
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Tambah/Kelola Region</h4>
						<form action="" method="POST" enctype="multipart/form-data">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">URL Link</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="url" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Region</label>
								<div class="col-md-8">
									<select class="form-control" name="country" id="country">
									    <option>-- Pilih Region --</option>
                                         <option value="ID - Indonesia">ID - Indonesia</option>
                                        <option value="MY - Malaysia">MY - Malaysia</option>
                                        <option value="PH - Filipina">PH - Filipina</option>
                                        <option value="SG - Singapura">SG - Singapura</option>
                                        <option value="TH - Thailand">TH - Thailand</option>
                                        <option value="VN - Vietnam">VN - Vietnam</option>
                                        <option value="MM - Myanmar">MM - Myanmar</option>
                                        <option value="KH - Kamboja">KH - Kamboja</option>
                                        <option value="CN - China">CN - China</option>
                                        <option value="JP - Jepang">JP - Jepang</option>
                                        <option value="KR - Korea Selatan">KR - Korea Selatan</option>
                                        <option value="TW - Taiwan">TW - Taiwan</option>
                                        <option value="HK - Hong Kong">HK - Hong Kong</option>
                                        <option value="MO - Makau">MO - Makau</option>
                                        <option value="IN - India">IN - India</option>
                                        <option value="PK - Pakistan">PK - Pakistan</option>
                                        <option value="BD - Bangladesh">BD - Bangladesh</option>
                                        <option value="LK - Sri Lanka">LK - Sri Lanka</option>
                                        <option value="NP - Nepal">NP - Nepal</option>
                                        <option value="SA - Arab Saudi">SA - Arab Saudi</option>
                                        <option value="AE - Uni Emirat Arab">AE - Uni Emirat Arab</option>
                                        <option value="EG - Mesir">EG - Mesir</option>
                                        <option value="TR - Turki">TR - Turki</option>
                                        <option value="QA - Qatar">QA - Qatar</option>
                                        <option value="MA - Maroko">MA - Maroko</option>
                                        <option value="RU - Rusia">RU - Rusia</option>
                                        <option value="DE - Jerman">DE - Jerman</option>
                                        <option value="FR - Prancis">FR - Prancis</option>
                                        <option value="GB - Inggris">GB - Inggris</option>
                                        <option value="IT - Italia">IT - Italia</option>
                                        <option value="ES - Spanyol">ES - Spanyol</option>
                                        <option value="PL - Polandia">PL - Polandia</option>
                                        <option value="NL - Belanda">NL - Belanda</option>
                                        <option value="US - Amerika Serikat">US - Amerika Serikat</option>
                                        <option value="CA - Kanada">CA - Kanada</option>
                                        <option value="MX - Meksiko">MX - Meksiko</option>
                                        <option value="BR - Brasil">BR - Brasil</option>
                                        <option value="AR - Argentina">AR - Argentina</option>
                                        <option value="PE - Peru">PE - Peru</option>
                                        <option value="CL - Chile">CL - Chile</option>
                                        <option value="AU - Australia">AU - Australia</option>
                                        <option value="NZ - Selandia Baru">NZ - Selandia Baru</option>
                                    </select>

								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="region">Simpan</button>
							</div>
						</form>
					</div>
					<table class="table table-striped no-border-last border-top m-0">
						<tr>
							<th>No</th>
							<th class="text-center">URL Link</th>
							<th class="text-center">REGION Text</th>
							<th class="text-center">Action</th>
						</tr>
						<?php $no = 1; foreach ($region as $loop): ?>
						<form action="" method="POST" enctype="multipart/form-data">
						<?= csrf_field(); ?> 
						<input type="hidden" class="form-control" name="id" value="<?= $loop['id']; ?>" />
						<tr>
							<td><?= $no++; ?></td>
							<td>
								<input type="text" class="form-control" name="url" value="<?= $loop['url_link']; ?>" />
							</td>
							<td>
								<input type="text" class="form-control" name="region" value="<?= $loop['region']; ?>" />
							</td>
							<td>
								<button class="btn btn-warning btn-sm" type="submit" name="tombol" value="region">Update</button>
								<button class="btn btn-danger btn-sm" type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/konfigurasi/region/delete/<?= $loop['id']; ?>');">Hapus</button>
							</td>
						</tr>
						</form>
						<?php endforeach ?>

						<?php if (count($region) == 0): ?>
						<tr>
							<td colspan="3" align="center">Tidak ada data</td>
						</tr>
						<?php endif ?>
					</table>
				</div>
				<!--Akhir Tambahan Bagus-->
				
				<!-- Tambahan Bagus-->
					<div class="card">
					<div class="card-body">
						<h4 class="card-title">Netflazz</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
						<div class="mb-3 row">
							<label class="col-md-4 col-form-label ">Api Key</label>
							<div class="col-md-8">
								<input type="text" class="form-control" value="<?= $netflazz['netflazz_apikey']; ?>" name="netflazz_apikey" autocomplete="off">
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-md-4 col-form-label ">Secret Key</label>
							<div class="col-md-8">
								<input type="text" class="form-control" value="<?= $netflazz['netflazz_secretkey']; ?>" name="netflazz_secretkey" autocomplete="off">
							</div>
						</div>
						<div class="text-end">
							<button class="btn " type="reset">Batal</button>
							<button class="btn btn-primary" type="submit" name="tombol" value="netflazz">Simpan</button>
						</div>
						</form>
					</div>
				</div>
				<!-- End Tambahan Bagus-->
				
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Digiflazz</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Username</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $digi['user']; ?>" name="user" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Api Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $digi['key']; ?>" name="key" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Seller Api Username</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $digi['sellerusername']; ?>" name="sellerusername" autocomplete="off">
								</div>
							</div>
								<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Seller Api Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $digi['sellerkey']; ?>" name="sellerkey" autocomplete="off">
								</div>
							</div>
								<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Seller Saldo</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $digi['saldo']; ?>" name="saldo" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="digi">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Api Games</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Merchant ID</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $ag['merchant']; ?>" name="merchant" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Secret Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $ag['secret']; ?>" name="secret" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="ag">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">BangJeff</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/bangjeff</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Api Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $bj_key; ?>" name="bj_key" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="bj">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">VocaGame</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/vocagame</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Api Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $voca['key']; ?>" name="voca_key" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Secret Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $voca['secret']; ?>" name="voca_secret" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Kode Merchant</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $voca['merchant']; ?>" name="voca_merchant" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="voca">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">DuitKu</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/duitku</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Kode Merchant</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $dk['merchant']; ?>" name="dk_merchant" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Api Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $dk['key']; ?>" name="dk_key" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="dk">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Tokopay</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/tokopay</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Kode Merchant</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $tokopay['merchant']; ?>" name="tokopay_merchant" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Secret Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $tokopay['secret']; ?>" name="tokopay_secret" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="tokopay">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Tripay</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/tripay</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Api Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $tripay['key']; ?>" name="key" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Private Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $tripay['private']; ?>" name="private" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Kode Merchant</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $tripay['merchant']; ?>" name="merchant" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="tripay">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
				    <div class="card-body">
				        <h4 class="card-title">Xendit</h4>
				        <form action="" method="POST">
						<?= csrf_field(); ?> 
							<p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/xendit</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Secret Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $xendit['secret_key']; ?>" name="secret_key" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="xendit">Simpan</button>
							</div>
						</form>
				    </div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Moota</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
						    <p>Silahkan arahkan Callback ke <code><?= base_url(); ?>/sistem/callback/moota</code></p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Secret Token</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $moota_secret; ?>" name="moota_secret" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="moota">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<!-- <div class="card">
					<div class="card-body">
						<h4 class="card-title">Api Enivay</h4>
						<form action="" method="POST">
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Lisensi</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $enivay; ?>" name="enivay" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="enivay">Simpan</button>
							</div>
						</form>
					</div>
				</div> -->
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Api Hokitopup</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Api key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $hokitopup; ?>" name="hokitopup" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="hokitopup">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">MooGold</h4>
						<form action="" method="POST">
							<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Partner ID</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $moogold['partner_id']; ?>" name="partner_id" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Secret Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $moogold['secret_key']; ?>" name="secret_key" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="moogold">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">UniPin</h4>
						<form action="" method="POST">
							<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Email</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $unipin['email_up']; ?>" name="email_up" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Password</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $unipin['password_up']; ?>" name="password_up" autocomplete="off">
								</div>
							</div>
								<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">PIN</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $unipin['pin_up']; ?>" name="pin_up" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="UniPin">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Tokogar</h4>
						<form action="" method="POST">
							<?= csrf_field(); ?> 
								<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">API Key</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $api_tokogar; ?>" name="api_tokogar" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="tokogar">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Konversi Kurs Harga Produk</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Kurs MYR</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $kurs_myr; ?>" name="kurs_myr" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="kurs_myr">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Pengaturan Waktu Pembayaran</h4>
						<form action="" method="POST">
							<?= csrf_field(); ?> 
							<p>Contoh Format Durasi: <code>60*60*1</code> = 1 Jam, <code>60*60*2</code> = 2 Jam, ... <code>60*60*24</code> = 24 Jam</p>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Durasi</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $order_timer; ?>" name="order_timer" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="order_timer">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Sosial Media</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Whatsapp</label>
								<div class="col-md-8">
									<input type="url" class="form-control" value="<?= $sm['wa']; ?>" name="wa" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Instagram</label>
								<div class="col-md-8">
									<input type="url" class="form-control" value="<?= $sm['ig']; ?>" name="ig" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">YouTube</label>
								<div class="col-md-8">
									<input type="url" class="form-control" value="<?= $sm['yt']; ?>" name="yt" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Facebook</label>
								<div class="col-md-8">
									<input type="url" class="form-control" value="<?= $sm['fb']; ?>" name="fb" autocomplete="off">
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-md-4 col-form-label ">Twitter</label>
								<div class="col-md-8">
									<input type="url" class="form-control" value="<?= $sm['tw']; ?>" name="tw" autocomplete="off">
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="sm">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Popup</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
						    <div class="mb-3 row">
						        <label class="col-md-4 col-form-label ">Status</label>
								<div class="col-md-8">
								    <select class="form-control" name="popup_status">
								        <option value="On" <?= $popup['status'] == 'On' ? 'selected' : ''; ?>>On</option>
								        <option value="Off" <?= $popup['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
								    </select>
							    </div>
							</div>
							<div class="mb-3 row">
							    <label class="col-md-4 col-form-label ">Link URL</label>
								<div class="col-md-8">
									<input type="url" class="form-control"  name="popup_link_url" value="<?= $popup['link_url']; ?>" autocomplete="off" />
								</div>
							</div>
							<div class="mb-3 row">
							    <label class="col-md-4 col-form-label ">Image URL</label>
								<div class="col-md-8">
									<input type="url" class="form-control" name="popup_image_url" value="<?= $popup['image_url']; ?>" autocomplete="off" />
								</div>
							</div>
							<div class="mb-3 row">
							    <label class="col-md-4 col-form-label ">Konten (Optional)</label>
								<div class="col-md-8">
									<textarea name="popup_content"><?= $popup['content']; ?></textarea>
								</div>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="popup">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Syarat & Ketentuan</h4>
						<form action="" method="POST">
						<?= csrf_field(); ?> 
							<div class="mb-3">
								<textarea name="page_sk"><?= $page_sk; ?></textarea>
							</div>
							<div class="text-end">
								<button class="btn " type="reset">Batal</button>
								<button class="btn btn-primary" type="submit" name="tombol" value="sk">Simpan</button>
							</div>
						</form>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
					CKEDITOR.replace('descriptiona');
					CKEDITOR.replace('description_footer');
					CKEDITOR.replace('popup_content');
					CKEDITOR.replace('page_sk', {
						height: 500,
					});
				</script>
				<?php $this->endSection(); ?>