<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title; ?> - <?= $web['title']; ?></title>

        <meta name="description" content="<?= strip_tags($web['description']); ?>">
        <meta name="keywords" content="<?= strip_tags($web['keywords']); ?>">

        <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/simplebar/css/simplebar.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/animate.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/icons.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/horizontal-menu.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/app-style.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-main.css">

        <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

        <style>
            :root {
                --warna: #1A355B;
                --warna_2: #152A49;
                --warna_3: #b19973;
            }
            .content {
                padding-top: 110px;
                min-height: 446px;
            }
            .table-white tr th, .table-white tr td {
                color: #fff;
                border-color: #242f3a;
            }
            label {
                font-weight: 500;
                text-transform: none;
            }
            .col-form-label {
                padding-top: calc(.375rem + 3px);
            }
            .card-tools {
                float: right;
                margin-top: -25px;
            }
            .cursor-pointer {
                cursor: pointer;
            }
            .menu-user a {
                padding: 10px 16px;
                border-radius: 5px;
            }
            .menu-user a:hover {
                background: var(--warna_2);
            }
            .menu-user a i {
                font-size: 19px;
                width: 20px;
            }
            .menu-user {
                margin-bottom: 26px;
            }
            .daterangepicker td, .daterangepicker th {
                color: #626262;
            }
            body, .circle-primary {
                background: var(--warna);
            }
            .bg-footer {
                background-color: var(--warna);
            }
            .bg-theme1, .bg-custom, .card {
                /*background: var(--warna_2) !important;*/
                background: var(--warna_2);
            }
            .btn-topup, .back-to-top {
                background: var(--warna_3);
            }
            .section {
                background: var(--warna_2);
            }
            .radio-nominal + label, .radio-nominale + label {
                background: var(--warna);  
                border: none !important;
            }
            .radio-nominale:checked + label, .radio-nominal:checked + label {
                background: var(--warna_3);
                color: #fff;
            }
            .strip-primary {
                background: #b19973;
            }
            .btn-primary {
                background: var(--warna_3) !important;
                border-color: var(--warna_3) !important;
            }
            .active, .btn:hover {
              background-color: var(--warna_3);
            }
            .sidenav {
                background: var(--warna_2);
            }
            .radio-nominal:checked + label, .table-white tr th, .table-white tr td {
                border-color: var(--warna);
            }
            .menu-utama div a {
                margin: 0 4px;
            }
            .menu-utama div a:hover, .menu-utama div a.active {
                background: var(--warna_3);
                border-radius: 14px 4px;
            }
            .navbar-collapse {
                background: var(--warna_2);
            }
            .menu-list {
                list-style: none;
                padding-left: 0;
            }
            .menu-list li a {
                display: block;
                padding: 10px 0;
                border-bottom: 1px dashed var(--warna_3);
                transition: .4s;
            }
            .menu-list li a:hover {
                padding-left: 6px;
            }
            .switch {
              position: relative;
              display: inline-block;
              width: 2rem;
              height: 1rem;
            }
            
            .switch input { 
              opacity: 0;
              width: 0;
              height: 0;
            }
            
            .slider {
              position: absolute;
              cursor: pointer;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background-color: #ccc;
              -webkit-transition: .4s;
              transition: .4s;
            }
            
            .slider:before {
              position: absolute;
              content: "";
              height: 0.8rem;
              width: 0.8rem;
              left: 2px;
              bottom: 2px;
              background-color: white;
              -webkit-transition: .4s;
              transition: .4s;
            }
            
            input:checked + .slider {
              background-color: #2196F3;
            }
            
            input:focus + .slider {
              box-shadow: 0 0 1px #2196F3;
            }
            
            input:checked + .slider:before {
              -webkit-transform: translateX(26px);
              -ms-transform: translateX(26px);
              transform: translateX(16px);
            }
            
            /* Rounded sliders */
            .slider.round {
              border-radius: 34px;
            }
            
            .slider.round:before {
              border-radius: 50%;
            }
            
            .dark-mode {
              background-color: white !important;
              color: black;
              box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
            }
            .bg-footer-2{
                background: var(--warna_2);
                margin-top: -4px;
            }
            
            @media (min-width: 1200px) {
                .container {
                    max-width: 1100px;
                }
            }
        </style>

        <?php $this->renderSection('css'); ?>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark shadow-sm bg-custom" style="padding: 0rem 0.5rem 0rem 0.5rem;" id="navBar">
                    <div class="container">
                        <a class="navbar-brand" href="<?= base_url(); ?>">
                            <img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" width="50" alt="logo icon" class="rounded">
                        </a>
                        <div class="d-flex">
                            <div class="float-start ms-auto mt-3 me-3">
                            <!--<label class="form-check-label ms-3" for="lightSwitch">-->
                            <!--</label>-->
                            <!--<input class="form-check-input" type="checkbox" id="lightSwitch" />-->
                            <!--<span class="slider round"></span>-->
                            <label class="switch">
                              <input type="checkbox" id="lightSwitch" onclick="darkmode()">
                              <span class="slider round"></span>
                            </label>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" id="navbarNavAltMarkupMobile">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse menu-utama" id="navbarNavAltMarkup">
                            <div class="navbar-nav ml-auto">
                                <a class="nav-item nav-link <?= $menu_active == 'Home' ? 'active' : ''; ?>" href="<?= base_url(); ?>" id="home"><i class="fa fa-home"></i> Home</a>
                                <a class="nav-item nav-link <?= $menu_active == 'Cek' ? 'active' : ''; ?>" href="<?= base_url(); ?>/payment" id="payment"><i class="fa fa-search"></i> Cek Pesanan</a>
                                <a class="nav-item nav-link" href="<?= $sm['wa']; ?>" id="contactMe"><i class="fa fa-phone"></i> Kontak Kami</a>
                                <a class="nav-item nav-link <?= $menu_active == 'Daftar Harga' ? 'active' : ''; ?>" href="<?= base_url(); ?>/daftar-harga"><i class="fa fa-tag"></i>Daftar Harga</a>
                                <!--<a class="nav-item nav-link <?= $menu_active == 'Method' ? 'active' : ''; ?>" href="<?= base_url(); ?>/method">Metode Pembayaran</a>-->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-calculator"></i>Kalkulator ML
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="/win-rate">Win Rate</a>
                                        <a class="dropdown-item" href="/magic-wheel">Magic Wheel</a>
                                        <a class="dropdown-item" href="/zodiac">Zodiac</a>
                                    </div>
                                </li>
                                <?php if ($admin !== false): ?>
                                <a class="nav-item nav-link" href="<?= base_url(); ?>/admin" id="administrator">Administrator</a>
                                <?php endif ?>
                                <?php if ($users !== false): ?>
                                <a class="nav-item nav-link" href="<?= base_url(); ?>/user" id="beranda">Beranda</a>
                                <?php else: ?>
                                <a class="nav-item nav-link <?= $menu_active == 'Login' ? 'active' : ''; ?>" href="#" data-toggle="modal" data-target="#myModalLogin" id="loginM"><i class="fa fa-sign-in"></i> Login Member</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <?php $this->renderSection('content'); ?>
            
            <!--Login-->
            <div class="modal fade" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form role="form" action="<?= base_url(); ?>/login" method="POST">
                            <div class="modal-header" style="background: #e9ecef;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- <h4 class="modal-title" id="myModalLabel" style="color:#000000;">Login form</h4> -->
                            </div>
                            <div class="modal-body" style="background: #f7f7f9;">
                                <ul class="nav justify-content-center mb-3">
                                <!--<li class="nav-item">-->
                                <!--  <button type="button" class="btn btn-link" id="createAccount">Not a member ?</button>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                <!--  <a class="nav-link" href="#">Register</a>-->
                                <!--</li>-->
                                
                                <div class="social-login">
                                    <button class="btn facebook-btn social-btn" type="button" id="createAccount"><span><i class="fa fa-id-card"></i> Daftar Member</span> </button>
                                    <button class="btn google-btn social-btn active" type="button" id="loginMember"><span><i class="fa fa-sign-in"></i> Login Member</span> </button>
                                </div>
                                </ul>
                                <?= alert(); ?>
                                <div id="login">
                                    <div class="form-group">
                                        <label for="email">Username</label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <input type="text" name="username" class="form-control" style="border: 1px solid #ced4da;" id="email" placeholder="Username">
                                            <!--<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group pb-modalreglog-input-group">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                            </div>
                                            <input type="password" name="password" class="form-control" style="border: 1px solid #ced4da;" id="pws" placeholder="Password">
                                            <span class="input-group-text" style="border-bottom-left-radius:0; border-top-left-radius:0"><span class="fa fa-eye-slash" style="cursor: pointer"
                                                onclick="pwEye(this);"></span></span>
                                        </div>
                                    </div>
                                    <p class="text-dark">Lupa password? <a class="text-primary" href="/reset">reset</a></p>
                                <!--</form>-->
                                </div>
                                <div id="register" class="d-none">
                                    <!--<form>-->
                                        <div class="form-group">
                                            <label for="email">Username</label>
                                            <div class="input-group pb-modalreglog-input-group">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                                </div>
                                                <input type="text" name="username_regist" class="form-control" style="border: 1px solid #ced4da;" id="email" placeholder="Username">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group pb-modalreglog-input-group">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                                </div>
                                                <input type="password" name="password_regist" class="form-control" style="border: 1px solid #ced4da;" id="pws" placeholder="Password">
                                                <span class="input-group-text" style="border-bottom-left-radius:0; border-top-left-radius:0"><span class="fa fa-eye-slash" style="cursor: pointer"
                                                onclick="pwEye(this);"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="handphone">No Hp / WhatsApp</label>
                                            <div class="input-group pb-modalreglog-input-group">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-whatsapp"></i></div>
                                                </div>
                                                <input type="handphone" name="wa" class="form-control" style="border: 1px solid #ced4da;" id="handphone" placeholder="No. WhatsApp">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn-link position-absolute" style="left:0;" id="createAccount">Not a member ?</button>-->
                                <!--<button type="button" class="btn btn-link d-none position-absolute" style="left:0;" id="loginMember">Already Registered?</button>-->
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; border-color: #6c757d;">Close</button>
                                <button type="submit" name="tombol" value="submit" class="btn btn-primary" id="submit">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Login-->

            <footer id="aboutus" class="bg-footer">
                <div class="bg-footer-2" id="footer">
                    <div class="pt-5 pb-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                    <img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" height="40" alt="logo icon" class="mb-3">
                                    <h5 class="mb-2" id="namaWeb"><?= $web['name']; ?></h5>
                                    <?= $web['description']; ?>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <h5 class="pb-2" id="halaman">Halaman</h5>
                                    <ul class="menu-list">
                                        <li><a href="<?= base_url(); ?>/" id="halamanUtama">Halaman Utama</a></li>
                                        <li><a href="<?= base_url(); ?>/payment" id="cekPesanan">Cek Pesanan</a></li>
                                        <li><a href="<?= base_url(); ?>/syarat-ketentuan" id="syaratKetentuan">Syarat & Ketentuan</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <h5 class="pb-2" id="sosialMedia">Sosial Media Kami</h5>
                                    <a href="<?= $sm['ig']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-instagram pr-4" id="ig"></i>
                                    </a>
                                    <a href="<?= $sm['yt']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-youtube pr-4" id="yt"></i>
                                    </a>
                                    <a href="<?= $sm['fb']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-facebook pr-4" id="fb"></i>
                                    </a>
                                    <a href="<?= $sm['tw']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-twitter" id="twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-footer-2 text-center pb-4" id="license"> Copyright © 2022 <?= $web['name']; ?>. All Rights Reserved </div>
            </footer>
        </div>

        <a href="javaScript:void();" class="back-to-top">
            <i class="fa fa-angle-double-up"></i>
        </a>

        <!--End wrapper-->
        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
        <!-- simplebar js -->
        <script src="<?= base_url(); ?>/assets/plugins/simplebar/js/simplebar.js"></script>
        <!-- Custom scripts -->
        <script src="<?= base_url(); ?>/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
        <!--Select Plugins Js-->
        <script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.min.js"></script>
        <!--Data Tables js-->
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

        <script>
            // $(document).ready(function() {
            //     $('#default-datatable').DataTable();
            // });

            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script>
            <?php if ($admin !== false): ?>
            function hapus(link) {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data akan dihapus permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tetap hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            }
            <?php endif; ?>

        </script>
        
        <script>
            const params = new URLSearchParams(window.location.search)
            if (params.get('stat') == 'invalid' || params.get('stat') == 'registfailed' || params.get('stat') == 'registsuccess') {
                $('#myModalLogin').modal('show');    
            }

            $("#createAccount").click(function(){
                $("#login").addClass("d-none");
                $("#loginMember").removeClass("d-none active");
                $("#createAccount").addClass("active");
                $("#register").removeClass("d-none");
                $("#submit").text("Register");
                $('form').attr('action', '/register');
            });
            $("#loginMember").click(function(){
                $("#login").removeClass("d-none");
                $("#createAccount").removeClass("d-none active");
                $("#loginMember").addClass("active");
                $("#register").addClass("d-none");
                $("#submit").text("Login");
                $('form').attr('action', '/login');
            });
            
            function pwEye(e) {
                var type = $(e).parent().parent().find("input").attr("type");
                console.log(type);
                console.log($(e).parent().parent().parent())
                if (type == "password") {
                    $(e).removeClass("fa-eye-slash");
                    $(e).addClass("fa-eye");
                    $(e).parent().parent().find("input").attr("type", "text");
                } else if (type == "text") {
                    $(e).removeClass("fa-eye");
                    $(e).addClass("fa-eye-slash");
                    $(e).parent().parent().find("input").attr("type", "password");
                }
            }
            
            function darkmode() {
                var element             = document.body;
                var lightSwitch         = document.getElementById("lightSwitch");
                var navBar              = document.getElementById("navBar");
                var footer              = document.getElementById("footer");
                var license             = document.getElementById("license");
                var navbarNavAltMarkup  = document.getElementById("navbarNavAltMarkup");
                var navbarNavAltMarkupMobile = document.getElementById("navbarNavAltMarkupMobile");
                var beranda             = document.getElementById("beranda");
                var administrator       = document.getElementById("administrator");
                var login               = document.getElementById("loginM");
                var contactMe           = document.getElementById("contactMe");
                var payment             = document.getElementById("payment");
                var home                = document.getElementById("home");
                var twitter             = document.getElementById("twitter");
                var fb                  = document.getElementById("fb");
                var yt                  = document.getElementById("yt");
                var ig                  = document.getElementById("ig");
                var syaratKetentuan     = document.getElementById("syaratKetentuan");
                var daftarHarga         = document.getElementById("daftarHarga");
                var cekPesanan          = document.getElementById("cekPesanan");
                var halamanUtama        = document.getElementById("halamanUtama");
                var halaman             = document.getElementById("halaman");
                var sosialMedia         = document.getElementById("sosialMedia");
                var namaWeb             = document.getElementById("namaWeb");
                var ProdukLainnya       = document.getElementById("Produk Lainnya");
                var TopUpGame           = document.getElementById("Top Up Game");
                var cardUser            = document.getElementById("cardUser");
                var cardUserFont        = document.getElementById("cardUserFont");
                var cardPayment         = document.getElementById("cardPayment");
                var cardPaymentFont     = document.getElementById("cardPaymentFont");
                var cardLayanan         = document.getElementById("cardLayanan");
                var cardLayananFont     = document.getElementById("cardLayananFont");
                var cardKonfirm         = document.getElementById("cardKonfirm");
                var cardKonfirmFont     = document.getElementById("cardKonfirmFont");
                var noTransaksi         = document.getElementById("noTransaksi");
                var cekPesananFont      = document.getElementById("cekPesananFont");
                var cardPesanan         = document.getElementById("cardPesanan");
                var detailPesanan       = document.getElementById("detailPesanan");
                var berandaUser         = document.getElementById("berandaUser");
                var berandaRiwayat      = document.getElementById("berandaRiwayat");
                var berandaTopUp        = document.getElementById("berandaTopUp");
                var berandaLogout       = document.getElementById("berandaLogout");
                var menuUtamaUser       = document.getElementById("menuUtamaUser");
                var infoProfile         = document.getElementById("infoProfile");
                var saldoSaya           = document.getElementById("saldoSaya");
                var pesananSaya         = document.getElementById("pesananSaya");
                var profileDetail       = document.getElementById("profileDetail");
                var gantiPassword       = document.getElementById("gantiPassword");
                var gantiPasswordText   = document.getElementById("gantiPasswordText");
                var gantiPasswordOld    = document.getElementById("gantiPasswordOld");
                var gantiPasswordNew    = document.getElementById("gantiPasswordNew");
                var gantiPasswordRepeat = document.getElementById("gantiPasswordRepeat");
                var profileDetailWA     = document.getElementById("profileDetailWA");
                var profileDetailUser   = document.getElementById("profileDetailUser");
                var saldoSayaText       = document.getElementById("saldoSayaText");
                var pesananSayaText     = document.getElementById("pesananSayaText");
                var riwayat             = document.getElementById("riwayat");
                var cardRiwayat         = document.getElementById("cardRiwayat");
                var topUp               = document.getElementById("topUp");
                var riwayatTopup        = document.getElementById("riwayatTopup");
                
                lightSwitch.addEventListener('click',function(e) {
                    if(!this.checked) {
                        localStorage.setItem("whiteMode", 'white');
                        alert("Mode White Aktif");
                        // console.log(localStorage.setItem);
                    }else{
                        localStorage.setItem("whiteMode", 'dark');
                        alert("Mode Dark Aktif");
                    }
                });
                
                element.classList.toggle("dark-mode");
                navBar.classList.toggle("dark-mode");
                footer.classList.toggle("dark-mode");
                license.classList.toggle("dark-mode");
                if (cardUser) {
                    cardUser.classList.toggle("dark-mode");
                    cardUserFont.classList.toggle("text-dark");
                    cardPayment.classList.toggle("dark-mode");
                    cardPaymentFont.classList.toggle("text-dark");
                    cardKonfirm.classList.toggle("dark-mode");
                    cardKonfirmFont.classList.toggle("text-dark");
                    cardLayanan.classList.toggle("dark-mode");
                    cardLayananFont.classList.toggle("text-dark");   
                }
                if (noTransaksi){
                    noTransaksi.classList.toggle("text-dark");
                    cekPesananFont.classList.toggle("text-dark");
                    cardPesanan.classList.toggle("dark-mode");
                }
                if (detailPesanan) {
                    detailPesanan.classList.toggle("text-dark");
                }
                if (administrator) {
                    administrator.classList.toggle("text-dark");
                }
                if (beranda) {
                    beranda.classList.toggle("text-dark");
                }
                if (menuUtamaUser) {
                    menuUtamaUser.classList.toggle("text-dark");
                    berandaUser.classList.toggle("text-dark");
                    berandaRiwayat.classList.toggle("text-dark");
                    berandaTopUp.classList.toggle("text-dark");
                    berandaLogout.classList.toggle("text-dark");
                }
                if (infoProfile) {
                    infoProfile.classList.toggle("text-dark");
                    saldoSaya.classList.toggle("dark-mode");
                    pesananSaya.classList.toggle("dark-mode");
                    profileDetail.classList.toggle("dark-mode");
                    gantiPassword.classList.toggle("dark-mode");
                    gantiPasswordText.classList.toggle("text-dark");
                    gantiPasswordOld.classList.toggle("text-dark");
                    gantiPasswordNew.classList.toggle("text-dark");
                    gantiPasswordRepeat.classList.toggle("text-dark");
                    profileDetailWA.classList.toggle("text-dark");
                    profileDetailUser.classList.toggle("text-dark");
                    saldoSayaText.classList.toggle("text-dark");
                    pesananSayaText.classList.toggle("text-dark");
                }
                if (navbarNavAltMarkupMobile) {
                    navbarNavAltMarkupMobile.classList.toggle("bg-dark");
                }
                if (riwayat) {
                    riwayat.classList.toggle("text-dark");
                    // cardRiwayat.classList.toggle("dark-mode");
                }
                if (topUp) {
                    topUp.classList.toggle("text-dark");
                    riwayatTopup.classList.toggle("text-dark");
                }
                navbarNavAltMarkup.classList.toggle("bg-white");
                login.classList.toggle("text-dark");
                contactMe.classList.toggle("text-dark");
                payment.classList.toggle("text-dark");
                home.classList.toggle("text-dark");
                twitter.classList.toggle("text-dark");
                fb.classList.toggle("text-dark");
                yt.classList.toggle("text-dark");
                ig.classList.toggle("text-dark");
                syaratKetentuan.classList.toggle("text-dark");
                cekPesanan.classList.toggle("text-dark");
                halamanUtama.classList.toggle("text-dark");
                halaman.classList.toggle("text-dark");
                sosialMedia.classList.toggle("text-dark");
                namaWeb.classList.toggle("text-dark");
                ProdukLainnya.classList.toggle("text-dark");
                TopUpGame.classList.toggle("text-dark");
                
                for (let i = 1; i < 50; i++) {
                    if (document.getElementById("cardGame"+i)) {
                        document.getElementById("cardGame"+i).classList.toggle("dark-mode");
                        document.getElementById("cardGameTitle"+i).classList.toggle("text-dark");
                    }
                }
            }
            
            if(localStorage.getItem('whiteMode') == 'white') {
                darkmode();
                // document.getElementById("lightSwitch").checked = false;
                $("#lightSwitch").attr("checked", false);
            }else{
                $("#lightSwitch").attr("checked", true);
            }
            console.log(localStorage.getItem('whiteMode'));
        </script>
        
        <?php $this->renderSection('js'); ?>
    </body>
</html>