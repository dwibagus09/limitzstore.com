<?php $this->extend('template'); ?>

<?php $this->section('css'); ?>
<style>
    /* Styling untuk hasil pencarian */
#resultContainer {
    background: #1E1E1E;
    color: white;
    padding: 15px;
    border-radius: 10px;
    text-align: left;
    max-width: 550px;
    margin: auto;
    display: none;
}

/* Styling untuk tabel */
#resultContainer table {
    width: 100%;
    border-collapse: collapse; /* Menghindari dobel border */
}

/* Styling untuk sel tabel */
#resultContainer td {
    padding: 8px 10px;
    border-bottom: 1px solid white; /* Garis bawah putih */
}

/* Styling untuk sel pertama (nama label) */
#resultContainer td:first-child {
    width: 30%;
    font-weight: bold;
}

/* Menghapus border bawah pada baris terakhir */
#resultContainer tr:last-child td {
    border-bottom: none;
}

/* Styling untuk bendera */
.flag {
    width: 20px;
    height: auto;
    vertical-align: middle;
    margin-left: 5px;
}

</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="clearfix pt-5"></div>
<div class="pt-5 pb-5">
    <div class="wrapper pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9 col-sm-9">
                    <div class="text-center mb-3">
                        <img src="<?= $web['logo']; ?>" width="250" height="50">
                    </div>
                    <center>
                        <h4>Cek Username & Region Mobile <br>Legends</h4>
                        <span>Masukkan ID dan Server untuk mendapatkan informasi username dan region.</span>
                    </center>
                    <br>
                    <form id="checkForm">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label class="mb-1" for="userid">ID</label>
                            <input type="text" id="userid" name="userid" style="border: 2px solid var(--warna_3);" class="form-control" placeholder="Masukkan ID">
                        </div>
                        <div class="mb-3">
                            <label class="mb-1" for="zoneid">Server</label>
                            <input type="text" id="zoneid" name="zoneid" style="border: 2px solid var(--warna_3);" class="form-control" placeholder="Masukkan Server">
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-2">
                                <button class="btn btn-primary d-block w-100" type="button" id="hasil">Cek Username & Region</button>
                            </div>
                             <div class="col-12 col-md-6 mb-2">
                                <select name="region" class="btn btn-primary d-block w-100" id="regionDropdown">
                                     <option value="">Pilih Region <br> Top Up</option>
                                    <?php foreach ($region as $regions): ?>
                                       
                                        <option value="<?= $regions['url_link']; ?>"><?= $regions['region']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Efek Loading -->
                    <div id="loading" class="text-center mt-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p>Memeriksa data...</p>
                    </div>

                    <!-- Hasil Pencarian -->
                    <div id="resultContainer" class="mt-3">
                        <h5 class="text-center">Hasil Pencarian</h5>
                        <table>
                            <tr>
                                <td>ID</td>
                                <td>:</td>
                                <td id="resUserID"></td>
                            </tr>
                            <tr>
                                <td>Zone</td>
                                <td>:</td>
                                <td id="resZoneID"></td>
                            </tr>
                            <tr>
                                <td>Region</td>
                                <td>:</td>
                                <td id="resRegion"></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td id="resUsername"></td>
                            </tr>
                        </table>
                        <h5 id="invalidData" style="display: none; color: red;">Invalid Data Record</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

document.getElementById('regionDropdown').addEventListener('change', function() {
    let selectedUrl = this.value.trim(); // Menghapus spasi ekstra jika ada
    if (selectedUrl !== "" && selectedUrl !== null) {
        window.location.href = selectedUrl; // Arahkan ke URL yang dipilih
    }
});


$(document).ready(function() {
    $("#hasil").click(function() {
        let userid = $("#userid").val();
        let zoneid = $("#zoneid").val();
        
        if (userid === "" || zoneid === "") {
            $("#resultContainer").hide();
            alert("ID dan Server wajib diisi!");
            return;
        }
        
        $("#resultContainer").fadeOut();
        $("#loading").fadeIn();
        
        $.ajax({
            url: "<?= base_url('proxy/check-account') ?>", // Menggunakan endpoint proxy CI4
            type: "POST",
            data: { 
                userid: userid,
                zoneid: zoneid
            },
            dataType: "json",
            success: function(response) {
                $("#loading").fadeOut();

                if (response.status && response.data) {
                    let regionCode = response.data.code;

                    let regionMapping = {
                        "ID": { name: "Indonesia", flag: "🇮🇩" },
                        "MY": { name: "Malaysia", flag: "🇲🇾" },
                        "PH": { name: "Filipina", flag: "🇵🇭" },
                        "SG": { name: "Singapura", flag: "🇸🇬" },
                        "TH": { name: "Thailand", flag: "🇹🇭" },
                        "VN": { name: "Vietnam", flag: "🇻🇳" },
                        "US": { name: "Amerika Serikat", flag: "🇺🇸" },
                        "JP": { name: "Jepang", flag: "🇯🇵" },
                        "KR": { name: "Korea Selatan", flag: "🇰🇷" },
                        "CN": { name: "China", flag: "🇨🇳" },
                        "BR": { name: "Brasil", flag: "🇧🇷" },
                        "DE": { name: "Jerman", flag: "🇩🇪" },
                        "FR": { name: "Prancis", flag: "🇫🇷" },
                        "GB": { name: "Inggris", flag: "🇬🇧" },
                        "AU": { name: "Australia", flag: "🇦🇺" },
                        "RU": { name: "Rusia", flag: "🇷🇺" },
                        "IN": { name: "India", flag: "🇮🇳" },
                        "TR": { name: "Turki", flag: "🇹🇷" },
                        "SA": { name: "Arab Saudi", flag: "🇸🇦" },
                        "EG": { name: "Mesir", flag: "🇪🇬" },
                        "ES": { name: "Spanyol", flag: "🇪🇸" },
                        "IT": { name: "Italia", flag: "🇮🇹" },
                        "MX": { name: "Meksiko", flag: "🇲🇽" },
                        "AR": { name: "Argentina", flag: "🇦🇷" },
                        "ZA": { name: "Afrika Selatan", flag: "🇿🇦" },
                        "CA": { name: "Kanada", flag: "🇨🇦" }
                    };
                    
                    // Menampilkan negara dengan bendera jika tersedia
                    let regionText = regionMapping[regionCode]
                        ? `${regionMapping[regionCode].name} <span class='flag'>${regionMapping[regionCode].flag}</span>`
                        : regionCode;

                    $("#resUserID").text(response.data.id);
                    $("#resZoneID").text(response.data.server);
                    $("#resUsername").html(response.data.nickname);
                    $("#resRegion").html(regionText);

                    $("#invalidData").hide();
                    $("#resultContainer").fadeIn();
                } else {
                    $("#invalidData").show();
                    $("#resultContainer").fadeIn();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loading").fadeOut();

                // Menampilkan detail error
                let errorMessage = "Terjadi kesalahan saat memproses permintaan.\n";
                errorMessage += "Status: " + textStatus + "\n";
                errorMessage += "Error: " + errorThrown + "\n";

                // Jika respons dari server tersedia, tampilkan juga
                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage += "Pesan: " + jqXHR.responseJSON.message;
                }

                alert(errorMessage);
            }
        });
    });
});
</script>
<?php $this->endSection(); ?>
