<?php $this->extend('template'); ?>

<?php $this->section('css'); ?>
<?php if(!$games['banner']) { ?>
 <style>
    .eniv-games-banner {
        background-image: url(<?= $games['image']; ?>);
    }
</style>
<?php }else { ?>
<style>
     .eniv-games-banner {
        background-image: url(<?= $games['banner']; ?>);
    }
</style>
 <?php } ?>
<style>
	.sticky{
		position: sticky;
	  	bottom: 20px; 
	  	right: 20px; 
	  	z-index: 999; 
	}
	.sticky-notes{
		padding: 2px 0px 1px 0px;
	  	background: var(--warna_2);
	  	position: sticky;
	  	bottom: 0px; /* Adjust as needed */
	  	right: 20px; /* Adjust as needed */
	  	z-index: 999; 
	}
    .eniv-product-item {
        position: relative;
    }
    .eniv-product-item p {
        display: inline-block;
    }
    .eniv-product-item img {
        width: 24px;
    }
    .eniv-product-area .row {
        padding: 0 6px;
    }
    .eniv-product-area .col-md-6, .eniv-product-area .col-md-12 {
        padding: 0 6px;
    }
    .eniv-method-category{
        height: 50px;
        border-radius: 8px 8px 0px 0px;
        margin-bottom: 0px;
    }
    .eniv-method-category-footer{
        padding: 10px 20px 20px 20px;
        border-radius: 0px 0px 8px 8px;
        margin-bottom: 12px;
        background: rgba(255, 255, 255, 0.5);
    }
    .eniv-method-category h1{
        margin-bottom: 14px;
    }
    .eniv-method-image-list img{
        height: 8px;
        margin-right: 8px;
        float: right;
    }
    .bg-custom-method-item{
        padding: 10px 20px 10px 20px;
        background: #212020;
    }
    .bg-custom-product-list{
        padding: 10px 20px 10px 20px;
        background: #4d4c4c;
        border-radius: 10px;
    }
    .eniv-method-item-list{
        margin-top: 15px;
        height: 100px;
        padding: 3px 12px 10px 12px;
        border-radius: 12px;
        margin-left: 0px;
        background: rgba(255, 255, 255, 0.8);
    }
    .eniv-method-item-list:hover, .eniv-method-item-list.active{
        background-color: #FFF;
    }
    .eniv-method-item-list img{
        height: 20px;
        float: none;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .eniv-method-item-list h1{
        color: #000;
    }
    .eniv-method-item-list h2{
        color: #000;
        margin-top: 12px;
        margin-bottom: 3px;
    }
    .eniv-method-item-list hr{
        color: #000;
        margin: 0px;
    }
    .eniv-method-item-list h3{
        color: #000;
        margin-top: 3px;
        font-size: 9px;
    }
	.pre-review-pesanan{
	    background: var(--warna);
	    border-radius: 5px;
	    border: 1px dashed #615c5c;
	    padding: 18px 18px 0px 18px;
	}
	.pre-review-pesanan img{
	    height: 60px;
	    float: left;
	    border-radius: 8px;
	    margin-right: 10px;
	}
	.pre-review-pesanan h6{
	    font-size: 11px;
	}
	.pre-review-pesanan h2{
	    margin: 10px 0px 0px 0px;
	    font-size: 12px;
	    font-weight: bold;
	}
	.pre-review-pesanan p{
	    font-size: 10px;
	}
	.btn-confirm-order, .btn-white-theme{
	    background: #ff9000;
	    border-radius: 5px;
	    font-size: 12px;
	    color: #FFF!important;
	}
	.entitle-shopping{
	    font-size: larger;
	    color: #FFF;
	}
    .content{
        width: 420px;
    }

    .product-rating{

        font-size: 50px;
    }

    .stars i{

        font-size: 18px;
        color: #28a745;
    }
    
    .activated-eniv-method-category{
        border: 1px solid var(--warna_3)!important;
    }
	.eniv-product-area .menu-category-product .menu-category-product-item{
		background: var(--warna_2);
		border-radius:8px;
		text-align: center; 
		cursor: pointer;
	}
	.eniv-product-area .menu-category-product .menu-category-product-item:hover, .activated-category-menu{
		border: 2px solid #3dbded!important;
		background:#323667!important;
	}
    #qris{
        height: 90px;
    }
    .bg-white-off{
        background: rgba(255, 255, 255, 0.8);
    }
    .border-radius{
        border-radius: 8px;
    }
    #qris, #qris h1{
        color: #000;
    }
    #payment-method-option .eniv-method-image-list img{
        float: left;
    }
    #qris .eniv-method-image-list img{
        height: 35px;
    }
    #payment-method-option .eniv-method-category h2{
        font-size: 14px;
        float: right;
    }
    #qris .eniv-games-ribbon span:nth-child(1), #qris .eniv-games-ribbon span:nth-child(3) {
        background: #876500;
        display: inline-block;
        height: 10px;
        position: absolute;
    }
    #qris .eniv-games-ribbon span:nth-child(1) {
        width: 10px;
        right: 60px;
        top: 50px;
    }
    #qris .eniv-games-ribbon span:nth-child(3) {
        width: 8px;
        right: 10px;
        top: 100px;
    }
    #qris .eniv-games-ribbon span:nth-child(2) {
        position: absolute;
        right: 0;
        background: #f5bd14;
        font-size: 8px !important;
        font-weight: 600;
        padding: 4px 0;
        top: 62px;
        z-index: 1;
        min-width: 85px;
        text-align: center;
        transform: rotate(45deg);
        margin-right: -10px;
        color: #333;
        clip-path: polygon(25% 0, 75% 0, 100% 100%, 0 100%);
    }
    .error_message{
        position: fixed;
        top: 3%;
        left: 50%;
        transform: translate(-50%, 0);
        height:40px;
        background: white;
        z-index: 9999; 
        border-radius: 10px;
    }
    .error_message .content-message{
        padding: 5px 10px 5px 10px;
    }
    .error_message p{
        color: #000;
    }
    
    .btn-content {
        display: flex;
        align-items: center; /* Vertikal sejajar */
        justify-content: space-between; /* Atur ruang antara elemen */
        gap: 10px; /* Jarak antar elemen */
    }

    .btn-text {
        display: flex;
        flex-direction: column; /* Teks berada dalam satu kolom */
        align-items: flex-start; /* Teks rata kiri */
    }

    .btn-text h7 {
        font-size: 12px; /* Ukuran lebih kecil untuk teks tambahan */
        margin: 0;
        line-height: 1.2; /* Jarak antar baris */
    }
    
    @media only screen and (max-width: 767px) {
        .mobile-only {
            display: none !important;
        }
        .error_message{
            left: 40%;
            transform: translate(-40%, 0);
       }
    }

    @media only screen and (min-width: 768px) {
        .desktop-only {
            display: none !important;
        }
    }
</style>
<?php $this->endSection(); ?>


