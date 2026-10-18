<?php
require __DIR__ . '/../includes/init.php';
$page_title = 'Data Peminjam - Camp Gear';
$active_page = 'anggota';
require __DIR__ . '/../includes/header.php';
?>
<main>
    <section class="page-heading">
        <p class="eyebrow">MANAJEMEN ANGGOTA</p>
        <h1>Data Peminjam</h1>
        <p>Data anggota ditampilkan menggunakan PHP dan session.</p>
    </section>
    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Daftar Anggota</h2>
                <p>Cari anggota melalui kolom pencarian.</p>
            </div>
            <a href="tambah.php" class="btn btn-primary">+ Tambah Peminjam</a>
        </div>
        <div class="table-responsive">
            <table id="tabel-anggota">
                <thead><tr><th>No.</th><th>Nama</th><th>Nomor Identitas</th><th>Nomor Telepon</th><th>Alamat</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php if (empty($_SESSION['anggota'])): ?>
                    <tr><td colspan="6">Belum ada data peminjam.</td></tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['anggota'] as $index => $anggota): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($anggota['nomor_identitas'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($anggota['telepon'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($anggota['alamat'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><span class="helper-text">Data #<?= (int)$anggota['id'] ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <p class="helper-text">Data peminjam disimpan sementara dalam session PHP, bukan database.</p>
    </section>
    <div class="back-link"><a href="../index.php" class="text-link">&larr; Kembali ke Beranda</a></div>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
