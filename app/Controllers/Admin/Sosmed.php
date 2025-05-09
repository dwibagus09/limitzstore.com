<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Sosmed extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Sosmed',
            'sosmed' => $this->M_Base->all_data('sosmed'),
    	]);

        return view('Admin/Sosmed/index', $data);
    }
    
    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'text' => $this->request->getPost('text'),
                'link' => $this->request->getPost('link'),
            ];
            
            $image = $this->M_Base->upload_file($this->request->getFile('image'), 'assets/images/sosmed/');
            
            if ($image) {
                
                $this->M_Base->data_insert('sosmed', array_merge($data_post, [
                    'image' => $image,
                ]));
                
                $this->session->setFlashdata('success', 'Sosmed berhasil ditambahkan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $this->session->setFlashdata('error', 'Gambar tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Tambah Sosmed',
    	]);

        return view('Admin/Sosmed/add', $data);
    }
    
    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($id) {
            
            $sosmed = $this->M_Base->data_where('sosmed', 'id', $id);
            
            if (count($sosmed) == 1) {
                
                if ($this->request->getPost('tombol')) {
            
                    $data_post = [
                        'link' => $this->request->getPost('link'),
                        'text' => $this->request->getPost('text'),
                    ];
                    
                    $image = $this->M_Base->upload_file($this->request->getFile('image'), 'assets/images/sosmed/');
                    
                    if ($image) {
                        
                        $file_old = $sosmed[0]['image'];
                        
                        if (!empty($file_old)) {
                            
                            $path = 'assets/images/sosmed/' . $file_old;
                            
                            if (file_exists($path)) {
                                
                                unlink($path);
                            }
                        }
                        
                    } else {
                        $image = $sosmed[0]['image'];
                    }
                    
                    $this->M_Base->data_update('sosmed', array_merge($data_post, [
                        'image' => $image,
                    ]), $id);
                    
                    $this->session->setFlashdata('success', 'Sosmed berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
                
                $data = array_merge($this->base_data, [
            		'title' => 'Edit Sosmed',
            		'sosmed' => $sosmed[0],
            	]);
        
                return view('Admin/Sosmed/edit', $data);
                
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
            
            $sosmed = $this->M_Base->data_where('sosmed', 'id', $id);
            
            if (count($sosmed) == 1) {
                
                $image = $sosmed[0]['image'];
                
                if (!empty($image)) {
                    
                    $path = 'assets/images/sosmed/' . $image;
                    
                    if (file_exists($path)) {
                        
                        unlink($path);
                    }
                }
                
                $this->M_Base->data_delete('sosmed', $id);
                
                $this->session->setFlashdata('success', 'Data sosmed berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/sosmed');
                
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}