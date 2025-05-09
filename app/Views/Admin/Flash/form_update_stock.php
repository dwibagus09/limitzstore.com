<?php $this->extend('Admin/template'); ?>

<?php $this->section('css'); ?>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-10">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Edit Produk</h4>
				<form action="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/flash/update-product-stock" method="POST" enctype="multipart/form-data">
				<?= csrf_field(); ?> 

					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Produk</label>
						<div class="col-md-8">
							<input type="text" class="form-control" autocomplete="off" name="product" value="<?= $products[0]['product']; ?>">
							<input type="hidden" class="form-control" autocomplete="off" name="product_id" value="<?= $products[0]['id']; ?>">
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Jml Stok</label>
						<div class="col-md-8">
							<input type="text" class="form-control" autocomplete="off" name="stock" value="<?= $products[0]['stock']; ?>">
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Jml Terjual</label>
						<div class="col-md-8">
							<input type="number" class="form-control" autocomplete="off" name="sold" value="<?= $products[0]['sold']; ?>">
						</div>
					</div>
					<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/flash" class="btn btn-warning float-start">Kembali</a>
					<div class="text-end">
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