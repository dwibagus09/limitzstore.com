<?php $this->extend('Admin/template'); ?>

<?php $this->section('css'); ?>
 <style>
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1; /* Warna track */
          }
          .table-responsive::-webkit-scrollbar-thumb {
            background: #888; /* Warna scrollbar itu sendiri */
          }
          .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #555; /* Warna scrollbar saat dihover */
          }
        @media (max-width: 768px) {
          .table-responsive::-webkit-scrollbar {
            height: 15px;
            width: 15px;
            border-radius: 5px;
          }
          .table-responsive {
              overflow-y: auto;
          }
        }
 </style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<form action="" method="post" id="delete-form">
<?= csrf_field(); ?> 
<div class="card">
	<div class="card-body">
		<h4 class="card-title">Produk Voucher: <?= $product[0]['product']; ?></h4>
		<div class="mb-3">
			<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher/add" class="btn btn-primary btn-sm">Tambah</a>
			<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher/import" class="btn btn-primary btn-sm">Import</a>
			<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher/export" class="btn btn-primary btn-sm">Export</a>
		</div>
	</div>
	<div class="table-responsive" style="overflow-x: auto;">
		<table class="table-white table table-striped border-top">
		    <thead>
		        <tr>
					<th width="10">No</th>
					<th>Kode Voucher</th>
					<th>Status</th>
					<th style="text-align:center;">Action</th>
				</tr>
		    </thead>
			<tbody id="sortable">
				<?php $no = 1; foreach ($voucher as $loop): ?>
				<tr id="">
					<td><?= $no++; ?></td>
					<td><?= $loop['kode_voucher']; ?></td>
					<td><?php if($loop['is_sold'] == "1"){ echo "<span class='badge bg-danger'>sold</span>"; }else{ echo "<span class='badge bg-success'>available</span>"; }  ?></td>
					<td align="center">
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
						<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
</form>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $("#sortable").sortable({
        stop: function() {
            var ids = '';
            $("#sortable tr").each(function() {
                
                id = $(this).attr('id');
                if (ids == '') {
                    ids = id;
                } else {
                    ids = ids + ',' + id;
                }
            });
            
            $.ajax({
                url: '<?= base_url(); ?>/admin/produk/sort',
                type: 'POST',
                dataType: 'html',
                data: 'id=' + ids,
                success: function(result) {
                    
                }
            });
        }
    });
</script>
<?php $this->endSection(); ?>