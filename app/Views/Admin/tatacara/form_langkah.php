<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tambah Menu</h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
                                <div class="mb-3 row">
										<label class="col-form-label col-md-4">Category</label>
										<div class="col-md-8">
											<select name="category" class="form-control">
                                                <?php foreach ($category as $loop): ?>
                                                    <option value="<?= $loop['id']; ?>" <?php if(isset($edit["category"]) && $edit["category"] ==  $loop['id']) { echo 'selected'; } else { echo ''; } ?>><?= $loop['nama']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">sort</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="sort" value="<?=isset($edit["sort"]) ? set_value("sort", $edit["sort"]): set_value("sort"); ?>">
										</div>
									</div>
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-4">Title</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="title" value="<?=isset($edit["title"]) ? set_value("title", $edit["title"]): set_value("title"); ?>">
										</div>
									</div>
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-4">Deskripsi</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" name="deskripsi" value="<?=isset($edit["deskripsi"]) ? set_value("deskripsi", $edit["deskripsi"]): set_value("deskripsi"); ?>">
										</div>
									</div>
									<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara" class="btn btn-warning float-start">Kembali</a>
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
				<?php $this->endSection(); ?>