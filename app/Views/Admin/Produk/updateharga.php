				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="eniv-content">
					<div class="container">
						<div class="eniv-body">
								
							<?= $this->include('header-admin'); ?>

							<div class="row justify-content-center">
								<div class="col-md-10">
									<div class="card">
										<div class="card-body">
											<h5 class="mb-3">Update Harga - By Percent and Modal</h5>

											<?= alert(); ?>

											<form action="" method="POST" enctype="multipart/form-data">
											<?= csrf_field(); ?> 
												<div class="mb-3 row">
													<label class="col-form-label col-md-4">Games</label>
													<div class="col-md-8">
													    <select class="form-control" name="games" id="selectOptionGames">
													        <?php foreach($games as $loop): ?>
													        <option value="<?= $loop['id']; ?>"><?= $loop['games']; ?></option>
													        <?php endforeach; ?>
													    </select>
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-form-label col-md-4">Profit</label>
													<div class="col-md-8">
														<input type="text" class="form-control" autocomplete="off" name="profit" id="profit">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-form-label col-md-4">Profit Silver</label>
													<div class="col-md-8">
														<input type="text" class="form-control" autocomplete="off" name="profit_silver" id="profit_silver">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-form-label col-md-4">Profit Gold</label>
													<div class="col-md-8">
														<input type="text" class="form-control" autocomplete="off" name="profit_gold" id="profit_gold">
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-form-label col-md-4">Profit Bisnis</label>
													<div class="col-md-8">
														<input type="text" class="form-control" autocomplete="off" name="profit_bisnis" id="profit_bisnis">
													</div>
												</div>
												<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk" class="btn btn-warning float-left">Kembali</a>
												<div class="text-end">
													<button class="btn " type="reset">Batal</button>
													<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
												</div>
											</form>
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
				$(document).ready(function(){
				    $('#selectOptionGames').change(function(){
				        var selectedOption = $(this).val();
				        if(selectedOption != ''){
				            $.ajax({
				                url: '<?= base_url('/admin/produk/ajax-load-profit-setting') ?>', 
				                type: 'POST', 
				                data: {games: selectedOption},
				                success: function(response){
				                    $('#profit').val(response.data.profit);
				                    $('#profit_silver').val(response.data.profit_silver);
				                    $('#profit_gold').val(response.data.profit_gold);
				                    $('#profit_bisnis').val(response.data.profit_bisnis);
				                },
				                error: function(xhr, status, error){
				                    console.error(error);
				                }
				            });
				        } else {
		            		$('#profit').val('');
		                    $('#profit_silver').val('');
		                    $('#profit_gold').val('');
		                    $('#profit_bisnis').val('');
		        		}
				    });
				});
				</script>
				<?php $this->endSection(); ?>