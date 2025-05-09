<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Topup extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Topup',
            'topup' => $this->M_Base->all_data('topup'),
    	]);

        return view('Admin/Topup/index', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $topup = $this->M_Base->data_where('topup', 'id', $id);

            if (count($topup) === 1) {

                if ($this->request->getPost('tombol')) {
                    
                    if (empty($this->request->getPost('googleauth'))) {
                        $this->session->setFlashdata('error', 'Masukan Google Auth');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
        
                    $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);
        
        
                    $secret_key = $admin[0]['secret_key'];
        
                    $googleAuth = new GoogleAuthenticator();
                    $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
        
                    if ($checkResult == true) {
                        $this->M_Base->data_update('topup', [
                            'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                            'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                            'amount' => addslashes(trim(htmlspecialchars($this->request->getPost('amount')))),
                            'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                        ], $id);

                        $this->session->setFlashdata('success', 'Data topup berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Topup',
                    'topup' => $topup[0],
                ]);

                return view('Admin/Topup/edit', $data);
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
            $topup = $this->M_Base->data_where('topup', 'id', $id);

            if (count($topup) === 1) {
                $this->M_Base->data_delete('topup', $id);

                $this->session->setFlashdata('success', 'Data topup berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/topup');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function detail($topup_id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            $topup = $this->M_Base->data_where('topup', 'topup_id', $topup_id);

            if (count($topup) === 1) {

                echo '
                <table class="table table-white table-striped">
                    <tr>
                        <th>Topup ID</th>
                        <td>'.$topup[0]['topup_id'].'</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>'.$topup[0]['username'].'</td>
                    </tr>
                    <tr>
                        <th>Metode</th>
                        <td>'.$topup[0]['method'].'</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp '.number_format($topup[0]['amount'],0,',','.').'</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>'.$topup[0]['status'].'</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>'.$topup[0]['date_create'].'</td>
                    </tr>
                </table>
                ';
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function accept($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
                $topup = $this->M_Base->data_where('topup', 'id', $id);

                if (count($topup) === 1) {

                    if ($this->request->getPost('tombol')) {


                    if ($topup[0]['status'] === 'Pending') {

                        $users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);

                        if (count($users) === 1) {
                            if (empty($this->request->getPost('googleauth'))) {
                                $this->session->setFlashdata('error', 'Masukan Google Auth');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                
                            $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);
                
                
                            $secret_key = $admin[0]['secret_key'];
                
                            $googleAuth = new GoogleAuthenticator();
                            $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));
                
                            if ($checkResult == true) {
                                $this->M_Base->data_update('topup', [
                                    'status' => 'Success',
                                ], $topup[0]['id']);
    
                                $this->M_Base->data_update('users', [
                                    'balance' => $users[0]['balance'] + $topup[0]['amount'],
                                ], $users[0]['id']);
    
                                $this->session->setFlashdata('success', 'Topup berhasil diterima');
                                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/topup');
                            } else {
                                $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Username penerima tidak ditemukan');
                            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/topup/accept/' . $id);
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Data topup sudah berstatus ' . $topup[0]['status']);
                        return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/topup/accept/' . $id);
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Terima Topup',
                    'topup' => $topup[0],
                ]);

                return view('Admin/Topup/terima', $data);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
        }
    }
}