<?php

namespace App\Controllers;

class Sistem extends BaseController {


    public function callback($action = null) {
        
    	if ($action === 'tripay') {
    	    
    	    $json = file_get_contents('php://input');

			$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

			if ($callbackSignature !== hash_hmac('sha256', $json, $this->M_Base->u_get('tripay-private'))) {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			} else if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			} else {
			    
			    $data = json_decode($json, true);
    	    
        	    if ($data) {
        	        
    				if (is_array($data)) {
    				    
    				    echo json_encode(['success' => true]);
    				    
    				    $id = $data['merchant_ref'];
    
    					if (in_array($data['status'], ['PAID', 'ACTIVE', 'SUCCEEDED'])) {
    					    
    						$orders = $this->M_Base->data_where_array('orders', [
    							'order_id' => $id,
    							'status' => 'Pending'
    						]);
    
    						if (count($orders) === 1) {
    
    							$this->M_Base->orders_multi($orders[0]);
    							//$this->M_Base->orders($orders[0]);
    
    						} else {
    						    
    							$topup = $this->M_Base->data_where_array('topup', [
    								'topup_id' => $id,
    								'status' => 'Pending',
    							]);
    
    							if (count($topup) === 1) {
    							    
    							    $this->M_Base->topup($topup[0]);
    								
    							} else {
    							    
    							    $upgrade = $this->M_Base->data_where_array('upgrade', [
    							        'upgrade_id' => $id,
    							    ]);
    							    
    							    if (count($upgrade) == 1) {
    							        
    							        $this->M_Base->upgrade($upgrade[0]);
    							        
    							    } else {
    							        echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
    							    }
    							}
    						}
    					} else {
    						echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
    					}
    				} else {
    					throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    				}
    			} else {
    				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    			}
    		}
    	} else if ($action == 'duitku') {
    	    
    	    $merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
            $amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
            $merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
            $signature = isset($_POST['signature']) ? $_POST['signature'] : null; 
            
            if (!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature)) {
            
                if ($signature == md5($merchantCode . $amount . $merchantOrderId . $this->M_Base->u_get('dk_key'))) {
            
                    if ($this->request->getPost('resultCode')) {
                        
                        if ($this->request->getPost('resultCode') == '00') {
                            
                            $id = $merchantOrderId;
                            
                            $orders = $this->M_Base->data_where_array('orders', [
    							'order_id' => $id,
    							'status' => 'Pending'
    						]);
    
    						if (count($orders) === 1) {
    
                                $this->M_Base->orders_multi($orders[0]);
    							//$this->M_Base->orders($orders[0]);
    
    						} else {
    						    
    							$topup = $this->M_Base->data_where_array('topup', [
    								'topup_id' => $id,
    								'status' => 'Pending',
    							]);
    
    							if (count($topup) === 1) {
    							    
    							    $this->M_Base->topup($topup[0]);
    								
    							} else {
    							    
    							    $upgrade = $this->M_Base->data_where_array('upgrade', [
    							        'upgrade_id' => $id,
    							    ]);
    							    
    							    if (count($upgrade) == 1) {
    							        
    							        $this->M_Base->upgrade($upgrade[0]);
    							        
    							    } else {
    							        echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
    							    }
    							}
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
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
    	} else if ($action == 'tokopay') {
    	    
    	    $ip = (@$_SERVER['HTTP_X_FORWARDED_FOR']=='') ? $_SERVER['REMOTE_ADDR'] : @$_SERVER['HTTP_X_FORWARDED_FOR'];
        
            if ($ip == '178.128.104.179') {
                
                $data = json_decode(file_get_contents('php://input'), true);
            
                if ($data) {
                    
                    if (is_array($data)) {
                        
                        if (in_array($data['status'], ['Success', 'Completed'])) {

                            echo json_encode(['status' => true]);

                            $id = $data['reff_id'];
                            
                            $orders = $this->M_Base->data_where_array('orders', [
    							'order_id' => $id,
    							'status' => 'Pending'
    						]);
    
    						if (count($orders) === 1) {
    
    							$this->M_Base->orders_multi($orders[0]);
                               //$this->M_Base->orders($orders[0]);
    
    						} else {
    						    
    							$topup = $this->M_Base->data_where_array('topup', [
    								'topup_id' => $id,
    								'status' => 'Pending',
    							]);
    
    							if (count($topup) === 1) {
    							    
    							    $this->M_Base->topup($topup[0]);
    								
    							} else {
    							    
    							    $upgrade = $this->M_Base->data_where_array('upgrade', [
    							        'upgrade_id' => $id,
    							    ]);
    							    
    							    if (count($upgrade) == 1) {
    							        
    							        $this->M_Base->upgrade($upgrade[0]);
    							        
    							    } else {
    							        echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
    							    }
    							}
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
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
    	} else if ($action == 'xendit') {
    	    
    	    $data = json_decode(file_get_contents('php://input'), true);
    	    
    	    if ($data) {
    	        
    	        if (is_array($data)) {
    	            
    	            $status = null;
    	            
    	            if (array_key_exists('status', $data)) {
    	                $status = $data['status'];
    	            } else if (array_key_exists('callback_virtual_account_id', $data)) {
    	                $status = 'PAID';
    	            } else if (array_key_exists('status', $data['data'])) {
    	                $status = $data['data']['status'];
    	            }
    	            
    	            $id = null;
    	            
    	            if (array_key_exists('reference_id', $data)) {
    	                $id = $data['reference_id'];
    	            } else if (array_key_exists('external_id', $data)) {
    	                $id = $data['external_id'];
    	            } else if (array_key_exists('reference_id', $data['data'])) {
    	                $id = $data['data']['reference_id'];
    	            }
    	            
    	            if (in_array($status, ['PAID', 'SUCCEEDED', 'SETTLING'])) {
    	                
    	                echo json_encode(['success' => true]);
    	                
    	                $orders = $this->M_Base->data_where_array('orders', [
							'order_id' => $id,
							'status' => 'Pending'
						]);

						if (count($orders) === 1) {
						    
						    $this->M_Base->orders_multi($orders[0]);
						    //$this->M_Base->orders($orders[0]);

						} else {
						    
							$topup = $this->M_Base->data_where_array('topup', [
								'topup_id' => $id,
								'status' => 'Pending',
							]);

							if (count($topup) === 1) {

							    $this->M_Base->topup($topup[0]);
							    
							} else {
							    
							    $upgrade = $this->M_Base->data_where_array('upgrade', [
							        'upgrade_id' => $id,
							    ]);
							    
							    if (count($upgrade) == 1) {
							        
							        $this->M_Base->upgrade($upgrade[0]);
							        
							    } else {
							        echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
							    }
							}
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
    	} else if ($action == 'moota') {
    	    
    	    if ($_SERVER['REMOTE_ADDR'] == '103.236.201.178') {
        
                $data = json_decode(file_get_contents('php://input'), true);
                
                if ($data) {
                    
                    if (is_array($data)) {
                        
                        foreach ($data as $loop) {
                            
                            if ($loop['type'] == 'CR') {
                                
                                $amount = $loop['amount'];
                                
                                $orders = $this->M_Base->data_where_array('orders', [
        							'price' => $amount,
        							'status' => 'Pending'
        						]);
        
        						if (count($orders) === 1) {
        						    
        						    $this->M_Base->orders($orders[0]);
        
        						} else {
        						    
        							$topup = $this->M_Base->data_where_array('topup', [
        								'amount' => $amount,
        								'status' => 'Pending',
        							]);
        
        							if (count($topup) === 1) {
        							    
        							    $this->M_Base->topup($topup[0]);
        							    
        							} else {
        							    
        							    $upgrade = $this->M_Base->data_where_array('upgrade', [
        							        'amount' => $amount,
        							    ]);
        							    
        							    if (count($upgrade) == 1) {
        							        
        							        $this->M_Base->upgrade($upgrade[0]);
        							        
        							    }
        							}
        						}
                            }
                        }
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
	        }
	        
	        echo "SUCCESS";
	        
    	} else if ($action == 'vocagame') {
    	    
    	    $headers = getallheaders();
        
            $valid = false;
            $callback_key = '';
            
            if (array_key_exists('X-Callback-Key', $headers)) {
                $valid = true;
                $callback_key = $headers['X-Callback-Key'];
            } else if (array_key_exists('x-callback-key', $headers)) {
                $valid = true;
                $callback_key = $headers['x-callback-key'];
            }
    
            if ($valid == true) {

                if ($callback_key == $this->M_Base->u_get('voca_key')) {

                    $post_data = file_get_contents('php://input');

                    $data = json_decode($post_data, true);

                    if ($data) {

                        if (is_array($data)) {

                            $order_id = $data['reference'];

                            if (!empty($order_id)) {

                                $orders = $this->M_Base->data_where_array('orders', [
                                    'order_id' => $order_id,
                                    'status' => 'Processing',
                                    'method' => 'SELLER DIGI',
                                ]);

                                if (count($orders) > 0) {
                                    
                                    if (in_array($data['status'], ['Success', 'Refunded'])) {

                                        $status = ($data['status'] == 'Refunded') ? 'Canceled' : 'Success';
                                        
                                        $this->M_Base->status($orders[0], $status, $data['sn']);
                                    }else{
                                        // Send Callback Digiflazz
                                        $this->M_Base->send_callback_digiflazz($order_id);
                                    }
                                }else{
                                    $orders = $this->M_Base->data_where_array('orders', [
                                        'order_id' => $order_id,
                                        'status' => 'Processing',
                                    ]);

                                    if (count($orders) == 1) {

                                        if (in_array($data['status'], ['Success', 'Refunded'])) {

                                            $status = ($data['status'] == 'Refunded') ? 'Canceled' : 'Success';
                                            
                                            $this->M_Base->status($orders[0], $status, $data['sn']);
                                        }
                                    }

                                }
                            }
                        }
                    }
                }
            }
    	    
    	} else if ($action == 'bangjeff') {
    	    
    	    if (array_key_exists('HTTP_X_REAL_IP', $_SERVER)) {
                $ip = $_SERVER['HTTP_X_REAL_IP'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            
            // file_put_contents('bangjeff-' . $ip . '.txt', file_get_contents('php://input'));

            if ($ip == '178.128.110.75') {
                
                $data = json_decode(file_get_contents('php://input'), true);
                
                if ($data) {
                    
                    if (is_array($data)) {
                        
                        $order_id = $data['reference_number'];
                        $status = $data['status_code'];
                        $ket = $data['voucher'] . ' ' . $data['status_desc'];
                        
                        if (in_array($status, ['SUCCESS', 'REFUNDED'])) {
                            
                            $orders = $this->M_Base->data_where_array('orders', [
                                'order_id' => $order_id,
                                'status' => 'Processing',
                            ]);
                            
                            if (count($orders) == 1) {
                                
                                $status = $status == 'SUCCESS' ? 'Success' : 'Canceled';
                                
                                $this->M_Base->status($orders[0], $status, $ket);
                            }
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
    	} else {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}
    }
    public function callback_digiflazz() {
        
        $headers = getallheaders();
        
        if (isset($headers['x-digiflazz-delivery']) && isset($headers['x-hub-signature'])) {
            $post_data = file_get_contents('php://input');
            $signature = 'sha1=' . hash_hmac('sha1', $post_data, '001857');
            
            if ($headers['x-hub-signature'] == $signature) {
                $data = (json_decode($post_data))->data;

                $data_order = $this->M_Base->data_like('orders', 'order_id_reference', $data->ref_id);
                if(empty($data_order)){
                    $data_order = $this->M_Base->data_where('orders', 'order_id', $data->ref_id);
                }
                
                if (count($data_order) >= 1) {
                    /* Start Check Product Count or Combo Product */
                    $data_order = $data_order[0];
                    $jml_order = $data_order['jumlah']; 
                    $str_order_id_reference = $data_order['order_id_reference'];
                    $array_order_id_reference = "";
                    if(!empty($str_order_id_reference)){
                        $array_order_id_reference = json_decode($str_order_id_reference);
                        if(is_array($array_order_id_reference)){
                            $jml_order = count($array_order_id_reference);
                        }
                    }
                    /* End Check Product Count or Combo Product */

                    if (in_array($data->status, ['Sukses', 'Gagal'])) {

                        $status = ($data->status == 'Gagal') ? 'Canceled' : 'Success';
                        // $status = ($data->status == 'Gagal') ? 'Processing' : 'Success';

                        if(is_array($array_order_id_reference)){
                            
                            $array_ket = array();
                            $str_ket = $data_order['ket']; 
                            if(!empty($str_ket)){
                                $array_ket = json_decode($str_ket);
                            }
                            if(!empty($status)){
                                if($data->sn){
                                    $array_ket[] = $data->sn;
                                }
                                $this->M_Base->data_update('orders', [
                                    'ket' => json_encode($array_ket),
                                ], $data_order['id']);
                            }

                            /*$orders = $this->M_Base->data_like('orders', 'order_id_reference', $data->ref_id);
                            $array_ket = json_decode($orders[0]['ket']);
                            $str_order_id_reference = $orders[0]['order_id_reference'];
                            if(!empty($str_order_id_reference)){
                                $array_order_id_reference = json_decode($str_order_id_reference);
                                if($array_order_id_reference){
                                    $jml_order = count($array_order_id_reference);
                                }
                            }
                            $count_success = 0;
                            
                            //Cek Semua Status
                            if(!empty($array_ket)){
                                foreach($array_ket as $loop){
                                    if($loop == "Success"){
                                        $count_success++;
                                    }
                                }
                            }

                            if($count_success == $jml_order){
                                $status = 'Success';
                                $this->M_Base->status($orders[0], $status, $orders[0]['ket']);
                            }*/

                            $orders = $this->M_Base->data_like('orders', 'order_id_reference', $data->ref_id);
                            $this->M_Base->status($orders[0], $status, $orders[0]['ket']);


                        }else{
                            if($data->sn){
                                $this->M_Base->status($data_order, $status, $data->sn);   
                            }
                        }
                        
                    }else{

                        if($data_order['method'] == "SELLER DIGI"){

                            $ket = $data->status;
                            $this->M_Base->status($data_order, $status, $ket);
                            
                        }
                    }
                }
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /*public function callback_vocagame() {
    
        $headers = getallheaders();
    
        $valid = false;
        $callback_key = '';
        
        if (array_key_exists('X-Callback-Key', $headers)) {
            $valid = true;
            $callback_key = $headers['X-Callback-Key'];
        } else if (array_key_exists('x-callback-key', $headers)) {
            $valid = true;
            $callback_key = $headers['x-callback-key'];
        }

        if ($valid == true) {

            if ($callback_key == $this->M_Base->u_get('voca_key')) {

                $post_data = file_get_contents('php://input');

                $data = json_decode($post_data, true);

                if ($data) {

                    if (is_array($data)) {
                        $order_id = $data['reference'];
                        if (!empty($order_id)) {

                            $orders = $this->M_Base->data_like_where('orders', 'order_id_reference', $order_id, 'status', 'Processing');

                            if (count($orders) == 1) {
                                
                                $str_ket = $orders[0]['ket']; 
                                if(empty($str_ket)){
                                    $str_ket = "[]";
                                }

                                if (in_array($data['status'], ['Success', 'Refunded'])) {

                                    $status = ($data['status'] == 'Refunded') ? 'Canceled' : 'Success';

                                    $array_ket = json_decode($str_ket);

                                    $array_ket[] = $status;

                                    $this->M_Base->data_update('orders', [
                                        'ket' => json_encode($array_ket),
                                    ], $orders[0]['id']);

                                    $orders = $this->M_Base->data_like_where('orders', 'order_id_reference', $order_id, 'status', 'Processing');

                                    $array_ket = json_decode($orders[0]['ket']);

                                    $count_success = 0;
                                    if($orders[0]['jumlah'] > 1){
                                        $num_of_order = $orders[0]['jumlah'];
                                        //Cek Semua Status
                                        if(!empty($array_ket)){
                                            foreach($array_ket as $key => $loop){
                                                if($key >=  $num_of_order){
                                                    if($loop == "Success"){
                                                        $count_success++;
                                                    }
                                                }
                                            }
                                        }

                                        if($count_success == $num_of_order){
                                            $status = 'Success';
                                        }

                                        $this->M_Base->status($orders[0], $status, $orders[0]['ket']);
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
    }*/
    
    public function callback_vocagame() {
    
        $headers = getallheaders();
        $valid = false;
        $callback_key = '';
        
        if (array_key_exists('X-Callback-Key', $headers)) {
            $valid = true;
            $callback_key = $headers['X-Callback-Key'];
        } else if (array_key_exists('x-callback-key', $headers)) {
            $valid = true;
            $callback_key = $headers['x-callback-key'];
        }

        if ($valid == true) {

            if ($callback_key == $this->M_Base->u_get('voca_key')) {
                $post_data = file_get_contents('php://input');
                $data = json_decode($post_data, true);

                if ($data) {
                    if (is_array($data)) {
                        $order_id = $data['reference'];
                        if (!empty($order_id)) {
                            $orders = $this->M_Base->data_like_where('orders', 'order_id_reference', $order_id, 'status', 'Processing');
                            if (count($orders) == 1) {
                                
                                $str_order_id_reference = $orders[0]['order_id_reference'];
                                $str_ket = $orders[0]['ket']; 

                                if(empty($str_ket)){
                                    $str_ket = "[]";
                                }

                                if (in_array($data['status'], ['Success', 'Refunded'])) {

                                    $status = ($data['status'] == 'Refunded') ? 'Canceled' : 'Success';

                                    $array_ket = json_decode($str_ket);
                                    $array_order_id_reference = json_decode($str_order_id_reference);

                                    $array_ket[] = $status;

                                    $this->M_Base->data_update('orders', ['ket' => json_encode($array_ket)], $orders[0]['id']);

                                    $orders = $this->M_Base->data_like_where('orders', 'order_id_reference', $order_id, 'status', 'Processing');

                                    $array_ket = json_decode($orders[0]['ket']);

                                    $count_success = 0;

                                    //if($orders[0]['jumlah'] > 1){
                                    if(is_array($array_order_id_reference)){
                                        //$num_of_order = $orders[0]['jumlah'];
                                        $num_of_order = count($array_order_id_reference);
                                        
                                        //Cek Semua Status
                                        if(!empty($array_ket)){
                                            foreach($array_ket as $key => $loop){
                                                if($key >=  $num_of_order){
                                                    if($loop == "Success"){
                                                        $count_success++;
                                                    }
                                                }
                                            }
                                        }

                                        if($count_success == $num_of_order){
                                            $status = 'Success';
                                        }

                                        $this->M_Base->status($orders[0], $status, $orders[0]['ket']);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

    }
    
    public function callback_gamepoint() {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            if(isset($data['merchantcode'])){
                $data_order = $this->M_Base->data_where('orders', 'order_id', $data['merchantcode']);
                $status = "Processing";
                $ket = $data_order[0]['ket'];
                if($data['code'] == 100 || $data['code'] == "100"){
                    $status = "Success";
                }
                if($data['code'] == 102 || $data['code'] == "102"){
                    $status = "Failed";
                    if(isset($data['reason'])){
                       $ket = $data['reason']; 
                    }
                }
                if(!empty($data_order)){
                    $this->M_Base->status($data_order[0], $status, $ket);
                }
            }
        }
    }
    
    public function canceled() {

        foreach ($this->M_Base->data_where('orders', 'status', 'Pending') as $loop) {
            
            if ((time() - strtotime($loop['date_create'])) >= 86400) {
                $this->M_Base->data_update('orders', [
                    'status' => 'Canceled',
                ], $loop['id']);
            }
        }

        foreach ($this->M_Base->data_where('topup', 'status', 'Pending') as $loop) {
            
            if ((time() - strtotime($loop['date_create'])) >= 86400) {
                $this->M_Base->data_update('topup', [
                    'status' => 'Canceled',
                ], $loop['id']);
            }
        }
    }
    
    public function refund_balance() {

        foreach ($this->M_Base->data_where('orders', 'status', 'Canceled') as $loop) {

            if($loop['method'] == 'Saldo Akun' || $loop['method'] == 'API'){
                if ((time() - strtotime($loop['date_create'])) <= 259200) { //86400 = 1 hari (x3)
                    
                    //Get User Balance
                    $user = $this->M_Base->data_where('users', 'username', $loop['username']);

                    if($user){
                        //Add User Balance
                        $this->M_Base->data_update('users', [
                                'balance' => $user[0]['balance'] + $loop['price'],
                        ], $user[0]['id']);

                        //Update Order
                        $this->M_Base->data_update('orders', [
                                'status' => 'Refunded',
                        ], $loop['id']);

                        //Logs
                        $this->M_Base->data_insert('logs', [
                            'logsname' => 'Refund Balance Order',
                            'ref_id' => $loop['order_id'],
                            'note' => $loop['price'],
                        ]);
                    }

                }
            }
        }

        foreach ($this->M_Base->data_where('orders', 'status', 'Expired') as $loop) {

            if($loop['method'] == 'Saldo Akun' || $loop['method'] == 'API'){
                if ((time() - strtotime($loop['date_create'])) <= 259200) { //86400 = 1 hari (x3)
                    
                    //Get User Balance
                    $user = $this->M_Base->data_where('users', 'username', $loop['username']);

                    if($user){
                        //Add User Balance
                        $this->M_Base->data_update('users', [
                                'balance' => $user[0]['balance'] + $loop['price'],
                        ], $user[0]['id']);

                        //Update Order
                        $this->M_Base->data_update('orders', [
                                'status' => 'Refunded',
                        ], $loop['id']);

                        //Logs
                        $this->M_Base->data_insert('logs', [
                            'logsname' => 'Refund Balance Order',
                            'ref_id' => $loop['order_id'],
                            'note' => $loop['price'],
                        ]);
                    }

                }
            }
        }

    }
    
    public function produk($action = null) {
        
        if ($action === 'auto-update') {
            
            $df_user = $this->M_Base->u_get('digi-user');
			$df_key = $this->M_Base->u_get('digi-key');

			$post_data = json_encode([
                'cmd' => 'prepaid',
                'username' => $df_user,
                'sign' => md5($df_user.$df_key.'price-list'),
            ]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/price-list');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            
            if ($result) {
                
                if (array_key_exists('data', $result)) {
                    
                    if (count($result['data']) > 3) {
                        
                        foreach ($result['data'] as $data) {
                            
                            $product = $this->M_Base->data_where_array('product', [
                                'provider' => 'DF',
                                'sku' => $data['buyer_sku_code'],
                            ]);
                            
                            if (count($product) == 1) {
                                
                                $status = ($data['buyer_product_status'] == true && $data['seller_product_status'] == true) ? 'On' : 'Off';
                                
                                if ($product[0]['status'] !== $status) {
                                    
                                    $this->M_Base->data_update('product', [
                                        'status' => $status,
                                    ], $product[0]['id']);
                                    
                                    echo $product[0]['product'] . ' status terupdate : ' . $status . '<br>';
                                }
                            }
                        }
                    }
                }
            }
            
            $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/product', []);
            
            if ($response) {
                
                if ($response['error'] == false) {
                    
                    foreach ($response['data'] as $loop) {
                        
                        $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/variant', [
                            'code' => $loop['code']
                        ]);
                        
                        if ($response) {
                
                            if ($response['error'] == false) {
                                
                                foreach ($response['data'] as $data) {
                                    
                                    $product = $this->M_Base->data_where_array('product', [
                                        'provider' => 'BangJeff',
                                        'sku' => $data['code'],
                                    ]);
                                    
                                    if (count($product) == 1) {
                                        
                                        $status = ($data['isActive'] == true) ? 'On' : 'Off';
                                        
                                        if ($product[0]['status'] !== $status) {
                                            
                                            $this->M_Base->data_update('product', [
                                                'status' => $status,
                                            ], $product[0]['id']);
                                            
                                            echo $product[0]['product'] . ' status terupdate : ' . $status . '<br>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $result = $this->M_Voca->trx('GET', [], 'products', 'products', [
                'merchant' => $this->M_Base->u_get('voca_merchant'),
                'secret' => $this->M_Base->u_get('voca_secret'),
                'key' => $this->M_Base->u_get('voca_key'),
            ]);
            
            if(isset($result['data'])){
                foreach ($result['data'] as $loop){
                     $resultitems = $this->M_Voca->trx('GET', [], 'products/' . $loop['id'] .'/items', 'products/' . $loop['id'] .'/items', [
                        'merchant' => $this->M_Base->u_get('voca_merchant'),
                        'secret' => $this->M_Base->u_get('voca_secret'),
                        'key' => $this->M_Base->u_get('voca_key'),
                    ]);
                    
                    foreach ($resultitems['data'] as $data) { 
                        $product = $this->M_Base->data_where_array('product', [
                                'provider' => 'VocaGame',
                                'sku' => $data['id'],
                        ]);
                            
                        if (count($product) == 1) {
                     
                            $status = ($data['isActive'] == 1) ? 'On' : 'Off';
                            
                            $this->M_Base->data_update('product', [
                                    'status' => $status,
                            ], $product[0]['id']);
                            
                            echo $product[0]['product'] . ' status terupdate : ' . $status . '<br>';
                        }
                    }
                }
            }
            
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function status() {
        $order = $this->M_Base->data_where_array('orders', [
            'provider' => 'HokiTopup',
            'status' => 'Processing'
        ]);
        
        $key = $this->M_Base->u_get('hokitopup');
        
        foreach ($order as $loop) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://hokitopup.id/api/v1-alpha',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('action' => 'status','api_key' => $key,'tid' => $loop['ket']),
            ));
            
            $response = curl_exec($curl);
            $result = json_decode($response, true);
            
            if($result) {
                if ($result['data']['status'] == 'Success') {
                    $this->M_Base->data_update('orders', [
                        'status' => $result['data']['status'],
                    ], $loop['id']);
                    
                    echo 'order id '.$loop['id'].' Berhasil di update status'.$result['data']['status'];
                } else {
                    echo 'order id '.$loop['id'].' Berhasil di update status'.$result['data']['status'];
                }
                
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    
    public function eod() {

        // COUNT DATA BEFORE PROCESS
        $total_order =$this->M_Base->data_count("orders");
        $total_order_history=$this->M_Base->data_count("orders_history");

        // SYNC DATA ORDERS & ORDERS HISTORY
        if($total_order > 0){
            $orders =$this->M_Base->all_data_order_asc("orders", "id");
            /*$today = date('Y-m-d H:i:s');
            $orders = $this->M_Base->data_where_array('orders', 
                ['date_create <' => $today]
            );*/

            if(!empty($orders)){
                ini_set('max_execution_time', '0');
                $num = 0;
                foreach($orders as $order){
                    // CHECK DATA ON ORDER HISTORY BEFORE INSERT
                    $data_order_history_1 =$this->M_Base->data_where("orders_history", "order_id", $order['order_id']);

                    //echo "<pre>"; print_r($data_order_history_1[0]['id']); die;

                    if(empty($data_order_history_1)){
                        // INSERT TO ORDERS HISTORY
                        $this->M_Base->data_insert('orders_history', [
                            'order_id' => $order['order_id'],
                            'order_id_reference' => $order['order_id_reference'],
                            'order_id_provider' => $order['order_id_provider'],
                            'ref_id_seller' => $order['ref_id_seller'],
                            'username' => $order['username'],
                            'wa' => $order['wa'],
                            'email' => $order['email'],
                            'product_id' => $order['product_id'],
                            'product' => $order['product'],
                            'jumlah' => $order['jumlah'],
                            'price_modal' => $order['price_modal'],
                            'price' => $order['price'],
                            'fee' => $order['fee'],
                            'uniq' => $order['uniq'],
                            'diskon' => $order['diskon'],
                            'voucher' => $order['voucher'],
                            'user_id' => $order['user_id'],
                            'zone_id' => $order['zone_id'],
                            'target' => $order['target'],
                            'target_json' => $order['target_json'],
                            'nickname' => $order['nickname'],
                            'method_id' => $order['method_id'],
                            'method' => $order['method'],
                            'games' => $order['games'],
                            'games_id' => $order['games_id'],
                            'status' => $order['status'],
                            'ket' => $order['ket'],
                            'payment_code' => $order['payment_code'],
                            'provider' => $order['provider'],
                            'callback_url' => $order['callback_url'],
                            'callback_status' => $order['callback_status'],
                            'callback_mesage' => $order['callback_mesage'],
                            'date' => $order['date'],
                            'date_create' => $order['date_create'],
                            'date_process' => $order['date_process'],
                        ]);
                    }else{
                        // UPDATE TO ORDER HISTORY
                        $this->M_Base->data_update('orders_history', [
                            'order_id' => $order['order_id'],
                            'order_id_reference' => $order['order_id_reference'],
                            'order_id_provider' => $order['order_id_provider'],
                            'ref_id_seller' => $order['ref_id_seller'],
                            'username' => $order['username'],
                            'wa' => $order['wa'],
                            'email' => $order['email'],
                            'product_id' => $order['product_id'],
                            'product' => $order['product'],
                            'jumlah' => $order['jumlah'],
                            'price_modal' => $order['price_modal'],
                            'price' => $order['price'],
                            'fee' => $order['fee'],
                            'uniq' => $order['uniq'],
                            'diskon' => $order['diskon'],
                            'voucher' => $order['voucher'],
                            'user_id' => $order['user_id'],
                            'zone_id' => $order['zone_id'],
                            'target' => $order['target'],
                            'target_json' => $order['target_json'],
                            'nickname' => $order['nickname'],
                            'method_id' => $order['method_id'],
                            'method' => $order['method'],
                            'games' => $order['games'],
                            'games_id' => $order['games_id'],
                            'status' => $order['status'],
                            'ket' => $order['ket'],
                            'payment_code' => $order['payment_code'],
                            'provider' => $order['provider'],
                            'callback_url' => $order['callback_url'],
                            'callback_status' => $order['callback_status'],
                            'callback_mesage' => $order['callback_mesage'],
                            'date' => $order['date'],
                            'date_create' => $order['date_create'],
                            'date_process' => $order['date_process'],
                        ], $data_order_history_1[0]['id']);
                    }

                    // CHECK DATA ON ORDER HISTORY AFTER INSERT
                    $data_order_history_2 =$this->M_Base->data_where("orders_history", "order_id", $order['order_id']);

                    // IF DATA EXIST THEN DELETE DATA ON TABLE ORDER
                    if($data_order_history_2){
                        $date = $order['date'];
                        $status = $order['status'];
                        $today = date('Y-m-d');
                        if($status == 'Success'){
                            $this->M_Base->data_delete("orders", $order['id']);
                        }else{
                            if($date != $today){
                                if($status != 'Processing'){
                                    $this->M_Base->data_delete("orders", $order['id']);
                                }
                            }
                        }
                    }

                    $num++;
                }

                echo $num." Data Already Synced.";
            }

        }else{
            echo "No Available Data to Sync. All Data Already Synced.";
        }

    }
    
    public function set_order_expired() {
        $orders =$this->M_Base->data_where("orders", "status", "Pending");
        if(count($orders) > 0){
            $today = date("Y-m-d H:i:s");
            $order_timer = $this->M_Base->u_get('order_timer');
            if(!empty($order_timer)){
                $order_time_array = explode("*", $order_timer);
                foreach($orders as $order){
                    if(!empty($order['date_create'])){
                        $date_expired = date('Y-m-d H:i:s', strtotime($order['date_create']) + ($order_time_array[0]*$order_time_array[1]*$order_time_array[2]));
                        if($today > $date_expired){
                            // Update Status Expired
                            $this->M_Base->data_update('orders', [
                                    'status' => 'Expired',
                                ], $order['id']);
                        }
                    }
                }
            }
        }else{
            //Do Nothing
        }
    }
}