<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Target extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        $data = array_merge($this->base_data, [
            'title' => 'Sistem Target',
            'target' => $this->M_Base->all_data('target'),
        ]);

        return view('Admin/Target/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {

            $data_post = [
                'target' => $this->request->getPost('target'),
                'text' => $this->request->getPost('text'),
                'img_petunjuk' => $this->request->getPost('img'),
                'description' => $this->request->getPost('description'),
                'sparator' => $this->request->getPost('sparator'),
                'error' => $this->request->getPost('error'),
            ];

            if ($this->request->getPost('col_type')) {

                if (is_array($this->request->getPost('col_type'))) {

                    $col = [];
                    foreach ($this->request->getPost('col_type') as $key => $value) {

                        if ($value == 'input') {

                            if ($this->request->getPost('title')) {

                                if (!array_key_exists($key, $this->request->getPost('title'))) {
                                    $this->session->setFlashdata('error', 'Data judul tidak ditemukan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Judul kolom tidak boleh kosong');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }

                            if ($this->request->getPost('type')) {

                                if (!array_key_exists($key, $this->request->getPost('type'))) {
                                    $this->session->setFlashdata('error', 'Data judul tidak ditemukan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Judul kolom tidak boleh kosong');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }

                            $col[] = [
                                'col_type' => $value,
                                'title' => $this->request->getPost('title')[$key],
                                'type' => $this->request->getPost('type')[$key]
                            ];
                        } else {

                            if ($this->request->getPost('option')) {

                                if (!array_key_exists($key, $this->request->getPost('option'))) {
                                    $this->session->setFlashdata('error', 'Data pilihan tidak ditemukan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Data pilihan tidak boleh kosong');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }

                            $col[] = [
                                'col_type' => $value,
                                'title' => $this->request->getPost('title')[$key],
                                'option' => $this->request->getPost('option')[$key]
                            ];
                        }
                    }

                    if (count($col) !== 0) {

                        $this->M_Base->data_insert('target', array_merge($data_post, [
                            'col' => json_encode($col),
                        ]));

                        $this->session->setFlashdata('success', 'Data target berhasil ditambahkan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));

                    } else {
                        $this->session->setFlashdata('error', 'Data kolom tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Target tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            } else {
                $this->session->setFlashdata('error', 'Minimal ada 1 kolom target');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Target',
        ]);

        return view('Admin/Target/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($id) {

            $target = $this->M_Base->data_where('target', 'id', $id);

            if (count($target) == 1) {

                if ($this->request->getPost('tombol')) {

                    $data_post = [
                        'target' => $this->request->getPost('target'),
                        'text' => $this->request->getPost('text'),
                        'img_petunjuk' => $this->request->getPost('img'),
                        'description' => $this->request->getPost('description'),
                        'sparator' => $this->request->getPost('sparator'),
                        'error' => $this->request->getPost('error'),
                    ];

                    if ($this->request->getPost('col_type')) {

                        if (is_array($this->request->getPost('col_type'))) {

                            $col = [];
                            foreach ($this->request->getPost('col_type') as $key => $value) {

                                if ($value == 'input') {

                                    if ($this->request->getPost('title')) {

                                        if (!array_key_exists($key, $this->request->getPost('title'))) {
                                            $this->session->setFlashdata('error', 'Data judul tidak ditemukan');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Judul kolom tidak boleh kosong');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                    if ($this->request->getPost('type')) {

                                        if (!array_key_exists($key, $this->request->getPost('type'))) {
                                            $this->session->setFlashdata('error', 'Data judul tidak ditemukan');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Judul kolom tidak boleh kosong');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                    $col[] = [
                                        'col_type' => $value,
                                        'title' => $this->request->getPost('title')[$key],
                                        'type' => $this->request->getPost('type')[$key]
                                    ];
                                } else {

                                    if ($this->request->getPost('option')) {

                                        if (!array_key_exists($key, $this->request->getPost('option'))) {
                                            $this->session->setFlashdata('error', 'Data pilihan tidak ditemukan');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Data pilihan tidak boleh kosong');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                    $col[] = [
                                        'col_type' => $value,
                                        'title' => $this->request->getPost('title')[$key],
                                        'option' => $this->request->getPost('option')[$key]
                                    ];
                                }
                            }

                            if (count($col) !== 0) {

                                $this->M_Base->data_update('target', array_merge($data_post, [
                                    'col' => json_encode($col),
                                ]), $id);

                                $this->session->setFlashdata('success', 'Data target berhasil disimpan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));

                            } else {
                                $this->session->setFlashdata('error', 'Data kolom tidak boleh kosong');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Target tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Minimal ada 1 kolom target');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Target',
                    'target' => $target[0],
                ]);

                return view('Admin/Target/edit', $data);

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

            $target = $this->M_Base->data_where('target', 'id', $id);

            if (count($target) == 1) {

                $this->M_Base->data_delete('target', $id);

                $this->session->setFlashdata('success', 'Data target berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/target');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}