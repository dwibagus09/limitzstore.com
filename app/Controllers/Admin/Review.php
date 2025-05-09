<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Review extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        $review = [];
        foreach ($this->M_Base->all_data('orders_review') as $loop) {
            
            $data_orders = $this->M_Base->data_where('orders', 'order_id', $loop['order_id']);
            
            if (count($data_orders) == 1) {
                $product = $data_orders[0]['product'];
            } else {
                $product = '';
            }
            
            $review[] = array_merge($loop, [
                'product' => $product,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Review Pesanan',
    		'review' => $review,
    	]);

        return view('Admin/Review/index', $data);
    }
    
    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($id) {
            
            $review = $this->M_Base->data_where('orders_review', 'id', $id);
            $order = $this->M_Base->data_where('orders', 'order_id', $review[0]['order_id']);
            log_message('info', 'Data Post User: ' . print_r($review, true));
            if (count($review) == 1) {
                
                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'star' => $this->request->getPost('star'),
                        'games_id' => $order[0]['games_id'],
                        'message' => $this->request->getPost('message'),
                    ];
                    
                    if (empty($data_post['star'])) {
                        $this->session->setFlashdata('error', 'Jumlah star tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        
                        $this->M_Base->data_update('orders_review', $data_post, $id);
                        
                        $this->session->setFlashdata('success', 'Data review berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }
                
                $orders = $this->M_Base->data_where('orders', 'order_id', $review[0]['order_id']);
                
                $product = count($orders) == 1 ? $orders[0]['product'] : '-';
                
                $data = array_merge($this->base_data, [
            		'title' => 'Edit Review',
            		'review' => array_merge($review[0], [
            		    'product' => $product,
            		]),
            	]);
        
                return view('Admin/Review/edit', $data);
                
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($id) {
            
            $review = $this->M_Base->data_where('orders_review', 'id', $id);
            
            if (count($review) == 1) {
                
                $this->M_Base->data_delete('orders_review', $id);
                
                $this->session->setFlashdata('success', 'Data review berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/review');
                
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function template($action = null, $id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($action === null) {
            
            $data = array_merge($this->base_data, [
        		'title' => 'Template Review',
        		'template' => $this->M_Base->all_data('review_template'),
        	]);
    
            return view('Admin/Review/Template/index', $data);
            
        } else if ($action === 'add') {
            
            if ($this->request->getPost('tombol')) {
                
                $data_post = [
                    'text' => $this->request->getPost('text'),
                ];
                
                if (empty($data_post['text'])) {
                    $this->session->setFlashdata('error', 'Isi pesan tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    
                    $this->M_Base->data_insert('review_template', $data_post);
                    
                    $this->session->setFlashdata('success', 'Data template berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
            
            $data = array_merge($this->base_data, [
        		'title' => 'Tambah Template',
        	]);
    
            return view('Admin/Review/Template/add', $data);
            
        } else if ($action === 'delete') {
            
            if ($id) {
                
                $template = $this->M_Base->data_where('review_template', 'id', $id);
                
                if (count($template) == 1) {
                    
                    $this->M_Base->data_delete('review_template', $id);
                    
                    $this->session->setFlashdata('success', 'Data template berhasil dihapus');
                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/review/template');
                    
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