<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/bca-get', 'Payment::mutation');
$routes->get('/bca-cron', 'Payment::cron');

$routes->get('/test', 'Home::test');

$routes->match(['get', 'post'], '/update-status', 'Sistem::status');
$routes->match(['get', 'post'], '/check-region', 'Pages::check_region');
$routes->match(['get', 'post'], 'proxy/check-account', 'ProxyController::checkAccount');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/konfigurasi/region/delete/(:num)', 'Admin\Konfigurasi::region/delete/$1');


$routes->post('/data-ajax', 'Home::ajax');

$routes->match(['get', 'post'], '/tata-cara/(:any)', 'Tatacara::index/$1');
$routes->match(['get', 'post'], '/update-harga/(:any)', 'Updateharga::index/$1');

$routes->match(['get', 'post'], '/games/product/check/(:any)', 'Games::product_count/$1');
$routes->match(['get', 'post'], '/games/order/(:any)/(:any)', 'Games::order/$1/$2');
$routes->match(['get', 'post'], '/games/(:any)', 'Games::index/$1');
$routes->match(['get', 'post'], '/syarat-ketentuan', 'Pages::sk');

$routes->match(['get', 'post'], '/read-popup', 'Pages::read_popup');
$routes->match(['get', 'post'], '/win-rate', 'Pages::wr');
$routes->match(['get', 'post'], '/magic-wheel', 'Pages::hp');
$routes->match(['get', 'post'], '/zodiac', 'Pages::zodiac');

$routes->match(['get', 'post'], '/daftar-harga/ajax', 'Pages::daftar_harga/ajax');
$routes->match(['get', 'post'], '/daftar-harga', 'Pages::daftar_harga');
$routes->match(['get', 'post'], '/review', 'Pages::review');
$routes->match(['get', 'post'], '/price', 'Pages::price');
$routes->match(['get', 'post'], '/method', 'Pages::method');
$routes->match(['get', 'post'], '/login', 'Pages::login');
$routes->match(['get', 'post'], '/verif-login', 'Pages::veriflogin');
$routes->match(['get', 'post'], '/verif-reset', 'Pages::verif_reset');
$routes->match(['get', 'post'], '/register', 'Pages::register');
$routes->match(['get', 'post'], '/logout', 'Pages::logout');
$routes->match(['get', 'post'], '/verif', 'Pages::verif');
$routes->match(['get', 'post'], '/forgot', 'Pages::forgot');
$routes->match(['get', 'post'], '/reset', 'Pages::reset');
$routes->match(['get', 'post'], '/top', 'Pages::top');
$routes->match(['get', 'post'], '/api', 'Pages::api');
$routes->match(['get', 'post'], '/api-v2', 'Pages::api_v2');
$routes->match(['get', 'post'], '/otomax', 'Pages::otomax');
$routes->match(['get', 'post'], '/api/(:any)', 'Pages::api/$1');
$routes->match(['get', 'post'], '/daftar-slug/ajax', 'Pages::daftar_slug/ajax');
$routes->match(['get', 'post'], '/daftar-slug', 'Pages::daftar_slug');

