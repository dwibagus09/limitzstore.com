<?php

namespace App\Controllers\Admin;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Produk extends BaseController {

    public function index() {
        
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getGet('games_id')) {
            
            if (is_numeric($this->request->getGet('games_id'))) {
                
                setcookie('games_id', $this->request->getGet('games_id'), time()+60*60*24*30, '/-9J6DWAuK/]:C2Tx1/produk');
                
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk');
                
            } else {
                setcookie('games_id', '', time()-1, '/-9J6DWAuK/]:C2Tx1/produk');
            }
        }
        
        $games_id = '';
        
        if (isset($_COOKIE['games_id'])) {
            
            $games_id = $_COOKIE['games_id'];
        }
        
        if (!empty($games_id)) {
            $query = $this->M_Base->data_where_array('product', [
                'games_id' => $games_id,
            ], 'sort');
        } else {
            $query = $this->M_Base->data_where_array('product', [
                'games_id' => '96',
            ], 'sort');
        }
        
        $product = [];
        foreach (array_reverse($query) as $loop) {
            $games = $this->M_Base->data_where('games', 'id', $loop['games_id']);

            $nama_games = count($games) == 1 ? $games[0]['games'] : '-';
            
            $data_category = $this->M_Base->data_where('product_category', 'id', $loop['category_id']);
            
            $category = count($data_category) == 1 ? $data_category[0]['category'] : '-';

            $product[] = array_merge($loop, [
                'games' => $nama_games,
                'category' => $category,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Produk',
            'product' => $product,
            'games_id' => $games_id,
            'games' => array_reverse($this->M_Base->all_data_order('games', 'games')),
    	]);

        return view('Admin/Produk/index', $data);
    }
    
