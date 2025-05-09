<?php $this->extend('template'); ?>
            
<?php $this->section('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/flipdown.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/flipdown.addon.css">
<?php if($web['filter-populer']['value'] == 1) { ?>
<style>
    .blackwhite {
       filter: grayscale(100%);
   }
   .blackwhite:hover {
       filter: grayscale(0%);
   }
</style>
<?php } ?>
<style>
    #flipdown {
       padding-top: 0;
    }
    .flipdown {
       width: fit-content;
       height: fit-content;
    }
    .flipdown .rotor-group:first-child {
       display: none;
    }
    .flipdown .rotor-leaf, .flipdown .rotor {
       height: 40px;
       border-radius: 20px;
    }
    /*.flipdown .rotor-leaf-front, .flipdown .rotor-leaf-rear, .flipdown .rotor-top, .flipdown .rotor-bottom, .flipdown .rotor:after {
       height: 18.5px;
    }*/
    .flipdown.flipdown__theme-light .rotor, .flipdown.flipdown__theme-light .rotor-top, .flipdown.flipdown__theme-light .rotor-leaf-front {
       font-size: 15px;
       font-weight: bold;
       background-image: linear-gradient(to bottom right, var(--warna_2), var(--warna_3));
    }
    .flipdown.flipdown__theme-light .rotor-bottom, .flipdown.flipdown__theme-light .rotor-leaf-rear{
       background-image: linear-gradient(to bottom right, var(--warna_2), var(--warna_3));
    }
    .flipdown .rotor, .flipdown .rotor-leaf, .flipdown .rotor-leaf-front, .flipdown .rotor-leaf-rear, .flipdown .rotor-top, .flipdown .rotor-bottom, .flipdown .rotor:after {
       width: 40px;
    }
    .eniv-flash h1 {
       font-size: 20px;
       font-weight: bold;
       display: inline-block;
       margin-bottom: 0;
       margin-right: 12px;
    }
    .eniv-flash h1 svg {
       margin: 0 -3px;
    }
    .eniv-flash h1 img{
       height: 80px;
    }
    .eniv-flash-item {
       display: flex;
       width: 100%;
       align-items: center;
       background-size: cover;
       background-position: center;
       padding: 5px 10px 5px 10px;
       border-radius: 10px;
       position: relative;
       margin-bottom: 14px;
    }
   .eniv-flash-item:before {
       content: ' ';
       background: #22222291;
       display: inline-block;
       position: absolute;
       right: 0;
       left: 0;
       top: 0;
       bottom: 0;
       border-radius: 12px;
   }
   .eniv-flash-item:after {
       content: ' ';
       backdrop-filter: blur(5px);
       -webkit-backdrop-filter: blur(5px);
       display: inline-block;
       position: absolute;
       right: 0;
       left: 0;
       top: 0;
       bottom: 0;
       border-radius: 10px;
   }
   .eniv-flash-item-image {
       width: 60px;
       height: 60px;
       border-radius: 6px;
       background-size: cover;
       background-position: center center;
       margin-right: 12px;
       position: relative;
       top: -30px;
       z-index: 1;
    }
    .eniv-flash-item-content {
       position: relative;
       z-index: 100;
       width: 100%;
    }
    .eniv-flash-item-content h2 {
       font-size: 12px;
       color: #fff;
       margin-bottom: 20px;
       font-weight: 700;
    }
    .eniv-flash-item-content h3 {
       font-size: 14px;
       font-weight: 600;
       margin-bottom: 0px;
       display: inline-block;
       background: var(--warna_3);
       padding: 8px 8px;
       line-height: 12px;
       border-radius: 4px;
       color: #FFF;
    }
    .eniv-flash-item-content h4 {
       font-size: 12px;
       display: inline-block;
       margin-left: 5px;
       font-weight: 500;
       color: #ff4343;
       text-decoration: line-through;
    }    
    .eniv-flash-item-image-flashsale{
       width: 85px;
       height: 85px;
       position: absolute;
       top: -5px;
       right: 0;
       z-index: 1;
    }
    .eniv-flash-item-content-availability{
        margin: 15px 0px 5px 0px;
        border-radius: 10px;
        position: relative;
        background: rgba(255, 255, 255, 0.2);
        text-align: center;
        padding: 2px;
        width: 100%;
    }
    .eniv-flash-item-content-availability span{
        font-size: 10px;
        font-weight: 500;
        color: #fff;
        position: relative;
        z-index: 3;
    }
    .eniv-flash-item-content-availability img{
        position: absolute;
        left: -4px;
        top: -6px;
        width: 28px!important;
        height:32px;
    }
    .eniv-flash-item-content-availability .progress-chart{
        background-image: url('<?= base_url(); ?>/assets/images/barfull6.png'); 
        background-size: cover; background-position: center center; 
        width: 100%; 
        height: 100%; 
        position: absolute; 
        top: 0; 
        border-radius: 10px;
    }
    .animate-flicker {
       animation: flicker 5s linear infinite;
    }
   @keyframes flicker {
       0%,
       19.999%,
       22%,
       62.999%,
       64%,
       64.999%,
       70%,
       to {
           opacity: 0.99;
           filter: drop-shadow(0 0 1px rgb(23 215 153))
               drop-shadow(0 0 15px rgba(245, 158, 11))
               drop-shadow(0 0 1px rgb(23 215 153));
       }
       20%,
       21.999%,
       63%,
       63.999%,
       65%,
       69.999% {
           opacity: 0.4;
           filter: none;
       }
   }
   @media screen AND (max-width: 520px) {
       .d-none-mobile {
           display: none;
       }
       .d-none-pc {
           display: block;
       }
       .eniv-flash .card {
           background: transparent;
           margin-bottom: 20px;
       }
       .eniv-flash .card .card-body {
           padding: 0;
       }
       .flipdown.flipdown__theme-light .rotor, .flipdown.flipdown__theme-light .rotor-top, .flipdown.flipdown__theme-light .rotor-leaf-front {
           font-size: 22px;
       }

       .text-mobile {
           font-size: 16px;
       }

       .flipdown .rotor-leaf, .flipdown .rotor {
           height: 38px;
           border-radius: 20px;
       }
       /*.flipdown .rotor-leaf-front, .flipdown .rotor-leaf-rear, .flipdown .rotor-top, .flipdown .rotor-bottom, .flipdown .rotor:after {
           height: 18.5px;
       }*/
       .flipdown.flipdown__theme-light .rotor, .flipdown.flipdown__theme-light .rotor-top, .flipdown.flipdown__theme-light .rotor-top, .flipdown.flipdown__theme-light .rotor-leaf-front {
           font-size: 20px;
           font-weight: bold;
           background-image: linear-gradient(to bottom right, var(--warna_4), var(--warna_3));
       }
       .flipdown.flipdown__theme-light .rotor-bottom, .flipdown.flipdown__theme-light .rotor-leaf-rear{
           background-image: linear-gradient(to bottom right, var(--warna_4), var(--warna_3));
       }
       .flipdown .rotor, .flipdown .rotor-leaf, .flipdown .rotor-leaf-front, .flipdown .rotor-leaf-rear, .flipdown .rotor-top, .flipdown .rotor-bottom, .flipdown .rotor:after {
           width: 27px;
       }
       .eniv-flash h1 {
           font-size: 10px;
           font-weight: bold;
           display: inline-block;
           margin-bottom: 0;
           margin-right: 12px;
       }
       .eniv-flash h1 svg {
           margin: 0 -3px;
       }
       .eniv-flash h1 img{
           height: 80px;
       }
   }
   @media screen AND (min-width: 520px) {
       .d-none-mobile {
           display: block;
       }
       .d-none-pc {
           display: none;
       }
   }
