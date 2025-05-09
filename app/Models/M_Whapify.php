<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Whapify extends Model {
    
    /**
     * Function to send a message using the Whapify API
     * @param array $params
     * @return mixed
     */
    public function send($params) {
        // API URL
        $url = 'https://whapify.id/api/send/whatsapp';

        // Prepare request data
        $postData = [
            'secret' => '786511b1227c35709f56a34fa0dff57aafa2d447',
            'account' => 26,
            'recipient' => $params['target'],
            'type' => 'text',
            'message' => $params['message'],
        ];

        // Initialize cURL
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute cURL and get the response
        $response = curl_exec($ch);

        // Close cURL
        curl_close($ch);

        // Return the response
        return $response;
    }
}
