<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dolondro\GoogleAuthenticator\SecretFactory;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Home extends BaseController {

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

    public function indexs() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('daterange')) {
            $daterange = explode(' - ', $this->request->getPost('daterange'));

            $end_date = fix_date($daterange[0]);
            $start_date = fix_date($daterange[1]);

        } else {
            $end_date = date('Y-m-d H:i:s', time()-60*60*24*2);
            $start_date = date('Y-m-d H:i:s', time()-60*60*24*1);
        }

        $orders = $orders_today = 0;
        $modal = $modal_today = 0;
        $keuntungan = $orders - $modal;
        $chart = [];

        /*foreach ($this->M_Base->data_avg('orders', 'date_create', [$end_date, $start_date], true) as $date) {
            $orderDateTime = strtotime($date['date_create']);
            $hour = date('Y-m-d H:00:00', $orderDateTime);

            foreach ($this->M_Base->data_where('orders', 'date_create', $date['date_create']) as $loop) {
                if ($loop['status'] == 'Success') {
                    $orders += $loop['price'];
                    if ($modal+=($loop['price_modal'])) {
                        $keuntungan += $loop['price'] - $loop['price_modal'];
                    }
                }
            }

            if (!isset($chart[$hour])) {
                $chart[$hour] = [
                    'tanggal' => $hour,
                    'total' => 0
                ];
            }

            $chart[$hour]['total'] += $this->M_Base->data_count('orders', ['date_create' => $date['date_create'], 'status' => 'Success']);
        }*/

        $builder = $this->db->table('orders');
        $builder->select('*');
        $builder->where('date_create >=', date('Y-m-d 00:00:00'));
        $builder->where('date_create <=', date('Y-m-d 23:59:59'));
        $builder->where('status', 'Success');
        $data_transaction_today = $builder->get()->getResultArray();
        if($data_transaction_today){
            foreach($data_transaction_today as $loop){
                $orders_today += $loop['price'];
                $modal_today += $loop['price_modal'];
            }
        }

        $keuntungan_today = $orders_today - $modal_today;

        $builder = $this->db->table('orders_history');
        $builder->select('*');
        $builder->where('date_create >=', $end_date);
        $builder->where('date_create <=', $start_date);
        $builder->where('status', 'Success');
        $data_transaction = $builder->get()->getResultArray();
 
        if($data_transaction){
            foreach($data_transaction as $loop){
                $orders += $loop['price'];
                $modal += $loop['price_modal'];
            }
        }

        $keuntungan = $orders - $modal;

        $builder = $this->db->table('v_order_transaction');
        $builder->select('full_date, total');
        $builder->where('full_date >=', $end_date);
        $builder->where('full_date <=', $start_date);
        $builder->orderBy('full_date', 'ASC');
        $arr_total_transaction = $builder->get()->getResultArray();
        $chart = $arr_total_transaction;
        
        $getlimit = $this->db->table('utility');
        $getlimit->where('u_key', 'limit-populer');
        $value = $getlimit->get()->getRowArray();

        $builder = $this->db->table('jumlah_klik');
        $builder->orderBy('jumlah_klik', 'DESC');
        $builder->limit($value['u_value']);

        $builder = $this->db->table('jumlah_klik');
        $builder->select('*');
        $builder->join('games', 'games.id = jumlah_klik.id_games');
        $builder->orderBy('jumlah_klik.jumlah_klik', 'DESC');
        $builder->limit(10);
        $totalclick = $builder->get()->getResultArray();

        $ga = new SecretFactory;
        $issuer = $this->base_data['web']['name'];
        $accountName = $this->admin['username'];

        if($this->admin['secret_key']) {
            $secretkey = $this->admin['secret_key'];
            $secreturl = $this->admin['secret_url'];
        } else {
            $secret = $ga->create($issuer, $accountName);
            $secretkey = $secret->getSecretKey();
            $secreturl = $secret->getUri();

            $this->M_Base->data_update('admin', ['secret_key' => $secretkey, 'secret_url'  => $secreturl], $this->admin['id']);
        }

        $qrCodeUrl = 'https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl='.$secreturl;

    	$data = array_merge($this->base_data, [
    		'title' => 'Administrator',
            'total' => [
                'admin' => $this->M_Base->data_count('admin'),
                'games' => $this->M_Base->data_count('games'),
                'product' => $this->M_Base->data_count('product'),
                'orders' => $orders,
                'orders_today' => $orders_today,
                'keuntungan' => $keuntungan,
                'keuntungan_today' => $keuntungan_today,
            ],
            'chart' => $chart,
            'menu_admin' => 'Dashboard',
            'date_range' => reverse_date($end_date,$start_date),
            'total_click' => $totalclick,
            'qr' => $qrCodeUrl
    	]);
        

        return view('Admin/Home/index', $data);
    }

    public function password() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'passwordl' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordl')))),
                'passwordb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordb')))),
                'passwordbb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordbb')))),
                'g-recaptcha-response' => addslashes(trim(htmlspecialchars($this->request->getPost('g-recaptcha-response')))),
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
            } else if (!password_verify($data_post['passwordl'], $this->admin['password'])) {
                $this->session->setFlashdata('error', 'Password lama tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['passwordb']) < 6) {
                $this->session->setFlashdata('error', 'Password baru minimal 6 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['passwordb']) > 24) {
                $this->session->setFlashdata('error', 'Password baru maksimal 24 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($data_post['passwordb'] !== $data_post['passwordbb']) {
                $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['g-recaptcha-response'])) {
                $this->session->setFlashdata('error', 'Please verify captcha');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($this->request->getPost('googleauth'))) {
                $this->session->setFlashdata('error', 'Masukan Google Auth');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                 
                $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                $secret_key = $admin[0]['secret_key'];

                $googleAuth = new GoogleAuthenticator();
                $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));

                if ($checkResult == true) {
                    $this->M_Base->data_update('admin', [
                        'password' => password_hash($data_post['passwordb'], PASSWORD_DEFAULT),
                    ], $this->admin['id']);

                    $this->session->setFlashdata('success', 'Password berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Ganti Password',
        ]);

        return view('Admin/Home/password', $data);
    }

    public function login() {

        if ($this->admin !== false) {
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
                'g-recaptcha-response' => addslashes(trim(htmlspecialchars($this->request->getPost('g-recaptcha-response')))),
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['g-recaptcha-response'])) {
                $this->session->setFlashdata('error', 'Please verify captcha');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            /*} else if (empty($this->request->getPost('googleauth'))) {
                $this->session->setFlashdata('error', 'Masukan Google Auth');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));*/
            } else {
                $admin = $this->M_Base->data_where('admin', 'username', $data_post['username']);

                $secret_key = $admin[0]['secret_key'];  

                $googleAuth = new GoogleAuthenticator();
                $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
                $checkResult = true;

                if ($checkResult == true) {
                    if (count($admin) === 1) {
                        // if(in_array($this->get_client_ip(), explode(',', $this->M_Base->u_get('ip')))) {
                            if (password_verify($data_post['password'], $admin[0]['password'])) {
                                if ($admin[0]['status'] === 'On') {
                                    $this->session->set('admin', $admin[0]['username']);
        
                                    $user_ip = $this->get_client_ip();
        
                                    $this->M_Base->data_insert('ip', [
                                        'user_id' => $admin[0]['id'],
                                        'ip' => $user_ip,
                                    ]);
        
                                    $this->session->setFlashdata('success', 'Login berhasil');
                                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1');
                                } else {
                                    $this->session->setFlashdata('error', 'Akun kamu telah dinonaktifkan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Username atau password salah');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        // } else {
                        //     $this->session->setFlashdata('error', 'IP Berbeda dengan yang di daftarkan you ip : '.$this->get_client_ip());
                        //     return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        // }
                    } else {
                        $this->session->setFlashdata('error', 'Username atau password salah');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Login',
    	]);

        return view('Admin/Home/login', $data);
    }

    public function ip() {

        $get_ip = $this->M_Base->all_data_order('ip', 'datetime');

        $data = array_merge($this->base_data, [
    		'title' => 'Administrator',
            'ip' => $get_ip
    	]);

        return view('Admin/ip/index', $data);
    }
}
