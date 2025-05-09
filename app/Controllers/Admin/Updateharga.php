<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Updateharga extends BaseController {
    
    
    private function number_format_accepted($str_number=""){
        if($str_number){
            $str_number = str_replace(',','.',$str_number);
            $str_number = preg_replace('/[^0-9a-zA-Z.]/', '', $str_number);
        }

        return $str_number;
    }

    public function index() {

        $data_profit_setting = array();
        if ($this->request->getPost('tombol')) {
            $games = $this->number_format_accepted($this->request->getPost('games'));
            $profit = $this->number_format_accepted($this->request->getPost('profit'));
            $profit_silver = $this->number_format_accepted($this->request->getPost('profit_silver'));
            $profit_gold = $this->number_format_accepted($this->request->getPost('profit_gold'));
            $profit_bisnis = $this->number_format_accepted($this->request->getPost('profit_bisnis'));

            $data_post = [
                'games' => $games,
                'profit' => $profit,
                'profit_silver' => $profit_silver,
                'profit_gold' => $profit_gold,
                'profit_bisnis' => $profit_bisnis,
            ];

            // Find by games_id
            $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $games);
            if(empty($data_profit_setting)){
                $data_post_insert = [
                    'games_id' => $games,
                    'profit' => $profit,
                    'profit_silver' => $profit_silver,
                    'profit_gold' => $profit_gold,
                    'profit_bisnis' => $profit_bisnis,
                ];
                $this->M_Base->data_insert('product_margin_setting', $data_post_insert);
            }else{
                $data_post_update = [
                    'games_id' => $games,
                    'profit' => $profit,
                    'profit_silver' => $profit_silver,
                    'profit_gold' => $profit_gold,
                    'profit_bisnis' => $profit_bisnis,
                    'modified' => date("Y-m-d H:i:s"),
                ];

                $this->M_Base->data_update('product_margin_setting', $data_post_update, $data_profit_setting[0]['id']);   
            }

            if($profit == "" || $profit_silver == "" || $profit_gold == "" || $profit_bisnis == ""){
                $this->session->setFlashdata('success', 'Nilai Persen Profit berhasil diupdate');
            }else{
                $query = $this->M_Base->data_where('product', 'games_id', $games);
                foreach($query as $resultquery) {
                    $product = $this->M_Base->data_where_array('product', [
                        'id' => $resultquery['id']
                    ]);
                        
                    if (count($product) == 1) {
                        if($product[0]['id'] == $resultquery['id'])  {
                            $price_modal = $resultquery['price_modal'];

                            $new_price = $new_price_silver = $new_price_gold = $new_price_bisnis = 0;

                            if($profit > 0){
                                $new_price = $price_modal / ($profit / 100);
                            }

                            if($profit_silver > 0){
                                $new_price_silver = $price_modal / ($profit_silver / 100);
                            }

                            if($profit_gold > 0){
                                $new_price_gold = $price_modal / ($profit_gold / 100);
                            }

                            if($profit_bisnis > 0){
                                $new_price_bisnis = $price_modal / ($profit_bisnis / 100);
                            }
                            
                            $this->M_Base->data_update('product', [
                                'price' => $new_price,
                                'price_silver' => $new_price_silver,
                                'price_gold' => $new_price_gold,
                                'price_bisnis' => $new_price_bisnis,
                            ], $product[0]['id']);
                        }
                    }
                }
                $this->session->setFlashdata('success', 'Nilai Persen Profit dan Harga berhasil diupdate');
            }
              
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));

            if(isset($data_post['games'])){
                $data_profit_setting = $this->M_Base->data_where('product_margin_setting', 'games_id', $games);
            }

        }


        $data = array_merge($this->base_data, [
    		'title' => 'Update Harga Percent',
    		'games' => $this->M_Base->all_data_order_asc('games','games'),
            'profit_setting' => $data_profit_setting,
    	]);

        return view('Admin/Produk/updateharga', $data);
    }


    public function ajax_load_profit_setting(){

        $games_id = $this->request->getPost('games');
        $jsonData = array(
            'profit' => '',
            'profit_gold' => '',
            'profit_silver' => '',
            'profit_bisnis' => '',
        );
        if($games_id){
            $data = $this->M_Base->data_where('product_margin_setting', 'games_id', $games_id);
            if(!empty($data)){
                $jsonData = array(
                    'profit' => $data[0]['profit'],
                    'profit_gold' => $data[0]['profit_gold'],
                    'profit_silver' => $data[0]['profit_silver'],
                    'profit_bisnis' => $data[0]['profit_bisnis'],
                ); 
            }
        }
        return $this->response->setJSON([
            'status' => true,
            'data' => $jsonData
        ]);
    }

}