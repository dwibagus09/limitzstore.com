<div class="mb-2">
    <input type="text" name="user_id" class="form-control" placeholder="Masukkan User ID" autocomplete="off" value="<?= $auto_fill['user']; ?>">
</div>
<div class="mb-2">
    <select name="zone_id" class="form-control">
        <option value="prod_official_asia" <?= $auto_fill['server'] == 'prod_official_asia' ? 'selected' : ''; ?>>Asia Server</option>
        <option value="prod_official_usa" <?= $auto_fill['server'] == 'prod_official_usa' ? 'selected' : ''; ?>>America Server</option>
        <option value="prod_official_eur" <?= $auto_fill['server'] == 'prod_official_eur' ? 'selected' : ''; ?>>Europe Server</option>
        <option value="prod_official_cht" <?= $auto_fill['server'] == 'prod_official_cht' ? 'selected' : ''; ?>>TW, HK, MO Server</option>
    </select>
</div>