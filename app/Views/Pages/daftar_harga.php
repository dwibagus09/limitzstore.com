			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="eniv-content">
                <div class="container">
            		<div class="eniv-body">
                        <div class="row justify-content-center">
                        	<div class="col-md-12">
                        		<div class="card">
                                    <div class="card-body pb-0">
                                        <h1 class="card-title"><?= $title; ?></h1>
        			                    <select class="form-control mb-3" name="games">
        			                        <option value="">Semua Games</option>
        			                        <?php foreach($games as $loop): ?>
        			                        <option value="<?= $loop['id']; ?>"><?= $loop['games']; ?></option>
        			                        <?php endforeach; ?>
        			                    </select>
        			                </div>
                        			<div class="table-responsive">
                        				<table class="table mb-0 border-top" id="datatable">
                        				    <thead>
        			                            <tr>
        			                                <th>Games</th>
        			                                <th>Produk</th>
        			                                <th>Harga Publik</th>
        			                                <th>Harga Silver</th>
        			                                <th>Harga Gold</th>
													<th>Harga Bisnis</th>
        			                                <th>Status</th>
        			                                <th>Aksi</th>
        			                            </tr>
        			                        </thead>
        			                        <tbody>
        			                            
        			                        </tbody>
        			                    </table>
            			             </div>
                        		</div>
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
					ordering: false
				});
				
				$("select[name=games]").on('change', function() {
				    
				    var games = $(this).val();
				    
				    table.ajax.url('<?= base_url(); ?>/daftar-harga/ajax?games=' + games).load();
				});
			</script>
			<?php $this->endSection(); ?>