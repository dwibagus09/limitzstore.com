				<?php $this->extend('Admin/template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Whatsapp</h4>
								<form action="" method="POST">
								<?= csrf_field(); ?> 
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Token Fonnte</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" value="<?= $wa['fonnte']; ?>" name="wa_fonnte">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">No. Whatsapp - Admin</label>
										<div class="col-md-8">
											<input type="text" class="form-control" autocomplete="off" value="<?= $wa['admin']; ?>" name="wa_admin">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4"></label>
										<div class="col-md-8">
										    <div class="p-2 alert bg-info mb-0">
										        <b class="d-block">Variabel yang dapat digunakan</b>
										        <ul>
										            <li>#order_id# : Order ID</li>
										            <li>#games# : Nama Games</li>
                                                    <li>#product# : Nama Produk</li>
                                                    <li>#price# : Total Harga</li>
                                                    <li>#user_id# : User ID</li>
                                                    <li>#zone_id# : Zone ID / Server</li>
                                                    <li>#nickname# : Nickname Player</li>
                                                    <li>#method# : Metode Pembayaran</li>
                                                    <li>#ket# : Keterangan</li>
										        </ul>
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Pembelian Baru</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_order" rows="4"><?= $wa['order']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Pembelian Berhasil</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_success" rows="4"><?= $wa['success']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4"></label>
										<div class="col-md-8">
										    <div class="p-2 alert bg-info mb-0">
										        <b class="d-block">Variabel yang dapat digunakan</b>
										        <ul>
										            <li>#username# : Username</li>
										            <li>#otp# : Kode OTP</li>
										        </ul>
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Verifikasi Akun</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_verif" rows="4"><?= $wa['verif']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4"></label>
										<div class="col-md-8">
										    <div class="p-2 alert bg-info mb-0">
										        <b class="d-block">Variabel yang dapat digunakan</b>
										        <ul>
										            <li>#username# : Username</li>
										        </ul>
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Ucapan Member Baru</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_welcome" rows="4"><?= $wa['welcome']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4"></label>
										<div class="col-md-8">
										    <div class="p-2 alert bg-info mb-0">
										        <b class="d-block">Variabel yang dapat digunakan</b>
										        <ul>
										            <li>#username# : Username</li>
										            <li>#password# : Password baru</li>
										        </ul>
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Reset Password</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_reset" rows="4"><?= $wa['reset']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4"></label>
										<div class="col-md-8">
										    <div class="p-2 alert bg-info mb-0">
										        <b class="d-block">Variabel yang dapat digunakan</b>
										        <ul>
										            <li>#username# : Username</li>
										            <li>#jumlah# : Jumlah Topup</li>
										        </ul>
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Ucapan Member Topup</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_topup" rows="4"><?= $wa['topup']; ?></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4"></label>
										<div class="col-md-8">
										    <div class="p-2 alert bg-info mb-0">
										        <b class="d-block">Variabel yang dapat digunakan</b>
										        <ul>
										            <li>#sender# : Username pengirim. Untuk pengirim "Admin" akan otomatis terisi Admin.</li>
										            <li>#recipient# : Username Penerima</li>
										            <li>#amount# : Jumlah nominal yang dikirim</li>
										            <li>#status# : Status Transaksi</li>
										            <li>#order_id# : Nomor Transaksi</li>
										        </ul>
										    </div>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-4">Notifikasi Transfer Saldo</label>
										<div class="col-md-8">
										    <textarea class="form-control" name="wa_notif_transfer_balance" rows="4"><?= $wa['wa_notif_transfer_balance']; ?></textarea>
										</div>
									</div>
									<div class="text-end">
										<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>