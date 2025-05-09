
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="description" content="<?= $web['deskripsi']; ?>">
    <meta name="author" content="ilhamards">

    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url(); ?>/css/hightlightjs-dark.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css" media="all">
    <script>hljs.initHighlightingOnLoad();</script>
</head>

<body>
<div class="left-menu">
    <div class="content-logo">
        <div class="logo">
            <img alt="platform by Emily van den Heever from the Noun Project" title="platform by Emily van den Heever from the Noun Project" src="<?= $web['logo']; ?>" height="40" />
            <span>API V2 Documentation</span>
        </div>
        <button class="burger-menu-icon" id="button-menu-mobile">
            <svg width="34" height="34" viewBox="0 0 100 100"><path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path><path class="line line2" d="M 20,50 H 80"></path><path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path></svg>
        </button>
    </div>
    <div class="mobile-menu-closer"></div>
    <div class="content-menu">
        <ul>
            <li>
                <a href="<?= base_url(); ?>">Kembali</a>
            </li>
            <li class="scroll-to-link active" data-target="content-get-started">
                <a>GET Started</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-account">
                <a>Get Account Info</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-saldo">
                <a>Get Saldo</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-product">
                <a>Get Product</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-order">
                <a>Order</a>
            </li>
            <li class="scroll-to-link" data-target="content-check-transaksi">
                <a>Check Transaksi</a>
            </li>
        </ul>
    </div>
</div>
<div class="content-page">
    <div class="content-code"></div>
    <div class="content">
        <div class="overflow-hidden content-section" id="content-get-started">
            <h1>Get started</h1>
            <pre>
    API Endpoint : https://api.limitzstore.com/v2<br/>

    CALLBACK RESPONSE :

    {
        "order_id": "BG231212",
        "status": "Success",
        "ket": "BG23232",
        "callback_url": "https://api.limitzstore.com/callback",
        "callback_status": "N",
        "callback_mesage": "Success send callback"
     }
    
                </pre>
            <p>
                Untuk mengakses API diperlukan <br/><br/>

                authorization : Apikey <br/>
                Whitelist IP <br/>
                Callback URL <br/><br/>
                
                Note :<br/>
                Pastikan anda telah whitelist IP di sistem kami<br/>
                Pastikan anda telah whitelist URL Callback anda di sistem kami<br/>
                Silahkan whitelist IP kami pada sistem Anda<br/>
                <strong>IPv4</strong> 36.50.77.83<br />
                <strong>IPv6</strong> 2001:df7:5300:9::53<br /><br />

                
                Kami akan mengirimkan callback ke sistem anda seperti ini :<br/>
                
            </p>
        </div>
        <div class="overflow-hidden content-section" id="content-get-account">
            <h2>Get Account Info</h2>
            <pre><code class="bash">
# Here is a curl example

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.limitzstore.com/v2/account',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'AUTHORIZATION: APIKEY'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
                </code></pre>
            <p>
                Api Endpoint :<br>
                <code class="higlighted break-word">https://api.limitzstore.com/v2/account</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "data": {
        "username": "oblivion777",
        "whatsapp": "0814858555",
        "level": "Diamond",
        "balance": "100000",
        "join_date": "2024-04-06 17:16:51",
        "total_order": 0
    }
}        </code></pre>
            <h4>AUTHORIZATION API KEY</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <!-- Tambahkan baris kosong -->
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                        </td>
                    </tr>
                <tr>
                    <td>API Key</td>
                    <td>Token</td>
                    <td>Your API key.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-get-saldo">
            <h2>Get Saldo</h2>
            <pre><code class="bash">
# Here is a curl example

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.limitzstore.com/v2/balance',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'AUTHORIZATION: APIKEY'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
                </code></pre>
            <p>
                Api Endpoint :<br>
                <code class="higlighted break-word">https://api.limitzstore.com/v2/balance</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "data": {
        "balance": "100000"
    }
}
                </code></pre>
            <h4>AUTHORIZATION API KEY</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <!-- Tambahkan baris kosong -->
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                        </td>
                    </tr>
                <tr>
                    <td>API Key</td>
                    <td>Token</td>
                    <td>Your API key.</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="overflow-hidden content-section" id="content-get-product">
            <h2>Get Product</h2>
            <pre><code class="bash">