<?php $this->section('content'); ?>
<div class="eniv-content">
    <div class="eniv-games-banner"></div>
    <div class="container">
        <div class="eniv-body">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="eniv-games-detail">
                        <h5><?= $games['games']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
	            <div class="col-md-12">
	                <div class="card card-body eniv-card text-center" style="padding: 8px !important;">
	                    <span class="d-inline-flex align-items-center justify-content-center flex-wrap" style="font-size: 13px;">
	                        <div style="margin-right: 8px; margin-left: 8px;"><i class="fas fa-shield-alt" style="margin-right: 10px; margin-left: 10px;"></i>Jaminan Aman</div>
	                        <div style="margin-right: 8px; margin-left: 8px;"><i class="fa fa-phone" style="margin-right: 10px; margin-left: 10px;"></i>Support 24 Jam</div>
	                        <div style="margin-right: 8px; margin-left: 8px;"><i class="fas fa-credit-card" style="margin-right: 10px; margin-left: 10px;"></i>Pembayaran  Aman & Terpercaya</div>
	                        <div style="margin-right: 8px; margin-left: 8px;"><i class="fa fa-bolt" style="margin-right: 10px; margin-left: 10px;"></i>Proses cepat</div>
	                    </span>
	                </div>
	            </div>

	            <div class="col-md-4">
		            <div class="card mobile-only">
	                    <div class="card-body eniv-card">
	                    <p><?= $games['content']; ?></p>
	                    </div>
	                </div>
	                <div class="card mobile-only">
	                    <div class="card-body eniv-card">
	                        <p class="fw-600 mb-3">Penilaian</p>

	                        <div class="ratings text-center mb-4">

	                            <i class="fa fa-star fa-2x text-warning" ></i><span class="product-rating"><?= $ratingratarata ?></span><span>/5</span>

	                            <div class="rating-text">
	                                
	                                <span class="mb-2"><?= $totalpuas ?> Pembelian merasa puas</span><br>
	                                <span class="mb-4"><?= $totalulasan ?> Ulasan</span><br>

	                                <div class="row" style="padding-top:20px;">
	                                <?php for ($i = 1; $i <= 5; $i++): ?>
	                                <div class="col-2" style="padding-top:3px;"><i class="fa fa-star text-warning"></i> <?= $i ?></div>
	                                <div class="col-10" style="padding-top:7px;">
	                                    <div class="progress" style="height: 13px;">
	                                        <?php
	                                        $index = $i - 1; // Sesuaikan indeks dengan array yang dimulai dari 0
	                                        $width = isset($dataratings[$index]) ? $dataratings[$index] : 0; // Periksa apakah indeks ada dalam array
	                                        ?>
	                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $width ?>%;" aria-valuenow="<?= $width ?>" aria-valuemin="0" aria-valuemax="100"></div>
	                                    </div>
	                                </div>
	                            <?php endfor; ?>
	                            </div>
	                            </div>

	                        </div>
	                        <?php foreach ($review as $loop): ?>
	                        <div>
	                            <div class="row mb-2">
	                                <div class="col-6">
	                                    <b class="d-block mb-2"><?= substr($loop['wa'], 0, 4); ?>****<?= substr($loop['wa'], -4); ?></b>
	                                    <small class="text-muted"><?= $loop['product']; ?></small>
	                                </div>
	                                <div class="col-6 text-end">
	                                    <div class="mb-2">
	                                        <?php for ($i = 1; $i <= $loop['star']; $i++): ?>
	                                        <i class="fa fa-star text-warning"></i>
	                                        <?php endfor; ?>
	                                    </div>
	                                    <small class="text-muted"><?= $loop['date_create']; ?></small>
	                                </div>
	                            </div>
	                            <p class="fw-500 mb-0">"<i><?= $loop['message']; ?></i>"</p>
	                        </div>
	                        <hr>
	                        <?php endforeach; ?>
	                        <a href="<?= base_url(); ?>/review">Lihat selengkapnya...</a>
	                    </div>
	                </div>
	            </div>

            	<div class="col-md-8">

	                <a class="btn btn-primary mb-4 desktop-only" style="border-radius: 5px !important;width: 100%;text-align: left; display: flex; justify-content: space-between;" data-bs-toggle="collapse" href="#keterangan" role="button" aria-expanded="false" aria-controls="keterangan" id="collapseBtn"><span>Lihat Cara Transaksi</span><i class="fas fa-chevron-down" style="padding-top:5px;"></i>
	                </a>
	                <div class="collapse desktop-only" id="keterangan" aria-labelledby="collapseBtn">
	                    <div class="card card-body eniv-card">
	                        <p><?= $games['content']; ?></p>
	                    </div>
	                </div>

	                <!-- Start of Product Section -->
                    <div id="section-product" class="eniv-product-area" style="position:static;padding-top:0px !important;margin-top:0px !important;margin-bottom: 10px;">
                    	<?php if(!empty($product)): ?>
                    	<div class="mobile-only">
	                    	<div class="menu-category-product d-flex flex-row">
	                    		<?php $k = 0; ?>
	                    		<?php foreach ($product as $k => $product_loop): ?>
	                    		<?php
	                    		     $class_menu_activated = "";
	                    		     if($product_loop['id'] == $selected_product_category_id){ $class_menu_activated="activated-category-menu"; }
	                    		?>
	                    		<div class="col-3 p-2">
		                    		<div id="cat-product-<?= $product_loop['id']; ?>" class="menu-category-product-item <?= $class_menu_activated; ?> text-center text-wrap p-1" onclick="show_category_product('<?= $product_loop['id']; ?>','<?= count($product); ?>');">
			                            <br />
			                            <img src="<?= $product_loop['category_image']; ?>" style="height: 30px;" />
			                            <br />
			                            <small class="text-wrap text-center"><strong><?= $product_loop['category']; ?></strong></small>
			                            <br />
			                            <br />
		                            </div>
	                        	</div>
	                            <?php endforeach; ?>
	                    	</div>
                    	</div>
                    	<div class="desktop-only" style="overflow-x: scroll; white-space: nowrap; overflow-y: hidden;">
	                    	<div class="menu-category-product d-flex flex-row">
	                    		<?php $k = 0; ?>
	                    		<?php foreach ($product as $k => $product_loop): ?>
	                    		<?php
	                    		 $class_menu_activated = "";
	                    		 if($product_loop['id'] == $selected_product_category_id){ $class_menu_activated="activated-category-menu"; }
	                    		?>
	                    		<div class="col-3 p-2">
		                    		<div id="cat-product-mobile-<?= $product_loop['id']; ?>" class="menu-category-product-item <?= $class_menu_activated; ?> text-center text-wrap p-1" onclick="show_category_product('<?= $product_loop['id']; ?>','<?= count($product); ?>');">
			                            <br />
			                            <img src="<?= $product_loop['category_image']; ?>" style="height: 25px;" />
			                            <br />
			                            <small style="font-size:10px;" class="text-center"><?= $product_loop['category']; ?></small>
			                            <br /><br />
		                            </div>
	                        	</div>
	                            <?php endforeach; ?>
	                    	</div>
                    	</div>
                    	<?php endif; ?>

                        <?php foreach ($product as $k => $product_loop): ?>
                        <div class="row mt-2 row-cat-product" id="row-cat-product-<?= $product_loop['id']; ?>">
                            <?php foreach ($product_loop['product'] as $loop): ?>
                            <div class="col-md-6 <?= $games['product_type'] == '2' ? 'col-6' : ''; ?>">
                                <div class="eniv-product-item" id="product-<?= $loop['id']; ?>" onclick="select_product('<?= $loop['id']; ?>');">
                                    <div class="card">
                                        <div class="card-body eniv-card">
                                            
                                            <?php if (!empty($loop['logo_url'])): ?>
                                            <img src="<?= $loop['logo_url']; ?>" alt="">
                                            <?php endif; ?>
                                            
                                            <h6><?= $loop['product']; ?></h6>
                                            <?php
                                            $product_price = $loop['price'];
                                            if ($users !== false) {
                                                if ($users['level'] == 'Silver') {
                                                    $product_price = $loop['price_silver'];
                                                } else if ($users['level'] == 'Gold') {
                                                    $product_price = $loop['price_gold'];
                                                } else if ($users['level'] == 'Bisnis') {
                                                    $product_price = $loop['price_bisnis'];
                                                }
                                            }
                                            ?>
                                            <p>Rp <?= number_format($product_price,0,',','.'); ?></p>
                                            <?php if ($loop['price_cut'] > 0): ?>
                                            <small class="text-danger ms-2">Rp <del><?= number_format($loop['price_cut'],0,',','.'); ?></del></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($loop['label'])): ?>
                                    <div class="eniv-games-ribbon">
                                        <span></span>
                                        <span><?= $loop['label']; ?></span>
                                        <span></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php if (count($product) == 0): ?>
                        <div class="text-center">
                            <img src="<?= base_url(); ?>/assets/images/empty.png" alt="" class="mb-3">
                            <h5 class="fw-600">Oppsss...</h5>
                            <p>Mohon maaf untuk saat ini tidak ada produk yang tersedia</p>
                        </div>
                        <?php endif ?>
                    </div>
                    <!-- End of Product Section-->


                    <!-- Start of Account Section-->
                    <div id="section-account">
                    <?php if (count($target) == 1 && $target[0]['target'] != 'default'): ?>
	                    <div class="card mt-6">
	                        <div class="card-body eniv-card">
	                            <p class="fw-600 mb-3"><?= $target[0]['text']; ?> 
	                            <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <circle cx="12" cy="12" r="10" stroke="white" stroke-width="1" fill="none" />
                              <path d="M12 8a3 3 0 0 1 3 3c0 1.67-1.33 2.5-2 3l-.5.5V15h-1v-1.5l.5-.5c.5-.5 1.5-1 1.5-2a2 2 0 0 0-4 0H9a3 3 0 0 1 3-3z" fill="white" />
                              <circle cx="12" cy="17" r="1" fill="white" />
                                </svg></a>
                                </p>
	                            
	                            <?php if (!$isLoggedIn): ?>
                                    <!-- Jika user belum login -->
                                    <a href="<?php base_url() ?>/login">
                                    <button class="btn btn-primary form-control" style="margin-bottom:20px;">
                                        <div class="btn-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save">
                                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                                <polyline points="7 3 7 8 15 8"></polyline>
                                            </svg>
                                            <div class="btn-text">
                                                <span>Ingin Top Up Lebih Mudah?</span>
                                                <h7 class="text-xxs leading-none md:text-xs">Gunakan Fitur SAVE ID Sekarang!</h7>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right">
                                                <path d="m9 18 6-6-6-6"></path>
                                            </svg>
                                        </div>
                                    </button>
                                    </a>
                                <?php else: ?>
                                    <!-- Jika user sudah login -->
                                    <select class="form-control" style="margin-bottom:8px;" id="playerDropdown">
                                        <option disabled selected>Pilih Akun</option>
                                        <?php foreach ($playerIds as $player): ?>
                                            <option value="<?= $player['id'] ?>" data-game-id="<?= $player['game_id'] ?>" 
                                            data-zone-id="<?= $player['zone_id'] ?>" data-server-id="<?= $player['server_id'] ?>" data-id-7="<?= $player['ID_7'] ?>" data-id-8="<?= $player['ID_8'] ?>"><?= $player['label_akun'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
	                             
	                             <?php 
	                            $fill = '';
	                            $no = 1; foreach (json_decode($target[0]['col'], true) as $loop): 
	                                if ($no == 1) {
	                                    $fill = $auto_fill['user'];
	                                } else if ($no == 2) {
	                                    $fill = $auto_fill['server'];
	                                }
	                            ?>
	                            <?php if ($loop['col_type'] == 'input'): ?>
	                                <input type="hidden" name="target" value="true">
	                            <div class="mb-2">
	                                <div class="input-group">
	                                    <span class="input-group-text left target-input"><?= $loop['title']; ?></span>
	                                    <input type="<?= $loop['type']; ?>" class="form-control games-input target-input" name="target[]" autocomplete="off" value="<?= $fill; ?>">
	                                </div>
	                            </div>
	                            <?php else: ?>
	                                <input type="hidden" name="target" value="true">
    	                            <div class="mb-2">
    	                                <div class="input-group">
    	                                    <span class="input-group-text left"><?= $loop['title']; ?></span>
    	                                    <select class="form-control games-input target-input" name="target[]">
    	                                        <?php foreach (explode("\n", $loop['option']) as $option): ?>
    	                                        <?php 
    	                                        $exp_option = explode('|', $option);
    	                                        if (count($exp_option) == 2) :
    	                                        ?>
    	                                        <option value="<?= $exp_option[0]; ?>" <?= $exp_option[0] == $fill ? 'selected' : ''; ?>><?= $exp_option[1]; ?></option>
    	                                        <?php endif; ?>
    	                                        <?php endforeach ?>
    	                                    </select>
    	                                </div>
    	                            </div>
	                            <?php endif ?>
	                            <?php $no++; endforeach ?>
	                            <div id="feedback" style="font-size:15px;text-transform: uppercase;margin-top:10px;color:#f03144;display:none;">
	                                <div class="input-group">
	                                    <span class="input-group-text left">PLAYER</span>
	                                    <input type="text" class="form-control" style="text-transform: uppercase;font-size:13px" value="<?= $target[0]['error']; ?>" disabled>
	                                </div>
	                             </div>
	                            <p class="text-muted fs-12 mb-0"><?= $target[0]['description']; ?></p>
	                        </div>
	                    </div>
                    <?php else: ?>
                        <input type="hidden" name="target" value="false">
                    <?php endif ?>
                	</div>
                	<!-- End of Account Section-->
                	<!-- Modal -->
                	 <?php if (count($target) == 1 && $target[0]['target'] != 'default'): ?>
                    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="helpModalLabel">Petunjuk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                            <img src="<?= $target[0]['img_petunjuk']; ?>" alt="Petunjuk" class="img-fluid" />
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endif ?>
                	<!-- Start of Order Section-->
	                <div id="section-order">
	                    
	                    <input type="hidden" name="product" value="0">
	                    <input type="hidden" name="method" value="0">

	                    <div class="card" id="quantity">
	                        <div class="card-body eniv-card">
	                            <p class="fw-600 mb-3">Masukan Jumlah Total Orderan</p>
	                            <div class="row">
	                            <div class="input-group">
	                                <input type="number" class="form-control" name="jumlah" id="jumlah" value="1" min="1" style="border-radius: 5px;height:30px">
	                                <div class="input-group-append" style="margin-left:10px;">
	                                <button class="btn btn-primary" type="button" id="decrease" style="border-radius: 5px;height:30px;padding: 5px 10px 5px 10px;background:var(--text_2) !important;"><i class="fa fa-minus"></i></button>
	                                <button class="btn btn-primary" type="button" id="increase" style="border-radius: 5px;height:30px;padding: 5px 10px 5px 10px;margin-left:10px;background:var(--text_2) !important;"><i class="fa fa-plus"></i></button>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    </div>
	                    
                        <div class="card" id="payment-method-option">
                            <div class="card-body eniv-card">
                                <p class="fw-600 mb-3 entitle-shopping">Pilih Pembayaran</p>
                                <div class="eniv-method-category bg-white-off border-radius" id="qris" onclick="select_method_qris('27');">
                                    <h1>QRIS (Semua E-WALLET)</h1>
                                    <div class="eniv-method-image-list" id="qris-27">
                                    <img src="<?= base_url(); ?>/assets/images/method/1676698761_e825b897c340c064c6bb.png" alt="">
                                    <h2>Rp 0</h2>
                                    </div>
                                    <div class="eniv-games-ribbon">
                                        <span></span>
                                        <span>BEST PRICE</span>
                                        <span></span>
                                    </div>
                                </div>
                                <br />
                                <?php foreach ($method as $method_loop): ?>
                                <div class="eniv-method-category" onclick="show_method('<?= $method_loop['id']; ?>');">
                                    <h1><?= $method_loop['category']; ?></h1>
                                    <i class="fa fa-chevron-down ms-2" style="float: right;position: relative;top: -28px;"></i>
                                </div>
                                <div class="eniv-method-item bg-custom-method-item" id="method-category-<?= $method_loop['id']; ?>">
                                    <div class="row">
                                    <?php foreach ($method_loop['method'] as $loop): ?>
                                    <div class="col-6">
                                        <div class="eniv-method-item-list bg-white-off" id="method-<?= $loop['id']; ?>" onclick="select_method('<?= $loop['id']; ?>');">
                                            <input type="hidden" name="str-method-<?= $loop['id']; ?>" value="<?= $loop['method']; ?>" />
                                            <input type="hidden" name="str-subtitle-<?= $loop['id']; ?>" value="<?= $loop['sub_title']; ?>" />
                                            <input type="hidden" name="str-price-<?= $loop['id']; ?>" value="" />
                                            <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="">
                                            <h2>Rp 0</h2>
                                            <hr />
                                            <h3><?= $loop['sub_title']; ?></h3>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="eniv-method-category-footer" id="eniv-method-category-footer-img-<?= $method_loop['id']; ?>">
                                    <div class="eniv-method-image-list">
                                        <?php foreach ($method_loop['method'] as $loop): ?>
                                        <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="">
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <?php endforeach ?>
                                
                                <?php if ($pay_balance == 'Y' AND $users !== false): ?>
                                <div class="eniv-method-category" onclick="show_method('balance');">
                                    <h1>Saldo Akun</h1>
                                </div>
                                <div class="eniv-method-item" id="method-category-balance">
                                    <div class="eniv-method-item-list bg-custom-method-item bg-white-off" id="method-balance" onclick="select_method('balance');">
                                        <input type="hidden" name="str-price-balance" value="" />
                                        <img src="<?= base_url(); ?>/assets/images/method/balance.png" alt="" height="20">
                                        <h1>Saldo Akun</h1>
                                        <h2>Rp 0</h2>
                                    </div>
                                </div>
                                <div class="eniv-method-category-footer" id="eniv-method-category-footer-img-<?= $method_loop['id']; ?>">
                                    <div class="eniv-method-image-list">
                                        <img src="<?= base_url(); ?>/assets/images/method/balance.png" alt="">
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

	                    <div class="card">
	                        <div class="card-body eniv-card">
	                            <p class="fw-600 mb-3">Kode Voucher</p>
	                            <div class="mb-3">
	                                <input type="text" class="form-control" placeholder="Optional" autocomplete="off" name="voucher">
	                            </div>
	                            <button class="btn btn-primary w-100 btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalpromo">Voucher Tersedia</button>
	                        </div>
	                    </div>
	                    
	                   <div class="card" id="contact_person">
	                        <div class="card-body eniv-card">
	                            <p class="fw-600 mb-3">Konfirmasi Pembelian</p>
	                            <div class="mb-4">
	                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#whatsapp" aria-expanded="true" aria-controls="whatsapp">
	                                    Whatsapp
	                                </button>
	                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#email" aria-expanded="false" aria-controls="email">
	                                    Email
	                                </button>
	                            </div>

	                                <div class="collapse show" id="whatsapp">
	                                <div class="mb-2">
	                                            <div class="input-group mb-2">
	                                                <span class="input-group-text left"><i class="fab fa-whatsapp fs-20"></i></span>
	                                                <input type="number" class="form-control" placeholder="Masukkan No. Whatsapp" autocomplete="off" name="wa" value="<?= $auto_fill['wa']; ?>">
	                                            </div>
	                                            <small class="text-muted">Bukti pembayaran atas pembelianmu akan kami kirimkan ke WhatsApp.</small>
	                                        </div>
	                                </div>
	                                <div class="collapse" id="email">
	                                <div class="mb-2">
	                                            <div class="input-group mb-2">
	                                                <span class="input-group-text left"><i class="fa fa-envelope fs-20"></i></span>
	                                                <input type="email" class="form-control" placeholder="Masukkan Email" autocomplete="off" name="email">
	                                            </div>
	                                            <small class="text-muted">Bukti pembayaran atas pembelianmu akan kami kirimkan ke Email.</small>
	                                        </div>
	                                </div>

	                        </div>
	                    </div>

	                    <div class="mb-4" id="preview-order-summary-detail">
	                        <div class="card" id="summary-price">
	                            <div class="card-body eniv-card pre-review-pesanan">
	                                <img src="<?= base_url(); ?>/assets/images/default.jpg" />
	                                <h6>[Silahkan Pilih Produk]</h6>
	                                <h2>-</h2>
	                                <p>Metode Pembelian</p>
	                            </div>
	                        </div>
	                        <div id="btn-order-process" class="eniv-order-btn mb-2">
	                            <button class="btn btn-primary w-100 btn-confirm-order" type="button" onclick="process_order();">
	                                <i class="fa fa-shopping-bag ms-2"></i>&ensp;Pesan Sekarang!
	                            </button>
	                        </div>
                    	</div>

	                    <div class="card desktop-only">
	                        <div class="card-body eniv-card">
	                            <p class="fw-600 mb-3">Penilaian</p>

	                            <div class="ratings text-center mb-4">

	                                <i class="fa fa-star fa-2x text-warning" ></i><span class="product-rating"><?= $ratingratarata ?></span><span>/5</span>

	                                <div class="rating-text">
	                                    
	                                    <span class="mb-2"><?= $totalpuas ?> Pembelian merasa puas</span><br>
	                                    <span class="mb-4"><?= $totalulasan ?> Ulasan</span><br>

	                                    <div class="row" style="padding-top:20px;">
	                                    <?php for ($i = 1; $i <= 5; $i++): ?>
	                                    <div class="col-2" style="padding-top:3px;"><i class="fa fa-star text-warning"></i> <?= $i ?></div>
	                                    <div class="col-10" style="padding-top:7px;">
	                                        <div class="progress" style="height: 13px;">
	                                            <?php
	                                            $index = $i - 1; // Sesuaikan indeks dengan array yang dimulai dari 0
	                                            $width = isset($dataratings[$index]) ? $dataratings[$index] : 0; // Periksa apakah indeks ada dalam array
	                                            ?>
	                                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $width ?>%;" aria-valuenow="<?= $width ?>" aria-valuemin="0" aria-valuemax="100"></div>
	                                        </div>
	                                    </div>
	                                <?php endfor; ?>
	                                </div>
	                                </div>

	                            </div>
	                            <?php foreach ($review as $loop): ?>
	                            <div>
	                                <div class="row mb-2">
		                                <div class="col-6">
		                                    <b class="d-block mb-2"><?= substr($loop['wa'], 0, 4); ?>****<?= substr($loop['wa'], -4); ?></b>
		                                    <small class="text-muted"><?= $loop['product']; ?></small>
		                                </div>
		                                <div class="col-6 text-end">
		                                    <div class="mb-2">
		                                        <?php for ($i = 1; $i <= $loop['star']; $i++): ?>
		                                        <i class="fa fa-star text-warning"></i>
		                                        <?php endfor; ?>
		                                    </div>
		                                    <small class="text-muted"><?= $loop['date_create']; ?></small>
		                                </div>
		                            </div>
		                            <p class="fw-500 mb-0">"<i><?= $loop['message']; ?></i>"</p>
	                            </div>
	                            <hr>
	                            <?php endforeach; ?>
	                            <a href="<?= base_url(); ?>/review">Lihat selengkapnya...</a>
	                        </div>
	                    </div>
	                </div>
                	<!-- End of Order Section -->

                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="mb-3">
                            <rect x="0.5" y="0.875" width="70" height="70" rx="35" fill="#0E101C"/>
                            <path d="M25.5175 42.6133L22.2467 21.3753H20.25C19.7859 21.3753 19.3408 21.1909 19.0126 20.8627C18.6844 20.5345 18.5 20.0894 18.5 19.6253C18.5 19.1612 18.6844 18.716 19.0126 18.3879C19.3408 18.0597 19.7859 17.8753 20.25 17.8753H23.7238C24.1459 17.8675 24.5565 18.0137 24.8787 18.2865C25.2095 18.5647 25.4253 18.9557 25.4843 19.3838L26.0582 23.1253H39.5V26.6253H26.5972L28.7498 40.6253H45.198L47.823 31.8753H51.477L48.1765 42.8775C48.0684 43.2382 47.847 43.5544 47.545 43.7792C47.2429 44.0039 46.8765 44.1253 46.5 44.1253H27.278C26.8439 44.1333 26.4224 43.9785 26.0968 43.6913C25.7794 43.4138 25.5731 43.0309 25.5157 42.6133H25.5175ZM32.5 49.3753C32.5 50.3036 32.1313 51.1938 31.4749 51.8502C30.8185 52.5065 29.9283 52.8753 29 52.8753C28.0717 52.8753 27.1815 52.5065 26.5251 51.8502C25.8687 51.1938 25.5 50.3036 25.5 49.3753C25.5 48.447 25.8687 47.5568 26.5251 46.9004C27.1815 46.244 28.0717 45.8753 29 45.8753C29.9283 45.8753 30.8185 46.244 31.4749 46.9004C32.1313 47.5568 32.5 48.447 32.5 49.3753ZM48.25 49.3753C48.25 50.3036 47.8813 51.1938 47.2249 51.8502C46.5685 52.5065 45.6783 52.8753 44.75 52.8753C43.8217 52.8753 42.9315 52.5065 42.2751 51.8502C41.6187 51.1938 41.25 50.3036 41.25 49.3753C41.25 48.447 41.6187 47.5568 42.2751 46.9004C42.9315 46.244 43.8217 45.8753 44.75 45.8753C45.6783 45.8753 46.5685 46.244 47.2249 46.9004C47.8813 47.5568 48.25 48.447 48.25 49.3753ZM48.25 17.8753C48.7141 17.8753 49.1593 18.0597 49.4874 18.3879C49.8156 18.716 50 19.1612 50 19.6253V21.3753H51.75C52.2141 21.3753 52.6592 21.5597 52.9874 21.8879C53.3156 22.216 53.5 22.6612 53.5 23.1253C53.5 23.5894 53.3156 24.0345 52.9874 24.3627C52.6592 24.6909 52.2141 24.8753 51.75 24.8753H50V26.6253C50 27.0894 49.8156 27.5345 49.4874 27.8627C49.1593 28.1909 48.7141 28.3753 48.25 28.3753C47.7859 28.3753 47.3407 28.1909 47.0126 27.8627C46.6844 27.5345 46.5 27.0894 46.5 26.6253V24.8753H44.75C44.2859 24.8753 43.8407 24.6909 43.5126 24.3627C43.1844 24.0345 43 23.5894 43 23.1253C43 22.6612 43.1844 22.216 43.5126 21.8879C43.8407 21.5597 44.2859 21.3753 44.75 21.3753H46.5V19.6253C46.5 19.1612 46.6844 18.716 47.0126 18.3879C47.3407 18.0597 47.7859 17.8753 48.25 17.8753Z" fill="#00E59B"/>
                        </svg>
                    </div>
                    <h1 class="fs-18 fw-600">Informasi Pembelian</h1>
                </div>
                <h2 class="fs-16">Detail Player</h2>
                <hr class="my-3">
                <div id="eniv-modal-result"></div>
                <div class="text-center">
                    <button type="button" class="btn btn-auth me-2" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-auth btn-primary" onclick="proses_order();">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGanda" tabindex="-1" aria-labelledby="modalGandaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="mb-3">
                            <rect x="0.5" y="0.875" width="70" height="70" rx="35" fill="#0E101C"/>
                            <path d="M25.5175 42.6133L22.2467 21.3753H20.25C19.7859 21.3753 19.3408 21.1909 19.0126 20.8627C18.6844 20.5345 18.5 20.0894 18.5 19.6253C18.5 19.1612 18.6844 18.716 19.0126 18.3879C19.3408 18.0597 19.7859 17.8753 20.25 17.8753H23.7238C24.1459 17.8675 24.5565 18.0137 24.8787 18.2865C25.2095 18.5647 25.4253 18.9557 25.4843 19.3838L26.0582 23.1253H39.5V26.6253H26.5972L28.7498 40.6253H45.198L47.823 31.8753H51.477L48.1765 42.8775C48.0684 43.2382 47.847 43.5544 47.545 43.7792C47.2429 44.0039 46.8765 44.1253 46.5 44.1253H27.278C26.8439 44.1333 26.4224 43.9785 26.0968 43.6913C25.7794 43.4138 25.5731 43.0309 25.5157 42.6133H25.5175ZM32.5 49.3753C32.5 50.3036 32.1313 51.1938 31.4749 51.8502C30.8185 52.5065 29.9283 52.8753 29 52.8753C28.0717 52.8753 27.1815 52.5065 26.5251 51.8502C25.8687 51.1938 25.5 50.3036 25.5 49.3753C25.5 48.447 25.8687 47.5568 26.5251 46.9004C27.1815 46.244 28.0717 45.8753 29 45.8753C29.9283 45.8753 30.8185 46.244 31.4749 46.9004C32.1313 47.5568 32.5 48.447 32.5 49.3753ZM48.25 49.3753C48.25 50.3036 47.8813 51.1938 47.2249 51.8502C46.5685 52.5065 45.6783 52.8753 44.75 52.8753C43.8217 52.8753 42.9315 52.5065 42.2751 51.8502C41.6187 51.1938 41.25 50.3036 41.25 49.3753C41.25 48.447 41.6187 47.5568 42.2751 46.9004C42.9315 46.244 43.8217 45.8753 44.75 45.8753C45.6783 45.8753 46.5685 46.244 47.2249 46.9004C47.8813 47.5568 48.25 48.447 48.25 49.3753ZM48.25 17.8753C48.7141 17.8753 49.1593 18.0597 49.4874 18.3879C49.8156 18.716 50 19.1612 50 19.6253V21.3753H51.75C52.2141 21.3753 52.6592 21.5597 52.9874 21.8879C53.3156 22.216 53.5 22.6612 53.5 23.1253C53.5 23.5894 53.3156 24.0345 52.9874 24.3627C52.6592 24.6909 52.2141 24.8753 51.75 24.8753H50V26.6253C50 27.0894 49.8156 27.5345 49.4874 27.8627C49.1593 28.1909 48.7141 28.3753 48.25 28.3753C47.7859 28.3753 47.3407 28.1909 47.0126 27.8627C46.6844 27.5345 46.5 27.0894 46.5 26.6253V24.8753H44.75C44.2859 24.8753 43.8407 24.6909 43.5126 24.3627C43.1844 24.0345 43 23.5894 43 23.1253C43 22.6612 43.1844 22.216 43.5126 21.8879C43.8407 21.5597 44.2859 21.3753 44.75 21.3753H46.5V19.6253C46.5 19.1612 46.6844 18.716 47.0126 18.3879C47.3407 18.0597 47.7859 17.8753 48.25 17.8753Z" fill="#00E59B"/>
                        </svg>
                    </div>
                    <h1 class="fs-18 fw-600">Transaksi Ganda Ditemukan</h1>
                </div>
                <h2 class="fs-16">Detail Player</h2>
                <hr class="my-3">
                <div id="eniv-modal-result2"></div>
                <div class="text-center">
                    <button type="button" class="btn btn-auth me-2" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-auth btn-primary" onclick="proses_order();">Lanjut Bayar?</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpromo" tabindex="-1" aria-labelledby="modalpromoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="eniv-voucher-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h1>Promo yang tersedia</h1>
                </div>
                <?php if($voucher) { ?>
                <?php foreach ($voucher as $loop): ?>
                <?php
                $level_next = false;
                                        
                $my_level = 'Guest';
                if ($users !== false) {
                    $my_level = 'NonGuest';
                    $my_level .= ',' . $users['level'];
                }
                foreach (array_filter(explode(',', $loop['level'])) as $voucher_level) {
                    
                    if (in_array($voucher_level, explode(',', $my_level))) {
                        
                        $level_next = true;
                    }
                }

                /*** START NEW CHANGES ***/    
                /*if (isset($users['level'])) {
                    $my_level = $users['level'];
                }else{
                    $my_level = 'Guest';
                }
                
                $check_contain_multilevel = str_contains($loop['level'], ",");
                if($check_contain_multilevel){
                    if (in_array($my_level, explode(',', $loop['level']))) {
                        $level_next = true;
                    }
                }else{
                    if($loop['level'] == $my_level){
                         $level_next = true;
                    }
                }*/
                /*** END NEW CHANGES ***/
                
                if ($level_next == true) : ?>
                <div class="eniv-voucher" onclick="select_voucher('<?= $loop['voucher']; ?>');">
                    <h1><?= $loop['title']; ?></h1>
                    <div class="mb-3">
                        <?= htmlspecialchars_decode($loop['content']); ?>
                    </div>
                    <small>Kode Promo : <b><?= $loop['voucher']; ?></b></small>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php }else { ?>
                    Tidak Tersedia Voucher
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="error_message" style="display:none">
    <div class="content-message">
    <p>
    <img src="<?= base_url(); ?>/assets/images/err_icon.jpg" alt=""> &ensp;<span>Error Error Errorr</span>
    </p>
    </div>
</div>
<?php $this->endSection(); ?>


<?php $this->section('footer'); ?>
	<div class="col-md-12 mb-4">
		<div class="row">
		    <div class="col-md-12">
		        <h6 class="mb-4">Top Up Game dan Voucher <?= $footercategory['category'] ?></h6>
		        <?php foreach ($footer as $loop): ?>
		        <span class="badge badge-primary mb-2" style="background:var(--warna_3) !important;"> <a href="<?= base_url() ?>/games/<?= $loop['slug'] ?>" style="border-radius: 0 !important;font-size:13px;color: var(--warna) !important;"><?= $loop['games'] ?></a></span>
		        <?php endforeach; ?>
		    </div>
		</div>
	</div>

	<?php
	$description = $games['footer'];
	$words = explode(" ", $description);
	$shortDescription = implode(" ", array_slice($words, 0, 50));
	?>

	<div class="col-md-12" style="margin-bottom:20px;">
		<div id="description_footer" class="description_footer">
		<?= $shortDescription ?>
		</div>
		<div id="description_footer_full" class="description_footer_full" style="display: none;">
		<?= $games['footer'] ?>
		</div>
		<center>
			<button id="show_more_btn" class="show-more" style="background: none;border: none;color:white;">Selengkapnya</button>
			<button id="show_less_btn" class="show-less" style="background: none;border: none;color:white; display: none;">Sembunyikan</button>
		</center>
	</div>
	<hr>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var collapseBtn = document.getElementById('collapseBtn');
    var arrowIcon = collapseBtn.querySelector('i');

    collapseBtn.addEventListener('click', function () {
        if (arrowIcon.classList.contains('fa-chevron-down')) {
            arrowIcon.classList.remove('fa-chevron-down');
            arrowIcon.classList.add('fa-chevron-up');
        } else {
            arrowIcon.classList.remove('fa-chevron-up');
            arrowIcon.classList.add('fa-chevron-down');
        }
    });
});
</script>
<script>
$(document).ready(function(){
    $(".error_message").hide();
    $('#quantity').hide();
    $("#feedback").hide();
    $('#summary-price').hide();
    $(".row-cat-product").hide();
    $("#row-cat-product-"+<?= $selected_product_category_id; ?>).show();
});

