<?php

namespace App\Controllers;
use App\Models\M_Base; // Import model M_Base

use CodeIgniter\Controller;

class ProxyController extends Controller
{
    protected $M_Base; // Deklarasi properti untuk model

    public function __construct()
    {
        // Load model M_Base
        $this->M_Base = new M_Base();
    }
    
    public function checkAccount()
    {
        // Ambil data dari permintaan POST
        $userid = $this->request->getPost('userid');
        $zoneid = $this->request->getPost('zoneid');
        $apikey = $this->M_Base->u_get('netflazz_apikey');
        $secretkey = $this->M_Base->u_get('netflazz_secretkey');
        // Validasi input
        if (empty($userid) || empty($zoneid)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User ID dan Zone ID wajib diisi!'
            ]);
        }

        // Data yang akan dikirim ke API eksternal
        $data = [
            'api_key' => $apikey, // Ganti dengan API KEY Anda
            'secret_key' => $secretkey, // Ganti dengan SECRET KEY Anda
            'action' => 'mlbb',
            'userid' => $userid,
            'zoneid' => $zoneid
        ];

        // URL API eksternal
        $apiUrl = 'https://api.nf22.my.id/subscribe/cek-account';

        // Inisialisasi cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Eksekusi permintaan ke API eksternal
        $response = curl_exec($ch);
        
        log_message('info', 'Respons dari API proxy: ' . $response);
        
        // Cek jika terjadi error
        if (curl_errno($ch)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menghubungi API: ' . curl_error($ch)
            ]);
        }

        // Tutup koneksi cURL
        curl_close($ch);

        // Kirim respons dari API eksternal ke frontend
        return $this->response->setJSON($response);
    }
}