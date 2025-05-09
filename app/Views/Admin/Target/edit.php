			<?php $this->extend('Admin/template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?= $title; ?></h4>
					<form action="" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?> 
						<div class="row mb-3">
                            <label class="col-md-4 col-form-label">Judul Target</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" autocomplete="off" name="target" value="<?= $target['target']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Teks Header</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" autocomplete="off" name="text" value="<?= $target['text']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Deskripsi / Petunjuk</label>
                            <div class="col-md-8">
                                <textarea name="description" cols="30" rows="4" class="form-control"><?= $target['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">URL Gambar Petunjuk</label>
                            <div class="col-md-8">
                                <input type="text" name="img" cols="30" rows="4" class="form-control" value="<?= $target['img_petunjuk']; ?>">
                            </div>
                        </div>
                        <h6 class="mb-3">Manajemen Target</h6>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Sparator</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" autocomplete="off" name="sparator" value="<?= $target['sparator']; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" onclick="kolom_add();">Tambah</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-4">
                                <tr>
                                    <th width="160">Tipe</th>
                                    <th>Data</th>
                                    <th width="10">Action</th>
                                </tr>
                                <tbody id="kolom">
                                    <?php 
                                        $col = json_decode($target['col'], true);
                                        if (!$col) {
                                            echo 'Sistem target error, silahkan buat baru';
                                            header("location:". base_url() . "/-9J6DWAuK/]:C2Tx1/target");
                                        } else {
                                            if (!is_array($col)) {
                                                echo 'Sistem target error, silahkan buat baru';
                                                header("location:". base_url() . "/-9J6DWAuK/]:C2Tx1/target");
                                            } else {
                                        foreach($col as $loop): 
                                            $id = rand(000000,999999);
                                        ?>
                                        <tr id="tr-<?= $id; ?>">
                                            <td>
                                                <select name="col_type[<?= $id; ?>]" class="form-control mb-0" onchange="load_data('<?= $id; ?>', this.value);">
                                                    <option value="input" <?= $loop['col_type'] == 'input' ? 'selected' : ''; ?>>Input</option>
                                                    <option value="select" <?= $loop['col_type'] == 'select' ? 'selected' : ''; ?>>Select</option>
                                                </select>
                                            </td>
                                            <td id="data-<?= $id; ?>">
                                                <?php if ($loop['col_type'] == 'input'): ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="title[<?= $id; ?>]" placeholder="Judul" value="<?= $loop['title']; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="type[<?= $id; ?>]">
                                                            <option value="text" <?= $loop['type'] == 'text' ? 'selected' : ''; ?>>Teks</option>
                                                            <option value="number" <?= $loop['type'] == 'number' ? 'selected' : ''; ?>>Angka Only</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="title[<?= $id; ?>]" placeholder="Judul" value="<?= $loop['title']; ?>">
                                                </div>
                                                <textarea cols="30" rows="4" class="form-control" name="option[<?= $id; ?>]"><?= $loop['option']; ?></textarea>
                                                <smal class="text-muted">
                                                    <b class="d-block mt-3 mb-2">Informasi</b>
                                                    <p class="text-muted">Pisahkan tiap pilihan dengan Enter <br> dan pisahkan antara teks dan nilai dengan |, contoh :</p>
                                                    <p class="text-muted mb-0">os_asia|Asia</p>
                                                    <p class="text-muted mb-0">os_euro|Euro</p>
                                                </smal>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" type="button" onclick="kolom_delete('<?= $id; ?>');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach;
                                         }
                                        }
                                         ?>
                                </tbody>
                            </table>
                        </div>
                         <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Alert Error</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" autocomplete="off" name="error" value="<?= $target['error']; ?>">
                            </div>
                        </div>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/target" class="btn btn-warning  float-start">Kembali</a>
						<div class="text-end">
							<button class="btn" type="reset">Batal</button>
							<button class="btn btn-primary " type="submit" name="tombol" value="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<script>
                function random_str(length) {
                    let result = '';
                    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    const charactersLength = characters.length;
                    let counter = 0;
                    while (counter < length) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                        counter += 1;
                    }
                    return result;
                }

                function kolom_add() {

                    var id = random_str(12);
                    var on_load = "'" +id+ "'";

                    $("#kolom").append('<tr id="tr-'+id+'">\
                        <td>\
                            <select name="col_type['+id+']" class="form-control mb-0" onchange="load_data('+on_load+', this.value);">\
                                <option value="input">Input</option>\
                                <option value="select">Select</option>\
                            </select>\
                        </td>\
                        <td id="data-'+id+'">\
                            \
                        </td>\
                        <td>\
                            <button class="btn btn-danger btn-sm" type="button" onclick="kolom_delete('+on_load+');">\
                                <i class="fa fa-trash"></i>\
                            </button>\
                        </td>\
                    </tr>');

                    load_data(id, 'input');
                }

                function load_data(id, type) {

                    if (type == 'input') {
                        var data_td = '<div class="row">\
                            <div class="col-md-6">\
                                <input type="text" class="form-control" name="title['+id+']" placeholder="Judul">\
                            </div>\
                            <div class="col-md-6">\
                                <select class="form-control" name="type['+id+']">\
                                    <option value="text">Teks</option>\
                                    <option value="number">Angka Only</option>\
                                </select>\
                            </div>\
                        </div>';
                    } else {
                        var data_td = '<div class="mb-3"><input type="text" class="form-control" name="title['+id+']" placeholder="Judul"></div><textarea cols="30" rows="4" class="form-control" name="option['+id+']"></textarea>\
                        <smal class="text-muted">\
                            <b class="d-block mt-3 mb-2">Informasi</b>\
                            <p class="text-muted">Pisahkan tiap pilihan dengan Enter <br> dan pisahkan antara teks dan nilai dengan |, contoh :</p>\
                            <p class="text-muted mb-0">os_asia|Asia</p>\
                            <p class="text-muted mb-0">os_euro|Euro</p>\
                        </smal>';
                    }

                    $("#data-" + id).html(data_td);
                }

                function kolom_delete(id) {
                    $("#tr-" + id).remove();
                }

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                });
            </script>
			<?php $this->endSection(); ?>