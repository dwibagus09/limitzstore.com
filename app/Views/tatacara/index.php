            <?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<style>
				#datatable_wrapper {
					padding: 0;
				}
				#datatable_wrapper .row:nth-child(1), #datatable_wrapper .row:nth-child(3) {
					padding: 20px 15px;
				}
				label {
					color: #fff;
				}
                .angka {
                    background-color: #fff;
                    color: #000;
                    padding : 6px 13px;
                    border-radius : 100%;
                    margin-right: 10px;
                    display: inline-block;
                }
                .text-1 {
                    text-align: center;
                    font-family: 'Roboto', sans-serif;
                    font-size: 20px;
                }
                .img-fluid {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
                .card-title {
                    font-size: 18px;
                    text-transform: uppercase;
                }
                .deskripsi {
                    font-family: 'Helvetica', sans-serif;
                }
			</style>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
			    <div class="container">
			        <div class="row justify-content-center pt-4">
                    <?php $i=1; foreach ($head as $loop) { ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-5 text-wrap"><span class="angka"><b><?= $i; ?></b></span> <?= $loop['title'] ?></h5>
                                <div class="content-bro mb-4">
                                    <?php foreach ($array as $headData) { ?>
                                        <?php foreach ($headData as $item) { ?>
                                            <?php if ($item['type'] == 'image' && $item['tata_cara_head_id'] == $loop['id']) { ?>
                                                <img src="<?= base_url(); ?>/assets/images/tatacara/<?= $item['isi'] ?>" class="img-fluid mb-2" alt="Responsive image">
                                            <?php } elseif ($item['type'] == 'text' && $item['tata_cara_head_id'] == $loop['id']) { ?>
                                                <div class="deskripsi mb-3"><?= $item['isi'] ?></div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="deskripsi mb-3"><?= $loop['deskripsi'] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } ?>
			        </div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>