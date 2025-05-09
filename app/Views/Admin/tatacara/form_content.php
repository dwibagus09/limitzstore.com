<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tambah Menu</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
                                <div class="mb-3 row">
										<label class="col-form-label col-md-4">List Langkah - Langkah</label>
										<div class="col-md-8">
											<select name="langkah" class="form-control">
                                                <?php foreach ($langkah as $loop): ?>
                                                    <option value="<?= $loop['id']; ?>" <?php if(isset($edit["langkah"]) && $edit["langkah"] ==  $loop['id']) { echo 'selected'; } else { echo ''; } ?>><?= $loop['title']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
										</div>
									</div>
                                    <div class="mb-3 row">
										<label class="col-form-label col-md-4">Type</label>
										<div class="col-md-8">
											<select name="type" class="form-control">
                                                    <option value="text" <?php if(isset($edit["type"]) && $edit["type"] ==  'text') { echo 'selected'; } else { echo ''; } ?>>Text</option>
                                                    <option value="image" <?php if(isset($edit["type"]) && $edit["type"] ==  'image') { echo 'selected'; } else { echo ''; } ?>>Image</option>
                                            </select>
										</div>
									</div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label ">Isi By Image</label>
                                        <div class="col-md-8">
                                            <img src="<?= base_url(); ?>/assets/images/tatacara/<?php if(isset($edit["type"]) && $edit["type"] ==  'image') { echo $edit["isi"]; } else { echo ''; } ?>" alt="" class="mb-3 rounded img-fluid">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label ">Isi by Text</label>
                                        <div class="col-md-8">
                                            <textarea name="isi"><?php if(isset($edit["type"]) && $edit["type"] ==  'text') { echo $edit["isi"]; } else { echo ''; } ?></textarea>
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
                <script>
					CKEDITOR.replace('isi');
				</script>
				<?php $this->endSection(); ?>