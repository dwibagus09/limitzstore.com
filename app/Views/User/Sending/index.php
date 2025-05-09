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
                            <!--<a href="<?= base_url(); ?>/user/riwayat-transfer" class="float-end">
                                <i class="fa fa-history me-2"></i>Riwayat Pengiriman 
                            </a>-->
							<h6 class="card-title"><?= $title; ?></h6>
							<form action="" method="POST">
                            <?= csrf_field(); ?> 
                                <input type="hidden" name="username_sender" value="<?= $username; ?>">
                                <input type="hidden" name="wa_sender" value="<?= $username; ?>">
                                <div class="mb-3">
									<label>Masukan Username Penerima</label>
									<input type="text" class="form-control" autocomplete="off" name="recipient">
								</div>
								<div class="mb-3">
									<label>Jumlah Nominal Kirim</label>
									<input type="number" class="form-control" autocomplete="off" name="nominal">
									<input type="hidden" name="saldo" value="<?= $balance; ?>">
								</div>
                                <div class="text-end">
                                    <a href="<?= base_url(); ?>/user" class="btn">Batal</a>
                                    <button class="btn btn-primary btn-auth" type="button" onclick="process_check();">Kirim Saldo</button>
                                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71" fill="none">
                            <rect x="0.5" y="0.875" width="70" height="70" rx="35" fill="#0E101C"/>
                            <path d="M25.5175 42.6133L22.2467 21.3753H20.25C19.7859 21.3753 19.3408 21.1909 19.0126 20.8627C18.6844 20.5345 18.5 20.0894 18.5 19.6253C18.5 19.1612 18.6844 18.716 19.0126 18.3879C19.3408 18.0597 19.7859 17.8753 20.25 17.8753H23.7238C24.1459 17.8675 24.5565 18.0137 24.8787 18.2865C25.2095 18.5647 25.4253 18.9557 25.4843 19.3838L26.0582 23.1253H39.5V26.6253H26.5972L28.7498 40.6253H45.198L47.823 31.8753H51.477L48.1765 42.8775C48.0684 43.2382 47.847 43.5544 47.545 43.7792C47.2429 44.0039 46.8765 44.1253 46.5 44.1253H27.278C26.8439 44.1333 26.4224 43.9785 26.0968 43.6913C25.7794 43.4138 25.5731 43.0309 25.5157 42.6133H25.5175ZM32.5 49.3753C32.5 50.3036 32.1313 51.1938 31.4749 51.8502C30.8185 52.5065 29.9283 52.8753 29 52.8753C28.0717 52.8753 27.1815 52.5065 26.5251 51.8502C25.8687 51.1938 25.5 50.3036 25.5 49.3753C25.5 48.447 25.8687 47.5568 26.5251 46.9004C27.1815 46.244 28.0717 45.8753 29 45.8753C29.9283 45.8753 30.8185 46.244 31.4749 46.9004C32.1313 47.5568 32.5 48.447 32.5 49.3753ZM48.25 49.3753C48.25 50.3036 47.8813 51.1938 47.2249 51.8502C46.5685 52.5065 45.6783 52.8753 44.75 52.8753C43.8217 52.8753 42.9315 52.5065 42.2751 51.8502C41.6187 51.1938 41.25 50.3036 41.25 49.3753C41.25 48.447 41.6187 47.5568 42.2751 46.9004C42.9315 46.244 43.8217 45.8753 44.75 45.8753C45.6783 45.8753 46.5685 46.244 47.2249 46.9004C47.8813 47.5568 48.25 48.447 48.25 49.3753ZM48.25 17.8753C48.7141 17.8753 49.1593 18.0597 49.4874 18.3879C49.8156 18.716 50 19.1612 50 19.6253V21.3753H51.75C52.2141 21.3753 52.6592 21.5597 52.9874 21.8879C53.3156 22.216 53.5 22.6612 53.5 23.1253C53.5 23.5894 53.3156 24.0345 52.9874 24.3627C52.6592 24.6909 52.2141 24.8753 51.75 24.8753H50V26.6253C50 27.0894 49.8156 27.5345 49.4874 27.8627C49.1593 28.1909 48.7141 28.3753 48.25 28.3753C47.7859 28.3753 47.3407 28.1909 47.0126 27.8627C46.6844 27.5345 46.5 27.0894 46.5 26.6253V24.8753H44.75C44.2859 24.8753 43.8407 24.6909 43.5126 24.3627C43.1844 24.0345 43 23.5894 43 23.1253C43 22.6612 43.1844 22.216 43.5126 21.8879C43.8407 21.5597 44.2859 21.3753 44.75 21.3753H46.5V19.6253C46.5 19.1612 46.6844 18.716 47.0126 18.3879C47.3407 18.0597 47.7859 17.8753 48.25 17.8753Z" fill="#00E59B"/>
                        </svg>
                    </div>
                    <h1 class="fs-18 fw-600">Informasi Pengiriman Saldo</h1>
                </div>
                <div id="eniv-modal-result"></div>
                <div class="text-center">
                    <button type="button" class="btn btn-auth me-2" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-auth btn-primary" onclick="process_send();">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script>
	var modal_konfirmasi = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));

    function process_check() {

        var recipient = $("input[name=recipient]").val();
    	var nominal = $("input[name=nominal]").val();
    	var saldo = $("input[name=saldo]").val();

    	if (recipient == '') {
    		Swal.fire('Gagal', 'Username tujuan penerima harus diisi', 'error');
    	}else{
	    	if (nominal == '') {
	    		Swal.fire('Gagal', 'Jumlah nominal kirim harus diisi', 'error');
	    	}
	    	if (nominal > saldo){
	    		Swal.fire('Gagal', 'Maaf saldo Anda tidak cukup', 'error');
	    	}
    	}

        var data = {
            recipient: recipient,
            nominal: nominal,
        };

    	$.ajax({
	        url: '<?= base_url(); ?>/user/send-balance',
	        data: data,
	        type: 'POST',
	        dataType: 'JSON',
	        beforeSend: function() {
	            $(".eniv-loading").addClass('show');
	        }, 
	        success: function(result) {

	            $(".eniv-loading").removeClass('show');
	            if (result.status == true) {
	                
	                $("#eniv-modal-result").html(result.msg);
	                modal_konfirmasi.show();
	                
	            } else {
	                Swal.fire('Gagal', result.msg, 'error');
	            }
	        }
	    });

    }

    function process_send(){

    	$(".eniv-loading").addClass('show');
        $("#btn-order").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>').attr('disabled', 'disabled');
        setTimeout(function() {
            $("#form-send").submit();
        }, 1200);
    }

    /*function process_send() {

        var trx_id = $("input[name=trx_id]").val();
    	var id_sender = $("input[name=id_sender]").val();
    	var username_sender = $("input[name=username_sender]").val();
    	var wa_sender = $("input[name=wa_sender]").val();
    	var id_recipient = $("input[name=id_recipient]").val();
    	var username_recipient = $("input[name=username_recipient]").val();
    	var wa_recipient = $("input[name=wa_recipient]").val();
    	var nominal = $("input[name=nominal]").val();

    	if(trx_id == '' &&  id_sender == '' &&  username_sender == '' &&  wa_sender == '' &&  id_recipient == '' &&  username_recipient == '' && wa_recipient == '' &&  nominal == ''){

    		Swal.fire('Gagal', 'Invalid Data Process. Silahkan Ulangi dan Refresh Halaman Anda!', 'error');

    	}else{

    		var data = {
            	id_sender: id_sender,
            	username_sender: username_sender,
            	wa_sender: wa_sender,
            	id_recipient: id_recipient,
            	username_recipient: username_recipient,
            	wa_recipient: wa_recipient,
            	nominal: nominal
      		};

	    	$.ajax({
		        url: '<?= base_url(); ?>/user/send-balance/'+trx_id,
		        data: data,
		        type: 'POST',
		        dataType: 'JSON',
		        beforeSend: function() {
		            $(".eniv-loading").addClass('show');
		        }, 
		        success: function(result) {

		            $(".eniv-loading").removeClass('show');
		            if (result.status == true) {
		                
		                $("#eniv-modal-result").html(result.msg);
		                modal_konfirmasi.show();
		                
		            } else {
		                Swal.fire('Gagal', result.msg, 'error');
		            }
		        }
		    });

    	}
    }*/
</script>
<?php $this->endSection(); ?>