<?php
$page_title = 'Tambah Peminjam - Camp Gear';
$active_page = 'anggota';
require __DIR__ . '/../includes/header.php';
?>
<main>
    <section class="page-heading">
        <p class="eyebrow">MANAJEMEN ANGGOTA</p>
        <h1>Tambah Peminjam</h1>
        <p>Lengkapi informasi anggota berikut.</p>
    </section>
    <section class="panel form-panel">
        <h2>Informasi Peminjam</h2>
        <form class="data-form" method="post" action="proses_tambah.php">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                <label for="nomor_identitas">Nomor Identitas</label>
                <input type="text" id="nomor_identitas" name="nomor_identitas" placeholder="Contoh: AG005" required>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor Telepon</label>
                <input type="tel" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat" required></textarea>
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
