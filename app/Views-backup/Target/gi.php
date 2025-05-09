<!--NEW UPDATE-->
<div class="form-row pt-3">
    <div class="col">
        <input type="number" name="user_id" class="form-control" placeholder="Masukkan User ID" autocomplete="off" style="border: 1px solid #ced4da;">
    </div>
    <div class="col">
        <input type="hidden" id="zone_id" name="zone_id" value="">
        <select class="form-control" id="server" name="server">
            <option value="">Pilih Server</option>
            <option value="Asia">Asia Server</option>
            <option value="America">America Server</option>
            <option value="Europe">Europe Server</option>
            <option value="TW_HK_MO">TW, HK, MO Server</option>
        </select>
    </div>
</div>

<script>
document.getElementById('server').addEventListener('change', function() {
    document.getElementById('zone_id').value = this.value;
});
</script>
<!--END NEW UPDATE-->
