		<?php $this->extend('template'); ?>
		
		<?php $this->section('css'); ?>
		<?php $this->endSection(); ?>
		
		<?php $this->section('content'); ?>
        <div class="eniv-content">
            <div class="container">
        		<div class="eniv-body">
				<?php if($config['value'] == 1) { ?>
        			<div class="row justify-content-center">
        				<div class="col-md-10">
        					<div class="text-center mb-4">
		                    	<h6 class="fs-18">TOP GLOBAL AKUN SULTAN</h6>
		                    	<h6 class="fs-18">LIMITZ STORE</h6>
		                    	<p>Reset Sampai <?= date("m-Y",strtotime($web['end-top'])) ?></p>
		                    </div>
		                    <div class="card">
	                            <div class="table-responsive">
	                                <table class="table border-bottom-none mb-0">
	                                    <tr>
	                                        <th>Rank</th>
	                                        <th>Nickname</th>
	                                        <th>Akun</th>
	                                        <th>Games</th>
	                                        <th>Total Order</th>
	                                    </tr>
	                                    <?php $no = 1; foreach ($top as $loop): ?>
	                                    <tr>
	                                        <td align="center">
	                                            <?php if ($no <= 3): ?>
	                                            <img src="<?= base_url(); ?>/assets/images/top/<?= $no; ?>.png" width="32">
	                                            <?php else: ?>
	                                            <?= $no; ?>
	                                            <?php endif; ?>
	                                        </td>
	                                        <td valign="middle"><?= $loop['nickname']; ?></td>
	                                        <td valign="middle"><?= substr($loop['user_id'], 0, 4); ?>******<?= substr($loop['user_id'], -4); ?></td>
	                                        <td valign="middle"><?= $loop['games']; ?></td>
	                                        <td valign="middle">Rp <?= number_format($loop['nominal'],0,',','.'); ?> (<?= $loop['total']; ?>x)</td>
	                                    </tr>
	                                    <?php $no++; endforeach; ?>
	                                </table>
		                        </div>
		                    </div>
        				</div>
        			</div>
					<?php } ?>
        		</div>
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
		<?php $this->endSection(); ?>