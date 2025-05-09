<?php $this->extend('Admin/template'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<style>
    .daterangepicker {
        background: #2b2d3d;
        padding: 12px !important;
        border: none !important;
    }
    .daterangepicker:before {
        border-bottom-color: #2b2d3d;
    }
    .daterangepicker:after {
        border-bottom-color: #2b2d3d;
    }
    .daterangepicker .calendar {
        float: left;
    }
    .daterangepicker .ranges {
        clear: both;
    }
    .daterangepicker .calendar-table {
        padding: 6px;
        background: #323548;
        border: none;
        margin-right: 12px;
    }
    .daterangepicker_input {
        position: relative;
        margin-bottom: 12px;
        margin-right: 12px;
    }
    .daterangepicker_input input {
        padding: 10px 18px;
        background: #242634 !important;
    }
    .daterangepicker_input i {
        position: absolute;
        right: 14px;
        top: 12px;
    }
    .daterangepicker td.off, .daterangepicker td.off.start-date, .daterangepicker td.off.in-range {
        background: transparent;
    }
    .daterangepicker td.in-range {
        color: #fff;
        background: #40445b;
    }
    .daterangepicker td.active, .daterangepicker td.active:hover, .daterangepicker td.available:hover, .daterangepicker th.available:hover {
        background: var(--warna_3);
        color: #333;
    }
    .range_inputs .btn-success {
        color: #333 !important;
        background: var(--warna_3) !important;
    }
    .daterangepicker.show-calendar .ranges {
        width: 100%;
        text-align: right;
    }
    .morris-hover-point {
        color: #666 !important;
        font-weight: 600;
    }
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="row justify-content-center">
	<div class="col-md-10">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?= $title; ?></h4>
				<form action="" method="POST" enctype="multipart/form-data">
				<?= csrf_field(); ?> 
					<div id="div-import">
						<div class="mb-3 row">
							<label class="col-form-label col-md-4">Pilih Tanggal</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="daterange" value="<?= $date_range; ?>">
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-md-4">Pilih Status</label>
						<div class="col-md-8">
							<select name="status" class="form-control">
								<?php foreach ($opt_status as $loop): ?>
								<option value="<?= $loop; ?>"><?= $loop; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!--<div class="mb-3 row">
						<label class="col-form-label col-md-4">Google Authenticator</label>
						<div class="col-md-8">
							<input type="number" class="form-control" autocomplete="off" name="googleauth" id="googleauth">
						</div>
					</div>-->
					<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan/history" class="btn btn-warning float-start">Kembali</a>
					<div class="text-end">
						<button class="btn " type="reset">Batal</button>
						<button class="btn btn-primary" type="submit" name="tombol" value="submit">Download</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$('input[name="daterange"]').daterangepicker({
        timePicker: true,
        locale: {
                format: 'MM/DD/YYYY HH:mm:ss' // Specify the date-time format
            }
    });
	});
</script>
<?php $this->endSection(); ?>