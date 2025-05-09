<?php

namespace App\Controllers;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Pages extends BaseController {

    //tambahan bagus
    public function check_region() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Check Region',
    		'region' => $this->M_Base->all_data('region'),
    	]);

        return view('Pages/cr', $data);
    }

    
    public function read_popup() {
        
        $this->session->set('read_popup', true);
    }
    
    public function daftar_harga($action = null) {

        if ($action == null) {
            
            $data = array_merge($this->base_data, [
        		'title' => 'Daftar Harga',
        		'menu_active' => 'Daftar Harga',
        		'games' => $this->M_Base->data_where('games', 'status', 'On'),
        	]);
    
            return view('Pages/daftar_harga', $data);
            
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
    
     public function top() {
        
        $top = [];
        
        foreach ($this->M_Base->data_where_array('top', [
		    'periode >=' => date('Y-m'),
            'periode <=' => $this->M_Base->u_get('end-top'),
		], 'nominal', 10) as $loop) {
		    
		    $data_games = $this->M_Base->data_where('games', 'id', $loop['games_id']);
		    
		    $games = count($data_games) == 1 ? $data_games[0]['games'] : '-';
		    
		    $top[] = array_merge($loop, [
		        'games' => $games,
		    ]);
		}

        $db = \Config\Database::connect();
        $builder = $db->table('config');
        $builder->where('nama', 'leaderboard');
        $get = $builder->get()->getRowArray();


    	$data = array_merge($this->base_data, [
    		'title' => 'Top Global Sultan',
    		'top' => $top,
            'config' => $get
    	]);

        return view('Pages/top', $data);
    }
    
    public function wr() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Kalkulator WR',
    	]);

        return view('Pages/wr', $data);
    }
    
    public function hp() {

    	$data = array_merge($this->base_data, [
    		'title' => 'HP Magic Wheel',
    	]);

        return view('Pages/hp', $data);
    }
    
    public function zodiac() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Zodiac',
    	]);

        return view('Pages/zodiac', $data);
    }
    
    public function sk() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Syarat & Ketentuan',
            'page_sk' => $this->M_Base->u_get('page_sk'),
    	]);

        return view('Pages/sk', $data);
    }

    public function price() {

        $product = [];
        foreach (array_reverse($this->M_Base->all_data_order('games', 'sort')) as $game) {
            $data_product = $this->M_Base->data_where_array('product', [
                'games_id' => $game['id']
            ], 'price');

            if (count($data_product) !== 0) {
                $product[] = [
                    'games' => $game['games'],
                    'image' => $game['image'],
                    'product' => array_reverse($data_product),
                ];
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Harga',
            'price' => $product,
            'menu_active' => 'Price',
    	]);

        return view('Pages/price', $data);
    }

    public function method() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Metode',
            'method' => $this->M_Base->all_data('method'),
            'menu_active' => 'Method',
    	]);

        return view('Pages/method', $data);
    }

    public function login() {

        if ($this->users !== false) {
            return redirect()->to(base_url());
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
                'g-recaptcha-response' => addslashes(trim(htmlspecialchars($this->request->getPost('g-recaptcha-response'))))
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } 
            /*else if (empty($data_post['g-recaptcha-response'])) {
                $this->session->setFlashdata('error', 'Please verify captcha');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } 
            */else {
                $users = $this->M_Base->data_where('users', 'username', $data_post['username']);

                if (count($users) === 1) {
                    if ($users[0]['username'] === $data_post['username']) {
                        if ($users[0]['status'] === 'On') {
                            if ($users[0]['verif'] === 'Y') {
                                if (password_verify($data_post['password'], $users[0]['password'])) {
                                    
                                    $this->session->set('verif-login', $data_post['username']);

                                        $otp = rand(111111,999999);
                        
                                        $this->M_Base->data_insert('otp', [
                                            'username' => $users[0]['username'],
                                            'otp' => $otp,
                                            'type' => 'Verif Login',
                                            'date_create' => date('Y-m-d G:i:s'),
                                        ]);
                                        
                                        $this->M_Wa->send([
                                            'token' => $this->M_Base->u_get('wa_fonnte'),
                                            'target' => $users[0]['wa'],
                                            'message' => str_replace([
                                                '#username#',
                                                '#wa#',
                                                '#otp#',
                                            ], [
                                                $users[0]['username'],
                                                $users[0]['wa'],
                                                $otp,
                                            ], $this->M_Base->u_get('wa_verif')),
                                        ]);

                                    $this->session->setFlashdata('success', 'Verifikasi Login');
                                    return redirect()->to(base_url() . '/verif-login');
                                } else {
                                    $this->session->setFlashdata('error', 'Username atau password salah');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Akun kamu belum terverifikasi');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Akun kamu telah dinonaktifkan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Username atau password salah');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Username atau password salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Login',
            'menu_active' => 'Login',
    	]);

        return view('Pages/login', $data);
    }

    public function logout() {

        $this->session->remove('username');

        $this->session->setFlashdata('success', 'Logout berhasil');
        return redirect()->to(base_url());
    }
    
    public function register(){
        
        if ($this->users !== false) {
            return redirect()->to(base_url());
        } else {
            
            if ($this->request->getPost('tombol')) {
            
                $data_post = [
                    'username' => addslashes(trim(htmlentities($this->request->getPost('username')))),
                    'password' => addslashes(trim(htmlentities($this->request->getPost('password')))),
                    'wa_phoneCode' => addslashes(trim(htmlentities($this->request->getPost('wa_phoneCode')))),
                    'wa' => addslashes(trim(htmlentities($this->request->getPost('wa')))),
                    'level' => 'Member',
                    'g-recaptcha-response' => addslashes(trim(htmlspecialchars($this->request->getPost('g-recaptcha-response'))))
                ];
    
                if (empty($data_post['username'])) {
                    $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (empty($data_post['password'])) {
                    $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (empty($data_post['wa'])) {
                    $this->session->setFlashdata('error', 'Whatsapp tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (!is_numeric($data_post['wa']) OR strlen($data_post['wa']) >= 15 OR strlen($data_post['wa']) <= 10) {
                    $this->session->setFlashdata('error', 'Whatsapp tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['username']) < 6) {
                    $this->session->setFlashdata('error', 'Username minimal 6 karakter');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['username']) > 24) {
                    $this->session->setFlashdata('error', 'Username maksimal 24 karakter');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['password']) < 6) {
                    $this->session->setFlashdata('error', 'Password minimal 6 karakter');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (strlen($data_post['password']) > 24) {
                    $this->session->setFlashdata('error', 'Password maksimal 24 karakter');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (empty($data_post['g-recaptcha-response'])) {
                    $this->session->setFlashdata('error', 'Please verify captcha');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
    
                    $find_user = $this->M_Base->data_where('users', 'username', $data_post['username']);
    
                    if (count($find_user) === 0) {
                        
                        $whatsapp = $data_post['wa_phoneCode'].ltrim($data_post['wa'], '0');
                        
                        $this->M_Base->data_insert('users', [
                            'username' => $data_post['username'],
                            'password' => password_hash($data_post['password'], PASSWORD_DEFAULT),
                            'balance' => 0,
                            'wa' => $whatsapp,
                            'status' => 'On',
                            'confirm' => 'Y',
                            'regist_pay' => 'By Form Register',
                            'level' => 'Member',
                            'verif' => 'N',
                            'date_create' => date('Y-m-d G:i:s'),
                            'upgrade_membership' => 'Not Upgrade',
                        ]);
                        
                        $otp = rand(111111,999999);
                        
                        $this->M_Base->data_insert('otp', [
                            'username' => $data_post['username'],
                            'otp' => $otp,
                            'type' => 'Verif',
                            'date_create' => date('Y-m-d G:i:s'),
                        ]);
                        
                        $this->M_Wa->send([
                            'token' => $this->M_Base->u_get('wa_fonnte'),
                            'target' => $whatsapp,
                            'message' => str_replace([
                                '#username#',
                                '#wa#',
                                '#otp#',
                            ], [
                                $data_post['username'],
                                $whatsapp,
                                $otp,
                            ], $this->M_Base->u_get('wa_verif')),
                        ]);
                        
                        $this->session->set('verif', $data_post['username']);
                        
                        $this->session->setFlashdata('success', 'Registrasi akun telah berhasil, silahkan verifikasi akun, kode OTP telah kami kirimkan');
                        return redirect()->to(base_url() . '/verif');
                        
                    } else {
                        $this->session->setFlashdata('error', 'Username sudah digunakan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Registrasi Akun',
        	]);
    
            return view('Pages/register', $data);
        }
    }

    public function veriflogin() {
        if ($this->users !== false) {
            return redirect()->to(base_url());
        } else if ($this->session->get('verif-login')) {
            
            $user_verif = $this->session->get('verif-login');
            
            if (!empty($user_verif)) {
                $users = $this->M_Base->data_where_array('users', [
                    'username' => $user_verif,
                    'verif' => 'Y',
                ]);
                if (count($users) == 1) {
                    
                    if ($this->request->getPost('tombol')) {
                        
                        $data_post = [
                            'kode' => addslashes(trim(htmlspecialchars($this->request->getPost('kode')))),
                        ];

                        if (empty($data_post['kode'])) {
                            $this->session->setFlashdata('error', 'Kode tidak boleh kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                                $otp = $this->M_Base->data_where_array('otp', [
                                    'username' => $users[0]['username'],
                                    'otp' => $data_post['kode'],
                                ]);

                                if (count($otp) == 1) {
                                
                                    $this->session->remove('verif-login');
                                    $this->M_Base->data_delete('otp', $otp[0]['id']);
                                    
                                    $this->session->set('username', $users[0]['username']);
    
                                    $this->session->setFlashdata('success', 'Login berhasil');
                                    return redirect()->to(base_url() . '/user');
                                } else {
                                    $this->session->setFlashdata('error', 'Kode OTP salah');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                        }
                    }

                    $data = array_merge($this->base_data, [
                		'title' => 'Verifikasi Login',
                	]);
            
                    return view('Pages/veriflogin', $data);

                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function verif() {
        
        if ($this->users !== false) {
            return redirect()->to(base_url());
        } else if ($this->session->get('verif')) {
            
            $user_verif = $this->session->get('verif');
            
            if (!empty($user_verif)) {
                
                $users = $this->M_Base->data_where_array('users', [
                    'username' => $user_verif,
                    'verif' => 'N',
                ]);
                
                if (count($users) == 1) {
                    
                    if ($this->request->getPost('tombol')) {
                        
                        $data_post = [
                            'otp' => addslashes(trim(htmlspecialchars($this->request->getPost('otp')))),
                        ];
                        
                        if (empty($data_post['otp'])) {
                            $this->session->setFlashdata('error', 'Kode OTP tidak boleh kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (!is_numeric($data_post['otp'])) {
                            $this->session->setFlashdata('error', 'Kode OTP tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            
                            $otp = $this->M_Base->data_where_array('otp', [
                                'username' => $users[0]['username'],
                                'otp' => $data_post['otp'],
                            ]);
                            
                            if (count($otp) == 1) {
                                
                                $this->session->remove('verif');
                                
                                $this->M_Base->data_update('users', [
                                    'verif' => 'Y',
                                ], $users[0]['id']);
                                
                                $this->M_Base->data_delete('otp', $otp[0]['id']);
                                
                                $this->M_Wa->send([
                                    'token' => $this->M_Base->u_get('wa_fonnte'),
                                    'target' => $users[0]['wa'],
                                    'message' => str_replace([
                                        '#username#',
                                        '#wa#',
                                    ], [
                                        $users[0]['username'],
                                        $users[0]['wa'],
                                    ], $this->M_Base->u_get('wa_welcome')),
                                ]);
                                
                                $this->session->setFlashdata('success', 'Verifikasi akun telah berhasil, silahkan Scan qr di Google Authenticator dan login kembali');
                                return redirect()->to(base_url() . '/login');
                                
                            } else {
                                $this->session->setFlashdata('error', 'Kode OTP salah');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        }
                    }
                    
                    $data = array_merge($this->base_data, [
                		'title' => 'Verifikasi Akun',
                	]);
            
                    return view('Pages/verif', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function forgot() {
        
        if ($this->users !== false) {
            return redirect()->to(base_url());
        } else {
            
            $data = array_merge($this->base_data, [
        		'title' => 'Lupa password',
        	]);
    
            return view('Pages/forgot', $data);
        }
    }

    public function verif_reset() {
        if ($this->users !== false) {
            return redirect()->to(base_url());
        } else if ($this->session->get('verif-reset')) {
            
            $user_verif = $this->session->get('verif-reset');
            
            if (!empty($user_verif)) {
                $users = $this->M_Base->data_where_array('users', [
                    'username' => $user_verif,
                    'verif' => 'Y',
                ]);
                if (count($users) == 1) {
                    
                    if ($this->request->getPost('tombol')) {
                        
                        $data_post = [
                            'kode' => addslashes(trim(htmlspecialchars($this->request->getPost('kode')))),
                        ];

                        if (empty($data_post['kode'])) {
                            $this->session->setFlashdata('error', 'Kode tidak boleh kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            if ($users[0]['level'] == 'Member') {
                                $otp = $this->M_Base->data_where_array('otp', [
                                    'username' => $users[0]['username'],
                                    'otp' => $data_post['kode'],
                                ]);

                                if (count($otp) == 1) {
                                
                                    $this->session->remove('verif-reset');
                                    $password = $this->M_Base->random_string(8);
                            
                                    $this->M_Base->data_update('users', [
                                        'password' => password_hash($password, PASSWORD_DEFAULT),
                                    ], $users[0]['id']);
                                    
                                    $this->M_Wa->send([
                                        'token' => $this->M_Base->u_get('wa_fonnte'),
                                        'target' => $users[0]['wa'],
                                        'message' => str_replace([
                                            '#username#',
                                            '#wa#',
                                            '#password#',
                                        ], [
                                            $users[0]['username'],
                                            $users[0]['wa'],
                                            $password
                                        ], $this->M_Base->u_get('wa_reset')),
                                    ]);
                                    
                                    $this->session->setFlashdata('success', 'Reset password berhasil, password akun kamu telah kami kirim melalui Whatsapp');
                                    return redirect()->to(base_url() . '/login');
                                } else {
                                    $this->session->setFlashdata('error', 'Kode OTP salah');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $secret_key = $users[0]['secret_key'];

                                $googleAuth = new GoogleAuthenticator();
                                $checkResult = $googleAuth->authenticate($secret_key, $data_post['kode']);

                                if ($checkResult == true) {
                                    $this->session->remove('verif-reset');
                                    $password = $this->M_Base->random_string(8);
                            
                                    $this->M_Base->data_update('users', [
                                        'password' => password_hash($password, PASSWORD_DEFAULT),
                                    ], $users[0]['id']);
                                    
                                    $this->M_Wa->send([
                                        'token' => $this->M_Base->u_get('wa_fonnte'),
                                        'target' => $users[0]['wa'],
                                        'message' => str_replace([
                                            '#username#',
                                            '#wa#',
                                            '#password#',
                                        ], [
                                            $users[0]['username'],
                                            $users[0]['wa'],
                                            $password
                                        ], $this->M_Base->u_get('wa_reset')),
                                    ]);
                                    
                                    $this->session->setFlashdata('success', 'Reset password berhasil, password akun kamu telah kami kirim melalui Whatsapp');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                } else {
                                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            }
                        }
                    }

                    $data = array_merge($this->base_data, [
                		'title' => 'Verifikasi Login',
                	]);
            
                    return view('Pages/veriflogin', $data);

                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function reset() {
        
        if ($this->users !== false) {
            return redirect()->to(base_url());
        } else {
            
            if ($this->request->getPost('tombol')) {
                
                $data_post = [
                    'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                    'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                ];
                
                if (empty($data_post['username'])) {
                    $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else if (empty($data_post['wa'])) {
                    $this->session->setFlashdata('error', 'No. Whatsapp tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    
                    $users = $this->M_Base->data_where_array('users', $data_post);
                 
                    if (count($users) == 1) {
                        
                        if ($users[0]['status'] == 'On') {

                            $this->session->set('verif-reset', $users[0]['username']);
                            
                                $otp = rand(111111,999999);
                
                                $this->M_Base->data_insert('otp', [
                                    'username' => $users[0]['username'],
                                    'otp' => $otp,
                                    'type' => 'Verif Reset',
                                    'date_create' => date('Y-m-d G:i:s'),
                                ]);
                                
                                $this->M_Wa->send([
                                    'token' => $this->M_Base->u_get('wa_fonnte'),
                                    'target' => $users[0]['wa'],
                                    'message' => str_replace([
                                        '#username#',
                                        '#wa#',
                                        '#otp#',
                                    ], [
                                        $users[0]['username'],
                                        $users[0]['wa'],
                                        $otp,
                                    ], $this->M_Base->u_get('wa_verif')),
                                ]);
                           

                            $this->session->setFlashdata('success', 'Silakan Verifikasi Akun Anda');
                            return redirect()->to(base_url() . '/verif-reset');

                        } else {
                            $this->session->setFlashdata('error', 'Akun kamu telah tersuspend');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Akun tidak terdaftar');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Reset password',
        	]);
    
            return view('Pages/reset', $data);
        }
    }
    
    public function review() {
        
        $review = [];
        
        foreach ($this->M_Base->all_data('orders_review') as $loop) {
            
            $data_orders = $this->M_Base->data_where('orders', 'order_id', $loop['order_id']);
            
            if (count($data_orders) == 1) {
                $wa = $data_orders[0]['wa'];
                $product = $data_orders[0]['product'];
            } else {
                $wa = '';
                $product = '';
            }
            
            $review[] = array_merge($loop, [
                'wa' => $wa,
                'product' => $product,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Penilaian',
    		'review' => $review,
    	]);

        return view('Pages/review', $data);
    }
    
    public function api($version=NULL) {
        $data = array_merge($this->base_data, [
            'title' => 'API '.$version.' - Documentation',
        ]);
        
        if($version){
            $template_view = 'Template/api_'.$version;
            return view($template_view, $data);
        }else{
            return view('Template/api', $data);
        }
        
    }
    
     public function api_v2() {
        $data = array_merge($this->base_data, [
            'title' => 'Api V2 - Documentasi',
        ]);
        
        return view('Template/api_v2', $data);
    }
    
     public function otomax() {
        $data = array_merge($this->base_data, [
            'title' => 'Api Otomax - Documentasi',
        ]);
        
        return view('Template/otomax', $data);
    }
    
    
    public function daftar_slug($action=NULL) {

        if ($action == NULL) {
            
            $data = array_merge($this->base_data, [
                'title' => 'Daftar Kode Validasi untuk Provider Kode Validasi Private',
            ]);
        
            return view('Pages/daftar_slug', $data);
            
        } else if ($action === 'ajax') {
            
            $query = $this->M_Base->all_data_order_asc('slug_games_info', 'games');
            $services = [];
            if($query){
                foreach($query as $loop){
                    $zone_name = $zone_id = NULL;
                    if($loop['is_zone'] == true){
                        $zone_id = $loop['zone_id']; 
                        $zone_name = $loop['zone_name'];
                    }
                    $services[] = [
                        $loop['provider'],
                        $loop['games'],
                        $loop['slug'],
                        $zone_id,
                        $zone_name
                    ];
                }
            }

            echo json_encode([
                'data' => $services,
            ]);
            
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}