            <?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
                <style>
                    .slidecontainer {
                        width: 100%;
                    }
        
                    .slider {
                        -webkit-appearance: none;
                        width: 100%;
                        height: 25px;
                        background: #bb7e00;
                        outline: none;
                        opacity: 0.7;
                        -webkit-transition: .2s;
                        transition: opacity .2s;
                        border-radius: 12px;
                    }
        
                    .slider:hover {
                        opacity: 1;
                    }
        
                    .slider::-webkit-slider-thumb {
                        -webkit-appearance: none;
                        appearance: none;
                        width: 25px;
                        height: 25px;
                        background: #FFFF00;
                        cursor: pointer;
                        border-radius: 12px;
                    }
        
                    .slider::-moz-range-thumb {
                        width: 25px;
                        height: 25px;
                        background: #000000;
                        cursor: pointer;
                    }
                    .slider:before {
                        display: none;
                    }
                </style>
                
            <div class="wrapper pt-4">
                <br>
                
                <div class="container" style="text-align:center;">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-9 col-sm-9">
                            <div class="text-center mb-3">
                                <img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" width="200" height="200">
                                <h5 class="text-white mt-3 mb-1">Kalkulator Zodiac</h5>
                                <p class="text-white">Digunakan untuk mengetahui total maksimal diamond yang dibutuhkan untuk mendapatkan skin Zodiac.<br></p>
                            </div>
                            <form method="post" target="">
                                <div class="row justify-content-center">
                                    <h5 class="text-white mt-3 mb-1" >Geser Sesuai Point Zodiac Anda</h5>
                                    <div class="col-12 col-lg-8 mb-5">
                                        <div class="slidecontainer">
                                            <p>&nbsp;</p>
                                            <span>
                                                <span class="text-white">Star Point Anda : </span>
                                            </span> <span id="f" style="font-weight:bold;color:#30cdf8">100</span><br>
                                            <input type="range" min="0" max="99" value="50" name="sld6" class="slider"
                                                id="myRange" onchange="show_value2(this.value)">
                                            <span class="text-white">Membutuhkan Maksimal : </span><span id="slider_value2"
                                                style="color:#fff;font-weight:bold;"></span>
                                            <img src="<?= base_url(); ?>/assets/images/diamond-ml (1).png" width="20" height="20">
                                            <br>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </form>
                            <span id="resultText" class="text-center d-block"> </span>
                        </div>
                    </div>
                </div>
                
        
            <script>
                function show_value2(x) {

                    if (x < 90) {
                        yz = Math.ceil((2000 - x * 20) * 850 / 1000);
                    }
        
                    if (x > 89) {
                        yz = Math.ceil((2000 - x * 20));
                    }
        
                    document.getElementById("slider_value2").innerHTML = yz;
        
                }
            </script>
            <script>
                var slideCol = document.getElementById("myRange");
                var y = document.getElementById("f");
                y.innerHTML = slideCol.value;
        
                slideCol.oninput = function() {
                    y.innerHTML = this.value;
                }
            </script>
        
            </div>
        </div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>