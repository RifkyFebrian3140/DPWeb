<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

$page_title = "Data Peminjam";
include __DIR__ . '/../includes/header.php';

$stmt = $pdo->query("SELECT * FROM anggota ORDER BY id DESC");
$daftarPeminjam = $stmt->fetchAll(PDO::FETCH_ASSOC);

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<main>
    <section>
        <h2>Data Peminjam</h2>

        <?php if ($flash): ?>
            <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['pesan']) ?>
            </p>
        <?php endif; ?>

        <p>
            <a href="/anggota/tambah.php">+ Tambah Peminjam</a>
        </p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Anggota</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($daftarPeminjam)): ?>
                        <tr>
                            <td colspan="5">Belum ada data peminjam.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarPeminjam as $i => $peminjam): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($peminjam['nama']) ?></td>
                                <td><?= htmlspecialchars($peminjam['no_anggota']) ?></td>
                                <td><?= htmlspecialchars($peminjam['alamat'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($peminjam['no_hp'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>