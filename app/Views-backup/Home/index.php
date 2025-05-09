            <?php $this->extend('template'); ?>
            
            <?php $this->section('css'); ?>
            <?php $this->endSection(); ?>
            
            <?php $this->section('content'); ?>
            <div class="mb-4" style="padding-top: 110px;">
                <div class="container">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php $no = 0; foreach ($banner as $loop): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $no; ?>" <?= $no == 0 ? 'class="active"' : ''; ?>></li>
                            <?php $no++; endforeach ?>
                        </ol>
                        <div class="carousel-inner" style="border-radius: 16px;">
                            <?php $no = 1; foreach ($banner as $loop): ?>
                            <div class="carousel-item <?= $no == 1 ? 'active' : ''; ?>">
                                <img class="d-block w-100" src="<?= base_url(); ?>/assets/images/banner/<?= $loop['image']; ?>" alt="First slide">
                            </div>
                            <?php $no++; endforeach ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="nav-item mt-4 dropdown d-lg-inline-block mx-auto justify-content-center">
                        <!--<li class="nav-item pe-md-2 dropdown d-lg-inline-block ">-->
                            <form action="" method="get">
                            <div class="input-group me-3" aria-haspopup="true" id="dropsearchdown">
                            <input style="width:200px; border: 1px solid #ced4da;" type="text" name="q" placeholder="Cari Game anda disini" id="searchProds" class="form-control search_input" autocomplete="off">
                            <button type="submit" class="btn btn-primary" id="btnSearchProds">
                            <i class="fa fa-search"></i>
                            </button>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-dark position-absolute shadow navbar-nav-scroll" aria-labelledby="dropsearchdown" id="dropDownSearchResults">
                            </ul>
                            </form>
                        <!--</li>-->
                    </div>
                </div>
            </div>
            
            <?php foreach ($games as $game): ?>
            <div class="container pt-4 pb-4">
                <div class="row">
                    <div class="col-12">
                        <h5 id="<?= $game['category']; ?>"><?= $game['category']; ?></h5>
                        <span class="strip-primary"></span>
                    </div>
                </div>
            </div>
            <div class="pb-4">
                <div class="container">
                    <div class="row game">
                        <?php foreach ($game['games'] as $loop): ?>
                        <?php if ($loop['status'] == 'On'): ?>
                        <div class="col-sm-3 col-lg-2 col-4 text-center" style="margin-top: 50px; padding-right: 0.5%; padding-left: 0.5%;">
                            <div class="card mb-3" id="cardGame<?= $loop['id'] ?>">
                                <a href="<?= base_url(); ?>/games/<?= $loop['slug']; ?>" class="product_list">
                                    <div class="card-game" bis_skin_checked="1">
                                        <img src="<?= base_url(); ?>/assets/images/games/<?= $loop['image']; ?>" class="img-fluid" style="border-radius: 10px; display: block; margin-top: -60px;">
                                    </div>
                                    <div class="card-title" bis_skin_checked="1" id="cardGameTitle<?= $loop['id'] ?>"> <?= $loop['games']; ?> </div>
                                    <div class="card-subtitle" bis_skin_checked="1" style="margin-top: 23px;"><?php if ($game['category'] == 'Top Up Game') {?><small class="text-sm text-muted" style="font-size: 11px;">Proses Otomatis</small><?php } ?></div>
                                    <div class="card-topup" bis_skin_checked="1">
                                        <div class="btn-topup" style="font-size: 0.60rem!important;" bis_skin_checked="1"> TOP UP </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <?php $this->endSection(); ?>
            
            <?php $this->section('js'); ?>
            <?php $this->endSection(); ?>