<?php 

namespace App\Models;

use CodeIgniter\Model;

use App\Models\M_Voca;
use App\Models\M_Wa;

class M_Base extends Model {
	
	public function random_string($length = 24) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	// CRUD Table
	public function select_distinct($table, $field) {
		return $this->db->table($table)->select($field)->distinct()->orderBy($field, 'ASC')->get()->getResultArray();
	}
	public function all_data($table, $limit = null) {
		if ($limit) {
			return $this->db->table($table)->orderBy('id', 'DESC')->limit($limit)->get()->getResultArray();
		} else {
			return $this->db->table($table)->orderBy('id', 'DESC')->get()->getResultArray();
		}
	}
	public function all_data_order($table, $order = null, $limit = null) {
		if ($order) {
		    
		    if ($limit) {
		        return $this->db->table($table)->orderBy($order, 'DESC')->limit($limit)->get()->getResultArray();
		    } else {
		        return $this->db->table($table)->orderBy($order, 'DESC')->get()->getResultArray();
		    }
		} else {
		    if ($limit) {
		        return $this->db->table($table)->orderBy('id', 'DESC')->limit($limit)->get()->getResultArray();
		    } else {
		        return $this->db->table($table)->orderBy('id', 'DESC')->get()->getResultArray();
		    }
		}
	}
    public function all_data_order_asc($table, $order) {
		return $this->db->table($table)->orderBy($order, 'asc')->get()->getResultArray();
	}

	public function data_insert($table, $data) {
		return $this->db->table($table)->insert($data);
	}
	public function data_where($table, $field, $value) {
		return $this->db->table($table)->where($field, $value)->get()->getResultArray();
	}
	public function data_where_custom($table, $field, $value, $order_by=NULL, $order_type='ASC') {
		if($order_by){
			return $this->db->table($table)->where($field, $value)->orderBy($order_by, $order_type)->get()->getResultArray();
		}else{
			return $this->db->table($table)->where($field, $value)->get()->getResultArray();
		}
	}
	public function data_wherein($table, $field, $value, $limit = null) {
		
		if ($limit) {
		    return $this->db->table($table)->whereIn($field, $value)->orderBy('id', 'DESC')->limit($limit)->get()->getResultArray();
		} else {
		    return $this->db->table($table)->whereIn($field, $value)->orderBy('id', 'DESC')->get()->getResultArray();
		}
	}
	public function data_where_array($table, $data, $order = null, $limit = null) {
		if ($order) {
		    
			if ($limit) {
			    
			    return $this->db->table($table)->where($data)->orderBy($order, 'DESC')->limit($limit)->get()->getResultArray();
			} else {
			    return $this->db->table($table)->where($data)->orderBy($order, 'DESC')->get()->getResultArray();
			}
		} else {
			
			if ($limit) {
			    return $this->db->table($table)->where($data)->limit($limit)->get()->getResultArray();
			} else {
			    return $this->db->table($table)->where($data)->get()->getResultArray();
			}
		}
	}

    public function data_where_array_asc($table, $data, $order, $limit) {
		return $this->db->table($table)->where($data)->orderBy($order, 'ASC')->limit($limit)->get()->getResultArray();
	}

	public function data_where_array_desc($table, $data, $order, $limit) {
		return $this->db->table($table)->where($data)->orderBy($order, 'DESC')->limit($limit)->get()->getResultArray();
	}

    public function data_where_offset($table, $data, $order = null, $limit = null, $offset = 0){
        if ($order) {
            if ($limit) {
                return $this->db->table($table)
                    ->where($data)
                    ->orderBy($order, 'ASC')
                    ->limit($limit, $offset)
                    ->get()
                    ->getResultArray();
            } else {
                return $this->db->table($table)
                    ->where($data)
                    ->orderBy($order, 'ASC')
                    ->get()
                    ->getResultArray();
            }
        } else {
            if ($limit) {
                return $this->db->table($table)
                    ->where($data)
                    ->limit($limit, $offset)
                    ->get()
                    ->getResultArray();
            } else {
                return $this->db->table($table)
                    ->where($data)
                    ->get()
                    ->getResultArray();
            }
        }
    }

    public function data_where_offset_custom($table, $data, $order = null, $order_type = 'ASC', $limit = null, $offset = 0){
        if ($order) {
            if ($limit) {
                return $this->db->table($table)
                    ->where($data)
                    ->orderBy($order, $order_type)
                    ->limit($limit, $offset)
                    ->get()
                    ->getResultArray();
            } else {
                return $this->db->table($table)
                    ->where($data)
                    ->orderBy($order, $order_type)
                    ->get()
                    ->getResultArray();
            }
        } else {
            if ($limit) {
                return $this->db->table($table)
                    ->where($data)
                    ->limit($limit, $offset)
                    ->get()
                    ->getResultArray();
            } else {
                return $this->db->table($table)
                    ->where($data)
                    ->get()
                    ->getResultArray();
            }
        }
    }

    public function data_search_six_fields($table, $arr_fields, $keywords, $order_by = null, $order_type = 'ASC', $limit = null, $offset = 0){
    	if(!empty($arr_fields)){
    		return $this->db->table($table)->like($arr_fields[0], $keywords)->orLike($arr_fields[1], $keywords)->orLike($arr_fields[2], $keywords)
	        ->orLike($arr_fields[3], $keywords)->orLike($arr_fields[4], $keywords)->orLike($arr_fields[5], $keywords)
	        ->orderBy($order_by, $order_type)
	        ->limit($limit, $offset)
	        ->get()
	        ->getResultArray();
    	}
    }
    
    public function data_search_three_fields($table, $arr_fields, $keywords, $order_by = null, $order_type = 'ASC', $limit = null, $offset = 0){
    	if(!empty($arr_fields)){
    		return $this->db->table($table)->like($arr_fields[0], $keywords)->orLike($arr_fields[1], $keywords)->orLike($arr_fields[2], $keywords)
	        ->orderBy($order_by, $order_type)
	        ->limit($limit, $offset)
	        ->get()
	        ->getResultArray();
    	}
    }

	public function data_update($table, $data, $id) {
		return $this->db->table($table)->set($data)->where('id', $id)->update();
	}
	
	//tamabahn bagus 271224
	public function data_update_order($table, $data, $id) {
		return $this->db->table($table)->set($data)->where('order_id_reference', $id)->update();
	}
	
	public function mario_update($table, $data, $where) {
		return $this->db->table($table)->set($data)->where($where)->update();
	}
	public function data_delete($table, $id) {
		return $this->db->table($table)->delete(['id' => $id]);
	}
	public function data_like($table, $filed, $data) {
		return $this->db->table($table)->like($filed, $data)->orderBy('id', 'DESC')->get()->getResultArray();
	}
	public function data_like_where($table, $filed, $str, $filed_2, $str_2) {
		return $this->db->table($table)->like($filed, $str)->where($filed_2, $str_2)->orderBy('id', 'DESC')->get()->getResultArray();
	}
	public function data_truncate($table) {
		return $this->db->table($table)->truncate();
	}
	public function data_avg($table, $filed, $data, $distinct = false) {
		if ($distinct === true) {
			return $this->db->table($table)->select('date_create,date')->where($filed . ' >=', $data[0])->where($filed . ' <=', $data[1])->distinct()->get()->getResultArray();
		} else {
			return $this->db->table($table)->where($filed . ' >=', $data[0])->where($filed . ' <=', $data[1])->get()->getResultArray();
		}
	}
	public function data_count($table, $where = null) {
		if ($where) {
			return $this->db->table($table)->where($where)->countAllResults();
		} else {
			return $this->db->table($table)->countAllResults();
		}
	}
	public function webconfig() {
		return file_get_contents('http://103.161.184.29/license/?url=' . base_url());
	}

