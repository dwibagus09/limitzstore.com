<?php 

namespace App\Models;

use CodeIgniter\Model;

use Xendit\Xendit;
use Xendit\PaymentChannels;

class M_Xendit extends Model {
    
    public function run($method, $params) {

            Xendit::setApiKey($this->db->table('utility')->where('u_key', 'xendit-secret-key')->get()->getResultArray()[0]['u_value']);
            
            $array['payment'] = null;
            
            if ($method == 'QR') {
                
                $qr_code = \Xendit\QRCode::create($params);
                if (array_key_exists('qr_string', $qr_code)) {
                    $array['payment'] = $qr_code['qr_string'];
                }
                
            } else if (in_array($method, ['OVO', 'DANA', 'LINKAJA', 'SHOPEEPAY'])) {
                
                $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($params);
                if (array_key_exists('actions', $createEWalletCharge)) {
                    
                    $array['payment'] = $createEWalletCharge['action']['desktop_web_checkout_url'];
                    
                    if (!$array['payment']) {
                        $array['payment'] = $createEWalletCharge['action']['mobile_web_checkout_url'];
                        
                        if (!$array['payment']) {
                            $array['payment'] = $createEWalletCharge['action']['mobile_deeplink_checkout_url'];
                        }
                    }
                }
                
            } else if (in_array($method, ['BCA', 'BNI', 'BRI', 'BJB', 'BSI', 'CIMB', 'DBS', 'MANDIRI', 'PERMATA', 'SAHABAT_SAMPOERNA'])) {
                
                $createVA = \Xendit\VirtualAccounts::create($params);
                if (array_key_exists('account_number', $createVA)) {
                    $array['payment'] = $createVA['account_number'];
                }
                
            } else if (in_array($method, ['ALFAMART', 'INDOMARET'])) {
                
                $createFPC = \Xendit\Retail::create($params);
                if (array_key_exists('payment_code', $createFPC)) {
                    $array['payment'] = $createVA['payment_code'];
                }
            } else if ($method == 'INVOICE') {
                
                dd($params);
                
                $createInvoice = \Xendit\Invoice::create($params);
                if (array_key_exists('invoice_url', $createInvoice)) {
                    $array['payment'] = $createInvoice['invoice_url'];
                }
                
            }
            
            return $array;
        }
}