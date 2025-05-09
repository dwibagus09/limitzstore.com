				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				 <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">-->
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
				<form action="<?= base_url('-9J6DWAuK/]:C2Tx1/produk/checked/delete') ?>" method="post" id="delete-form">
				<?= csrf_field(); ?> 
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Produk</h4>
						<div class="mb-3">
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/add" class="btn btn-primary btn-sm">Tambah Produk</a>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/excel" class="btn btn-primary btn-sm">Import / Export</a>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/category" class="btn btn-primary btn-sm">Kategori</a>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/update" class="btn btn-primary btn-sm">Update Harga</a>
							<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/update-harga" class="btn btn-primary btn-sm">Update Harga Percent</a>
							<button type="button" class="btn btn-primary btn-sm" id="delete-button">Hapus Product Checked</button>
						</div>
						<div class="row">
						    <div class="col-md-4">
						        <select class="form-control" onchange="window.location.href = '?games_id=' + this.value">
						            <?php foreach ($games as $loop): ?>
						            <option value="<?= $loop['id']; ?>" <?= $loop['id'] == $games_id ? 'selected' : ''; ?>><?= $loop['games']; ?></option>
						            <?php endforeach; ?>
						        </select>
						    </div>
						</div>
					</div>
					<div class="table-responsive" style="overflow-x: auto;">
						<table class="table-white table table-striped border-top">
						    <thead>
						        <tr>
								<th width="50"><input type="checkbox" class="item-checkbox" id="checkAll"></th>
									<th width="10">No</th>
									<th>Id Product</th>
									<th>Games</th>
									<th>Produk</th>
									<th>Kategori</th>
									<th>Koin</th>
									<th>Harga Modal</th>
									<th>Harga <del>Coret</del></th>
									<th>Harga Publik</th>
									<th>Harga Silver</th>
									<th>Harga Gold</th>
									<th>Harga Bisnis</th>
									<th>Provider</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
						    </thead>
							<tbody id="sortable">
								<?php $no = 1; foreach ($product as $loop): ?>
								<tr id="<?= $loop['id']; ?>">
									<td><input type="checkbox" class="item-checkbox" name="delete[]" value="<?= $loop['id'] ?>"></td>
									<td><?= $no++; ?></td>
									<td><span class="badge bg-primary"><?= $loop['id']; ?></span></td>
									<td><?= $loop['games']; ?></td>
									<td><?= $loop['product']; ?></td>
									<td><?= $loop['category']; ?></td>
									<td><?= number_format($loop['coin'],0,',','.'); ?> <i class="fa fa-bitcoin"></i></td>
									<td>Rp <?= number_format($loop['price_modal'],0,',','.'); ?></td>
									<td>Rp <?= number_format($loop['price_cut'],0,',','.'); ?></td>
									<td>Rp <?= number_format($loop['price'],0,',','.'); ?></td>
									<td>Rp <?= number_format($loop['price_silver'],0,',','.'); ?></td>
									<td>Rp <?= number_format($loop['price_gold'],0,',','.'); ?></td>
									<td>Rp <?= number_format($loop['price_bisnis'],0,',','.'); ?></td>
									<td><?= $loop['provider']; ?> - <?= $loop['sku']; ?></td>
									<td><div class="form-check form-switch">
									<input class="form-check-input status-switch" type="checkbox" role="switch" data-id="<?= $loop['id']; ?>" <?php if ($loop['status'] == 'On') { echo 'checked'; } ?> style="width:3em !important; height: 1.5em !important;">
									</div></td>
									<td width="10" nowrap>
									    <?php if($loop['category_id'] == "4"): ?>
									    <a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/voucher/<?= $loop['id']; ?>" class="btn btn-success btn-sm">Kelola Voucher</a>
									    <?php endif; ?>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode/price/<?= $loop['id']; ?>" class="btn btn-success btn-sm d-none">Kostum Harga</a>
										<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
										<button type="button" onclick="hapus('<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">Hapus</button>
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
				<!--<script src="<?= base_url(); ?>/assets/js/jquery.ui.touch-punch.min.js"></script>-->
				<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <!--            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>-->
			<script>
				$(document).ready(function() {
					$('.status-switch').change(function() {
						if ($(this).prop('checked')) {
							var datastatus = 'On';
						} else {
							var datastatus = 'Off';
						}

						var id = $(this).data('id');

						console.log(id);
						console.log(datastatus);

						$.ajax({
								url: '<?= base_url('/admin/produk/update-ajax') ?>/' + id,
								method: 'POST',
								data: {
									status: datastatus
								},
								success: function(response) {
									if(response.success == true) {
										Swal.fire({
											icon: 'success',
											title: 'Success',
											text: 'Status Berhasil dirubah'
										});
									} else {
										Swal.fire({
											icon: 'error',
											title: 'Error',
											text: 'Status Gagal dirubah'
										});
									}
								},
							});
					});
				});
			</script>
				<script>
				document.addEventListener('DOMContentLoaded', function() {
					var deleteButton = document.getElementById('delete-button');
					var checkboxes = document.querySelectorAll('.item-checkbox');
					deleteButton.addEventListener('click', function() {
						var deleteIds = [];
						checkboxes.forEach(function(checkbox) {
							if (checkbox.checked) {
								deleteIds.push(checkbox.value);
							}
						});
						if (deleteIds.length === 0) {
							alert('Pilih setidaknya satu item untuk dihapus.');
						} else {
							Swal.fire({
								title: 'Anda yakin?',
								text: 'Data akan dihapus permanen',
								icon: 'warning',
								showCancelButton: true,
								confirmButtonText: 'Ya, Hapus!',
								cancelButtonText: 'Batal'
							}).then((result) => {
								if (result.isConfirmed) {
									document.getElementById('delete-form').submit();
								}
							});
						}
					});
				});
				
					$(document).ready(function() {
						// When the checkAll checkbox is clicked
						$('#checkAll').click(function(){
							console.log('checked all');
							$('.item-checkbox').prop('checked', this.checked);
						});
						
						// When any item-checkbox checkbox is clicked
						$('.item-checkbox').click(function() {
							console.log('checked 1');
							if (!this.checked) {
								$('#checkAll').prop('checked', false);
							}
						});
					});
				</script>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
					var editButton = document.getElementById('edit-button');
					var checkboxes = document.querySelectorAll('.item-checkbox');
					
					editButton.addEventListener('click', function() {
						var selectedItems = [];

						checkboxes.forEach(function(checkbox) {
							if (checkbox.checked) {
								var itemId = checkbox.value;
								var itemUrl = '<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk/edit/' + itemId;
								selectedItems.push(itemUrl);
							}
						});

						selectedItems.forEach(function(url, index) {
							setTimeout(function() {
								window.open(url, '_blank');
							}, index * 1000);
						});
					});
				});
				</script>
				<script>
				    // function touchHandler(event) {
        //                 var touch = event.changedTouches[0];
                    
        //                 var simulatedEvent = document.createEvent("MouseEvent");
        //                     simulatedEvent.initMouseEvent({
        //                     touchstart: "mousedown",
        //                     touchmove: "mousemove",
        //                     touchend: "mouseup"
        //                 }[event.type], true, true, window, 1,
        //                     touch.screenX, touch.screenY,
        //                     touch.clientX, touch.clientY, false,
        //                     false, false, false, 0, null);
                    
        //                 touch.target.dispatchEvent(simulatedEvent);
        //                 event.preventDefault();
        //             }
                    
        //             function init() {
        //                 document.addEventListener("touchstart", touchHandler, true);
        //                 document.addEventListener("touchmove", touchHandler, true);
        //                 document.addEventListener("touchend", touchHandler, true);
        //                 document.addEventListener("touchcancel", touchHandler, true);
        //             }
                    
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