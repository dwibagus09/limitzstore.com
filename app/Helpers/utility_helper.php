<?php 
function alert() {
	if (session('error')) {
		echo '
		<div class="alert p-3 alert-danger">
			<b>Gagal</b> '.session('error').'
		</div>
		';
	}

	if (session('success')) {
		echo '
		<div class="alert p-3 alert-success">
			<b>Berhasil</b> '.session('success').'
		</div>
		';
	}
}

function fix_date($date) {
    $date_time_parts = explode(' ', $date);
    $time = $date_time_parts[1];
	$date = explode('/', $date_time_parts[0]);

	$resultdate = $date[2] . '-' . $date[0] . '-' . $date[1];
	
	return $resultdate . ' ' . $time;
}

function reverse_date($date_1, $date_2) {
	$x1 = preg_split("/[-\s]/", $date_1);
	$x2 = preg_split("/[-\s]/", $date_2);

	$date_1 = $x1[1] . '/' . $x1[2] . '/' . $x1[0] . ' ' . $x1[3];
	$date_2 = $x2[1] . '/' . $x2[2] . '/' . $x2[0] . ' ' . $x2[3];

	return $date_1 . ' - ' . $date_2;
}
function badge($status) {

	if (in_array($status, ['Pending'])) {
		return 'warning';
	} else if (in_array($status, ['Success', 'Completed', 'Complete', 'On', '+'])) {
		return 'success';
	} else if (in_array($status, ['Canceled', 'Failed', 'Expired', 'Off', '-'])) {
		return 'danger';
	} else {
		return 'info';
	}
}

function badgepembayaran($status) {

	if (in_array($status, ['Pending'])) {
		return 'warning';
	} else if (in_array($status, ['Success', 'Completed', 'Complete', 'On', '+', 'Processing'])) {
		return 'success';
	} else if (in_array($status, ['Canceled', 'Failed', 'Expired', 'Off', '-'])) {
		return 'danger';
	} else {
		return 'info';
	}
}

function status_payment($status) {
    if (in_array($status, ['Pending'])) {
		return 'Belum Dibayar';
	} else if (in_array($status, ['Success', 'Completed', 'Complete', 'On', '+', 'Processing'])) {
		return 'Terbayar';
	} else if (in_array($status, ['Canceled', 'Failed', 'Expired', 'Off', '-'])) {
		return 'Gagal';
	} else {
		return '-';
	}
}