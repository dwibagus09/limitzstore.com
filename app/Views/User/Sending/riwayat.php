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
							<h6 class="card-title">
                                <a href="<?= base_url(); ?>/user">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <?= $title; ?>
                            </h6>
                            <div class="table-responsive eniv-parent-table-orders">
                                <table class="table eniv-table-orders">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transaction as $loop): ?>
                                        <tr>
                                            <td nowrap=""><small class="text-muted"><?= $loop['created']; ?></small></td>
                                            <td><a href="<?= base_url(); ?>/user/riwayat-transfer/<?= $loop['trx_id']; ?>" class="fw-500">#<?= $loop['trx_id']; ?></a></td>
                                            <td><?= $loop['username_sender']; ?></td>
                                            <td><?= $loop['username_recipient']; ?></td>
                                            <td valign="middle" nowrap="">Rp <?= number_format($loop['amount'],0,',','.'); ?></td>
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
        pageLength: 6,
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