<?php
$page_title = 'Tambah Alat Kemah - Camp Gear';
$active_page = 'alat';
require __DIR__ . '/../includes/header.php';
?>
<main>
    <section class="page-heading">
        <p class="eyebrow">MANAJEMEN PERLENGKAPAN</p>
        <h1>Tambah Alat Kemah</h1>
        <p>Lengkapi informasi perlengkapan berikut.</p>
    </section>
    <section class="panel form-panel">
        <h2>Informasi Alat</h2>
        <form class="data-form" method="post" action="proses_tambah.php">
            <div class="form-group">
                <label for="nama_alat">Nama Alat</label>
                <input type="text" id="nama_alat" name="nama_alat" placeholder="Contoh: Tenda Dome" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Tenda">Tenda</option>
                    <option value="Perlengkapan Tidur">Perlengkapan Tidur</option>
                    <option value="Memasak">Memasak</option>
                    <option value="Penerangan">Penerangan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stok">Jumlah Stok</label>
                <input type="number" id="stok" name="stok" min="0" step="1" placeholder="Masukkan stok" required>
            </div>
            <div class="form-group">
                <label for="kondisi">Kondisi Alat</label>
                <select id="kondisi" name="kondisi" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="Baik">Baik</option>
                    <option value="Perlu Dicek">Perlu Dicek</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <a href="list.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
        <p class="helper-text">Data disimpan ke database PostgreSQL.</p>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
