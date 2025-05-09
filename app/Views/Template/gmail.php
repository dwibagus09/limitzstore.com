<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $title ?></title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
 <body style="margin: 0; padding: 0; font-family: 'Roboto', sans-serif;color:#000;">
<div style="max-width: 600px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 30px;">
        <?php $logo = ""; ?>
        <?php if(isset($web['logoinvoice'])){ $logo = $web['logoinvoice'];  } ?>
        <?php if(isset($logo)){ $logo = $logo;  } ?>
        <img src="<?= $logo ?>" alt="" style="max-width: 200px; height: auto; margin: 0 auto; display: block;">
    </div>
    <div style="padding: 0 20px;">
        <p style="text-align: justify; font-size: 15px; margin-bottom: 15px;"><?= $Description ?></p>
        <hr>
        <h5 style="margin-bottom: 20px;font-size: 15px;"><b>RINGKASAN PESANAN</b></h5>
        <h5 style="margin-bottom: 20px;font-size: 15px;"><b><?= $product ?></b></h5>
        <div style="margin-bottom: 10px;font-size: 14px;">Info User: <?= $user_id ?> (<?= $zone_id ?>)</div>
        <div style="margin-bottom: 10px;font-size: 14px;">Nickname: <?= $nickname ?></div>
        <div style="margin-bottom: 10px;font-size: 14px;">ID Transaksi: <?= $order_id ?></div>
        <div style="margin-bottom: 10px;font-size: 14px;">Metode Pembayaran: <?= $metode ?></div>
        <div style="margin-bottom: 10px;font-size: 14px;">Total Harga: <?= $total_harga ?></div>
        <div style="margin-bottom: 20px;font-size: 14px;">Keterangan: <?= $keterangan ?></div>
        <p style="text-align: justify; font-size: 15px; margin-bottom: 15px;">TopUp Apapun ? Kapanpun ? Dimanapun ? Hanya di <a href="belanjagame.com" style="text-decoration: none; color: #6495ED;">belanjagame.com</a> Yang Jadi #TopupAndalanKamu.</p>
        <hr>
          <table style="width: 100%; background-color: gray;">
            <tr>
                <td style="text-align: center; color: white; padding: 20px;">@2024 belanjagame.com</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
