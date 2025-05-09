<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Omega extends Model {

    public function trx($type = 'GET', $data = [], $path = '', $sign = '', $voca = []) {

        $sign = hash_hmac('sha256', $voca['merchant'] . '/' . $sign, $voca['secret']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-bisnis.vocagame.com/v1/core/'.$path.'?signature=' . $sign);
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
}