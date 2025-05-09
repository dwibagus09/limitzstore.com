<?php $this->extend('Admin/template'); ?>
                
<?php $this->section('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .export-box {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .btn-export {
        background: #2A629C;
        color: white;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-export:hover {
        background: #1a4b7c;
        color: white;
    }
</style>
<?php $this->endSection(); ?>
                
<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="export-box">
            <h4 class="mb-4 text-center" style="color:black;">Export Produk Digiflazz</h4>
            
            <form id="exportForm" method="get">
                <div class="form-group mb-4">
    <label style="color:black;">Pilih Provider</label>
    <select class="form-control" name="provider" id="provider" required>
        <option value="">-- Pilih Provider --</option>
        <option value="digiflazz">Digiflazz</option>
        <option value="tokogar">Tokogar</option>
    </select>
</div>

                <div class="form-group mb-4">
                    <label style="color:black;">Pilih Game</label>
                      <input type="text" class="form-control" name="brand" required placeholder="NAMA GAME">
                </div>
                
                <div class="form-group mb-4">
                    <label style="color:black;">Urutkan Berdasarkan</label>
                    <select class="form-control" name="sort">
                        <option value="asc">Terkecil ke Terbesar</option>
                        <option value="desc">Terbesar ke Terkecil</option>
                    </select>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-export">
                        <i class="fas fa-file-excel mr-2"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $('.select2').select2({-->
<!--            placeholder: "Pilih brand",-->
<!--            allowClear: true-->
<!--        });-->
        
<!--        $('#exportForm').on('submit', function(e) {-->
<!--            e.preventDefault();-->
<!--            const brand = $('[name="brand"]').val();-->
<!--            const sort = $('[name="sort"]').val();-->
            
<!--            if (!brand) {-->
<!--                alert('Silakan pilih brand terlebih dahulu');-->
<!--                return;-->
<!--            }-->
            
            // Redirect ke endpoint export
<!--            window.location.href = `<?= base_url('digiflazz/products/brand') ?>/${encodeURIComponent(brand)}?sort=${sort}&export=excel`;-->
<!--        });-->
<!--    });-->
<!--</script>-->
<script>
$('#exportForm').on('submit', function(e) {
    e.preventDefault();

    const brand = $('[name="brand"]').val();
    const sort = $('[name="sort"]').val();
    const provider = $('#provider').val();

    if (!provider) {
        alert('Silakan pilih provider terlebih dahulu');
        return;
    }

    if (!brand) {
        alert('Silakan isi nama game terlebih dahulu');
        return;
    }

    let actionUrl = '';

    if (provider === 'digiflazz') {
        actionUrl = `<?= base_url('digiflazz/products/brand') ?>/${encodeURIComponent(brand)}?sort=${sort}&export=excel`;
    } else if (provider === 'tokogar') {
        actionUrl = `<?= base_url('tokogar/products/brand') ?>/${encodeURIComponent(brand)}?sort=${sort}&export=excel`;
    }

    // Redirect ke URL yang sesuai
    window.location.href = actionUrl;
});
</script>
<?php $this->endSection(); ?>