function showFeedback() {
    $("#feedback").show();
}

function hideFeedback() {
    $("#feedback").hide();
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
	var whatsapp = document.querySelector('[data-bs-target="#whatsapp"]');
	var email = document.querySelector('[data-bs-target="#email"]');
	var collapsewhatsapp = document.getElementById('whatsapp');
	var collapseemail = document.getElementById('email');

	whatsapp.addEventListener('click', function () {
	    collapsewhatsapp.classList.add('show');
	    collapseemail.classList.remove('show');
	});

	email.addEventListener('click', function () {
	    collapseemail.classList.add('show');
	    collapsewhatsapp.classList.remove('show');
	});
});
</script>
<script>
var modal_promo = new bootstrap.Modal(document.getElementById('modalpromo'));
var modal_konfirmasi = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));
var modal_ganda = new bootstrap.Modal(document.getElementById('modalGanda'));

function select_voucher(voucher) {
    
    $("input[name=voucher]").val(voucher);
    
    modal_promo.hide();
}


function select_product(id) {
	$('html, body').animate({
	scrollTop: $("#section-account").offset().top-100
	}, 400);

    $("#qris").removeClass('activated-eniv-method-category');
    $(".eniv-product-item").removeClass('active');
    $("#product-" + id).addClass('active');

	$("input[name=product]").val(id);

    $('#summary-price').show();
    $('#preview-order-summary-detail').addClass('sticky-notes');

	$.ajax({
		url: '<?= base_url(); ?>/games/product/check/' + id,
		dataType: 'JSON',
		success: function(result) {
			if (result[0].product_count == 'Y') {
			$('#quantity').show();
			} else {
			$('#quantity').hide();
			}
		}
	});

	$.ajax({
		url: '<?= base_url(); ?>/games/order/get-price/' + id,
		dataType: 'JSON',
		success: function(result) {
			for (let i = 0; i < result.length; i++) {
				$("#method-" + result[i].method + " h2").text('Rp ' + result[i].price);
                if(result[i].method == "27"){
                    $("#qris-27 h2").text('Rp ' + result[i].price);
                }
				$("input[name=str-price-"+ result[i].method +"]").attr("value", result[i].price);
                $("input[name=str-price-balance").attr("value", result[i].price);
                $("#summary-price" + " h2").text('Rp ' + result[i].price);
                $("#summary-price" + " h6").text(result[i].product);
                $("#summary-price" + " p").text('**Proses Instant');
                $("#summary-price img").attr("src", result[i].image);
			}

			$('#jumlah').val(1);
		}
	});

	$('#jumlah').off().on('input', function() {
		updateTotal(id, $('#jumlah').val());
	});

	$('#decrease').off().on('click', function() {
        if(parseInt($('#jumlah').val()) > 1){
            $('#jumlah').val(parseInt($('#jumlah').val()) - 1);
            $(".eniv-method-item-list").removeClass('active');
            $("input[name=method]").val('');
        }
        updateTotal(id, $('#jumlah').val());
    });

    $('#increase').off().on('click', function() {
        $('#jumlah').val(parseInt($('#jumlah').val()) + 1);
        $(".eniv-method-item-list").removeClass('active');
        $("input[name=method]").val('');
        updateTotal(id, $('#jumlah').val());
    });

	function updateTotal(id, jumlah) {
		id = id.toString();
		jumlah = parseInt(jumlah);

		$.ajax({
			url: '<?= base_url(); ?>/games/order/get-price/' + id,
			dataType: 'JSON',
			success: function(result) {
				for (let i = 0; i < result.length; i++) {
				    var prices = result[i].price.replace(/\./g, "");
				    console.log(prices);
				    var hasil = jumlah * prices;
				    $("#method-" + result[i].method + " h2").text('Rp ' + hasil.toLocaleString('id-ID').replace(/,/g, '.'));
                    if(result[i].method  == '27'){
                        $("#qris-27 h2").text('Rp ' + hasil.toLocaleString('id-ID').replace(/,/g, '.'));
                    }
                    $("input[name=str-price-" + result[i].method + "]").val(hasil.toLocaleString('id-ID').replace(/,/g, '.'));
                    $('#summary-price h2').text('Rp ' + hasil.toLocaleString('id-ID').replace(/,/g, '.'));
				}
			}
		});
	}

    function updateTotalCount(id, jumlah) {
        id = id.toString();
        jumlah = parseInt(jumlah);

        $.ajax({
            url: '<?= base_url(); ?>/games/order/get-price/' + id,
            dataType: 'JSON',
            success: function(result) {
                for (let i = 0; i < result.length; i++) {
                    var product_price = result[i].product_price.replace(/\./g, "");
                    var custom_price = result[i].custom_price.replace(/\./g, "");
                    var fee = result[i].fee;
                    var hasil_product_price = jumlah * product_price;
                    var hasil = jumlah * custom_price;
                    var hasil_akhir = hasil + fee;
                    $("#method-" + result[i].method + " h2").text('Rp ' + hasil_akhir.toLocaleString('id-ID').replace(/,/g, '.'));
                    if(result[i].method  == '27'){
                        $("#qris-27 h2").text('Rp ' + hasil_akhir.toLocaleString('id-ID').replace(/,/g, '.'));
                    }
                    $("input[name=str-price-" + result[i].method + "]").val(hasil_akhir.toLocaleString('id-ID').replace(/,/g, '.'));
                    $('#summary-price h2').text('Rp ' + hasil_product_price.toLocaleString('id-ID').replace(/,/g, '.'));
                }
            }
        });
    }

}

