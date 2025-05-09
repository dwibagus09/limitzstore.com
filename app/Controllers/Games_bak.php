<?php

namespace App\Controllers;

use Xendit\Xendit;
use Xendit\PaymentChannels;
use CodeIgniter\HTTP\CURLRequest;

class Games extends BaseController {
	
	const MERCHANT_ID = "M220920NQDM1623ZP";
	const SECRET_KEY = "c2c0eb6618c4abd1ea59a5d0386f25c7873c245f7f4d0ca6e562e53b1dab4b02";

    private function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    public function index($slug = null) {

        if ($slug) {
            //$games = $this->M_Base->data_where('games', 'slug', $slug);
            $games = $this->M_Base->data_where_array('games', [
                'slug' => $slug,
                'status' => "On",
            ]);

            if (count($games) === 1) {
                
                if ($games[0]['slug'] === $slug) {
                    
                    $target = $this->M_Base->data_where('target', 'id', $games[0]['target']);
                    
                    $sparator = count($target) == 1 ? $target[0]['sparator'] : '';

                    if ($this->request->getPost('method') AND $this->request->getPost('product')) {

                        $data_post = [
                            'user_id' => '',
                            'zone_id' => '',
                            'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                            'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                            'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                            'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                            'email' => addslashes(trim(htmlspecialchars($this->request->getPost('email')))),
                            'voucher' => addslashes(trim(htmlspecialchars($this->request->getPost('voucher')))),
                            'jumlah' => addslashes(trim(htmlspecialchars($this->request->getPost('jumlah'))))
                        ];
                        
                        if ($games[0]['target'] != 'default') {
                            if ($this->request->getPost('target')) {
                            
                                $target_array = explode(',', $this->request->getPost('target'));
                                
                                if (is_array($target_array)) {
                                    
                                    $target = addslashes(trim(htmlspecialchars(implode($sparator, $target_array))));
                                    $target_json = addslashes(trim(htmlspecialchars(implode(',', $target_array))));
                                    
                                    $user_id = addslashes(trim(htmlspecialchars($target_array[0])));
                                    $zone_id = '';
                                    
                                    if (count($target_array) >= 2) {
                                        $zone_id = addslashes(trim(htmlspecialchars($target_array[1])));
                                    }
                                    
                                    $data_post['user_id'] = $user_id;
                                    $data_post['zone_id'] = $zone_id;
                                } else {
                                    $this->session->setFlashdata('error', 'Data Player tidak sesuai');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            }
                        } else {
                            $target = null;
                            $target_json = null;
                            
                            $user_id = null;
                            $zone_id = null;
                        }
                        
                        setcookie('fi_' . $games[0]['id'] . '_user', $data_post['user_id'], time()+60*60*24*30, '/');
                        setcookie('fi_' . $games[0]['id'] . '_server', $data_post['zone_id'], time()+60*60*24*30, '/');
                        setcookie('fi_wa', $data_post['wa'], time()+60*60*24*30, '/');
                        
                        if ($games[0]['target'] != 'default') {
                            if (in_array($games[0]['slug'], ['promo-diamond-slow', 'promo-gift-skin', 'joki-ranked-mobile-legends',])) {
                                $data_post['data'] = json_decode(trim($this->request->getPost('user_id')), true);
                                $data_post['user_id'] = trim(htmlentities($data_post['data']['user_id']));
                            }
                            if (empty($data_post['user_id'])) {
                                $this->session->setFlashdata('error', 'ID Player harus diisi'.$games[0]['target']);
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        }
                        if (empty($data_post['method'])) {
                            $this->session->setFlashdata('error', 'Metode belum dipilih');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['product'])) {
                            $this->session->setFlashdata('error', 'Produk belum dipilih');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['jumlah'])) {
                            $this->session->setFlashdata('error', 'Jumlah harus diisi');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if ($data_post['jumlah'] < 1) {
                            $this->session->setFlashdata('error', 'Jumlah minimal 1');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $product = $this->M_Base->data_where('product', 'id', $data_post['product']);

                            if (count($product) === 1) {

                                if ($product[0]['status'] == 'On') {

                                    if ($data_post['method'] === 'balance') {
                                        $users = '';
                                        if ($this->session->get('username')) {
                                            $users = $this->M_Base->data_where('users', 'username', $this->session->get('username'));
                                
                                            if (count($users) == 1) {
                                                if ($users[0]['status'] == 'On') {
                                                    $users = $users[0]['level'];
                                                }
                                            }
                                        }

                                        if ($users == 'Gold') {
                                            $idusers = 10002;
                                        } elseif ($users == 'Silver') {
                                            $idusers = 10001;
                                        } else {
                                            $idusers = 10003;
                                        }
                                                                                
                                        $method = [
                                            [
                                                'id' => $idusers,
                                                'status' => 'On',
                                                'provider' => 'Balance',
                                                'method' => 'Saldo Akun',
                                                'uniq' => 'N',
                                            ]
                                        ];
                                        $data_post['method'] = $method[0]['id'];
                                    } else {
                                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                                    }

                                    if (count($method) === 1) {
                                        if ($method[0]['status'] == 'On') {
                                            
                                            if ($data_post['zone_id'] == 1) {
                                                $data_post['zone_id'] = '';
                                            }
                                            
                                            $product_price = $product[0]['price'];

                                            if ($this->users == false) {
                                                $username = '';
                                                $username_tripay = 'Default';
                                            } else {
                                                $username = $this->users['username'];
                                                $username_tripay = $this->users['username'];
                                                
                                                if ($this->users['level'] == 'Silver') {
                                                    $product_price = $product[0]['price_silver'];
                                                } else if ($this->users['level'] == 'Gold') {
                                                    $product_price = $product[0]['price_gold'];
                                                }  else if ($this->users['level'] == 'Bisnis') {
                                                    $product_price = $product[0]['price_bisnis'];
                                                }
                                            }

                                            $status = 'Pending';
                                            $ket = 'Menunggu Pembayaran';

                                            $db = \Config\Database::connect();
                                            $builder = $db->table('utility');
                                            $builder->where('id', '55');
                                            $get = $builder->get()->getRowArray();

                                            $check_order_id =  $get['u_value'] . rand(000000,999999) . date('dmY');

                                            $builder2 = $db->table('orders');
                                            $builder2->where('order_id', $check_order_id);
                                            $get2 = $builder2->get()->getRowArray();
                                            if ($get2) {
                                                $order_id =  $check_order_id . rand(0000000,9999999) . date('dmY');
                                            } else {
                                                $order_id =  $check_order_id;
                                            }

                                            $order_id_provider = '';

                                            $find_price = $this->M_Base->data_where_array('price', [
                                                'method_id' => $data_post['method'],
                                                'product_id' => $data_post['product'],
                                            ]);
                                            
                                            if ($product[0]['product_count'] == 'Y') {
                                                $jumlah = (int)$data_post['jumlah'];
                                                if($jumlah < 1){
                                                    $jumlah = 1;
                                                }
                                            } else {
                                                $jumlah = 1;
                                            }

                                            $order_id_reference = '';
                                            if($jumlah > 1){
                                                $order_id_reference = array();
                                                // Product Count Order
                                                $order_id_reference[] = $order_id;
                                                for ($i=1; $i < $jumlah; $i++) { 
                                                    $check_order_id =  $get['u_value'] . rand(000000,999999) . date('dmY');
                                                    $builder2 = $db->table('orders');
                                                    $builder2->where('order_id', $check_order_id);
                                                    $get2 = $builder2->get()->getRowArray();
                                                    if ($get2) {
                                                        $order_id_reference[] =  $check_order_id . rand(0000000,9999999) . date('dmY');
                                                    } else {
                                                        $order_id_reference[] =  $check_order_id;
                                                    }
                                                }
                                            }

                                            $uniq = ($method[0]['uniq'] == 'Y') ? rand(000,999) : 0;

                                            $price = count($find_price) == 1 ? $find_price[0]['price'] * $jumlah : $product_price * $jumlah;
                                            
                                            if ($games[0]['slug'] === 'joki-ranked-mobile-legends') {
                                                $price = $price*$data_post['data']['star'];
                                            }
                                            
                                            $fee = 0;
                                            if (isset($method[0]['percent']) || isset($method[0]['fee'])) {
                                                if (is_numeric($method[0]['percent'])) {
                                                $fee += round(($price / 100) * $method[0]['percent']);
                                            }
                                            
                                            if (is_numeric($method[0]['fee'])) {
                                                $fee += $method[0]['fee'];
                                            }
                                            }
                                            
                                            $voucher = '';
                                            $diskon = 0;
                                            
                                            if (!empty($data_post['voucher'])) {
                                                
                                                $voucher = $data_post['voucher'];
                                                
                                                $data_voucher = $this->M_Base->data_where('voucher', 'voucher', $voucher);
                                                
                                                if (count($data_voucher) == 1) {
                                                    
                                                    $level_next = false;
                                                    
                                                    $my_level = 'Guest';
                                                    if ($this->users !== false) {
                                                        $my_level = 'NonGuest';
                                                        $my_level .= ',' . $this->users['level'];
                                                    }
                                                    foreach (array_filter(explode(',', $data_voucher[0]['level'])) as $voucher_level) {
                                                        
                                                        if (in_array($voucher_level, explode(',', $my_level))) {
                                                            
                                                            $level_next = true;
                                                        }
                                                    }
                                                    
                                                    if ($level_next == true) {
                                                        
                                                        if ($data_voucher[0]['stok'] > 0) {
                                                            
                                                            if ($price >= $data_voucher[0]['min']) {
                                                                
                                                                if ($data_voucher[0]['diskon_type'] == 'Flat') {
                                                                    $diskon = $data_voucher[0]['diskon'];
                                                                } else {
                                                                    $diskon = round(($price / 100) * $data_voucher[0]['diskon']);
                                                                    if ($diskon > $data_voucher[0]['max']) {
                                                                        $diskon = $data_voucher[0]['max'];
                                                                    }
                                                                }
                                                                
                                                                $this->M_Base->data_update('voucher', [
                                                                    'stok' => $data_voucher[0]['stok'] - 1,
                                                                ], $data_voucher[0]['id']);
                                                                
                                                            } else {
                                                                $this->session->setFlashdata('error', 'Min. Transaksi Rp ' . number_format($data_voucher[0]['min'],0,',','.') . ' untuk menggunakan voucher ini');
                                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                            }
                                                        } else {
                                                            $this->session->setFlashdata('error', 'Voucher telah mencapai limit');
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                    } else {
                                                        $this->session->setFlashdata('error', 'Voucher tidak dapat digunakan');
                                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                    }
                                                } else {
                                                    $this->session->setFlashdata('error', 'Voucher tidak ditemukan');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                }
                                            }
                                            
                                            $price = ($price - $diskon) + $uniq + $fee;

                                            if ($method[0]['provider'] == 'Tripay') {

                                                $data = [
                                                    'method'         => $method[0]['code'],
                                                    'merchant_ref'   => $order_id,
                                                    'amount'         => $price,
                                                    'customer_name'  => $username_tripay,
                                                    'customer_email' => $data_post['email'],
                                                    'customer_phone' => $data_post['wa'],
                                                    'order_items'    => [
                                                        [
                                                            'sku'         => $product[0]['sku'],
                                                            'name'        => $product[0]['product'],
                                                            'price'       => $price,
                                                            'quantity'    => $jumlah,
                                                        ]
                                                    ],
                                                    'return_url'   => base_url(),
                                                    'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                                                    'signature'    => hash_hmac('sha256', $this->M_Base->u_get('tripay-merchant').$order_id.$price, $this->M_Base->u_get('tripay-private'))
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
                                                        if ($result['data']) {
                                                            if (array_key_exists('qr_url', $result['data'])) {
                                                                $payment_code = $result['data']['qr_url'];
                                                            } else {
                                                                if (array_key_exists('pay_code', $result['data'])) {
                                                                $payment_code = $result['data']['pay_code'];
                                                                } else {
                                                                    $payment_code = $result['data']['checkout_url'];
                                                                }
                                                            }
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
                                                    'paymentAmount' => $price,
                                                    'paymentMethod' => $method[0]['code'],
                                                    'merchantOrderId' => $order_id,
                                                    'productDetails' => $product[0]['product'],
                                                    'customerVaName' => $username_tripay,
                                                    'email' => $data_post['email'],
                                                    'itemDetails' => [
                                                        [
                                                            'name' => $product[0]['product'],
                                                            'price' => $price,
                                                            'quantity' => $jumlah
                                                        ]
                                                    ],
                                                    'callbackUrl' => base_url() . '/sistem/callback/duitku',
                                                    'returnUrl' => base_url() . '/payment/' . $order_id,
                                                    'signature' => md5($merchantCode . $order_id . $price . $apiKey),
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
                                                        'ref_id' => $order_id,
                                                        'nominal' => $price,
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
                
                                                        if ($method[0]['code'] == 'QRIS' || $method[0]['code'] == 'QRISREALTIME' || $method[0]['code'] == 'QRIS_REALTIME_NOBU') {
                                                            $payment_code = $response['data']['qr_string'];
                                                        }else{
                                                            $payment_code = $response['data']['pay_url'];
                                                        }
                
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
                                                        'reference_id' => $order_id,
                                                        'type' => 'DYNAMIC',
                                                        'currency' => 'IDR',
                                                        'amount' => $price,
                                                    ];
                                                    
                                                    $qr_code = \Xendit\QRCode::create($params);
                                                    if (array_key_exists('qr_string', $qr_code)) {
                                                        $payment_code = $qr_code['qr_string'];
                                                    }
                                                    
                                                } else if (in_array($method[0]['code'], ['OVO', 'DANA', 'LINKAJA', 'SHOPEEPAY'])) {
                                                    
                                                    $ewalletChargeParams = [
                                                        'reference_id' => $order_id,
                                                        'currency' => 'IDR',
                                                        'customer_id' => 'c832697e-a62d-46fa-a383-24930b155e' . rand(0000,9999),
                                                        'amount' => $price,
                                                        'checkout_method' => 'ONE_TIME_PAYMENT',
                                                        'channel_code' => 'ID_' . $method[0]['code'],
                                                        'channel_properties' => [
                                                            'mobile_number' => '+628' . substr($data_post['wa'], 2),
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
                                                        "external_id" => $order_id,
                                                        "bank_code" => $method[0]['code'],
                                                        "name" => $username_tripay,
                                                        "is_closed" => true,
                                                        "expected_amount" => $price,
                                                    ];
                                                    
                                                    $createVA = \Xendit\VirtualAccounts::create($params);
                                                    
                                                    if (array_key_exists('account_number', $createVA)) {
                                                        $payment_code = $createVA['account_number'];
                                                    }
                                                    
                                                } else if (in_array($method[0]['code'], ['INVOICE'])) {
                                                    
                                                    $params = [ 
                                                        'external_id' => $order_id,
                                                        'amount' => $price,
                                                        'description' => 'Pembelian ' . $product[0]['product'],
                                                        'invoice_duration' => 86400,
                                                        'should_send_email' => true,
                                                        'success_redirect_url' => base_url(),
                                                        'failure_redirect_url' => base_url(),
                                                        'currency' => 'IDR',
                                                        'items' => [
                                                            [
                                                                'name' => $product[0]['product'],
                                                                'quantity' => $jumlah,
                                                                'price' => $price,
                                                            ]
                                                        ],
                                                    ];
            
                                                    $createInvoice = \Xendit\Invoice::create($params);
                                                    if (array_key_exists('invoice_url', $createInvoice)) {
                                                        $payment_code = $createInvoice['invoice_url'];
                                                    }
                                                    
                                                } else if (in_array($method[0]['code'], ['ALFAMART', 'INDOMARET'])) {
                                                    
                                                    $params = [
                                                        'external_id' => $order_id,
                                                        'retail_outlet_name' => $method[0]['code'],
                                                        'name' => $username_tripay,
                                                        'expected_amount' => $price
                                                    ];
                                                    
                                                    $createFPC = \Xendit\Retail::create($params);
                                                    if (array_key_exists('payment_code', $createFPC)) {
                                                        $payment_code = $createVA['payment_code'];
                                                    }
                                                    
                                                } else {
                                                    $this->session->setFlashdata('error', 'Kode metode tidak dikenali');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                }
                                            } else if ($method[0]['provider'] == 'Balance') {

                                                if ($this->users == false) {
                                                    $this->session->setFlashdata('error', 'Silahkan login dahulu');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                } else if ($this->users['balance'] < $price) {
                                                    $this->session->setFlashdata('error', 'Saldo tidak mencukupi');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                } else {

                                                    $payment_code = 'Saldo Akun';
                                                    $status = 'Processing';

                                                    if (!empty($data_post['zone_id']) AND $data_post['zone_id'] != 1) {
                                                        $customer_no = $data_post['user_id'] . $data_post['zone_id'];
                                                    } else {
                                                        $customer_no = $data_post['user_id'];
                                                    }

                                                    if ($product[0]['provider'] === 'DF') {

                                                        $df_user = $this->M_Base->u_get('digi-user');
                                                        $df_key = $this->M_Base->u_get('digi-key');

                                                        if($jumlah >  1){
                                                            $tmp_ket = array();
                                                            $tmp_id_provider = array();
                                                            for ($i=0; $i < $jumlah; $i++) { 
                                                                $post_data = json_encode([
                                                                    'username' => $df_user,
                                                                    'buyer_sku_code' => $product[0]['sku'],
                                                                    'customer_no' => $customer_no,
                                                                    'ref_id' => $order_id_reference[$i],
                                                                    'sign' => md5($df_user.$df_key.$order_id_reference[$i]),
                                                                ]);
                                                                $ch = curl_init();
                                                                curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                                                $result = curl_exec($ch);
                                                                $result = json_decode($result, true);
                                                                if (isset($result['data'])) {
                                                                    if ($result['data']['status'] == 'Gagal') {
                                                                        $tmp_ket[$i] = $result['data']['message'];
                                                                    } else {
                                                                        if(isset($result['data']['sn'])){
                                                                            $status = 'Success';
                                                                            $tmp_ket[$i] = $result['data']['sn'];
                                                                        }else{
                                                                            if(isset($result['data']['message'])){
                                                                                $tmp_ket[$i] = $result['data']['message'];
                                                                            }
                                                                        }
                                                                        echo json_encode(['success' => true]);
                                                                    }
                                                                } else {
                                                                    $tmp_ket[$i] = 'Failed Order';
                                                                }
                                                            }
                                                            $ket = json_encode($tmp_ket);

                                                        }else{
                                                            $post_data = json_encode([
                                                                'username' => $df_user,
                                                                'buyer_sku_code' => $product[0]['sku'],
                                                                'customer_no' => $customer_no,
                                                                'ref_id' => $order_id,
                                                                'sign' => md5($df_user.$df_key.$order_id),
                                                            ]);
                                            
                                                            $ch = curl_init();
                                                            curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                                            curl_setopt($ch, CURLOPT_POST, 1);
                                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                                            $result = curl_exec($ch);
                                                            $result = json_decode($result, true);
                                                            
                                                            if (isset($result['data'])) {
                                                                if ($result['data']['status'] == 'Gagal') {
                                                                    $ket = $result['data']['message'];
                                                                } else {
                                                                    //$ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
                                                                    if($result['data']['sn'] !== ''){
                                                                        $status = 'Success';
                                                                        $ket = $result['data']['sn'];
                                                                    }else{
                                                                        $ket = $result['data']['message'];
                                                                    }
                                                                    echo json_encode(['success' => true]);
                                                                }
                                                            } else {
                                                                $ket = 'Failed Order';
                                                            }
                                                        }

                                                    } else if ($product[0]['provider'] == 'Manual') {
                                                        
                                                        $status = 'Processing';
                                                        $ket = 'Pesanan siap diproses';
                                                        
                                                    } else if ($product[0]['provider'] === 'VocaGame') {
                                                        
                                                        $exp_sku = explode('.', $product[0]['sku']);

                                                        if (count($exp_sku) == 2) {
                                                            

                                                            if($jumlah >  1){

                                                                $tmp_ket = array();
                                                                $tmp_id_provider = array();
                                                                for ($i=0; $i < $jumlah; $i++) { 

                                                                    $result = $this->M_Voca->trx('POST', [
                                                                        'productId' => $exp_sku[0],
                                                                        'productItemId' => $exp_sku[1],
                                                                        'reference' => $order_id_reference[$i],
                                                                        'data' => [
                                                                            'userId' => $data_post['user_id'],
                                                                            'zoneId' => $data_post['zone_id'],
                                                                        ],
                                                                        'callbackUrl' => base_url() . '/sistem/callback_vocagame',
                                                                    ], 'transaction', 'transaction/' . $order_id_reference[$i], [
                                                                        'merchant' => $this->M_Base->u_get('voca_merchant'),
                                                                        'secret' => $this->M_Base->u_get('voca_secret'),
                                                                        'key' => $this->M_Base->u_get('voca_key'),
                                                                    ]);
                                                                    if ($result) {
                                                                        if (array_key_exists('statusCode', $result)) {
                                                                            $tmp_id_provider[$i] = '';
                                                                            $tmp_ket[$i] = 'Result : ' . $result['message'];
                                                                        } else {
                                                                            $status = 'Success';
                                                                            $tmp_id_provider[$i] = $result['data']['invoiceId'];
                                                                            $tmp_ket[$i] = $result['data']['sn'];
                                                                        }
                                                                    } else {
                                                                        $tmp_id_provider[$i] = '';
                                                                        $tmp_ket[$i] = 'Gagal terkoneksi ke VocaGame';
                                                                    }
                                                                }

                                                                $order_id_provider = json_encode($tmp_id_provider);
                                                                $ket = json_encode($tmp_ket);

                                                            }else{

                                                                   $result = $this->M_Voca->trx('POST', [
                                                                    'productId' => $exp_sku[0],
                                                                    'productItemId' => $exp_sku[1],
                                                                    'reference' => $order_id,
                                                                    'data' => [
                                                                        'userId' => $data_post['user_id'],
                                                                        'zoneId' => $data_post['zone_id'],
                                                                    ],
                                                                    'callbackUrl' => base_url() . '/sistem/callback/vocagame',
                                                                ], 'transaction', 'transaction/' . $order_id, [
                                                                    'merchant' => $this->M_Base->u_get('voca_merchant'),
                                                                    'secret' => $this->M_Base->u_get('voca_secret'),
                                                                    'key' => $this->M_Base->u_get('voca_key'),
                                                                ]);
                                                                   if ($result) {
                                                                    if (array_key_exists('statusCode', $result)) {
                                                                        $ket = 'Result : ' . $result['message'];
                                                                    } else {
                                                                        $status = 'Success';
                                                                        $order_id_provider = $result['data']['invoiceId'];
                                                                        $ket = $result['data']['sn'];
                                                                    }
                                                                } else {
                                                                    $ket = 'Gagal terkoneksi ke VocaGame';
                                                                }

                                                            }

                                                        } else {
                                                            $ket = 'Kode produk tidak sesuai';
                                                        }
                                                    } else if ($product[0]['provider'] === 'BangJeff') {
                                                        
                                                            if (!empty($data_post['zone_id'])) {
                                                                $inputs = [
                                                                    [
                                                                        'name' => 'ID',
                                                                        'value' => $data_post['user_id']
                                                                    ],
                                                                    [
                                                                        'name' => 'Server',
                                                                        'value' => $data_post['zone_id']
                                                                    ],
                                                                ];
                                                            } else {
                                                                $inputs = [
                                                                    [
                                                                        'name' => 'ID',
                                                                        'value' => $data_post['user_id']
                                                                    ]
                                                                ];
                                                            }


                                                            if($jumlah >  1){

                                                                $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/checkout', [
                                                                    'code' => $product[0]['sku'],
                                                                    'inputs' => $inputs,
                                                                    'qty' => $jumlah,
                                                                    'referenceNumber' => $order_id,
                                                                ]);

                                                            }else{

                                                                $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/checkout', [
                                                                    'code' => $product[0]['sku'],
                                                                    'inputs' => $inputs,
                                                                    'referenceNumber' => $order_id,
                                                                ]);

                                                            }
                                                            
                                                            if ($response) {
                                                                
                                                                if ($response['error'] == false) {
                                                                    $status = 'Success';
                                                                    $ket = $response['data']['invoiceNumber'];
                                                                    
                                                                } else {
                                                                    
                                                                    $ket = 'Failed : ' . $response['message'] . ' ';
                                                                }
                                                            } else {
                                                                
                                                                $ket = 'Gagal terkoneksi ke provider' . ' ';
                                                            }
                                                        
                                                    } elseif ($product[0]['provider'] == 'HokiTopup') {

                                                        $key = $this->M_Base->u_get('hokitopup');
                                        
                                                        if (!empty($data_post['zone_id'])) {

                                                            $curl = curl_init();
                                                            
                                                            curl_setopt_array($curl, array(
                                                              CURLOPT_URL => 'https://hokitopup.id/api/v1-alpha',
                                                              CURLOPT_RETURNTRANSFER => true,
                                                              CURLOPT_ENCODING => '',
                                                              CURLOPT_MAXREDIRS => 10,
                                                              CURLOPT_TIMEOUT => 0,
                                                              CURLOPT_FOLLOWLOCATION => true,
                                                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                              CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                                                              CURLOPT_CUSTOMREQUEST => 'POST',
                                                              CURLOPT_POSTFIELDS => array('action' => 'order','api_key' => $key,'product' => $product[0]['sku'],'user_id' => $data_post['user_id'],'zone_id' => $data_post['zone_id'],'order_id' => $order_id),
                                                            ));
                                                            
                                                            $result = curl_exec($curl);
                                                            $error = curl_error($curl);
                                                            $result = json_decode($result, true);
                                                        } else {
                                                            $curl = curl_init();
                                                            
                                                            curl_setopt_array($curl, array(
                                                              CURLOPT_URL => 'https://hokitopup.id/api/v1-alpha',
                                                              CURLOPT_RETURNTRANSFER => true,
                                                              CURLOPT_ENCODING => '',
                                                              CURLOPT_MAXREDIRS => 10,
                                                              CURLOPT_TIMEOUT => 0,
                                                              CURLOPT_FOLLOWLOCATION => true,
                                                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                              CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                                                              CURLOPT_CUSTOMREQUEST => 'POST',
                                                              CURLOPT_POSTFIELDS => array('action' => 'order','api_key' => $key,'product' => $product[0]['sku'],'user_id' => $data_post['user_id'],'zone_id' => '','order_id' => $order_id),
                                                            ));
                                                            
                                                            $result = curl_exec($curl);
                                                            $error = curl_error($curl);
                                                            $result = json_decode($result, true);
                                                        }
                                                        
                                                        if($result) {
                                                            if ($result['success'] == false) {
                                                                $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                                                            } else if ($result['success'] == true) {
                                                                $status = 'Success';
                                                                $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                                                            } else {
                                                                $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                                                            }
                                                        } else {
                                                            $ket = $error;
                                                        }
                                                        
                                                } else if ($product[0]['provider'] === 'AG') {

                                                        if($jumlah >  1){
                                                             $tmp_ket = array();
                                                             for ($i=0; $i < $jumlah; $i++) { 
                                                                $curl = curl_init();
                                                                curl_setopt_array($curl, array(
                                                                    CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $order_id_reference[$i],
                                                                    CURLOPT_RETURNTRANSFER => true,
                                                                    CURLOPT_ENCODING => '',
                                                                    CURLOPT_MAXREDIRS => 10,
                                                                    CURLOPT_TIMEOUT => 0,
                                                                    CURLOPT_FOLLOWLOCATION => true,
                                                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                    CURLOPT_CUSTOMREQUEST => 'GET',
                                                                    CURLOPT_POSTFIELDS => '',
                                                                    CURLOPT_HTTPHEADER => array(
                                                                        'Content-Type: application/x-www-form-urlencoded'
                                                                    ),
                                                                ));

                                                                $result = curl_exec($curl);
                                                                $result = json_decode($result, true);

                                                                if ($result['status'] == 0) {
                                                                    $tmp_ket = $result['error_msg'];
                                                                } else {
                                                                    
                                                                    if ($result['data']['status'] == 'Sukses') {
                                                                        $status = 'Success';
                                                                    }

                                                                    $tmp_ket = $result['data']['sn'];
                                                                }

                                                             }

                                                             $ket = json_encode($tmp_ket);

                                                        }else{

                                                            $curl = curl_init();
                                                            curl_setopt_array($curl, array(
                                                                CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $order_id,
                                                                CURLOPT_RETURNTRANSFER => true,
                                                                CURLOPT_ENCODING => '',
                                                                CURLOPT_MAXREDIRS => 10,
                                                                CURLOPT_TIMEOUT => 0,
                                                                CURLOPT_FOLLOWLOCATION => true,
                                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                CURLOPT_CUSTOMREQUEST => 'GET',
                                                                CURLOPT_POSTFIELDS => '',
                                                                CURLOPT_HTTPHEADER => array(
                                                                    'Content-Type: application/x-www-form-urlencoded'
                                                                ),
                                                            ));

                                                            $result = curl_exec($curl);
                                                            $result = json_decode($result, true);

                                                            if ($result['status'] == 0) {
                                                                $ket = $result['error_msg'];
                                                            } else {
                                                                
                                                                if ($result['data']['status'] == 'Sukses') {
                                                                    $status = 'Success';
                                                                }

                                                                $ket = $result['data']['sn'];
                                                            }

                                                        }

                                                    } else {
                                                        $ket = 'Provider tidak ditemukan';
                                                    }
                                                    
                                                    //Jika Status Sukses maka Balance Akan Berkurang atau keterangan pesanan siap diproses (mode manual)
                                                    //if($status == "Success" || $ket = 'Pesanan siap diproses'){
                                                        $this->M_Base->data_update('users', [
                                                            'balance' => $this->users['balance'] - $price,
                                                        ], $this->users['id']);   
                                                    //}
                                                }

                                            } else if ($method[0]['provider'] == 'Manual') {
                                                $payment_code = $method[0]['rek'];
                                            } else {
                                                $this->session->setFlashdata('error', 'Metode tidak terdaftar');
                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                            }
                                            
                                            if ($product[0]['product_count'] == 'Y') {
                                                $jumlah = (int)$data_post['jumlah'];
                                                if($jumlah < 1){
                                                    $jumlah = 1;
                                                }
                                            } else {
                                                $jumlah = 1;
                                            }

                                            if(!empty($order_id_reference)){
                                                $order_id_reference = json_encode($order_id_reference);
                                            }

                                            $this->M_Base->data_insert('orders', [
                                                'order_id' => $order_id,
                                                'order_id_reference' => $order_id_reference,
                                                'order_id_provider' => $order_id_provider,
                                                'username' => $username,
                                                'wa' => $data_post['wa'],
                                                'email' => $data_post['email'],
                                                'product_id' => $product[0]['id'],
                                                'product' => $product[0]['product'],
                                                'jumlah' => $jumlah,
                                                'price_modal' => $product[0]['price_modal'] * $jumlah,
                                                'price' => $price,
                                                'fee' => $fee,
                                                'uniq' => $uniq,
                                                'diskon' => $diskon,
                                                'voucher' => $voucher,
                                                'user_id' => in_array($games[0]['slug'], ['promo-diamond-slow', 'promo-gift-skin', 'joki-ranked-mobile-legends',]) ? json_encode(json_encode($data_post['data'])) : $data_post['user_id'],
                                                'zone_id' => $data_post['zone_id'],
                                                'target' => $target,
                                                'target_json' => $target_json,
                                                'nickname' => $data_post['username'],
                                                'method_id' => $method[0]['id'],
                                                'method' => $method[0]['method'],
                                                'games' => $games[0]['games'],
                                                'games_id' => $games[0]['id'],
                                                'status' => $status,
                                                'ket' => $ket,
                                                'payment_code' => $payment_code,
                                                'provider' => $product[0]['provider'],
                                                'date' => date('Y-m-d'),
                                                'date_create' => date('Y-m-d G:i:s'),
                                                'date_process' => date('Y-m-d G:i:s'),
                                            ]);

                                            $user_ip = $this->get_client_ip();

                                            $this->M_Base->data_insert('ip', [
                                                'order_id' => $order_id,
                                                'ip' => $user_ip,
                                            ]);
                                            
                                                 $email_smtp = \Config\Services::email();
                                                
                                                                $config["protocol"] = "smtp";
                                                                
                                                                //isi sesuai nama domain/mail server
                                                                $config["SMTPHost"]  = "avellino.id.domainesia.com";
                                                                
                                                                //alamat email SMTP
                                                                $config["SMTPUser"]  = "smtp@belanjagame.com"; 
                                                                
                                                                //password email SMTP
                                                                $config["SMTPPass"]  = "smtp@belanjagame.com"; 
                                                                
                                                                $config["SMTPPort"]  = 465;
                                                                $config["SMTPCrypto"] = "ssl";
                                                                
                                                                $email_smtp->initialize($config);
                                                                
                                                                $email_smtp->setFrom("invoice@belanjagame.com", "INVOICE BELANJA GAME");
                                                                $email_smtp->setTo($data_post['email']);
                                                                $email_smtp->setSubject("INOVICE BELANJA GAME - $order_id");
                                                
                                                   $data = array_merge($this->base_data, [
                                                            'title' => $this->base_data['web']['name'],
                                                            'Description' => $product[0]['product'].' telah berhasil di order. Silakan lakukan pembayaran melalui metode pembayaran yang telah anda pilih.',
                                                            'game' => $games[0]['games'],
                                                            'product' => $product[0]['product'],
                                                            'user_id' => $data_post['user_id'],
                                                            'zone_id' => $data_post['zone_id'],
                                                            'nickname' => $data_post['username'],
                                                            'order_id' => $order_id,
                                                            'metode' => $method[0]['method'],
                                                            'total_harga' => $price,
                                                            'keterangan' => $ket,
                                                        ]);
                                                
                                                
                                                $messagebody = view("Template/gmail", $data);
                                                
                                                $email_smtp->setMessage($messagebody);
                                                $email_smtp->setMailType('html');  
                                                
                                                $email_smtp->send();
                                                
                                                 $wa_order = $this->M_Base->u_get('wa_order');
                                            if (!empty($wa_order)) {
                                                
                                                if ($data_post['username']){
                                                    $usernameakun = $data_post['username'];
                                                } else {
                                                    $usernameakun = 'Tidak ada nickname';
                                                }
                                                $this->M_Wa->send([
                                                    'token' => $this->M_Base->u_get('wa_fonnte'),
                                                    'target' => $data_post['wa'],
                                                    'message' => str_replace([
                                                        '#order_id#',
                                                        '#product#',
                                                        '#price#',
                                                        '#user_id#',
                                                        '#zone_id#',
                                                        '#nickname#',
                                                        '#method#',
                                                        '#games#',
                                                        '#ket#',
                                                    ], [
                                                        $order_id,
                                                        $product[0]['product'],
                                                        $price,
                                                        $data_post['user_id'],
                                                        $data_post['zone_id'],
                                                        $usernameakun,
                                                        $method[0]['method'],
                                                        $games[0]['games'],
                                                        $ket,
                                                    ], $wa_order),
                                                ]);
                                            }
                                            
                                            if ($status == 'Success') {
                                                
                                                $top = $this->M_Base->data_where_array('top', [
                                                    'user_id' => $data_post['user_id'],
                                                    'games_id' => $games[0]['id'],
                                                    'periode' => date('Y-m'),
                                                ]);
                                                
                                                if (count($top) == 0) {
                                                    
                                                    $this->M_Base->data_insert('top', [
                                                        'user_id' => $data_post['user_id'],
                                                        'nickname' => $data_post['username'],
                                                        'games_id' => $games[0]['id'],
                                                        'total' => 1,
                                                        'nominal' => $price,
                                                        'periode' => date('Y-m'),
                                                    ]);
                                                } else {
                                                    
                                                    $nickname = $top[0]['nickname'];
                                                    if (!empty($data_post['username'])) {
                                                        $nickname = $data_post['username'];
                                                    }
                                                    
                                                    $this->M_Base->data_update('top', [
                                                        'nickname' => $nickname,
                                                        'total' => $top[0]['total'] + 1,
                                                        'nominal' => $top[0]['nominal'] + $price,
                                                    ], $top[0]['id']);
                                                }
                                                
                                               $email_smtp = \Config\Services::email();

                                                $config["protocol"] = "smtp";
                                                
                                                //isi sesuai nama domain/mail server
                                                $config["SMTPHost"]  = "avellino.id.domainesia.com";
                                                
                                                //alamat email SMTP
                                                $config["SMTPUser"]  = "smtp@belanjagame.com"; 
                                                
                                                //password email SMTP
                                                $config["SMTPPass"]  = "smtp@belanjagame.com"; 
                                                
                                                $config["SMTPPort"]  = 465;
                                                $config["SMTPCrypto"] = "ssl";
                                                
                                                $email_smtp->initialize($config);
                                                
                                                $email_smtp->setFrom("invoice@belanjagame.com", "INVOICE BELANJA GAME");
                                                $email_smtp->setTo($data_post['email']);
                                                $email_smtp->setSubject("INOVICE BELANJA GAME - $order_id");
                                                
                                                   $data = array_merge($this->base_data, [
                                                            'title' => $this->base_data['web']['name'],
                                                            'Description' => 'Product telah ditambahkan ke akun '.$games[0]['games'].' bos anda. Jika masih belum masuk, silakan melakukan re-login dan masuk kembali.',
                                                            'game' => $games[0]['games'],
                                                            'product' => $product[0]['product'],
                                                            'user_id' => $data_post['user_id'],
                                                            'zone_id' => $data_post['zone_id'],
                                                            'nickname' => $data_post['username'],
                                                            'order_id' => $order_id,
                                                            'metode' => $method[0]['method'],
                                                            'total_harga' => $price,
                                                            'keterangan' => $ket,
                                                        ]);
                                                
                                                
                                                $messagebody = view("Template/gmail", $data);
                                                
                                                $email_smtp->setMessage($messagebody);
                                                $email_smtp->setMailType('html');  
                                                
                                                $email_smtp->send();
                                                
                                                    $wa_success = $this->M_Base->u_get('wa_success');
                                                    if (!empty($wa_success)) {
                                                         if ($data_post['username']){
                                                            $usernameakun = $data_post['username'];
                                                        } else {
                                                            $usernameakun = 'Tidak ada nickname';
                                                        }
                                                        $this->M_Wa->send([
                                                            'token' => $this->M_Base->u_get('wa_fonnte'),
                                                            'target' => $data_post['wa'],
                                                            'message' => str_replace([
                                                                '#order_id#',
                                                                '#product#',
                                                                '#price#',
                                                                '#user_id#',
                                                                '#zone_id#',
                                                                '#nickname#',
                                                                '#method#',
                                                                '#games#',
                                                                '#ket#',
                                                            ], [
                                                                $order_id,
                                                                $product[0]['product'],
                                                                $price,
                                                                $data_post['user_id'],
                                                                $data_post['zone_id'],
                                                                $usernameakun,
                                                                $method[0]['method'],
                                                                $games[0]['games'],
                                                                $ket,
                                                            ], $wa_success),
                                                        ]);
                                                }
                                            }
                                            
                                            $this->session->setFlashdata('success', 'Pesanan berhasil dibuat');
                                            return redirect()->to(base_url() . '/payment/' . $order_id);

                                        } else {
                                            $this->session->setFlashdata('error', 'Metode pembayaran sedang gangguan');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Metode pembayaran tidak ditemukan');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                } else {
                                    $this->session->setFlashdata('error', 'Produk sedang gangguan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Produk tidak ditemukan');
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
                    
                    $product = [];
                    foreach (array_reverse($this->M_Base->all_data_order('product_category', 'sort')) as $category) {

                    	$data_product = array_reverse($this->M_Base->data_where_array('product', [
                    		'category_id' => $category['id'],
                    		'games_id' => $games[0]['id'],
                    		'status' => 'On',
                    	], 'sort'));

                    	if (count($data_product) !== 0) {
                    		$product[] = [
                    			'id' => $category['id'],
                    			'category' => $category['category'],
                    			'product' => $data_product,
                    		];
                    	}
                    }
                    
                    $auto_fill = [
                        'user' => '',
                        'server' => '',
                        'wa' => '',
                    ];
                    
                    if (isset($_COOKIE['fi_wa'])) {
                        
                        $fi_wa = addslashes(trim(htmlspecialchars($_COOKIE['fi_wa'])));
                        
                        if (is_numeric($fi_wa)) {
                            
                            if (strlen($fi_wa) > 8 AND strlen($fi_wa) < 18) {
                                
                                $auto_fill['wa'] = $fi_wa;
                            }
                        }
                    }
                    
                    if (isset($_COOKIE['fi_' . $games[0]['id'] . '_user'])) {
                        
                        $auto_fill_user = addslashes(trim(htmlspecialchars($_COOKIE['fi_' . $games[0]['id'] . '_user'])));
                        
                        if (!empty($auto_fill_user)) {
                            
                            $auto_fill['user'] = $auto_fill_user;
                        }
                    }
                    
                    if (isset($_COOKIE['fi_' . $games[0]['id'] . '_server'])) {
                        
                        $auto_fill_server = addslashes(trim(htmlspecialchars($_COOKIE['fi_' . $games[0]['id'] . '_server'])));
                        
                        if (!empty($auto_fill_server)) {
                            
                            $auto_fill['server'] = $auto_fill_server;
                        }
                    }
                    
                    $review = [];
                    foreach ( $this->M_Base->all_data('orders_review', 5) as $loop) {
                        // Load All Data Orders Need to Change using Count
                        // $data_orders = $this->M_Base->all_data('orders');
                        $count_data_orders = $this->M_Base->data_count('orders');
                        if ($count_data_orders == 1) {
                            // If Load data only 1 then load data orders
                            $data_orders = $this->M_Base->all_data('orders');
                            $review_wa = $data_orders[0]['wa'];
                            $review_product = $data_orders[0]['product'];
                        } else {
                            $review_wa = '';
                            $review_product = '';
                        }
                        
                        $review[] = array_merge($loop, [
                            'wa' => $review_wa,
                            'product' => $review_product,
                        ]);
                    }
                    //echo "<pre>"; print_r($review); die;
                    //$totalulasan = count($review);
                    $totalulasan = $this->M_Base->data_count('orders_review');

                    $ratings = [];
                    for ($i = 1; $i <= 5; $i++) {
                        $ratings[$i] = $this->db->table('orders_review')->where('star', $i)->countAllResults();
                    }

                    $totalReviews = array_sum($ratings);
                    $dataratings = [];
                    foreach ($ratings as $rating) {
                        $width = ($rating > 0) ? ($rating / $totalReviews) * 100 : 0;
                        $dataratings[] = $width;
                    }

                    $puas = $ratings[3] + $ratings[4] + $ratings[5];

                    $totalRating = 0;
                    for ($i = 1; $i <= 5; $i++) {
                        $totalRating += $i * $ratings[$i];
                    }

                    $ratingRataRata = ($totalReviews > 0) ? $totalRating / $totalReviews : 0;

                    $builder = $this->db->table('games');
                    $builder->where('category', $games[0]['category']);
                    $builder->where('status', 'On');
                    $footer = $builder->get()->getResultArray();

                    $buildercategory = $this->db->table('category');
                    $buildercategory->where('id', $games[0]['category']);
                    $footercategory = $buildercategory->get()->getRowArray();

                    $data = array_merge($this->base_data, [
                        'title' => $games[0]['games'],
                        'games' => $games[0],
                        'footer' => $footer,
                        'footercategory' => $footercategory,
                        'pay_balance' => $this->M_Base->u_get('pay_balance'),
                        'method' => $method,
                        'auto_fill' => $auto_fill,
                        'voucher' => $this->M_Base->data_where_array('voucher', ['private' => 'N', 'stok >' => 0]),
                        'product' => $product,
                        'target' => $target,
                        'popup' => [
                            'status' => $games[0]['popup_status'],
                            'content' => $games[0]['popup_content'],
                        ],
                        'review' => array_slice($review, -5, null, true),
                        'totalulasan' => $totalulasan,
                        'totalpuas' => $puas,
                        'ratingratarata' => round($ratingRataRata, 1),
                        'dataratings' => $dataratings,
                    ]);

                    return view('Games/index', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                //throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                return redirect()->to(base_url());
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function product_count($id) {
        if (is_numeric($id)) {
            $product = $this->M_Base->data_where('product', 'id', $id);

            $price[] = [
                'product_count' => $product[0]['product_count'],
            ];

            echo json_encode($price);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function order($action = null, $id = null) {

        if ($action === 'get-price') {
            if (is_numeric($id)) {
                $product = $this->M_Base->data_where('product', 'id', $id);

                if (count($product) == 1) {
                    
                    $product_price = $product[0]['price'];
                    
                    if ($this->users !== false) {
                        
                        if ($this->users['level'] == 'Silver') {
                            $product_price = $product[0]['price_silver'];
                        } else if ($this->users['level'] == 'Gold') {
                            $product_price = $product[0]['price_gold'];
                        } else if ($this->users['level'] == 'Bisnis') {
                            $product_price = $product[0]['price_bisnis'];
                        }
                    }
                    
                    $price = [];
                    foreach ($this->M_Base->all_data('method') as $loop) {

                        $find_price = $this->M_Base->data_where_array('price', [
                            'method_id' => $loop['id'],
                            'product_id' => $id
                        ]);

                        $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product_price;
                        
                        $fee = $loop['fee'];
                        if (is_numeric($loop['percent'])) {
                            $fee += round(($custom_price / 100) * $loop['percent']);
                        }

                        $price[] = [
                            'method' => $loop['id'],
                            'price' => number_format($custom_price + $fee,0,',','.'),
                        ];
                    }

                    if ($this->M_Base->u_get('pay_balance') == 'Y') {
                        if ($this->session->get('username')) {
                            $users = $this->M_Base->data_where('users', 'username', $this->session->get('username'));
                
                            if (count($users) == 1) {
                                if ($users[0]['status'] == 'On') {
                                    $this->users = $users[0]['level'];
                                }
                            }
                        }
                        if ($this->users == 'Gold'){
                            $idusers = 10002;
                        } else {
                            if ($this->users == 'Bisnis'){
                                $idusers = 10003;
                            } else {
                                $idusers = 10001;
                            }
                        }

                        $find_price = $this->M_Base->data_where_array('price', [
                            'method_id' => $idusers,
                            'product_id' => $id
                        ]);

                        $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product_price;

                        $price[] = [
                            'method' => 'balance',
                            'price' => number_format($custom_price,0,',','.'),
                            'user' => $this->users,
                        ];
                    }

                    echo json_encode($price);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($action == 'get-detail') {

            if ($this->request->getPost('method')) {
                
                if($this->request->getPost('target')) {
                    $data_post = [
                        'target' => addslashes(trim(htmlspecialchars($this->request->getPost('target')))),
                        'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                        'product' => $id,
                        'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                        'email' => addslashes(trim(htmlspecialchars($this->request->getPost('email')))),
                        'voucher' => addslashes(trim(htmlspecialchars($this->request->getPost('voucher')))),
                        'jumlah' => addslashes(trim(htmlspecialchars($this->request->getPost('jumlah')))),
                        'user_id' => '',
                        'zone_id' => '',
                    ];
                    
                    $target_exp = explode(',', $data_post['target']);
                
                    if (is_array($target_exp)) {
                        
                        $data_post['user_id'] = $target_exp[0];
                        
                        if (count($target_exp) >= 2) {
                            $data_post['zone_id'] = $target_exp[1];
                        }
                    }
                } else {
                    $data_post = [
                        'target' => 0,
                        'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                        'product' => $id,
                        'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                        'voucher' => addslashes(trim(htmlspecialchars($this->request->getPost('voucher')))),
                        'email' => addslashes(trim(htmlspecialchars($this->request->getPost('email')))),
                        'jumlah' => addslashes(trim(htmlspecialchars($this->request->getPost('jumlah')))),
                        'user_id' => 0,
                        'zone_id' => 0,
                    ];
                }

                $product = $this->M_Base->data_where('product', 'id', $data_post['product']);

                if (count($product) === 1) {
                    
                    if ($data_post['method'] === 'balance') {
                        $method = [
                            [
                                'method' => 'Saldo Akun',
                            ],
                        ];
                    } else {
                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                    }

                    if (count($method) === 1) {

                        $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);

                        if (count($games) == 1) {
                            if ($games[0]['slug'] === 'promo-diamond-slow') {
                                $data_post['data'] = json_encode([
                                    'email' => addslashes(trim(htmlspecialchars($this->request->getPost('email')))),
                                    'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
                                    'login_type' => addslashes(trim(htmlspecialchars($this->request->getPost('login_type')))),
                                    'user_id' => $data_post['user_id']
                                ]);
                            } else if ($games[0]['slug'] === 'promo-gift-skin') {
                                $data_post['data'] = json_encode([
                                    'nickname' => trim(htmlspecialchars($this->request->getPost('nickname'))),
                                    'hero' => trim(htmlspecialchars($this->request->getPost('hero'))),
                                    'skin' => trim(htmlspecialchars($this->request->getPost('skin'))),
                                    'user_id' => $data_post['user_id']
                                ]);
                            } else if ($games[0]['slug'] === 'joki-ranked-mobile-legends') {
                                $data_post['data'] = json_encode([
                                    'email' => addslashes(htmlspecialchars($this->request->getPost('email'))),
                                    'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
                                    'hero' => addslashes(htmlspecialchars($this->request->getPost('hero'))),
                                    'login_type' => addslashes(trim(htmlspecialchars($this->request->getPost('login_type')))),
                                    'star' => addslashes(trim(htmlspecialchars($this->request->getPost('star')))),
                                    'user_id' => $data_post['user_id']
                                ]);
                            }

                            $price = $this->M_Base->data_where_array('price', [
                                'method_id' => $data_post['method'],
                                'product_id' => $data_post['product'],
                            ]);
                            
                            $product_price = count($price) == 1 ? $price[0]['price'] : $product[0]['price'];
                            
                            if ($this->users !== false) {
                                if ($this->users['level'] == 'Silver') {
                                    $product_price = $product[0]['price_silver'];
                                } else if ($this->users['level'] == 'Gold') {
                                    $product_price = $product[0]['price_gold'];
                                } else if ($this->users['level'] == 'Bisnis') {
                                    $product_price = $product[0]['price_bisnis'];
                                }
                            }

                            $real_price = count($price) == 1 ? $product_price : $product[0]['price'];

                            if ($data_post['zone_id'] != 1) {
                                $target = $data_post['user_id'] . ' (' . $data_post['zone_id'] . ')';
                            } else {
                                $target = $data_post['user_id'];
                            }
                            
                            if ($games[0]['slug'] === 'promo-diamond-slow') {
                                $data_data = json_decode($data_post['data'], true);
                                $target = json_encode([
                                    trim(htmlspecialchars($this->request->getPost('email'))),
                                    trim(htmlspecialchars($this->request->getPost('password'))),
                                    trim(htmlspecialchars($this->request->getPost('login_type'))),
                                    $data_post['user_id'],
                                    $data_post['zone_id']
                                ]);
                            } else if ($games[0]['slug'] === 'promo-gift-skin') {
                                $data_data = json_decode($data_post['data'], true);
                                $target = json_encode([
                                    trim(htmlspecialchars($this->request->getPost('nickname'))),
                                    trim(htmlspecialchars($this->request->getPost('id_akun'))),
                                    trim(htmlspecialchars($this->request->getPost('id_server'))),
                                    trim(htmlspecialchars($this->request->getPost('hero'))),
                                    trim(htmlspecialchars($this->request->getPost('skin')))
                                ]);
                            } else if ($games[0]['slug'] === 'joki-ranked-mobile-legends') {
                                $data_data = json_decode($data_post['data'], true);
                                $target = json_encode([
                                    trim(htmlspecialchars($this->request->getPost('email'))),
                                    trim(htmlspecialchars($this->request->getPost('password'))),
                                    trim(htmlspecialchars($this->request->getPost('hero'))),
                                    trim(htmlspecialchars($this->request->getPost('nickname'))),
                                    trim(htmlspecialchars($this->request->getPost('login_type'))),
                                    trim(htmlspecialchars($this->request->getPost('star')))
                                ]);
                            }
                            
                            $price = $product[0]['price'];
                            if ($this->users !== false) {
                                if ($this->users['level'] == 'Silver') {
                                    $price = $product[0]['price_silver'];
                                } else if ($this->users['level'] == 'Gold') {
                                    $price = $product[0]['price_gold'];
                                } else if ($this->users['level'] == 'Bisnis') {
                                    $price = $product[0]['price_bisnis'];
                                }
                            }
                            
                             if ($product[0]['product_count'] == 'Y') {
                                    $jumlah = $data_post['jumlah'];
                                    if($jumlah < 1){
                                        $jumlah = 1;
                                    }
                                } else {
                                    $jumlah = 1;
                                }
                                
                              if ($data_post['method'] === 'balance') {
                                   $fee = 0;
                                } else {
                                   $fee = $method[0]['fee'];
                                    if (is_numeric($method[0]['percent'])) {
                                        $fee += round(($price / 100) * $method[0]['percent']);
                                    }
                                }
                            
                            $diskon = 0;
                            
                            $voucher_error = null;
                            
                            if ($data_post['voucher']) {
                                
                                if (!empty($data_post['voucher'])) {
                                    
                                    $voucher = $this->M_Base->data_where('voucher', 'voucher', $data_post['voucher']);
                                    
                                    if (count($voucher) == 1) {
                                        
                                        $level_next = false;
                                                    
                                        $my_level = 'Guest';
                                        if ($this->users !== false) {
                                            $my_level = 'NonGuest';
                                            $my_level .= ',' . $this->users['level'];
                                        }
                                        
                                        foreach (array_filter(explode(',', $voucher[0]['level'])) as $voucher_level) {
                                            
                                            if (in_array($voucher_level, explode(',', $my_level))) {
                                                
                                                $level_next = true;
                                            }
                                        }
                                        
                                        if ($level_next == true) {
                                            
                                            if ($voucher[0]['stok'] > 0) {
                                                
                                                if ($price >= $voucher[0]['min']) {
                                                    
                                                    if ($voucher[0]['diskon_type'] == 'Flat') {
                                                        $diskon = $voucher[0]['diskon'];
                                                    } else {
                                                        
                                                        $diskon = round(($price / 100) * $voucher[0]['diskon']);
                                                        
                                                        if ($diskon > $voucher[0]['max']) {
                                                            $diskon = $voucher[0]['max'];
                                                        }
                                                    }
                                                } else {
                                                    $voucher_error = 'Min. Transaksi Rp ' . number_format($voucher[0]['min'],0,',','.') . ' untuk menggunakan voucher ini';
                                                }
                                            } else {
                                                $voucher_error = 'Voucher telah mencapai limit';
                                            }
                                        } else {
                                            $voucher_error = 'Voucher tidak dapat digunakan';
                                        }
                                    } else {
                                        $voucher_error = 'Voucher tidak ditemukan';
                                    }
                                }
                            }
                            
                            if($product[0]['price_cut'] > $price){
                                 $diskonvoucher = $product[0]['price_cut'] - $price;
                            } else {
                                 $diskonvoucher = 0;
                            }
                            
                            $hemat = $diskon + $diskonvoucher;
                            
                            if ($voucher_error == null) {
                                
                                $total = (($price * $jumlah) - $diskon) + $fee;
                                
                                 $target_alert = $this->M_Base->data_where('target', 'id', $games[0]['target']);

                                if ($games[0]['check_status'] == 'Y') {
                                    
                                    if ($games[0]['cek_id_provider'] === 'kenzo' || $games[0]['cek_id_provider'] === 'apigame' || $games[0]['cek_id_provider'] === 'pln' || $games[0]['cek_id_provider'] === 'voca' || $games[0]['cek_id_provider'] === 'enivay') {
                                        
                                        if($games[0]['cek_id_provider'] === 'apigame') {
                                                if ($data_post['zone_id'] != 1) {
                                                    $gtarget = $data_post['user_id'] . $data_post['zone_id'];
                                                } else {
                                                    $gtarget = $data_post['user_id'];
                                                }
                
                                                $result = self::fetch('https://v1.apigames.id/merchant/' . self::MERCHANT_ID . '/cek-username/' . $games[0]['check_code'], [
                                                    'user_id' => $gtarget,
                                                    'signature' => md5(self::MERCHANT_ID . self::SECRET_KEY)
                                                ]);
                                                
                                                if($result) {
                                                    if ($result['status'] == 1) {
                                                        $username = $result['data']['username'];
                                                        $status = $result['status'];
                                                    } else {
                                                        $status = 'errors';
                                                    }
                                                }
                                        }
                                        
                                        if ($games[0]['cek_id_provider'] === 'kenzo') {
                                              $result = self::fetch('https://kenzopedia.com/api/cek_id', [
                                                        'apikey' => 'kenzogege',
                                                        'game' => $games[0]['check_code'],
                                                        'user_id' => $data_post['user_id'],
                                                        'zone_id' => $data_post['zone_id'],
                                                ]);
                                                
                                                if($result) {
                                                    if ($result['status'] == 'success') {
                                                        $username = $result['data']['username'];
                                                        $status = $result['status'];
                                                    } else {
                                                        $status = 'errors';
                                                    }
                                                }
                                                
                                        }
                                        
                                         if ($games[0]['cek_id_provider'] === 'pln') {
                                                        $df_user = $this->M_Base->u_get('digi-user');
                                                        $df_key = $this->M_Base->u_get('digi-key');

                                                        $post_data = json_encode([
                                                            'commands' => 'pln-subscribe',
                                                            'customer_no' => $data_post['user_id'],
                                                        ]);
                                        
                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                                        curl_setopt($ch, CURLOPT_POST, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                                        $result = curl_exec($ch);
                                                        $result = json_decode($result, true);
                                                        
                                                        if($result) {
                                                            if ($result['data']['name']) {
                                                                $username = $result['data']['name'];
                                                                $status = 'success';
                                                            } else {
                                                                $status = 'errors';
                                                            }
                                                        }
                                         }
                                         
                                         if ($games[0]['cek_id_provider'] === 'voca') {
                                                
                                                $result = $this->M_Voca->inquiry('POST', [
                                                                'productId' => $games[0]['check_code'],
                                                                'data' => [
                                                                    'userId' => $data_post['user_id'],
                                                                    'zoneId' => $data_post['zone_id'],
                                                                ],
                                                            ], 'inquiry', 'inquiry', [
                                                                'merchant' => $this->M_Base->u_get('voca_merchant'),
                                                                'secret' => $this->M_Base->u_get('voca_secret'),
                                                                'key' => $this->M_Base->u_get('voca_key'),
                                                            ]);
                                                            
                                                if($result) {
                                                    if ($result['message'] == 'Success' || $result['message'] == 'success') {
                                                        $username = $result['data']['ign'];
                                                        $status = $result['message'];
                                                    } else {
                                                        $status = 'errors';
                                                    }
                                                }

                                         }
                                         
                                         if ($games[0]['cek_id_provider'] === 'enivay') {
                                             $result = $this->M_Base->post('https://api.enivay.com/games/api/' . $games[0]['check_code'], [
                                                'token' => $this->M_Base->u_get('enivay-license'),
                                                'id' => $data_post['user_id'],
                                                'server' => $data_post['zone_id'],
                                            ]);
                                            
                                            if($result) {
                                                if ($result['status'] == true || $result['msg']['ok'] == true) {
                                                    $username = $result['msg']['name'];
                                                    $status = 'success';
                                                } else {
                                                    $status = 'errors';
                                                }
                                            }
                                         }

                                       
                                         
                                        if ($result) {
                                            // if ($result['ok'] == true) {
                                            
                                            if ($status == 'success') {
                                                $csrf_token = csrf_hash();

                                                echo json_encode([
                                                    'status' => true,
                                                    'msg' => '
                                                    <form action="" method="POST" id="form-order">
                                                        <input type="hidden" name="csrf_test_name" value="' . $csrf_token . '">
                                                        <input type="hidden" name="target" value="'.$data_post['target'].'">
                                                        <input type="hidden" name="username" value="'.$username.'">
                                                        <input type="hidden" name="method" value="'.$data_post['method'].'">
                                                        <input type="hidden" name="product" value="'.$data_post['product'].'">
                                                        <input type="hidden" name="wa" value="'.$data_post['wa'].'">
                                                        <input type="hidden" name="email" value="'.$data_post['email'].'">
                                                        <input type="hidden" name="voucher" value="'.$data_post['voucher'].'">
                                                         <input type="hidden" name="jumlah" value="'.$data_post['jumlah'].'">
                                                    </form>
                                                    <table class="w-100 mb-4">
                                                        <tr id="tr-nickname">
                                                            <td class="pb-2">Nickname</td>
                                                            <th class="text-end">'.$username.'</td>
                                                        </tr>
                                                        <tr id="tr-target">
                                                            <td class="pb-2">ID Player</td>
                                                            <th class="text-end">'.$target.'</td>
                                                        </tr>
                                                    </table>
                                                    <h2 class="fs-16">Detail Pembelian</h2>
                                                    <hr class="my-3">
                                                    <table class="w-100 mb-2">
                                                        <tr>
                                                            <td class="pb-2">Games</td>
                                                            <th class="text-end">'.$games[0]['games'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Item</td>
                                                            <th class="text-end">'.$product[0]['product'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">No. Whatsapp</td>
                                                            <th class="text-end">'.$data_post['wa'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Pembayaran</td>
                                                            <th class="text-end">'.$method[0]['method'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Harga</td>
                                                            <th class="text-end">Rp '.number_format($price,0,',','.').' <span style="text-decoration: line-through;">Rp '.number_format($product[0]['price_cut'],0,',','.').'</span></td>
                                                        </tr>
                                                         <tr>
                                                            <td class="pb-2">Jumlah</td>
                                                            <th class="text-end">'.$data_post['jumlah'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Biaya Admin</td>
                                                            <th class="text-end">Rp '.number_format($fee,0,',','.').'</td>
                                                        </tr>
                                                         <tr>
                                                            <td class="pb-2">Diskon Voucher</td>
                                                            <th class="text-end"><span class="text-success">Rp -'.number_format($diskon,0,',','.').'</span></td>
                                                        </tr>
                                                         <tr>
                                                            <td class="pb-2">Diskon Promo</td>
                                                            <th class="text-end"><span class="text-success">Rp -'.number_format($diskonvoucher,0,',','.').'</span></td>
                                                        </tr>
                                                        <tr>
                                                    <td class="pb-2">Total Bayar</td>
                                                    <th class="text-end"><b>Rp '.number_format($total,0,',','.').'</b></td>
                                                </tr>
                                                         <tr>
                                                            <td class="pb-2">Kamu Hemat Total</td>
                                                            <th class="text-end"><span class="text-success"><b>Rp -'.number_format($hemat,0,',','.').'</b></span></td>
                                                        </tr>
                                                    </table>
                                                    ',
                                                ]);
                                            } else {
                                                echo json_encode([
                                                    'status' => false,
                                                    'msg' =>  $target_alert[0]['error'],
                                                ]);
                                            }
                                        } else {
                                            echo json_encode([
                                                'status' => false,
                                                'msg' => $target_alert[0]['error']
                                            ]);
                                        }
                                    }
                                    
                                    if ($games[0]['cek_id_provider'] === 'omega') {

                                    
                                    if ($data_post['user_id'] && $data_post['zone_id']) {
                                        /*https://checkidgames.vercel.app/api/game/mobile-legends?id=47194237&zone=2079*/
                                        /*$content = @file_get_contents('http://omegatronik.co.id:3001/api/game/'.$games[0]['check_code'].'?id='.$data_post['user_id'].'&zone='.$data_post['zone_id'].'');*/
                                        $content = @file_get_contents('https://develo.belanjagame.com/api/game/'.$games[0]['check_code'].'?id='.$data_post['user_id'].'&zone='.$data_post['zone_id'].'');
                                    } else {
                                        $content = @file_get_contents('https://develo.belanjagame.com/api/game/'.$games[0]['check_code'].'?id='.$data_post['user_id'].'');
                                    }
                                    if ($content === false) {
                                        echo json_encode([
                                            'status' => false,
                                            'msg' => $target_alert[0]['error']
                                        ]);
                                    } else {
                                            $response = json_decode($content, true);
                                            if ($response['status'] == true) {
                                                $csrf_token = csrf_hash();

                                                echo json_encode([
                                                    'status' => true,
                                                    'msg' => '
                                                    <form action="" method="POST" id="form-order">
                                                        <input type="hidden" name="csrf_test_name" value="' . $csrf_token . '">
                                                        <input type="hidden" name="target" value="'.$data_post['target'].'">
                                                        <input type="hidden" name="username" value="'.$response['data']['username'].'">
                                                        <input type="hidden" name="method" value="'.$data_post['method'].'">
                                                        <input type="hidden" name="product" value="'.$data_post['product'].'">
                                                        <input type="hidden" name="wa" value="'.$data_post['wa'].'">
                                                         <input type="hidden" name="email" value="'.$data_post['email'].'">
                                                        <input type="hidden" name="voucher" value="'.$data_post['voucher'].'">
                                                        <input type="hidden" name="jumlah" value="'.$data_post['jumlah'].'">
                                                    </form>
                                                    <table class="w-100 mb-4">
                                                        <tr id="tr-nickname">
                                                            <td class="pb-2">Nickname</td>
                                                            <th class="text-end">'.$response['data']['username'].'</td>
                                                        </tr>
                                                        <tr id="tr-target">
                                                            <td class="pb-2">ID Player</td>
                                                            <th class="text-end">'.$target.'</td>
                                                        </tr>
                                                    </table>
                                                    <h2 class="fs-16">Detail Pembelian</h2>
                                                    <hr class="my-3">
                                                    <table class="w-100 mb-2">
                                                        <tr>
                                                            <td class="pb-2">Games</td>
                                                            <th class="text-end">'.$games[0]['games'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Item</td>
                                                            <th class="text-end">'.$product[0]['product'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">No. Whatsapp</td>
                                                            <th class="text-end">'.$data_post['wa'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Pembayaran</td>
                                                            <th class="text-end">'.$method[0]['method'].'</td>
                                                        </tr>
                                                         <tr>
                                                            <td class="pb-2">Harga</td>
                                                            <th class="text-end">Rp '.number_format($price,0,',','.').' <span style="text-decoration: line-through;">Rp '.number_format($product[0]['price_cut'],0,',','.').'</span></td>
                                                        </tr>
                                                         <tr>
                                                            <td class="pb-2">Jumlah</td>
                                                            <th class="text-end">'.$data_post['jumlah'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Biaya Admin</td>
                                                            <th class="text-end">Rp '.number_format($fee,0,',','.').'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb-2">Diskon Vocuher</td>
                                                            <th class="text-end"><span class="text-success">Rp -'.number_format($diskon,0,',','.').'</span></td>
                                                        </tr>
                                                         <tr>
                                                            <td class="pb-2">Diskon Promo</td>
                                                            <th class="text-end"><span class="text-success">Rp -'.number_format($diskonvoucher,0,',','.').'</span></td>
                                                        </tr>
                                                        <tr>
                                                    <td class="pb-2">Total Bayar</td>
                                                    <th class="text-end"><b>Rp '.number_format($total,0,',','.').'</b></td>
                                                </tr>
                                                         <tr>
                                                            <td class="pb-2">Kamu Hemat Total</td>
                                                            <th class="text-end"><span class="text-success"><b>Rp -'.number_format($hemat,0,',','.').'</b></span></td>
                                                        </tr>
                                                    </table>
                                                    ',
                                                ]);
                                            } else {
                                                echo json_encode([
                                                    'status' => false,
                                                    'msg' => $target_alert[0]['error'],
                                                ]);
                                            }
                                        }
                                    }
                                    
                                } else {
                                    $csrf_token = csrf_hash();
                                    echo json_encode([
                                        'status' => true,
                                        'msg' => '
                                            <form action="" method="POST" id="form-order">
                                                <input type="hidden" name="csrf_test_name" value="' . $csrf_token . '">
                                                <input type="hidden" name="target" value="'.$data_post['target'].'">
                                                <input type="hidden" name="username" value="-">
                                                <input type="hidden" name="method" value="'.$data_post['method'].'">
                                                <input type="hidden" name="product" value="'.$data_post['product'].'">
                                                <input type="hidden" name="wa" value="'.$data_post['wa'].'">
                                                 <input type="hidden" name="email" value="'.$data_post['email'].'">
                                                <input type="hidden" name="voucher" value="'.$data_post['voucher'].'">
                                                <input type="hidden" name="jumlah" value="'.$data_post['jumlah'].'">
                                            </form>
                                            <h2 class="fs-16">Detail Pembelian</h2>
                                            <hr class="my-3">
                                            <table class="w-100 mb-2">
                                                <tr>
                                                    <td class="pb-2">Games</td>
                                                    <th class="text-end">'.$games[0]['games'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-2">Item</td>
                                                    <th class="text-end">'.$product[0]['product'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-2">No. Whatsapp</td>
                                                    <th class="text-end">'.$data_post['wa'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-2">Pembayaran</td>
                                                    <th class="text-end">'.$method[0]['method'].'</td>
                                                </tr>
                                                 <tr>
                                                    <td class="pb-2">Harga</td>
                                                    <th class="text-end">Rp '.number_format($price,0,',','.').' <span style="text-decoration: line-through;">Rp '.number_format($product[0]['price_cut'],0,',','.').'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-2">Biaya Admin</td>
                                                    <th class="text-end">Rp '.number_format($fee,0,',','.').'</td>
                                                </tr>
                                                <tr>
                                                    <td class="pb-2">Diskon Vocuher</td>
                                                    <th class="text-end"><span class="text-success">Rp -'.number_format($diskon,0,',','.').'</span></td>
                                                </tr>
                                                   <tr>
                                                            <td class="pb-2">Diskon Promo</td>
                                                            <th class="text-end"><span class="text-success">Rp -'.number_format($diskonvoucher,0,',','.').'</span></td>
                                                        </tr>
                                                        <tr>
                                                    <td class="pb-2">Total Bayar</td>
                                                    <th class="text-end"><b>Rp '.number_format($total,0,',','.').'</b></td>
                                                </tr>
                                                         <tr>
                                                            <td class="pb-2">Kamu Hemat Total</td>
                                                            <th class="text-end"><span class="text-success"><b>Rp -'.number_format($hemat,0,',','.').'</b></span></td>
                                                        </tr>
                                            </table>
                                        ',
                                    ]);
                                }
                            } else {
                                echo json_encode([
                                    'status' => false,
                                    'msg' => $voucher_error,
                                ]);
                            }
                        } else {
                            echo json_encode([
                                'status' => false,
                                'msg' => 'Games tidak ditemukan',
                            ]);
                        }
                    } else {
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Metode pembayaran tidak ditemukan',
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Produk tidak ditemukan',
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Pembelian gagal dilakukan',
                ]);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public static function fetch($url, $data) {
    	$curl = curl_init();
    	curl_setopt_array($curl, [
    		CURLOPT_URL => $url . "?" . http_build_query($data),
    		CURLOPT_CUSTOMREQUEST => 'GET',
    		CURLOPT_RETURNTRANSFER => TRUE,
    		CURLOPT_FOLLOWLOCATION => TRUE
   		]); $response = curl_exec($curl);
   		curl_close($curl);
   		
   		return json_decode($response, true);
    }
}
