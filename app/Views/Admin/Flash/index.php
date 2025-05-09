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
						<label class="col-form-label col-md-4">Tanggal Expired</label>
						<div class="col-md-8">
						    <div class="input-group">
						        <?php $fs_date = explode(' ', $fs['date']); ?>
						        <input type="date" class="form-control left" autocomplete="off" name="fs_date" value="<?= $fs_date[0]; ?>">
								<input type="time" class="form-control right" autocomplete="off" name="fs_date_time" value="<?= $fs_date[1]; ?>">
						    </div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Status</label>
						<div class="col-md-8">
							<select name="fs_status" class="form-control">
								<option value="On" <?= $fs['status'] == 'On' ? 'selected' : ''; ?> ?>On</option>
								<option value="Off" <?= $fs['status'] == 'Off' ? 'selected' : ''; ?> ?>Off</option>
							</select>
						</div>
					</div>
					<div class="text-end mb-3">
						<button class="btn " type="reset">Batal</button>
						<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
					</div>
				</form>
				<hr />
				<div class="table-responsive">
				    <table class="table border">
				        <tr>
				            <th>Produk</th>
				            <th>Harga</th>
				            <th>Stok</th>
				            <th>Terjual</th>
				            <th>Aksi</th>
				        </tr>
				        <?php foreach ($fs['product'] as $loop): ?>
				        <tr>
				            <td><?= $loop['product']; ?></td>
				            <td>Rp <?= number_format($loop['price_cut'],0,',','.'); ?></td>
				            <td><?= $loop['stock']; ?></td>
				            <td><?= $loop['sold']; ?></td>
				            <td>
				            	<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/flash/update-product-stock/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Stok</a>
				            	<button class="btn btn-primary btn-sm" onclick="update_status(<?= $loop['id']; ?>)">off</button>
				            	<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/edit/<?= $loop['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>
				            </td>
				        </tr>
				        <?php endforeach; ?>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endSection(); ?>
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: var(--warna_2);">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Stok Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
            	
            </div>
        </div>
    </div>
</div>

<?php $this->section('js'); ?>
<<script type="text/javascript">
	function update_status(id) {
		Swal.fire({
            title: 'Konfirmasi Status Pemberhentian Produk Flash Sale',
            text: "Apakah produk ini akan di keluarkan dari produk flash sale?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: '&ensp;Ya&ensp;'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/flash/update-product-status/'+ id;
            }
        });
	}
</script>
<?php $this->endSection(); ?>	