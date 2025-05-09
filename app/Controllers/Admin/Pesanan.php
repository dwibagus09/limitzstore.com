<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dolondro\GoogleAuthenticator\GoogleAuthenticator;

class Pesanan extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Pesanan',
            'orders' => $this->M_Base->all_data('orders'),
    	]);

        /*$length = 25;
        $start = 0;
        $query = $this->M_Base->data_where_offset('orders', 'id is NOT NULL', 'id', $length, $start);
        echo "pre>"; print_r($query); die;*/

        return view('Admin/Pesanan/index', $data);
    }

    public function ajax_load_data(){
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }else{
            $draw=$this->request->getPost('draw');
            $length=$this->request->getPost('length');
            $start=$this->request->getPost('start');
            $search=$this->request->getPost('search');
            $search=$search["value"];
            $total=$this->M_Base->data_count("orders");

            $output=array();
            $output['draw']=$draw;
            $output['recordsTotal']=$output['recordsFiltered']=$total;
            $output['data']=array();

            if(empty($length)){
                $length = 25;
            }
            if(empty($start)){
                $start = 0;
            }

            if($search!=""){
                $query=$this->M_Base->data_search_six_fields('orders',['product','method','provider','order_id','user_id','status'], $search, 'id','DESC', $length, $start);
            }else{
                $query = $this->M_Base->data_where_offset_custom('orders', 'id is NOT NULL', 'id', 'DESC', $length, $start);
            }

            if($search!=""){
                $query=$this->M_Base->data_search_six_fields('orders',['product','method','provider','order_id','user_id','status'], $search, 'id','DESC', $length, $start);
                $output['recordsTotal']=$output['recordsFiltered']=count($query);
            }

            $queue_no=$start+1;
            foreach ($query as $loop) {
                $str_check = '<input type="checkbox" class="item-checkbox" name="delete[]" value="'.$loop['id'].'">';
                $order_id = '<b class="cursor-pointer" onclick="detail(\''.$loop['order_id']. '\');">'.$loop['order_id'].'</b>';
                if (!empty($loop['zone_id']) AND $loop['zone_id'] != 1) {
                    $uid =  $loop['user_id'] . ' ('.$loop['zone_id'].')';
                } else {
                    $uid = $loop['user_id'];
                }
                $str_action_edit = '<a href="'.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/edit/'.$loop['id'].'" class="btn btn-primary btn-sm">&ensp;Edit&ensp;</a>';
                $str_action_check = '<button type="button" onclick="check(\''.$loop['order_id'].'\');" class="btn btn-warning btn-sm">Check</button>';
                $str_action_delete = '<button type="button" onclick="hapus(\''.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/delete/'.$loop['id'].'\');" class="btn btn-danger btn-sm">Hapus</button>';
                $str_action_reorder = '<button type="button" onclick="reorder(\''.$loop['order_id'].'\');" class="btn btn-success btn-sm">Pesan Ulang</button>';
                if($loop['status'] == "Processing" || $loop['status'] == "Refunded"){
                    $str_actions = $str_action_check.' '.$str_action_reorder.' '.$str_action_edit.' '.$str_action_delete;   
                }else if($loop['status'] == "Success"){
                    $str_actions = $str_action_check.' '.$str_action_edit.' '.$str_action_delete;
                }else if($loop['status'] == "Canceled" || $loop['status'] == "Expired" || $loop['status'] == "Pending"){
                    $str_actions = $str_action_reorder.' '.$str_action_edit.' '.$str_action_delete;
                }else{
                    $str_actions = $str_action_edit.' '.$str_action_delete;
                }
                $output['data'][]=array($str_check,$queue_no,$order_id,$loop['product']."<br/>".$uid,$loop['method'],$loop['provider'],$loop['status'],$str_actions);
            $queue_no++;
            }

            echo json_encode($output);

        }
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $orders = $this->M_Base->data_where('orders', 'id', $id);
            if (count($orders) === 1) {

                if ($this->request->getPost('tombol')) {
                    $this->M_Base->data_update('orders', [
                        'username' => $this->request->getPost('username'),
                        'wa' => $this->request->getPost('wa'),
                        'product' => $this->request->getPost('product'),
                        'method' => $this->request->getPost('method'),
                        'user_id' => $this->request->getPost('user_id'),
                        'zone_id' => $this->request->getPost('zone_id'),
                        'nickname' => $this->request->getPost('nickname'),
                        'status' => $this->request->getPost('status'),
                        'ket' => $this->request->getPost('ket'),
                    ], $id);
                    
                    if ($this->request->getPost('status') == 'Success') {
                        
                        $wa_success = $this->M_Base->u_get('wa_success');
                        if (!empty($wa_success)) {
                            
                            $this->M_Wa->send([
                                'token' => $this->M_Base->u_get('wa_fonnte'),
                                'target' => $this->request->getPost('wa') . ',' . $this->M_Base->u_get('wa_admin'),
                                'message' => str_replace([
                                    '#order_id#',
                                    '#product#',
                                    '#price#',
                                    '#user_id#',
                                    '#zone_id#',
                                    '#nickname#',
                                    '#method#',
                                    '#games#',
                                    '#ket#',
                                ], [
                                    $orders[0]['order_id'],
                                    $this->request->getPost('product'),
                                    $orders[0]['price'],
                                    $this->request->getPost('user_id'),
                                    $this->request->getPost('zone_id'),
                                    $this->request->getPost('nickname'),
                                    $this->request->getPost('method'),
                                    $orders[0]['games'],
                                    $this->request->getPost('ket'),
                                ], $wa_success),
                            ]);
                        }
                    }

                    $this->session->setFlashdata('success', 'Data pesanan berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Pesanan',
                    'orders' => $orders[0],
                ]);

                return view('Admin/Pesanan/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function edit_history($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $orders = $this->M_Base->data_where('orders_history', 'id', $id);
            if (count($orders) === 1) {

                if ($this->request->getPost('tombol')) {
                    $this->M_Base->data_update('orders_history', [
                        'username' => $this->request->getPost('username'),
                        'wa' => $this->request->getPost('wa'),
                        'product' => $this->request->getPost('product'),
                        'method' => $this->request->getPost('method'),
                        'user_id' => $this->request->getPost('user_id'),
                        'zone_id' => $this->request->getPost('zone_id'),
                        'nickname' => $this->request->getPost('nickname'),
                        'status' => $this->request->getPost('status'),
                        'ket' => $this->request->getPost('ket'),
                    ], $id);
                    
                    if ($this->request->getPost('status') == 'Success') {
                        
                        $wa_success = $this->M_Base->u_get('wa_success');
                        if (!empty($wa_success)) {
                            
                            $this->M_Wa->send([
                                'token' => $this->M_Base->u_get('wa_fonnte'),
                                'target' => $this->request->getPost('wa') . ',' . $this->M_Base->u_get('wa_admin'),
                                'message' => str_replace([
                                    '#order_id#',
                                    '#product#',
                                    '#price#',
                                    '#user_id#',
                                    '#zone_id#',
                                    '#nickname#',
                                    '#method#',
                                    '#games#',
                                    '#ket#',
                                ], [
                                    $orders[0]['order_id'],
                                    $this->request->getPost('product'),
                                    $orders[0]['price'],
                                    $this->request->getPost('user_id'),
                                    $this->request->getPost('zone_id'),
                                    $this->request->getPost('nickname'),
                                    $this->request->getPost('method'),
                                    $orders[0]['games'],
                                    $this->request->getPost('ket'),
                                ], $wa_success),
                            ]);
                        }
                    }

                    $this->session->setFlashdata('success', 'Data pesanan berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Pesanan',
                    'orders' => $orders[0],
                ]);

                return view('Admin/Pesanan/edit', $data);
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
            $orders = $this->M_Base->data_where('orders', 'id', $id);

            if (count($orders) === 1) {
                $this->M_Base->data_delete('orders', $id);

                $this->session->setFlashdata('success', 'Data pesanan berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function delete_history($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $orders = $this->M_Base->data_where('orders_history', 'id', $id);

            if (count($orders) === 1) {
                $this->M_Base->data_delete('orders_history', $id);

                $this->session->setFlashdata('success', 'Data pesanan berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function deleteall(){
        $deleteIds = $this->request->getPost('delete');
        $action = $this->request->getPost('action');

        if (!empty($deleteIds)) {
            foreach ($deleteIds as $id) {
                $orders = $this->M_Base->data_where('orders', 'id', $id);
                if (count($orders) === 1) {
                    $this->M_Base->data_delete('orders', $id);
                } else {

                    $orders = $this->M_Base->data_where('orders_history', 'id', $id);
                    if(count($orders) === 1){
                        $this->M_Base->data_delete('orders_history', $id);
                    }else{
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                }
            }
            $this->session->setFlashdata('success', 'Pesanan berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Gagal hapus Pesanan');
        }

        if($action == "order_history"){
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan/history');
        }else{
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
        }

    }

    public function detail($order_id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            $orders = $this->M_Base->data_where('orders', 'order_id', $order_id);
            if(empty($orders)){
                $orders = $this->M_Base->data_where('orders_history', 'order_id', $order_id);
            }
            if (count($orders) === 1) {

                if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
                    $target = $orders[0]['user_id'] . ' (' . $orders[0]['zone_id'] . ')';
                } else {
                    $target = $orders[0]['user_id'];
                }

                echo '
                <table class="table table-white table-striped">
                    <tr>
                        <th>No Transaksi</th>
                        <td>'.$orders[0]['order_id'].'</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>'.$orders[0]['username'].'</td>
                    </tr>
                    <tr>
                        <th>Whatsapp</th>
                        <td>'.$orders[0]['wa'].'</td>
                    </tr>
                    <tr>
                        <th>Produk</th>
                        <td>'.$orders[0]['games'].' - '.$orders[0]['product'].'</td>
                    </tr>
                    <tr>
                        <th>ID Player</th>
                        <td>'.$target.'</td>
                    </tr>
                    <tr>
                        <th>Nickname</th>
                        <td>'.$orders[0]['nickname'].'</td>
                    </tr>
                    <tr>
                        <th>Voucher</th>
                        <td>Rp '.number_format($orders[0]['diskon'],0,',','.').' ('.$orders[0]['voucher'].')</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp '.number_format($orders[0]['price'],0,',','.').'</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>'.$orders[0]['status'].'</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>'.$orders[0]['ket'].'</td>
                    </tr>
                    <tr>
                        <th>Metode</th>
                        <td>'.$orders[0]['method'].'</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>'.$orders[0]['date_create'].'</td>
                    </tr>
                </table>
                ';
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function refund(){
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        $data = array_merge($this->base_data, [
            'title' => 'Log Refund',
            'logs' => $this->M_Base->all_data('logs'),
        ]);

        return view('Admin/Pesanan/refund', $data);

    }


    public function ajax_load_refund(){
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }else{
            $draw=$this->request->getPost('draw');
            $length=$this->request->getPost('length');
            $start=$this->request->getPost('start');
            $search=$this->request->getPost('search');
            $search=$search["value"];
            $total=$this->M_Base->data_count("logs");

            $output=array();
            $output['draw']=$draw;
            $output['recordsTotal']=$output['recordsFiltered']=$total;
            $output['data']=  array();

            if(empty($length)){
                $length = 25;
            }
            if(empty($start)){
                $start = 0;
            }

            if($search!=""){
                $query=$this->M_Base->data_search_three_fields('logs',['ref_id','note','created'], $search, 'id','DESC', $length, $start);
            }else{
                $query = $this->M_Base->data_where_offset_custom('logs', 'id is NOT NULL', 'id', 'DESC', $length, $start);
            }

            if($search!=""){
                $query=$this->M_Base->data_search_three_fields('logs',['ref_id','note','created'], $search, 'id','DESC', $length, $start);
                $output['recordsTotal']=$output['recordsFiltered']=count($query);
            }

            $queue_no=$start+1;
            foreach ($query as $loop) {
                //$date_created = date('d/m/Y H:i:s', $loop['created']);
                $output['data'][]=array($queue_no,$loop['created'],$loop['ref_id'],$loop['note']);
            $queue_no++;
            }

            echo json_encode($output);

        }
    }


    public function history() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        $data = array_merge($this->base_data, [
            'title' => 'Riwayat Pesanan',
            'orders' => $this->M_Base->all_data('orders_history'),
        ]);

        return view('Admin/Pesanan/history', $data);
    }


    public function ajax_load_history(){
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }else{
            $draw=$this->request->getPost('draw');
            $length=$this->request->getPost('length');
            $start=$this->request->getPost('start');
            $search=$this->request->getPost('search');
            $search=$search["value"];
            $total=$this->M_Base->data_count("orders_history");

            $output=array();
            $output['draw']=$draw;
            $output['recordsTotal']=$output['recordsFiltered']=$total;
            $output['data']=array();

            if(empty($length)){
                $length = 25;
            }
            if(empty($start)){
                $start = 0;
            }

            if($search!=""){
                $query=$this->M_Base->data_search_six_fields('orders_history',['product','method','provider','order_id','user_id','status'], $search, 'id','DESC', $length, $start);
            }else{
                $query = $this->M_Base->data_where_offset_custom('orders_history', 'id is NOT NULL', 'id', 'DESC', $length, $start);
            }

            if($search!=""){
                $query=$this->M_Base->data_search_six_fields('orders_history',['product','method','provider','order_id','user_id','status'], $search, 'id','DESC', $length, $start);
                $output['recordsTotal']=$output['recordsFiltered']=count($query);
            }

            $queue_no=$start+1;
            foreach ($query as $loop) {
                $str_check = '<input type="checkbox" class="item-checkbox" name="delete[]" value="'.$loop['id'].'">';
                $order_id = '<b class="cursor-pointer" onclick="detail(\''.$loop['order_id']. '\');">'.$loop['order_id'].'</b>';
                if (!empty($loop['zone_id']) AND $loop['zone_id'] != 1) {
                    $uid =  $loop['user_id'] . ' ('.$loop['zone_id'].')';
                } else {
                    $uid = $loop['user_id'];
                }
                $str_action_edit = '<a href="'.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/edit-history/'.$loop['id'].'" class="btn btn-primary btn-sm">Edit</a>';
                $str_action_check = '<button type="button" onclick="check(\''.$loop['order_id'].'\');" class="btn btn-warning btn-sm">Check</button>';
                $str_action_reorder = '<button type="button" onclick="reorder(\''.$loop['order_id'].'\');" class="btn btn-success btn-sm">Pesan Ulang</button>';
                $str_action_delete = '<button type="button" onclick="hapus(\''.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/delete-history/'.$loop['id'].'\');" class="btn btn-danger btn-sm">Hapus</button>';
                if($loop['status'] == "Processing" || $loop['status'] == "Refunded" || $loop['status'] == "Success"){
                    $str_actions = $str_action_check.' '.$str_action_edit.' '.$str_action_delete;   
                }else{
                    $str_actions = $str_action_edit.' '.$str_action_delete;
                }
                $output['data'][]=array($str_check,$queue_no,$order_id,$loop['product']."<br/>".$uid,$loop['method'],$loop['provider'],$loop['status'],$str_actions);
            $queue_no++;
            }

            echo json_encode($output);

        }
    }

    public function export() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            $status = $this->request->getPost('status');
            $daterange = explode(' - ', $this->request->getPost('daterange'));
            $start_date = fix_date($daterange[0]);
            $end_date = fix_date($daterange[1]);
            $query = $this->M_Base->data_where_array('orders_history', 
                ['status' => $status, 'date_create >=' => $start_date, 'date_create <=' => $end_date]
            );

            //echo "<pre>"; print_r($query); die;
            if (count($query) !== 0) {
                $txt_startdate = str_replace(' ', '', $start_date);
                $txt_startdate = preg_replace('/[^A-Za-z0-9\-]/', '', $txt_startdate);
                $txt_end_date = str_replace(' ', '', $end_date);
                $txt_end_date = preg_replace('/[^A-Za-z0-9\-]/', '', $txt_end_date);
                $file_name = 'export-order-' . $txt_startdate .'-'. $txt_end_date . '.xlsx';

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $sheet->setCellValue('A1', 'Invoice Id');
                $sheet->setCellValue('B1', 'Nama Games');
                $sheet->setCellValue('C1', 'Tanggal');
                $sheet->setCellValue('D1', 'Metode');
                $sheet->setCellValue('E1', 'Username');
                $sheet->setCellValue('F1', 'No Whatsapp');
                $sheet->setCellValue('G1', 'Email');
                $sheet->setCellValue('H1', 'Tipe');
                $sheet->setCellValue('I1', 'Level Account');
                $sheet->setCellValue('J1', 'Id Produk');
                $sheet->setCellValue('K1', 'Produk');
                $sheet->setCellValue('L1', 'Harga Produk');
                
                $line = 2;
                foreach ($query as $loop) {
                    $level = $this->get_info_user($loop['username'], 'level');
                    $type  = "Public";
                    if($level == "Bisnis" || $level == "Silver" || $level == "Gold"){
                        $type  = "Reseller";
                    }
                    if($level == "Member"){
                        $type  = "Member";
                    }
                    $selling_price = $loop['price'] - $loop['fee']; 
                    $sheet->setCellValue('A' . $line, $loop['order_id']);
                    $sheet->setCellValue('B' . $line, $loop['games']);
                    $sheet->setCellValue('C' . $line, $loop['date_create']);
                    $sheet->setCellValue('D' . $line, $loop['method']);
                    $sheet->setCellValue('E' . $line, $loop['username']);
                    $sheet->setCellValue('F' . $line, $loop['wa']);
                    $sheet->setCellValue('G' . $line, $loop['email']);
                    $sheet->setCellValue('H' . $line, $type);
                    $sheet->setCellValue('I' . $line, $level);
                    $sheet->setCellValue('J' . $line, $loop['product_id']);
                    $sheet->setCellValue('K' . $line, $loop['product']);
                    $sheet->setCellValue('L' . $line, $selling_price);
                    
                    $line++;
                }
                
                $writer = new Xlsx($spreadsheet);
                $writer->save('assets/excel/' . $file_name);
                
                return redirect()->to(base_url() . '/assets/excel/' . $file_name);
            }else{
                $this->session->setFlashdata('error', 'Tidak ada data pesanan untuk di export');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }


        if ($this->request->getPost('status')) {
            $status = $this->request->getPost('status');
        }else{
            $status = "Success";
        }

        if ($this->request->getPost('daterange')) {
            $daterange = explode(' - ', $this->request->getPost('daterange'));

            $end_date = fix_date($daterange[0]);
            $start_date = fix_date($daterange[1]);

        } else {
            $end_date = date('Y-m-d H:i:s', time()-60*60*24*1);
            $start_date = date('Y-m-d 23:59:59');
        }

        $opt_status = array(
            'Success' => 'Success',
            'Pending' => 'Pending',
            'Processing' => 'Processing',
            'Canceled' => 'Canceled'
        );

        $data = array_merge($this->base_data, [
            'title' => 'Export Riwayat Pesanan',
            'date_range' => reverse_date($end_date,$start_date),
            'opt_status' => $opt_status,
            'status' => $status
        ]);

        return view('Admin/Pesanan/export', $data);
    }

    private function get_info_user($username=NULL, $data_type=NULL){
        $result = "";
        $query = $this->M_Base->data_where_array('users', 
            ['username' => $username]
        );
        if(count($query) > 0){
            if($data_type){
                $result = $query[0][$data_type];
            }
        }
        return $result;
    }
    
    public function update_status($order_id){
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            $orders = $this->M_Base->data_where('orders', 'order_id', $order_id);
            if(empty($orders)){
                $orders = $this->M_Base->data_where('orders_history', 'order_id', $order_id);
            }
            if(count($orders) === 1){
                if($orders[0]['status'] != "Success"){
                    $status = "Success";
                    $ket = $orders[0]['ket'];
            	    $this->M_Base->data_update('orders_history', [
                        'status' => $status,
                        'ket' => $ket,
                    ], $orders[0]['id']);
                    
                    $this->M_Base->status($orders[0], $status, $ket);
                }
            }
            $this->session->setFlashdata('success', 'Pesanan berhasil diupdate');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
        }
    }
    
    public function reorder($order_id){
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            $orders = $this->M_Base->data_where('orders', 'order_id', $order_id);
            if(empty($orders)){
                $orders = $this->M_Base->data_where('orders_history', 'order_id', $order_id);
            }
            if(count($orders) === 1){
                $product = $this->M_Base->data_where('product', 'id', $orders[0]['product_id']);
                if(count($product) === 1){
                    switch ($orders[0]['provider']) {
                        case 'VocaGame':
                            $exp_sku = explode('.', $product[0]['sku']);
                            $result = $this->M_Voca->trx('POST', [
                                'productId' => $exp_sku[0],
                                'productItemId' => $exp_sku[1],
                                'reference' => $orders[0]['order_id'],
                                'data' => [
                                    'userId' => $orders[0]['user_id'],
                                    'zoneId' => $orders[0]['zone_id'],
                                ],
                                'callbackUrl' => base_url() . '/sistem/callback/vocagame',
                            ], 'transaction', 'transaction/' . $orders[0]['order_id'], [
                                'merchant' => $this->M_Base->u_get('voca_merchant'),
                                'secret' => $this->M_Base->u_get('voca_secret'),
                                'key' => $this->M_Base->u_get('voca_key'),
                            ]);
                            if ($result) {
                                if (array_key_exists('statusCode', $result)) {
                                    $id_provider = '';
                                    $ket = 'Result : ' . $result['message'];
                                } else {
                                    $status = 'Processing';
                                    $id_provider = $result['data']['invoiceId'];
                                    $ket = $result['data']['sn'];
                                }
                            } else {
                                $id_provider = '';
                                $ket = 'Gagal terkoneksi ke VocaGame';
                            }
                            break;
                        case 'DF':
                            $df_user = $this->M_Base->u_get('digi-user');
                            $df_key = $this->M_Base->u_get('digi-key');
                            $post_data = json_encode([
                                'username' => $df_user,
                                'buyer_sku_code' => $product[0]['sku'],
                                'customer_no' => $orders[0]['zone_id'].''.$orders[0]['user_id'],
                                'ref_id' => $orders[0]['order_id'],
                                'sign' => md5($df_user.$df_key.$order_id),
                            ]);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                            $result = curl_exec($ch);
                            $result = json_decode($result, true);
                            if (isset($result['data'])) {
                                if ($result['data']['status'] == 'Gagal') {
                                    $id_provider = '';
                                    $ket = $result['data']['message'];
                                } else {
                                    $id_provider = '';
                                    if($result['data']['sn'] !== ''){
                                        $status = 'Success';
                                        $ket = $result['data']['sn'];
                                    }else{
                                        $ket = $result['data']['message'];
                                    }
                                    echo json_encode(['success' => true]);
                                }
                            } else {
                                $id_provider = '';
                                $ket = 'Failed Order';
                            }

                            break;
                        default:
                            $status = 'Processing';
                            $ket = 'Layanan Reorder tidak tersedia untuk Provider ini.';
                            break;
                    }

                    // UPDATE ORDER
                    $this->M_Base->data_update('orders_history', [
                        'status' => $status,
                        'id_provider' => $id_provider,
                        'ket' => $ket,
                    ], $orders[0]['id']);

                    $this->M_Base->data_update('orders', [
                        'status' => $status,
                        'id_provider' => $id_provider,
                        'ket' => $ket,
                    ], $orders[0]['id']);

                    $this->session->setFlashdata('success', 'Pesanan berhasil dibuat');
                    return redirect()->to(base_url() . '/payment/' . $order_id);
                }else{
                    $this->session->setFlashdata('error', 'Produk tidak ditemukan');
                    return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
                }
                
            }else{

                $this->session->setFlashdata('error', 'Pesanan tidak ditemukan');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
            }
        }
    }
    
    public function check($order_id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else {
            $orders = $this->M_Base->data_where('orders', 'order_id', $order_id);
            if(empty($orders)){
                $orders = $this->M_Base->data_where('orders_history', 'order_id', $order_id);
            }
            if (count($orders) === 1) {

                if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
                    $target = $orders[0]['user_id'] . ' (' . $orders[0]['zone_id'] . ')';
                } else {
                    $target = $orders[0]['user_id'];
                }

                $this->check_transaction_order($orders[0]);

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    /*private function check_transaction_order($order){
        if(!empty($order)){
            switch ($order['provider']) {
                case 'VocaGame':
                    // Call Check Transaction Detail
                    //$invoiceId = 'VBMLBBXX1908D0A6DB3C8C1CD9812E558';
                    //$reference = 'XXXTESBJG184107072024';
                    //$invoiceId = 'VBMLBBXX19113A8730A13FB0ED5C83E48';
                    //$reference = 'INVBG10468702082024';
                    //$invoiceId = 'VBMLBBXX1911725859417A351A1757745';
                    //$reference = 'XXXTESBJG184103082024';
                    
                    $keterangan = $order['ket'];
                    if (($pos = strpos($keterangan, "Ref:")) !== FALSE) {
                        $invoiceId = substr($keterangan, $pos+4);
                    }else{
                        if(!empty($order['order_id_provider'])){
                            $invoiceId = $order['order_id_provider'];
                        }else{
                            if(!empty($order['order_id_reference'])){
                                $arr_reference = json_decode($order['order_id_reference']);
                                if(count($arr_reference) > 1){
                                    foreach($arr_reference as $v){
                                        $invoiceId = $v;
                                    }
                                }else{
                                    $invoiceId = $arr_reference[0];
                                }
                            }
                        }
                    }
                    
                    //Sample Replacement Invoice ID
                    //$invoiceId = "VBMLBBXX18F4902F0F0369F5D90103D1C";
                    if(!empty($invoiceId)){
                        $invoiceId = $string = str_replace(' ', '', $invoiceId);
                        $result = $this->M_Voca->check_trx('GET','transaction', $invoiceId ,'transaction/'.$invoiceId.'/detail', [
                            'merchant' => $this->M_Base->u_get('voca_merchant'),
                            'secret' => $this->M_Base->u_get('voca_secret'),
                            'key' => $this->M_Base->u_get('voca_key'),
                        ]);
                        if(empty($result)){
                            $result = array(
                                'message' => 'Permintaan tidak ditemukan.',
                                'data'    => array(),
                            );
                        }
                    }else{
                        $result = array(
                            'message' => 'Data ini tidak menyimpan nomor referensi transaksi.',
                            'data'    => array(),
                        );
                    }
                    break;
                case 'DF': 
                    $df_user = $this->M_Base->u_get('digi-user');
                    $df_key = $this->M_Base->u_get('digi-key');

                    // Method QRIS DANA
                    $id_sku_product = "15.1177";
                    $customer_no = "95704162412806";
                    $order_id_reference = "INVBG9531626062024"; 

                    $post_data = json_encode([
                        'commands' => "checkstatus", 
                        'username' => $df_user,
                        'buyer_sku_code' => $id_sku_product,
                        'customer_no' => $customer_no,
                        'ref_id' => $order_id_reference,
                        'sign' => md5($df_user.$df_key.$order_id_reference),
                    ]);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                    $result = curl_exec($ch);
                    $result = json_decode($result, true);
                    
                    echo "<pre>"; print_r($result); die;
                    break;
                case 'AG':
                    $result = array();
                    break;
                default:
                    $result = Array(
                            'message' => 'Provider belum tersedia untuk checking...',
                            'error' => 'Provider not Found!'
                        );
                    break;
            }

        }else{

            $result = Array(
                    'message' => 'Data pesanan tidak ditemukan',
                    'error' => 'Empty Data'
            );
        }
        
        if($result['message'] == "Success"){
            if($result['data']){
                $data = $result['data'];
                $str_display_result = '<table class="table table-white table-striped">';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Invoice ID:</td><td>'.$data['reference'] .'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Invoice ID Provider:</td><td>'.$data['invoiceId'] .'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Produk:</td><td>'.$data['productItemName'].'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Game:</td><td>'.$data['productName'].'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Target User:</td><td>'.$data['data']['userId']." ".$data['data']['zoneId'].'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>SN:</td><td>'.$data['sn'].'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Total:</td><td>'.$data['totalAmount'].'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Tgl Trx:</td><td>'.$data['trxDate'].'</td>';
                $str_display_result .= '</tr>';
                $str_display_result .= '<tr>';
                $str_display_result .= '<td>Status:</td><td>'.$data['status'].'</td>';
                $str_display_result .= '</tr>';
                if($order['status'] == "Success"){
                    // Do Nothing
                }else{
                    if($data['status'] == "Success"){ 
                        $str_display_result .= '<tr>';
                        $str_display_result .= '<td colspan="2" align="center"><button class="btn btn-warning" onclick="update_status(\''.$data['reference'].'\')">Update Status Pesanan</button></td>';
                        $str_display_result .= '</tr>';
                    }
                }
                $str_display_result .= '</table>';
            }else{
                $str_display_result = '<table class="table table-white table-striped">';
                $str_display_result .= '<tr><td>Tidak Ada Data</td></tr>';
                $str_display_result .= '</table>';
            }

        }else{

            $str_display_result = '<table class="table table-white table-striped">';
            $str_display_result .= '<tr><td>'.$result['message'].'</td></tr>';
            $str_display_result .= '</table>';
       }

       echo $str_display_result; 
    }*/
    
    private function check_transaction_order($order){
        if(!empty($order)){
            $data_result = array();
            switch ($order['provider']) {
                case 'VocaGame':
                    // Sample Call Transaction
                    /*$result = $this->M_Voca->trx('POST', [
                        'productId' => '15',
                        'productItemId' => '1818',
                        'reference' => 'XXXTESBJG184103082024',
                        'data' => [
                            'userId' => '47194237',
                            'zoneId' => '2079',
                        ],
                        'callbackUrl' => base_url() . '/sistem/callback_vocagame',
                     ], 'transaction', 'transaction/' . 'XXXTESBJG184103082024', [
                        'merchant' => $this->M_Base->u_get('voca_merchant'),
                        'secret' => $this->M_Base->u_get('voca_secret'),
                        'key' => $this->M_Base->u_get('voca_key'),
                    ]);*/

                    // Call Check Transaction Detail
                    //$invoiceId = 'VBMLBBXX1908D0A6DB3C8C1CD9812E558';
                    //$reference = 'XXXTESBJG184107072024';
                    //$invoiceId = 'VBMLBBXX19113A8730A13FB0ED5C83E48';
                    //$reference = 'INVBG10468702082024';
                    //$invoiceId = 'VBMLBBXX1911725859417A351A1757745';
                    //$reference = 'XXXTESBJG184103082024';
                    
                    $keterangan = $order['ket'];
                    if (($pos = strpos($keterangan, "Ref:")) !== FALSE) {
                        $invoiceId = substr($keterangan, $pos+4);
                    }else{
                        if(!empty($order['order_id_provider'])){
                            $invoiceId = $order['order_id_provider'];
                        }else{
                            if(!empty($order['order_id_reference'])){
                                $arr_reference = json_decode($order['order_id_reference']);
                                if(count($arr_reference) > 1){
                                    foreach($arr_reference as $v){
                                        $invoiceId = $v;
                                    }
                                }else{
                                    $invoiceId = $arr_reference[0];
                                }
                            }
                        }
                    }
                    //Sample Replacement INVOICE ID ORDER
                    //$invoiceId = "VBMLBBXX18F4902F0F0369F5D90103D1C";
                    if(!empty($invoiceId)){
                        $invoiceId = $string = str_replace(' ', '', $invoiceId);
                        $result = $this->M_Voca->check_trx('GET','transaction', $invoiceId ,'transaction/'.$invoiceId.'/detail', [
                            'merchant' => $this->M_Base->u_get('voca_merchant'),
                            'secret' => $this->M_Base->u_get('voca_secret'),
                            'key' => $this->M_Base->u_get('voca_key'),
                        ]);
                        if(!empty($result)){
                            if($result['message'] == "Success"){
                                if($result['data']){
                                    $data = $result['data'];
                                    $data_result = array(
                                        "order_id_ref" => $data['reference'],
                                        "provider_name" => "VocaGame",
                                        "invoice_id" => $data['invoiceId'],
                                        "product" => $data['productItemName'],
                                        "game" => $data['productName'],
                                        "target" => $data['data']['userId'].' '.$data['data']['zoneId'],
                                        "sn" => $data['sn'],
                                        "amount" => $data['totalAmount'],
                                        "trxDate" => $data['trxDate'],
                                        "status" => $data['status']
                                    );
                                }else{
                                    $result = array(
                                        'message' => 'Data tidak ada.',
                                    );
                                }
                            }else{
                                $result = array(
                                    'message' => $result['message'],
                                );
                            }
                        }else{
                            $result = array(
                                'message' => 'Permintaan tidak ditemukan.',
                            );
                        }
                    }else{
                        $result = array(
                            'message' => 'Data ini tidak menyimpan nomor referensi transaksi.',
                        );
                    }
                    break;
                case 'DF': 
                    $df_user = $this->M_Base->u_get('digi-user');
                    $df_key = $this->M_Base->u_get('digi-key');

                    // Sample Call Transaction
                    /*$id_sku_product = "";
                    $customer_no = "471942372079";
                    $order_id_reference = "XXXTESBJG114108072024";
                    $post_data = json_encode([
                        'username' => $df_user,
                        'buyer_sku_code' => $id_sku_product,
                        'customer_no' => $customer_no,
                        'ref_id' => $order_id_reference,
                        'sign' => md5($df_user.$df_key.$order_id_reference),
                    ]);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                    $result = curl_exec($ch);
                    $result = json_decode($result, true);*/

                    // COMMANDS
                    /*
                    "checkstatus" = Seller Pasca Bayar >> Check Status
                    "inq-pasca"   = Seller Pasca Bayar dan Buyer >> Check Tagihan
                    "topup"       = Seller Prabayar
                    "status-pasca"= Buyer >> Check Status
                    */

                    // Call Transaction Detail
                    // Sample Data
                    //$id_sku_product = "15.1178";
                    //$customer_no = "125332572013";
                    //$order_id_reference = "INVBG41383411052024"; 


                    $id_sku_product = "15.1177";
                    $customer_no = "95704162412806";
                    $order_id_reference = "INVBG9531626062024"; 

                    // GET Product SKU by ID
                    $product = $this->M_Base->data_where('product', 'id', $order['product_id']);
                    if(isset($product[0]['sku'])){
                        $id_sku_product = $product[0]['sku'];
                        $customer_no = $order['user_id'].$order['zone_id'];
                        $order_id_reference = $order['order_id']; 

                        $post_data = json_encode([
                            'commands' => "checkstatus", 
                            'username' => $df_user,
                            'buyer_sku_code' => $id_sku_product,
                            'customer_no' => $customer_no,
                            'ref_id' => $order_id_reference,
                            'sign' => md5($df_user.$df_key.$order_id_reference),
                        ]);
                        
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                        $result = curl_exec($ch);
                        $result = json_decode($result, true);
                        
                        //echo "<pre>"; print_r($result); die;

                        if(!empty($result)){
                            if($result['data']){
                                $data = $result['data'];
                                $data_result = array(
                                    "order_id_ref" => $data['ref_id'],
                                    "provider_name" => "Digiflazz",
                                    "invoice_id" => "-",
                                    "product" => "-",
                                    "game" => "-",
                                    "target" => $data['customer_no'],
                                    "sn" => $data['sn'],
                                    "amount" => $data['price'],
                                    "trxDate" => "-",
                                    "status" => $data['status']
                                );
                            }else{
                                $result = array(
                                    'message' => 'Data tidak ada.',
                                );
                            }
                        }else{
                            $result = array(
                                'message' => 'Permintaan tidak ditemukan.',
                            );
                        }
                    }else{
                        $result = array(
                            'message' => 'Permintaan tidak ditemukan.',
                        );
                    }
                    
                    break;
                case 'AG':
                    $result = array();
                    break;
                default:
                    $result = Array(
                            'message' => 'Provider belum tersedia untuk checking...',
                            'error' => 'Provider not Found!'
                        );
                    break;
            }

        }else{

            $result = Array(
                    'message' => 'Data pesanan tidak ditemukan',
                    'error' => 'Empty Data'
            );
        }
        
        if(!empty($data_result)){
            $str_display_result = '<table class="table table-white table-striped">';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Provider:</td><td>'.$data_result['provider_name'].'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Invoice ID:</td><td>'.$data_result['order_id_ref'] .'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Invoice ID Provider:</td><td>'.$data_result['invoice_id'] .'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Produk:</td><td>'.$data_result['product'].'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Game:</td><td>'.$data_result['game'].'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Target User:</td><td>'.$data_result['target'].'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>SN:</td><td>'.$data_result['sn'].'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Total:</td><td>'.$data_result['amount'].'</td>';
            $str_display_result .= '</tr>';
            $str_display_result .= '<tr>';
            $str_display_result .= '<td>Status:</td><td>'.$data_result['status'].'</td>';
            $str_display_result .= '</tr>';
            if($order['status'] == "Success"){
                // Do Nothing
            }else{
                if($data_result['status'] == "Success" || $data_result['status'] == "Sukses" ){ 
                    $str_display_result .= '<tr>';
                    $str_display_result .= '<td colspan="2"><button class="btn btn-warning" onclick="update_status(\''.$data_result['order_id_ref'].'\')">Update Status</button></td>';
                    $str_display_result .= '</tr>';
                }
                if($data_result['status'] == "Pending" || $data_result['status'] == "Refunded" || $data_result['status'] == "Cancelled"){
                    $str_display_result .= '<tr>';
                    $str_display_result .= '<td colspan="2"><button class="btn btn-warning" onclick="reorder(\''.$data['order_id_ref'].'\')">Re-order</button></td>';
                    $str_display_result .= '</tr>';
                }
            }
            $str_display_result .= '</table>';
        }else{
            $str_display_result = '<table class="table table-white table-striped">';
            $str_display_result .= '<tr>'.$result['message'].'</tr>';
            $str_display_result .= '</table>';
        }

        echo $str_display_result; 
    }
}