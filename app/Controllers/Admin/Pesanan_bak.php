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
                $str_action_edit = '<a href="'.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/edit/'.$loop['id'].'" class="btn btn-primary btn-sm">Edit</a>';
                $str_action_delete = '<button type="button" onclick="hapus(\''.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/delete/'.$loop['id'].'\');" class="btn btn-danger btn-sm">Hapus</button>';
                $str_actions = $str_action_edit.''.$str_action_delete;
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

        if (!empty($deleteIds)) {
            foreach ($deleteIds as $id) {
                $orders = $this->M_Base->data_where('orders', 'id', $id);

                if (count($orders) === 1) {

                    $this->M_Base->data_delete('orders', $id);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            }

            $this->session->setFlashdata('success', 'Pesanan berhasil dihapus');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/pesanan');
        } else {
            $this->session->setFlashdata('error', 'Gagal hapus Pesanan');
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
                $order_id = '<b class="cursor-pointer" onclick="detail(\''.$loop['order_id']. '\');">'.$loop['order_id'].'</b>';
                if (!empty($loop['zone_id']) AND $loop['zone_id'] != 1) {
                    $uid =  $loop['user_id'] . ' ('.$loop['zone_id'].')';
                } else {
                    $uid = $loop['user_id'];
                }
                $str_action_edit = '<a href="'.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/edit-history/'.$loop['id'].'" class="btn btn-primary btn-sm">Edit</a>';
                $str_action_delete = '<button type="button" onclick="hapus(\''.base_url().'/-9J6DWAuK/]:C2Tx1/pesanan/delete-history/'.$loop['id'].'\');" class="btn btn-danger btn-sm">Hapus</button>';
                $str_actions = $str_action_edit.''.$str_action_delete;
                $output['data'][]=array($queue_no,$order_id,$loop['product']."<br/>".$uid,$loop['method'],$loop['provider'],$loop['status'],$str_actions);
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
}