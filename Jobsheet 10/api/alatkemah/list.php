<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

$page_title = "Data Alat Kemah";
include __DIR__ . '/../includes/header.php';

// ===============================
// SEARCH
// ===============================
$q = trim($_GET['q'] ?? '');

// ===============================
// PAGINATION
// ===============================
$perPage = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $perPage;

// ===============================
// HITUNG TOTAL DATA
// ===============================
if ($q !== '') {
    $stmtCount = $pdo->prepare(
        "SELECT COUNT(*)
         FROM alat
         WHERE nama_alat ILIKE :q
            OR kategori ILIKE :q
            OR kondisi ILIKE :q"
    );

    $stmtCount->execute([
        'q' => '%' . $q . '%'
    ]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM alat");
}

$totalData = (int) $stmtCount->fetchColumn();

$totalPages = max(1, (int) ceil($totalData / $perPage));

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}

// ===============================
// AMBIL DATA
// ===============================
if ($q !== '') {
    $stmt = $pdo->prepare(
        "SELECT *
         FROM alat
         WHERE nama_alat ILIKE :q
            OR kategori ILIKE :q
            OR kondisi ILIKE :q
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(':q', '%' . $q . '%');
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

} else {
    $stmt = $pdo->prepare(
        "SELECT *
         FROM alat
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}

$daftarAlat = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        <!-- SEARCH -->
        <form method="get">
            <input
                type="search"
                name="q"
                placeholder="Cari alat kemah..."
                value="<?= htmlspecialchars($q) ?>"
            >

            <button type="submit">Cari</button>

            <?php if ($q !== ''): ?>
                <a href="/alatkemah/list.php">Reset</a>
            <?php endif; ?>
        </form>

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
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (empty($daftarAlat)): ?>

                    <tr>
                        <td colspan="6">
                            Data tidak ditemukan.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarAlat as $i => $alat): ?>

                        <tr>
                            <td><?= $offset + $i + 1 ?></td>

                            <td>
                                <?= htmlspecialchars($alat['nama_alat']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($alat['kategori'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars((string) $alat['stok']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($alat['kondisi']) ?>
                            </td>

                            <td>

                                <a href="/alatkemah/edit.php?id=<?= $alat['id'] ?>">
                                    Edit
                                </a>

                                <form
                                    class="form-hapus"
                                    method="post"
                                    action="/alatkemah/hapus.php"
                                    style="display:inline;"
                                >
                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $alat['id'] ?>"
                                    >

                                    <button type="submit">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <?php if ($totalPages > 1): ?>

            <p>
                Halaman <?= $page ?> dari <?= $totalPages ?>
            </p>

            <div>

                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&q=<?= urlencode($q) ?>">
                        ← Sebelumnya
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                    <?php if ($i == $page): ?>

                        <strong>
                            <?= $i ?>
                        </strong>

                    <?php else: ?>

                        <a href="?page=<?= $i ?>&q=<?= urlencode($q) ?>">
                            <?= $i ?>
                        </a>

                    <?php endif; ?>

                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>&q=<?= urlencode($q) ?>">
                        Berikutnya →
                    </a>
                <?php endif; ?>

            </div>

        <?php endif; ?>

    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>