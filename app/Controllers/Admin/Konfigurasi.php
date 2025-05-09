<?php

namespace App\Controllers\Admin;
use App\Models\M_Base;
use App\Controllers\BaseController;
use Cloudinary\Cloudinary;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Konfigurasi extends BaseController {

    private $cloudinary;

    public function __construct(){
        $m_base = new M_Base();
        $cloudinary_name = $m_base->u_get('cloudinary_name');
        if(empty($cloudinary_name)){
            $cloudinary_name = "dwaihanw9";
        }
        $cloudinary_key = $m_base->u_get('cloudinary_key');
        if(empty($cloudinary_key)){
            $cloudinary_key = "519328715711546";
        }
        $cloudinary_secret = $m_base->u_get('cloudinary_secret');
        if(empty($cloudinary_secret)){
            $cloudinary_secret = "kUYIs6kWlrTiUr5RBOzGub7NGfM";
        }
        $this->cloudinary = new Cloudinary(
            [
                'cloud' => [
                    'cloud_name' => $cloudinary_name,
                    'api_key'    => $cloudinary_key,
                    'api_secret' => $cloudinary_secret,
                ],
                'url' => [
                    'secure' => true
                ]
            ]
        );
    }

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            if ($this->request->getPost('tombol') == 'umum') {

                $this->M_Base->u_update('web-title', $this->request->getPost('title'));
                $this->M_Base->u_update('web-name', $this->request->getPost('name'));
                $this->M_Base->u_update('deskripsi', $this->request->getPost('deskripsi'));
                $this->M_Base->u_update('web-keywords', $this->request->getPost('keywords'));
                $this->M_Base->u_update('web-description', $this->request->getPost('descriptiona'));
                $this->M_Base->u_update('upgrade-membership', $this->request->getPost('upgrade-membership'));
                $this->M_Base->u_update('kode-store', $this->request->getPost('kode-store'));
                $this->M_Base->u_update('limit-populer', $this->request->getPost('limit-populer'));
                $this->M_Base->u_update('end-top', $this->request->getPost('end-top'));
                $this->M_Base->u_update('image_footer', $this->request->getPost('image_footer'));
                $this->M_Base->u_update('description_footer', $this->request->getPost('description_footer'));
                $this->M_Base->u_update('tawkto', $this->request->getPost('tawkto'));
                $this->M_Base->u_update('profit', $this->request->getPost('profit'));
                $this->M_Base->u_update('profit-silver', $this->request->getPost('profit-silver'));
                $this->M_Base->u_update('profit-gold', $this->request->getPost('profit-gold'));
                $this->M_Base->u_update('profit-bisnis', $this->request->getPost('profit-bisnis'));

                // $logo = $this->M_Base->upload_file($this->request->getFiles()['logo'], 'assets/images/');
                $logofile = $this->request->getFile('logo');
                if($logofile) {
                    $tempPath = $logofile->getTempName();
                    if(!empty($tempPath)) {
                        $randomFilenamelogo = 'logo_' . uniqid() . '_' . time() . '_' . date('Ymd');
                        $logo = $this->cloudinary->uploadApi()->upload($tempPath, 
                        ["public_id" => $randomFilenamelogo, 'folder' => 'logo']
                    );

                    if ($logo) {
                        $this->M_Base->u_update('web-logo', $logo['secure_url']);
                    }
                    }
                }

                $logoinvoicefile = $this->request->getFile('logoinvoice');
                if($logoinvoicefile) {
                    $tempPathinvoicefile = $logoinvoicefile->getTempName();
                    if(!empty($tempPathinvoicefile)) {
                        $randomFilenamelogoinvoice = 'logoinvoice_' . uniqid() . '_' . time() . '_' . date('Ymd');
                       $logoinvoice = $this->cloudinary->uploadApi()->upload($tempPathinvoicefile, 
                            ["public_id" => $randomFilenamelogoinvoice, 'folder' => 'favicon']
                        );

                        if ($logoinvoice) {
                            $this->M_Base->u_update('logoinvoice', $logoinvoice['secure_url']);
                        }
                    }
                }

                $faviconfile = $this->request->getFile('favicon');
                if($faviconfile) {
                    $tempPathfaviconfile = $faviconfile->getTempName();
                    if(!empty($tempPathfaviconfile)) {
                        $randomFilenamefavicon = 'favicon_' . uniqid() . '_' . time() . '_' . date('Ymd');
                       $favicon = $this->cloudinary->uploadApi()->upload($tempPathfaviconfile, 
                            ["public_id" => $randomFilenamefavicon, 'folder' => 'favicon']
                        );

                        if ($favicon) {
                            $this->M_Base->u_update('favicon', $favicon['secure_url']);
                        }
                    }
                }
                

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'ip') {
                if (empty($this->request->getPost('googleauth'))) {
                    $this->session->setFlashdata('error', 'Masukan Google Auth');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                    $secret_key = $admin[0]['secret_key'];
    
                    $googleAuth = new GoogleAuthenticator();
                    $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
                    
                    if ($checkResult == true) {
                        $this->M_Base->u_update('ip', $this->request->getPost('ip'));

                        $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }
            } else if ($this->request->getPost('tombol') == 'cloudinary') {
                $this->M_Base->u_update('cloudinary_name', $this->request->getPost('cloudname'));
                $this->M_Base->u_update('cloudinary_key', $this->request->getPost('key'));
                $this->M_Base->u_update('cloudinary_secret', $this->request->getPost('secret'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'banner') {

                // $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/banner/');

                $bannerfile = $this->request->getFile('image');
                if(!empty($bannerfile)){
                    $tempPath = $bannerfile->getTempName();
                    $randomFilename = uniqid() . '_' . time();
                    $image = $this->cloudinary->uploadApi()->upload($tempPath, 
                        ["public_id" => $randomFilename, 'folder' => 'banner']
                    );
                    $image_url = $image['secure_url'];
                }else{
                    $image_url = $this->request->getPost('image');
                }

                if ($image_url) {
                    if(!empty($this->request->getPost('id'))){
                        $this->M_Base->data_update('banner', [
                            'url' => $this->request->getPost('url'),
                            'alt' => $this->request->getPost('alt'),
                        ], $this->request->getPost('id'));
                        $this->session->setFlashdata('success', 'Banner berhasil diupdate');
                    }else{
                        $this->M_Base->data_insert('banner', [
                            'image' => $image_url,
                            'url' => $this->request->getPost('url'),
                            'alt' => $this->request->getPost('alt'),
                        ]);
                        $this->session->setFlashdata('success', 'Banner berhasil ditambahkan');
                    }

                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar banner tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            } else if ($this->request->getPost('tombol') == 'region') {

                // $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/banner/')
                    if(!empty($this->request->getPost('id'))){
                        $this->M_Base->data_update('region', [
                            'url_link' => $this->request->getPost('url'),
                            'region' => $this->request->getPost('region'),
                        ], $this->request->getPost('id'));
                        $this->session->setFlashdata('success', 'Region berhasil diupdate');
                    }else{
                        $this->M_Base->data_insert('region', [
                            'url_link' => $this->request->getPost('url'),
                            'region' => $this->request->getPost('country'),
                        ]);
                        $this->session->setFlashdata('success', 'Region berhasil ditambahkan');
                    }

                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        
            }else if ($this->request->getPost('tombol') == 'digi') {
                $this->M_Base->u_update('digi-user', $this->request->getPost('user'));
                $this->M_Base->u_update('digi-key', $this->request->getPost('key'));
                $this->M_Base->u_update('seller-digi-username', $this->request->getPost('sellerusername'));
                $this->M_Base->u_update('seller-digi-key', $this->request->getPost('sellerkey'));
                $this->M_Base->u_update('saldo-seller-digi', $this->request->getPost('saldo'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'ag') {
                $this->M_Base->u_update('ag-merchant', $this->request->getPost('merchant'));
                $this->M_Base->u_update('ag-secret', $this->request->getPost('secret'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'tripay') {
                $this->M_Base->u_update('tripay-key', $this->request->getPost('key'));
                $this->M_Base->u_update('tripay-private', $this->request->getPost('private'));
                $this->M_Base->u_update('tripay-merchant', $this->request->getPost('merchant'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'xendit') {
                $this->M_Base->u_update('xendit-secret-key', $this->request->getPost('secret_key'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'enivay') {
                $this->M_Base->u_update('enivay-license', $this->request->getPost('enivay'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'sm') {
                $this->M_Base->u_update('sm-wa', $this->request->getPost('wa'));
                $this->M_Base->u_update('sm-ig', $this->request->getPost('ig'));
                $this->M_Base->u_update('sm-yt', $this->request->getPost('yt'));
                $this->M_Base->u_update('sm-fb', $this->request->getPost('fb'));
                $this->M_Base->u_update('sm-tw', $this->request->getPost('tw'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'sk') {
                $this->M_Base->u_update('page_sk', $this->request->getPost('page_sk'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($this->request->getPost('tombol') == 'xendit') {
                $this->M_Base->u_update('xendit_key', $this->request->getPost('xendit_key'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'moota') {
                
                $this->M_Base->u_update('moota_secret', $this->request->getPost('moota_secret'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'voca') {
                
                $this->M_Base->u_update('voca_key', $this->request->getPost('voca_key'));
                $this->M_Base->u_update('voca_secret', $this->request->getPost('voca_secret'));
                $this->M_Base->u_update('voca_merchant', $this->request->getPost('voca_merchant'));
                
                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'tokopay') {
                
                $this->M_Base->u_update('tokopay_merchant', $this->request->getPost('tokopay_merchant'));
                $this->M_Base->u_update('tokopay_secret', $this->request->getPost('tokopay_secret'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'bj') {
                
                $this->M_Base->u_update('bj_key', $this->request->getPost('bj_key'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'tokogar') {
                
                $this->M_Base->u_update('api_tokogar', $this->request->getPost('api_tokogar'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'UniPin') {
                
                $this->M_Base->u_update('unipin_email', $this->request->getPost('email_up'));
                $this->M_Base->u_update('unipin_password', $this->request->getPost('password_up'));
                $this->M_Base->u_update('unipin_pin', $this->request->getPost('pin_up'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'hokitopup') {
                
                $this->M_Base->u_update('hokitopup', $this->request->getPost('hokitopup'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));

            } else if ($this->request->getPost('tombol') == 'kurs_myr') {
                
                $this->M_Base->u_update('kurs_myr', $this->request->getPost('kurs_myr'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'order_timer') {
                
                $this->M_Base->u_update('order_timer', $this->request->getPost('order_timer'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'popup') {
                
                $this->M_Base->u_update('popup_status', $this->request->getPost('popup_status'));
                $this->M_Base->u_update('popup_link_url', $this->request->getPost('popup_link_url'));
                $this->M_Base->u_update('popup_image_url', $this->request->getPost('popup_image_url'));
                $this->M_Base->u_update('popup_content', $this->request->getPost('popup_content'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else if ($this->request->getPost('tombol') == 'dk') {
                
                $this->M_Base->u_update('dk_key', $this->request->getPost('dk_key'));
                $this->M_Base->u_update('dk_merchant', $this->request->getPost('dk_merchant'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            }else if ($this->request->getPost('tombol') == 'moogold') {
                
                $this->M_Base->u_update('moogold_pid', $this->request->getPost('partner_id'));
                $this->M_Base->u_update('moogold_secretkey', $this->request->getPost('secret_key'));

                $this->session->setFlashdata('success', 'Data konfiguasi berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Konfigurasi',
            'tripay' => [
                'key' => $this->M_Base->u_get('tripay-key'),
                'private' => $this->M_Base->u_get('tripay-private'),
                'merchant' => $this->M_Base->u_get('tripay-merchant'),
            ],
            'xendit' => [
                'secret_key' => $this->M_Base->u_get('xendit-secret-key'),
            ],
            'ag' => [
                'merchant' => $this->M_Base->u_get('ag-merchant'),
                'secret' => $this->M_Base->u_get('ag-secret'),
            ],
            'popup' => [
                'status' => $this->M_Base->u_get('popup_status'),
                'link_url' => $this->M_Base->u_get('popup_link_url'),
                'image_url' => $this->M_Base->u_get('popup_image_url'),
                'content' => $this->M_Base->u_get('popup_content'),
            ],
            'dk' => [
                'key' => $this->M_Base->u_get('dk_key'),
                'merchant' => $this->M_Base->u_get('dk_merchant'),
            ],
            'tokopay' => [
                'merchant' => $this->M_Base->u_get('tokopay_merchant'),
                'secret' => $this->M_Base->u_get('tokopay_secret'),
            ],
            'digi' => [
                'user' => $this->M_Base->u_get('digi-user'),
                'key' => $this->M_Base->u_get('digi-key'),
                'sellerusername' => $this->M_Base->u_get('seller-digi-username'),
                'sellerkey' => $this->M_Base->u_get('seller-digi-key'),
                'saldo' => $this->M_Base->u_get('saldo-seller-digi'),
            ],
            'voca' => [
                'key' => $this->M_Base->u_get('voca_key'),
                'secret' => $this->M_Base->u_get('voca_secret'),
                'merchant' => $this->M_Base->u_get('voca_merchant'),
            ],
            'unipin' => [
                'email_up' => $this->M_Base->u_get('unipin_email'),
                'password_up' => $this->M_Base->u_get('unipin_password'),
                'pin_up' => $this->M_Base->u_get('unipin_pin'),
            ],
            'cloudinary' => [
                'cloudname' => $this->M_Base->u_get('cloudinary_name'),
                'key' => $this->M_Base->u_get('cloudinary_key'),
                'secret' => $this->M_Base->u_get('cloudinary_secret'),
            ],
            'enivay' => $this->M_Base->u_get('enivay-license'),
            'hokitopup' => $this->M_Base->u_get('hokitopup'),
            'kurs_myr' => $this->M_Base->u_get('kurs_myr'),
            'order_timer' => $this->M_Base->u_get('order_timer'),
            'banner' => $this->M_Base->all_data('banner'),
            'region' => $this->M_Base->all_data('region'),
            'page_sk' => $this->M_Base->u_get('page_sk'),
            'moota_secret' => $this->M_Base->u_get('moota_secret'),
            'xendit_key' => $this->M_Base->u_get('xendit_key'),
            'bj_key' => $this->M_Base->u_get('bj_key'),
            'api_tokogar' => $this->M_Base->u_get('api_tokogar'),
            'moogold' => [
                'partner_id' => $this->M_Base->u_get('moogold_pid'),
                'secret_key' => $this->M_Base->u_get('moogold_secretkey'),
            ],
            'netflazz' => [
                'netflazz_apikey' => $this->M_Base->u_get('netflazz_apikey'),
                'netflazz_secretkey' => $this->M_Base->u_get('netflazz_secretkey'),
            ],
    	]);

        return view('Admin/Konfigurasi/index', $data);
    }

    public function banner($action = null, $id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if ($action === 'delete') {
            if (is_numeric($id)) {
                $this->M_Base->data_delete('banner', $id);

                $this->session->setFlashdata('success', 'Banner berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/konfigurasi');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function region($action = null, $id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if ($action === 'delete') {
            if (is_numeric($id)) {
                $this->M_Base->data_delete('region', $id);

                $this->session->setFlashdata('success', 'Region berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/konfigurasi');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}