</style>
<style>
   .eniv-content {
       background-image: url(<?= base_url(); ?>/assets/images/<?= $tema['hero']; ?>);
       background-repeat: no-repeat;
       background-position: top center;
       background-size: contain;
   }
   .eniv-tipe-games {
       display: flex;
       flex-wrap: nowrap;
       overflow: auto;
       margin-bottom: 20px;
   }
   .eniv-tipe-games span {
       padding: 6px 14px;
       border-radius: 8px;
       margin-right: 6px;
       border: 1px solid var(--warna_3);
       color: var(--warna_3);
       cursor: pointer;
       white-space: nowrap;
   }
   .eniv-tipe-games span.active {
       color: #333;
       background: var(--warna_3);
   }
</style>
<?php $this->endSection(); ?>
           
<?php $this->section('content'); ?>
<div class="eniv-content">
   <div class="container">
       <div class="eniv-body">
           <div class="swiper swiper-carousel">
               <div class="swiper-wrapper">
                   <?php foreach ($banner as $loop): ?>
                   <div class="swiper-slide">
                       <a href="<?= $loop['url']; ?>"><img src="<?= $loop['image']; ?>" alt="<?= $loop['alt']; ?>" width="100%" class="rounded"></a>
                   </div>
                   <?php endforeach ?>
               </div>
               <div class="swiper-pagination"></div>
            </div>
            <div class="games-area">
               <?php if ($fs['status'] == 'On'): ?>
               <div class="eniv-flash">
                   <div class="mb-0 d-flex align-items-center">
                       <h1><img src="<?= base_url(); ?>/assets/images/FS.png" class="eniv-flash-image" /></h1>
                       <div id="flipdown" class="flipdown"></div>
                   </div>
                   <div id="flashsale">
                       <div class="owl-carousel">
                           <?php foreach ($fs['product'] as $loop): ?>
                           <div>
                               <a href="<?= base_url(); ?>/games/<?= $loop['games']['slug']; ?>/?product=<?= $loop['id']; ?>" class="eniv-flash-item" style="background-image: url(<?= $loop['games']['image']; ?>);">
                                   <div class="eniv-flash-item-image" style="background-image: url(<?= $loop['games']['image']; ?>);">
                                   </div>
                                   <div class="eniv-flash-item-content">
                                       <small><?= $loop['games']['games']; ?></small>
                                       <h2><?= $loop['product']; ?></h2>
                                       <h3>Rp <?= number_format($loop['price'],0,',','.'); ?></h3>
                                       <h4>Rp <?= number_format($loop['price_cut'],0,',','.'); ?></h4>
                                       <div class="eniv-flash-item-content-availability ">
                                           <?php
                                           $percent = 0;
                                           if($loop['stock'] > 0){
                                               $sisa_stock = $loop['stock'] - $loop['sold'];
                                               $percent = ($sisa_stock/$loop['stock']) * 100;
                                           }
                                           if($loop['stock'] == 0){
                                                $percent = 100;
                                           }
                                           ?>
                                           <div class="progress-chart" style="width:<?= $percent; ?>%"></div>
                                           <img src="<?= base_url(); ?>/assets/images/fire.5ae864091cce5a80c154.webp" alt="fire"/>
                                           <?php if($loop['stock'] > 0){ $stock = $loop['stock'];  }else{ $stock = "∞";} ?>
                                           <span class="text-center">
                                           Tersedia <?= $sisa_stock; ?>
                                           </span>
                                        </div>
                                   </div>
                                   <div class="eniv-flash-item-image-flashsale">
                                        <img src="<?= base_url(); ?>/assets/images/flashsale.gif" />
                                   </div>
                                </a>
                           </div>
                           <?php endforeach; ?>
                       </div>
                   </div>
               </div>
               <?php endif; ?>
               <?php if($config['value'] == 1) { ?>
                   <div class="games-category">
                       <h5>
                           <span>POPULER &#128293;</span>
                       </h5>
                       <div class="row eniv-row">
                       <?php foreach ($populer as $loop): ?>
                           <div class="col-md-2 col-4 eniv-col blackwhite">
                               <a class="games-item" href="<?= base_url(); ?>/games/<?= $loop['slug']; ?>" data-games="<?= $loop['id']; ?>">
                                   <img src="<?= $loop['image']; ?>" alt="">
                                   <h6><?= $loop['games']; ?></h6>
                                   <span><?= $loop['subs_title']; ?></span>
                               </a>
                           </div>
                           <?php endforeach; ?>
                       </div>
                   </div>
               <?php } ?>

             <div class="eniv-tipe-games">
                   <?php $no = 1; foreach ($category as $loop): ?>
                   <span class="" id="tipe-btn-<?= $loop['id']; ?>" onclick="select_tipe('<?= $loop['id']; ?>');"><?= $loop['category']; ?></span>
                   <?php $no++; endforeach; ?>
               </div>
               
               <?php $no = 1; foreach ($games as $category): ?>
                <div class="games-tipe" id="tipe-<?= $category['id']; ?>">
                   <div class="games-category">
                       <h5>
                           <?php
                           $category_text = explode(' ', $category['category']);
                           unset($category_text[count($category_text)-1]);
                           ?>
                           <?= implode(' ', $category_text); ?>
                           <span><?= explode(' ', $category['category'])[count($category_text)]; ?></span>
                       </h5>
                       <div class="row eniv-row" id="data-games-<?= $category['id']; ?>">
                           <?php foreach ($category['games'] as $loop): ?>
                           <div class="col-md-2 col-4 eniv-col">
                               <a class="games-item" href="<?= base_url(); ?>/games/<?= $loop['slug']; ?>" data-games="<?= $loop['id']; ?>">
                                   <img src="<?= $loop['image']; ?>" alt="<?= $loop['games']; ?>">
                                   <h6><?= $loop['games']; ?></h6>
                                   <span><?= $loop['subs_title']; ?></span>
                               </a>
                           </div>
                           <?php endforeach; ?>
                       </div>
                       <?php if (count($category['games']) == 6): ?>
                           <div class="text-center">
                               <button class="btn btn-sm btn-primary mb-4 show-more" data-category="<?= $category['id']; ?>" data-offset="6" style="background:var(--warna_2) !important;color:var(--warna_3) !important;font-size:13px;margin-top:10px;border-radius: 5px !important;">Tampilkan Lainnya</button>
                           </div>
                       <?php endif;?>
                   </div>
               </div>
               <?php $no++; endforeach; ?>
           </div>
           <div class="text-center mb-5">
               <h6 class="fs-20 fw-500">Mengapa Harus TopUp Games Kamu di <?= $web['title']; ?>?</h6>
               <p>Cari tau apa yang buat kamu harus <span class="text-primary">topup game kamu di <b><?= $web['title']; ?></b></span></p>
           </div>
           <div class="row justify-content-center mb-4">
               <div class="col-md-5">
                   <div class="eniv-feature">
                       <div class="eniv-feature-img">
                           <img src="<?= base_url(); ?>/assets/images/feature/1.png" alt="">
                       </div>
                       <div class="eniv-feature-content">
                           <h6 class="fs-16">Harga Termurah</h6>
                           <p class="mb-0 text-muted"><?= $web['title']; ?> selalu memberikan produk berkualitas baik dengan harga termurah  untuk seluruh games yang tersedia.</p>
                       </div>
                   </div>
               </div>
               <div class="col-md-5">
                   <div class="eniv-feature">
                       <div class="eniv-feature-img">
                           <img src="<?= base_url(); ?>/assets/images/feature/2.png" alt="">
                       </div>
                       <div class="eniv-feature-content">
                           <h6 class="fs-16">Metode Pembayaran Terbaik</h6>
                           <p class="mb-0 text-muted"><?= $web['title']; ?> menawarkan begitu banyak pilihan pembayaran mulai dari e-wallet, transfer bank, hingga pembayaran convenience store terdekat.</p>
                       </div>
                   </div>
               </div>
               <div class="col-md-5">
                   <div class="eniv-feature">
                       <div class="eniv-feature-img">
                           <img src="<?= base_url(); ?>/assets/images/feature/3.png" alt="">
                       </div>
                       <div class="eniv-feature-content">
                           <h6 class="fs-16">Banyak Promosi Menarik</h6>
                           <p class="mb-0 text-muted"><?= $web['title']; ?> selalu memberikan penawaran menarik, hingga diskon, untuk kamu pengguna setia <?= $web['title']; ?>.</p>
                       </div>
                   </div>
               </div>
               <div class="col-md-5">
                   <div class="eniv-feature">
                       <div class="eniv-feature-img">
                           <img src="<?= base_url(); ?>/assets/images/feature/4.png" alt="">
                       </div>
                       <div class="eniv-feature-content">
                           <h6 class="fs-16">Proses Pengiriman Instant</h6>
                           <p class="mb-0 text-muted">Proses pengiriman pesanan kamu akan langsung di proses  secara cepat & instant ketika kamu selesai melakukan pembayaran.</p>
                       </div>
                   </div>
               </div>
           </div>
           <div class="text-center mb-5">
               <h1 class="fs-20 fw-500">
                   <img src="<?= $web['logo']; ?>" alt="BELANJA GAME" height="80" width="150">
               </h1>
               <!--<h2 class="fs-20 fw-500"><?= $web['title']; ?></h2>-->
               <p class="mw-500 m-auto"><?= $web['title']; ?> memiliki provider game berkualitas yang terintegrasi dengan <span class="text-primary">lebih dari 50 game dengan total +1000 produk</span></p>
               <p class="mw-500 m-auto">
                    <br />
                    <?= $web['description']; ?>
               </p>
           </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
           
