<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Metode extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('pay_balance')) {
            $this->M_Base->u_update('pay_balance', $this->request->getPost('pay_balance'));

            $this->session->setFlashdata('success', 'Sistem pembayaran berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }
        
        $method = [];
        
        foreach ($this->M_Base->all_data('method') as $loop) {
            
            $data_category = $this->M_Base->data_where('method_category', 'id', $loop['category_id']);
            
            $category = count($data_category) == 1 ? $data_category[0]['category'] : '-';
            
            $method[] = array_merge($loop, [
                'category' => $category,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Metode',
            'method' => $method,
            'pay_balance' => $this->M_Base->u_get('pay_balance'),
    	]);

        return view('Admin/Metode/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                'category_id' => addslashes(trim(htmlspecialchars($this->request->getPost('category_id')))),
                'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                'code' => addslashes(trim(htmlspecialchars($this->request->getPost('code')))),
                'uniq' => addslashes(trim(htmlspecialchars($this->request->getPost('uniq')))),
                'rek' => addslashes(trim(htmlspecialchars($this->request->getPost('rek')))),
                'instruksi' => addslashes(trim(htmlspecialchars($this->request->getPost('instruksi')))),
                'type' => addslashes(trim(htmlspecialchars($this->request->getPost('type')))),
                'fee' => addslashes(trim(htmlspecialchars($this->request->getPost('fee')))),
                'percent' => addslashes(trim(htmlspecialchars($this->request->getPost('percent')))),
                'sub_title' => addslashes(trim(htmlspecialchars($this->request->getPost('sub_title')))),
            ];

            if (empty($data_post['method']) OR empty($data_post['uniq'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/method/');

                if ($image) {
                    $this->M_Base->data_insert('method', array_merge($data_post, [
                        'image' => $image,
                        'status' => 'On',
                    ]));

                    $this->session->setFlashdata('success', 'Metode berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Metode',
            'category' => $this->M_Base->all_data('method_category'),
        ]);

        return view('Admin/Metode/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {

            $method = $this->M_Base->data_where('method', 'id', $id);

            if (count($method) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                        'category_id' => addslashes(trim(htmlspecialchars($this->request->getPost('category_id')))),
                        'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                        'code' => addslashes(trim(htmlspecialchars($this->request->getPost('code')))),
                        'uniq' => addslashes(trim(htmlspecialchars($this->request->getPost('uniq')))),
                        'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                        'rek' => addslashes(trim(htmlspecialchars($this->request->getPost('rek')))),
                        'instruksi' => addslashes(trim(htmlspecialchars($this->request->getPost('instruksi')))),
                        'type' => addslashes(trim(htmlspecialchars($this->request->getPost('type')))),
                        'fee' => addslashes(trim(htmlspecialchars($this->request->getPost('fee')))),
                        'percent' => addslashes(trim(htmlspecialchars($this->request->getPost('percent')))),
                        'sub_title' => addslashes(trim(htmlspecialchars($this->request->getPost('sub_title')))),
                    ];

                    if (empty($data_post['method']) OR empty($data_post['uniq'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/method/');

                        if ($image) {
                            $file = 'assets/images/method/' . $method[0]['image'];

                            if (file_exists($file)) {
                                unlink($file);
                            }
                        } else {
                            $image = $method[0]['image'];
                        }

                        $this->M_Base->data_update('method', array_merge($data_post, [
                            'image' => $image,
                        ]), $id);

                        $this->session->setFlashdata('success', 'Metode berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Metode',
                    'method' => $method[0],
                    'category' => $this->M_Base->all_data('method_category'),
                ]);

                return view('Admin/Metode/edit', $data);
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
            $method = $this->M_Base->data_where('method', 'id', $id);

            if (count($method) === 1) {
                $this->M_Base->data_delete('method', $id);

                $this->session->setFlashdata('success', 'Metode berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/metode');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function price($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                if ($this->request->getPost('tombol')) {
                    foreach ($this->request->getPost('price') as $metode => $price) {
                        $data_price = $this->M_Base->data_where_array('price', [
                            'method_id' => $metode,
                            'product_id' => $product[0]['id'],
                        ]);

                        if (count($data_price) == 1) {
                            $this->M_Base->data_update('price', [
                                'price' => $price,
                            ], $data_price[0]['id']);
                        } else {
                            if ($product[0]['price'] !== $price) {
                                $this->M_Base->data_insert('price', [
                                    'product_id' => $product[0]['id'],
                                    'method_id' => $metode,
                                    'price' => $price,
                                ]);
                            }
                        }
                    }

                    $this->session->setFlashdata('success', 'Harga produk berhasil dikosum');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }

                $method = [];
                foreach ($this->M_Base->all_data('method') as $loop) {

                    $data_price = $this->M_Base->data_where_array('price', [
                        'product_id' => $id,
                        'method_id' => $loop['id']
                    ]);

                    $price = count($data_price) == 1 ? $data_price[0]['price'] : $product[0]['price'];

                    $method[] = array_merge($loop, [
                        'price' => $price,
                    ]);
                }

                $find_price = $this->M_Base->data_where_array('price', [
                    'method_id' => 10001,
                    'product_id' => $product[0]['id'],
                ]);
                
                $find_price2 = $this->M_Base->data_where_array('price', [
                    'method_id' => 10002,
                    'product_id' => $product[0]['id'],
                ]);

                $find_price3 = $this->M_Base->data_where_array('price', [
                    'method_id' => 10003,
                    'product_id' => $product[0]['id'],
                ]);

                $price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];
                
                $price2 = count($find_price2) == 1 ? $find_price2[0]['price'] : $product[0]['price'];

                $price3 = count($find_price3) == 1 ? $find_price3[0]['price'] : $product[0]['price'];

                $method = array_merge($method, [
                    [
                        'id' => 10001,
                        'price' => $price,
                        'image' => 'silver-surf.png',
                    ],
                    [
                        'id' => 10002,
                        'price' => $price2,
                        'image' => 'gold-surf.png',
                    ],
                    [
                        'id' => 10003,
                        'price' => $price3,
                        'image' => 'bisnis-surf.png',
                    ]
                ]);

                $data = array_merge($this->base_data, [
                    'title' => 'Kostum Harga',
                    'method' => $method,
                ]);

                return view('Admin/Metode/price', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    
    public function price_regist() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            if ($this->request->getPost('tombol')) {
                // echo '<pre>';
                // print_r($this->request->getPost('note')); die();
                foreach ($this->request->getPost('price') as $metode => $price) {
                    $data_price = $this->M_Base->data_where_array('method_regist', [
                        'method_id' => $metode,
                    ]);

                    if (count($data_price) == 1) {
                        $this->M_Base->data_update('method_regist', [
                            'price' => $price,
                            'note' => $this->request->getPost('note')[$metode], 
                        ], $data_price[0]['id']);
                    } else {
                        // if ($product[0]['price'] !== $price) {
                        $this->M_Base->data_insert('method_regist', [
                            'method_id' => $metode,
                            'price' => $price,
                            'note' => $this->request->getPost('note')[$metode],
                        ]);
                        // }
                    }
                }

                $this->session->setFlashdata('success', 'Harga pendaftaran berhasil diupdate');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }

            $method_regist = [];
            foreach ($this->M_Base->all_data('method') as $loop) {

                $data_price = $this->M_Base->data_where_array('method_regist', [
                    'method_id' => $loop['id']
                ]);

                $price  = count($data_price) == 1 ? $data_price[0]['price'] : 0;
                $note   = count($data_price) == 1 ? $data_price[0]['note'] : '';

                $method_regist[] = array_merge($loop, [
                    'price' => $price,
                    'note' => $note,
                ]);
            }

            $data = array_merge($this->base_data, [
                'title' => 'Harga Register',
                'method' => $method_regist,
            ]);

            return view('Admin/Metode/regist', $data);
            // } else {
            //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // }
        }
    } 
    
    public function category($action = null, $id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($action == null) {
            
            $data = array_merge($this->base_data, [
        		'title' => 'Kategori Metode',
                'category' => $this->M_Base->all_data('method_category'),
        	]);
    
            return view('Admin/Metode/Category/index', $data);
            
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
                    
                    $this->M_Base->data_insert('method_category', $data_post);
                    
                    $this->session->setFlashdata('success', 'Data kategori metode berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Tambah Kategori',
        	]);
    
            return view('Admin/Metode/Category/add', $data);
            
        } else if ($action === 'edit') {
            
            if ($id) {
                
                $category = $this->M_Base->data_where('method_category', 'id', $id);
                
                if (count($category) == 1) {
                    
                    if ($this->request->getPost('tombol')) {
                
                        $data_post = [
                            'category' => $this->request->getPost('category'),
                            'sort' => $this->request->getPost('sort'),
                        ];
                        
                        if (empty($data_post['category'])) {
                            $this->session->setFlashdata('error', 'Kategori tidak boleh kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            
                            $this->M_Base->data_update('method_category', $data_post, $id);
                            
                            $this->session->setFlashdata('success', 'Data kategori metode berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                    
                    $data = array_merge($this->base_data, [
                		'title' => 'Edit Kategori',
                		'category' => $category[0],
                	]);
            
                    return view('Admin/Metode/Category/edit', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($action === 'delete') {
            
            if ($id) {
                
                $category = $this->M_Base->data_where('method_category', 'id', $id);
                
                if (count($category) == 1) {
                    
                    $this->M_Base->data_delete('method_category', $id);
                    
                    $this->session->setFlashdata('success', 'Data kategori metode berhasil dihapus');
                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/metode/category');
                    
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
    
}