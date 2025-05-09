<div class="mb-2">
    <input type="text" name="user_id" class="form-control" placeholder="Masukkan User ID" autocomplete="off" value="<?= $auto_fill['user']; ?>">
</div>
<div class="mb-2">
    <select name="zone_id" class="form-control">
        <option value="os_asia" <?= $auto_fill['server'] == 'os_asia' ? 'selected' : ''; ?>>Asia Server</option>
        <option value="os_usa" <?= $auto_fill['server'] == 'os_usa' ? 'selected' : ''; ?>>America Server</option>
        <option value="os_euro" <?= $auto_fill['server'] == 'os_euro' ? 'selected' : ''; ?>>Europe Server</option>
        <option value="os_cht" <?= $auto_fill['server'] == 'os_cht' ? 'selected' : ''; ?>>TW, HK, MO Server</option>
    </select>
</div>