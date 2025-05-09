				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<style>
				    input.form-control-color {
                        background: none !important;
                        border: none !important;
                        width: 46px;
                        height: 46px;
                    }
                    th[valign="middle"] {
                        vertical-align: middle;
                    }
				</style>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Tema Website</h4>
								<form action="" method="POST" enctype="multipart/form-data">
								<?= csrf_field(); ?> 
								    <div class="row">
								        <div class="col-md-6">
								            <div class="table-responsive">
        								        <table class="table border">
        								            <?php foreach ($tema as $loop => $key): ?>
        								            <tr>
        								                <th valign="middle"><?= ucfirst(str_replace('_', ' ', $loop)); ?></th>
        								                <td width="10">
        								                    <input type="color" class="form-control-color" autocomplete="off" name="tema_<?= $loop; ?>" value="<?= $key; ?>">
        								                </td>
        								            </tr>
        								            <?php endforeach; ?>
        								        </table>
        								    </div>
								        </div>
								        <div class="col-md-6">
								            <div class="mb-3 row">
								                <label class="col-form-label col-md-4">Gambar Background Home</label>
								                <div class="col-md-8">
								                    <img src="<?= base_url(); ?>/assets/images/<?= $tema['hero']; ?>" class="d-block mb-3" width="120">
								                    <input type="file" class="form-control" name="tema_image_hero">
								                    <small class="text-muted d-block mt-2">Gunakan ukuran 1920 × 700 px</small>
								                </div>
								            </div>
								            <div class="mb-3 row">
								                <label class="col-form-label col-md-4">Gambar Sidebar</label>
								                <div class="col-md-8">
								                    <img src="<?= base_url(); ?>/assets/images/<?= $tema['sidebar']; ?>" class="d-block mb-3" width="120">
								                    <input type="file" class="form-control" name="tema_image_sidebar">
								                    <small class="text-muted d-block mt-2">Gunakan ukuran 326 × 447 px</small>
								                </div>
								            </div>
								        </div>
								    </div>
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