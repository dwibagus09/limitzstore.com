
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
            <span>API Documentation</span>
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
    API Endpoint : <?= base_url(); ?> <br/>

    CALLBACK RESPONSE :

    {
        "order_id": "BG231212",
        "status": "Success",
        "ket": "BG23232",
        "callback_url": "<?= base_url(); ?>/callback",
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
                Pastikan anda telah whitelist URL Callback anda di sistem kami<br/><br/>
                
                Kami akan mengirimkan callback ke sistem anda seperti ini :<br/>
                
            </p>
        </div>
        <div class="overflow-hidden content-section" id="content-get-saldo">
            <h2>Get Saldo</h2>
            <pre><code class="bash">
# Here is a curl example

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '<?= base_url(); ?>/profile',
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
                <code class="higlighted break-word"><?= base_url(); ?>/profile</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "error": false,
    "data": "8"
}
                </code></pre>
            <h4>AUTHORIZATION Bearer Token</h4>
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
                    <td>Bearer</td>
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
  CURLOPT_URL => '<?= base_url(); ?>/product',
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
                <code class="higlighted break-word"><?= base_url(); ?>/product/{nama games}</code><br/><br>
                <code class="higlighted break-word"><?= base_url(); ?>/product/{category}</code><br/><br>
                <code class="higlighted break-word"><?= base_url(); ?>/product/{nama games}/{category}</code><br/><br>
                {nama games} dan {category} is opsional<br>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "error": false,
    "data": [
        {
            "id": "1027.34",
            "games": "GIFT SKIN AOT",
            "product": "Skin AoT Martis : Levi Ackerman",
            "category": "18",
            "price": "0",
            "status": "On"
        },
        {
            "id": "1283.137",
            "games": "Google Play",
            "product": "Google Play Rp. 100.000 INDONESIA REGION",
            "category": "2",
            "price": "0",
            "status": "On"
        },
    ]
}
                </code></pre>
            <h4>AUTHORIZATION Bearer Token</h4>
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
                    <td>Bearer</td>
                    <td>Token</td>
                    <td>Your API key.</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="overflow-hidden content-section" id="content-get-order">
            <h2>Order</h2>
            <pre><code class="bash">
# Here is a curl example

curl_setopt_array($curl, array(
  CURLOPT_URL => '<?= base_url(); ?>/order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "product": "110.10",
    "value": {
        "user_id": "2323121",
        "zone_id": "2322"
    },
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
                <code class="higlighted break-word"><?= base_url(); ?>/order</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "error": false,
    "data": Order ID Anda
}
                </code></pre>
            <h4>AUTHORIZATION Bearer Token</h4>
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
                    <td>Bearer</td>
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
                    <td>product</td>
                    <td>string</td>
                    <td>Product ID.</td>
                </tr>
                <tr>
                    <td colspan="3">
                    
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                       Value :
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
                <tr>
                    <td colspan="3">
                    
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

        <div class="overflow-hidden content-section" id="content-check-transaksi">
            <h2>Order</h2>
            <pre><code class="bash">
# Here is a curl example

curl_setopt_array($curl, array(
  CURLOPT_URL => '<?= base_url(); ?>/status',
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
                <code class="higlighted break-word"><?= base_url(); ?>/status</code>
            </p>
            <br>
            <pre><code class="json">
Result example :

{
    "status": true,
    "error": false,
    "data": {
        "status": "Processing",
        "ket": "success"
    }
}
                </code></pre>
            <h4>AUTHORIZATION Bearer Token</h4>
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
                    <td>Bearer</td>
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