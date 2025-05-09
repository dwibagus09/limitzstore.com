<?php $this->extend('Admin/template'); ?>

<?php $this->section('css'); ?>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-10">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?= $title; ?></h4>
				<form action="" method="POST" enctype="multipart/form-data">
				    <?= csrf_field(); ?> 
					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Kode Voucher</label>
						<div class="col-md-8">
							<input type="text" class="form-control" autocomplete="off" name="kode_voucher">
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
    CKEDITOR.replace('content');
</script>
<?php $this->endSection(); ?>