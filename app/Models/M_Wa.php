<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Wa extends Model {
	
	public function send($data) {
    	    
	    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $data['target'],
                'message' => $data['message'],
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $data['token'],
            ),
        ));
        
        $response = curl_exec($curl);
        $response = json_decode($response, true);
        
        return $response;
	}
}