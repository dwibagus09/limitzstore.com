<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Voca extends Model {

    public function trx($type = 'GET', $data = [], $path = '', $sign = '', $voca = []) {

        $signs = hash_hmac('sha256', $voca['merchant'] . '/' . $sign, $voca['secret']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-bisnis.vocagame.com/v1/core/'.$path.'?signature=' . $signs);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Merchant: ' . $voca['merchant']
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        return $result;
	}
	
    public function coba($type = 'GET', $data = [], $path = '', $sign = '', $voca = []) {

        $signs = hash_hmac('sha256', $voca['merchant'] . '/' . $sign, $voca['secret']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-bisnis.vocagame.com/v1/core/'.$path.'?signature=' . $signs);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Merchant: ' . $voca['merchant']
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        return 'https://api-bisnis.vocagame.com/v1/core/'.$path.'?signature=' . $signs;
	}
	
    public function check_trx($type = 'GET', $path = '', $invoiceId = '', $sign = '', $voca = []) {

        $signs = hash_hmac('sha256', $voca['merchant'] . '/' . $sign, $voca['secret']);
        //$signs = hash_hmac('sha256','46275b0f-09d1-4f92-9e75-d367f1388b13/transaction/VBMLBBXX1911725859417A351A1757745/detail', '136a7b1a9ac583c2c0e4e58fe7a63f98bc2aef34d380c1bb6c302656a41b4109');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-bisnis.vocagame.com/v1/core/'.$path.'/'.$invoiceId.'/detail?signature=' . $signs);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Merchant: ' . $voca['merchant']
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        return $result;
    }
    
    	public function trxdetail($type = 'GET', $order_id_provider='',$reference=[], $voca = [],$sign ='') {
       // Validate input parameters
    if (empty($voca['merchant']) || empty($voca['secret']) || empty($voca['key'])) {
        return [
            'error' => true,
            'message' => 'Konfigurasi VOCAGame tidak lengkap.',
            'data' => compact('voca', 'order_id_provider', 'reference'),
        ];
    }

    // Generate HMAC signature
    $signature = hash_hmac(
        'sha256',
        $voca['merchant'] . '/transaction/' . $order_id_provider . '/detail',
        $voca['secret']
    );

    // API URL with signature as query parameter
    $url = 'https://api-bisnis.vocagame.com/v1/core/transaction/' . $order_id_provider . '/detail?signature=' . $signature;

        // Initialize cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Merchant: ' . $voca['merchant']
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    
        // Execute the request
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        // if (curl_errno($ch)) {
        //     $error_message = curl_error($ch);
        //     curl_close($ch);
        //     return [
        //         'error' => true,
        //         'message' => 'cURL Error: ' . $error_message
        //     ];
        // }
    
        // curl_close($ch);
    
        // // Decode and validate the response
        // $result = json_decode($result, true);
    
        // if ($http_code !== 200 || !is_array($result)) {
        //     return [
        //         'error' => true,
        //         'message' => 'HTTP Error: ' . $http_code . ' atau response tidak valid.'
        //     ];
        // }
    
        return $result;
    }
	
	public function trxDetails($type = 'GET', $data=[], $voca = [],$sign ='')
    {
        
        $orderIdProvider = $data['order_id_provider'];

        $path = "transaction/{$orderIdProvider}/detail";
        $signature = hash_hmac('sha256',  $voca['merchant'] . '/' . $path, $voca['secret']);
    
        // Set up the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-bisnis.vocagame.com/v1/core/' . $path . '?signature=' . $signature);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Merchant: ' . $merchant
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
        // Execute the request and decode the result
        $result = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($result, true);

        return $result;
    
    }
}