	public function u_get($key) {
		return $this->db->table('utility')->where('u_key', $key)->get()->getResultArray()[0]['u_value'];
	}
	public function u_update($key, $value) {
		return $this->db->table('utility')->set(['u_value' => $value])->where('u_key', $key)->update();
	}
	public function data_update_plus($satuan, $tipe, $jumlah) {
		if ($satuan === 'Angka') {
			return $this->db->table('services')->set('price', 'price' . $tipe . $jumlah, false)->update();
		} else {
			foreach ($this->db->table('services')->get()->getResultArray() as $service) {
				$total_up = ($jumlah / 100) * $service['price'];
				$this->db->table('services')->set('price', 'price' . $tipe . $total_up, false)->where('id', $service['id'])->update();
			}
		}
	}
	public function upload_file($file, $path, $custome_name = false, $ex = ['png', 'jpeg', 'jpg', 'xlsx', 'jfif', 'webp'], $get_original = false) {
		if ($file) {
			if ($file->getError() == 0) {
				if (in_array(strtolower($file->getClientExtension()), $ex)) {
					if ($custome_name === false) {
						$nama_file = $file->getRandomName();
					} else {
						$nama_file = $custome_name . '.' . $file->getClientExtension();
					}

					$file->move($path, $nama_file);

					if ($get_original) {
						return [
							'name' => $nama_file,
							'original' => $file->getClientName(),
						];
					} else {
						return $nama_file;
					}

				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function post($link, $data) {
	    $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL             => $link,
            CURLOPT_POST            => true,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_IPRESOLVE        => CURL_IPRESOLVE_V4,
        ));
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        
        return $result; 
	}
	
	public function bj($link, $data) {
	    
	    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->u_get('bj_key'),
            ),
        ));
        
        $response = curl_exec($curl);
        $response = json_decode($response, true);
        
