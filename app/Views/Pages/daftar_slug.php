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
        			                </div>
                        			<div class="table-responsive">
                        				<table class="table mb-0 border-top" id="datatable">
                        				    <thead>
        			                            <tr>
        			                                <th>Provider</th>
        			                                <th>Games</th>
        			                                <th>Slug</th>
        			                                <th>Zone ID</th>
        			                                <th>Zone Name</th>
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
					ajax: '<?= base_url(); ?>/daftar-slug/ajax',
					pageLength: 25,
					ordering: false
				});
				
				/*$("select[name=source]").on('change', function() {
				    
				    var games = $(this).val();
				    table.ajax.url('<?= base_url(); ?>/daftar-slug/ajax?source=' + source).load();
				});*/

			</script>
			<?php $this->endSection(); ?>