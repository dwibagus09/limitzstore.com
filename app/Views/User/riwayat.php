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
        							<h6 class="card-title"><?= $title; ?></h6>
                                    <div class="table-responsive eniv-parent-table-orders">
                                        <table class="table eniv-table-orders">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orders as $loop): ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?= base_url(); ?>/payment/<?= $loop['order_id']; ?>" class="d-block fw-500"><?= $loop['order_id']; ?></a>
                                                        <small class="text-muted"><?= $loop['date_create']; ?></small>
                                                    </td>
                                                    <td nowrap="">
                                                        <p class="mb-0 lh-20"><?= $loop['games']; ?></p>
                                                        <small class="text-muted"><?= $loop['product']; ?></small>
                                                    </td>
                                                    <td valign="middle" nowrap="">Rp <?= number_format($loop['price'],0,',','.'); ?></td>
                                                    <td valign="middle" align="right">
                                                        <span class="fw-500 text-<?= badge($loop['status']); ?>"><?= $loop['status']; ?></span>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
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
            $(".eniv-table-orders").dataTable({
                scrollX: true,
                ordering: false,
                lengthChange: false,
                pageLength: 5,
                language: { 
                    search: '',
                    paginate: {
                        next: '<i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i>'
                    }
                },
            });
        </script>
		<?php $this->endSection(); ?>