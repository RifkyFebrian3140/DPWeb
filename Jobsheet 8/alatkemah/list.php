<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

$page_title = "Data Alat Kemah";
include __DIR__ . '/../includes/header.php';

$daftarAlat = $pdo
    ->query("SELECT * FROM alat ORDER BY id DESC")
    ->fetchAll(PDO::FETCH_ASSOC);

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<main>
    <section>
        <h2>Data Alat Kemah</h2>

        <?php if ($flash): ?>
            <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['pesan']) ?>
            </p>
        <?php endif; ?>

        <p>
            <a href="/alatkemah/tambah.php">+ Tambah Alat</a>
        </p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($daftarAlat)): ?>
                        <tr>
                            <td colspan="5">
                                Belum ada data alat kemah.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarAlat as $i => $alat): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($alat['nama_alat']) ?></td>
                                <td><?= htmlspecialchars($alat['kategori'] ?? '-') ?></td>
                                <td><?= htmlspecialchars((string) $alat['stok']) ?></td>
                                <td><?= htmlspecialchars($alat['kondisi']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>