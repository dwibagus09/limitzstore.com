<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Voucher extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Voucher',
            'voucher' => $this->M_Base->all_data('voucher'),
    	]);

        return view('Admin/Voucher/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'voucher' => addslashes(trim(htmlspecialchars($this->request->getPost('voucher')))),
                'diskon_type' => addslashes(trim(htmlspecialchars($this->request->getPost('diskon_type')))),
                'diskon' => addslashes(trim(htmlspecialchars($this->request->getPost('diskon')))),
                'min' => addslashes(trim(htmlspecialchars($this->request->getPost('min')))),
                'max' => addslashes(trim(htmlspecialchars($this->request->getPost('max')))),
                'title' => addslashes(trim(htmlspecialchars($this->request->getPost('title')))),
                'content' => addslashes(trim(htmlspecialchars($this->request->getPost('content')))),
                'stok' => addslashes(trim(htmlspecialchars($this->request->getPost('stok')))),
                'private' => addslashes(trim(htmlspecialchars($this->request->getPost('private')))),
            ];

            if (empty($data_post['voucher'])) {
                $this->session->setFlashdata('error', 'Kode voucher ada data yang kosong');
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
                    $level = '';
                    if ($this->request->getPost('level')) {
                        
                        if (is_array($this->request->getPost('level'))) {
                            
                            $level = implode(',', $this->request->getPost('level'));
                            
                        }
                    }
                    
                    if (empty($level)) {
                        $this->session->setFlashdata('error', 'Silahkan pilih pengguna');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                    
                    $insert = $this->M_Base->data_insert('voucher', array_merge($data_post, [
                        'level' => $level,
                    ]));
                    
                    
                    $this->session->setFlashdata('success', 'Voucher berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    
                } else {
                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Voucher',
        ]);

        return view('Admin/Voucher/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {

            $voucher = $this->M_Base->data_where('voucher', 'id', $id);

            if (count($voucher) === 1) {
                
                if ($this->request->getPost('tombol')) {
            
                    $data_post = [
                        'voucher' => addslashes(trim(htmlspecialchars($this->request->getPost('voucher')))),
                        'diskon_type' => addslashes(trim(htmlspecialchars($this->request->getPost('diskon_type')))),
                        'diskon' => addslashes(trim(htmlspecialchars($this->request->getPost('diskon')))),
                        'min' => addslashes(trim(htmlspecialchars($this->request->getPost('min')))),
                        'max' => addslashes(trim(htmlspecialchars($this->request->getPost('max')))),
                        'title' => addslashes(trim(htmlspecialchars($this->request->getPost('title')))),
                        'content' => addslashes(trim(htmlspecialchars($this->request->getPost('content')))),
                        'stok' => addslashes(trim(htmlspecialchars($this->request->getPost('stok')))),
                        'private' => addslashes(trim(htmlspecialchars($this->request->getPost('private')))),
                    ];
        
                    if (empty($data_post['voucher'])) {
                        $this->session->setFlashdata('error', 'Kode voucher ada data yang kosong');
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
                            $level = '';
                            if ($this->request->getPost('level')) {
                                
                                if (is_array($this->request->getPost('level'))) {
                                    
                                    $level = implode(',', $this->request->getPost('level'));
                                    
                                }
                            }
                            
                            if (empty($level)) {
                                $this->session->setFlashdata('error', 'Silahkan pilih pengguna');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                            
                            $this->M_Base->data_update('voucher', array_merge($data_post, [
                                'level' => $level,
                            ]), $id);
                            
                            $this->session->setFlashdata('success', 'Voucher berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Voucher',
                    'voucher' => $voucher[0],
                ]);

                return view('Admin/Voucher/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
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

            $voucher = $this->M_Base->data_where('voucher', 'id', $id);

            if (count($voucher) === 1) {
                
                $this->M_Base->data_delete('voucher', $id);
                
                $this->session->setFlashdata('success', 'Kode voucher berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/voucher');
                
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

    }
}