<?php $this->section('js'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/flipdown.min.js"></script>

<script>
$('.show-more').click(function(){
var category = $(this).data('category');
var dataOffset = $(this).data('offset');
var $this = $(this); // Store $(this) reference

$.ajax({
type: 'POST',
url: '<?= base_url('data-ajax') ?>',
data: { id: category, offset: dataOffset, limit: 6 },
success: function(response){
if(response.data.length == 0) {
    $this.remove(); // Use $this instead of $(this)
} else {
    if (response.data[0].games.length < 6) {
        $this.remove(); // Use $this instead of $(this)
    }
    var gameduplicate = 0;
    response.data[0].games.forEach(function(game){
        if ($('#data-games-' + category + ' [data-games="' + game.id + '"]').length === 0) {
            var gameItem = `
                <div class="col-md-2 col-4 eniv-col">
                    <a class="games-item" href="<?= base_url(); ?>/games/${game.slug}" data-games="${game.id}">
                        <img src="${game.image}" alt="${game.games}">
                        <h6>${game.games}</h6>
                        <span>${game.subs_title}</span>
                    </a>
                </div>
            `;
            $('#data-games-' + category).append(gameItem);
        } else {
            gameduplicate++;
        }
    });
    if (gameduplicate > 0) {
        var newOffset = dataOffset + gameduplicate;
        $this.data('offset', newOffset); // Use $this instead of $(this)
        $.ajax({
            type: 'POST',
            url: '<?= base_url('data-ajax') ?>',
            data: { id: category, offset: newOffset, limit: gameduplicate },
            success: function(response){
                if(response.data.length == 0) {
                    $this.remove(); // Use $this instead of $(this)
                } else {
                    response.data[0].games.forEach(function(game){
                        if ($('#data-games-' + category + ' [data-games="' + game.id + '"]').length === 0) {
                            var gameItem = `
                                <div class="col-md-2 col-4 eniv-col">
                                    <a class="games-item" href="<?= base_url(); ?>/games/${game.slug}" data-games="${game.id}">
                                        <img src="${game.image}" alt="${game.games}">
                                        <h6>${game.games}</h6>
                                        <span>${game.subs_title}</span>
                                    </a>
                                </div>
                            `;
                            $('#data-games-' + category).append(gameItem);
                        }
                    });
                }
            }
        });
    }
}
}
});
});

</script>
<script>

   $(".eniv-col").click(function(){
       $(this).removeClass("blackwhite");
   });
   
   document.addEventListener('DOMContentLoaded', () => {
       var flipdown = new FlipDown(<?= strtotime($fs['date']); ?>, {
           theme: "light",
       }).start().ifEnded(() => {
           window.location.reload();
       });
   });
   
   $('.owl-carousel').owlCarousel({
       loop : true,
       margin : 10,
       nav : false,
       stagePadding: 0,
       autoplay : true,
       autoplayTimeout : 3000,
       autoplayHoverPause : true,
       responsive: {
           0:{
               items:1
           },
           600:{
               items:3
           },
           1000:{
               items:3
           }
       }
   });
</script>
<script>
   const swiper = new Swiper('.swiper-carousel', {
       effect: "coverflow",
       grabCursor: true,
       centeredSlides: true,
       slidesPerView: "auto",
       loop: true,
       autoplay: {
           delay: 3000,
           disableOnInteraction: false,
       },
       coverflowEffect: {
           rotate: 30,
           stretch: 0,
           modifier: 1,
           slideShadows: false,
       },
   });
   
   function select_tipe(id) {
       $(".eniv-tipe-games span").removeClass('active');
       $("#tipe-btn-" + id).addClass('active');

       $(".games-tipe").addClass('d-none');
       $("#tipe-" + id).removeClass('d-none');
   }
</script>
<?php $this->endSection(); ?>