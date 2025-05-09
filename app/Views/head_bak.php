<head>
    <!--
    Script ini dibuat oleh Frendy Santoso dari PT. Enivay Interkoneksi Indoensia
    Perlu bantuan? hubungi : wa.me/6285654008642
    -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $web['deskripsi']; ?>">
    <meta name="keywords" content="<?= $web['keywords']; ?>">

    <title><?= $title; ?></title>

    <meta property="og:image" content="<?= $web['logo']; ?>" />
    <link rel="shortcut icon" href="<?= $web['favicon']; ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

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
    .tawkto-chat .tawkto-chat-widget {
        position: fixed;
        bottom: 200px;
        right: 200px;
        z-index: 10000;
    }
    </style>

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/swiper-style.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/responsive.css" />

    <?php if($web['tawkto-config']['value'] == 1) { ?>
       <?= $web['tawkto'] ?>
    <?php } ?>

    <style>
    .card-auth {
        background-image: url(<?= base_url(); ?>/assets/images/auth-bg.png);
    }
    .eniv-loading {
        background-image: url(<?= base_url(); ?>/assets/images/loading.gif);
    }
    </style>

    <?php $this->renderSection('css'); ?>

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>