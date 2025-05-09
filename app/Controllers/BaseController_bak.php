<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\M_Base;
use App\Models\M_Wa;
use App\Models\M_Whapify;
use App\Models\M_Voca;
use App\Models\M_Duitku;
use App\Models\M_Omega;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller {

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['utility'];

    public $db;
    public $session;
    public $agent;
    public $M_Base;
    public $M_Wa;
    public $M_Voca;
    public $M_Duitku;
    public $M_Whapify;
    public $M_Omega;
    public $admin;
    public $users;
    public $base_data;
    
    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->agent = $this->request->getUserAgent();

        $this->M_Base = new M_Base;
        $this->M_Wa = new M_Wa;
        $this->M_Voca = new M_Voca;
        $this->M_Duitku = new M_Duitku;
        $this->M_Whapify = new M_Whapify;
        $this->M_Omega = new M_Omega;

        if (preg_match("/webzip|httrack|wget|FlickBot|downloader|production
        bot|superbot|PersonaPilot|NPBot|WebCopier|vayala|imagefetch|
        Microsoft URL Control|mac finder|
        emailreaper|emailsiphon|emailwolf|emailmagnet|emailsweeper|
        Indy Library|FrontPage|cherry picker|WebCopier|netzip|
        Share Program|TurnitinBot|full web bot|zeus/i", $this->agent->getAgentString())) {
            die('- Sttt...');
        }

        $this->admin = false;

        if ($this->session->get('admin')) {
            $admin = $this->M_Base->data_where('admin', 'username', $this->session->get('admin'));

            if (count($admin) == 1) {
                if ($admin[0]['status'] == 'On') {
                    $this->admin = $admin[0];
                }
            }
        }

        $this->users = false;

        if ($this->session->get('username')) {
            $users = $this->M_Base->data_where('users', 'username', $this->session->get('username'));

            if (count($users) == 1) {
                if ($users[0]['status'] == 'On') {
                    $this->users = $users[0];
                }
            }
        }

        $builderconfig = $this->db->table('config');
        $builderconfig->where('nama', 'tawkto');
        $configpopuler = $builderconfig->get()->getRowArray();
        
        $filterconfig = $this->db->table('config');
        $filterconfig->where('nama', 'blackwhitefilterpopuler');
        $configfilterpopuler = $filterconfig->get()->getRowArray();

        $buildertatacara = $this->db->table('tata_cara_kategory');
        $tatacara = $buildertatacara->get()->getResultArray();

        $this->base_data = [
            'users' => $this->users,
            'admin' => $this->admin,
            'web' => [
                'title' => $this->M_Base->u_get('web-title'),
                'name' => $this->M_Base->u_get('web-name'),
                'deskripsi' => $this->M_Base->u_get('deskripsi'),
                'logo' => $this->M_Base->u_get('web-logo'),
                'favicon' => $this->M_Base->u_get('favicon'),
                'icon' => $this->M_Base->u_get('web-logo'),
                'keywords' => $this->M_Base->u_get('web-keywords'),
                'description' => $this->M_Base->u_get('web-description'),
                'web_contact' => $this->M_Base->u_get('web-contact'),
                'upgrade-membership' => $this->M_Base->u_get('upgrade-membership'),
                'kode-store' => $this->M_Base->u_get('kode-store'),
                'limit-populer' => $this->M_Base->u_get('limit-populer'),
                'filter-populer' => $configfilterpopuler,
                'tawkto-config' => $configpopuler,
                'end-top' => $this->M_Base->u_get('end-top'),
                'description_footer' => $this->M_Base->u_get('description_footer'),
                'tata-cara' => $tatacara,
                'tawkto' => $this->M_Base->u_get('tawkto'),
                'profit' => $this->M_Base->u_get('profit'),
                'profit-silver' => $this->M_Base->u_get('profit-silver'),
                'profit-gold' => $this->M_Base->u_get('profit-gold'),
                'profit-bisnis' => $this->M_Base->u_get('profit-bisnis'),
                'ip' => $this->M_Base->u_get('ip'),
                'logoinvoice' => $this->M_Base->u_get('logoinvoice'),
            ],
            'sm' => [
                'wa' => $this->M_Base->u_get('sm-wa'),
                'yt' => $this->M_Base->u_get('sm-yt'),
                'fb' => $this->M_Base->u_get('sm-fb'),
                'ig' => $this->M_Base->u_get('sm-ig'),
                'tw' => $this->M_Base->u_get('sm-tw'),
            ],
            'menu_active' => 'Home',
            'games_footer' => $this->M_Base->all_data('games', 6),
            'method_footer' => $this->M_Base->data_where_array('method', [
                'status' => 'On',
            ]),
            'harga_upgrade' => [
                'silver' => $this->M_Base->u_get('harga_silver'),
                'gold' => $this->M_Base->u_get('harga_gold'),
                'bisnis' => $this->M_Base->u_get('harga_bisnis'),
            ],
            'search' => '',
            'menu_users' => '',
            'menu_admin' => '',
            'sosmed_footer' => [],
            'sosmed_right' => $this->M_Base->all_data('sosmed'),
            'popup' => [
                'status' => 'Off',
                'content' => '',
            ],
            'tema' => [
                'warna' => $this->M_Base->u_get('tema_warna'),
            	'warna_2' => $this->M_Base->u_get('tema_warna_2'),
            	'warna_3' => $this->M_Base->u_get('tema_warna_3'),
                'warna_4' => $this->M_Base->u_get('tema_warna_4'),
            	'text' => $this->M_Base->u_get('tema_text'),
                'text_2' => $this->M_Base->u_get('tema_text_2'),
                'border' => $this->M_Base->u_get('tema_border'),
                'sidebar' => $this->M_Base->u_get('tema_image_sidebar'),
                'hero' => $this->M_Base->u_get('tema_image_hero'),
            ],
        ];
    }
}
