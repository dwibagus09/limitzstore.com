<?php

namespace App\Controllers;

class Home extends BaseController {
    
    
    public function sistem_voca($action = null, $id = null) {

        if ($action === 'trx') {
            
            $result = $this->M_Voca->trx('POST', [
                'productId' => $exp_sku[0],
                'productItemId' => $exp_sku[1],
                'reference' => $order_id,
                'data' => [
                    'userId' => $data_post['user_id'],
                    'zoneId' => $data_post['zone_id'],
                ],
                'callbackUrl' => base_url() . '/sistem/callback/vocagame',
            ], 'transaction', 'transaction/' . $order_id, [
                'merchant' => $this->M_Base->u_get('voca_merchant'),
                'secret' => $this->M_Base->u_get('voca_secret'),
                'key' => $this->M_Base->u_get('voca_key'),
            ]);
            
            var_dump($result); die;
            
        } else  if ($action === 'games') {

            $result = $this->M_Voca->trx('GET', [], 'products', 'products', [
                'merchant' => $this->M_Base->u_get('voca_merchant'),
                'secret' => $this->M_Base->u_get('voca_secret'),
                'key' => $this->M_Base->u_get('voca_key'),
            ]);

            if ($result) {

                if (array_key_exists('statusCode', $result)) {
                    echo $result['message'];
                } else {
                    echo '<table border="1" cellpadding="10" cellspacing="0">';
                    echo '
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Kode</th>
                        <th>Tipe</th>
                        <th colspan="2">Action</th>
                    </tr>
                    ';
                    foreach ($result['data'] as $loop) {
                        echo '
                        <tr>
                            <td>'.$loop['id'].'</td>
                            <td>'.$loop['title'].'</td>
                            <td>'.$loop['code'].'</td>
                            <td>'.$loop['type'].'</td>
                            <td><a href="/home/sistem_voca/product/'.$loop['id'].'">Produk</a></td>
                            <td><a href="/home/sistem_voca/detail/'.$loop['id'].'">Detail</a></td>
                        </tr>
                        ';
                    }
                    echo '</table>';
                }
            }
        } else if ($action === 'product') {

            if ($id) {

                $path = 'products/' . $id . '/items';

                $result = $this->M_Voca->trx('GET', [
                    'productId' => $id,
                ], $path, $path, [
                    'merchant' => $this->M_Base->u_get('voca_merchant'),
                    'secret' => $this->M_Base->u_get('voca_secret'),
                    'key' => $this->M_Base->u_get('voca_key'),
                ]);

                if ($result) {

                    if (array_key_exists('statusCode', $result)) {
                        echo $result['message'];
                    } else {
                        echo '<a href="/home/sistem_voca/games">Kembali</a><br>';
                        echo '<table border="1" cellpadding="10" cellspacing="0">';
                        echo '
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Voucher Stok</th>
                        </tr>
                        ';
                        foreach ($result['data'] as $loop) {

                            $status = $loop['isActive'] == 1 ? 'Aktif' : 'Gangguan';

                            echo '
                            <tr>
                                <td>'.$loop['id'].'</td>
                                <td>'.$loop['name'].'</td>
                                <td>'.$loop['price'].'</td>
                                <td>'.$status.'</td>
                                <td>'.$loop['voucherStock'].'</td>
                            </tr>
                            ';
                        }
                        echo '</table>';
                    }
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($action === 'detail') {

            if ($id) {

                $path = 'products/' . $id;

                $result = $this->M_Voca->trx('GET', [], $path, $path, [
                    'merchant' => $this->M_Base->u_get('voca_merchant'),
                    'secret' => $this->M_Base->u_get('voca_secret'),
                    'key' => $this->M_Base->u_get('voca_key'),
                ]);

                if ($result) {

                    if (array_key_exists('statusCode', $result)) {
                        echo $result['message'];
                    } else {

                        $input = [];

                        foreach ($result['data']['userInput']['fields'] as $loop) {
                            $input[] = $loop['attrs']['name'];
                        }

                        echo '<a href="/home/sistem_voca/games">Kembali</a><br>';
                        echo '<ul>';
                        echo '
                        <li><b>Games ID</b> : '.$result['data']['id'].'</li>
                        <li><b>Judul</b> : '.$result['data']['title'].'</li>
                        <li><b>Kode</b> : '.$result['data']['code'].'</li>
                        <li><b>Tipe</b> : '.$result['data']['type'].'</li>
                        <li><b>Instruksi</b> : '.$result['data']['userInput']['instructionText'].'</li>
                        <li><b>Input</b> : '.implode('|', $input).'</li>
                        ';
                        echo '</ul>';
                    }
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public static function fetch($url, $data) {
    	$curl = curl_init();
    	curl_setopt_array($curl, [
    		CURLOPT_URL => $url . "?" . http_build_query($data),
    		CURLOPT_CUSTOMREQUEST => 'GET',
    		CURLOPT_RETURNTRANSFER => TRUE,
    		CURLOPT_FOLLOWLOCATION => TRUE
   		]); $response = curl_exec($curl);
   		curl_close($curl);
   		
   		return json_decode($response, true);
    }
    
    public function test() {
      
        $this->M_Base->send_callback('WQS18276601042024');

    }
    
    public function index() {
        
        $search = null;
        
        if ($this->request->getGet('search')) {
            
            $search = addslashes(trim(htmlspecialchars($this->request->getGet('search'))));
        }
        
        $category = [];

        if ($search) {
            
            $data_games = [];
            
            foreach ($this->M_Base->data_like('games', 'games', $search) as $loop) {
                
                if ($loop['status'] == 'On') {
                    
                    $data_games[] = $loop;
                }
            }
            
            $games[] = [
                'id' => '1',
                'category' => 'Pencarian ' . $search,
                'games' => $data_games,
            ];
            
        } else {
            $games = [];
            foreach (array_reverse($this->M_Base->all_data_order('category', 'sort')) as $data_category) {
                
                $data_games = $this->M_Base->data_where_array_asc('games', [
                    'category' => $data_category['id'],
                    'status' => 'On',
                ], 'sort', 6);
                
                if (count($data_games) !== 0) {
                    
                    $category[] = $data_category;
                    
                    $games[] = [
                        'id' => $data_category['id'],
                        'category' => $data_category['category'],
                        'games' => $data_games,
                    ];
                }
            }
        }
        
        $method_regist = [];
        foreach ($this->M_Base->all_data('method') as $loop) {
            $data_price = $this->M_Base->data_where_array('method_regist', [
                'method_id' => $loop['id']
            ]);
            
            $name   = count($data_price) == 1 ? $loop['method'] : '';
            $price  = count($data_price) == 1 ? $data_price[0]['price'] : 0;
            $note   = count($data_price) == 1 ? $data_price[0]['note'] : '';

            $method_regist[] = array_merge($loop, [
                'name' => $name,
                'price' => $price,
                'note' => $note,
            ]);
        }
        
        $fs_product = [];
        
        foreach ($this->M_Base->data_where_array('product', [
            'fs' => 'Y',
            'status' => 'On',
        ]) as $loop) {
            
            $data_games = $this->M_Base->data_where_array('games', ['id' => $loop['games_id'], 'status' => 'On']);
            
            if (count($data_games) == 1) {
                
                $fs_product[] = array_merge($loop, [
                    'games' => $data_games[0],
                ]);
            }
        }
        
        $fs = [
            'date' => $this->M_Base->u_get('fs_date'),
            'status' => $this->M_Base->u_get('fs_status'),
            'product' => $fs_product,
        ];
        
        if ($fs['status'] == 'On') {
            
            if (strtotime($fs['date']) - time() < 1) {
                
                $this->M_Base->u_update('fs_status', 'Off');
                
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

        $buildergames = $this->db->table('games');
        $buildergames->where('status', 'On');
        $buildergames->orderBy('category', 'ASC');
        $allgames = $buildergames->get()->getResultArray();
        
        $populer = [];


        /*$builder = $this->db->table('jumlah_klik');
        $builder->orderBy('jumlah_klik', 'DESC');
        $get = $builder->get()->getResultArray();

        foreach ($get as $data) {
            $builders =  $this->db->table('games');
            $builders->where('id', $data['id_games']);
            $builders->where('populer', 'Y');
            $builders->where('status', 'On');
            $builders->orderBy('sort', 'ASC');
            $get = $builders->get()->getRowArray();
            
            if ($get !== NULL) {
                $populer[] = $get;
            }
        }

        $builderconfig = $this->db->table('config');
        $builderconfig->where('nama', 'populer');
        $configpopuler = $builderconfig->get()->getRowArray();
        
        usort($populer, function($a, $b) {
            return $a['sort_populer'] - $b['sort_populer'];
        });

        $populer = array_slice($populer, 0, $this->M_Base->u_get('limit-populer'));*/
        
        $buildergames = $this->db->table('games');
        $buildergames->where('status', 'On');
        $buildergames->where('populer', 'Y');
        $buildergames->orderBy('sort_populer', 'ASC');
        $buildergames->limit($this->M_Base->u_get('limit-populer'), 0);
        $get_data_populer = $buildergames->get()->getResultArray();

        if(!empty($get_data_populer)){
            $populer = $get_data_populer;
        }else{
            $builder = $this->db->table('jumlah_klik');
            $builder->orderBy('jumlah_klik', 'DESC');
            $get = $builder->get()->getResultArray();

            foreach ($get as $data) {
                $builders =  $this->db->table('games');
                $builders->where('id', $data['id_games']);
                $builders->where('populer', 'Y');
                $builders->where('status', 'On');
                $builders->orderBy('sort', 'ASC');
                $get = $builders->get()->getRowArray();
                
                if ($get !== NULL) {
                    $populer[] = $get;
                }
            }

            usort($populer, function($a, $b) {
                return $a['sort_populer'] - $b['sort_populer'];
            });

            $populer = array_slice($populer, 0, $this->M_Base->u_get('limit-populer'));

        }

        $builderconfig = $this->db->table('config');
        $builderconfig->where('nama', 'populer');
        $configpopuler = $builderconfig->get()->getRowArray();

    	$data = array_merge($this->base_data, [
    		'title' => $this->base_data['web']['name'],
    		'games' => $games,
    		'category' => $category,
    		'search' => $search,
    		'fs' => $fs,
            'banner' => $this->M_Base->all_data('banner'),
            'method' => $method_regist,
            'populer' => $populer,
            'config' => $configpopuler,
            'popup' => [
                'status' => $this->M_Base->u_get('popup_status'),
                'content' => $this->M_Base->u_get('popup_content'),
                'link_url' => $this->M_Base->u_get('popup_link_url'),
                'image_url' => $this->M_Base->u_get('popup_image_url'),
            ],
    	]);

        return view('Home/index', $data);
    }

    public function ajax() {

        $id = $this->request->getPost('id');
        $offset = $this->request->getPost('offset');
    
        if($id && $offset) {
            $games = [];
            foreach ($this->M_Base->data_where_array('category', ['id' => $id] , 'sort') as $data_category) {
                
                $data_games = $this->M_Base->data_where_offset('games', [
                    'category' => $data_category['id'],
                    'status' => 'On',
                ], 'sort', 6, $offset);
                
                if (count($data_games) !== 0) {
                    
                    $category[] = $data_category;
                    
                    $games[] = [
                        'id' => $data_category['id'],
                        'category' => $data_category['category'],
                        'games' => $data_games,
                    ];
                }
            }

            $data = [
                'success' => true,
                'data'      => $games,
            ];
    
            return $this->response->setJSON($data);
        } else {
            $data = [
                'success' => false,
                'message'      => 'ID AND OFFSET WAJIB DI ISI',
            ];
    
            return $this->response->setJSON($data);
        }

    }
}
