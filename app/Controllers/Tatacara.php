<?php

namespace App\Controllers;

class Tatacara extends BaseController {


    public function index ($slug) {
        if ($slug) {

            $find_category = $this->M_Base->data_where('tata_cara_kategory', 'slug', $slug);

            $find_head = $this->db->table('tata_cara_head')->where(['category' => $find_category[0]['id']])->orderBy('sort', 'ASC')->get()->getResultArray();

            $isi = [];

            foreach ($find_head as $loop) {
                $isi[] = $this->M_Base->data_where_array('tata_cara_body', ['tata_cara_head_id' => $loop['id'], 'tata_cara_category_id' => $find_category[0]['id']]);
            }

            $data = array_merge($this->base_data, [
                'title' => 'TATA CARA - '.$find_category[0]['nama'],
                'head' => $find_head,
                'array' => $isi,
            ]);
    
            return view('tatacara/index', $data);
        } else {
            $this->session->setFlashdata('error', 'URL SALAH');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }
    }

}