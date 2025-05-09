<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Excel extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'action' => $this->request->getPost('action'),
                'games_id' => $this->request->getPost('games_id'),
            ];

            if (empty($this->request->getPost('googleauth'))) {
                $this->session->setFlashdata('error', 'Masukan Google Auth');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $admin = $this->M_Base->data_where('admin', 'username', $this->admin['username']);


                $secret_key = $admin[0]['secret_key'];

                $googleAuth = new GoogleAuthenticator();
                $checkResult = $googleAuth->authenticate($secret_key, $this->request->getPost('googleauth'));

                if ($checkResult == true) {
                    if ($data_post['action'] == 'Export') {
                
                        if ($data_post['games_id'] == 'all') {
                            $query = $this->M_Base->all_data('product');
                        } else {
                            $query = array_reverse($this->M_Base->data_where_array('product', [
                                'games_id' => $data_post['games_id'],
                            ], 'price'));
                        }
                        
                        if (count($query) !== 0) {
                            
                            $file_name = 'export-product-' . $data_post['games_id'] . '.xlsx';
                            
                            $spreadsheet = new Spreadsheet();
                            $sheet = $spreadsheet->getActiveSheet();
                            
                            $sheet->setCellValue('A1', 'ID Games');
                            $sheet->setCellValue('B1', 'ID Kategori');
                            $sheet->setCellValue('C1', 'Nama Produk');
                            $sheet->setCellValue('D1', 'Label');
                            $sheet->setCellValue('E1', 'Koin');
                            $sheet->setCellValue('F1', 'Urutan');
                            $sheet->setCellValue('G1', 'Flsah Sale');
                            $sheet->setCellValue('H1', 'Harga Modal');
                            $sheet->setCellValue('I1', 'Harga Coret');
                            $sheet->setCellValue('J1', 'Harga Member');
                            $sheet->setCellValue('K1', 'Harga Silver');
                            $sheet->setCellValue('L1', 'Harga Gold');
                            $sheet->setCellValue('M1', 'Harga Bisnis');
                            $sheet->setCellValue('N1', 'Harga Seller');
                            $sheet->setCellValue('O1', 'Provider');
                            $sheet->setCellValue('P1', 'Product Count');
                            $sheet->setCellValue('Q1', 'Combo Product');
                            $sheet->setCellValue('R1', 'Kode Produk');
                            $sheet->setCellValue('S1', 'Logo URL');
                            
                            $line = 2;
                            
                            foreach ($query as $loop) {
                                $sheet->setCellValue('A' . $line, $loop['games_id']);
                                $sheet->setCellValue('B' . $line, $loop['category_id']);
                                $sheet->setCellValue('C' . $line, $loop['product']);
                                $sheet->setCellValue('D' . $line, $loop['label']);
                                $sheet->setCellValue('E' . $line, $loop['coin']);
                                $sheet->setCellValue('F' . $line, $loop['sort']);
                                $sheet->setCellValue('G' . $line, $loop['fs']);
                                $sheet->setCellValue('H' . $line, $loop['price_modal']);
                                $sheet->setCellValue('I' . $line, $loop['price_cut']);
                                $sheet->setCellValue('J' . $line, $loop['price']);
                                $sheet->setCellValue('K' . $line, $loop['price_silver']);
                                $sheet->setCellValue('L' . $line, $loop['price_gold']);
                                $sheet->setCellValue('M' . $line, $loop['price_bisnis']);
                                $sheet->setCellValue('N' . $line, $loop['price_seller']);
                                $sheet->setCellValue('O' . $line, $loop['provider']);
                                $sheet->setCellValue('P' . $line, $loop['product_count']);
                                $sheet->setCellValue('Q' . $line, $loop['combo_product']);
                                $sheet->setCellValue('R' . $line, $loop['sku']);
                                $sheet->setCellValue('S' . $line, $loop['logo_url']);
                                
                                $line++;
                            }
                            
                            $writer = new Xlsx($spreadsheet);
                            $writer->save('assets/excel/' . $file_name);
                            
                            return redirect()->to(base_url() . '/assets/excel/' . $file_name);
                            
                        } else {
                            $this->session->setFlashdata('error', 'Tidak ada produk');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else if ($data_post['action'] == 'Import') {
                        
                        $file = $this->M_Base->upload_file($this->request->getFile('file'), 'assets/excel/');
                        
                        if ($file) {
                            
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                            $reader->setReadDataOnly(true);
                            $spreadsheet = $reader->load('assets/excel/' . $file)->getActiveSheet()->toArray(null, true, true, true);;
                            
                            if (count($spreadsheet) !== 0) {
                                
                                $no = 1;
                                
                                $add = 0;
                                $update = 0;
                                
                                foreach ($spreadsheet as $loop) {
                                    
                                    if ($no > 1) {
                                        
                                        $A = ($loop['A'] == null) ? '' : $loop['A'];
                                        $B = ($loop['B'] == null) ? '' : $loop['B'];
                                        $C = ($loop['C'] == null) ? '' : $loop['C'];
                                        $D = ($loop['D'] == null) ? '' : $loop['D'];
                                        $E = ($loop['E'] == null) ? '' : $loop['E'];
                                        $F = ($loop['F'] == null) ? '' : $loop['F'];
                                        $G = ($loop['G'] == null) ? '' : $loop['G'];
                                        $H = ($loop['H'] == null) ? '' : $loop['H'];
                                        $I = ($loop['I'] == null) ? '' : $loop['I'];
                                        $J = ($loop['J'] == null) ? '' : $loop['J'];
                                        $K = ($loop['K'] == null) ? '' : $loop['K'];
                                        $L = ($loop['L'] == null) ? '' : $loop['L'];
                                        $M = ($loop['M'] == null) ? '' : $loop['M'];
                                        $N = ($loop['N'] == null) ? '' : $loop['N'];
                                        $O = ($loop['O'] == null) ? '' : $loop['O'];
                                        $P = ($loop['P'] == null) ? '' : $loop['P'];
                                        $Q = ($loop['Q'] == null) ? '' : $loop['Q'];
                                        $R = ($loop['R'] == null) ? '' : $loop['R'];
                                        $S = ($loop['S'] == null) ? '' : $loop['S'];
                                        
                                        $product = $this->M_Base->data_where_array('product', [
                                            'provider' => $O,
                                            'sku' => $R,
                                        ]);
                                        
                                        if (count($product) == 0) {
                                            $this->M_Base->data_insert('product', [
                                                'games_id' => $A,
                                                'category_id' => $B,
                                                'product' => $C,
                                                'label' => $D,
                                                'coin' => $E,
                                                'sort' => $F,
                                                'fs' => $G,
                                                'price_modal' => $H,
                                                'price_cut' => $I,
                                                'price' => $J,
                                                'price_silver' => $K,
                                                'price_gold' => $L,
                                                'price_bisnis' => $M,
                                                'price_seller' => $N,
                                                'provider' => $O,
                                                'product_count' => $P,
                                                'combo_product' => $Q,
                                                'sku' => $R,
                                                'logo_url' => $S,
                                            ]);
                                            
                                            $add++;
                                            
                                        } else {
                                            $this->M_Base->data_update('product', [
                                                'games_id' => $A,
                                                'category_id' => $B,
                                                'product' => $C,
                                                'label' => $D,
                                                'coin' => $E,
                                                'sort' => $F,
                                                'fs' => $G,
                                                'price_modal' => $H,
                                                'price_cut' => $I,
                                                'price' => $J,
                                                'price_silver' => $K,
                                                'price_gold' => $L,
                                                'price_bisnis' => $M,
                                                'price_seller' => $N,
                                                'provider' => $O,
                                                'product_count' => $P,
                                                'combo_product' => $Q,
                                                'sku' => $R,
                                                'logo_url' => $S,
                                            ], $product[0]['id']);
                                            
                                            $update++;
                                        }
                                    }
                                    
                                    $no++;
                                }
                                
                                $this->session->setFlashdata('success', $add . ' ditambahkan dan ' . $update . ' diupdate');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                
                            } else {
                                $this->session->setFlashdata('error', 'Tidak ada baris di dalam file');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'File excel gagal diupload');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                } else {
                    $this->session->setFlashdata('error', 'Kode Google Auth Salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }
        
        $games = [];
        
        foreach (array_reverse($this->M_Base->all_data_order('games', 'games')) as $loop) {
            
            $games[] = array_merge($loop, [
                'total_product' => $this->M_Base->data_count('product', [
                    'games_id' => $loop['id'],
                ]),
            ]);
        }
        
    	$data = array_merge($this->base_data, [
    		'title' => 'Import / Export',
    		'games' => $games,
    	]);

        return view('Admin/Excel/index', $data);
    }
}