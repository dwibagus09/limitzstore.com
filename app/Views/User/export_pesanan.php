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
                                        Export Data Riwayat Pesanan
                                    </h6>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?> 
                                        <div id="div-import">
                                            <div class="mb-3 row">
                                                <div class="col-md-6">
                                                    <select class="form-control" name="month">
                                                        <option value="">-- Pilih Bulan --</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "01")){ $selected = "selected"; }?>
                                                        <option value="01" <?php echo $selected; ?>>Januari</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "02")){ $selected = "selected"; }?>
                                                        <option value="02" <?php echo $selected; ?>>Februari</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "03")){ $selected = "selected"; }?>
                                                        <option value="03" <?php echo $selected; ?>>Maret</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "04")){ $selected = "selected"; }?>
                                                        <option value="04" <?php echo $selected; ?>>April</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "05")){ $selected = "selected"; }?>
                                                        <option value="05" <?php echo $selected; ?>>Mei</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "06")){ $selected = "selected"; }?>
                                                        <option value="06" <?php echo $selected; ?>>Juni</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "07")){ $selected = "selected"; }?>
                                                        <option value="07" <?php echo $selected; ?>>Juli</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "08")){ $selected = "selected"; }?>
                                                        <option value="08" <?php echo $selected; ?>>Agustus</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "09")){ $selected = "selected"; }?>
                                                        <option value="09" <?php echo $selected; ?>>September</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "10")){ $selected = "selected"; }?>
                                                        <option value="10" <?php echo $selected; ?>>Oktober</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "11")){ $selected = "selected"; }?>
                                                        <option value="11" <?php echo $selected; ?>>November</option>
                                                        <?php $selected = ""; if(isset($month) && ($month == "0128")){ $selected = "selected"; }?>
                                                        <option value="12" <?php echo $selected; ?>>Desember</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="year">
                                                        <option value="">-- Pilih Tahun --</option>
                                                        <?php 
                                                        for ($i=2024; $i <= $now_year; $i++) { 
                                                            $selected = ""; 
                                                            if(isset($year) && ($year == $i)){ 
                                                                echo "<option value='".$i."' selected>".$i."</option>";
                                                            }else{
                                                                echo "<option value='".$i."'>".$i."</option>";
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button class="btn btn-primary" type="submit" name="tombol" value="submit">Download</button>
                                        </div>
                                    </form>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
		<?php $this->endSection(); ?>