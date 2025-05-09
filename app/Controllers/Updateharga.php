<?php

namespace App\Controllers;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Updateharga extends BaseController {
    
    public function index($action) {
        
        if ($action == 'test-product-list-gp') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.belanjagame.com/product-list-gamepoint',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST'
            ));
            
            $response = curl_exec($curl);
            $result = json_decode($response, true);
            echo  "<pre>"; print_r($result); die;
            
            curl_close($curl);
        }
        
        if ($action == 'test-product-detail-gp') {
            $product_id = 26; //ML 156 PUBG G 26 PUBG INDO 40 
            $post_data = json_encode([
                'product_id' => $product_id,
            ]);
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.belanjagame.com/product-detail-gamepoint',
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
            echo  "<pre>"; print_r($result); die;
            
            curl_close($curl);
        }
        
        if ($action == 'test-order-gp') {
            $order_id = "TESGP000003";
            $product_id = 156; //Mobile Legends
            $package_id = 19958; //5 Diamonds (5 + 0 Bonus) 
            $post_data = json_encode([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'package_id' => $package_id,
            ]);
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.belanjagame.com/order-gamepoint',
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
            
            echo  "<pre>"; print_r($result); die;
            
            curl_close($curl);
        }
        
        if ($action == 'test-pingwb-digiflazz') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/report/hooks/755132/pings');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            
            print_r($result); die;
        }
        if ($action == 'test-buy-digiflazz') {
                $df_user = $this->M_Base->u_get('digi-user');
                $df_key = $this->M_Base->u_get('digi-key');
                
               $post_data = json_encode([
                    'username' => $df_user,
                    'buyer_sku_code' => '15.689',
                    'customer_no' => '471942372079',
                    'ref_id' => 'BGTESTBUY'.date('YMDHis'),
                    'sign' => md5($df_user.$df_key.'BGTESTBUY'.date('YMDHis')),
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
                
                echo "RESPONSE CODE DIGI: "; print_r($result['data']); die;
            }
        
        if($action == 'test'){
            $datas['price'] = '1000';
            $datas['buyer_sku_code'] = '15.1818';
            $product = $this->M_Base->data_where_array('product', [
                'provider' => 'VocaGame',
                'sku' => $datas['buyer_sku_code'],
            ]);

            //echo "<pre>"; print_r($games); die;

            if (count($product) == 1) {
                $price_modal = $product[0]['price_modal'];

                $price_member = $product[0]['price'];
                $diff_price_member = $price_member - $price_modal;
                if($diff_price_member > 0){
                    $price_member_new = $datas['price'] + $diff_price_member;
                }else{
                    $price_member_new = $datas['price'];
                }

                $price_gold = $product[0]['price_gold'];
                $diff_price_gold =  $price_gold - $price_modal;
                if($diff_price_gold > 0){
                    $price_gold_new = $datas['price'] + $diff_price_gold;
                }else{
                    $price_gold_new = $datas['price'];
                }

                $price_silver = $product[0]['price_silver'];
                $diff_price_silver =  $price_silver - $price_modal;
                if($diff_price_silver > 0){
                    $price_silver_new = $datas['price'] + $diff_price_silver;
                }else{
                    $price_silver_new = $datas['price'];
                }

                $price_bisnis = $product[0]['price_bisnis'];
                $diff_price_bisnis = $price_bisnis - $price_modal;
                if($diff_price_bisnis > 0){
                    $price_bisnis_new = $datas['price'] + $diff_price_bisnis;
                }else{
                    $price_bisnis_new = $datas['price'];
                }

                $price_seller = $product[0]['price_seller'];
                $diff_price_seller = $price_seller - $price_modal;
                if($diff_price_seller > 0){
                    $price_seller_new = $datas['price'] + $diff_price_seller;
                }else{
                    $price_seller_new = $datas['price'];
                }


                if(isset($product['games_id'])){
                    $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                    if(!empty($data_profit_setting)){
                        if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                            
                            $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                            $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                            $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                            $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                        }
                    }
                }
                        
                /*$this->M_Base->data_update('product', [
                    'price_modal' => $datas['price'],
                    'price' => $price_member_new,
                    'price_gold' => $price_gold_new,
                    'price_silver' => $price_silver_new,
                    'price_bisnis' => $price_bisnis_new,
                    'price_seller' => $price_seller_new,
                ], $product[0]['id']);*/

                $product_name = $games_name = "";
                if(isset($product[0]['games_id'])){
                    $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                    if(isset($games[0]['games'])){
                        $games_name = $games[0]['games'];
                    }
                }
                if($product[0]['product']){
                    $product_name = $product[0]['product'];
                }

                echo '<pre>';
                if($product[0]['price_modal'] != $datas['price']){
                    echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                    if($product[0]['price_modal'] < $datas['price']){
                    echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$datas['price'].'<br/>';
                    echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                    echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                    echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                    echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                    echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                    }else{
                    echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$datas['price'].'<br/>';
                    echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                    echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                    echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                    echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                    echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                    }
                    echo '=============================================================================================<br />';
                }
                echo '</pre>';
             }
       } 

       if ($action == 'test-digiflazz') {
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
            
            echo "<pre>"; print_r($result); die;
            
            if(!empty($result['data'])){

                foreach ($result['data'] as $datas) {
                     
                    $product = array();
                    if(isset($datas['buyer_sku_code'])){
                        $product = $this->M_Base->data_where_array('product', [
                            'provider' => 'DF',
                            'sku' => $datas['buyer_sku_code'],
                        ]);
                    } 
                    if (count($product) == 1) {

                        $price_modal = $product[0]['price_modal'];

                        $price_member = $product[0]['price'];
                        $diff_price_member = $price_member - $price_modal;
                        if($diff_price_member > 0){
                            $price_member_new = $datas['price'] + $diff_price_member;
                        }else{
                            $price_member_new = $datas['price'];
                        }

                        $price_gold = $product[0]['price_gold'];
                        $diff_price_gold =  $price_gold - $price_modal;
                        if($diff_price_gold > 0){
                            $price_gold_new = $datas['price'] + $diff_price_gold;
                        }else{
                            $price_gold_new = $datas['price'];
                        }

                        $price_silver = $product[0]['price_silver'];
                        $diff_price_silver =  $price_silver - $price_modal;
                        if($diff_price_silver > 0){
                            $price_silver_new = $datas['price'] + $diff_price_silver;
                        }else{
                            $price_silver_new = $datas['price'];
                        }

                        $price_bisnis = $product[0]['price_bisnis'];
                        $diff_price_bisnis = $price_bisnis - $price_modal;
                        if($diff_price_bisnis > 0){
                            $price_bisnis_new = $datas['price'] + $diff_price_bisnis;
                        }else{
                            $price_bisnis_new = $datas['price'];
                        }

                        $price_seller = $product[0]['price_seller'];
                        $diff_price_seller = $price_seller - $price_modal;
                        if($diff_price_seller > 0){
                            $price_seller_new = $datas['price'] + $diff_price_seller;
                        }else{
                            $price_seller_new = $datas['price'];
                        }

                        if(isset($product['games_id'])){
                            $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                            if(!empty($data_profit_setting)){
                                if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                                    
                                    $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                                    $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                                    $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                                    $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                                }
                            }
                        }
                                
                        /*$this->M_Base->data_update('product', [
                            'price_modal' => $datas['price'],
                            'price' => $price_member_new,
                            'price_gold' => $price_gold_new,
                            'price_silver' => $price_silver_new,
                            'price_bisnis' => $price_bisnis_new,
                            'price_seller' => $price_seller_new,
                        ], $product[0]['id']);*/
                        
                        $product_name = $games_name = "";
                        if(isset($product[0]['games_id'])){
                            $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                            if(isset($games[0]['games'])){
                                $games_name = $games[0]['games'];
                            }
                        }
                        if($product[0]['product']){
                            $product_name = $product[0]['product'];
                        }

                        echo '<pre>';
                        if($product[0]['price_modal'] != $datas['price']){
                            echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                            if($product[0]['price_modal'] < $datas['price']){
                            echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$datas['price'].'<br/>';
                            echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                            echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                            echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                            echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                            echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                            }else{
                            echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$datas['price'].'<br/>';
                            echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                            echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                            echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                            echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                            echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                            }
                            echo '=============================================================================================<br />';
                        }
                        echo '</pre>';
                    }      
                }
            }else{

               echo 'Output hasil dari memanggil data API DIGIFLAZZ: <br />';
               echo '<pre>'; print_r($result); die;
            }

       }

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
            
            if(!empty($result['data'])){

                 foreach ($result['data'] as $datas) {
                     
                    $product = array();
                    if(isset($datas['buyer_sku_code'])){
                        $product = $this->M_Base->data_where_array('product', [
                            'provider' => 'DF',
                            'sku' => $datas['buyer_sku_code'],
                        ]);
                    } 
                    
                    if (count($product) == 1) {

                        $price_modal = $product[0]['price_modal'];

                        $price_member = $product[0]['price'];
                        $diff_price_member = $price_member - $price_modal;
                        if($diff_price_member > 0){
                            $price_member_new = $datas['price'] + $diff_price_member;
                        }else{
                            $price_member_new = $datas['price'];
                        }

                        $price_gold = $product[0]['price_gold'];
                        $diff_price_gold =  $price_gold - $price_modal;
                        if($diff_price_gold > 0){
                            $price_gold_new = $datas['price'] + $diff_price_gold;
                        }else{
                            $price_gold_new = $datas['price'];
                        }

                        $price_silver = $product[0]['price_silver'];
                        $diff_price_silver =  $price_silver - $price_modal;
                        if($diff_price_silver > 0){
                            $price_silver_new = $datas['price'] + $diff_price_silver;
                        }else{
                            $price_silver_new = $datas['price'];
                        }

                        $price_bisnis = $product[0]['price_bisnis'];
                        $diff_price_bisnis = $price_bisnis - $price_modal;
                        if($diff_price_bisnis > 0){
                            $price_bisnis_new = $datas['price'] + $diff_price_bisnis;
                        }else{
                            $price_bisnis_new = $datas['price'];
                        }

                        $price_seller = $product[0]['price_seller'];
                        $diff_price_seller = $price_seller - $price_modal;
                        if($diff_price_seller > 0){
                            $price_seller_new = $datas['price'] + $diff_price_seller;
                        }else{
                            $price_seller_new = $datas['price'];
                        }

                        if(isset($product['games_id'])){
                            $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                            if(!empty($data_profit_setting)){
                                if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                                    
                                    $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                                    $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                                    $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                                    $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                                }
                            }
                        }
                                
                        /*$this->M_Base->data_update('product', [
                            'price_modal' => $datas['price'],
                        ], $product[0]['id']);*/

                        $this->M_Base->data_update('product', [
                            'price_modal' => $datas['price'],
                            'price' => $price_member_new,
                            'price_gold' => $price_gold_new,
                            'price_silver' => $price_silver_new,
                            'price_bisnis' => $price_bisnis_new,
                            'price_seller' => $price_seller_new,
                        ], $product[0]['id']);

                        $product_name = $games_name = "";
                        if(isset($product[0]['games_id'])){
                            $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                            if(isset($games[0]['games'])){
                                $games_name = $games[0]['games'];
                            }
                        }
                        if($product[0]['product']){
                            $product_name = $product[0]['product'];
                        }

                        echo '<pre>';
                        if($product[0]['price_modal'] != $datas['price']){
                            echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                            if($product[0]['price_modal'] < $datas['price']){
                            echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$datas['price'].'<br/>';
                            echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                            echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                            echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                            echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                            echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                            }else{
                            echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$datas['price'].'<br/>';
                            echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                            echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                            echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                            echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                            echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                            }
                            echo '=============================================================================================<br />';
                        }
                        echo '</pre>';
                        
                        //echo 'berhasil update price modal '.$datas['price'].' id product '.$product[0]['id'].'<br/>';
                    }
                     
                 }
            }else{

               echo 'Output hasil dari memanggil data API DIGIFLAZZ: <br />';
               echo '<pre>'; print_r($result); die;

            }

        }

        
        if ($action == 'test-bangjeff') {
            $result = $this->M_Base->bj('https://api.bangjeff.com/api/v3/product', []);
            
            if(!empty($result['data'])){

                foreach ($result['data'] as $loop) {
                        
                    $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/variant', [
                        'code' => $loop['code']
                    ]);

                    foreach ($response['data'] as $data) {
                        
                        $product = array();
                        if(isset($data['code'])){
                            $product = $this->M_Base->data_where_array('product', [
                                'provider' => 'BangJeff',
                                'sku' => $data['code'],
                            ]);
                        }    

                        if (count($product) == 1) {

                            $price_modal = $product[0]['price_modal'];

                            $price_member = $product[0]['price'];
                            $diff_price_member = $price_member - $price_modal;
                            if($diff_price_member > 0){
                                $price_member_new = $data['price'] + $diff_price_member;
                            }else{
                                $price_member_new = $data['price'];
                            }

                            $price_gold = $product[0]['price_gold'];
                            $diff_price_gold =  $price_gold - $price_modal;
                            if($diff_price_gold > 0){
                                $price_gold_new = $data['price'] + $diff_price_gold;
                            }else{
                                $price_gold_new = $data['price'];
                            }

                            $price_silver = $product[0]['price_silver'];
                            $diff_price_silver =  $price_silver - $price_modal;
                            if($diff_price_silver > 0){
                                $price_silver_new = $data['price'] + $diff_price_silver;
                            }else{
                                $price_silver_new = $data['price'];
                            }

                            $price_bisnis = $product[0]['price_bisnis'];
                            $diff_price_bisnis = $price_bisnis - $price_modal;
                            if($diff_price_bisnis > 0){
                                $price_bisnis_new = $data['price'] + $diff_price_bisnis;
                            }else{
                                $price_bisnis_new = $data['price'];
                            }

                            $price_seller = $product[0]['price_seller'];
                            $diff_price_seller = $price_seller - $price_modal;
                            if($diff_price_seller > 0){
                                $price_seller_new = $data['price'] + $diff_price_seller;
                            }else{
                                $price_seller_new = $data['price'];
                            }

                            if(isset($product['games_id'])){
                                $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                                if(!empty($data_profit_setting)){
                                    if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                                        
                                        $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                                        $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                                        $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                                        $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                                    }
                                }
                            }

                            /*$this->M_Base->data_update('product', [
                                'price_modal' => $data['price'],
                                'price' => $price_member_new,
                                'price_gold' => $price_gold_new,
                                'price_silver' => $price_silver_new,
                                'price_bisnis' => $price_bisnis_new,
                                'price_seller' => $price_seller_new,
                            ], $product[0]['id']);*/

                            $product_name = $games_name = "";
                            if(isset($product[0]['games_id'])){
                                $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                                if(isset($games[0]['games'])){
                                    $games_name = $games[0]['games'];
                                }
                            }
                            if($product[0]['product']){
                                $product_name = $product[0]['product'];
                            }

                            echo '<pre>';
                            if($product[0]['price_modal'] != $data['price']){
                                echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                                if($product[0]['price_modal'] < $data['price']){
                                echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }else{
                                echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }
                                echo '=============================================================================================<br />';
                            }
                            echo '</pre>';

                        }

                    }
                }
            }else{
                echo 'Output hasil dari memanggil data API BANGJEFF: <br />';
                echo '<pre>'; print_r($result); die;
            }
        }


        if ($action == 'bangjeff') {
            $result = $this->M_Base->bj('https://api.bangjeff.com/api/v3/product', []);
            
            if(!empty($result['data'])){
                foreach ($result['data'] as $loop) {
                        
                    $response = $this->M_Base->bj('https://api.bangjeff.com/api/v3/variant', [
                        'code' => $loop['code']
                    ]);

                        foreach ($response['data'] as $data) {
                            
                        $product = array();
                        if(isset($data['code'])){
                            $product = $this->M_Base->data_where_array('product', [
                                'provider' => 'BangJeff',
                                'sku' => $data['code'],
                            ]);
                        }    

                        if (count($product) == 1) {

                            $price_modal = $product[0]['price_modal'];

                            $price_member = $product[0]['price'];
                            $diff_price_member = $price_member - $price_modal;
                            if($diff_price_member > 0){
                                $price_member_new = $data['price'] + $diff_price_member;
                            }else{
                                $price_member_new = $data['price'];
                            }

                            $price_gold = $product[0]['price_gold'];
                            $diff_price_gold =  $price_gold - $price_modal;
                            if($diff_price_gold > 0){
                                $price_gold_new = $data['price'] + $diff_price_gold;
                            }else{
                                $price_gold_new = $data['price'];
                            }

                            $price_silver = $product[0]['price_silver'];
                            $diff_price_silver =  $price_silver - $price_modal;
                            if($diff_price_silver > 0){
                                $price_silver_new = $data['price'] + $diff_price_silver;
                            }else{
                                $price_silver_new = $data['price'];
                            }

                            $price_bisnis = $product[0]['price_bisnis'];
                            $diff_price_bisnis = $price_bisnis - $price_modal;
                            if($diff_price_bisnis > 0){
                                $price_bisnis_new = $data['price'] + $diff_price_bisnis;
                            }else{
                                $price_bisnis_new = $data['price'];
                            }

                            $price_seller = $product[0]['price_seller'];
                            $diff_price_seller = $price_seller - $price_modal;
                            if($diff_price_seller > 0){
                                $price_seller_new = $data['price'] + $diff_price_seller;
                            }else{
                                $price_seller_new = $data['price'];
                            }


                            if(isset($product['games_id'])){
                                $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                                if(!empty($data_profit_setting)){
                                    if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                                        
                                        $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                                        $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                                        $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                                        $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                                    }
                                }
                            }

                            /*$this->M_Base->data_update('product', [
                                    'price_modal' => $data['price'],
                            ], $product[0]['id']);*/

                            $this->M_Base->data_update('product', [
                                'price_modal' => $data['price'],
                                'price' => $price_member_new,
                                'price_gold' => $price_gold_new,
                                'price_silver' => $price_silver_new,
                                'price_bisnis' => $price_bisnis_new,
                                'price_seller' => $price_seller_new,
                            ], $product[0]['id']);

                            $product_name = $games_name = "";
                            if(isset($product[0]['games_id'])){
                                $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                                if(isset($games[0]['games'])){
                                    $games_name = $games[0]['games'];
                                }
                            }
                            if($product[0]['product']){
                                $product_name = $product[0]['product'];
                            }

                            echo '<pre>';
                            if($product[0]['price_modal'] != $data['price']){
                                echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                                if($product[0]['price_modal'] < $data['price']){
                                echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }else{
                                echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }
                                echo '=============================================================================================<br />';
                            }
                            echo '</pre>';

                            //echo 'berhasil update price modal '.$data['price'].' id product '.$product[0]['id'].'<br/>';

                        }

                    }
                }
            }else{

                echo 'Output hasil dari memanggil data API BANGJEFF: <br />';
                echo '<pre>'; print_r($result); die;
            }
        }

        
        if ($action == 'test-vocagame') {
            $result = $this->M_Voca->trx('GET', [], 'products', 'products', [
                'merchant' => $this->M_Base->u_get('voca_merchant'),
                'secret' => $this->M_Base->u_get('voca_secret'),
                'key' => $this->M_Base->u_get('voca_key'),
            ]);
            
            if(!empty($result['data'])){

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
                            $price_modal = $product[0]['price_modal'];

                            $price_member = $product[0]['price'];
                            $diff_price_member = $price_member - $price_modal;
                            if($diff_price_member > 0){
                                $price_member_new = $data['price'] + $diff_price_member;
                            }else{
                                $price_member_new = $data['price'];
                            }

                            $price_gold = $product[0]['price_gold'];
                            $diff_price_gold =  $price_gold - $price_modal;
                            if($diff_price_gold > 0){
                                $price_gold_new = $data['price'] + $diff_price_gold;
                            }else{
                                $price_gold_new = $data['price'];
                            }

                            $price_silver = $product[0]['price_silver'];
                            $diff_price_silver =  $price_silver - $price_modal;
                            if($diff_price_silver > 0){
                                $price_silver_new = $data['price'] + $diff_price_silver;
                            }else{
                                $price_silver_new = $data['price'];
                            }

                            $price_bisnis = $product[0]['price_bisnis'];
                            $diff_price_bisnis = $price_bisnis - $price_modal;
                            if($diff_price_bisnis > 0){
                                $price_bisnis_new = $data['price'] + $diff_price_bisnis;
                            }else{
                                $price_bisnis_new = $data['price'];
                            }

                            $price_seller = $product[0]['price_seller'];
                            $diff_price_seller = $price_seller - $price_modal;
                            if($diff_price_seller > 0){
                                $price_seller_new = $data['price'] + $diff_price_seller;
                            }else{
                                $price_seller_new = $data['price'];
                            }

                            if(isset($product['games_id'])){
                                $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                                if(!empty($data_profit_setting)){
                                    if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                                        
                                        $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                                        $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                                        $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                                        $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                                    }
                                }
                            }

                            /*$this->M_Base->data_update('product', [
                                'price_modal' => $data['price'],
                                'price' => $price_member_new,
                                'price_gold' => $price_gold_new,
                                'price_silver' => $price_silver_new,
                                'price_bisnis' => $price_bisnis_new,
                                'price_seller' => $price_seller_new,
                            ], $product[0]['id']);*/

                            $product_name = $games_name = "";
                            if(isset($product[0]['games_id'])){
                                $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                                if(isset($games[0]['games'])){
                                    $games_name = $games[0]['games'];
                                }
                            }
                            if($product[0]['product']){
                                $product_name = $product[0]['product'];
                            }

                            echo '<pre>';
                            //if($product[0]['price_modal'] != $data['price']){
                                echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                                if($product[0]['price_modal'] < $data['price']){
                                echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }elseif($product[0]['price_modal'] > $data['price']){
                                echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }else{
                                echo 'Price Modal SAMA dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member SAMA dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold SAMA dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver SAMA dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis SAMA dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller SAMA dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }
                                echo '=============================================================================================<br />';
                            //}
                            echo '</pre>';

                        }
                    }
                }

            }else{

                echo 'Output hasil dari memanggil data API VOCAGAME: <br />';
                echo '<pre>'; print_r($result); die;
            }

        }


        if ($action == 'vocagame') {
            $result = $this->M_Voca->trx('GET', [], 'products', 'products', [
                'merchant' => $this->M_Base->u_get('voca_merchant'),
                'secret' => $this->M_Base->u_get('voca_secret'),
                'key' => $this->M_Base->u_get('voca_key'),
            ]);

            if(!empty($result['data'])){

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
                            $price_modal = $product[0]['price_modal'];

                            $price_member = $product[0]['price'];
                            $diff_price_member = $price_member - $price_modal;
                            if($diff_price_member > 0){
                                $price_member_new = $data['price'] + $diff_price_member;
                            }else{
                                $price_member_new = $data['price'];
                            }

                            $price_gold = $product[0]['price_gold'];
                            $diff_price_gold =  $price_gold - $price_modal;
                            if($diff_price_gold > 0){
                                $price_gold_new = $data['price'] + $diff_price_gold;
                            }else{
                                $price_gold_new = $data['price'];
                            }

                            $price_silver = $product[0]['price_silver'];
                            $diff_price_silver =  $price_silver - $price_modal;
                            if($diff_price_silver > 0){
                                $price_silver_new = $data['price'] + $diff_price_silver;
                            }else{
                                $price_silver_new = $data['price'];
                            }

                            $price_bisnis = $product[0]['price_bisnis'];
                            $diff_price_bisnis = $price_bisnis - $price_modal;
                            if($diff_price_bisnis > 0){
                                $price_bisnis_new = $data['price'] + $diff_price_bisnis;
                            }else{
                                $price_bisnis_new = $data['price'];
                            }

                            $price_seller = $product[0]['price_seller'];
                            $diff_price_seller = $price_seller - $price_modal;
                            if($diff_price_seller > 0){
                                $price_seller_new = $data['price'] + $diff_price_seller;
                            }else{
                                $price_seller_new = $data['price'];
                            }
                            
                            if(isset($product['games_id'])){
                                $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $product['games_id']);
                                if(!empty($data_profit_setting)){
                                    if(($data_profit_setting[0]['profit'] > 0) && ($data_profit_setting[0]['profit_silver'] > 0) && ($data_profit_setting[0]['profit_gold'] > 0) && ($data_profit_setting[0]['profit_bisnis'] > 0)){
                                        
                                        $price_member_new = $datas['price'] / ($data_profit_setting[0]['profit']/100);
                                        $price_silver_new = $datas['price'] / ($data_profit_setting[0]['profit_silver']/100);
                                        $price_gold_new = $datas['price'] / ($data_profit_setting[0]['profit_gold']/100);
                                        $price_bisnis_new = $datas['price'] / ($data_profit_setting[0]['profit_bisnis']/100);

                                    }
                                }
                            }
                            $this->M_Base->data_update('product', [
                                'price_modal' => $data['price'],
                                'price' => $price_member_new,
                                'price_gold' => $price_gold_new,
                                'price_silver' => $price_silver_new,
                                'price_bisnis' => $price_bisnis_new,
                                'price_seller' => $price_seller_new 
                            ], $product[0]['id']);

                            $product_name = $games_name = "";
                            if(isset($product[0]['games_id'])){
                                $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);
                                if(isset($games[0]['games'])){
                                    $games_name = $games[0]['games'];
                                }
                            }
                            if($product[0]['product']){
                                $product_name = $product[0]['product'];
                            }

                            echo '<pre>';
                            if($product[0]['price_modal'] != $data['price']){
                                echo 'Berhasil update harga untuk id product '.$product[0]['id'].' ===> '.$games_name.' ('.$product_name.'): <br/>';
                                if($product[0]['price_modal'] < $data['price']){
                                echo 'Price Modal NAIK dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member NAIK dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold NAIK dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver NAIK dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis NAIK dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller NAIK dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }else{
                                echo 'Price Modal TURUN dari '.$product[0]['price_modal'].' menjadi '.$data['price'].'<br/>';
                                echo 'Price Member TURUN dari '.$product[0]['price'].' menjadi '.$price_member_new.'<br/>';
                                echo 'Price Gold TURUN dari '.$product[0]['price_gold'].' menjadi '.$price_gold_new.'<br/>';
                                echo 'Price Silver TURUN dari '.$product[0]['price_silver'].' menjadi '.$price_silver_new.'<br/>';
                                echo 'Price Bisnis TURUN dari '.$product[0]['price_bisnis'].' menjadi '.$price_bisnis_new.'<br/>';
                                echo 'Price Seller TURUN dari '.$product[0]['price_seller'].' menjadi '.$price_seller_new.'<br/>';
                                }
                                echo '=============================================================================================<br />';
                            }
                            echo '</pre>';

                        }
                    }
                }

            }else{

                echo 'Output hasil dari memanggil data API VOCAGAME: <br />';
                echo '<pre>'; print_r($result); die;
            }
        }


    }
}