        return $response;
	}
	
	public function upgrade($upgrade = []) {
	    
	    $users = $this->data_where_array('users', [
            'username' => $upgrade['username'],
        ]);
        
        if (count($users) == 1) {
            
            $this->data_update('users', [
                'level' => $upgrade['level'],
            ], $users[0]['id']);
            
            $this->data_delete('upgrade', $upgrade['id']);
        }
	}
	
	public function topup($topup = []) {
	    
	    $users = $this->data_where('users', 'username', $topup['username']);
    
		if (count($users) === 1) {
		    $nominal_topup = $topup['amount'] - $topup['fee'];
			$this->data_update('users', [
				'balance' => $users[0]['balance'] + $nominal_topup,
			], $users[0]['id']);

			$this->data_update('topup', [
				'status' => 'Success',
			], $topup['id']);
			
			$wa_topup = $this->u_get('wa_topup');
                if (!empty($wa_topup)) {
                    $M_Wa = new M_Wa;
                
                    $M_Wa->send([
                        'token' => $this->u_get('wa_fonnte'),
                        'target' => $users[0]['wa'],
                        'message' => str_replace([
                            '#username#',
                            '#jumlah#',
                        ], [
                            $users[0]['username'],
                            $topup['amount'],
                        ], $wa_topup),
                    ]);
                }
			
		}
	}
	
	public function send_callback($orderid){
	    $orders = $this->db->table('orders')->select('order_id, status, ket, callback_url, callback_status, callback_mesage')->where('order_id', $orderid)->get()->getRowArray();
	    
        $data = json_encode($orders);
        
        $url = $orders['callback_url'];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        
        $response = curl_exec($ch);

        if ($response === false) {
            $error_message = curl_error($ch);
            $data = [
                'callback_mesage' => $error_message
            ];
            return $this->db->table('orders')->set($data)->where('order_id', $orderid)->update();
        } else {
            $data = [
                    'callback_status' => 'Y',
                    'callback_mesage' => 'Success send callback'
                ];
            return $this->db->table('orders')->set($data)->where('order_id', $orderid)->update();
        }

	}
	
	 public function send_callback_digiflazz($orderid){
	    $orders = $this->db->table('orders')->where('order_id', $orderid)->get()->getRowArray();

        if(!empty($check_order['zone_id'])) {
            $customer_no = $orders['user_id'].$orders['zone_id'];
        } else {
            $customer_no = $orders['user_id'];
        }


        if($orders['status'] == 'Success') {
            $status = '1'; //success
            $rc = '00';
        } else if($orders['status'] == 'Processing') {
            $status = '0'; //sedang Diproses
            $rc = '39';
        } else {
            $status = '2'; //gagal
            $rc = '07';
        }

        /*if($orders['status'] == 'Success') {
            $rc = '00';
        } else if($orders['status'] == 'Processing') {
            $rc = '39';
        } else {
            $rc = '07';
        }*/

        $totalbalance = $this->u_get('saldo-seller-digi');

        $response = [
            'data'   => [
                "ref_id"=> $orders['ref_id_seller'],
                "status"=> $status,
                "code"=> $orders['product_id'].'.'.$orders['games_id'],
                "hp"=> $customer_no,
                "price"=> $orders['price'],
                "message"=> $orders['status'],
                "balance"=> (string)$totalbalance,
                "tr_id"=> $orders['order_id'],
                "rc"=> $rc,
                "sn"=> $orders['ket']
            ],
        ];
	    
        $data = json_encode($response);
        
        $url = 'https://api.digiflazz.com/v1/seller/callback#koneksiseller';
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        
        $response = curl_exec($ch);

        $data = [
            'callback_mesage' => date('Y-m-d G:i:s')
        ];

        return $this->db->table('orders')->set($data)->where('order_id', $orderid)->update();
	}
	
	public function orders($orders = []) {
	    
	    $status = 'Processing';
	    
	    $ket = 'Pesanan siap diproses';
    
		$product = $this->data_where('product', 'id', $orders['product_id']);

		if (count($product) === 1) {
			
			if (!empty($orders['zone_id']) AND $orders['zone_id'] != 1) {
				$customer_no = $orders['user_id'] . $orders['zone_id'];
			} else {
				$customer_no = $orders['user_id'];
			}

			if ($orders['provider'] == 'DF') {

				$df_user = $this->u_get('digi-user');
				$df_key = $this->u_get('digi-key');

				if($orders['jumlah'] > 1){

					$order_id_reference = $orders['order_id_reference'];
					if(!empty($order_id_reference)){
            			$order_id_reference = json_decode($order_id_reference);
                        $tmp_ket = array();
                        for ($i=0; $i < $orders['jumlah']; $i++) { 
		                    $post_data = json_encode([
			                    'username' => $df_user,
			                    'buyer_sku_code' => $product[0]['sku'],
			                    'customer_no' => $customer_no,
			                    'ref_id' => $order_id_reference[$i],
			                    'sign' => md5($df_user.$df_key.$order_id_reference[$i]),
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
			                    	$tmp_ket[$i] = $result['data']['message'];
			                    } else if ($result['data']['status'] == 'Sukses') {
			                        $status = 'Success';
			                        $tmp_ket[$i] = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
			                    } else {
			                        $status = 'Processing';
			                        $tmp_ket[$i] = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
			                    }
			                } else {
			                	$tmp_ket[$i] = 'Failed Order';
			                }

                        }
					}else{
						$tmp_ket[$i] = 'Order ID not found';
					}

                    $ket = json_encode($tmp_ket);

				}else{

					$post_data = json_encode([
	                    'username' => $df_user,
	                    'buyer_sku_code' => $product[0]['sku'],
	                    'customer_no' => $customer_no,
	                    'ref_id' => $orders['order_id'],
	                    'sign' => md5($df_user.$df_key.$orders['order_id']),
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
	                    } else if ($result['data']['status'] == 'Sukses') {
	                        $status = 'Success';
	                        $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
	                    } else {
	                        $status = 'Processing';
	                        $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
	                    }
	                } else {
	                	$ket = 'Failed Order';
	                }

				}
            } elseif ($product[0]['provider'] == 'Manual') {
            //  if($product[0]['category_id'] == "4"){
            //         $product_vouchers = $this->data_where_array('product_voucher',[
            //             'id_product' => $product[0]['id'],
            //             'is_sold' => false,
            //         ]);
            //         if(count($product_vouchers) > 0){
            //             // Tambahan bagus Ambil voucher pertama yang tersedia
            //             $id_product_voucher = $product_vouchers[0]['id'];
            //             $sn = $product_vouchers[0]['kode_voucher']; // SN dari stok lokal
                                                                    
            //             // Tandai voucher sebagai terjual
            //             $this->M_Base->data_update('product_voucher', ['is_sold' => true], $id_product_voucher);
                                                        
            //             $status = 'Success';
            //             $ket = $sn; // SN untuk transaksi saat ini
            //             $status = '1'; // sedang di proses
            //             $rc = '00'; // process
                                                    
            //             // Update status pesanan (jika diperlukan untuk setiap hit)
            //           $this->M_Base->data_update_order('orders', ['status' => 'Success'], $orders['order_id_reference']);
            //         }else{
            //             $status = 'Processing';
            //             $ket = 'Voucher telah habis';
            //         }
            //     }else{
            //         $status = 'Processing';
            //         $ket = 'Pesanan siap diproses';
            //     }           
            //Tambahan Bagus 26 Jan
            try {
                                                            $jml_user = $orders['jumlah']; // Contoh jumlah user, bisa diganti dengan nilai dinamis
                                                            log_message('info', "Memulai proses pengambilan voucher untuk {$jml_user} user...");
                                                        
                                                            $product_vouchers = $this->M_Base->data_where_array('product_voucher', [
                                                                'id_product' => $product[0]['id'],
                                                                'is_sold' => false,
                                                            ]);
                                                        
                                                            log_message('info', "Jumlah voucher tersedia: " . count($product_vouchers));
                                                        
                                                            if (count($product_vouchers) >= $jml_user) {
                                                                log_message('info', "Voucher mencukupi untuk {$jml_user} user, memproses...");
                                                        
                                                                // Proses voucher sebanyak $jml_user
                                                                $voucher_list = [];
                                                                for ($i = 0; $i < $jml_user; $i++) {
                                                                    $id_product_voucher = $product_vouchers[$i]['id'];
                                                                    $sn = $product_vouchers[$i]['kode_voucher']; // SN dari stok lokal
                                                        
                                                                    // Tandai voucher sebagai terjual
                                                                    $this->M_Base->data_update('product_voucher', ['is_sold' => true], $id_product_voucher);
                                                        
                                                                    log_message('info', "Voucher ID {$id_product_voucher} dengan SN {$sn} telah ditandai sebagai terjual.");
                                                        
                                                                    // Simpan SN ke daftar voucher
                                                                    $voucher_list[] = $sn;
                                                                }
                                                        
                                                                // Gabungkan daftar voucher dengan baris baru
                                                               // $ket = "Voucher berhasil dikeluarkan:\n" . implode("\n", $voucher_list);
                                                               $ket = "Voucher berhasil dikeluarkan:<br>" . implode("<br>", $voucher_list);
                                                                $status = 'Success'; // Status sukses karena semua voucher berhasil dikeluarkan
                                                                $rc = '00'; // Kode sukses
                                                        
                                                                log_message('info', "Proses selesai, status: {$status}, keterangan: " . str_replace("\n", ", ", $ket));
                                                            } else {
                                                                log_message('warning', "Voucher tidak mencukupi. Diperlukan: {$jml_user}, tersedia: " . count($product_vouchers));
                                                        
                                                                // Jika voucher kurang dari jumlah user, ubah status menjadi "Processing"
                                                                $status = 'Processing';
                                                                $ket = 'Voucher tidak cukup untuk jumlah user yang diminta. Diperlukan: ' . $jml_user . ', tersedia: ' . count($product_vouchers);
                                                                $rc = '01'; // Kode untuk sedang diproses
                                                            }
                                                        } catch (Exception $e) {
                                                            log_message('error', 'Terjadi kesalahan: ' . $e->getMessage());
                                                            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                        
                
                } else if ($orders['provider'] == 'VocaGame') {
			    
			    $M_Voca = new M_Voca;
			    $exp_sku = explode('.', $product[0]['sku']);

                if (count($exp_sku) == 2) {

                	if($orders['jumlah'] > 1){
                		$order_id_reference = $orders['order_id_reference'];
                		if(!empty($order_id_reference)){
                			$order_id_reference = json_decode($order_id_reference);
                            $tmp_ket = array();
                            $tmp_id_provider = array();
                            for ($i=0; $i < $orders['jumlah']; $i++) { 

			                    $result = $M_Voca->trx('POST', [
			                        'productId' => $exp_sku[0],
			                        'productItemId' => $exp_sku[1],
			                        'reference' => $order_id_reference[$i],
			                        'data' => [
			                            'userId' => $orders['user_id'],
			                            'zoneId' => $orders['zone_id'],
			                        ],
			                        'callbackUrl' => base_url() . '/sistem/callback_vocagame',
			                    ], 'transaction', 'transaction/' . $order_id_reference[$i], [
			                        'merchant' => $this->u_get('voca_merchant'),
			                        'secret' => $this->u_get('voca_secret'),
			                        'key' => $this->u_get('voca_key'),
			                    ]);

                                if ($result) {
                                    if (array_key_exists('statusCode', $result)) {
                                        $tmp_id_provider[$i] = '';
                                        $tmp_ket[$i] = 'Result : ' . $result['message'];
                                    } else {
                                        $tmp_id_provider[$i] = $result['data']['invoiceId'];
                                        $tmp_ket[$i] = $result['data']['sn'];
                                    }
                                } else {
                                    $tmp_id_provider[$i] = '';
                                    $tmp_ket[$i] = 'Gagal terkoneksi ke VocaGame';
                                }
                            }
                		}

                		$order_id_provider = json_encode($tmp_id_provider);
                        $ket = json_encode($tmp_ket);

                	}else{

	                    $result = $M_Voca->trx('POST', [
	                        'productId' => $exp_sku[0],
	                        'productItemId' => $exp_sku[1],
	                        'reference' => $orders['order_id'],
	                        'data' => [
	                            'userId' => $orders['user_id'],
	                            'zoneId' => $orders['zone_id'],
	                        ],
	                        'callbackUrl' => base_url() . '/sistem/callback/vocagame',
	                    ], 'transaction', 'transaction/' . $orders['order_id'], [
	                        'merchant' => $this->u_get('voca_merchant'),
	                        'secret' => $this->u_get('voca_secret'),
	                        'key' => $this->u_get('voca_key'),
	                    ]);

	                    if ($result) {

	                        if (array_key_exists('statusCode', $result)) {
	                            $ket = 'Result : ' . $result['message'];
	                        } else {

	                            $order_id_provider = $result['data']['invoiceId'];
	                            
	                            $ket = $result['data']['sn'];
	                        }
	                    } else {
	                        $ket = 'Gagal terkoneksi ke VocaGame';
	                    }

                	}

                    
                } else {
                    $ket = 'Kode produk tidak sesuai';
                }
			    
			} else if ($orders['provider'] == 'BangJeff') {
			    
			    if (!empty($orders['zone_id'])) {
                    $inputs = [
                        [
                            'name' => 'ID',
                            'value' => $orders['user_id']
                        ],
                        [
                            'name' => 'Server',
                            'value' => $orders['zone_id']
                        ],
                    ];
                } else {
                    $inputs = [
                        [
                            'name' => 'ID',
                            'value' => $orders['user_id']
                        ]
                    ];
                }

                if($orders['jumlah'] > 1){
	                $response = $this->bj('https://api.bangjeff.com/api/v3/checkout', [
	                    'code' => $product[0]['sku'],
	                    'inputs' => $inputs,
	                    'qty' => $orders['jumlah'],
	                    'referenceNumber' => $orders['order_id'],
	                ]);
                }else{
	                $response = $this->bj('https://api.bangjeff.com/api/v3/checkout', [
	                    'code' => $product[0]['sku'],
	                    'inputs' => $inputs,
	                    'referenceNumber' => $orders['order_id'],
	                ]);
                }
                
                if ($response) {
                    
                    if ($response['error'] == false) {
                        
                        $ket = $response['data']['invoiceNumber'];
                        
                    } else {
                        
                        $ket = 'Failed : ' . $response['message'] . ' ';
                    }
                } else {
                    $ket = 'Gagal terkoneksi ke provider' . ' ';
                }
			} else if ($orders['provider'] == 'GP') {
			    
			    //Action Buy Product GamePoint
                $product_id = $package_id = 0;
                if(!empty($product[0]['sku'])){
                    $arr_sku = explode(".",$product[0]['sku']);
                    $package_id = $arr_sku[0]; // product
                    $product_id = $arr_sku[1]; // games
                }
                if(!empty($orders['zone_id'])){ 
                    $post_data = json_encode([
                        'order_id' => $orders['order_id'],
                        'product_id' => $product_id,
                        'package_id' => $package_id,
                        'input1' => $orders['user_id'],
                        'input2' => $orders['zone_id'],
                    ]);        
                }else{
                    $post_data = json_encode([
                        'order_id' => $orders['order_id'],
                        'product_id' => $product_id,
                        'package_id' => $package_id,
                        'input1' => $orders['user_id'],
                    ]);
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.limitzstore.com/order-gamepoint',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => $post_data
                ));
                
                $response = curl_exec($curl);
                $result = json_decode($response, true);
                
                if($result['code'] == 100 || $result['code'] == "100"){
                    $status = 'Success';
                    $ket = $result['referenceno'] ? $result['referenceno'] : $result['message'];
                }else{
                    $ket = $result['message'];
                }
                
			} else if ($orders['provider'] == 'AG') {

				if($orders['jumlah'] > 1){
					$order_id_reference = $orders['order_id_reference'];
					if(!empty($order_id_reference)){
            			$order_id_reference = json_decode($order_id_reference);
                        $tmp_ket = array();
                        for ($i=0; $i < $orders['jumlah']; $i++) { 
							$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->u_get('ag-merchant').'&secret='.$this->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $order_id_reference[$i],
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
								$tmp_ket[$i] = $result['error_msg'];
							} else {
								
							    if ($result['data']['status'] == 'Sukses') {
							        $status = 'Success';
							    }

							    $tmp_ket[$i] = $result['data']['sn'];
							}
                        }

					}else{

						$tmp_ket = "Order Id Reference tidak tersedia";
					}

					$ket = json_encode($tmp_ket);

				}else{
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->u_get('ag-merchant').'&secret='.$this->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $orders['order_id'],
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

				}

			} elseif ($orders['provider'] == 'HokiTopup') {

				$key = $this->u_get('hokitopup');
                
			 if (!empty($orders['zone_id'])) {

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
                      CURLOPT_POSTFIELDS => array('action' => 'order','api_key' => $key,'product' => $product[0]['sku'],'user_id' => $orders['user_id'],'zone_id' => $orders['zone_id'],'order_id' => $orders['order_id']),
                    ));
                    
                    $result = curl_exec($curl);
                    $error = curl_error($curl);
                    $result = json_decode($result, true);
                } else {
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
                      CURLOPT_POSTFIELDS => array('action' => 'order','api_key' => $key,'product' => $product[0]['sku'],'user_id' => $orders['user_id'],'zone_id' => '','order_id' => $orders['order_id']),
                    ));
                    
                    $result = curl_exec($curl);
                    $error = curl_error($curl);
                    $result = json_decode($result, true);
                }
                
                 if($result) {
                    if ($result['success'] == false) {
                    	$ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                    } else if ($result['success'] == true) {
                        $status = 'Success';
                        $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                    } else {
                        $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                    }
                } else {
                    $ket = $error;
                }
            } elseif($orders['provider'] == 'Tokogar'){
               try {
                                                        // Determine product variant ID from SKU
                                                        $variant_id = $product[0]['sku'];
                                                        $region = $product[0]['region'] ?? 'N/A'; // Default to 'N/A' if region not specified
                                                        
                                                        // Initialize variables
                                                        $tmp_ket = [];
                                                        $processed_ref_ids = $processed_ref_ids ?? [];
                                                        $processed_ref_ids_store = $session->get('processed_ref_ids') ?? [];
                                                
                                                        // Determine processing mode based on product_count and combo_product
                                                        if ($product[0]['product_count'] === "Y" || $product[0]['combo_product'] === "Y") {
                                                            // Batch processing mode
                                                            $jml = !empty($array_sku) ? count($array_sku) : $jumlah;
                                                            if (!is_array($array_sku) && $jml > 1) {
                                                                $jml = 1;
                                                            }
                                                        } else {
                                                            // Single item processing mode
                                                            $jml = 1;
                                                            $order_id_reference = [$order_id]; // Use main order ID as reference
                                                        }
                                                
                                                        for ($i = 0; $i < $jml; $i++) {
                                                            $ref_id = $order_id_reference[$i] ?? null;
                                                
                                                            if (!$ref_id || in_array($ref_id, $processed_ref_ids) || in_array($ref_id, $processed_ref_ids_store)) {
                                                                log_message('info', "Skipped Ref ID {$ref_id}: Missing or already processed.");
                                                                continue;
                                                            }
                                                
                                                            $processed_ref_ids[] = $ref_id;
                                                            $processed_ref_ids_store[] = $ref_id;
                                                
                                                            // Prepare request data for Tokogar
                                                            $post_data = [
                                                               // 'api_key' => 'Cjht4-fKH3-EDL-2Mailmj5', // Your Tokogar API key
                                                                'variant_id' => $variant_id,
                                                                'target_1' => $customer_no, // Customer number/ID
                                                                'target_2' => $region, // Region/server
                                                                'testing' => "" // Auto testing mode in development
                                                            ];
                                                
                                                            log_message('info', "Post Data to Tokogar: " . json_encode($post_data));
                                                
                                                            $client = \Config\Services::curlrequest();
                                                            
                                                            try {
                                                                $response = $client->post('https://api.limitzstore.com/v2/tokogar-order', [
                                                                    'form_params' => $post_data,
                                                                    'headers' => [
                                                                        'Accept' => 'application/json',
                                                                        //'Content-Type' => 'application/x-www-form-urlencoded'
                                                                    ],
                                                                    'timeout' => 30,
                                                                    'http_errors' => false // To handle HTTP errors manually
                                                                ]);
                                                
                                                                $statusCode = $response->getStatusCode();
                                                                $result = json_decode($response->getBody(), true);
                                                                
                                                                log_message('info', "Tokogar API Response M_Base [{$statusCode}]: " . print_r($response, true));
                                                
                                                                if ($statusCode === 200 && isset($result['success'])) {
                                                                    if ($result['success'] === true) {
                                                                        // Successful transaction
                                                                        $status = 'Success';
                                                                        // Add additional info if available
                                                                        if (isset($result['data']['ket'])) {
                                                                            if (!isset($tmp_ket[$i])) $tmp_ket[$i] = ''; // FIX INI WAJIB
                                                                            $tmp_ket[$i] .= $result['data']['order_id']. " | " . $result['data']['ket'];
                                                                        }
                                                                    }else {
                                                                        // API returned error
                                                                        $error_msg = $result['message'] ?? 'Unknown API error';
                                                                        $tmp_ket[$i] = 'Failed: ' . $error_msg;
                                                                        log_message('error', "Tokogar API error for Ref ID {$ref_id}: {$error_msg}");
                                                                    }
                                                                } else {
                                                                    // HTTP error or invalid response
                                                                    $error_msg = "Invalid API response (HTTP {$statusCode})";
                                                                    if (isset($result['message'])) {
                                                                        $error_msg .= ": " . $result['message'];
                                                                    }
                                                                    $tmp_ket[$i] = 'Failed: ' . $error_msg;
                                                                    log_message('error', $error_msg);
                                                                }
                                                            } catch (\Exception $e) {
                                                                $error_msg = "Connection error: " . $e->getMessage();
                                                                $tmp_ket[$i] = 'Failed: ' . $error_msg;
                                                                log_message('error', "Ref ID M_Base {$ref_id}: {$error_msg}");
                                                                continue;
                                                            }
                                                        }
                                                
                                                        $session->set('processed_ref_ids', $processed_ref_ids_store);
                                                        
                                                        // Finalize the transaction
                                                        if (!empty($tmp_ket)) {
                                                            $ket = implode(' | ', $tmp_ket);
                                                            log_message('info', "Final transaction M_Base results: {$ket}");
                                                            
                                                            // Here you would typically save the transaction results to database
                                                            // $this->saveTransactionResults($order_id, $status, $ket);
                                                        }
                                                
                                                    } catch (Exception $e) {
                                                        log_message('error', 'Tokogar processing failed: ' . $e->getMessage());
                                                        $this->session->setFlashdata('error', 'Order processing error. Please try again.');
                                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                    } 
            } else {
				$ket = 'Provider tidak ditemukan';
			}
		} else {
			$ket = 'Produk tidak ditemukan';
		}
		
		$check_games = $this->data_where_array('games', [
                'id' => $orders['games_id'],
            ]);
        
        if ($check_games[0]['target'] != 'default') {
            if($orders['method'] == 'API') {
                $ket = $orders['order_id'];
            }
            
            if($orders['method'] == 'SELLER DIGI') {
                $ket = $orders['nickname'].$orders['order_id'];
            }
        }
		    

		$this->data_update('orders', [
			'status' => $status,
			'ket' => $ket
		], $orders['id']);
		
        if($orders['callback_url']) {
            $this->send_callback($orders['order_id']);
        }
        
        if($orders['method'] == 'SELLER DIGI') {
            $this->send_callback_digiflazz($orders['order_id']);
        }
        
        if ($product[0]['provider'] == 'Manual') {
                                            $this->M_Base->data_update_order('orders', ['status' => $status], $order_id_reference);
                                            // Tambahkan log informasi
                                            log_message('info', "Status pesanan telah diperbarui. Order ID: {$order_id_reference}, Status: {$status}");

        }
		
		if ($status == 'Success') {
		    
		    if(isset($id_product_voucher)){
                if($status == "Success"){
                    $this->data_update('product_voucher', ['is_sold' => true], $id_product_voucher);
                }
		    }
		    
		    $top = $this->data_where_array('top', [
                'user_id' => $orders['user_id'],
                'games_id' => $orders['games_id'],
                'periode' => date('Y-m'),
            ]);
            
            if (count($top) == 0) {
                
                $this->data_insert('top', [
                    'user_id' => $orders['user_id'],
                    'nickname' => $orders['nickname'],
                    'games_id' => $orders['games_id'],
                    'total' => 1,
                    'nominal' => $orders['price'],
                    'periode' => date('Y-m'),
                ]);
            } else {
                
                $nickname = $top[0]['nickname'];
                if (!empty($orders['nickname'])) {
                    $nickname = $orders['nickname'];
                }
                
                $this->data_update('top', [
                    'nickname' => $nickname,
                    'total' => $top[0]['total'] + 1,
                    'nominal' => $top[0]['nominal'] + $orders['price'],
                ], $top[0]['id']);
            }
            
            if($orders['jumlah'] > 1){
            	$product_n = $orders['product'].'( x'.$orders['jumlah'].' )';
            }else{
            	$product_n = $orders['product'];
            }
		    $wa_success = $this->u_get('wa_success');
            if (!empty($wa_success)) {
                
                $M_Wa = new M_Wa;
                // Bersihkan dan proses $ket
                                                    $ket_cleaned = trim($ket, '[]'); // Hapus kurung siku
                                                    $ket_cleaned = str_replace('"', '', $ket_cleaned); // Hapus tanda kutip ganda
                                                    $ket_parts = explode(',', $ket_cleaned); // Pisahkan berdasarkan koma
                                                  //  $final_ket = isset($ket_parts[1]) ? $ket_parts[1] : ''; // Ambil elemen kedua jika tersedia
                                                  $final_ket = "A";
                $M_Wa->send([
                    'token' => $this->u_get('wa_fonnte'),
                    'target' => $orders['wa'] . ',' . $this->u_get('wa_admin'),
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
                        $orders['order_id'],
                        $product_n,
                        $orders['price'],
                        $orders['user_id'],
                        $orders['zone_id'],
                        $orders['nickname'],
                        $orders['method'],
                        $orders['games'],
                        $final_ket,
                    ], $wa_success),
                ]);
            }
            
            $email_smtp = \Config\Services::email();

            $config["protocol"] = "smtp";
            
            //isi sesuai nama domain/mail server
            $config["SMTPHost"]  = "limitzstore.com";
            
            //alamat email SMTP
            $config["SMTPUser"]  = "smtp@limitzstore.com"; 
            
            //password email SMTP
            $config["SMTPPass"]  = "Limitzstore2025!@"; 
            
            $config["SMTPPort"]  = 465;
            $config["SMTPCrypto"] = "ssl";
            
            $email_smtp->initialize($config);
            
            $email_smtp->setFrom("invoice@limitzstore.com", "INVOICE LIMITZSTORE");
            $email_smtp->setTo($orders['email']);
            $email_smtp->setSubject("INVOICE LIMITZSTORE - ". $orders['order_id']);
            
           $data = [
                    'logo' => $this->u_get('logoinvoice'),
                    'title' => 'INVOICE LIMITZSTORE',
                    'Description' => 'Product telah ditambahkan ke akun '.$orders['games'].' bos anda. Jika masih belum masuk, silakan melakukan re-login dan masuk kembali.',
                    'game' => $orders['games'],
                    'product' => $product_n,
                    'user_id' => $orders['user_id'],
                    'zone_id' => $orders['zone_id'],
                    'nickname' => $orders['nickname'],
                    'order_id' => $orders['order_id'],
                    'metode' => $orders['method'],
                    'total_harga' => $orders['price'],
                    'keterangan' => $ket,
                ];
            
            
            $messagebody = view("Template/gmail", $data);
            
            $email_smtp->setMessage($messagebody);
            $email_smtp->setMailType('html');  
            
            $email_smtp->send();
		}
	}
	
	public function orders_multi($orders = []) {
	    
	    $status = 'Processing';
	    
	    $ket = 'Pesanan siap diproses';
    
		$product = $this->data_where('product', 'id', $orders['product_id']);

		if (count($product) === 1) {

			/** Start Product Count or Combo Product **/
			$id_sku_product = $product[0]['sku'];
			$order_id_reference = $orders['order_id_reference'];
			$jml_order = $orders['jumlah'];
			$array_sku = array();
			if(isset($product[0]['combo_product'])){
		        if($product[0]['combo_product'] == 'Y'){
		            $array_sku = explode(',', $product[0]['sku']);
		            if(is_array($array_sku)){
		            	$jml_order = count($array_sku);
		            }
		        }
			}
			/** End of Product Count or Combo Product **/
			
			if (!empty($orders['zone_id']) AND $orders['zone_id'] != 1) {
				$customer_no = $orders['user_id'] . $orders['zone_id'];
			} else {
				$customer_no = $orders['user_id'];
			}

			if ($orders['provider'] == 'DF') {

				$df_user = $this->u_get('digi-user');
				$df_key = $this->u_get('digi-key');

				if(($product[0]['product_count'] == "Y") || ($product[0]['combo_product'] == "Y")){
					if(!empty($order_id_reference)){
            			$order_id_reference = json_decode($order_id_reference);
                        $tmp_ket = array();
                        for ($i=0; $i < $jml_order; $i++) { 
                        	if(!empty($array_sku)){
                            	$id_sku_product = $array_sku[$i];
                            }
		                    $post_data = json_encode([
			                    'username' => $df_user,
			                    //'buyer_sku_code' => $product[0]['sku'],
			                    'buyer_sku_code' => $id_sku_product,
			                    'customer_no' => $customer_no,
			                    'ref_id' => $order_id_reference[$i],
			                    'sign' => md5($df_user.$df_key.$order_id_reference[$i]),
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
			                    	$tmp_ket[$i] = $result['data']['message'];
			                    } else if ($result['data']['status'] == 'Sukses') {
			                        $status = 'Success';
			                        $tmp_ket[$i] = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
			                    } else {
			                        $status = 'Processing';
			                        $tmp_ket[$i] = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
			                    }
			                } else {
			                	$tmp_ket[$i] = 'Failed Order';
			                }

                        }
					}else{
						$tmp_ket[$i] = 'Order ID not found';
					}

                    $ket = json_encode($tmp_ket);

				}else{

					$post_data = json_encode([
	                    'username' => $df_user,
	                    'buyer_sku_code' => $id_sku_product,
	                    'customer_no' => $customer_no,
	                    'ref_id' => $orders['order_id'],
	                    'sign' => md5($df_user.$df_key.$orders['order_id']),
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
	                    } else if ($result['data']['status'] == 'Sukses') {
	                        $status = 'Success';
	                        $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
	                    } else {
	                        $status = 'Processing';
	                        $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
	                    }
	                } else {
	                	$ket = 'Failed Order';
	                }

				}
            } else if ($orders['provider'] == 'Manual') {
                                
                $status = 'Processing';
                $ket = 'Pesanan siap diproses';
                
			} else if ($orders['provider'] == 'VocaGame') {
			    
			    $M_Voca = new M_Voca;

			    //$exp_sku = explode('.', $product[0]['sku']);
                //if (count($exp_sku) == 2) {

                	if(($product[0]['product_count'] == "Y") || ($product[0]['combo_product'] == "Y")){
                		
                		if(!empty($order_id_reference)){
                			$order_id_reference = json_decode($order_id_reference);
                            $tmp_ket = array();
                            $tmp_id_provider = array();
                            for ($i=0; $i < $jml_order; $i++) { 
                                if(!empty($array_sku)){
                                    $id_sku_product = $array_sku[$i];
                                }else{
                                    $id_sku_product = $product[0]['sku'];
                                }
                                $exp_sku = explode('.', $id_sku_product);
                            	//$exp_sku = explode('.', $product[0]['sku']);
                            	if(count($exp_sku) == 2){
				                    $result = $M_Voca->trx('POST', [
				                        'productId' => $exp_sku[0],
				                        'productItemId' => $exp_sku[1],
				                        'reference' => $order_id_reference[$i],
				                        'data' => [
				                            'userId' => $orders['user_id'],
				                            'zoneId' => $orders['zone_id'],
				                        ],
				                        'callbackUrl' => base_url() . '/sistem/callback_vocagame',
				                    ], 'transaction', 'transaction/' . $order_id_reference[$i], [
				                        'merchant' => $this->u_get('voca_merchant'),
				                        'secret' => $this->u_get('voca_secret'),
				                        'key' => $this->u_get('voca_key'),
				                    ]);

	                                if ($result) {
	                                    if (array_key_exists('statusCode', $result)) {
	                                        $tmp_id_provider[$i] = '';
	                                        $tmp_ket[$i] = 'Result : ' . $result['message'];
	                                    } else {
	                                        $tmp_id_provider[$i] = $result['data']['invoiceId'];
	                                        $tmp_ket[$i] = $result['data']['sn'];
	                                    }
	                                } else {
	                                    $tmp_id_provider[$i] = '';
	                                    $tmp_ket[$i] = 'Gagal terkoneksi ke VocaGame';
	                                }
                            	}else{
                            		$tmp_ket[$i] = 'Kode produk tidak sesuai';
                            	}
                            }
                		}

                		$order_id_provider = json_encode($tmp_id_provider);
                        $ket = json_encode($tmp_ket);

                	}else{

                		$exp_sku = explode('.', $product[0]['sku']);

                		if (count($exp_sku) == 2) {

		                    $result = $M_Voca->trx('POST', [
		                        'productId' => $exp_sku[0],
		                        'productItemId' => $exp_sku[1],
		                        'reference' => $orders['order_id'],
		                        'data' => [
		                            'userId' => $orders['user_id'],
		                            'zoneId' => $orders['zone_id'],
		                        ],
		                        'callbackUrl' => base_url() . '/sistem/callback/vocagame',
		                    ], 'transaction', 'transaction/' . $orders['order_id'], [
		                        'merchant' => $this->u_get('voca_merchant'),
		                        'secret' => $this->u_get('voca_secret'),
		                        'key' => $this->u_get('voca_key'),
		                    ]);

		                    if ($result) {

		                        if (array_key_exists('statusCode', $result)) {
		                            $ket = 'Result : ' . $result['message'];
		                        } else {

		                            $order_id_provider = $result['data']['invoiceId'];
		                            
		                            $ket = $result['data']['sn'];
		                        }
		                    } else {
		                        $ket = 'Gagal terkoneksi ke VocaGame';
		                    }

                		}else{

                			$ket = 'Kode produk tidak sesuai';
                		}

                	}

                    
                /*} else {
                    $ket = 'Kode produk tidak sesuai';
                }*/
			    
			} else if ($orders['provider'] == 'BangJeff') {
			    
			    if (!empty($orders['zone_id'])) {
                    $inputs = [
                        [
                            'name' => 'ID',
                            'value' => $orders['user_id']
                        ],
                        [
                            'name' => 'Server',
                            'value' => $orders['zone_id']
                        ],
                    ];
                } else {
                    $inputs = [
                        [
                            'name' => 'ID',
                            'value' => $orders['user_id']
                        ]
                    ];
                }

                if($orders['jumlah'] > 1){
	                $response = $this->bj('https://api.bangjeff.com/api/v3/checkout', [
	                    'code' => $product[0]['sku'],
	                    'inputs' => $inputs,
	                    'qty' => $orders['jumlah'],
	                    'referenceNumber' => $orders['order_id'],
	                ]);
                }else{
	                $response = $this->bj('https://api.bangjeff.com/api/v3/checkout', [
	                    'code' => $product[0]['sku'],
	                    'inputs' => $inputs,
	                    'referenceNumber' => $orders['order_id'],
	                ]);
                }
                
                if ($response) {
                    
                    if ($response['error'] == false) {
                        
                        $ket = $response['data']['invoiceNumber'];
                        
                    } else {
                        
                        $ket = 'Failed : ' . $response['message'] . ' ';
                    }
                } else {
                    $ket = 'Gagal terkoneksi ke provider' . ' ';
                }
                
			} else if ($orders['provider'] == 'GP') {
			    
			    //Action Buy Product GamePoint
                $product_id = $package_id = 0;
                if(!empty($product[0]['sku'])){
                    $arr_sku = explode(".",$product[0]['sku']);
                    $package_id = $arr_sku[0]; //product
                    $product_id = $arr_sku[1]; //games
                }
                if(!empty($orders['zone_id'])){ 
                    $post_data = json_encode([
                        'order_id' => $orders['order_id'],
                        'product_id' => $product_id,
                        'package_id' => $package_id,
                        'input1' => $orders['user_id'],
                        'input2' => $orders['zone_id'],
                    ]);        
                }else{
                    $post_data = json_encode([
                        'order_id' => $orders['order_id'],
                        'product_id' => $product_id,
                        'package_id' => $package_id,
                        'input1' => $orders['user_id'],
                    ]);
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.limitzstore.com/order-gamepoint',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => $post_data
                ));
                
                $response = curl_exec($curl);
                $result = json_decode($response, true);
                
                if($result['code'] == 100 || $result['code'] == "100"){
                    $status = 'Success';
                    $ket = $result['referenceno'] ? $result['referenceno'] : $result['message'];
                }else{
                    $ket = $result['message'];
                }
			    
			} else if ($orders['provider'] == 'AG') {

				if($orders['jumlah'] > 1){
					$order_id_reference = $orders['order_id_reference'];
					if(!empty($order_id_reference)){
            			$order_id_reference = json_decode($order_id_reference);
                        $tmp_ket = array();
                        for ($i=0; $i < $orders['jumlah']; $i++) { 
							$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->u_get('ag-merchant').'&secret='.$this->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $order_id_reference[$i],
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
								$tmp_ket[$i] = $result['error_msg'];
							} else {
								
							    if ($result['data']['status'] == 'Sukses') {
							        $status = 'Success';
							    }

							    $tmp_ket[$i] = $result['data']['sn'];
							}
                        }

					}else{

						$tmp_ket = "Order Id Reference tidak tersedia";
					}

					$ket = json_encode($tmp_ket);

				}else{
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->u_get('ag-merchant').'&secret='.$this->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $orders['order_id'],
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

				}

			} elseif ($orders['provider'] == 'HokiTopup') {

				$key = $this->u_get('hokitopup');
                
			 if (!empty($orders['zone_id'])) {

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
                      CURLOPT_POSTFIELDS => array('action' => 'order','api_key' => $key,'product' => $product[0]['sku'],'user_id' => $orders['user_id'],'zone_id' => $orders['zone_id'],'order_id' => $orders['order_id']),
                    ));
                    
                    $result = curl_exec($curl);
                    $error = curl_error($curl);
                    $result = json_decode($result, true);
                } else {
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
                      CURLOPT_POSTFIELDS => array('action' => 'order','api_key' => $key,'product' => $product[0]['sku'],'user_id' => $orders['user_id'],'zone_id' => '','order_id' => $orders['order_id']),
                    ));
                    
                    $result = curl_exec($curl);
                    $error = curl_error($curl);
                    $result = json_decode($result, true);
                }
                
                 if($result) {
                    if ($result['success'] == false) {
                    	$ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                    } else if ($result['success'] == true) {
                        $status = 'Success';
                        $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                    } else {
                        $ket = $result['data']['tid'] ? $result['data']['tid'] : $result['message'];
                    }
                } else {
                    $ket = $error;
                }
            } else {
				$ket = 'Provider tidak ditemukan';
			}
		} else {
			$ket = 'Produk tidak ditemukan';
		}
		
		$check_games = $this->data_where_array('games', [
                'id' => $orders['games_id'],
            ]);
        
        if ($check_games[0]['target'] != 'default') {
            if($orders['method'] == 'API') {
                $ket = $orders['order_id'];
            }
            
            if($orders['method'] == 'SELLER DIGI') {
                $ket = $orders['nickname'].$orders['order_id'];
            }
        }
		    

		$this->data_update('orders', [
			'status' => $status,
			'ket' => $ket,
		], $orders['id']);
		
        if($orders['callback_url']) {
            $this->send_callback($orders['order_id']);
        }
        
        if($orders['method'] == 'SELLER DIGI') {
            $this->send_callback_digiflazz($orders['order_id']);
        }
		
		if ($status == 'Success') {
		    
		    if(isset($id_product_voucher)){
                if($status == "Success"){
                    $this->data_update('product_voucher', ['is_sold' => true], $id_product_voucher);
                }
		    }
		    
		    $top = $this->data_where_array('top', [
                'user_id' => $orders['user_id'],
                'games_id' => $orders['games_id'],
                'periode' => date('Y-m'),
            ]);
            
            if (count($top) == 0) {
                
                $this->data_insert('top', [
                    'user_id' => $orders['user_id'],
                    'nickname' => $orders['nickname'],
                    'games_id' => $orders['games_id'],
                    'total' => 1,
                    'nominal' => $orders['price'],
                    'periode' => date('Y-m'),
                ]);
            } else {
                
                $nickname = $top[0]['nickname'];
                if (!empty($orders['nickname'])) {
                    $nickname = $orders['nickname'];
                }
                
                $this->data_update('top', [
                    'nickname' => $nickname,
                    'total' => $top[0]['total'] + 1,
                    'nominal' => $top[0]['nominal'] + $orders['price'],
                ], $top[0]['id']);
            }
            
            if($orders['jumlah'] > 1){
            	$product_n = $orders['product'].'( x'.$orders['jumlah'].' )';
            }else{
            	$product_n = $orders['product'];
            }
		    $wa_success = $this->u_get('wa_success');
            if (!empty($wa_success)) {
                
                $M_Wa = new M_Wa;
                
                $M_Wa->send([
                    'token' => $this->u_get('wa_fonnte'),
                    'target' => $orders['wa'] . ',' . $this->u_get('wa_admin'),
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
                        $orders['order_id'],
                        $product_n,
                        $orders['price'],
                        $orders['user_id'],
                        $orders['zone_id'],
                        $orders['nickname'],
                        $orders['method'],
                        $orders['games'],
                        $ket,
                    ], $wa_success),
                ]);
            }
            
            $email_smtp = \Config\Services::email();

            $config["protocol"] = "smtp";
            
            //isi sesuai nama domain/mail server
            $config["SMTPHost"]  = "limitzstore.com";
            
            //alamat email SMTP
            $config["SMTPUser"]  = "smtp@limitzstore.com"; 
            
            //password email SMTP
            $config["SMTPPass"]  = "Limitzstore2025!@"; 
            
            $config["SMTPPort"]  = 465;
            $config["SMTPCrypto"] = "ssl";
            
            $email_smtp->initialize($config);
            
            $email_smtp->setFrom("invoice@limitzstore.com", "INVOICE LIMITZSTORE");
            $email_smtp->setTo($orders['email']);
            $email_smtp->setSubject("INVOICE LIMITZSTORE - ". $orders['order_id']);
            
           $data = [
                    'logo' => $this->u_get('logoinvoice'),
                    'title' => 'INVOICE LIMITZSTORE',
                    'Description' => 'Product telah ditambahkan ke akun '.$orders['games'].' bos anda. Jika masih belum masuk, silakan melakukan re-login dan masuk kembali.',
                    'game' => $orders['games'],
                    'product' => $product_n,
                    'user_id' => $orders['user_id'],
                    'zone_id' => $orders['zone_id'],
                    'nickname' => $orders['nickname'],
                    'order_id' => $orders['order_id'],
                    'metode' => $orders['method'],
                    'total_harga' => $orders['price'],
                    'keterangan' => $ket,
                ];
            
            
            $messagebody = view("Template/gmail", $data);
            
            $email_smtp->setMessage($messagebody);
            $email_smtp->setMailType('html');  
            
            $email_smtp->send();
		}
	}
	
	public function status($orders, $status, $ket) {
	    
	   $check_games = $this->data_where_array('games', [
                'id' => $orders['games_id'],
            ]);
        
        if ($check_games[0]['target'] != 'default') {
            if($orders['method'] == 'API') {
                $ket = $orders['order_id'];
            }
            
            if($orders['method'] == 'SELLER DIGI') {
                $ket = $orders['nickname'].$orders['order_id'];
            }
        }
		    
		    
	    $this->data_update('orders', [
            'status' => $status,
            'ket' => $ket,
        ], $orders['id']);
        
        if($orders['callback_url']) {
            $this->send_callback($orders['order_id']);
        }
        
        if($orders['method'] == 'SELLER DIGI') {
            $this->send_callback_digiflazz($orders['order_id']);
        }
		
        
        if ($status == 'Success') {
            
            if(isset($id_product_voucher)){
                if($status == "Success"){
                    $this->data_update('product_voucher', ['is_sold' => true], $id_product_voucher);
                }
		    }
            
            $top = $this->data_where_array('top', [
                'user_id' => $orders['user_id'],
                'games_id' => $orders['games_id'],
                'periode' => date('Y-m'),
            ]);
            
            if (count($top) == 0) {
                
                $this->data_insert('top', [
                    'user_id' => $orders['user_id'],
                    'nickname' => $orders['nickname'],
                    'games_id' => $orders['games_id'],
                    'total' => 1,
                    'nominal' => $orders['price'],
                    'periode' => date('Y-m'),
                ]);
            } else {
                
                $nickname = $top[0]['nickname'];
                if (!empty($orders['nickname'])) {
                    $nickname = $orders['nickname'];
                }
                
                $this->data_update('top', [
                    'nickname' => $nickname,
                    'total' => $top[0]['total'] + 1,
                    'nominal' => $top[0]['nominal'] + $orders['price'],
                ], $top[0]['id']);
            }

            if($orders['jumlah'] > 1){
            	$product_n = $orders['product'].'( x'.$orders['jumlah'].' )';
            }else{
            	$product_n = $orders['product'];
            }

            $wa_success = $this->u_get('wa_success');
                
                $M_Wa = new M_Wa;
                // $ket_cleaned = trim($ket, '[]'); // Hapus kurung siku
                // $ket_cleaned = str_replace('"', '', $ket_cleaned); // Hapus tanda kutip ganda
                // $ket_parts = explode(',', $ket_cleaned); // Pisahkan berdasarkan koma
                // $final_ket = isset($ket_parts[1]) ? $ket_parts[1] : ''; // Ambil elemen kedua jika tersedia
                
                // Decode JSON menjadi array
                $ketArray = json_decode($ket, true);
                
                // Jika $ketArray null, cek apakah mungkin hanya berupa string tunggal
                if (is_null($ketArray)) {
                    // Jika $ket bukan array JSON, ubah menjadi array dengan satu elemen
                    $ketArray = [$ket];
                }
                
                // Array untuk menampung hasil format
                $formattedItems = [];
                
                // Loop untuk setiap elemen dan format sesuai keinginan
                foreach ($ketArray as $item) {
                    if (!empty($item)) {
                        // Mengganti '/nick: ' dengan 'Nick: ' dan '/ref: ' dengan 'Ref: '
                        $formattedItem = str_replace(['Transaksi Pending', '/nick: ', '/ref: ', ], [' ', 'Nick: ', 'Ref: '], $item);
                        
                        // Menambahkan hasil ke array
                        $formattedItems[] = $formattedItem;
                    }
                }

                // Gabungkan hasil dengan pemisah <br> (baris baru) untuk setiap item
                $final_ket = implode("\n\n", $formattedItems);

                
                $M_Wa->send([
                    'token' => $this->u_get('wa_fonnte'),
                    'target' => $orders['wa'] . ',' . $this->u_get('wa_admin'),
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
                        $orders['order_id'],
                        $product_n,
                        $orders['price'],
                        $orders['user_id'],
                        $orders['zone_id'],
                        $orders['nickname'],
                        $orders['method'],
                        $orders['games'],
                        $final_ket,
                    ], $wa_success),
                ]);
		    
		    $email_smtp = \Config\Services::email();

            $config["protocol"] = "smtp";
            
            //isi sesuai nama domain/mail server
            $config["SMTPHost"]  = "limitzstore.com";
            
            //alamat email SMTP
            $config["SMTPUser"]  = "smtp@limitzstore.com"; 
            
            //password email SMTP
            $config["SMTPPass"]  = "Limitzstore2025!@"; 
            
            $config["SMTPPort"]  = 465;
            $config["SMTPCrypto"] = "ssl";
            
            $email_smtp->initialize($config);
            
            $email_smtp->setFrom("invoice@limitzstore.com", "INVOICE LIMITZSTORE");
            $email_smtp->setTo($orders['email']);
            $email_smtp->setSubject("INVOICE LIMITZSTORE - ". $orders['order_id']);
            
           $data = [
                    'logo' => $this->u_get('logoinvoice'),
                    'title' => 'INVOICE LIMITZSTORE',
                    'Description' => 'Product telah ditambahkan ke akun '.$orders['games'].' bos anda. Jika masih belum masuk, silakan melakukan re-login dan masuk kembali.',
                    'game' => $orders['games'],
                    'product' => $product_n,
                    'user_id' => $orders['user_id'],
                    'zone_id' => $orders['zone_id'],
                    'nickname' => $orders['nickname'],
                    'order_id' => $orders['order_id'],
                    'metode' => $orders['method'],
                    'total_harga' => $orders['price'],
                    'keterangan' => $ket,
                ];
            
            
            $messagebody = view("Template/gmail", $data);
            
            $email_smtp->setMessage($messagebody);
            $email_smtp->setMailType('html');  
            
            $email_smtp->send();
		    }
		   
	}
}