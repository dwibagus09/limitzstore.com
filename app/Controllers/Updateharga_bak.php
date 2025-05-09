<?php

namespace App\Controllers;

class Updateharga extends BaseController {
    
    public function index($action) {
            
           if ($action == 'digiflazz') {
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
                
                 foreach ($result['data'] as $datas) {
                     
                         $product = $this->M_Base->data_where_array('product', [
                        'provider' => 'DF',
                        'sku' => $datas['buyer_sku_code'],
                    ]);
                    
                        if (count($product) == 1) {
                                
                                $this->M_Base->data_update('product', [
                                    'price_modal' => $datas['price'],
                                ], $product[0]['id']);
                                
                                echo 'berhasil update price modal '.$datas['price'].' id product '.$product[0]['id'].'<br/>';
                     }
                     
                 }
            }
            
            if ($action == 'bangjeff') {
                $result = $this->M_Base->bj('https://api.bangjeff.com/api/v3/product', []);
                
                foreach ($result['data'] as $loop) {
                        
                        $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/variant', [
                            'code' => $loop['code']
                        ]);
                        
                        foreach ($response['data'] as $data) {
                                    
                            $product = $this->M_Base->data_where_array('product', [
                                'provider' => 'BangJeff',
                                'sku' => $data['code'],
                            ]);
                            
                            
                            if (count($product) == 1) {
                         
                                    
                                $this->M_Base->data_update('product', [
                                        'price_modal' => $data['price'],
                                ], $product[0]['id']);
                                
                                echo 'berhasil update price modal '.$data['price'].' id product '.$product[0]['id'].'<br/>';
                                }
                        }
                }
            }
            
            if ($action == 'vocagame') {
                $result = $this->M_Voca->trx('GET', [], 'products', 'products', [
                    'merchant' => $this->M_Base->u_get('voca_merchant'),
                    'secret' => $this->M_Base->u_get('voca_secret'),
                    'key' => $this->M_Base->u_get('voca_key'),
                ]);
                
                foreach ($result['data'] as $loop){
                     $resultitems = $this->M_Voca->trx('GET', [], 'products/' . $loop['id'] .'/items', 'products/' . $loop['id'] .'/items', [
                        'merchant' => $this->M_Base->u_get('voca_merchant'),
                        'secret' => $this->M_Base->u_get('voca_secret'),
                        'key' => $this->M_Base->u_get('voca_key'),
                    ]);
                    
                    foreach ($resultitems['data'] as $data) { 
                            $product = $this->M_Base->data_where_array('product', [
                                    'provider' => 'VocaGame',
                                    'sku' => $loop['id'].'.'.$data['id'],
                                ]);
                            
                             if (count($product) == 1) {
                         
                                $this->M_Base->data_update('product', [
                                        'price_modal' => $data['price'],
                                ], $product[0]['id']);
                                
                                echo 'berhasil update price modal '.$data['price'].' id product '.$product[0]['id'].'<br/>';
                                }
                        }
                    }
                }
    }
}