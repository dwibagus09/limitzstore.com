<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tatacara extends BaseController {

    public function __construct(){
        helper(['form']);   
    }

    public function index () {

        $data = $this->M_Base->all_data('tata_cara_kategory');

        $headjoin = $this->db->table('tata_cara_head');
        $headjoin->select('*,tata_cara_head.id as id');
        $headjoin->join('tata_cara_kategory', 'tata_cara_kategory.id = tata_cara_head.category');
        $datahead = $headjoin->get()->getResultArray();

        $bodyjoin = $this->db->table('tata_cara_body');
        $bodyjoin->select('*,tata_cara_body.id as id');
        $bodyjoin->join('tata_cara_kategory', 'tata_cara_kategory.id = tata_cara_body.tata_cara_category_id');
        $bodyjoin->join('tata_cara_head', 'tata_cara_head.id = tata_cara_body.tata_cara_head_id');
        $databody = $bodyjoin->get()->getResultArray();


        $data = array_merge($this->base_data, [
            'title' => 'TATA CARA',
            'data' => $data,
            'datahead' => $datahead,
            'databody' => $databody
        ]);

        return view('Admin/tatacara/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'nama' => addslashes(trim(htmlspecialchars($this->request->getPost('nama')))),
                'slug' => addslashes(trim(htmlspecialchars($this->request->getPost('slug')))),
            ];

            if (empty($data_post['nama']) OR empty($data_post['slug'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $menu = $this->M_Base->data_where_array('tata_cara_kategory', ['slug' => $data_post['slug']]);

                if (count($menu) === 1) {
                    $this->session->setFlashdata('error', 'Data yang di add double');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->M_Base->data_insert('tata_cara_kategory', $data_post);
                    $this->session->setFlashdata('success', 'Menu berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Menu',
            // 'games' => $this->M_Base->all_data('games'),
        ]);

        return view('Admin/tatacara/form', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $menu = $this->M_Base->data_where('tata_cara_kategory', 'id', $id);

            if (count($menu) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'nama' => addslashes(trim(htmlspecialchars($this->request->getPost('nama')))),
                        'slug' => addslashes(trim(htmlspecialchars($this->request->getPost('slug')))),
                    ];
        

                    if (empty($data_post['nama']) OR empty($data_post['slug'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_update('tata_cara_kategory', $data_post, $id);
                        $this->session->setFlashdata('success', 'Produk berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Menu',
                    'edit' => $this->db->table('tata_cara_kategory')->where(['id' => $id])->get()->getrowarray(),
                ]);

                return view('Admin/tatacara/form', $data);

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
            $menu = $this->M_Base->data_where('tata_cara_kategory', 'id', $id);

            if (count($menu) === 1) {

                $this->M_Base->data_delete('tata_cara_kategory', $id);
                
                $this->session->setFlashdata('success', 'Produk berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/tata-cara');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function addlangkah() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                'title' => addslashes(trim(htmlspecialchars($this->request->getPost('title')))),
                'deskripsi' => addslashes(trim(htmlspecialchars($this->request->getPost('deskripsi')))),
            ];

            if (empty($data_post['category']) OR empty($data_post['sort']) OR empty($data_post['title'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $langkah = $this->M_Base->data_where_array('tata_cara_head', ['sort' => $data_post['sort']]);

                if (count($langkah) === 1) {
                    $this->session->setFlashdata('error', 'Data yang di add double');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->M_Base->data_insert('tata_cara_head', $data_post);
                    $this->session->setFlashdata('success', 'Menu berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Langkah - Langkah',
            'category' => $this->M_Base->all_data('tata_cara_kategory'),
        ]);

        return view('Admin/tatacara/form_langkah', $data);
    }

    public function editlangkah($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $menu = $this->M_Base->data_where('tata_cara_head', 'id', $id);

            if (count($menu) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                        'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                        'title' => addslashes(trim(htmlspecialchars($this->request->getPost('title')))),
                        'deskripsi' => addslashes(trim(htmlspecialchars($this->request->getPost('deskripsi')))),
                    ];
        

                    if (empty($data_post['category']) OR empty($data_post['sort']) OR empty($data_post['title'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_update('tata_cara_head', $data_post, $id);
                        $this->session->setFlashdata('success', 'Produk berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $headjoin = $this->db->table('tata_cara_head');
                $headjoin->select('*');
                $headjoin->join('tata_cara_kategory', 'tata_cara_kategory.id = tata_cara_head.category');
                $headjoin->where('tata_cara_head.id', $id);
                $datahead = $headjoin->get()->getrowarray();

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Langkah - Langkah',
                    'category' => $this->M_Base->all_data('tata_cara_kategory'),
                    'edit' => $datahead,
                ]);

                return view('Admin/tatacara/form_langkah', $data);

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function deletelangkah($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $menu = $this->M_Base->data_where('tata_cara_head', 'id', $id);

            if (count($menu) === 1) {

                $this->M_Base->data_delete('tata_cara_head', $id);
                
                $this->session->setFlashdata('success', 'Produk berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/tata-cara');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function addcontent() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {

            $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/tatacara/');

            if ($image) {
                $isi = $image;
            } else {
                $isi = $this->request->getPost('isi');
            }

            $langkah = $this->db->table('tata_cara_head')->where('id', addslashes(trim(htmlspecialchars($this->request->getPost('langkah')))))->get()->getRowArray();
            
            $data_post = [
                'tata_cara_head_id' => addslashes(trim(htmlspecialchars($this->request->getPost('langkah')))),
                'tata_cara_category_id' => $langkah['category'],
                'type' => addslashes(trim(htmlspecialchars($this->request->getPost('type')))),
                'isi' => $isi,
            ];

            if (empty($data_post['tata_cara_head_id']) OR empty($data_post['type']) OR empty($data_post['tata_cara_category_id'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $this->M_Base->data_insert('tata_cara_body', $data_post);
                $this->session->setFlashdata('success', 'Menu berhasil ditambahkan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Content',
            'langkah' => $this->M_Base->all_data('tata_cara_head'),
        ]);

        return view('Admin/tatacara/form_content', $data);
    }

    public function editcontent($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $content = $this->M_Base->data_where('tata_cara_body', 'id', $id);

            if (count($content) === 1) {

                if ($this->request->getPost('tombol')) {
                    $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/tatacara/');

                    if ($image) {
                        $isi = $image;
                    } else {
                        $isi = $this->request->getPost('isi');
                    }
        
                    $langkah = $this->db->table('tata_cara_head')->where('id', addslashes(trim(htmlspecialchars($this->request->getPost('langkah')))))->get()->getRowArray();
                    
                    $data_post = [
                        'tata_cara_head_id' => addslashes(trim(htmlspecialchars($this->request->getPost('langkah')))),
                        'tata_cara_category_id' => $langkah['category'],
                        'type' => addslashes(trim(htmlspecialchars($this->request->getPost('type')))),
                        'isi' => $isi,
                    ];
        

                    if (empty($data_post['tata_cara_head_id']) OR empty($data_post['type']) OR empty($data_post['tata_cara_category_id'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_update('tata_cara_body', $data_post, $id);
                        $this->session->setFlashdata('success', 'Produk berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $bodyjoin = $this->db->table('tata_cara_body');
                $bodyjoin->select('*');
                $bodyjoin->join('tata_cara_head', 'tata_cara_head.id = tata_cara_body.tata_cara_head_id');
                $bodyjoin->where('tata_cara_body.id', $id);
                $databody = $bodyjoin->get()->getrowarray();

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Menu',
                    'langkah' => $this->M_Base->all_data('tata_cara_head'),
                    'edit' => $databody,
                ]);

                return view('Admin/tatacara/form_content', $data);

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function deletecontent($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (is_numeric($id)) {
            $menu = $this->M_Base->data_where('tata_cara_body', 'id', $id);

            if (count($menu) === 1) {

                $this->M_Base->data_delete('tata_cara_body', $id);
                
                $this->session->setFlashdata('success', 'Produk berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/tata-cara');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}