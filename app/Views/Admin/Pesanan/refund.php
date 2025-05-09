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
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Log Refund Saldo Akun</h4>
					</div>
					<div class="table-responsive">
						<table class="mb-0 no-border-last table table-striped" id="mytables">
						<thead>
							<tr>
								<th>No</th>
								<th>Tgl Proses</th>
								<th>No Invoice</th>
								<th>Nominal Refund</th>>
							</tr>
						</thead>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
					// set orderable "false" menghilangkan fungsi pengurutan pada kolom pertama
					$("#mytables").DataTable({
				    	ajax: {
						  url: "<?= base_url(); ?>/admin/pesanan/ajax-load-refund",
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
				</script>
				<?php $this->endSection(); ?>