function select_method_qris(id) {
    var price = $("input[name=str-price-" + id + "]").val();
    var note = $("input[name=str-subtitle-" + id + "]").val();
    var method = $("input[name=str-method-" + id + "]").val();
    $("#summary-price" + " h2").text('Rp ' + price + ' - ' + method);
    $("#summary-price" + " p").text(note);

    $(".eniv-method-item-list").removeClass('active');
    $("#qris").addClass('activated-eniv-method-category');
    $("input[name=method]").val(id);
}

function select_method(id) {
    if(id == 'balance'){
        var price = $("input[name=str-price-balance").val();
        $("#summary-price" + " h2").text('Rp ' + price);
        $("#summary-price" + " p").text('Saldo Akun');
    }else{
        var price = $("input[name=str-price-" + id + "]").val();
        var note = $("input[name=str-subtitle-" + id + "]").val();
        var method = $("input[name=str-method-" + id + "]").val();

        $("#summary-price" + " h2").text('Rp ' + price + ' - ' + method);
        $("#summary-price" + " p").text(note);
    }

    $("#qris").removeClass('activated-eniv-method-category');
    $(".eniv-method-item-list").removeClass('active');
    $("#method-" + id).addClass('active');
    $("input[name=method]").val(id);

}

function process_order() {
    
    var target = $('.games-input').map(function() {
        return this.value;
    }).get().join(',');

    var product = $("input[name=product]").val();
    var method = $("input[name=method]").val();

    var collapsewhatsapp = document.getElementById('whatsapp');
    var collapseemail = document.getElementById('email');

    var wa = $("input[name=wa]").val();
    var email = $("input[name=email]").val();
    var voucher = $("input[name=voucher]").val();
    var checktarget = $('input[name=target]').val();
    var jumlah = $('input[name=jumlah]').val();

    // if (jumlah < 1) {
    //     jumlah = 1;
    // } 

    // if (product == "" || product == " " || product == "0" || product == 0) {
    //     //Swal.fire('Gagal', 'Nominal produk harus dipilih', 'error');
    //     showNotifications('Pilih produk');
    //     $('html, body').animate({
    //             scrollTop: $("#section-product").offset().top-100
    //     }, 400);
    // } 

    // if (checktarget == true) {
    //     if (target == "," || target == "" || target == " ") {
    //         //Swal.fire('Gagal', 'ID Player harus diisi', 'error');
    //         showNotifications('ID Player harus diisi');
    //         $('html, body').animate({
    //             scrollTop: $("#section-account").offset().top-100
    //         }, 400);
    //     }
    // } 

    // if (method == "" || method == " " || method == "0" || method == 0) {
    //     //Swal.fire('Gagal', 'Pilih metode pembayaran', 'error');
    //     showNotifications('Pilih pembayaran');
    //     $('html, body').animate({
    //         scrollTop: $("#payment-method-option").offset().top-100
    //     }, 400);
    // }

    // if (collapsewhatsapp.classList.contains('show')) {
    //     if (wa.length < 10 || wa.length > 14) {
    //         //Swal.fire('Gagal', 'Nomor Whatsapp tidak sesuai', 'error');
    //         showNotifications('Cek Nomor Whatsapp');
    //         $('html, body').animate({
    //             scrollTop: $("#contact_person").offset().top-100
    //         }, 400);
    //     } else {
    //         var data = {
    //             target: target,
    //             method: method,
    //             product: product,
    //             voucher: voucher,
    //             wa: wa,
    //             email: 'order@belanjagame.com',
    //             jumlah:jumlah,
    //         };
            
    //       proses_ajaxs(data, product);
    //     }
    // } else {
    //     if (collapseemail.classList.contains('show')) {
    //         if (email == "" || email == " ") {
    //             //Swal.fire('Gagal', 'Email Harus diisi', 'error');
    //             showNotifications('Email Harus diisi');
    //             $('html, body').animate({
    //                 scrollTop: $("#contact_person").offset().top-100
    //             }, 400);
    //         } else {
    //             var data = {
    //                 target: target,
    //                 method: method,
    //                 product: product,
    //                 voucher: voucher,
    //                 wa: 0,
    //                 email: email,
    //                 jumlah:jumlah,
    //             };
                
    //           proses_ajaxs(data, product);
    //         }
    //     }
    // }
    if (jumlah < 1) {
        Swal.fire('Gagal', 'Jumlah minimal 1', 'error'); 
    }
    if (jumlah < 1) {
        jumlah = 1;
    } 

    
    if (product == "" || product == " " || product == "0" || product == 0) {
        showNotifications('Silahkan Pilih produk');
        $('html, body').animate({
            scrollTop: $("#section-product").offset().top-100
        }, 400);
    }else if (checktarget) {
        if (target == ",") {
            //Swal.fire('Gagal', 'ID Player harus diisi', 'error');
            showNotifications('ID Player harus diisi');
            $('html, body').animate({
                scrollTop: $("#section-account").offset().top-100
            }, 400);
        }else if (method == "" || method == " " || method == "0" || method == 0) {
            //Swal.fire('Gagal', 'Pilih metode pembayaran', 'error');
            showNotifications('Silahkan Pilih pembayaran');
            $('html, body').animate({
                scrollTop: $("#payment-method-option").offset().top-100
            }, 400);
        }else if (collapsewhatsapp.classList.contains('show')) {
            if (wa.length < 10 || wa.length > 14) {
                //Swal.fire('Gagal', 'Nomor Whatsapp tidak sesuai', 'error');
                showNotifications('No Whatsapp tidak sesuai');
                $('html, body').animate({
                    scrollTop: $("#contact_person").offset().top-100
                }, 400);
            } else {
                var data = {
                    target: target,
                    method: method,
                    product: product,
                    voucher: voucher,
                    wa: wa,
                    email: 'order@belanjagame.com',
                    jumlah:jumlah,
                };
                
               proses_ajaxs(data, product);
            }
        } else {
            if (collapseemail.classList.contains('show')) {
                if (email == "" || email == " ") {
                    //Swal.fire('Gagal', 'Email Harus diisi', 'error');
                    showNotifications('Email Harus diisi');
                    $('html, body').animate({
                        scrollTop: $("#contact_person").offset().top-100
                    }, 400);
                } else {
                    var data = {
                        target: target,
                        method: method,
                        product: product,
                        voucher: voucher,
                        wa: 0,
                        email: email,
                        jumlah:jumlah,
                    };
                    
                   proses_ajaxs(data, product);
                }
            }
        }
    }

}

