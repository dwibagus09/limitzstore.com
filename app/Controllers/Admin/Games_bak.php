<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Cloudinary\Cloudinary;

class Games extends BaseController {

    private $cloudinary;

    public function __construct(){
        $this->cloudinary = new Cloudinary(
            [
                'cloud' => [
                    'cloud_name' => 'dhpih39wl',
                    'api_key'    => '631858462155671',
                    'api_secret' => 'gPW2PhXEqEBlDFauUM9kisQmum4',
                ],
                'url' => [
                    'secure' => true
                ]
            ]
        );
    }

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        $games = [];
        foreach ($this->M_Base->all_data('games') as $loop) {
            
            $data_category = $this->M_Base->data_where('category', 'id', $loop['category']);
            
            $category = count($data_category) == 1 ? $data_category[0]['category'] : '-';
            
            $games[] = array_merge($loop, [
                'category' => $category,
                'product' => $this->M_Base->data_count('product', [
                    'games_id' => $loop['id']
                ]),
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Games',
            'games' => $games,
    	]);

        return view('Admin/Games/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'games' => addslashes(trim(htmlspecialchars($this->request->getPost('games')))),
                'subs_title' => addslashes(trim(htmlspecialchars($this->request->getPost('subs_title')))),
                'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                'content' => addslashes(trim($this->request->getPost('content'))),
                'target' => addslashes(trim(htmlspecialchars($this->request->getPost('target')))),
                'product_type' => addslashes(trim(htmlspecialchars($this->request->getPost('product_type')))),
                'check_status' => addslashes(trim(htmlspecialchars($this->request->getPost('check_status')))),
                'check_code' => addslashes(trim(htmlspecialchars($this->request->getPost('check_code')))),
                'popup_status' => addslashes(trim(htmlspecialchars($this->request->getPost('popup_status')))),
                'popup_content' => addslashes(trim(htmlspecialchars($this->request->getPost('popup_content')))),
                'populer' => addslashes(trim(htmlspecialchars($this->request->getPost('populer')))),
                'sort_populer' => addslashes(trim(htmlspecialchars($this->request->getPost('sort_populer')))),
                'footer' => $this->request->getPost('footer'),
            ];

            if (empty($data_post['games'])) {
                $this->session->setFlashdata('error', 'Nama games tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['category'])) {
                $this->session->setFlashdata('error', 'Kategori games tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['target'])) {
                $this->session->setFlashdata('error', 'Sistem target tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {

                $data_post['sort'] = empty($data_post['sort']) ? '1' : $data_post['sort'];

                $randomFilename = uniqid() . '_' . time() . '_' . date('Ymd');

                $bannerfile = $this->request->getFile('banner');

                if ($bannerfile) {
                    $tempPathbanner = $bannerfile->getTempName();
                    
                    if(!empty($tempPathbanner)) {
                        $bannerurl = $this->cloudinary->uploadApi()->upload($tempPathbanner, 
                            ["public_id" => $randomFilename, 'folder' => 'games/banner']
                        );

                        $banner = $bannerurl['secure_url'];
                    } else {
                        $banner = '';
                    }

                } else {
                    $banner = '';
                }

                $imagefile = $this->request->getFile('image');

                if ($imagefile) {
                    $tempPathimage = $imagefile->getTempName();

                    if(!empty($tempPathimage)) {
                        $imageurl = $this->cloudinary->uploadApi()->upload($tempPathimage, 
                            ["public_id" => $randomFilename, 'folder' => 'games/banner']
                        );

                        $image = $imageurl['secure_url'];
                    } else {
                        $image = '';
                    }

                } else {
                    $image = '';
                }

                // $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/games/');
                // $banner = $this->M_Base->upload_file($this->request->getFiles()['banner'], 'assets/images/games/banner/');

                if ($image && $banner) {
                    $this->M_Base->data_insert('games', array_merge($data_post, [
                        'slug' => url_title($data_post['games'], '-', true),
                        'image' => $image,
                        'banner' => $banner,
                        'status' => 'On',
                    ]));

                    $this->session->setFlashdata('success', 'Games berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Games',
            'category' => $this->M_Base->all_data('category'),
            'target' => $this->M_Base->all_data('target'),
        ]);

        return view('Admin/Games/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $games = $this->M_Base->data_where('games', 'id', $id);

            if (count($games) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'games' => addslashes(trim(htmlspecialchars($this->request->getPost('games')))),
                        'subs_title' => addslashes(trim(htmlspecialchars($this->request->getPost('subs_title')))),
                        'slug' => addslashes(trim(htmlspecialchars($this->request->getPost('slug')))),
                        'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                        'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                        'content' => addslashes(trim($this->request->getPost('content'))),
                        'target' => addslashes(trim(htmlspecialchars($this->request->getPost('target')))),
                        'product_type' => addslashes(trim(htmlspecialchars($this->request->getPost('product_type')))),
                        'check_status' => addslashes(trim(htmlspecialchars($this->request->getPost('check_status')))),
                        'check_code' => addslashes(trim(htmlspecialchars($this->request->getPost('check_code')))),
                        'cek_id_provider' => addslashes(trim(htmlspecialchars($this->request->getPost('cek_id_provider')))),
                        'popup_status' => addslashes(trim(htmlspecialchars($this->request->getPost('popup_status')))),
                        'popup_content' => addslashes(trim(htmlspecialchars($this->request->getPost('popup_content')))),
                        'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                        'populer' => addslashes(trim(htmlspecialchars($this->request->getPost('populer')))),
                        'sort_populer' => addslashes(trim(htmlspecialchars($this->request->getPost('sort_populer')))),
                        'footer' => $this->request->getPost('footer'),
                    ];

                    if (empty($data_post['games'])) {
                        $this->session->setFlashdata('error', 'Nama games tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['slug'])) {
                        $this->session->setFlashdata('error', 'Slug games tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['category'])) {
                        $this->session->setFlashdata('error', 'Kategori games tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['target'])) {
                        $this->session->setFlashdata('error', 'Sistem target tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {

                        $data_post['sort'] = empty($data_post['sort']) ? '1' : $data_post['sort'];

                        // $banner = $this->M_Base->upload_file($this->request->getFiles()['banner'], 'assets/images/games/banner/');

                        // $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/games/');

                        $randomFilename = uniqid() . '_' . time() . '_' . date('Ymd');

                        $bannerfile = $this->request->getFile('banner');

                        if ($bannerfile) {
                            $tempPathbanner = $bannerfile->getTempName();
                            
                            if(!empty($tempPathbanner)) {
                                $bannerurl = $this->cloudinary->uploadApi()->upload($tempPathbanner, 
                                    ["public_id" => $randomFilename, 'folder' => 'games/banner']
                                );

                                $banner = $bannerurl['secure_url'];
                            } else {
                                $banner = $games[0]['banner'];
                            }

                        } else {
                            $banner = $games[0]['banner'];
                        }

                        $imagefile = $this->request->getFile('image');

                        if ($imagefile) {
                            $tempPathimage = $imagefile->getTempName();

                            if(!empty($tempPathimage)) {
                                $imageurl = $this->cloudinary->uploadApi()->upload($tempPathimage, 
                                    ["public_id" => $randomFilename, 'folder' => 'games/banner']
                                );

                                $image = $imageurl['secure_url'];
                            } else {
                                $image = $games[0]['image'];
                            }

                        } else {
                            $image = $games[0]['image'];
                        }

                        $this->M_Base->data_update('games', array_merge($data_post, [
                            'image' => $image,
                            'banner' => $banner,
                        ]), $id);

                        $this->session->setFlashdata('success', 'Games berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Games',
                    'category' => $this->M_Base->all_data('category'),
                    'target' => $this->M_Base->all_data('target'),
                    'games' => $games[0],
                ]);

                return view('Admin/Games/edit', $data);

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
            $games = $this->M_Base->data_where('games', 'id', $id);

            if (count($games) === 1) {
                $this->M_Base->data_delete('games', $id);

                $this->session->setFlashdata('success', 'Data berhasil dihapus');
                return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/games');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}