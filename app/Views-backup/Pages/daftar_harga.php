			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<style>
				#datatable_wrapper {
					padding: 0;
				}
				#datatable_wrapper .row:nth-child(1), #datatable_wrapper .row:nth-child(3) {
					padding: 20px 15px;
				}
				label {
					color: #fff;
				}
				th {
				    border-bottom: none !important;
				}
				th, td {
				    color: #fff;
				    border-color: #2e5081 !important;
				}
			</style>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
			    <div class="container">
			        <div class="row justify-content-center pt-4">
			            <div class="col-lg-12">
			                <div class="mb-3">
			                    <select class="form-control" name="games">
			                        <option value="">Semua Games</option>
			                        <?php foreach($games as $loop): ?>
			                        <option value="<?= $loop['id']; ?>"><?= $loop['games']; ?></option>
			                        <?php endforeach; ?>
			                    </select>
			                </div>
			                <div class="table-responsive">
			                    <table class="table" id="datatable">
			                        <thead>
			                            <tr>
			                                <th>Games</th>
			                                <th>Produk</th>
			                                <th>Harga Publik</th>
			                                <th>Harga Silver</th>
			                                <th>Harga Gold</th>
			                                <th>Status</th>
			                                <th>Aksi</th>
			                            </tr>
			                        </thead>
			                        <tbody></tbody>
			                    </table>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<script>
				var table = $("#datatable").DataTable({
					ajax: '<?= base_url(); ?>/daftar-harga/ajax',
					pageLength: 25,
				});
				
				$("select[name=games]").on('change', function() {
				    
				    var games = $(this).val();
				    
				    table.ajax.url('<?= base_url(); ?>/daftar-harga/ajax?games=' + games).load();
				});
			</script>
			<?php $this->endSection(); ?>