function proses_ajaxs(data, product) {
    $.ajax({
        url: '<?= base_url(); ?>/games/order/get-detail/' + product,
        data: data,
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
            $(".eniv-loading").addClass('show');
        }, 
        success: function(result) {

            $(".eniv-loading").removeClass('show');

            if (result.status == true) {
                
                
                if(result.ganda_trx == false){
                 
                $("#eniv-modal-result").html(result.msg);
                
                modal_konfirmasi.show();
                   
                } else {
                    $("#eniv-modal-result2").html(result.msg);
                
                modal_ganda.show();
                    
                }
            } else {
                Swal.fire('Gagal', result.msg, 'error');
                // $(".target-input").addClass("is-invalid");
                // showFeedback()
            }
        }
    });
}

function proses_order() {
  
    $(".eniv-loading").addClass('show');
    
    $("#btn-order").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>').attr('disabled', 'disabled');
    
    setTimeout(function() {
        $("#form-order").submit();
    }, 1200);
}

function show_method(id) {
    
    var category = $("#method-category-" + id);
    
    if (category.hasClass('show')) {
        category.removeClass('show');
    } else {
        category.addClass('show');
    }
}

function show_category_product(no, num_of_category) {
    $(".menu-category-product-item").removeClass('activated-category-menu');
    $(".row-cat-product").hide();

    $("#row-cat-product-"+no).show();
    $("#cat-product-" +no).addClass('activated-category-menu');
    $("#cat-product-mobile-" +no).addClass('activated-category-menu');
}

