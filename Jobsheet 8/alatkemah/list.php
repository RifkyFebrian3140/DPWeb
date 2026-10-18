<?php
require __DIR__ . '/../includes/init.php';
require __DIR__ . '/../includes/koneksi.php';

$alatList = $pdo->query('SELECT * FROM alat ORDER BY id DESC')->fetchAll();
$page_title = 'Data Alat Kemah - Camp Gear';
$active_page = 'alat';
require __DIR__ . '/../includes/header.php';
?>
<main>
    <section class="page-heading">
        <p class="eyebrow">MANAJEMEN PERLENGKAPAN</p>
        <h1>Data Alat Kemah</h1>
        <p>Data alat kemah diambil dari PostgreSQL.</p>
    </section>
    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Daftar Perlengkapan</h2>
                <p>Cari alat melalui kolom pencarian.</p>
            </div>
            <a href="tambah.php" class="btn btn-primary">+ Tambah Alat</a>
        </div>
        <div class="table-responsive">
            <table id="tabel-alat">
                <thead><tr><th>No.</th><th>Nama Alat</th><th>Kategori</th><th>Stok</th><th>Kondisi</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php if (empty($alatList)): ?>
                    <tr><td colspan="6">Belum ada data alat kemah.</td></tr>
                <?php else: ?>
                    <?php foreach ($alatList as $index => $alat): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($alat['nama_alat'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($alat['kategori'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= (int)$alat['stok'] ?></td>
                        <td><span class="status <?= $alat['kondisi'] === 'Baik' ? 'status-good' : 'status-warning' ?>"><?= htmlspecialchars($alat['kondisi'], ENT_QUOTES, 'UTF-8') ?></span></td>
                        <td><span class="helper-text">Data #<?= (int)$alat['id'] ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <p class="helper-text">Data alat disimpan di database PostgreSQL.</p>
    </section>
    <div class="back-link"><a href="../index.php" class="text-link">&larr; Kembali ke Beranda</a></div>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