$routes->match(['get', 'post'], '/payment/check/list-order', 'Payment::check/list-order');
$routes->match(['get', 'post'], '/payment/check/status/(:any)', 'Payment::check/status/$1');
$routes->match(['get', 'post'], '/payment', 'Payment::index');
$routes->match(['get', 'post'], '/payment/(:any)', 'Payment::index/$1');
$routes->match(['get', 'post'], '/qrcode/(:any)', 'Payment::download_qr_code/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1', 'Admin\Home::indexs');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/password', 'Admin\Home::password');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/login', 'Admin\Home::login');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara', 'Admin\Tatacara::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/add-menu', 'Admin\Tatacara::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/edit-menu/(:num)', 'Admin\Tatacara::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/delete-menu/(:num)', 'Admin\Tatacara::delete/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/add-langkah', 'Admin\Tatacara::addlangkah');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/edit-langkah/(:num)', 'Admin\Tatacara::editlangkah/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/delete-langkah/(:num)', 'Admin\Tatacara::deletelangkah/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/add-content', 'Admin\Tatacara::addcontent');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/edit-content/(:num)', 'Admin\Tatacara::editcontent/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tata-cara/delete-content/(:num)', 'Admin\Tatacara::deletecontent/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/konfigurasi/banner/delete/(:num)', 'Admin\Konfigurasi::banner/delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/konfigurasi', 'Admin\Konfigurasi::index');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/games', 'Admin\Games::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/games/add', 'Admin\Games::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/games/edit/(:num)', 'Admin\Games::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/games/delete/(:num)', 'Admin\Games::delete/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/kategori', 'Admin\Kategori::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/kategori/add', 'Admin\Kategori::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/kategori/edit/(:num)', 'Admin\Kategori::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/kategori/delete/(:num)', 'Admin\Kategori::delete/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/flash', 'Admin\Flash::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/flash/update-product-status/(:num)', 'Admin\Flash::update_product_status/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/flash/update-product-stock', 'Admin\Flash::update_product_stock');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/flash/update-product-stock/(:num)', 'Admin\Flash::update_product_stock/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/target', 'Admin\Target::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/target/add', 'Admin\Target::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/target/edit/(:num)', 'Admin\Target::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/target/delete/(:num)', 'Admin\Target::delete/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/review', 'Admin\Review::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/review/edit/(:num)', 'Admin\Review::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/review/delete/(:num)', 'Admin\Review::delete/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk', 'Admin\Produk::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/add', 'Admin\Produk::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/checked/delete', 'Admin\Produk::deleteall');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/edit/(:num)', 'Admin\Produk::edit/$1');
$routes->match(['get', 'post'], '/admin/produk/update-ajax/(:num)', 'Admin\Produk::update_ajax/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/delete/(:num)', 'Admin\Produk::delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/update-harga/', 'Admin\Updateharga::index');
$routes->match(['get', 'post'], '/admin/produk/ajax-load-profit-setting/', 'Admin\Updateharga::ajax_load_profit_setting');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/update', 'Admin\Produk::update');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/category', 'Admin\Produk::category');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/category/(:any)', 'Admin\Produk::category/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/voucher', 'Admin\Produk::voucher');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/produk/voucher/(:any)', 'Admin\Produk::voucher/$1');


$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan', 'Admin\Pesanan::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/add', 'Admin\Pesanan::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/checked/delete', 'Admin\Pesanan::deleteall');
$routes->match(['get', 'post'], '/admin/pesanan/ajax-load-data', 'Admin\Pesanan::ajax_load_data');
$routes->match(['get', 'post'], '/admin/pesanan/detail/(:num)', 'Admin\Pesanan::detail/$1');
$routes->match(['get', 'post'], '/admin/pesanan/check/(:num)', 'Admin\Pesanan::check/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/edit/(:num)', 'Admin\Pesanan::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/delete/(:num)', 'Admin\Pesanan::delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/refund', 'Admin\Pesanan::refund');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/update-status/(:any)', 'Admin\Pesanan::update_status/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/reorder/(:any)', 'Admin\Pesanan::reorder/$1');
$routes->match(['get', 'post'], '/admin/pesanan/ajax-load-refund', 'Admin\Pesanan::ajax_load_refund');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/history', 'Admin\Pesanan::history');
$routes->match(['get', 'post'], '/admin/pesanan/ajax-load-history', 'Admin\Pesanan::ajax_load_history');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/edit-history/(:num)', 'Admin\Pesanan::edit_history/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/delete-history/(:num)', 'Admin\Pesanan::delete_history/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pesanan/export', 'Admin\Pesanan::export');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode', 'Admin\Metode::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/add', 'Admin\Metode::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/edit/(:num)', 'Admin\Metode::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/delete/(:num)', 'Admin\Metode::delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/price/(:num)', 'Admin\Metode::price/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/regist', 'Admin\Metode::price_regist');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/category', 'Admin\Metode::category');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/category/(:any)', 'Admin\Metode::category/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/metode/category/(:any)/(:num)', 'Admin\Metode::category/$1/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna', 'Admin\Pengguna::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/add', 'Admin\Pengguna::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/edit/(:num)', 'Admin\Pengguna::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/send-balance', 'Admin\Pengguna::send_balance');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/send-balance/(:num)', 'Admin\Pengguna::send_balance/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/delete/(:num)', 'Admin\Pengguna::delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/reset/(:num)', 'Admin\Pengguna::reset/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/reset-sandi/(:num)', 'Admin\Pengguna::reset_password/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/pengguna/upgrademembership/(:num)', 'Admin\Pengguna::upgrade_membership/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/topup', 'Admin\Topup::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/topup/edit/(:num)', 'Admin\Topup::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/topup/detail/(:num)', 'Admin\Topup::detail/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/topup/delete/(:num)', 'Admin\Topup::delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/topup/accept/(:num)', 'Admin\Topup::accept/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/upgrademembership', 'Admin\UpgradeMembership::index');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/whatsapp', 'Admin\Whatsapp::index');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/admin', 'Admin\Admin::index');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/tema', 'Admin\Tema::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/sosmed', 'Admin\Sosmed::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/sosmed/add', 'Admin\Sosmed::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/sosmed/edit/(:num)', 'Admin\Sosmed::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/sosmed/delete/(:num)', 'Admin\Sosmed::delete/$1');


