<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Config extends BaseController {

    public function index() {
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('config');
        $get= $builder->get()->getResultArray();

        $data = array_merge($this->base_data, [
    		'title' => 'Config',
            'config' => $get
    	]);

        return view('Admin/config/index', $data);
    }

    public function update($nama){

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        
        helper(['form']);
        $rules = [
            'value' => 'required',
        ];
          
        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('config');
            $data = [
                'value' => $this->request->getVar('value'),
            ];
            $builder->set($data);
            $builder->where('nama', $nama);
            $builder->update();
            
            $this->session->setFlashdata('success', 'Data berhasil di ubah');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }else{
            $db = \Config\Database::connect();
            $builder = $db->table('config');
            $builder->where('nama', $nama);
            $get = $builder->get()->getResultArray();

            $data = array_merge($this->base_data, [
                'title' => 'Update Config',
                'config' => $get
            ]);
            return view('Admin/config/update', $data);
        }
    }

    public function add_jumlah_click(){
        helper(['form']);
        $rules = [
            'id_games' => 'required',
        ];
          
        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('jumlah_klik');

            $builder->where('id_games', $this->request->getVar('id_games'));
            $get = $builder->get()->getRowArray();

            if ($get) {
                $data = [
                    'id_games' => $this->request->getVar('id_games'),
                    'jumlah_klik' => $get['jumlah_klik'] + 1,
                ];
                $builder->set($data);
                $builder->where('id_games', $this->request->getVar('id_games'));
                $builder->update();

                $this->response->setStatusCode(200)->setBody(['Message' => 'Sukses']);
            } else {
                $data = [
                    'id_games' => $this->request->getVar('id_games'),
                    'jumlah_klik' => 1,
                ];
                $builder->insert($data);

                $this->response->setStatusCode(200)->setBody(['Message' => 'Sukses']);
            }
        }else{
            $this->response->setStatusCode(404)->setBody(['Message' => 'Errors']);
        }
    }
}