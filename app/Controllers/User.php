<?php

namespace App\Controllers;

use GoogleAuthenticator\GoogleAuthenticator;
use Xendit\Xendit;
use Xendit\PaymentChannels;
use Dolondro\GoogleAuthenticator\SecretFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\Session\Session;

class User extends BaseController {

    public function index() {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            $level_av = [];
            
            $level_id_now = $this->M_Base->data_where('level', 'level', $this->users['level']);
            
            if (count($level_id_now) == 1) {
                
                $level_av = $this->M_Base->data_where_array('level', [
                    'id >' => $level_id_now[0]['id'],
                ]);
            }
            
            $total_order = 0;
             foreach ($this->M_Base->data_where('orders', 'username', $this->users['username']) as $loop) {
                 
                 if ($loop['status'] == 'Success') {
                    
                    $total_order += $loop['price'];
                }
             }

             $ga = new SecretFactory;
             $issuer = $this->base_data['web']['name'];
             $accountName = $this->users['username'];
     
             if($this->users['secret_key']) {
                 $secretkey = $this->users['secret_key'];
                 $secreturl = $this->users['secret_url'];
             } else {
                 $secret = $ga->create($issuer, $accountName);
                 $secretkey = $secret->getSecretKey();
                 $secreturl = $secret->getUri();
     
                 $this->M_Base->data_update('users', ['secret_key' => $secretkey, 'secret_url'  => $secreturl], $this->users['id']);
             }
     
             $qrCodeUrl = 'https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl='.$secreturl;

        	$data = array_merge($this->base_data, [
        		'title' => 'Beranda',
        		'level_av' => $level_av,
        		'total' => [
        		    'orders' => $this->M_Base->data_count('orders', ['username' => $this->users['username']]),
        		    'pending' => $this->M_Base->data_count('orders', ['username' => $this->users['username'], 'status' => 'Pending']),
        		    'processing' => $this->M_Base->data_count('orders', ['username' => $this->users['username'], 'status' => 'Processing']),
        		    'success' => $this->M_Base->data_count('orders', ['username' => $this->users['username'], 'status' => 'Success']),
        		    'canceled' => $this->M_Base->data_count('orders', ['username' => $this->users['username'], 'status' => 'Canceled']),
        		],
        		'menu_users' => 'Dashboard',
                'orders' => $total_order,
                'qr' => $qrCodeUrl
        	]);

            return view('User/index', $data);
        }
    }

    public function daftar_harga($action = null) {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
        if ($action == null) {
            
            if ($this->request->getPost('tombol')) {
            
                $data_post = [
                    'games' => $this->request->getPost('games'),
                ];
                
                        if($this->users['level'] == 'Member') {
                            $columns = ['product.id', 'product.games_id', 'games.games', 'product.product', 'product.price as price', 'product.status'];
                        } elseif($this->users['level'] == 'Silver'){
                            $columns = ['product.id', 'product.games_id', 'games.games', 'product.product', 'product.price_silver as price', 'product.status'];
                        } elseif($this->users['level'] == 'Gold'){
                            $columns = ['product.id', 'product.games_id', 'games.games', 'product.product', 'product.price_gold as price', 'product.status'];
                        } elseif($this->users['level'] == 'Bisnis'){
                            $columns = ['product.id', 'product.games_id', 'games.games', 'product.product', 'product.price_bisnis as price', 'product.status'];
                        }
                
                        if ($data_post['games']) {
                            $query = array_reverse(
                                $this->db->table('product')
                                    ->select($columns)
                                    ->join('games', 'games.id = product.games_id')
                                    ->where(['games_id' => $data_post['games']]) 
                                    ->orderBy('product.games_id', 'ASC')
                                    ->get()
                                    ->getResultArray()
                            );
                        } else {
                            $query = $this->db->table('product')
                                ->select($columns)
                                ->join('games', 'games.id = product.games_id')
                                ->orderBy('product.games_id', 'ASC')
                                ->get()
                                ->getResultArray();
                        }
                        
                        if (count($query) !== 0) {
                            
                            $file_name = 'export-product-' . $data_post['games'] . '.xlsx';
                            
                            $spreadsheet = new Spreadsheet();
                            $sheet = $spreadsheet->getActiveSheet();
                            
                            $sheet->setCellValue('A1', 'ID Produk');
                            $sheet->setCellValue('B1', 'Games');
                            $sheet->setCellValue('C1', 'Nama Produk');
                            $sheet->setCellValue('D1', 'Price');
                            $sheet->setCellValue('E1', 'Status');
                            
                            $line = 2;
                            
                            foreach ($query as $loop) {

                                $sheet->setCellValue('A' . $line, $loop['id'].'.'.$loop['games_id']);
                                $sheet->setCellValue('B' . $line, $loop['games']);
                                $sheet->setCellValue('C' . $line, $loop['product']);
                                $sheet->setCellValue('D' . $line, $loop['price']);
                                $sheet->setCellValue('E' . $line, $loop['status']);
                                
                                $line++;
                            }
                            
                            $writer = new Xlsx($spreadsheet);
                            $writer->save('assets/excel/' . $file_name);
                            
                            return redirect()->to(base_url() . '/assets/excel/' . $file_name);
                            
                        } else {
                            $this->session->setFlashdata('error', 'Tidak ada produk');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Daftar Harga',
        		'menu_users' => 'Daftar Harga',
        		'games' => $this->M_Base->data_where('games', 'status', 'On'),
        	]);
    
            return view('User/daftar_harga', $data);
            
        } else if ($action === 'ajax') {
            
            if ($this->request->getGet('games')) {
                
                $query = $this->M_Base->data_where('product', 'games_id', $this->request->getGet('games'));
                
            } else {
                $query = $this->M_Base->all_data('product');
            }
            
            $services = [];
            foreach($query as $loop) {
                
                if ($loop['status'] == 'On') {
                    $badge = 'success';
                    $status_text = 'Normal';
                } else {
                    $badge = 'danger';
                    $status_text = 'Gangguan';
                }
                
                $data_games = $this->M_Base->data_where('games', 'id', $loop['games_id']);
                
                if (count($data_games) == 1) {
                    $url = '/games/' . $data_games[0]['slug'];
                    $games = $data_games[0]['games'];
                } else {
                    $url = '/';
                    $games = '-';
                }
                
                $services[] = [
                    $loop['id'].".".$loop['games_id'],
                    $games,
                    $loop['product'],
                    'Rp ' . number_format($loop['price'],0,',','.'),
                    'Rp ' . number_format($loop['price_silver'],0,',','.'),
                    'Rp ' . number_format($loop['price_gold'],0,',','.'),
                    'Rp ' . number_format($loop['price_bisnis'],0,',','.'),
                    '<span class="badge bg-'.$badge.' p-2">' . $status_text . '</span>',
                    '<a href="'.$url.'" class="btn btn-primary">Beli</a>'
                ];
            }
            
            echo json_encode([
                'data' => $services,
            ]);
            
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    }
    
    private function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
    
    public function generate_api() {
        $data_post = [
                'api_key' => 'API-'.$this->generateRandomString(30)
                ];
            $this->M_Base->data_update('users', $data_post, $this->users['id']);

            $this->session->setFlashdata('success', 'Berhasil Reset Api key');
            return redirect()->to(str_replace('index.php/', '', site_url('user/settings')));
    }
    
    public function update_callback() {
            $data_post = [
                'callback_url' => $this->request->getPost('callback_url'),
                'ip_api' => $this->request->getPost('ip_api')
                ];
            $this->M_Base->data_update('users', $data_post, $this->users['id']);

            $this->session->setFlashdata('success', 'Berhasil update callback URL');
            return redirect()->to(str_replace('index.php/', '', site_url('user/settings')));
    }

    public function settings() {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if ($this->request->getPost('btn_password')) {
                $data_post = [
                    'passwordl' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordl')))),
                    'passwordb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordb')))),
                    'passwordbb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordbb')))),
                ];

                if (empty($data_post['passwordl'])) {
                    $this->session->setFlashdata('error', 'Password lama tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (empty($data_post['passwordb'])) {
                    $this->session->setFlashdata('error', 'Password baru tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (empty($data_post['passwordbb'])) {
                    $this->session->setFlashdata('error', 'Konfirmasi password tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['passwordb']) < 6) {
                    $this->session->setFlashdata('error', 'Password minimal 6 karakter');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['passwordb']) > 24) {
                    $this->session->setFlashdata('error', 'Password maksimal 24 karakter');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if ($data_post['passwordb'] !== $data_post['passwordbb']) {
                    $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (!password_verify($data_post['passwordl'], $this->users['password'])) {
                    $this->session->setFlashdata('error', 'Password lama tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->M_Base->data_update('users', [
                        'password' => password_hash($data_post['passwordb'], PASSWORD_DEFAULT),
                    ], $this->users['id']);

                    $this->session->setFlashdata('success', 'Password berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }

            if ($this->request->getPost('tombol')) {
                $data_post = [
                    'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                ];

                if (empty($data_post['wa'])) {
                    $this->session->setFlashdata('error', 'Nomor whatsapp tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['wa']) < 10 OR strlen($data_post['wa']) > 14) {
                    $this->session->setFlashdata('error', 'Nomor whatsapp tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->M_Base->data_update('users', $data_post, $this->users['id']);

                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }

            $data = array_merge($this->base_data, [
                'title' => 'Pengaturan Akun',
                'menu_users' => 'Pengaturan Akun',
            ]);

            return view('User/settings', $data);
        }
    }
    
    public function my_order() {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {

            $data = array_merge($this->base_data, [
                'title' => 'Pesanan Saya',
                'menu_users' => 'Pesanan',
                'orders' => $this->M_Base->data_where_custom('orders', 'username', $this->users['username'],'id','DESC'),
            ]);

            return view('User/riwayat', $data);
        }
    }

    public function order_history() {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {

            $data = array_merge($this->base_data, [
                'title' => 'Riwayat Pesanan',
                'menu_users' => 'Riwayat',
                'orders' => $this->M_Base->data_where_custom('orders_history', 'username', $this->users['username'],'id','DESC'),
            ]);

            return view('User/riwayat', $data);
        }
    }
    
    public function export_order_history() {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            if ($this->request->getPost('tombol')) {
                $month = $this->request->getPost('status');
                if(empty($month)){ $month = date('m'); }
                $year = $this->request->getPost('year');
                if(empty($year)){ $year = date('Y'); }

                $start_date = $year.'-'.$month.'-01';
                $end_date = $year.'-'.$month.'-31';

                //echo "<pre>"; print_r($month); die;
                //echo "<pre>"; print_r($year); die;

                $query = $this->M_Base->data_where_array('orders_history', 
                    ['username' => $this->users['username'], 'MONTH(date_create)' => $month, 'YEAR(date_create)' => $year]
                );
                //echo "<pre>"; print_r($query); die;

                if (count($query) !== 0) {
                    $file_name = 'export-pesanan-'.date('YmdHis').'.xlsx';

                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();

                    $sheet->setCellValue('A1', 'Invoice Id');
                    $sheet->setCellValue('B1', 'Tanggal');
                    $sheet->setCellValue('C1', 'Nama Games');
                    $sheet->setCellValue('D1', 'Nama Produk');
                    $sheet->setCellValue('E1', 'Harga Produk');
                    $sheet->setCellValue('F1', 'User Id');
                    $sheet->setCellValue('G1', 'Zone Id');
                    $sheet->setCellValue('H1', 'Nickname');
                    $sheet->setCellValue('I1', 'Status');
                    
                    $line = 2;
                    foreach ($query as $loop) {
                        $sheet->setCellValue('A' . $line, $loop['order_id']);
                        $sheet->setCellValue('B' . $line, $loop['date_create']);
                        $sheet->setCellValue('C' . $line, $loop['games']);
                        $sheet->setCellValue('D' . $line, $loop['product']);
                        $sheet->setCellValue('E' . $line, $loop['price']);
                        $sheet->setCellValue('F' . $line, $loop['user_id']);
                        $sheet->setCellValue('G' . $line, $loop['zone_id']);
                        $sheet->setCellValue('H' . $line, $loop['nickname']);
                        $sheet->setCellValue('I' . $line, $loop['status']);
                        
                        $line++;
                    }
                    
                    $writer = new Xlsx($spreadsheet);
                    $writer->save('assets/excel/' . $file_name);
                    
                    return redirect()->to(base_url() . '/assets/excel/' . $file_name);
                }else{
                    $this->session->setFlashdata('error', 'Tidak ada data pesanan untuk di export');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }else{

                $month = date("m");
                $year = date("Y");

                if ($this->request->getPost('month')) {
                    $month = $this->request->getPost('month');
                }

                if ($this->request->getPost('year')) {
                    $year = $this->request->getPost('year');
                } 
 
                $opt_status = array(
                    'Success' => 'Success',
                    'Pending' => 'Pending',
                    'Processing' => 'Processing',
                    'Canceled' => 'Canceled'
                );

                $data = array_merge($this->base_data, [
                    'title' => 'Export Riwayat Pesanan',
                    'menu_users' => 'Download',
                    'opt_status' => $opt_status,
                    'month' => $month,
                    'year' => $year,
                    'now_year' => $year,
                ]);

                return view('User/export_pesanan', $data);

            }
        }
    }

    public function topup($topup_id = null) {

        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            if ($topup_id === null) {
                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'nominal' => addslashes(trim(htmlspecialchars($this->request->getPost('nominal')))),
                        'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                    ];

                    if (empty($data_post['nominal'])) {
                        $this->session->setFlashdata('error', 'Nominal tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['method'])) {
                        $this->session->setFlashdata('error', 'Metode tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if ($data_post['nominal'] < 10000) {
                        $this->session->setFlashdata('error', 'Topup minimal Rp 10.000');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if ($data_post['nominal'] > 5000000) {
                        $this->session->setFlashdata('error', 'Topup maksimal Rp 5.000.000');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);

                        if (count($method) === 1) {
                            if ($method[0]['status'] == 'On') {

                                $topup_id = date('Ymd') . rand(0000,9999);

                                $uniq = $method[0]['uniq'] == 'Y' ? rand(000,999) : 0;
                                
                                $fee = $method[0]['fee'];
                                if (is_numeric($method[0]['percent'])) {
                                    $fee += round(($data_post['nominal'] / 100) * $method[0]['percent']);
                                }

                                $amount = $data_post['nominal'] + $uniq + $fee;

                                if ($method[0]['provider'] == 'Tripay') {

                                    $data = [
                                        'method'         => $method[0]['code'],
                                        'merchant_ref'   => $topup_id,
                                        'amount'         => $amount,
                                        'customer_name'  => $this->users['username'],
                                        'customer_email' => 'email@domain.com',
                                        'customer_phone' => $this->users['wa'],
                                        'order_items'    => [
                                            [
                                                'sku'         => 'DS',
                                                'name'        => 'Topup Saldo',
                                                'price'       => $amount,
                                                'quantity'    => 1,
                                            ]
                                        ],
                                        'return_url'   => base_url(),
                                        'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                                        'signature'    => hash_hmac('sha256', $this->M_Base->u_get('tripay-merchant').$topup_id.$amount, $this->M_Base->u_get('tripay-private'))
                                    ];

                                    $curl = curl_init();

                                    curl_setopt_array($curl, [
                                        CURLOPT_FRESH_CONNECT  => true,
                                        CURLOPT_URL            => 'https://tripay.co.id/api/transaction/create',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_HEADER         => false,
                                        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->M_Base->u_get('tripay-key')],
                                        CURLOPT_FAILONERROR    => false,
                                        CURLOPT_POST           => true,
                                        CURLOPT_POSTFIELDS     => http_build_query($data),
                                        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
                                    ]);

                                    $result = curl_exec($curl);
                                    $result = json_decode($result, true);

                                    if ($result) {
                                        if ($result['success'] == true) {
                                            if (array_key_exists('qr_url', $result['data'])) {
                                                $payment_code = $result['data']['qr_url'];
                                            } else {
                                                $payment_code = $result['data']['pay_code'];
                                            }
                                        } else {
                                            $this->session->setFlashdata('error', 'Result : ' . $result['message']);
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Gagal terkoneksi ke Tripay');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                } else if ($method[0]['provider'] == 'DuitKu') {
                                    
                                    $apiKey = $this->M_Base->u_get('dk_key');
                                    $merchantCode = $this->M_Base->u_get('dk_merchant');
                                    
                                    $params = [
                                        'merchantCode' => $merchantCode,
                                        'paymentAmount' => $amount,
                                        'paymentMethod' => $method[0]['code'],
                                        'merchantOrderId' => $topup_id,
                                        'productDetails' => 'Topup Saldo',
                                        'customerVaName' => $this->users['username'],
                                        'email' => 'email@domain.com',
                                        'itemDetails' => [
                                            [
                                                'name' => 'Topup Saldo',
                                                'price' => $amount,
                                                'quantity' => 1
                                            ]
                                        ],
                                        'callbackUrl' => base_url() . '/sistem/callback/duitku',
                                        'returnUrl' => base_url(),
                                        'signature' => md5($merchantCode . $topup_id . $amount . $apiKey),
                                        'expiryPeriod' => 1440
                                    ];
                                    
                                    $result = $this->M_Duitku->maker($params);
                                    
                                    if ($result['ok'] == true) {
                                        $payment_code = $result['data'];
                                    } else {
                                        $this->session->setFlashdata('error', $result['msg']);
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }
                                    
                                } else if ($method[0]['provider'] == 'Tokopay') {
                                    
                                    $tokopay = [
                                        'merchant' => $this->M_Base->u_get('tokopay_merchant'),
                                        'secret' => $this->M_Base->u_get('tokopay_secret'),
                                    ];
                                    
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'https://api.tokopay.id/v1/order?' . http_build_query([
                                            'merchant' => $tokopay['merchant'],
                                            'secret' => $tokopay['secret'],
                                            'ref_id' => $topup_id,
                                            'nominal' => $amount,
                                            'metode' => $method[0]['code'],
                                        ]),
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 60,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                    ));
                                    
                                    $response = curl_exec($curl);
                                    $response = json_decode($response, true);
                                    
                                    if ($response) {
                                        
                                        if ($response['status'] == 'Success' AND array_key_exists('data', $response)) {
    
                                            $payment_code = $response['data']['pay_url'];
    
                                        } else {
                                            $this->session->setFlashdata('error', 'Tokopay : ' . $response['error_msg']);
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Gagal terkoneksi ke Tokopay');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }
                                    
                                } else if ($method[0]['provider'] == 'Xendit') {
                                    
                                    Xendit::setApiKey($this->M_Base->u_get('xendit-secret-key'));
                                                
                                    if ($method[0]['code'] == 'QR') {
                                        
                                        $params = [
                                            'api_version' => '2022-07-31',
                                            'reference_id' => $topup_id,
                                            'type' => 'DYNAMIC',
                                            'currency' => 'IDR',
                                            'amount' => $amount,
                                        ];
                                        
                                        $qr_code = \Xendit\QRCode::create($params);
                                        if (array_key_exists('qr_string', $qr_code)) {
                                            $payment_code = $qr_code['qr_string'];
                                        }
                                        
                                    } else if (in_array($method[0]['code'], ['OVO', 'DANA', 'LINKAJA', 'SHOPEEPAY'])) {
                                        
                                        $ewalletChargeParams = [
                                            'reference_id' => $topup_id,
                                            'currency' => 'IDR',
                                            'customer_id' => 'c832697e-a62d-46fa-a383-24930b155e' . rand(0000,9999),
                                            'amount' => $amount,
                                            'checkout_method' => 'ONE_TIME_PAYMENT',
                                            'channel_code' => 'ID_' . $method[0]['code'],
                                            'channel_properties' => [
                                                'mobile_number' => '+628' . substr($this->users['wa'], 2),
                                                'success_redirect_url' => base_url(),
                                            ],
                                            'metadata' => [
                                                'meta' => 'data'
                                            ]
                                        ];
                                        
                                        $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
                                        if (array_key_exists('actions', $createEWalletCharge)) {
                                            
                                            if (is_array($createEWalletCharge['actions'])) {
                                                
                                                $payment_code = $createEWalletCharge['actions']['desktop_web_checkout_url'];
                                                
                                                if (!$payment_code) {
                                                    $payment_code = $createEWalletCharge['actions']['mobile_web_checkout_url'];
                                                    
                                                    if (!$payment_code) {
                                                        $payment_code = $createEWalletCharge['actions']['mobile_deeplink_checkout_url'];
                                                    }
                                                }
                                            } else {
                                                $payment_code = 'OVONOTIF';
                                            }
                                        }
                                    } else if (in_array($method[0]['code'], ['BCA', 'BNI', 'BRI', 'BJB', 'BSI', 'CIMB', 'DBS', 'MANDIRI', 'PERMATA', 'SAHABAT_SAMPOERNA'])) {
                                        
                                        $params = [
                                            "external_id" => $topup_id,
                                            "bank_code" => $method[0]['code'],
                                            "name" => $this->users['username'],
                                            "is_closed" => true,
                                            "expected_amount" => $amount,
                                        ];
                                        
                                        $createVA = \Xendit\VirtualAccounts::create($params);
                                        
                                        if (array_key_exists('account_number', $createVA)) {
                                            $payment_code = $createVA['account_number'];
                                        }
                                        
                                    } else if (in_array($method[0]['code'], ['INVOICE'])) {
                                        
                                        $params = [ 
                                            'external_id' => $topup_id,
                                            'amount' => $amount,
                                            'description' => 'Isi ulang saldo akun ' . $this->users['username'],
                                            'invoice_duration' => 86400,
                                            'should_send_email' => true,
                                            'success_redirect_url' => base_url(),
                                            'failure_redirect_url' => base_url(),
                                            'currency' => 'IDR',
                                            'items' => [
                                                [
                                                    'name' => 'Isi ulang saldo akun ' . $this->users['username'],
                                                    'quantity' => 1,
                                                    'price' => $amount,
                                                ]
                                            ],
                                        ];

                                        $createInvoice = \Xendit\Invoice::create($params);
                                        if (array_key_exists('invoice_url', $createInvoice)) {
                                            $payment_code = $createInvoice['invoice_url'];
                                        }
                                        
                                    } else if (in_array($method[0]['code'], ['ALFAMART', 'INDOMARET'])) {
                                        
                                        $params = [
                                            'external_id' => $topup_id,
                                            'retail_outlet_name' => $method[0]['code'],
                                            'name' => $this->users['username'],
                                            'expected_amount' => $amount
                                        ];
                                        
                                        $createFPC = \Xendit\Retail::create($params);
                                        if (array_key_exists('payment_code', $createFPC)) {
                                            $payment_code = $createVA['payment_code'];
                                        }
                                        
                                    } else {
                                        $this->session->setFlashdata('error', 'Kode metode tidak dikenali');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }
                                    
                                } else if ($method[0]['provider'] == 'Manual') {
                                    $payment_code = $method[0]['rek'];
                                } else {
                                    $this->session->setFlashdata('error', 'Metode tidak terdaftar');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }

                                $this->M_Base->data_insert('topup', [
                                    'username' => $this->users['username'],
                                    'topup_id' => $topup_id,
                                    'method_id' => $method[0]['id'],
                                    'method' => $method[0]['method'],
                                    'amount' => $amount,
                                    'fee' => $fee,
                                    'status' => 'Pending',
                                    'payment_code' => $payment_code,
                                    'date_create' => date('Y-m-d G:i:s'),
                                ]);

                                 

                                $this->session->setFlashdata('success', 'Request Deposit');
                                return redirect()->to(base_url() . '/user/topup/' . $topup_id);

                            } else {
                                $this->session->setFlashdata('error', 'Metode tidak tersedia');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Metode tidak ditemukan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }
                
                $method = [];
                foreach (array_reverse($this->M_Base->all_data_order('method_category', 'sort')) as $category) {

                	$data_method = $this->M_Base->data_where_array('method', [
                		'category_id' => $category['id'],
                		'status' => 'On',
                	]);

                	if (count($data_method) !== 0) {
                		$method[] = [
                			'id' => $category['id'],
                			'category' => $category['category'],
                			'method' => $data_method,
                		];
                	}
                }

                $data = array_merge($this->base_data, [
                    'title' => 'TopUp Saldo',
                    'menu_users' => 'TopUp Saldo',
                    'method' => $method,
                ]);

                return view('User/Topup/index', $data);
                
            } else {
                $topup = $this->M_Base->data_where_array('topup', [
                    'topup_id' => $topup_id,
                    'username' => $this->users['username'],
                ]);

                if (count($topup) === 1) {

                    $find_method = $this->M_Base->data_where('method', 'id', $topup[0]['method_id']);

                    $instruksi = count($find_method) == 1 ? $find_method[0]['instruksi'] : '-';

                    $data = array_merge($this->base_data, [
                        'title' => 'Riwayat TopUp',
                        'menu_users' => 'TopUp Saldo',
                        'topup' => array_merge($topup[0], [
                            'instruksi' => $instruksi,
                        ]),
                    ]);

                    return view('User/Topup/detail', $data);
                } else {
                    
                    if ($topup_id === 'riwayat') {
                        
                        $data = array_merge($this->base_data, [
                            'title' => 'Riwayat TopUp',
                            'menu_users' => 'TopUp Saldo',
                            'topup' => $this->M_Base->data_where_custom('topup', 'username', $this->users['username'],'id','DESC'),
                        ]);

                        return view('User/Topup/riwayat', $data);
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                }
            }
        }
    }
    
     public function upgrade($upgrade_id = null) {
        
        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if ($upgrade_id === null) {
            
                $level_id_now = $this->M_Base->data_where('level', 'level', $this->users['level']);
                
                if (count($level_id_now) == 1) {
                    
                    $level_av = $this->M_Base->data_where_array('level', [
                        'id >' => $level_id_now[0]['id'],
                    ]);
                    
                    if (count($level_av) == 0) {
                        $this->session->setFlashdata('error', 'Tidak ada level yang tersedia untuk di upgrade');
                        return redirect()->to(base_url() . '/user');
                    } else {
                        
                        $upgrade = $this->M_Base->data_where('upgrade', 'username', $this->users['username']);
                        
                        if (count($upgrade) == 0) {
                            
                            $level_ready = [];
                            
                            foreach ($level_av as $loop) {
                                
                                $level_ready[] = array_merge($loop, [
                                    'price' => $this->M_Base->u_get('harga_' . strtolower($loop['level'])),
                                ]);
                            }
                            
                            if ($this->request->getPost('tombol')) {
                                
                                $data_post = [
                                    'level' => addslashes(trim(htmlspecialchars($this->request->getPost('level')))),
                                    'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                                ];
                                
                                if (empty($data_post['level'])) {
                                    $this->session->setFlashdata('error', 'Level tidak ditemukan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                } else if (empty($data_post['method'])) {
                                    $this->session->setFlashdata('error', 'Metode tidak boleh kosong');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                } else {
                                    
                                    $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
            
                                    if (count($method) === 1) {
                                        
                                        if ($method[0]['status'] == 'On') {
                                            
                                            $level = $this->M_Base->data_where('level', 'id', $data_post['level']);
                                            
                                            if (count($level) == 1) {
                                                
                                                if ($level[0]['id'] > $level_id_now[0]['id']) {
                                                    
                                                    $upgrade_id = date('Ymd') . rand(0000,9999);
                
                                                    $uniq = $method[0]['uniq'] == 'Y' ? rand(000,999) : 0;
                    
                                                    $amount = $this->M_Base->u_get('harga_' . strtolower($level[0]['level'])) + $uniq;
                                                    
                                                    if ($method[0]['provider'] == 'Tripay') {
                    
                                                        $data = [
                                                            'method'         => $method[0]['code'],
                                                            'merchant_ref'   => $upgrade_id,
                                                            'amount'         => $amount,
                                                            'customer_name'  => $this->users['username'],
                                                            'customer_email' => 'email@domain.com',
                                                            'customer_phone' => $this->users['wa'],
                                                            'order_items'    => [
                                                                [
                                                                    'sku'         => 'DS',
                                                                    'name'        => 'Upgrade Akun ke ' . $level[0]['level'],
                                                                    'price'       => $amount,
                                                                    'quantity'    => 1,
                                                                ]
                                                            ],
                                                            'return_url'   => base_url(),
                                                            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                                                            'signature'    => hash_hmac('sha256', $this->M_Base->u_get('tripay-merchant').$upgrade_id.$amount, $this->M_Base->u_get('tripay-private'))
                                                        ];
                    
                                                        $curl = curl_init();
                    
                                                        curl_setopt_array($curl, [
                                                            CURLOPT_FRESH_CONNECT  => true,
                                                            CURLOPT_URL            => 'https://tripay.co.id/api/transaction/create',
                                                            CURLOPT_RETURNTRANSFER => true,
                                                            CURLOPT_HEADER         => false,
                                                            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->M_Base->u_get('tripay-key')],
                                                            CURLOPT_FAILONERROR    => false,
                                                            CURLOPT_POST           => true,
                                                            CURLOPT_POSTFIELDS     => http_build_query($data),
                                                            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
                                                        ]);
                    
                                                        $result = curl_exec($curl);
                                                        $result = json_decode($result, true);
                    
                                                        if ($result) {
                                                            if ($result['success'] == true) {
                                                                if (array_key_exists('qr_url', $result['data'])) {
                                                                    $payment_code = $result['data']['qr_url'];
                                                                } else {
                                                                    $payment_code = $result['data']['pay_code'];
                                                                }
                                                            } else {
                                                                $this->session->setFlashdata('error', 'Result : ' . $result['message']);
                                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                            }
                                                        } else {
                                                            $this->session->setFlashdata('error', 'Gagal terkoneksi ke Tripay');
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                    
                                                    } else if ($method[0]['provider'] == 'DuitKu') {
                                                        
                                                        $apiKey = $this->M_Base->u_get('dk_key');
                                                        $merchantCode = $this->M_Base->u_get('dk_merchant');
                                                        
                                                        $params = [
                                                            'merchantCode' => $merchantCode,
                                                            'paymentAmount' => $amount,
                                                            'paymentMethod' => $method[0]['code'],
                                                            'merchantOrderId' => $upgrade_id,
                                                            'productDetails' => 'Upgrade Akun',
                                                            'customerVaName' => $this->users['username'],
                                                            'email' => 'email@domain.com',
                                                            'itemDetails' => [
                                                                [
                                                                    'name' => 'Upgrade Akun',
                                                                    'price' => $amount,
                                                                    'quantity' => 1
                                                                ]
                                                            ],
                                                            'callbackUrl' => base_url() . '/sistem/callback/duitku',
                                                            'returnUrl' => base_url() . '/user',
                                                            'signature' => md5($merchantCode . $upgrade_id . $amount . $apiKey),
                                                            'expiryPeriod' => 1440
                                                        ];
                                                        
                                                        $result = $this->M_Duitku->maker($params);
                                                        
                                                        if ($result['ok'] == true) {
                                                            $payment_code = $result['data'];
                                                        } else {
                                                            $this->session->setFlashdata('error', $result['msg']);
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                        
                                                    } else if ($method[0]['provider'] == 'Tokopay') {
                                                        
                                                        $tokopay = [
                                                            'merchant' => $this->M_Base->u_get('tokopay_merchant'),
                                                            'secret' => $this->M_Base->u_get('tokopay_secret'),
                                                        ];
                                                        
                                                        $curl = curl_init();
                                                        curl_setopt_array($curl, array(
                                                            CURLOPT_URL => 'https://api.tokopay.id/v1/order?' . http_build_query([
                                                                'merchant' => $tokopay['merchant'],
                                                                'secret' => $tokopay['secret'],
                                                                'ref_id' => $upgrade_id,
                                                                'nominal' => $amount,
                                                                'metode' => $method[0]['code'],
                                                            ]),
                                                            CURLOPT_RETURNTRANSFER => true,
                                                            CURLOPT_ENCODING => '',
                                                            CURLOPT_MAXREDIRS => 10,
                                                            CURLOPT_TIMEOUT => 60,
                                                            CURLOPT_FOLLOWLOCATION => true,
                                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                            CURLOPT_CUSTOMREQUEST => 'GET',
                                                        ));
                                                        
                                                        $response = curl_exec($curl);
                                                        $response = json_decode($response, true);
                                                        
                                                        if ($response) {
                                                            
                                                            if ($response['status'] == 'Success' AND array_key_exists('data', $response)) {
                        
                                                                $payment_code = $response['data']['pay_url'];
                        
                                                            } else {
                                                                $this->session->setFlashdata('error', 'Tokopay : ' . $response['error_msg']);
                                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                            }
                                                        } else {
                                                            $this->session->setFlashdata('error', 'Gagal terkoneksi ke Tokopay');
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                        
                                                    } else if ($method[0]['provider'] == 'Xendit') {
                                                        
                                                        Xendit::setApiKey($this->M_Base->u_get('xendit-secret-key'));
                                                
                                                        if ($method[0]['code'] == 'QR') {
                                                            
                                                            $params = [
                                                                'api_version' => '2022-07-31',
                                                                'reference_id' => $upgrade_id,
                                                                'type' => 'DYNAMIC',
                                                                'currency' => 'IDR',
                                                                'amount' => $amount,
                                                            ];
                                                            
                                                            $qr_code = \Xendit\QRCode::create($params);
                                                            if (array_key_exists('qr_string', $qr_code)) {
                                                                $payment_code = $qr_code['qr_string'];
                                                            }
                                                            
                                                        } else if (in_array($method[0]['code'], ['OVO', 'DANA', 'LINKAJA', 'SHOPEEPAY'])) {
                                                            
                                                            $ewalletChargeParams = [
                                                                'reference_id' => $upgrade_id,
                                                                'currency' => 'IDR',
                                                                'customer_id' => 'c832697e-a62d-46fa-a383-24930b155e' . rand(0000,9999),
                                                                'amount' => $amount,
                                                                'checkout_method' => 'ONE_TIME_PAYMENT',
                                                                'channel_code' => 'ID_' . $method[0]['code'],
                                                                'channel_properties' => [
                                                                    'mobile_number' => '+628' . substr($this->users['wa'], 2),
                                                                    'success_redirect_url' => base_url(),
                                                                ],
                                                                'metadata' => [
                                                                    'meta' => 'data'
                                                                ]
                                                            ];
                                                            
                                                            $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
                                                            if (array_key_exists('actions', $createEWalletCharge)) {
                                                                
                                                                if (is_array($createEWalletCharge['actions'])) {
                                                                    
                                                                    $payment_code = $createEWalletCharge['actions']['desktop_web_checkout_url'];
                                                                    
                                                                    if (!$payment_code) {
                                                                        $payment_code = $createEWalletCharge['actions']['mobile_web_checkout_url'];
                                                                        
                                                                        if (!$payment_code) {
                                                                            $payment_code = $createEWalletCharge['actions']['mobile_deeplink_checkout_url'];
                                                                        }
                                                                    }
                                                                } else {
                                                                    $payment_code = 'OVONOTIF';
                                                                }
                                                            }
                                                        } else if (in_array($method[0]['code'], ['BCA', 'BNI', 'BRI', 'BJB', 'BSI', 'CIMB', 'DBS', 'MANDIRI', 'PERMATA', 'SAHABAT_SAMPOERNA'])) {
                                                            
                                                            $params = [
                                                                "external_id" => $upgrade_id,
                                                                "bank_code" => $method[0]['code'],
                                                                "name" => $this->users['username'],
                                                                "is_closed" => true,
                                                                "expected_amount" => $amount,
                                                            ];
                                                            
                                                            $createVA = \Xendit\VirtualAccounts::create($params);
                                                            
                                                            if (array_key_exists('account_number', $createVA)) {
                                                                $payment_code = $createVA['account_number'];
                                                            }
                                                            
                                                        } else if (in_array($method[0]['code'], ['INVOICE'])) {
                                                            
                                                            $params = [ 
                                                                'external_id' => $upgrade_id,
                                                                'amount' => $amount,
                                                                'description' => 'Upgrade Akun ke ' . $level[0]['level'],
                                                                'invoice_duration' => 86400,
                                                                'should_send_email' => true,
                                                                'success_redirect_url' => base_url(),
                                                                'failure_redirect_url' => base_url(),
                                                                'currency' => 'IDR',
                                                                'items' => [
                                                                    [
                                                                        'name' => 'Upgrade Akun ke ' . $level[0]['level'],
                                                                        'quantity' => 1,
                                                                        'price' => $amount,
                                                                    ]
                                                                ],
                                                            ];
                    
                                                            $createInvoice = \Xendit\Invoice::create($params);
                                                            if (array_key_exists('invoice_url', $createInvoice)) {
                                                                $payment_code = $createInvoice['invoice_url'];
                                                            }
                                                            
                                                        } else if (in_array($method[0]['code'], ['ALFAMART', 'INDOMARET'])) {
                                                            
                                                            $params = [
                                                                'external_id' => $upgrade_id,
                                                                'retail_outlet_name' => $method[0]['code'],
                                                                'name' => $this->users['username'],
                                                                'expected_amount' => $amount
                                                            ];
                                                            
                                                            $createFPC = \Xendit\Retail::create($params);
                                                            if (array_key_exists('payment_code', $createFPC)) {
                                                                $payment_code = $createVA['payment_code'];
                                                            }
                                                            
                                                        } else {
                                                            $this->session->setFlashdata('error', 'Kode metode tidak dikenali');
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                        
                                                    } else if ($method[0]['provider'] == 'Manual') {
                                                        $payment_code = $method[0]['rek'];
                                                    } else {
                                                        $this->session->setFlashdata('error', 'Metode tidak terdaftar');
                                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                    }
                    
                                                    $this->M_Base->data_insert('upgrade', [
                                                        'username' => $this->users['username'],
                                                        'upgrade_id' => $upgrade_id,
                                                        'method_id' => $method[0]['id'],
                                                        'amount' => $amount,
                                                        'to_level' => $level[0]['id'],
                                                        'level' => $level[0]['level'],
                                                        'payment_code' => $payment_code,
                                                        'date_create' => date('Y-m-d G:i:s'),
                                                    ]);
                                                    
                                                    $this->M_Base->data_update('users', [
                                                        'upgrade_membership' => 'Pending',
                                                    ], $this->users['id']);
                    
                                                    $this->session->setFlashdata('success', 'Request upgrade akun telah berhasil');
                                                    return redirect()->to(base_url() . '/user/upgrade/' . $upgrade_id);
                                                    
                                                } else {
                                                    $this->session->setFlashdata('error', 'Upgrade level gagal');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                }
                                            } else {
                                                $this->session->setFlashdata('error', 'Level tidak terdaftar');
                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                            }
                                        } else {
                                            $this->session->setFlashdata('error', 'Metode tidak tersedia');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Metode tidak ditemukan');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }
                                }
                            }
            
                            $method = [];
                            foreach (array_reverse($this->M_Base->all_data_order('method_category', 'sort')) as $category) {
            
                            	$data_method = $this->M_Base->data_where_array('method', [
                            		'category_id' => $category['id'],
                            		'status' => 'On',
                            	]);
            
                            	if (count($data_method) !== 0) {
                            		$method[] = [
                            			'id' => $category['id'],
                            			'category' => $category['category'],
                            			'method' => $data_method,
                            		];
                            	}
                            }
                            
                            $data = array_merge($this->base_data, [
                                'title' => 'Upgrade Akun',
                                'method' => $method,
                                'level_ready' => $level_ready,
                                'menu_users' => 'Upgrade Akun',
                            ]);
            
                            return view('User/Upgrade/index', $data);
                            
                        } else {
                            return redirect()->to(base_url() . '/user/upgrade/' . $upgrade[0]['upgrade_id']);
                        }
                    }
                    
                } else {
                    $this->session->setFlashdata('error', 'Level kamu tidak terdaftar dalam sistem');
                    return redirect()->to(base_url() . '/user');
                }
                
            } else {
                
                if ($upgrade_id === 'cancel') {
                    
                    foreach ($this->M_Base->data_where('upgrade', 'username', $this->users['username']) as $loop) {
                        
                        $this->M_Base->data_delete('upgrade', $loop['id']);
                    }
                    
                    $this->session->setFlashdata('success', 'Permintaan upgrade akun telah dibatalkan');
                    return redirect()->to(base_url() . '/user');
                    
                } else {
                    
                    $upgrade = $this->M_Base->data_where_array('upgrade', [
                        'upgrade_id' => $upgrade_id,
                        'username' => $this->users['username'],
                    ]);
    
                    if (count($upgrade) === 1) {
    
                        $method = $this->M_Base->data_where('method', 'id', $upgrade[0]['method_id']);
    
                        $data = array_merge($this->base_data, [
                            'title' => 'Upgrade Akun',
                            'upgrade' => array_merge($upgrade[0], $method[0]),
                            'menu_users' => 'Upgrade Akun',
                        ]);
    
                        return view('User/Upgrade/detail', $data);
                        
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                }
            }
        }
    }
    
    public function send_balance() {
        if ($this->users === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            $user_recipient = $users = array();
            if ($this->session->get('username')) {
                $users = $this->M_Base->data_where('users', 'username', $this->session->get('username'));
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            if ($this->request->getPost()) {

                if($this->request->getPost('trx_id')){
                    $data_post = [
                        'trx_id' => addslashes(trim(htmlspecialchars($this->request->getPost('trx_id')))),
                        'id_sender' => addslashes(trim(htmlspecialchars($this->request->getPost('id_sender')))),
                        'username_sender' => addslashes(trim(htmlspecialchars($this->request->getPost('username_sender')))),
                        'wa_sender' => addslashes(trim(htmlspecialchars($this->request->getPost('wa_sender')))),
                        'id_recipient' => addslashes(trim(htmlspecialchars($this->request->getPost('id_recipient')))),
                        'username_recipient' => addslashes(trim(htmlspecialchars($this->request->getPost('username_recipient')))),
                        'wa_recipient' => addslashes(trim(htmlspecialchars($this->request->getPost('wa_recipient')))),
                        'amount' => addslashes(trim(htmlspecialchars($this->request->getPost('nominal')))),
                        'status' => 'pending'
                    ];
                    // Save Data Transaksi
                    $amount = (int) $data_post['amount'];
                    $save_data_transaction = $this->M_Base->data_insert('transfer_balance', $data_post);
                    if($save_data_transaction){
                        // Update Data Saldo Sender
                        $user_sender = $this->M_Base->data_where('users', 'id', $data_post['id_sender']);
                        $update_data_sender = $this->M_Base->data_update('users', [
                                'balance' => $user_sender[0]['balance'] - $amount,
                        ], $user_sender[0]['id']);

                        // Update Data Saldo Recipient
                        if($update_data_sender){
                            $user_recipient = $this->M_Base->data_where('users', 'id', $data_post['id_recipient']);
                            $update_data_recipient = $this->M_Base->data_update('users', [
                                    'balance' => $user_recipient[0]['balance'] + $amount,
                            ], $user_recipient[0]['id']);

                            // Update Data Status Transaksi
                            if($update_data_recipient){
                                $status = "success";
                            }else{
                                $status = "failed";
                            }

                            $data_transaction = $this->M_Base->data_where('transfer_balance', 'trx_id', $data_post['trx_id']);
                            $update_data_transaction = $this->M_Base->data_update('transfer_balance', [
                                    'status' => $status,
                            ], $data_transaction[0]['id']);

                            if($update_data_transaction){
                                // Send WA Notif Recipient
                                $wa_transfer = $this->M_Base->u_get('wa_notif_transfer_balance');
                                if (!empty($wa_transfer)) {
                                    $this->M_Wa->send([
                                        'token' => $this->M_Base->u_get('wa_fonnte'),
                                        'target' => $data_post['wa_recipient'],
                                        'message' => str_replace([
                                            '#sender#',
                                            '#recipient#',
                                            '#amount#',
                                            '#status#',
                                            '#order_id#',
                                        ], [
                                            $data_post['username_sender'],
                                            $data_post['username_recipient'],
                                            $amount,
                                            $status,
                                            $data_post['trx_id'],
                                        ], $wa_transfer),
                                    ]);
                                }

                            }

                            $this->session->setFlashdata('success', 'Pesanan berhasil dibuat');
                            return redirect()->to(base_url() . '/user/transfer_history/' . $data_post['trx_id']);

                        }
                    }

                    $this->session->setFlashdata('error', 'Pengiriman data saldo akun gagal!');
                    return redirect()->to(base_url() . '/user/send-balance');
                    
                                                            
                }else{
                    $data_post = [
                        'trx_id' => 'trx_'.date('YmdHis'),
                        'username_recipient' => addslashes(trim(htmlspecialchars($this->request->getPost('recipient')))),
                        'nominal' => addslashes(trim(htmlspecialchars($this->request->getPost('nominal')))),
                    ];

                    if(!empty($data_post['username_recipient'])){
                        $user_recipient = $this->M_Base->data_where('users', 'username', $data_post['username_recipient']);
                    }

                    if(!empty($user_recipient)){
                        $csrf_token = csrf_hash();
                        echo json_encode([
                            'status' => true,
                            'msg' => '
                            <p class="text-muted">Silahkan cek kembali informasi transaksi pengiriman saldo akun Anda berikut ini:</p>
                            <hr class="my-3">
                            <form action="" method="POST" id="form-send">
                                <input type="hidden" name="csrf_test_name" value="' . $csrf_token . '">
                                <input type="hidden" name="trx_id" value="'.$data_post['trx_id'].'">
                                <input type="hidden" name="id_sender" value="'.$users[0]['id'].'">
                                <input type="hidden" name="username_sender" value="'.$users[0]['username'].'">
                                <input type="hidden" name="wa_sender" value="'.$users[0]['wa'].'">
                                <input type="hidden" name="id_recipient" value="'.$user_recipient[0]['id'].'">
                                <input type="hidden" name="username_recipient" value="'.$user_recipient[0]['username'].'">
                                <input type="hidden" name="wa_recipient" value="'.$user_recipient[0]['wa'].'">
                                <input type="hidden" name="nominal" value="'.$data_post['nominal'].'">
                            </form>
                            </table>
                            <h2 class="fs-16">Detail Pengiriman</h2>
                            <hr class="my-3">
                            <table class="w-100 mb-2">
                                <tr>
                                    <td class="pb-2">Pengirim:</td>
                                    <th class="text-end">'.$users[0]['username'].'</td>
                                </tr>
                                <tr>
                                    <td class="pb-2">Penerima:</td>
                                    <th class="text-end">'.$user_recipient[0]['username'].'</td>
                                </tr>
                                <tr>
                                    <td class="pb-2">WhatsApp Penerima:</td>
                                    <th class="text-end">'.$user_recipient[0]['wa'].'</td>
                                </tr>
                                <tr>
                                    <td class="pb-2">Nominal yang dikirim:</td>
                                    <th class="text-end">Rp '.number_format($data_post['nominal'],0,',','.').'</td>
                                </tr>
                            </table>
                            <hr class="my-3">
                            <p class="text-muted mb-3">Pastikan informasi pengiriman saldo akun Anda sudah benar. Dengan melakukan transaksi ini, Anda telah menyetujui Syarat & Ketentuan dan Kebijakan Privasi yang berlaku.</p>
                            ',
                        ]);
                    }else{
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Username penerima tidak ditemukan. Silahkan cek dan masukan data username penerima dengan benar!',
                        ]);
                    }
                }
            }else{

                $data = array_merge($this->base_data, [
                    'title' => 'Kirim Saldo',
                    'menu_users' => 'Send Saldo',
                    'username' => $this->users['username'],
                    'wa' => $this->users['wa'],
                    'level' => $this->users['level'],
                    'balance' => $this->users['balance'],
                ]);

                return view('User/Sending/index', $data);
            }
                
        }
    }

    public function transfer_history($trx_id=NULL) {
        if ($this->users === false) {
            $this->session->setFlashdata('error', 'Silahkan login terlebih dahulu');
            return redirect()->to(base_url() . '/login');
        }else{
            if($trx_id){

                $receipt = $this->M_Base->data_where('transfer_balance', 'trx_id', $trx_id);

                if(empty($receipt)){
                    return redirect()->to(base_url() . '/user/riwayat-transfer');
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Receipt Transfer Saldo Akun',
                    'menu_users' => 'Send Saldo',
                    'receipt' => $receipt[0],
                ]);

                return view('User/Sending/detail', $data);

            }else{

                $transaction = $this->M_Base->all_data('transfer_balance');
                $data = array_merge($this->base_data, [
                    'title' => 'Riwayat Transfer Saldo Akun',
                    'menu_users' => 'Send Saldo',
                    'transaction' => $transaction
                ]);

                return view('User/Sending/riwayat', $data);
            }
        }
    }

    public function scan_google_auth() {
        $ga = new GoogleAuthenticator;

        $name = $this->users['username'];
        $secret = $ga->createSecret();
        $title = $this->base_data['web']['name'];

        $qrCodeUrl = $ga->getQRCodeGoogleUrl($name, $secret, $title);

        $data = array_merge($this->base_data, [
            'title' => 'Scan Google Auth',
            'qr' => $qrCodeUrl
        ]);

        return view('User/google_auth', $data);
    }
    
    public function index_save_id(){
        if ($this->users === false) {
            $this->session->setFlashdata('error', 'Silahkan login terlebih dahulu');
            return redirect()->to(base_url() . '/login');
        }else{
            
        $iduser = $this->users['id'];
        $data = array_merge($this->base_data, [
                    'title' => 'Save ID',
                    'menu_users' => 'Save ID',
                    'games' => $this->M_Base->data_where('games', 'status', 'On'),
                    'target' => $this->M_Base->all_data('target'),
                    'player' => $this->M_Base->data_where('player_id', 'user_id', $iduser),
                ]);
        return view ('User/save_id', $data);
        }
    }
    
    public function getTargetFields() {
    $gameName = $this->request->getGET('games'); // Ambil nama game yang dipilih

    // Query ke database untuk mendapatkan data target dan kolom
    $gamequery = $this->M_Base->data_where('target', 'target', $gameName);

    // Pastikan bahwa gamequery mengembalikan data yang benar
    if ($gamequery) {
        // Cek apakah 'col' berisi string JSON yang valid, jika ada
        foreach ($gamequery as $game) {
            if (isset($game['col']) && !is_null($game['col'])) {
                // Pastikan 'col' adalah JSON string yang valid
                $decodedCol = json_decode($game['col']);
                if (json_last_error() === JSON_ERROR_NONE) {
                    // Jika valid, kirimkan data seperti biasa
                    return $this->response->setJSON($gamequery); // Gunakan response()->setJSON() untuk hasil yang lebih bersih
                } else {
                    // Jika format JSON 'col' tidak valid
                    return $this->response->setJSON(['error' => 'Kolom data tidak valid']);
                }
            }
        }
    }

    // Jika tidak ada data yang ditemukan atau query gagal
    return $this->response->setJSON(['error' => 'Data game tidak ditemukan']);
    }

    
    public function save_id_player() {
    // Periksa apakah user sudah login
        if ($this->users === false) {
            $this->session->setFlashdata('error', 'Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/login'));
        }

        // Ambil ID user yang sedang login
        $iduser = $this->users['id'];

        // Ambil data dari form
        $game = $this->request->getPost('games'); // Nama game
        $label = $this->request->getPost('label'); // Nama game
        $targets = $this->request->getPost('target'); // Data target dari dynamic fields
        
        
        // Validasi input
        if (empty($game)) {
            $this->session->setFlashdata('error', 'Game harus dipilih');
            return redirect()->to(base_url('/user/save-id'));
        }
        
        // Simpan data ke database
        if (is_array($targets) && count($targets) >= 1) {
            $userId = isset($targets[0]) ? trim($targets[0]) : '';

            // Validasi user_id
            if (empty($userId)) {
                // Kirim notifikasi bahwa user_id harus diisi
                $this->session->setFlashdata('error', 'User ID wajib diisi.');
                return redirect()->to(base_url('/user/save-id'));
            }
            
        $data = [
        'user_id' => $iduser,
        'label_akun' => $label,
        'games' => $game,
        'game_id' => $userId, // Ambil nilai pertama dari array (User ID)
        'zone_id' => isset($targets[1]) && !empty($targets[1]) ? $targets[1] : '', // Ambil nilai kedua dari array (Zone ID)
        'server_id' => isset($targets[2]) && !empty($targets[2]) ? $targets[2] : '',
        'ID_7' => isset($targets[3]) && !empty($targets[3]) ? $targets[3] : '',
        'ID_8' => isset($targets[4]) && !empty($targets[4]) ? $targets[4] : '',
        'date_create' => date('Y-m-d H:i:s'),
        ];

    // Simpan data ke database
    $this->M_Base->data_insert('player_id', $data);

    $this->session->setFlashdata('success', 'Data berhasil disimpan');
    } else {
        $this->session->setFlashdata('error', 'Data target tidak lengkap');
    }
    
    return redirect()->to(base_url('/user/save-id'));
    }
    
    public function delete_data($id) {
        
        if ($this->users === false) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silahkan login terlebih dahulu.'
            ]);
        }else {
            $playerid = $this->M_Base->data_where('player_id', 'id', $id);

            if (count($playerid) === 1) {
                $this->M_Base->data_delete('player_id', $id);

                $this->session->setFlashdata('success', 'Data ID berhasil dihapus');
                return redirect()->to(base_url() . '/user/save-id');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }


    
    // Fungsi untuk AJAX request mendapatkan banner
    public function getBanner()
    {
        $gameName = $this->request->getGet('game'); // Ambil nama game dari parameter GET
        $game = $this->M_Base->data_where('games', 'games', $gameName);
        if ($game) {
            return $this->response->setJSON(['banner' => $game[0]['banner']]);
        } else {
            return $this->response->setJSON(['banner' => null]);
        }
    }
    
}
