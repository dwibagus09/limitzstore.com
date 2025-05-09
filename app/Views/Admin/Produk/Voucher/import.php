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
				    <li>Pastikan Anda mengimport product voucher pada product yang sesuai.</li>
				    <li>Pastikan jangan membuka tab form import lebih dari satu halaman. Sistem akan secara otomatis memasukan voucher sesuai akses produk yang telah dipilih.</li>
				</ul>
				<form action="" method="POST" enctype="multipart/form-data">
				    <?= csrf_field(); ?>
					<div id="div-import">
						<div class="mb-3 row">
							<label class="col-form-label col-md-4">File</label>
							<div class="col-md-8">
							    <input type="hidden" class="form-control" name="product_id" value="<?= $product_id; ?>">
								<input type="file" class="form-control" autocomplete="off" name="file">
								<small class="d-block mt-1">Silahkan upload file Excel dengan format .xlsx, download file contoh <a href="<?= base_url(); ?>/example-import-product-voucher.xlsx">disini</a></small>
							</div>
						</div>
					</div>
				
					<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher" class="btn btn-warning float-start">Kembali</a>
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