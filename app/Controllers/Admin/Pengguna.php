<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Pengguna extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            $this->M_Base->u_update('harga_silver', $this->request->getPost('harga_silver'));
            $this->M_Base->u_update('harga_gold', $this->request->getPost('harga_gold'));
            $this->M_Base->u_update('harga_bisnis', $this->request->getPost('harga_bisnis'));
            
            $this->session->setFlashdata('success', 'Data konfigurasi berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

        $data = array_merge($this->base_data, [
            'title' => 'Pengguna',
            'account' => $this->M_Base->all_data('users'),
        ]);

        return view('Admin/Pengguna/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'username' => addslashes(trim(htmlentities($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlentities($this->request->getPost('password')))),
                'balance' => addslashes(trim(htmlentities($this->request->getPost('balance')))),
                'wa' => addslashes(trim(htmlentities($this->request->getPost('wa')))),
                'regist_pay' => 'By Admin',
                'level' => addslashes(trim(htmlentities($this->request->getPost('level')))),
                'upgrade_membership' => 'Not Upgrade',
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
            } else if (empty($this->request->getPost('googleauth'))) {
                $this->session->setFlashdata('error', 'Masukan Google Auth');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {

                $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                $secret_key = $admin[0]['secret_key'];

                $googleAuth = new GoogleAuthenticator();
                $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));

                if ($checkResult == true) {

                    $find_user = $this->M_Base->data_where('users', 'username', $data_post['username']);

                    if (count($find_user) === 0) {
                        $this->M_Base->data_insert('users', array_merge($data_post, [
                            'password' => password_hash($data_post['password'], PASSWORD_DEFAULT),
                            'status' => 'On',
                            'date_create' => date('Y-m-d G:i:s'),
                        ]));

                        $this->session->setFlashdata('success', 'Pengguna berhasil ditambahkan <br> Username : ' . $data_post['username'] . '<br>Password : ' . $data_post['password'] . '<br>Saldo : ' . number_format($data_post['balance'],0,',','.'));
                        return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pengguna');
                    } else {
                        $this->session->setFlashdata('error', 'Username sudah digunakan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }
        $arr_level = $this->M_Base->all_data('level');
        $data = array_merge($this->base_data, [
            'title' => 'Tambah Pengguna',
            'arr_level' => $arr_level
        ]);

        return view('Admin/Pengguna/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'balance' => addslashes(trim(htmlspecialchars($this->request->getPost('balance')))),
                        'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                        'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                        'confirm' => addslashes(trim(htmlspecialchars($this->request->getPost('confirm')))),
                        'level' => addslashes(trim(htmlentities($this->request->getPost('level')))),
                    ];

                    if (empty($data_post['status']) OR empty($data_post['wa'])) {
                        $this->session->setFlashdata('error', 'Nomor wa tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (strlen($data_post['wa']) < 10 OR strlen($data_post['wa']) > 14) {
                        $this->session->setFlashdata('error', 'Nomor wa tidak sesuai');
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
                            $this->M_Base->data_update('users', $data_post, $id);

                            $this->session->setFlashdata('success', 'Data pengguna berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }

                $arr_level = $this->M_Base->all_data('level');
                $data = array_merge($this->base_data, [
                    'title' => 'Edit Pengguna',
                    'account' => $account[0],
                    'arr_level' => $arr_level
                ]);

                return view('Admin/Pengguna/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    
    public function send_balance($id = null) {
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }else{
            $user_recipient = $users = array();
            if ($this->request->getPost()) {
                $username_recipient = addslashes(trim(htmlspecialchars($this->request->getPost('username'))));
                $amount = addslashes(trim(htmlspecialchars($this->request->getPost('amount'))));
                $recipient = $this->M_Base->data_where('users', 'username', $username_recipient);
                $data_post = [
                    'trx_id' => 'trx_'.date('YmdHis'),
                    'id_sender' => 0,
                    'username_sender' => 'Admin Belanja Game',
                    'wa_sender' => '081224148025',
                    'id_recipient' => $recipient[0]['id'],
                    'username_recipient' => $recipient[0]['username'],
                    'wa_recipient' => $recipient[0]['wa'],
                    'amount' => $amount,
                    'status' => 'pending'
                ];
                $amount = (int) $amount;
                $save_data_transaction = $this->M_Base->data_insert('transfer_balance', $data_post);

                if($save_data_transaction){
                    $update_data_recipient = $this->M_Base->data_update('users', [
                            'balance' => $recipient[0]['balance'] + $amount,
                    ], $recipient[0]['id']);

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

                    if($status = "success"){
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
                        $this->session->setFlashdata('success', 'Saldo Akun telah terkirim.');
                        return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pengguna');
                    }else{
                        $this->session->setFlashdata('error', 'Saldo Akun gagal dikirim. Silahkan ulangi lagi!');
                        return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pengguna');
                    }
                }
            }else{

                if($id){
                    $account = $this->M_Base->data_where('users', 'id', $id);
                    $arr_level = $this->M_Base->all_data('level');
                    $data = array_merge($this->base_data, [
                        'title' => 'Kirim Saldo Akun',
                        'account' => $account[0],
                        'arr_level' => $arr_level
                    ]);
                }else{
                    $arr_level = $this->M_Base->all_data('level');
                    $data = array_merge($this->base_data, [
                        'title' => 'Kirim Saldo Akun',
                        'arr_level' => $arr_level,
                        'users' => $this->M_Base->all_data_order_asc('users','username')
                    ]);
                }

                return view('Admin/Pengguna/send_balance', $data);
            }
                
        }
    }

    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {
                $this->M_Base->data_delete('users', $id);

                $this->session->setFlashdata('success', 'Data pengguna berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pengguna');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function reset_password($id) {
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                       'googleauth' => $this->request->getPost('googleauth'),
                    ];

                    if (empty($this->request->getPost('googleauth'))) {
                        $this->session->setFlashdata('error', 'Masukan Google Auth');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {

                        $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                        $secret_key = $admin[0]['secret_key'];
        
                        $googleAuth = new GoogleAuthenticator();
                        $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
        
                        if ($checkResult == true) {
                            $password = $this->M_Base->random_string(6);

                            $this->M_Base->data_update('users', [
                                'password' => password_hash($password, PASSWORD_DEFAULT),
                            ], $id);
            
                            $this->session->setFlashdata('success', 'Password pengguna berhasil direset : ' . $password);
                            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pengguna/reset-sandi/' . $id);
                        } else {
                            $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Reset Password',
                ]);
        
                return view('Admin/Pengguna/resetpassword', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function reset($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {

                $password = $this->M_Base->random_string(6);

                $this->M_Base->data_update('users', [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ], $id);

                $this->session->setFlashdata('success', 'Password pengguna berhasil direset : ' . $password);
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pengguna/edit/' . $id);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    
    public function upgrade_membership($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $this->M_Base->data_update('users', [
                    'upgrade_membership' => 'Approved',
                    'level' => 'Gold',
                ], $id);
            
            $this->session->setFlashdata('success', 'Upgrade member berhasil');
            return redirect()->to(base_url().'/-9J6DWAuK/]:C2Tx1/pengguna');
        }
    }
}