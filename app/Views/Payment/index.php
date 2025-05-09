			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="eniv-content">
                <div class="container">
            		<div class="eniv-body">
    		        	<div class="row justify-content-center">
    		        		<div class="col-md-10">
    		        			<div class="card">
    		            			<div class="card-body eniv-card">
    		            				<p class="fw-600 mb-3 fs-16">Cek Pesanan</p>
    		            				<form role="form" class="mb-3" action="" method="POST">
    		            				    <?= csrf_field(); ?> 
    		            					<div class="mb-2">
    		            						<div class="eniv-check-order">
    		            							<input type="text" class="form-control" autocomplete="off" name="order_id" placeholder="Masukan Order ID kamu">
    		            							<button>
    		            								Cari Pesanan
    		            								<svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
    		            									<path d="M3.95768 8.86425H13.3469L10.4731 11.8373C10.4066 11.9062 10.3564 11.9858 10.3256 12.0714C10.2948 12.157 10.2838 12.2471 10.2934 12.3363C10.3127 12.5167 10.4143 12.683 10.576 12.7987C10.7377 12.9145 10.9461 12.9701 11.1555 12.9535C11.3648 12.9369 11.5579 12.8493 11.6923 12.7101L15.6506 8.61877C15.6772 8.58623 15.701 8.55204 15.7219 8.51649C15.7219 8.48239 15.7614 8.46194 15.7773 8.42784C15.8132 8.34966 15.8319 8.26643 15.8327 8.18237C15.8319 8.0983 15.8132 8.01507 15.7773 7.93689C15.7773 7.90279 15.7377 7.88234 15.7219 7.84824C15.701 7.81269 15.6772 7.7785 15.6506 7.74596L11.6923 3.65466C11.6178 3.57769 11.5246 3.51578 11.4193 3.47336C11.3139 3.43093 11.199 3.40902 11.0827 3.40918C10.8977 3.40887 10.7184 3.46436 10.576 3.56601C10.4959 3.62326 10.4296 3.69356 10.381 3.7729C10.3324 3.85223 10.3025 3.93904 10.293 4.02835C10.2834 4.11766 10.2944 4.20772 10.3253 4.29337C10.3562 4.37901 10.4064 4.45857 10.4731 4.52747L13.3469 7.50048H3.95768C3.74772 7.50048 3.54636 7.57232 3.39789 7.7002C3.24942 7.82808 3.16602 8.00152 3.16602 8.18237C3.16602 8.36321 3.24942 8.53665 3.39789 8.66453C3.54636 8.79241 3.74772 8.86425 3.95768 8.86425Z" fill="#F3F3F3"/>
    		            								</svg>
    		            							</button>
    		            						</div>
    		            					</div>
    		            					<small class="text-muted">Pesanan kamu tidak terdaftar meskipun kamu yakin sudah memesan? harap tunggu 1-2 jam namun jika pesanan masih tidak muncul maka kamu dapat menghubungi kami</small>
    		            				</form>
    		            			</div>
    		            		</div>
								<?php if($config['value'] == 1) { ?>
    		            		<div class="card">
    		            		    <div class="card-body">
    		            		        <p class="fw-600 mb-0 fs-16">10 Pesanan Terbaru</p>
    		            		    </div>
    				            	<div class="table-responsive">
    				            		<table class="w-100 table mb-0 border-top eniv-table-last-orders">
    				            		    <thead>
    				            		        <tr>
        				            				<th>Tanggal</th>
        				            				<th>Order ID</th>
        				            				<th>Produk</th>
        				            				<th>Harga</th>
        				            				<th>Status</th>
        				            			</tr>
    				            		    </thead>
    				            		    <tbody id="result-orders">
    				            		        <tr>
    				            		            <td colspan="5" align="center">Loading...</td>
    				            		        </tr>
    				            		    </tbody>
    				            		</table>
    				            	</div>
    				            </div>
								<?php } ?>
    		        		</div>
    		        	</div>
            		</div>
                </div>
            </div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<script>
			    setInterval(function() {
			        $.ajax({
			            url: '<?= base_url(); ?>/payment/check/list-order',
			            success: function(result) {
			                $("#result-orders").html(result);
			            }
			        })
			    }, 1000);
			</script>
			<?php $this->endSection(); ?>