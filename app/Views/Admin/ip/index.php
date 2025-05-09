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
						<h4 class="card-title">DATA IP ADDRESS</h4>
					</div>
					<div class="table-responsive">
						<table class="mb-0 no-border-last table table-striped" id="mytables">
						<thead>
							<tr>
								<th>No</th>
								<th>Order ID</th>
								<th>User ID</th>
								<th>IP</th>
								<th>DATE TIME</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($ip as $loop): ?>
							<tr>
								<td><?= $no++; ?></td>
                                <td><?= $loop['order_id']; ?></td>
								<td><?= $loop['user_id']; ?></td>
								<td><?= $loop['ip']; ?></td>
								<td><?= $loop['datetime']; ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
						</table>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
					$("#mytables").DataTable({
					lengthMenu: [ [50, 100, 500, 1000], [50, 100, 500, 1000] ],
					});
				</script>
				<?php $this->endSection(); ?>