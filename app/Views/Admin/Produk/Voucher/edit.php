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
							<input type="text" class="form-control" autocomplete="off" name="kode_voucher" value="<?= $voucher['kode_voucher']; ?>">
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Status Terjual</label>
						<div class="col-md-8">
							<select name="is_sold" class="form-control">
							    <option value="0" <?= $voucher['is_sold'] == '0' ? 'selected' : ''; ?>>Tidak</option>
								<option value="1" <?= $voucher['is_sold'] == '1' ? 'selected' : ''; ?>>Ya</option>
							</select>
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
document.getElementById('googleauth').addEventListener('input', function () {
this.value = this.value.replace(/[^0-9]/g, ''); // Hanya membiarkan karakter angka
if (this.value.length > 6) {
	this.value = this.value.slice(0, 6); // Membatasi panjang masukan menjadi 6 digit
}
});
</script>
<script>
    CKEDITOR.replace('content');
</script>
<?php $this->endSection(); ?>