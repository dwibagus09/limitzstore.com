<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tema extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            
            $this->M_Base->u_update('tema_warna', $this->request->getPost('tema_warna'));
            $this->M_Base->u_update('tema_warna_2', $this->request->getPost('tema_warna_2'));
            $this->M_Base->u_update('tema_warna_3', $this->request->getPost('tema_warna_3'));
            $this->M_Base->u_update('tema_warna_4', $this->request->getPost('tema_warna_4'));
            $this->M_Base->u_update('tema_text', $this->request->getPost('tema_text'));
            $this->M_Base->u_update('tema_text_2', $this->request->getPost('tema_text_2'));
            $this->M_Base->u_update('tema_border', $this->request->getPost('tema_border'));
            
            foreach (['tema_image_sidebar', 'tema_image_hero'] as $image_name) {
                
                $image = $this->M_Base->upload_file($this->request->getFile($image_name), 'assets/images/');
                
                if ($image) {
                    
                    $file_old = $this->M_Base->u_get($image_name);
                    
                    if (!empty($file_old)) {
                        
                        $path = 'assets/images/' . $file_old;
                        
                        if (file_exists($path)) {
                            
                            unlink($path);
                        }
                    }
                    
                    $this->M_Base->u_update($image_name, $image);
                }
            }
            
            
            $this->session->setFlashdata('success', 'Data tema berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Tema Website',
    	]);

        return view('Admin/Tema/index', $data);
    }
}