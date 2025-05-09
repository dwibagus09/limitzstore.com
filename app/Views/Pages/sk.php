		<?php $this->extend('template'); ?>
		
		<?php $this->section('css'); ?>
		<?php $this->endSection(); ?>
		
		<?php $this->section('content'); ?>
        <div class="eniv-content">
            <div class="container">
        		<div class="eniv-body">
        			<div class="row justify-content-center">
        				<div class="col-md-10">
        					<div class="text-center mb-4">
		                    	<h6 class="fs-18">SYARAT & KETENTUAN</h6>
		                    </div>
		                    <?= $page_sk; ?>
        				</div>
        			</div>
        		</div>
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
		<?php $this->endSection(); ?>