    public function update() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'games' => $this->request->getPost('games'),
                'rate' => $this->request->getPost('rate'),
                'rate_silver' => $this->request->getPost('rate_silver'),
                'rate_gold' => $this->request->getPost('rate_gold'),
                'rate_bisnis' => $this->request->getPost('rate_bisnis'),
                'rate_modal' => $this->request->getPost('rate_modal'),
            ];
            
            foreach(['rate', 'rate_silver', 'rate_gold', 'rate_bisnis', 'rate_modal'] as $level) {
                
                if (!empty($data_post[$level]) AND $data_post[$level] !== 0) {
                    
                    if ($data_post['games'] == 'all') {
                        $query = $this->M_Base->all_data('product');
                    } else {
                        $query = $this->M_Base->data_where('product', 'games_id', $data_post['games']);
                    }
                    
                    foreach($query as $loop) {
                        
                        $table = 'price';
                        if ($level == 'rate_silver') {
                            $table = 'price_silver';
                        } else if ($level == 'rate_gold') {
                            $table = 'price_gold';
                        } else if ($level == 'rate_bisnis') {
                            $table = 'price_bisnis';
                        } else if ($level == 'rate_modal') {
                            $table = 'price_modal';
                        }
                        
                        if (!empty($loop['coin']) AND $loop['coin'] !== 0) {
                            
                            $this->M_Base->data_update('product', [
                                $table => $loop['coin'] * $data_post[$level],
                            ], $loop['id']);
                        }
                    }
                }
            }
            
            $this->session->setFlashdata('success', 'Harga berhasil diupdate');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Update Harga',
    		'games' => $this->M_Base->all_data('games'),
    	]);

        return view('Admin/Produk/update', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'games_id' => addslashes(trim(htmlspecialchars($this->request->getPost('games_id')))),
                'category_id' => addslashes(trim(htmlspecialchars($this->request->getPost('category_id')))),
                'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                'label' => addslashes(trim(htmlspecialchars($this->request->getPost('label')))),
                'fs' => addslashes(trim(htmlspecialchars($this->request->getPost('fs')))),
                'price_modal' => addslashes(trim(htmlspecialchars($this->request->getPost('price_modal')))),
                'price_cut' => addslashes(trim(htmlspecialchars($this->request->getPost('price_cut')))),
                'price' => addslashes(trim(htmlspecialchars($this->request->getPost('price')))),
                'price_gold' => addslashes(trim(htmlspecialchars($this->request->getPost('price_gold')))),
                'price_silver' => addslashes(trim(htmlspecialchars($this->request->getPost('price_silver')))),
                'price_bisnis' => addslashes(trim(htmlspecialchars($this->request->getPost('price_bisnis')))),
                'price_seller' => addslashes(trim(htmlspecialchars($this->request->getPost('price_seller')))),
                'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                'product_count' => addslashes(trim(htmlspecialchars($this->request->getPost('product_count')))),
                'combo_product' => addslashes(trim(htmlspecialchars($this->request->getPost('combo_product')))),
                'sku' => addslashes(trim(htmlspecialchars($this->request->getPost('sku')))),
                'region' => addslashes(trim(htmlspecialchars($this->request->getPost('region_id')))),
                'logo_url' => trim(htmlspecialchars($this->request->getPost('logo_url'))),
                'coin' => trim(htmlspecialchars($this->request->getPost('coin'))),
            ];

            if (empty($data_post['games_id']) OR empty($data_post['product']) OR empty($data_post['price']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            /*} else if (empty($this->request->getPost('googleauth'))) {
                $this->session->setFlashdata('error', 'Masukan Google Auth');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));*/
            } else {
                $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                $secret_key = $admin[0]['secret_key'];

                $googleAuth = new GoogleAuthenticator();
                $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
                $checkResult = true;

                if ($checkResult == true) {
                    $games = $this->M_Base->data_where('games', 'id', $data_post['games_id']);

                    if (count($games) === 1) {
                        $this->M_Base->data_insert('product', $data_post);

                        $this->session->setFlashdata('success', 'Produk berhasil ditambahkan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->session->setFlashdata('error', 'Games tidak ditemukan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Produk',
            'games' => array_reverse($this->M_Base->all_data_order('games', 'games')),
            'category' => $this->M_Base->all_data('product_category'),
        ]);

        return view('Admin/Produk/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'games_id' => addslashes(trim(htmlspecialchars($this->request->getPost('games_id')))),
                        'category_id' => addslashes(trim(htmlspecialchars($this->request->getPost('category_id')))),
                        'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                        'label' => addslashes(trim(htmlspecialchars($this->request->getPost('label')))),
                        'fs' => addslashes(trim(htmlspecialchars($this->request->getPost('fs')))),
                        'price_modal' => addslashes(trim(htmlspecialchars($this->request->getPost('price_modal')))),
                        'price_cut' => addslashes(trim(htmlspecialchars($this->request->getPost('price_cut')))),
                        'price' => addslashes(trim(htmlspecialchars($this->request->getPost('price')))),
                        'price_gold' => addslashes(trim(htmlspecialchars($this->request->getPost('price_gold')))),
                        'price_silver' => addslashes(trim(htmlspecialchars($this->request->getPost('price_silver')))),
                        'price_bisnis' => addslashes(trim(htmlspecialchars($this->request->getPost('price_bisnis')))),
                        'price_seller' => addslashes(trim(htmlspecialchars($this->request->getPost('price_seller')))),
                        'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                        'product_count' => addslashes(trim(htmlspecialchars($this->request->getPost('product_count')))),
                        'combo_product' => addslashes(trim(htmlspecialchars($this->request->getPost('combo_product')))),
                        'sku' => addslashes(trim(htmlspecialchars($this->request->getPost('sku')))),
                        'region' => addslashes(trim(htmlspecialchars($this->request->getPost('region_id')))),
                        'logo_url' => trim(htmlspecialchars($this->request->getPost('logo_url'))),
                        'coin' => trim(htmlspecialchars($this->request->getPost('coin'))),
                    ];

                    if (empty($data_post['games_id']) OR empty($data_post['product']) OR empty($data_post['price']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    /*} else if (empty($this->request->getPost('googleauth'))) {
                        $this->session->setFlashdata('error', 'Masukan Google Auth');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));*/
                    } else {
                        $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                        $secret_key = $admin[0]['secret_key'];
        
                        $googleAuth = new GoogleAuthenticator();
                        $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
                        $checkResult = true;
        
                        if ($checkResult == true) {
                            $games = $this->M_Base->data_where('games', 'id', $data_post['games_id']);

                            if (count($games) === 1) {
                                $this->M_Base->data_update('product', $data_post, $id);

                                $this->session->setFlashdata('success', 'Produk berhasil disimpan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            } else {
                                $this->session->setFlashdata('error', 'Games tidak ditemukan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Produk',
                    'product' => $product[0],
                    'games' => array_reverse($this->M_Base->all_data_order('games', 'games')),
                    'category' => $this->M_Base->all_data('product_category'),
                ]);

                return view('Admin/Produk/edit', $data);

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update_ajax($id) {
        $data_post = [
            'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
        ];

        $update = $this->M_Base->data_update('product', $data_post, $id);
        if($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                $this->M_Base->data_delete('product', $id);
                
                $this->session->setFlashdata('success', 'Produk berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function deleteall(){
        $deleteIds = $this->request->getPost('delete');

        if (!empty($deleteIds)) {
            foreach ($deleteIds as $id) {
                $product = $this->M_Base->data_where('product', 'id', $id);

                if (count($product) === 1) {

                    $this->M_Base->data_delete('product', $id);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            }

            $this->session->setFlashdata('success', 'Produk berhasil dihapus');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk');
        } else {
            $this->session->setFlashdata('error', 'Gagal hapus product');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk');
        }
    }
    
    public function sort() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            
            if ($this->request->getPost('id')) {
            
                $id = $this->request->getPost('id');
                
                $no = 1;
                foreach(explode(',', $id) as $loop) {
                    
                    $this->M_Base->data_update('product', [
                        'sort' => $no,
                    ], $loop);
                    
                    $no++;
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    
    public function category($action = null, $id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($action == null) {
            
            $data = array_merge($this->base_data, [
        		'title' => 'Kategori Produk',
                'category' => $this->M_Base->all_data('product_category'),
        	]);
    
            return view('Admin/Produk/Category/index', $data);
            
        } else if ($action === 'add') {
            
            if ($this->request->getPost('tombol')) {
                
                $data_post = [
                    'category' => $this->request->getPost('category'),
                    'sort' => $this->request->getPost('sort'),
                ];
                
                if (empty($data_post['category'])) {
                    $this->session->setFlashdata('error', 'Kategori tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    
                    $this->M_Base->data_insert('product_category', $data_post);
                    
                    $this->session->setFlashdata('success', 'Data kategori produk berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Tambah Kategori',
        	]);
    
            return view('Admin/Produk/Category/add', $data);
            
        } else if ($action === 'edit') {
            
            if ($id) {
                
                $category = $this->M_Base->data_where('product_category', 'id', $id);
                
                if (count($category) == 1) {
                    
                    if ($this->request->getPost('tombol')) {
                
                        $data_post = [
                            'category' => $this->request->getPost('category'),
                            'image' => $this->request->getPost('image'),
                            'sort' => $this->request->getPost('sort'),
                        ];
                        
                        if (empty($data_post['category'])) {
                            $this->session->setFlashdata('error', 'Kategori tidak boleh kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            
                            $this->M_Base->data_update('product_category', $data_post, $id);
                            
                            $this->session->setFlashdata('success', 'Data kategori produk berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                    
                    $data = array_merge($this->base_data, [
                		'title' => 'Edit Kategori',
                		'category' => $category[0],
                	]);
            
                    return view('Admin/Produk/Category/edit', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($action === 'delete') {
            
            if ($id) {
                
                $category = $this->M_Base->data_where('product_category', 'id', $id);
                
                if (count($category) == 1) {
                    
                    $this->M_Base->data_delete('product_category', $id);
                    
                    $this->session->setFlashdata('success', 'Data kategori produk berhasil dihapus');
                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk/category');
                    
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
    
    public function voucher($action = null, $id = null) {
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if (isset($_COOKIE['product_id'])) {
            $product_id = $_COOKIE['product_id'];
        }else{
            $product_id = "";
        }
        
        if ($action === 'add') {
            
            if ($this->request->getPost('tombol')) {
                
                $data_post = [
                    'kode_voucher' => $this->request->getPost('kode_voucher'),
                    'id_product' => $product_id,
                    'is_sold' => false,
                ];
                
                if (empty($data_post['kode_voucher'])) {
                    $this->session->setFlashdata('error', 'Kode voucher tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    
                    $this->M_Base->data_insert('product_voucher', $data_post);
                    
                    $this->session->setFlashdata('success', 'Data produk voucher berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    //return redirect()->to(str_replace('index.php/', '', site_url(previous_url())));
                     //return redirect()->back();  // Kembali ke halaman sebelumnya
                    return redirect()->to('/produk/voucher');  // Ganti dengan URL yang sesuai
                }
                
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Tambah Produk Voucher',
        	]);
    
            return view('Admin/Produk/Voucher/add', $data);
            
        } else if ($action === 'edit') {
            
            if ($id) {
                
                $voucher = $this->M_Base->data_where('product_voucher', 'id', $id);
                
                if (count($voucher) == 1) {
                    
                    if ($this->request->getPost('tombol')) {
                
                        $data_post = [
                            'kode_voucher' => $this->request->getPost('kode_voucher'),
                            'is_sold' => $this->request->getPost('is_sold')
                        ];
                        
                        if (empty($data_post['kode_voucher'])) {
                            $this->session->setFlashdata('error', 'Kode voucher tidak boleh kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            
                            $this->M_Base->data_update('product_voucher', $data_post, $id);
                            $this->session->setFlashdata('success', 'Data produk voucher berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                    
                    $data = array_merge($this->base_data, [
                		'title' => 'Edit Produk Voucher',
                		'voucher' => $voucher[0],
                	]);
            
                    return view('Admin/Produk/Voucher/edit', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
        } else if ($action === 'delete') {
            
            if ($id) {
                
                $product_voucher = $this->M_Base->data_where('product_voucher', 'id', $id);
                
                if (count($product_voucher) == 1) {
                    
                    $this->M_Base->data_delete('product_voucher', $id);
                    
                    $this->session->setFlashdata('success', 'Data produk voucher berhasil dihapus');
                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk/voucher');
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
        } else if ($action === 'import') {
            
            if ($this->request->getPost('tombol')) {
                $product_id = $this->request->getPost('product_id');
                $file = $this->M_Base->upload_file($this->request->getFile('file'), 'assets/excel/');
                if ($file) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
                    $spreadsheet = $reader->load('assets/excel/' . $file)->getActiveSheet()->toArray(null, true, true, true);
                    if (count($spreadsheet) !== 0) {
                        $no = 1;
                        $add = 0;
                        $update = 0;
                        foreach ($spreadsheet as $loop) {
                            if ($no > 1) {
                                //$A = ($loop['A'] == null) ? '' : $loop['A'];
                                $voucher = $this->M_Base->data_where_array('product_voucher', [
                                    'kode_voucher' => $loop['A'],
                                ]);
                                
                                if (count($voucher) == 0) {
                                    $this->M_Base->data_insert('product_voucher', [
                                        'kode_voucher' => $loop['A'],
                                        'id_product' => $product_id,
                                        'is_sold' => false
                                    ]);
                                    
                                    $add++;
                                }else{
                                    $this->M_Base->data_update('product_voucher', [
                                                'kode_voucher' => $loop['A'],
                                                'modified' => date("Y-m-d H:i:s"),
                                            ], $product_voucher[0]['kode_voucher']);
                                            
                                    $update++;   
                                }
                                
                            }
                            
                            $no++;
                        }
                        
                        $this->session->setFlashdata('success', $add . ' ditambahkan dan ' . $update . ' diupdate');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }else{
                        $this->session->setFlashdata('error', 'Tidak ada baris di dalam file');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }else{
                    $this->session->setFlashdata('error', 'File excel gagal diupload');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
                
            }else{
                
                $data = array_merge($this->base_data, [
        		    'title' => 'Import Voucher Produk',
                    'product_id' => $product_id,
        	    ]);
                return view('Admin/Produk/Voucher/import', $data);   
            }
            
        } else if ($action === 'export') {
            $query = $this->M_Base->data_where_array('product_voucher', [
                                'id_product' => $product_id,
                            ]);
        
            if (count($query) !== 0) {
                $file_name = 'export-product-voucher' . $product_id . '.xlsx';
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'ID Produk');
                $sheet->setCellValue('B1', 'Kode Voucher');
                $sheet->setCellValue('C1', 'Status');
                
                $line = 2;
                foreach ($query as $loop) {
                    $status = "available";
                    if($loop['is_sold'] == "1"){
                        $status = "sold";
                    }
                    $sheet->setCellValue('A' . $line, $loop['id_product']);
                    $sheet->setCellValue('B' . $line, $loop['kode_voucher']);
                    $sheet->setCellValue('C' . $line, $status);
                    $line++;
                }
                
                $writer = new Xlsx($spreadsheet);
                $writer->save('assets/excel/' . $file_name);
                            
                return redirect()->to(base_url() . '/assets/excel/' . $file_name);
            }else{
                $this->session->setFlashdata('error', 'Tidak ada produk voucher');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
            
        } else{
            
            if (isset($action)) {
                setcookie('product_id', '', time()-1, '/-9J6DWAuK/]:C2Tx1/produk/voucher');
                setcookie('product_id', '', time()-1, '/-9J6DWAuK/]:C2Tx1/produk/voucher/import');
                setcookie('product_id', '', time()-1, '/-9J6DWAuK/]:C2Tx1/produk/voucher/export');
                setcookie('product_id', $action, time()+60*60*24*30, '/-9J6DWAuK/]:C2Tx1/produk/voucher');
                setcookie('product_id', $action, time()+60*60*24*30, '/-9J6DWAuK/]:C2Tx1/produk/voucher/import');
                setcookie('product_id', $action, time()+60*60*24*30, '/-9J6DWAuK/]:C2Tx1/produk/voucher/export');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/produk/voucher');
            } 
        
            $product = $this->M_Base->data_where('product', 'id', $product_id);
            $voucher = $this->M_Base->data_where('product_voucher', 'id_product', $product_id);
            $data = array_merge($this->base_data, [
        		'title' => 'Voucher Produk',
        		'product' => $product,
                'voucher' => $voucher,
        	]);
    
            return view('Admin/Produk/Voucher/index', $data);
        }
    }
    
    
}