$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/admin/add', 'Admin\Admin::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/digiflazz/export', 'Digiflazz::exportPage');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/logout', 'Admin\Admin::logout');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/admin/edit/(:num)', 'Admin\Admin::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/admin/delete/(:num)', 'Admin\Admin::delete/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/admin/reset/(:num)', 'Admin\Admin::reset/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/excel', 'Admin\Excel::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/voucher', 'Admin\Voucher::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/voucher/add', 'Admin\Voucher::add');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/voucher/edit/(:num)', 'Admin\Voucher::edit/$1');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/voucher/delete/(:num)', 'Admin\Voucher::delete/$1');

$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/ip', 'Admin\Home::ip');

$routes->match(['get'], '/-9J6DWAuK/]:C2Tx1/config', 'Admin\Config::index');
$routes->match(['get', 'post'], '/-9J6DWAuK/]:C2Tx1/config/update/(:any)', 'Admin\Config::update/$1');
$routes->match(['post'], '/admin/config/click', 'Admin\Config::add_jumlah_click');

$routes->match(['get', 'post'], '/user', 'User::index');
$routes->match(['post'], '/user/reset-apikey', 'User::generate_api');
$routes->match(['post'], '/user/callback-url', 'User::update_callback');
$routes->match(['get', 'post'], '/user/topup', 'User::topup');
$routes->match(['get', 'post'], '/user/topup/(:any)', 'User::topup/$1');
$routes->match(['get', 'post'], '/user/upgrademembership', 'User::upgrademembership');
$routes->match(['get', 'post'], '/user/upgrademembership/(:any)', 'User::upgrademembership/$1');
$routes->match(['get', 'post'], '/user/pesanan-saya', 'User::my_order');
$routes->match(['get', 'post'], '/user/riwayat', 'User::order_history');
$routes->match(['get', 'post'], '/user/download-riwayat-pesanan', 'User::export_order_history');
$routes->match(['get', 'post'], '/user/daftar-harga/ajax', 'User::daftar_harga/ajax');
$routes->match(['get', 'post'], '/user/daftar-harga', 'User::daftar_harga');
$routes->match(['get', 'post'], '/user/google-auth', 'User::scan_google_auth');
$routes->match(['get', 'post'], '/user/send-balance', 'User::send_balance');
$routes->match(['get', 'post'], '/user/riwayat-transfer', 'User::transfer_history');
$routes->match(['get', 'post'], '/user/riwayat-transfer/(:any)', 'User::transfer_history/$1');
$routes->match(['get', 'post'], '/user/save-id', 'User::index_save_id');
$routes->match(['get', 'post'], '/user/get-banner', 'User::getBanner');
$routes->match(['get', 'post'], '/user/save_id_player', 'User::save_id_player');
$routes->match(['get', 'post'], '/user/delete_data_player/(:num)', 'User::delete_data/$1');
$routes->match(['get', 'post'], '/user/getTargetFields', 'User::getTargetFields');


$routes->match(['get', 'post'], '/sistem/callback/(:any)', 'Sistem::callback/$1');
$routes->match(['get', 'post'], '/sistem/callback_digiflazz', 'Sistem::callback_digiflazz');
$routes->match(['get', 'post'], '/sistem/callback_vocagame', 'Sistem::callback_vocagame');
$routes->match(['get', 'post'], '/sistem/callback_gamepoint', 'Sistem::callback_gamepoint');
$routes->match(['get', 'post'], '/sistem/refund_balance', 'Sistem::refund_balance');
$routes->match(['get', 'post'], '/sistem/eod', 'Sistem::eod');
$routes->match(['get', 'post'], '/sistem/expiry_orders', 'Sistem::set_order_expired');

$routes->group('digiflazz', function($routes) {
    $routes->match(['get', 'post'], 'products', 'Digiflazz::getAllProducts');
    $routes->match(['get', 'post'], 'products/(:segment)', 'Digiflazz::getProductByCode/$1');
    $routes->get('products/brand/(:segment)', 'Digiflazz::getProductsByBrand/$1');
    $routes->get('product', 'Digiflazz::getProduct');
});

$routes->group('tokogar',  function($routes) {
    $routes->get('export', 'Tokogar::exportPage');
    $routes->match(['get', 'post'], 'products', 'Tokogar::getAllProducts');
   // $routes->get('products', 'Tokogar::getAllProducts');
   // $routes->get('products/brand/(:any)', 'Tokogar::getProducts');
});

$routes->get('tokogar/products/brand', 'Tokogar::getProducts');
$routes->get('tokogar/products/brand/(:any)', 'Tokogar::getProducts/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