function showNotifications(err_messg){
    $(".error_message p span").text(err_messg);
    $(".error_message").show(300);
    setTimeout(hideNotifications, 5000);
}

function hideNotifications(){
    $(".error_message").hide(300);
}

document.addEventListener('DOMContentLoaded', function () {
        const dropdown = document.getElementById('playerDropdown');
        console.log(dropdown);
        if (dropdown) {
            dropdown.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const gameId = selectedOption.getAttribute('data-game-id');
                const zoneId = selectedOption.getAttribute('data-zone-id');
                const serverId = selectedOption.getAttribute('data-server-id');
                const Id7 = selectedOption.getAttribute('data-id-7');
                const Id8 = selectedOption.getAttribute('data-id-8');
                
                const inputs = document.querySelectorAll('.games-input');

                // Isi input pertama dengan game_id dan input kedua dengan zone_id
                inputs[0].value = gameId || '';  // Input pertama adalah game_id
                inputs[1].value = zoneId || '';  // Input kedua adalah zone_id
                inputs[2].value = serverId || '';  // Input pertama adalah game_id
                inputs[3].value = Id7 || '';  // Input kedua adalah zone_id
                inputs[4].value = Id8 || '';  // Input kedua adalah zone_id
            });
        }
    });

</script>
<?php if (isset($_GET['product'])): ?>
	<?php if (is_numeric($_GET['product'])): ?>
	<script>
	select_product('<?= $_GET['product']; ?>');
	</script>
	<?php endif; ?>
<?php endif; ?>
<?php $this->endSection(); ?>
