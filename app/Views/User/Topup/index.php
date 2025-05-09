			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			
			<div class="eniv-content">
                <div class="container">
            		<div class="eniv-body">
            			<div class="row">
            				
                            <?= $this->Include('users'); ?>
    
            				<div class="col-md-9">
            					<div class="card">
            						<div class="card-body">
                                        <a href="<?= base_url(); ?>/user/topup/riwayat" class="float-end">
                                            <i class="fa fa-history me-2"></i>Riwayat Topup
                                        </a>
            							<h6 class="card-title"><?= $title; ?></h6>
            							<form action="" method="POST">
                                        <?= csrf_field(); ?> 
                                            <input type="hidden" name="method" value="0">
            								<div class="mb-3">
            									<label>Jumlah TopUp</label>
            									<input type="number" class="form-control" autocomplete="off" name="nominal">
            								</div>
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label>Metode Pembayaran</label>
                                                </div>
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
                                                    </div>
                                                    <?php endforeach ?>
                                                </div>
                                                <?php endforeach ?>
                                            </div>
                                            <div class="text-end">
                                                <a href="<?= base_url(); ?>/user" class="btn">Batal</a>
                                                <button class="btn btn-primary btn-auth" type="submit" name="tombol" value="submit">Topup Saldo</button>
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
			    function select_method(id) {
                    $(".eniv-method-item-list").removeClass('active');
                    $("#method-" + id).addClass('active');
    
                    $("input[name=method]").val(id);
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
			<?php $this->endSection(); ?>