# Here is a curl example

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.limitzstore.com/v2/product',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'AUTHORIZATION: APIKEY'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
                </code></pre>
            <p>
                Api Endpoint :<br><br>
                <code class="higlighted break-word">https://api.limitzstore.com/v2/product</code><br/><br/>

                <strong>Keterangan:</strong> Endpoint ini dapat digunakan DENGAN atau TANPA request.<br />

                Berikut ini contoh dengan opsional request:<br />
                <code>
                {
				    "games": "FC  Mobile",
    				"category": "PULSA DAN DATA"
    			}
    			</code>
    			<br>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "data": [
        {
            "id": "97.09",
            "games": "GIFT SKIN AOT",
            "product": "Skin Normal (269 Diamonds)",
            "category": null,
            "price": "0",
            "status": "On"
        },
        {
            "id": "95.45",
            "games": "GIFT SKIN AOT",
            "product": "Skin Normal (299 Diamonds)",
            "category": null,
            "price": "0",
            "status": "On"
        }
    ]
}
                </code></pre>
            <h4>AUTHORIZATION API KEY</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                        </td>
                    </tr>
                <tr>
                    <td>API Key</td>
                    <td>Token</td>
                    <td>Your API key.</td>
                </tr>
                </tbody>
            </table>
            <h4>Body</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="3">
                        <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                    </td>
                </tr>
                <tr>
                    <td>games</td>
                    <td>string</td>
                    <td>contoh value: "GIFT SKIN" atau NULL</td>
                </tr>
                <tr>
                    <td>category</td>
                    <td>string</td>
                    <td>contoh value: "MOBILE LEGENDS" atau NULL</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="overflow-hidden content-section" id="content-get-order">
            <h2>Order</h2>
            <pre><code class="bash">
# Here is a curl example

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.limitzstore.com/v2/order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "sku_product": "MLBB113",
    "product": "110.10",
    "user_id": "2323121",
    "zone_id": "2322",
    "order_id: "INVTEST001"
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'AUTHORIZATION: APIKEY'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
                </code></pre>
            <p>
                Api Endpoint :<br>
                <code class="higlighted break-word">https://api.limitzstore.com/v2/order</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "data": Order ID Anda
}
                </code></pre>
            <h4>AUTHORIZATION API KEY</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                        </td>
                    </tr>
                <tr>
                    <td>API Key</td>
                    <td>Token</td>
                    <td>Your API key.</td>
                </tr>
                </tbody>
            </table>
            
            <h4>Body</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="3">
                        <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                    </td>
                </tr>
                <tr>
                    <td>sku_product</td>
                    <td>string</td>
                    <td>SKU Product (Dapat di kosongkan jika Product telah diisi)</td>
                </tr>
                <tr>
                    <td>product</td>
                    <td>string</td>
                    <td>Product ID (Dapat di kosongkan jika SKU Product telah diisi)</td>
                </tr>
                <tr>
                    <td colspan="3">
                    
                    </td>
                </tr>
                <tr>
                    <td>user_id</td>
                    <td>string</td>
                    <td>User ID akun games.</td>
                </tr>
                <tr>
                    <td>zone_id (opsional)</td>
                    <td>string</td>
                    <td>Zone ID akun games.</td>
                </tr>
                <!--<tr>
                    <td>order_id</td>
                    <td>string</td>
                    <td>Order id transaksi dari web anda Unique.</td>
                </tr>-->
                </tbody>
            </table>
        </div>

        <div class="overflow-hidden content-section" id="content-check-transaksi">
            <h2>Order</h2>
            <pre><code class="bash">
# Here is a curl example

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.limitzstore.com/v2/status',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "order_id": "BG23122024"
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'AUTHORIZATION: APIKEY'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
                </code></pre>
            <p>
                Api Endpoint :<br>
                <code class="higlighted break-word">https://api.limitzstore.com/v2/status</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "data": {
        "order_id": "ARB61422115042024",
        "games": "Mobile Legends",
        "product": "3 Diamonds",
        "price": "1127",
        "user_id": "47290237",
        "zone_id": "2279",
        "status": "Pending",
        "keterangan": "Menunggu Pembayaran"
    }
}
                </code></pre>
            <h4>AUTHORIZATION API KEY</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                        </td>
                    </tr>
                <tr>
                    <td>API Key</td>
                    <td>Token</td>
                    <td>Your API key.</td>
                </tr>
                </tbody>
            </table>
            
            <h4>Body</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <p style="margin-right: 0 !important;padding:0px !important;">Pastikan anda mengirim data ke kami sesuai dengan format yang kami berikan</p>
                        </td>
                    </tr>
                
                <tr>
                    <td>order_id</td>
                    <td>string</td>
                    <td>Order id transaksi dari web anda Unique.</td>
                </tr>
                </tbody>
            </table>
        </div>
       
    </div>
    <div class="content-code"></div>
</div>
<script src="<?= base_url(); ?>/js/script.js"></script>
</body>
</html>