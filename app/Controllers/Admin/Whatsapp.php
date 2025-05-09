<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Whatsapp extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/-9J6DWAuK/]:C2Tx1/login');
        }
        
        if ($this->request->getPost('tombol')) {
            $this->M_Base->u_update('wa_fonnte', $this->request->getPost('wa_fonnte'));
            $this->M_Base->u_update('wa_order', $this->request->getPost('wa_order'));
            $this->M_Base->u_update('wa_success', $this->request->getPost('wa_success'));
            $this->M_Base->u_update('wa_admin', $this->request->getPost('wa_admin'));
            
            $this->M_Base->u_update('wa_welcome', $this->request->getPost('wa_welcome'));
            $this->M_Base->u_update('wa_reset', $this->request->getPost('wa_reset'));
            $this->M_Base->u_update('wa_verif', $this->request->getPost('wa_verif'));
            $this->M_Base->u_update('wa_topup', $this->request->getPost('wa_topup'));

            $this->M_Base->u_update('wa_notif_transfer_balance', $this->request->getPost('wa_notif_transfer_balance'));
            
            $this->session->setFlashdata('success', 'Data whatsapp berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Whatsapp',
    		'wa' => [
    		    'fonnte' => $this->M_Base->u_get('wa_fonnte'),
    		    'order' => $this->M_Base->u_get('wa_order'),
    		    'success' => $this->M_Base->u_get('wa_success'),
    		    'admin' => $this->M_Base->u_get('wa_admin'),
    		    'welcome' => $this->M_Base->u_get('wa_welcome'),
    		    'reset' => $this->M_Base->u_get('wa_reset'),
    		    'verif' => $this->M_Base->u_get('wa_verif'),
                'topup' => $this->M_Base->u_get('wa_topup'),
                'wa_notif_transfer_balance' => $this->M_Base->u_get('wa_notif_transfer_balance'),
    	    ]
    	]);

        return view('Admin/Whatsapp/index', $data);
    }
}