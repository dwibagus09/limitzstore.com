<?php

namespace App\Controllers;

class Payment extends BaseController {

    public $username_ibank = "ammadfar6332"; // username bca ibank
    public $password_ibank = "250796"; // pin / password bca ibank

    public function index($order_id = null) {

    	if ($order_id === null) {

            if ($this->request->getPost('order_id')) {
                $orders = $this->M_Base->data_where('orders', 'order_id', $this->request->getPost('order_id'));
                if(empty($orders)){
                    $orders = $this->M_Base->data_where('orders_history', 'order_id', $this->request->getPost('order_id'));
                }
                if (count($orders) == 1) {
                    if ($orders[0]['order_id'] === $this->request->getPost('order_id')) {
                        return redirect()->to(base_url() . '/payment/' . $orders[0]['order_id']);
                    } else {
                        $this->session->setFlashdata('error', 'No Transaksi tidak ditemukan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'No Transaksi tidak ditemukan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }

            $db = \Config\Database::connect();
            $builder = $db->table('config');
            $builder->where('nama', 'pesananterakhir');
            $get = $builder->get()->getRowArray();

    		$data = array_merge($this->base_data, [
	    		'title' => 'Pembayaran',
                'menu_active' => 'Cek',
                'config' => $get
	    	]);

	        return view('Payment/index', $data);

    	} else {
    		$orders = $this->M_Base->data_where('orders', 'order_id', $order_id);
            if(empty($orders)){
                $orders = $this->M_Base->data_where('orders_history', 'order_id', $order_id);
            }
    		if (count($orders) === 1) {
    		    
    		    $method_image= '';
    		    $instruksi = '';
                $fee = 0;
                $percent = 0;
                if ($orders[0]['method_id'] == 10001 || $orders[0]['method_id'] == 10002 || $orders[0]['method_id'] == 10003) {
                    $fee = 0;
                    $percent = 0;
                } else {
                    $method = $this->M_Base->data_where('method', 'id', $orders[0]['method_id']);

                    $instruksi = count($method) == 1 ? $method[0]['instruksi'] : '-';
                    
                    if(count($method) == 1) {
                        $fee = $method[0]['fee'];
                        $percent = $method[0]['percent'];
                        $method_image = $method[0]['image'];
                    }
                }
                
                $data_games = $this->M_Base->data_where('games', 'id', $orders[0]['games_id']);
                
                $games_image = count($data_games) == 1 ? $data_games[0]['image'] : '';
                
                $confeti = $orders[0]['status'] == 'Success' ? true : false;
                
                $orders_review = $this->M_Base->data_where('orders_review', 'order_id', $orders[0]['order_id']);
                
                if (count($orders_review) == 0) {
                    
                    if ($this->request->getPost('tombol')) {
                        
                        $data_post = [
                            'star' => $this->request->getPost('star'),
                            'games_id' => $orders[0]['games_id'],
                            'message' => $this->request->getPost('message'),
                        ];
                        
                        if (empty($data_post['star'])) {
                            $this->session->setFlashdata('error', 'Rating tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (!is_numeric($data_post['star'])) {
                            $this->session->setFlashdata('error', 'Rating tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if ($data_post['star'] < 1 || $data_post['star'] > 5) {
                            $this->session->setFlashdata('error', 'Rating tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (strlen($data_post['message']) > 250) {
                            $this->session->setFlashdata('error', 'Pesan terlalu panjang');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            
                            $this->M_Base->data_insert('orders_review', array_merge($data_post, [
                                'order_id' => $orders[0]['order_id'],
                                'date_create' => date('Y-m-d G:i:s'),
                            ]));
                            
                            $this->session->setFlashdata('success', 'Penilaian berhasil dikirim');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }
                
                $today = date("Y-m-d H:i:s");
                $date_expired = date('Y-m-d H:i:s', strtotime('24 hours') );
                $order_timer = "60*60*24"; //Default 24 Jam
                $order_time_array = explode("*", $order_timer);
                if(isset($orders[0]['date_create'])){
                    $date_expired = date('Y-m-d H:i:s', strtotime($orders[0]['date_create']) + ($order_time_array[0]*$order_time_array[1]*$order_time_array[2]));
                }

                $db = \Config\Database::connect();
                $builder = $db->table('utility');
                $builder->where('u_key', 'order_timer');
                $get_utility = $builder->get()->getRowArray();
                if(isset($get_utility['u_value'])){
                    $order_timer = $get_utility['u_value'];
                    $order_time_array = explode("*", $order_timer);
                    $date_expired = date('Y-m-d H:i:s', strtotime($orders[0]['date_create']) + ($order_time_array[0]*$order_time_array[1]*$order_time_array[2]));
                }

                if($today > $date_expired){
                    // Update Status Cancelled
                    if($orders[0]['status'] == "Pending"){
                        $this->M_Base->data_update('orders', [
                            'status' => 'Expired',
                        ], $orders[0]['id']);
                    }
                }

    			$data = array_merge($this->base_data, [
		    		'title' => 'Detail Pembayaran',
		    		'orders' => array_merge($orders[0], [
                        'instruksi' => $instruksi, 
                        'fee_admin' => $fee, 
                        'percent' => $percent,
                        'games_image' => $games_image,
                        'method_image' => $method_image,
                    ]),
                    'order_timer' => $order_time_array,
                    'date_expired' => $date_expired,
                    'menu_active' => 'Cek',
                    'confeti' => $confeti,
                    'review' => $orders_review,
                    'review_template' => $this->M_Base->all_data('review_template'),
		    	]);

		        return view('Payment/detail', $data);
    		} else {
    			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    		}
    	}
    }
    
    public function check($action = null, $order_id = null) {
        
        if ($action === 'status') {
            
            if ($order_id) {
                
                if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)) {

				    if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
				        
				        $orders = $this->M_Base->data_where('orders', 'order_id', $order_id);
				        if(count($orders) == 0){
				            
				            $orders = $this->M_Base->data_where('orders_history', 'order_id', $order_id);
				        }
				        
				        if (count($orders) == 1) {
				            
				            echo $orders[0]['status'];
				            
				        } else {
				            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				        }
				    } else {
				        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				    }
				} else {
				    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				}
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($action === 'list-order') {
            
            if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)) {
                
                if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                    
                    foreach ($this->M_Base->data_wherein('orders', 'status', ['Processing', 'Success'], 10) as $loop) {
                        echo '<tr>
                            <td>'.$loop['date_create'].'</td>
                            <td>'.substr($loop['order_id'], 0, 4).'*****'.substr($loop['order_id'], -4).'</td>
                            <td>'.$loop['product'].'<br><small class="text-muted">'.$loop['games'].'</small></td>
                            <td>Rp '.number_format($loop['price'],0,',','.').'</td>
                            <td><span class="badge bg-'.badge($loop['status']).'">'.$loop['status'].'</span></td>
                        </tr>';
                    }
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function cron() {
     
        // topup 
        $this->M_Base->mario_update('topup',[
            'status' => 'Canceled',
        ],[
            'status' => 'Pending',
            'method_id' => 32,
            'DATE(date_create) <' => date('Y-m-d')
        ]);
        $topup = $this->M_Base->data_where_array('topup',[
            'status' => 'Pending',
            'method_id' => 32,
        ]);
        if(count($topup) < 1) 
            echo "Tidak Ada Data Topup";
        

        foreach($topup as $key => $item) {
            $cek = $this->M_Base->data_count('mutation',[
                'amount' => $item['amount'],
                'is_read' => 0
            ]);
            if($cek > 0) 
            {
                $users = $this->M_Base->data_where('users', 'username', $item['username']);

                if (count($users) === 1) {
                    $this->M_Base->data_update('users', [
                        'balance' => $users[0]['balance'] + $item['amount'],
                    ], $users[0]['id']);

                    $this->M_Base->data_update('topup', [
                        'status' => 'Success',
                    ], $item['id']);

                    echo json_encode(['msg' => 'Berhasil {TOPUP}']);
                } else {
                    echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
                }
                
                // $this->M_Base->mario_update('topup',[
                //     'status' => 'Success',
                //     'ket' => "Pembayaran berhasil",
                // ],[
                //     'id' => $item['id'],
                // ]);

                $this->M_Base->mario_update('mutation',[
                    'is_read' => 1,
                ],[
                    'amount' => $item['amount'],
                    'is_read' => 0
                ]);
                echo "BERHASIL TOPUP ID #".$item['id'].'<br>';
            }
        }
        echo "<br>";

        $this->M_Base->mario_update('orders',[
            'status' => 'Canceled',
        ],[
            'status' => 'Pending',
            'DATE(date_create) <' => date('Y-m-d'),
        ]);
        $orders = $this->M_Base->data_where_array('orders',[
            'status' => 'Pending',
            'method_id' => 32,
        ]);
        if(count($orders) < 1) {
            echo "Tidak Ada Data Order";
            exit;
        }
           $status = "Pending";

        foreach($orders as $key => $item) {
            $cek = $this->M_Base->data_count('mutation',[
                'amount' => $item['price'],
                'is_read' => 0
            ]);
     
            if($cek > 0) 
            {
                $this->M_Base->mario_update('mutation',[
                    'is_read' => 1,
                ],[
                    'amount' => $item['price'],
                    'is_read' => 0
                ]);
                // echo "kena ini";
                
                $status = 'Processing';
                

                $product = $this->M_Base->data_where('product', 'id', $item['product_id']);

                if (!empty($item['zone_id']) AND $item['zone_id'] != 1) {
                    $customer_no = $item['user_id'] . $item['zone_id'];
                } else {
                    $customer_no = $item['user_id'];
                }

                if ($item['provider'] == 'DF') {

                    $df_user = $this->M_Base->u_get('digi-user');
                    $df_key = $this->M_Base->u_get('digi-key');

                    $post_data = json_encode([
                        'username' => $df_user,
                        'buyer_sku_code' => $product[0]['sku'],
                        'customer_no' => $customer_no,
                        'ref_id' => $item['order_id'],
                        'sign' => md5($df_user.$df_key.$item['order_id']),
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
                            $ket = $result['data']['message'];
                        } else {
                            $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];

                            echo json_encode(['success' => true]);
                        }
                    } else {
                        $ket = 'Failed Order';
                    }
                } else if ($item['provider'] == 'Manual') {
                                    
                    $status = 'Processing';
                    $ket = 'Pesanan siap diproses';
                    
                } else if ($item['provider'] == 'AG') {

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $item['order_id'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_POSTFIELDS => '',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/x-www-form-urlencoded'
                        ),
                    ));

                    $result = curl_exec($curl);
                    $result = json_decode($result, true);

                    if ($result['status'] == 0) {
                        $ket = $result['error_msg'];
                    } else {
                        
                        if ($result['data']['status'] == 'Sukses') {
                            $status = 'Success';
                        }

                        $ket = $result['data']['sn'];
                    }

                } else {
                    $ket = 'Provider tidak ditemukan';
                }
                
                echo $status;
                
                 $this->M_Base->mario_update('orders', [
                    'status' => $status,
                    'ket' => $ket,
                ],[
                    'id' => $item['id']
                ]);

              
                echo "UPDATE ORDER ID #".$item['id']." ".$status."<br>";
            } else {
                $ket = 'Order tidak ditemukan';
            }
           
               
            }
        
    }

    public function mutation() {
        $source = $this->fetchResponseFrom($this->grab_bca($this->username_ibank, $this->password_ibank, date('Y-m-d')));
    
        if(empty($source)) echo "tidak ada mutasi hari ini";
        foreach($source as $key => $item) {
            if($item['jenis'] == "DB") continue; 
            $cek = $this->M_Base->data_count('mutation',[
                'description' => $item['keterangan'],
                'amount' => $item['mutasi'],
            ]);
            if($cek > 0) continue; 

            $data = [
                'description' => $item['keterangan'],
                'amount' => $item['mutasi'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->M_Base->data_insert('mutation', $data);
            echo "BERHASIL INSERT #".$item['keterangan'].'<br>';
        }
    }

     function toIDR($money) {
        $m = explode('.', $money);
        return str_replace(',', '', $m[0]);
    }
    
     function fix_angka($string)
    {
        $string = str_replace(',', '', $string);
        $string = strtok($string, '.');
        return $string;
    }
    
    
    public function grab_bca($user, $pass, $tgl) {
        $user_ip = '103.147.154.54';
        $ua = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36";
        $cookie = 'bca-cookie.txt';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com');
        $info = curl_exec($ch);
        $a = strstr($info, 'var s = document.createElement(\'script\'), attrs = { src: (window.location.protocol ==', 1);
        $a = strstr($a, 'function getCurNum(){');
        $b = array(
            'return "',
            'function getCurNum(){',
            '";',
            '}',
            '{',
            '(function()'
        );
        $b = str_replace($b, '', $a);
        $curnum = trim($b);
        $params = 'value%28actions%29=login&value%28user_id%29=' . $user . '&value%28CurNum%29=' . $curnum . '&value%28user_ip%29=' . $user_ip . '&value%28browser_info%29=' . $ua . '&value%28mobile%29=false&value%28pswd%29=' . $pass . '&value%28Submit%29=LOGIN';
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/authentication.do');
        curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        $info = curl_exec($ch);
        //print_r($info);
        // Buka menu
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/nav_bar_indo/menu_bar.htm');
        curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/authentication.do');
       // $info = curl_exec($ch);
        // Buka Informasi Rekening
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
        curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/authentication.do');
       // $info = curl_exec($ch);
        // Buka Mutasi Rekening
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acct_stmt');
        curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
        curl_setopt($ch, CURLOPT_POST, 1);
        $info = curl_exec($ch);
        //print_r($info);
        // Parameter untuk Lihat Mutasi Rekening
        $params = array();
        $jkt_time = time() + (3600 * 7);
        $t1 = explode('-', $tgl);
        $t0 = explode('-', $tgl);
        $params[] = 'value%28startDt%29=' . $t0[2];
        $params[] = 'value%28startMt%29=' . $t0[1];
        $params[] = 'value%28startYr%29=' . $t0[0];
        $params[] = 'value%28endDt%29=' . $t1[2];
        $params[] = 'value%28endMt%29=' . $t1[1];
        $params[] = 'value%28endYr%29=' . $t1[0];
        $params[] = 'value%28D1%29=0';
        $params[] = 'value%28r1%29=1';
        $params[] = 'value%28fDt%29=';
        $params[] = 'value%28tDt%29=';
        $params[] = 'value%28submit1%29=Lihat+Mutasi+Rekening';
        $params = implode('&', $params);
        // Buka Lihat Mutasi Rekening & simpan hasilnya di $source
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview');
        curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        $source = curl_exec($ch);
        //print_r($source);
        // Logout, cURL close, hapus cookies
        curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/authentication.do?value(actions)=logout');
        curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
        $info = curl_exec($ch);
        curl_close($ch);
        @unlink($cookie);
        return $source;
    }
    
    public function fetchResponseFrom($str) {
        //file_put_contents(date('d-m-y h:i:s.html'), $str);
        $exp = explode('<table border="0" cellpadding="0" cellspacing="0" width="590">', $str);
        $exp = explode('</table>', $exp[2]);
        $all = explode('<font face="verdana" size="1" color="#0000bb">', $exp[1]);
    
        $strings = [];
        foreach($all as $el) {
            $strings[] = trim(strip_tags($el));
        }
    
        $col = [];
        $total = count($strings) - 1;
        $cIt = 0;
        for ($it = 1; $total >= $it; $it++) {
            if ($it % 6 == 0) {
                $col[$cIt][] = $strings[$it];
                $cIt++;
            } else {
                $col[$cIt][] = $strings[$it];
            }
        }
    
        $result = array_map(function($r) {
            return [
              'tgl'         => $r[0],
              'keterangan'  => preg_replace('/\s+/', ' ', $r[1]),
              'cabang'      => $r[2],
              'mutasi'      => $this->fix_angka($r[3]),
              'jenis'       => $r[4],
              'saldo'       => $r[5]
            ];
          }, $col);
        return $result;
    }
}
