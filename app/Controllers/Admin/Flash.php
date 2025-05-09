<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Flash extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            
            $this->M_Base->u_update('fs_date', $this->request->getPost('fs_date') . ' ' . $this->request->getPost('fs_date_time'));
            $this->M_Base->u_update('fs_status', $this->request->getPost('fs_status'));
             
            $this->session->setFlashdata('success', 'Data flash sale berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string()))); 
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Flash',
            'fs' => [
                'date' => $this->M_Base->u_get('fs_date'),
                'status' => $this->M_Base->u_get('fs_status'),
                'product' => $this->M_Base->data_where_array('product', ['fs' => 'Y', 'status' => 'On']),
            ],
    	]);

        return view('Admin/Flash/index', $data);
    }
    
    public function update_product_status($product_id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            $products = $this->M_Base->data_where('product', 'id', $product_id);
            if (count($products) === 1) {
                $this->M_Base->data_update('product', [
                    'fs' => 'N',
                ], $product_id);

                $this->session->setFlashdata('success', 'Data product flash sale berhasil di off kan.');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/flash'); 

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function update_product_stock($product_id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            if($product_id){
                //$products = $this->M_Base->data_where('product', 'id', $product_id);
                $products = $this->M_Base->data_where_array('product', ['id' => $product_id, 'fs' => 'Y', 'status' => 'On']);
                if (count($products) === 1) {
                    $data = array_merge($this->base_data, [
                        'title' => 'Form Update Stok',
                        'products' => $products,
                    ]);

                    return view('Admin/Flash/form_update_stock', $data);

                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            }else{

                if ($this->request->getPost('tombol')) {
                    $product_id = $this->request->getPost('product_id');
                    $this->M_Base->data_update('product', [
                        'stock' => $this->request->getPost('stock'),
                        'sold' => $this->request->getPost('sold'),
                    ], $product_id);
                     
                    $this->session->setFlashdata('success', 'Update data product flash sale berhasil disimpan');
                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/flash'); 
                }

            }
        }
    }
}