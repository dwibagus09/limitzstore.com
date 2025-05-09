<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Duitku extends Model {
    
    public function maker($params = []) {
        
        $data = [
            'ok' => false,
            'msg' => 'Gagal terkoneksi ke DuitKu',
            'data' => '',
        ];
        
        $method = $params['paymentMethod'] ;
        $params_string = json_encode($params);
                                                
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params_string))
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
            $data['ok'] = true;
            //QRIS
            if($method == "SP" || $method == "LQ" || $method == "NQ" || $method == "DQ" || $method == "GQ" || $method == "SQ"){
                $data['data'] = $response['qrString'];
            }else{
                $data['data'] = $response['paymentUrl'];
            }
            
        } else {
            $data['msg'] = 'DuitKu : ' . $response['Message'];
        }
        
        return $data;
    }
}