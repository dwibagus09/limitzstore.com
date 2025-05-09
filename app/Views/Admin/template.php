<!DOCTYPE html>
<html lang="en">
	<head>
	<?= $this->Include('head'); ?>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-admin.css">

	<style>
        :root {
        	--warna: <?= $tema['warna']; ?>;
        	--warna_2: <?= $tema['warna_2']; ?>;
        	--warna_3: <?= $tema['warna_3']; ?>;
            --warna_4: <?= $tema['warna_4']; ?>;
        	--text: <?= $tema['text']; ?>;
            --text_2: <?= $tema['text_2']; ?>;
            --border: <?= $tema['border']; ?>;
        }
        .eniv-admin-sidebar::-webkit-scrollbar {
            width: 0;
        }
        
        .togglebro {
            position: relative;
            bottom:110px;
            left:110px;
        }
	</style>
	</head>
	<body>
		<div class="eniv-admin-sidebar">
			<div class="eniv-admin-logo">
				<a href="<?= base_url(); ?>">
				    <img src="<?= $web['logo']; ?>" alt="" width="120">
				</a>
				
				<div class="eniv-admin-toggle togglebro">
					<img src="<?= base_url(); ?>/assets/images/menu.png" alt="">
				</div>
			</div>
			<div class="eniv-admin-menu">
				<span class="eniv-admin-menu-title">Menu Utama</span>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1" class="<?= $menu_admin == 'Dashboard' ? 'active' : ''; ?>">
					<i class="fa fa-home"></i>
					Dashboard
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/konfigurasi" class="<?= $menu_admin == 'Konfigurasi' ? 'active' : ''; ?>">
					<i class="fa fa-cog"></i>
					Konfigurasi
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/config" class="<?= $menu_admin == 'Config' ? 'active' : ''; ?>">
					<i class="fa fa-cog"></i>
					Config
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tata-cara" class="<?= $menu_admin == 'Kelola Tata Cara' ? 'active' : ''; ?>">
					<i class="fa fa-cog"></i>
					Kelola Tata Cara
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/admin" class="<?= $menu_admin == 'Kelola Admin' ? 'active' : ''; ?>">
					<i class="fa fa-user"></i>
					Kelola Admin
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pengguna" class="<?= $menu_admin == 'Kelola Pengguna' ? 'active' : ''; ?>">
					<i class="fa fa-users"></i>
					Kelola Pengguna
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/kategori" class="<?= $menu_admin == 'Kelola Kategori' ? 'active' : ''; ?>">
					<i class="fa fa-list"></i>
					Kelola Kategori
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/games" class="<?= $menu_admin == 'Kelola Games' ? 'active' : ''; ?>">
					<i class="fa fa-gamepad"></i>
					Kelola Games
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/target" class="<?= $menu_admin == 'Sistem Target' ? 'active' : ''; ?>">
					<i class="fa fa-database"></i>
					Sistem Target
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/produk" class="<?= $menu_admin == 'Kelola Produk' ? 'active' : ''; ?>">
					<i class="fa fa-box"></i>
					Kelola Produk
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/pesanan" class="<?= $menu_admin == 'Kelola Pembelian' ? 'active' : ''; ?>">
					<i class="fa fa-shopping-basket"></i>
					Kelola Pesanan
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/review" class="<?= $menu_admin == 'Review Pesanan' ? 'active' : ''; ?>">
					<i class="fa fa-star"></i>
					Review Pesanan
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/metode" class="<?= $menu_admin == 'Kelola Metode' ? 'active' : ''; ?>">
					<i class="fa fa-credit-card"></i>
					Kelola Metode
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/voucher" class="<?= $menu_admin == 'Kelola Voucher' ? 'active' : ''; ?>">
					<i class="fa fa-percent"></i>
					Kelola Voucher
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/topup" class="<?= $menu_admin == 'Kelola Topup' ? 'active' : ''; ?>">
					<i class="fa fa-wallet"></i>
					Kelola Topup
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/flash" class="<?= $menu_admin == 'Flash Sale' ? 'active' : ''; ?>">
					<i class="fa fa-tags"></i>
					Flash Sale
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/whatsapp" class="<?= $menu_admin == 'Pesan Whatsapp' ? 'active' : ''; ?>">
					<i class="fab fa-whatsapp"></i>
					Pesan Whatsapp
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/ip" class="<?= $menu_admin == 'Data Ip' ? 'active' : ''; ?>">
					<i class="fa fa-cog"></i>
					IP ADDRESS
				</a>
					<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/digiflazz/export" class="<?= $menu_admin == 'Get Produk' ? 'active' : ''; ?>">
					<i class="fa fa-box"></i>
					GET PRODUK
				</a>
				<span class="eniv-admin-menu-title mt-4">Tampilan & Lainnya</span>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/tema" class="<?= $menu_admin == 'Tema Website' ? 'active' : ''; ?>">
					<i class="fa fa-desktop"></i>
					Tema Tampilan
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/sosmed" class="<?= $menu_admin == 'Kelola Sosmed' ? 'active' : ''; ?>">
					<i class="fa fa-comments"></i>
					Kelola Sosmed
				</a>
				<a href="<?= base_url(); ?>/-9J6DWAuK/]:C2Tx1/logout" class="<?= $menu_admin == 'Logout' ? 'active' : ''; ?>">
					<i class="fas fa-sign-out-alt"></i>
					Logout
				</a>
			</div>
		</div>
		<div class="eniv-admin-content">
			<div class="eniv-admin-content-nav">
				<div class="row">
					<div class="col-6">
						<div class="eniv-admin-toggle">
							<img src="<?= base_url(); ?>/assets/images/menu.png" alt="">
						</div>
					</div>
					<div class="col-6">
						<div class="text-end">
							<a href="">
								<img src="<?= base_url(); ?>/assets/images/profile.png" alt="" width="32">
							</a>
						</div>
					</div>
				</div>
			</div>

			<?php $this->renderSection('content'); ?>

		</div>

		<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered modal-lg">
		        <div class="modal-content">
		            <div class="modal-body">
		            	<h4 class="fs-16 fw-500 mb-3">Edit Data</h4>
			            <form action="" method="POST" enctype="multipart/form-data">
			            	<div id="modal-edit-result"></div>
			            	<div class="mt-3 text-end">
			            		<button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
			            		<button type="submit" class="btn btn-primary" name="tombol_edit" value="tombol_edit">Submit</button>
			            	</div>
			            </form>
		            </div>
		        </div>
		    </div>
		</div>

		<?= $this->Include('js'); ?>

		<script>

			$(".eniv-admin-toggle").on('click', function() {

				var el_siebar = $(".eniv-admin-sidebar");

				if (el_siebar.hasClass('show')) {
					el_siebar.removeClass('show');
				} else {
					el_siebar.addClass('show');
				}
			});

			var modal_edit = new bootstrap.Modal(document.getElementById('modal-edit'));

			function edit(link) {
				$.ajax({
					url: link,
					success: function(result) {
						$("#modal-edit-result").html(result);

						modal_edit.show();
					}
				});
			}
		</script>
	</body>
</html>