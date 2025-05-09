				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<style>
                .dataTables_wrapper .dataTables_paginate .paginate_button {
                    color: #fff !important; 
                    background-color: var(--warna_3) !important;
                    border-color:var(--warna_3) !important; 
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                    color: #fff !important; 
                    background-color: var(--warna_3) !important; 
                    border-color: var(--warna_3) !important; 
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
                    color: #fff !important; 
                    background-color: var(--warna_3) !important; 
                    border-color: var(--warna_3) !important; 
                }
                 .dataTables_wrapper .dataTables_paginate .paginate_button.not(.current) {
                    color: #fff !important;
                    background-color: var(--warna_3) !important; 
                    border-color: var(--warna_3) !important; 
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current) {
                    color: #fff !important;
                    background-color: var(--warna_3) !important; 
                    border-color: var(--warna_3) !important; 
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                    color: #fff !important;
                    background-color: var(--warna_3) !important; 
                    border-color: var(--warna_3) !important; 
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
                    color: #000 !important;
                    background-color: var(--warna_3) !important;
                    border-color: var(--warna_3) !important;
                }
                .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover,
                .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):focus {
                    color: #fff !important;
                    background-color: var(--warna_3) !important;
                    border-color: var(--warna_3) !important;
                }
            </style>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<form action="<?= base_url('-9J6DWAuK/]:C2Tx1/pesanan/checked/delete') ?>" method="post" id="delete-form">
				<?= csrf_field(); ?> 
				<input type="hidden" name="action" value="order_history" />
				<div class="card">
					<div class="card-body">
						<h4 class="card-title"><?= $title ?></h4>
						<b class="d-block mb-1">Keterangan Status</b>
						<ul class="mb-0 pl-4 mb-4">
							<li><b>Pending</b> : Pesanan belum dibayar / menunggu pembayaran</li>
							<li><b>Processing</b> : Pesanan dalam proses oleh provider / manual</li>
							<li><b>Success</b> : Pesanan telah berhasil diproses</li>
							<li><b>Canceled</b> : Pesanan gagal diproses</li>
							<li><b>Expired</b> : Pesanan gagal / expired</li>
						</ul>
						<button type="button" class="btn btn-primary btn-sm" id="delete-button">Hapus Pesanan Checked</button>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/export" class="btn btn-primary btn-sm">Export Data Pesanan</a>
						<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/refund" class="btn btn-primary btn-sm" target="_blank">Logs Data Refund</a>
					</div>
					<div class="table-responsive">
						<table class="mb-0 no-border-last table table-striped" id="mytables">
						<thead>
							<tr>
								<th width="50"><input type="checkbox" id="checkAll" /></th>
								<th>No</th>
								<th>No Transaksi</th>
								<th>Produk</th>
								<th>Metode</th>
								<th>Provider</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						</table>
					</div>
				</div>
				</form>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content" style="background: var(--warna_2);">
				            <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body p-0">
				            	
				            </div>
				        </div>
				    </div>
				</div>
				<div class="modal fade" id="modal-detail-retrieve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCheck" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content" style="background: var(--warna_2);">
				            <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabelCheck">Hasil Checking</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body p-0">
				            	
				            </div>
				        </div>
				    </div>
				</div>
				<script>
					// set orderable "false" menghilangkan fungsi pengurutan pada kolom pertama
					$("#mytables").DataTable({
				    	ajax: {
						  url: "<?= base_url(); ?>/admin/pesanan/ajax-load-history",
						  type:'POST'
						},
						processing: true,
						serverSide: true,
						searching: true,
						order: [],
						lengthMenu: [ [25, 50, 100, 500, 1000], [25, 50, 100, 500, 1000] ],
						"columnDefs": 
						[ { "orderable": false, "targets": 0 } ]
					});

					$(document).ready(function() {
						// When the checkAll checkbox is clicked
						$('#checkAll').click(function(){
							$('.item-checkbox').prop('checked', this.checked);
						});

						$('#delete-button').click(function(){
							var deleteIds = [];
							$(".item-checkbox").each(function() {
								if ($(this).prop('checked')==true){ 
						    		deleteIds.push($(this).val());
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

					$(document).on('click','.item-checkbox', function(event){
						// When any item-checkbox checkbox is clicked
						if (!this.checked) {
							$('#checkAll').prop('checked', false);
						}
					});

					function detail(order_id) {
						$.ajax({
							url: '<?= base_url(); ?>/admin/pesanan/detail/' + order_id,
							success: function(result) {
								$("#modal-detail div div .modal-body").html(result);

								$("#modal-detail").modal('show');
							}
						});
					}

					function check(order_id) {
						$.ajax({
							url: '<?= base_url(); ?>/admin/pesanan/check/' + order_id,
							success: function(result) {
								$("#modal-detail-retrieve div div .modal-body").html(result);

								$("#modal-detail-retrieve").modal('show');
							}
						});
					}
					
					function update_status(order_id) {
						Swal.fire({
							title: 'Konfirmasi Update',
							text: 'Update status "Success" no pesanan "'+ order_id +'" ini?',
							icon: 'warning',
							showCancelButton: true,
							confirmButtonText: 'Ya, Update!',
							cancelButtonText: 'Batal'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/update-status/"+order_id;
							}
						});
					}

					function reorder(order_id) {
						Swal.fire({
							title: 'Konfirmasi Order',
							text: 'Re-order no pesanan "'+ order_id +'" ini?',
							icon: 'warning',
							showCancelButton: true,
							confirmButtonText: 'Ya, Lanjut!',
							cancelButtonText: 'Batal'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/reorder/"+order_id;
							}
						});
					}
				</script>
				<?php $this->endSection(); ?>