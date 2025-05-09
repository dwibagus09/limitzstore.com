<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kategori extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Kategori',
            'kategori' => $this->M_Base->all_data('category'),
    	]);

        return view('Admin/Kategori/index', $data);
    }
    
    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
            ];

            if (empty($data_post['category'])) {
                $this->session->setFlashdata('error', 'Nama kategori baru tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {

                $this->M_Base->data_insert('category', $data_post);

                $this->session->setFlashdata('success', 'Kategori baru berhasil ditambahkan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Tambah Kategori',
    	]);

        return view('Admin/Kategori/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            
            $category = $this->M_Base->data_where('category', 'id', $id);

            if (count($category) === 1) {
                
                if ($this->request->getPost('tombol')) {
            
                    $data_post = [
                        'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                        'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                    ];
        
                    if (empty($data_post['category'])) {
                        $this->session->setFlashdata('error', 'Nama kategori baru tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
        
                        $this->M_Base->data_update('category', $data_post, $id);
        
                        $this->session->setFlashdata('success', 'Kategori berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }
        
            	$data = array_merge($this->base_data, [
            		'title' => 'Edit Kategori',
            		'category' => $category[0]
            	]);
        
                return view('Admin/Kategori/edit', $data);
                
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
        } else if (is_numeric($id)) {
            
            $category = $this->M_Base->data_where('category', 'id', $id);

            if (count($category) === 1) {
                
                $this->M_Base->data_delete('category', $id);

                $this->session->setFlashdata('success', 'Data berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/kategori');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}