<?php $this->extend('template'); ?>
            
            <?php $this->section('css'); ?>
            <?php $this->endSection(); ?>
            
            <?php $this->section('content'); ?>
            <style>
                .card {
                    border: 1px solid rgba(174,174,174,.5);
                }
                /*.m-0 {*/
                /*    color : #767676;*/
                /*}*/
                /*.mb-0 {*/
                /*    color : #767676;*/
                /*}*/
                .nominal-price {
                    font-size: 9px;
                    text-align: left;
                }
                .name-prod {
                    color: #ffffff;
                    text-align: left;
                }
                .icon-diamond {
                    bottom: 0%;
                    right: 5%;
                    position: absolute;
                }
                .radio-nominal-payment {
                    color: #767676;
                    display: none;
                    margin: 10px;
                    cursor: pointer;
                }
                                
                .radio-nominal-payment + label {
                    text-align: left;
                    color: #767676;
                    display: inline-block;
                    padding: 13px;
                    background-color: #1f2a36;
                    cursor: pointer;
                    border-radius: 5px;
                    width: 100%;
                    font-size: 10px;
                }
                .radio-nominal-payment + label, .radio-nominal-payment + label {
                    background: #d0d0d0;
                    filter: grayscale(100%);
                }
                .radio-nominalepayment:checked + label, .radio-nominal-payment:checked + label {
                    background: #e8e8e8;
                    filter: grayscale(0%);
                    border: 1px solid #2f2fd5;
                }
            </style>
            <div class="clearfix pt-5"></div>
            <div class="pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="text-center pt-3 pb-2">
                                <img src="<?= base_url(); ?>/assets/images/games/<?= $games['image']; ?>" class="mb-3" style="display: block; margin: 0 auto; border-radius: 10px !important;" width="120px" height="120px">
                                <h5></h5>
                            </div>
                            <div class="pb-3">
                                <?= $games['content']; ?>
                            </div>
                        </div>
                        <div class="col-sm-9">

                            <?= alert(); ?>
                            
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardUser">
                                        <div class="text-white text-center position-absolute circle-primary">1</div>
                                        <h5 style="margin-left: 45px; margin-top: 5px;" id="cardUserFont">Input Data Game</h5>
                                        <?= $this->include('Target/' . $games['target']); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $nominal = '2';
                            $payment_method = '3';
                            $confirmation = '4';
                            if ($games['slug'] === 'promo-diamond-slow') { 
                                $nominal = '3';
                                $payment_method = '4';
                                $confirmation = '5'; ?>
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardDetailLogin">
                                        <div class="text-white text-center position-absolute circle-primary">2</div>
                                        <h5 style="margin-left: 45px; margin-top: 5px; padding-bottom: 15px;" id="cardUserFont">Lengkapi Data</h5>
                                        <div class="form-group">
                                            <label class="text-white">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Jenis Login</label>
                                            <select class="form-control" name="login_type" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Moonton">Moonton</option>\
                                                <option value="FB">FB</option>
                                                <option value="VK">VK</option>
                                                <option value="Tiktok">Tiktok</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } else if ($games['slug'] === 'promo-gift-skin') {
                                $nominal = '3';
                                $payment_method = '4';
                                $confirmation = '5'; ?>
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardDetailLogin">
                                        <div class="text-white text-center position-absolute circle-primary">2</div>
                                        <h5 style="margin-left: 45px; margin-top: 5px; padding-bottom: 15px;" id="cardUserFont">Lengkapi Data</h5>
                                        <div class="form-group">
                                            <label class="text-white">Nickname</label>
                                            <input type="text" class="form-control" name="nickname" placeholder="Masukkan Nickname" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Nama Hero</label>
                                            <input type="text" class="form-control" name="hero" placeholder="Masukkan Nama Hero" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Nama Skin</label>
                                            <input type="text" class="form-control" name="skin" placeholder="Masukkan Nama Skin" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } else if ($games['slug'] === 'joki-ranked-mobile-legends') {
                                $nominal = '3';
                                $payment_method = '5';
                                $confirmation = '6'; ?>
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardDetailLogin">
                                        <div class="text-white text-center position-absolute circle-primary">2</div>
                                        <h5 style="margin-left: 45px; margin-top: 5px; padding-bottom: 15px;" id="cardUserFont">Lengkapi Data</h5>
                                        <div class="form-group">
                                            <label class="text-white">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Hero</label>
                                            <input type="text" class="form-control" name="hero" placeholder="Masukkan Minimal 3 Request Hero" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white">Jenis Login</label>
                                            <select class="form-control" name="login_type" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Moonton">Moonton</option>\
                                                <option value="FB">FB</option>
                                                <option value="VK">VK</option>
                                                <option value="Tiktok">Tiktok</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardLayanan">
                                        <div class="text-white text-center position-absolute circle-primary" id="cardLayananNumber"><?php echo $nominal; ?></div>
                                        <h5 style="margin-left: 45px; margin-top: 5px;" id="cardLayananFont">Pilih Nominal Layanan</h5>
                                        <div class="row pt-3 pl-2 pr-2 mb-2">
                                            <?php if (count($product) == 0): ?>
                                            <div class="col-12">
                                                <div class="alert alert-warning alert-dismissible mt-2 mb-0" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <div class="alert-icon">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                    </div>
                                                    <div class="alert-message">
                                                        <strong>Information!</strong> Produk sedang tidak tersedia.
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif ?>
                                            <?php foreach ($product as $loop): ?>
                                            <div class="col-sm-4 col-6">
                                                <input type="radio" id="product-<?= $loop['id']; ?>" class="radio-nominale" name="product" value="<?= $loop['id']; ?>" onchange="get_price(this.value);">
                                                <label for="product-<?= $loop['id']; ?>">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col name-prod"><?= $loop['product']; ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col nominal-price">
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
                                                                    Rp <?= number_format($product_price,0,".","."); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if ($loop['logo_url'] != '') {?>
                                                        <div class="col-lg-3 col-1 m-auto">
                                                            <img src="<?= $loop['logo_url']; ?>" width="32" class="icon-diamond">
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    </label>
                                                
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($games['slug'] === 'joki-ranked-mobile-legends') { ?>
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body">
                                        <div class="text-white text-center position-absolute circle-primary">4</div>
                                        <h5 style="margin-left: 45px; margin-top: 5px; padding-bottom: 15px;">Masukkan Jumlah (Star/Poin)</h5>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="star" placeholder="Masukkan Jumlah (Star/Poin)" required>
                                            <span class="text-white">Minimal Order Untuk Rank { (GM/Epic/Legend) = 5 Star , (Mythic+) = 30 Point } Jika Kurang Dari Minimal order maka uang akan hangus -Farhan Surf Store</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- <div class="pb-3">
                                <div class="section">
                                    <div class="card-body">
                                        <div class="text-white text-center position-absolute circle-primary">3</div>
                                        <h5 style="margin-left: 45px; margin-top: 5px;">Pilih Pembayaran</h5>
                                        <div class="row pt-3 pl-2 pr-2 mb-2">

                                            <?php if ($pay_balance === 'Y'): ?>
                                            <div class="col-sm-12 col-12">
                                                <input class="radio-nominal" type="radio" name="method" value="balance" id="method-balance">
                                                <label for="method-balance">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="ml-2 mr-2 pb-0">
                                                                <img src="<?= base_url(); ?>/assets/images/method/balance.png" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                <p class="m-0" style="font-weight: normal;">Saldo Akun</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2 mt-2 text-right">
                                                                <p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-balance"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <?php endif ?>

                                            <?php foreach ($method as $loop): ?>
                                            <div class="col-sm-12 col-12">
                                                <input class="radio-nominal" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
                                                <label for="method-<?= $loop['id']; ?>">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="ml-2 mr-2 pb-0">
                                                                <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                <p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="ml-2 mt-2 text-right">
                                                                <p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardPayment">
                                        <div class="text-white text-center position-absolute circle-primary"><?php echo $payment_method; ?></div>
                                        <h5 style="margin-left: 45px; margin-top: 5px;" id="cardPaymentFont">Pilih Metode Pembayaran</h5>
                                        <div class="row pt-3 pl-2 pr-2 mb-2">
                                            <div class="col-sm-12 col-12">
                                                <div class="accordion" id="accordionExample">
                                                    
                                                    <div class="card">
                                                        <div class="card-header text-white" id="headingTwo" style="background: rgba(235,235,235,.035);">
                                                            <div class="collapsed" data-toggle="collapse" data-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5" onclick="hiddenIcon('BT')"><i class="fa fa-bank"></i>
                                                                Bank Transfer                                                                
                                                                <span class="float-right" id="coll-bank-transfer"></span>
                                                            </div>
                                                        </div>
                                                        <div id="collapse-5" class="collapse pt-2" aria-labelledby="headingTwo" data-parent="#accordionExample" style="padding: 10px">
                                                        <?php foreach ($method as $loop): ?>
                                                            <?php if($loop['type'] == 'BT'):?>
                                                            <input class="radio-nominal-payment" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
                                                            <label for="method-<?= $loop['id']; ?>">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="ml-2 mr-2 pb-0">
                                                                            <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                            <p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2 mt-2 text-right">
                                                                            <p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        </div>
                                                        <div class="text-right pb-1 pt-2 pr-2" style="background: rgba(174,174,174,.261);" data-toggle="collapse" data-target="#collapse-5" aria-controls="collapse-5" onclick="hiddenIcon('BT')">
                                                            <div id="imgBT">
                                                            <?php foreach ($method as $loop): ?>
                                                                <?php if($loop['type'] == 'BT'):?>
                                                                    <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 20px;" id="<?= $loop['method']; ?>">
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card">
                                                        <div class="card-header text-white" id="headingTwo" style="background: rgba(235,235,235,.035);">
                                                            <div class="collapsed" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3" onclick="hiddenIcon('WALLET')"><i class="fa fa-shopping-bag"></i>
                                                                E-Wallet                                                                
                                                                <span class="float-right" id="coll-dompet-digital"></span>
                                                            </div>
                                                        </div>
                                                        <div id="collapse-3" class="collapse pt-2" aria-labelledby="headingTwo" data-parent="#accordionExample" style="padding: 10px">
                                                        <?php foreach ($method as $loop): ?>
                                                            <?php if($loop['type'] == 'WALLET'):?>
                                                            <input class="radio-nominal-payment" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
                                                            <label for="method-<?= $loop['id']; ?>">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="ml-2 mr-2 pb-0">
                                                                            <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                            <p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2 mt-2 text-right">
                                                                            <p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        </div>
                                                        <div class="text-right pb-1 pt-2 pr-2" style="background: rgba(174,174,174,.261);" data-toggle="collapse" data-target="#collapse-3" aria-controls="collapse-3" onclick="hiddenIcon('WALLET')">
                                                            <div id="imgWALLET">
                                                            <?php foreach ($method as $loop): ?>
                                                                <?php if($loop['type'] == 'WALLET'):?>
                                                                    <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 20px;"id="<?= $loop['method']; ?>">
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card">
                                                        <div class="card-header text-white" id="headingTwo" style="background: rgba(235,235,235,.035);">
                                                            <div class="collapsed" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4" onclick="hiddenIcon('VA')"><i class="fa fa-credit-card"></i>
                                                                Virtual Account                                                                
                                                                <span class="float-right" id="coll-virtual-account"></span>
                                                            </div>
                                                        </div>
                                                        <div id="collapse-4" class="collapse pt-2" aria-labelledby="headingTwo" data-parent="#accordionExample" style="padding: 10px">
                                                        <?php foreach ($method as $loop): ?>
                                                            <?php if($loop['type'] == 'VA'):?>
                                                            <input class="radio-nominal-payment" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
                                                            <label for="method-<?= $loop['id']; ?>">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="ml-2 mr-2 pb-0">
                                                                        <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                        <p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="ml-2 mt-2 text-right">
                                                                        <p class="mb-0" style="font-weight: bold; font-size: 13px; " id="price-method-<?= $loop['id']; ?>"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </label>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        </div>
                                                        <div class="text-right pb-1 pt-2 pr-2" style="background: rgba(174,174,174,.261);" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4" onclick="hiddenIcon('VA')">
                                                            <div id="imgVA">
                                                            <?php foreach ($method as $loop): ?>
                                                                <?php if($loop['type'] == 'VA'):?>
                                                                    <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 20px;" id="<?= $loop['method']; ?>">
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card">
                                                        <div class="card-header text-white" id="headingTwo" style="background: rgba(235,235,235,.035);">
                                                            <div class="collapsed" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2" onclick="hiddenIcon('CS')"><i class="fa fa-institution"></i>
                                                                Convenience Store                                                             
                                                                <span class="float-right" id="coll-convenience-store"></span>
                                                            </div>
                                                        </div>
                                                        <div id="collapse-2" class="collapse pt-2" aria-labelledby="headingTwo" data-parent="#accordionExample" style="padding: 10px">
                                                        <?php foreach ($method as $loop): ?>
                                                            <?php if($loop['type'] == 'CS'):?>    
                                                            <input class="radio-nominal-payment" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
                                                            <label for="method-<?= $loop['id']; ?>">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="ml-2 mr-2 pb-0">
                                                                        <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                        <p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="ml-2 mt-2 text-right">
                                                                        <p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </label>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                        </div>
                                                        <div class="text-right pb-1 pt-2 pr-2" style="background: rgba(174,174,174,.261);" data-toggle="collapse" data-target="#collapse-2" aria-controls="collapse-2" onclick="hiddenIcon('CS')">
                                                            <div id="imgCS">
                                                            <?php foreach ($method as $loop): ?>
                                                                <?php if($loop['type'] == 'CS'):?>
                                                                    <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 20px;" id="<?= $loop['method']; ?>">
                                                                <?php endif ?>
                                                            <?php endforeach ?>   
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php if ($pay_balance === 'Y'): ?>
                                                    <div class="card">
                                                        <div class="card-header text-white" id="headingTwo" style="background: rgba(235,235,235,.035);">
                                                            <div class="collapsed" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1" onclick="hiddenIcon('SALDO')"><i class="fa fa-bolt"></i>
                                                                Surf Pay                                                                
                                                                <span class="float-right" id="coll-bank-transfer-bisa-transfer-dari-bankewallet-apapun-bri-bni-dana-dll"></span>
                                                            </div>
                                                        </div>
                                                        <div id="collapse-1" class="collapse pt-2" aria-labelledby="headingTwo" data-parent="#accordionExample" style="padding: 10px">
                                                            <input class="radio-nominal-payment" type="radio" name="method" value="balance" id="method-balance">
                                                            <label for="method-balance">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="ml-2 mr-2 pb-0">
                                                                            <?php
                                                                                $img = '';
                                                                                if($users['level'] == 'Gold') {$img = 'balance-gold-surf.png'; }else{ $img = 'balance-silver-surf.png';}
                                                                            ?>
                                                                            <img src="<?= base_url(); ?>/assets/images/method/<?= $img ?>" class="rounded img-fluid mb-1" style="height: 40px;">
                                                                            <p class="m-0" style="font-weight: normal;">Saldo Akun</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="ml-2 mt-2 text-right">
                                                                            <p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-balance"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="text-right pb-1 pt-2 pr-2" style="background: rgba(174,174,174,.261);" data-toggle="collapse" data-target="#collapse-1" aria-controls="collapse-1" onclick="hiddenIcon('SALDO')">
                                                            <img src="<?= base_url(); ?>/assets/images/method/balance.png" class="rounded img-fluid mb-1" style="height: 20px;" id="saldoAccount">
                                                        </div>
                                                    </div>
                                                    <?php endif ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-3">
                                <div class="section">
                                    <div class="card-body" id="cardKonfirm">
                                        <div class="text-white text-center position-absolute circle-primary"><?php echo $confirmation; ?></div>
                                        <h5 style="margin-left: 45px; margin-top: 5px;" id="cardKonfirmFont">Konfirmasi Pesanan</h5>
                                        <div class="form-group pt-3">

                                            <input type="text" name="wa" placeholder="Masukan No. Whatsapp" class="form-control" value="" style="border: 1px solid #ced4da;" required>

                                            <small class="mt-2 d-block mb-3">
                                                Dengan membeli otomatis saya menyutujui <a href="<?= base_url(); ?>/syarat-ketentuan/" target="_blank" class="text-warning">Ketentuan Layanan</a>.
                                            </small>
                                            <button type="button" class="btn btn-primary text-white" onclick="process_order();">Beli Sekarang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-detail">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-white animated bounceIn" style="background: var(--warna_2);">
                                        <div class="card-header border-bottom-0">
                                            <h5 class="text-white">Detail Pembelian</h5>
                                        </div>
                                        <div class="modal-body table-responsive pt-0">
                                            
                                        </div>
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
                $("#formorder").modal('show');
                
                <?php
                // NEW UPDATE
                // if ($games['target'] == 'gi') {
                ?>
                // $('select[name=server]').change(function () {
                //     var server = $(this).val();
                //     var user_id = $('input[name=user_id]').val();
                    
                //     user_id = user_id.replace(/001/, '');
                //     user_id = user_id.replace(/002/, '');
                //     user_id = user_id.replace(/003/, '');
                //     user_id = user_id.replace(/004/, '');
                    
                //     $('input[name=user_id]').val(server + user_id);
                // });
                <?php
                // }
                // END NEW UPDATE
                ?>

                function get_price(id, star = null) {
                    $.ajax({
                        url: '<?= base_url(); ?>/games/order/get-price/' + id,
                        dataType: 'JSON',
                        success: function(result) {
                            <?php if ($games['slug'] === 'joki-ranked-mobile-legends') { ?>
                            star = star === null ? parseInt($('input[name=star]').val()) : star;
                            for (let price in result) {
                                var format_price = result[price].price.replace('.', '');
                                format_price = format_price*star;
                                $("#price-method-" + result[price].method).text(format_price.toLocaleString("id-ID", {style:"currency", currency:"IDR"}).replace(',00', ''));
                            }
                            <?php } else { ?>
                            for (let price in result) {
                                $("#price-method-" + result[price].method).text('Rp ' + result[price].price);
                            }
                            <?php } ?>
                        }
                    });
                }
                
                $('input[name=star]').change(function () {
                    var star = $(this).val();
                    if (star !== '' || star !== 0) {
                        get_price($('[name=product]').val(), star);
                    }
                });

                function process_order() {
                    var user_id = $("input[name=user_id]").val();
                    var zone_id = $("input[name=zone_id]").val();
                    
                    <?php if ($games['slug'] === 'promo-diamond-slow') { ?>
                    var email = $("input[name=email]").val();
                    var password = $("input[name=password]").val();
                    var login_type= $("select[name=login_type]").val();
                    <?php } else if ($games['slug'] === 'promo-gift-skin') { ?>
                    var nickname = $("input[name=nickname]").val();
                    var hero = $("input[name=hero]").val();
                    var skin = $("input[name=skin]").val();
                    <?php } else if ($games['slug'] === 'joki-ranked-mobile-legends') { ?>
                    var email = $("input[name=email]").val();
                    var password = $("input[name=password]").val();
                    var hero = $("input[name=hero]").val();
                    var login_type= $("select[name=login_type]").val();
                    var star = $("input[name=star]").val();
                    <?php } ?>

                    var product = $("input[name=product]:checked").val();
                    var method = $("input[name=method]:checked").val();

                    var wa = $("input[name=wa]").val();

                    if (user_id == '' || user_id == ' ') {
                        Swal.fire('Gagal', 'ID Player harus diisi', 'error');
                    } else if (zone_id == '' || zone_id == ' ') {
                        Swal.fire('Gagal', 'ID Player harus diisi', 'error');
                    <?php if ($games['slug'] === 'promo-diamond-slow') { ?>
                    } else if (email == '' || email == ' ') {
                        Swal.fire('Gagal', 'Email harus diisi', 'error');
                    } else if (password == '' || password == ' ') {
                        Swal.fire('Gagal', 'Password harus diisi', 'error');
                    } else if (login_type == '' || login_type == ' ') {
                        Swal.fire('Gagal', 'Jenis Login harus dipilih', 'error');
                    <?php } else if ($games['slug'] === 'promo-gift-skin') { ?>
                    } else if (nickname == '' || nickname == ' ') {
                        Swal.fire('Gagal', 'Nickname harus diisi', 'error');
                    } else if (hero == '' || hero == ' ') {
                        Swal.fire('Gagal', 'Nama Hero harus diisi', 'error');
                    } else if (skin == '' || skin == ' ') {
                        Swal.fire('Gagal', 'Nama Skin harus diisi', 'error');
                    <?php } else if ($games['slug'] === 'joki-ranked-mobile-legends') { ?>
                    } else if (email == '' || email == ' ') {
                        Swal.fire('Gagal', 'Email harus diisi', 'error');
                    } else if (password == '' || password == ' ') {
                        Swal.fire('Gagal', 'Password harus diisi', 'error');
                    } else if (hero == '' || hero == ' ') {
                        Swal.fire('Gagal', 'Hero harus diisi', 'error');
                    } else if (login_type == '' || login_type == ' ') {
                        Swal.fire('Gagal', 'Jenis Login harus dipilih', 'error');
                    } else if (star == '' || star == ' ') {
                        Swal.fire('Gagal', 'Star/Poin harus diisi', 'error');
                    <?php } ?>
                    } else if (product == '' || product == ' ') {
                        Swal.fire('Gagal', 'Nominal produk harus dipilih', 'error');
                    } else if (method == '' || method == ' ') {
                        Swal.fire('Gagal', 'Pilih metode pembayaran', 'error');
                    } else if (wa.length < 10 || wa.length > 14) {
                        Swal.fire('Gagal', 'Nomor Whatsapp tidak sesuai', 'error');
                    } else {
                        <?php if ($games['slug'] === 'promo-diamond-slow') { ?>
                        var data = {
                            user_id: user_id,
                            zone_id: zone_id,
                            email: email,
                            password: password,
                            login_type: login_type,
                            product: product,
                            method: method,
                            wa: wa
                        };
                        <?php } else if ($games['slug'] === 'promo-gift-skin') { ?>
                        var data = {
                            user_id: user_id,
                            zone_id: zone_id,
                            nickname: nickname,
                            hero: hero, 
                            skin: skin,
                            product: product,
                            method: method,
                            wa: wa
                        };
                        <?php } else if ($games['slug'] === 'joki-ranked-mobile-legends') { ?>
                        var data = {
                            user_id: user_id,
                            zone_id: zone_id,
                            email: email,
                            password: password,
                            login_type: login_type,
                            hero: hero,
                            star: star,
                            product: product,
                            method: method,
                            wa: wa
                        };
                        <?php } else { ?>
                        var data = {
                            user_id: user_id,
                            zone_id: zone_id,
                            method: method,
                            product: product,
                            wa: wa
                        };
                        <?php } ?>
                        
                        $.ajax({
                            url: '<?= base_url(); ?>/games/order/get-detail/' + product,
                            data: data,
                            type: 'POST',
                            dataType: 'JSON',
                            beforeSend: function() {
                                Swal.showLoading();
                            }, 
                            success: function(result) {

                                Swal.hideLoading();

                                if (result.status == true) {
                                    // $("#modal-detail div div .modal-body").html(result.msg);

                                    

                                    // $("#modal-detail").modal('show');

                                    // show result in swal without confirm button cause it's already in modal
                                    Swal.fire({
                                        title: 'Detail Pesanan',
                                        html: result.msg,
                                        showConfirmButton: false,
                                        showCancelButton: false,
                                        showCloseButton: true,
                                        allowOutsideClick: true,
                                        allowEscapeKey: false,
                                        allowEnterKey: false,
                                        stopKeydownPropagation: false,
                                        onOpen: function() {
                                            $("#modal-detail").modal('show');
                                        }
                                    });

                                 

                                } else {
                                    Swal.fire('Gagal', result.msg, 'error');
                                }
                            }
                        });
                    }
                }
                
                function openPaymentDrawer(elem) {
                    var $this = $(elem);
                    console.log($this.parents('.collapse'));
                    $("#icon").addClass('d-none');
                }
                
                function hiddenIcon(type){
                    console.log(type);
                    var imgBT       = document.getElementById("imgBT");
                    var imgVA       = document.getElementById("imgVA");
                    var imgCS       = document.getElementById("imgCS");
                    var imgWALLET   = document.getElementById("imgWALLET");
                    var SALDO_ACCOUNT   = document.getElementById("saldoAccount");
                    
                    if (type === 'BT') {
                        imgBT.classList.toggle("d-none");
                    }
                        
                    if (type === 'VA') {
                        imgVA.classList.toggle("d-none");
                    }
                    
                    if (type === 'CS') {
                        imgCS.classList.toggle("d-none");
                    }
                    
                    if (type === 'WALLET') {
                        imgWALLET.classList.toggle("d-none");
                    }
                    
                    if (type === 'SALDO') {
                        SALDO_ACCOUNT.classList.toggle("d-none");
                    }
                }
                
                function proses_order() {
                    
                    $("#btn-order").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>').attr('disabled', 'disabled');
                    
                    setTimeout(function() {
                        $("#form-order").submit();
                    }, 1200);
                }
            </script>
            <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous">
    </script>
            <?php $this->endSection(); ?>