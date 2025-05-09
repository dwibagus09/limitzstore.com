            <?php $this->extend('template'); ?>
            
            <?php $this->section('css'); ?>
            <?php if(!$games['banner']) { ?>
             <style>
                .eniv-games-banner {
                    background-image: url(<?= base_url(); ?>/assets/images/games/<?= $games['image']; ?>);
                }
            </style>
            <?php }else { ?>
            <style>
                 .eniv-games-banner {
                    background-image: url(<?= base_url(); ?>/assets/images/games/banner/<?= $games['banner']; ?>);
                }
            </style>
             <?php } ?>
            <style>
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
                
                @media only screen and (max-width: 767px) {
                    .mobile-only {
                        display: none !important;
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
                <div class="eniv-games-banner">
                </div>
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
                            <div class="col-md-8">
                                <a class="btn btn-primary mb-4 desktop-only" style="border-radius: 5px !important;width: 100%;text-align: left; display: flex; justify-content: space-between;" data-bs-toggle="collapse" href="#keterangan" role="button" aria-expanded="false" aria-controls="keterangan" id="collapseBtn">
                                <span>Lihat Cara Transaksi</span>
                                <i class="fas fa-chevron-down" style="padding-top:5px;"></i>
                            </a>
                            <div class="collapse desktop-only" id="keterangan" aria-labelledby="collapseBtn">
                                <div class="card card-body eniv-card">
                                    <p><?= $games['content']; ?></p>
                                </div>
                            </div>
                            <div class="card">
                            <div class="card">
                            <div class="card-header bg-primary text-white" style="background-image: linear-gradient(to right, transparent 50px, var(--warna_2) 50px);">
                                <b style="font-size:17px;padding-left:5px;">1</b><span style="padding-left:40px;font-size:17px;">Pilih nominal</span>
                            </div>
                            <!-- other card content goes here -->
                            </div>
                                <div class="card-body eniv-product-area" style="padding-top:20px !important;margin-top:0px !important;">
                                    <?php foreach ($product as $product_loop): ?>
                                    <div class="row" style="padding:5px;">
                                        <div class="col-md-12">
                                            <b class="d-block mb-2"><?= $product_loop['category']; ?></b>
                                        </div>
                                        <?php foreach ($product_loop['product'] as $loop): ?>
                                        <div class="col-md-6 <?= $games['product_type'] == '2' ? 'col-6' : ''; ?>">
                                            <div class="eniv-product-item" id="product-<?= $loop['id']; ?>" onclick="select_product('<?= $loop['id']; ?>');">
                                                <div class="card" style="background: var(--warna);">
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
                            </div>
                            </div>
                            <div class="col-md-4" id="section-order">
                                
                                <input type="hidden" name="product" value="0">
                                <input type="hidden" name="method" value="0">
                                
                                 <div class="card mobile-only">
                                    <div class="card-body eniv-card">
                                    <p><?= $games['content']; ?></p>
                                </div>
                                </div>
                                
                                <?php if (count($target) == 1 && $target[0]['target'] != 'default'): ?>
                                <div class="card">
                                <div class="card-header bg-primary text-white" style="background-image: linear-gradient(to right, transparent 50px, var(--warna_2) 50px);">
                                <b style="font-size:17px;padding-left:5px;">2</b><span style="padding-left:40px;font-size:17px;">Masukan data akun</span>
                                </div>
                                    <div class="card-body eniv-card">
                                        <p class="fw-600 mb-3"><?= $target[0]['text']; ?></p>
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
                                        <div id="feedback" style="font-size:15px;text-transform: uppercase;margin-top:10px;color:#f03144;">
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

                                <div class="card" id="quantity">
                                    <div class="card-body eniv-card">
                                        <p class="fw-600 mb-3">Masukan Jumlah Total</p>
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
                                
                                <div class="card">
                                <div class="card-header bg-primary text-white" style="background-image: linear-gradient(to right, transparent 50px, var(--warna_2) 50px);">
                                <b style="font-size:17px;padding-left:5px;">3</b><span style="padding-left:40px;font-size:17px;">Pilih Pembayaran</span>
                                </div>
                                    <div class="card-body eniv-card">
                                        <p class="fw-600 mb-3">Pilih Pembayaran</p>
                                        
                                        <?php foreach ($method as $method_loop): ?>
                                        <div class="eniv-method-category" onclick="show_method('<?= $method_loop['id']; ?>');">
                                            <h1><?= $method_loop['category']; ?></h1>
                                            <div class="eniv-method-image-list">
                                                <?php foreach ($method_loop['method'] as $loop): ?>
                                                <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="">
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <div class="eniv-method-item" id="method-category-<?= $method_loop['id']; ?>">
                                            <?php foreach ($method_loop['method'] as $loop): ?>
                                            <div class="eniv-method-item-list" id="method-<?= $loop['id']; ?>" onclick="select_method('<?= $loop['id']; ?>');">
                                                <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="">
                                                <h1><?= $loop['method']; ?></h1>
                                                <h3><?= $loop['sub_title']; ?></h3>
                                                <h2>Rp 0</h2>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                        <?php endforeach ?>
                                        
                                        <?php if ($pay_balance == 'Y' AND $users !== false): ?>
                                        <div class="eniv-method-category" onclick="show_method('balance');">
                                            <h1>Saldo Akun</h1>
                                            <div class="eniv-method-image-list">
                                                <img src="<?= base_url(); ?>/assets/images/method/balance.png" alt="">
                                            </div>
                                        </div>
                                        <div class="eniv-method-item" id="method-category-balance">
                                            <div class="eniv-method-item-list" id="method-balance" onclick="select_method('balance');">
                                                <img src="<?= base_url(); ?>/assets/images/method/balance.png" alt="">
                                                <h1>Saldo Akun</h1>
                                                <h2>Rp 0</h2>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card">
                                <div class="card-header bg-primary text-white" style="background-image: linear-gradient(to right, transparent 50px, var(--warna_2) 50px);">
                                <b style="font-size:17px;padding-left:5px;">4</b><span style="padding-left:40px;font-size:17px;">Masukan Voucher</span>
                                </div>
                                    <div class="card-body eniv-card">
                                        <p class="fw-600 mb-3">Kode Voucher</p>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Optional" autocomplete="off" name="voucher">
                                        </div>
                                        <button class="btn btn-primary w-100 btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalpromo">Voucher Tersedia</button>
                                    </div>
                                </div>
                               <div class="card">
                               <div class="card-header bg-primary text-white" style="background-image: linear-gradient(to right, transparent 50px, var(--warna_2) 50px);">
                                <b style="font-size:17px;padding-left:5px;">5</b><span style="padding-left:40px;font-size:17px;">Konfirmasi Pembelian</span>
                                </div>
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
                                <div class="eniv-order-btn mb-4">
                                    <button class="btn btn-primary btn-auth w-100" type="button" onclick="process_order();">Konfirmasi Pesanan <i class="fa fa-arrow-right ms-2"></i></button>
                                </div>
                                <div class="card">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71" fill="none">
                                        <rect x="0.5" y="0.875" width="70" height="70" rx="35" fill="#0E101C"/>
                                        <path d="M25.5175 42.6133L22.2467 21.3753H20.25C19.7859 21.3753 19.3408 21.1909 19.0126 20.8627C18.6844 20.5345 18.5 20.0894 18.5 19.6253C18.5 19.1612 18.6844 18.716 19.0126 18.3879C19.3408 18.0597 19.7859 17.8753 20.25 17.8753H23.7238C24.1459 17.8675 24.5565 18.0137 24.8787 18.2865C25.2095 18.5647 25.4253 18.9557 25.4843 19.3838L26.0582 23.1253H39.5V26.6253H26.5972L28.7498 40.6253H45.198L47.823 31.8753H51.477L48.1765 42.8775C48.0684 43.2382 47.847 43.5544 47.545 43.7792C47.2429 44.0039 46.8765 44.1253 46.5 44.1253H27.278C26.8439 44.1333 26.4224 43.9785 26.0968 43.6913C25.7794 43.4138 25.5731 43.0309 25.5157 42.6133H25.5175ZM32.5 49.3753C32.5 50.3036 32.1313 51.1938 31.4749 51.8502C30.8185 52.5065 29.9283 52.8753 29 52.8753C28.0717 52.8753 27.1815 52.5065 26.5251 51.8502C25.8687 51.1938 25.5 50.3036 25.5 49.3753C25.5 48.447 25.8687 47.5568 26.5251 46.9004C27.1815 46.244 28.0717 45.8753 29 45.8753C29.9283 45.8753 30.8185 46.244 31.4749 46.9004C32.1313 47.5568 32.5 48.447 32.5 49.3753ZM48.25 49.3753C48.25 50.3036 47.8813 51.1938 47.2249 51.8502C46.5685 52.5065 45.6783 52.8753 44.75 52.8753C43.8217 52.8753 42.9315 52.5065 42.2751 51.8502C41.6187 51.1938 41.25 50.3036 41.25 49.3753C41.25 48.447 41.6187 47.5568 42.2751 46.9004C42.9315 46.244 43.8217 45.8753 44.75 45.8753C45.6783 45.8753 46.5685 46.244 47.2249 46.9004C47.8813 47.5568 48.25 48.447 48.25 49.3753ZM48.25 17.8753C48.7141 17.8753 49.1593 18.0597 49.4874 18.3879C49.8156 18.716 50 19.1612 50 19.6253V21.3753H51.75C52.2141 21.3753 52.6592 21.5597 52.9874 21.8879C53.3156 22.216 53.5 22.6612 53.5 23.1253C53.5 23.5894 53.3156 24.0345 52.9874 24.3627C52.6592 24.6909 52.2141 24.8753 51.75 24.8753H50V26.6253C50 27.0894 49.8156 27.5345 49.4874 27.8627C49.1593 28.1909 48.7141 28.3753 48.25 28.3753C47.7859 28.3753 47.3407 28.1909 47.0126 27.8627C46.6844 27.5345 46.5 27.0894 46.5 26.6253V24.8753H44.75C44.2859 24.8753 43.8407 24.6909 43.5126 24.3627C43.1844 24.0345 43 23.5894 43 23.1253C43 22.6612 43.1844 22.216 43.5126 21.8879C43.8407 21.5597 44.2859 21.3753 44.75 21.3753H46.5V19.6253C46.5 19.1612 46.6844 18.716 47.0126 18.3879C47.3407 18.0597 47.7859 17.8753 48.25 17.8753Z" fill="#00E59B"/>
                                    </svg>
                                </div>
                                <h1 class="fs-18 fw-600">Informasi Pembelian</h1>
                            </div>
                            <p class="text-muted">Pastikan data pesanan Anda sudah benar.</p>
                            <h2 class="fs-16">Detail Player</h2>
                            <hr class="my-3">
                            <div id="eniv-modal-result"></div>
                            <p class="text-muted mb-3">Dengan melakukan pembelian ini, anda telah menyetujui Syarat & Ketentuan dan Kebijakan Privasi yang berlaku.</p>
                            <div class="text-center">
                                <button type="button" class="btn btn-auth me-2" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-auth btn-primary" onclick="proses_order();">Bayar Sekarang</button>
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
                            <?php foreach ($voucher as $loop): ?>
                            <?php
                            
                            $level_next = false;
                                                    
                            $my_level = 'Guest';
                            if ($users !== false) {
                                $my_level .= ',' . $users['level'];
                            }
                            
                            foreach (array_filter(explode(',', $loop['level'])) as $voucher_level) {
                                
                                if (in_array($voucher_level, explode(',', $my_level))) {
                                    
                                    $level_next = true;
                                }
                            }
                            
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
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endSection(); ?>

            <?php $this->section('footer'); ?>
            <div class="col-md-12 mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-4">Top Up Game dan Voucher <?= $footercategory['category'] ?></h6>
                                <?php foreach ($footer as $loop): ?>
                                <span class="badge badge-primary mb-2" style="background:var(--warna_3) !important;"> <a href="<?= base_url() ?>/games/<?= $loop['slug'] ?>" style="border-radius: 0 !important;font-size:13px;color: var(--text_2) !important;"><?= $loop['games'] ?></a></span>
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
                    $("#feedback").hide();
                });
            
                // To show the div
                function showFeedback() {
                    $("#feedback").show();
                }
            
                // To hide the div
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
                $(document).ready(function() {
                    $('#quantity').hide();
                });

                var modal_promo = new bootstrap.Modal(document.getElementById('modalpromo'));
                var modal_konfirmasi = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));
                
                function select_voucher(voucher) {
                    
                    $("input[name=voucher]").val(voucher);
                    
                    modal_promo.hide();
                }
                
                
           function select_product(id) {
    $('html, body').animate({
        scrollTop: $("#section-order").offset().top
    }, 400);

    $(".eniv-product-item").removeClass('active');
    $("#product-" + id).addClass('active');

    $("input[name=product]").val(id);

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
        }
        updateTotal(id, $('#jumlah').val());
    });
    
    $('#increase').off().on('click', function() {
        $('#jumlah').val(parseInt($('#jumlah').val()) + 1);
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
                }
            }
        });
    }
}
                
                function select_method(id) {
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

                    if (checktarget == true) {
                        if (target == '' || target == ' ') {
                        Swal.fire('Gagal', 'ID Player harus diisi', 'error');
                        }
                    }
                    if (product == '' || product == ' ') {
                        Swal.fire('Gagal', 'Nominal produk harus dipilih', 'error');
                    } else if (method == '' || method == ' ') {
                        Swal.fire('Gagal', 'Pilih metode pembayaran', 'error');
                    } else if (jumlah < 1) {
                        Swal.fire('Gagal', 'Jumlah minimal 1', 'error'); 
                        
                    } 
                    if (collapsewhatsapp.classList.contains('show')) {
                        if (wa.length < 10 || wa.length > 14) {
                            Swal.fire('Gagal', 'Nomor Whatsapp tidak sesuai', 'error');
                        } else {
                                var data = {
                                    target: target,
                                    method: method,
                                    product: product,
                                    voucher: voucher,
                                    wa: wa,
                                    email: 'order@lapaksurf.com',
                                    jumlah:jumlah,
                                };
                                
                               proses_ajaxs(data, product);
                        }
                    } else {
                        if (collapseemail.classList.contains('show')) {
                            if (email == '' || email == ' ') {
                            Swal.fire('Gagal', 'Email Harus diisi', 'error');
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
                                                
                                                $("#eniv-modal-result").html(result.msg);
                                                
                                                modal_konfirmasi.show();
                                                
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
            </script>
            <?php if (isset($_GET['product'])): ?>
            <?php if (is_numeric($_GET['product'])): ?>
            <script>
                select_product('<?= $_GET['product']; ?>');
            </script>
            <?php endif; ?>
            <?php endif; ?>
            <?php $this->endSection(); ?>