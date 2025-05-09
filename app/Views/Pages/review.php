		<?php $this->extend('template'); ?>
		
		<?php $this->section('css'); ?>
		<?php $this->endSection(); ?>
		
		<?php $this->section('content'); ?>
        <div class="eniv-content">
            <div class="container">
        		<div class="eniv-body">
					<div class="text-center mb-4">
                    	<h6 class="fs-18">PENILAIAN SETIAP PESANAN</h6>
                    	<p>Pendapat tentang pesanan mereka</p>
                    </div>
        			<div class="row">
        			    <?php foreach ($review as $loop): ?>
        				<div class="col-md-6">
		                    <div class="card">
		                        <div class="card-body p-4">
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
		                    </div>
        				</div>
        				<?php endforeach; ?>
        			</div>
        		</div>
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
		<?php $this->endSection(); ?>