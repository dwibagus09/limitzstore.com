				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title"><?= $title; ?></h4>
								<ul>
								    <li><b>Import</b> : Aksi ini digunakan untuk menambahkan atau menganti data produk sesuai isi dari file excel, yang akan mengganti data sesuai kode produk jika kode produk sudah ada</li>
								    <li><b>Export</b> : Aksi ini digunakan untuk mendapatkan data produk berdasarkan games tertentu / semua produk</li>
								</ul>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Aksi</label>
										<div class="col-md-8">
											<select name="action" class="form-control">
												<option value="Import">Import</option>
												<option value="Export">Export</option>
											</select>
										</div>
									</div>
									<div id="div-export" class="d-none">
									    <div class="mb-3 row">
    										<label class="col-form-label col-md-4">Produk dari games</label>
    										<div class="col-md-8">
    											<select name="games_id" class="form-control">
    												<option value="all">Semua Produk</option>
    												<?php foreach ($games as $loop): ?>
    												<option value="<?= $loop['id']; ?>"><?= $loop['games']; ?> - <?= $loop['total_product']; ?> Produk</option>
    												<?php endforeach; ?>
    											</select>
    										</div>
    									</div>
									</div>
									<div id="div-import">
    									<div class="mb-3 row">
    										<label class="col-form-label col-md-4">File</label>
    										<div class="col-md-8">
    											<input type="file" class="form-control" autocomplete="off" name="file">
    											<small class="d-block mt-1">Silahkan upload file Excel dengan format .xlsx, download file contoh <a href="<?= base_url(); ?>/example-import.xlsx">disini</a></small>
    										</div>
    									</div>
    								</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Google Authenticator</label>
										<div class="col-md-8">
											<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk" class="btn btn-warning float-start">Kembali</a>
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
				    $("select[name=action]").on('change', function() {
				        
				        if ($(this).val() == 'Import') {
				            $("#div-export").addClass('d-none');
				            $("#div-import").removeClass('d-none');
				        } else {
				            $("#div-export").removeClass('d-none');
				            $("#div-import").addClass('d-none');
				        }
				    });
				</script>
				<?php $this->endSection(); ?>