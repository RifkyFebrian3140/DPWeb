<<<<<<< HEAD
<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

$page_title = "Data Peminjam";
include __DIR__ . '/../includes/header.php';

// SEARCH
$q = trim($_GET['q'] ?? '');

// PAGINATION
$perPage = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $perPage;

// HITUNG DATA
if ($q !== '') {

    $stmtCount = $pdo->prepare(
        "SELECT COUNT(*)
         FROM anggota
         WHERE nama ILIKE :q
            OR no_anggota ILIKE :q
            OR alamat ILIKE :q
            OR no_hp ILIKE :q"
    );

    $stmtCount->execute([
        'q' => '%' . $q . '%'
    ]);

} else {

    $stmtCount = $pdo->query(
        "SELECT COUNT(*) FROM anggota"
    );
}

$totalData = (int) $stmtCount->fetchColumn();

$totalPages = max(
    1,
    (int) ceil($totalData / $perPage)
);

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}

// AMBIL DATA
if ($q !== '') {

    $stmt = $pdo->prepare(
        "SELECT *
         FROM anggota
         WHERE nama ILIKE :q
            OR no_anggota ILIKE :q
            OR alamat ILIKE :q
            OR no_hp ILIKE :q
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(
        ':q',
        '%' . $q . '%'
    );

    $stmt->bindValue(
        ':limit',
        $perPage,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':offset',
        $offset,
        PDO::PARAM_INT
    );

    $stmt->execute();

} else {

    $stmt = $pdo->prepare(
        "SELECT *
         FROM anggota
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(
        ':limit',
        $perPage,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':offset',
        $offset,
        PDO::PARAM_INT
    );

    $stmt->execute();
}

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

        <!-- SEARCH -->

        <form method="get">

            <input
                type="search"
                name="q"
                placeholder="Cari peminjam..."
                value="<?= htmlspecialchars($q) ?>"
            >

            <button type="submit">
                Cari
            </button>

            <?php if ($q !== ''): ?>

                <a href="/anggota/list.php">
                    Reset
                </a>

            <?php endif; ?>

        </form>

        <p>
            <a href="/anggota/tambah.php">
                + Tambah Peminjam
            </a>
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
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php if (empty($daftarPeminjam)): ?>

                    <tr>
                        <td colspan="6">
                            Data tidak ditemukan.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarPeminjam as $i => $peminjam): ?>

                        <tr>

                            <td>
                                <?= $offset + $i + 1 ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['no_anggota']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['alamat'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['no_hp'] ?? '-') ?>
                            </td>

                            <td>

                                <a href="/anggota/edit.php?id=<?= $peminjam['id'] ?>">
                                    Edit
                                </a>

                                <form
                                    class="form-hapus"
                                    method="post"
                                    action="/anggota/hapus.php"
                                    style="display:inline;"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $peminjam['id'] ?>"
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

        <?php endif; ?>

    </section>
</main>

=======
<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

$page_title = "Data Peminjam";
include __DIR__ . '/../includes/header.php';

// SEARCH
$q = trim($_GET['q'] ?? '');

// PAGINATION
$perPage = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $perPage;

// HITUNG DATA
if ($q !== '') {

    $stmtCount = $pdo->prepare(
        "SELECT COUNT(*)
         FROM anggota
         WHERE nama ILIKE :q
            OR no_anggota ILIKE :q
            OR alamat ILIKE :q
            OR no_hp ILIKE :q"
    );

    $stmtCount->execute([
        'q' => '%' . $q . '%'
    ]);

} else {

    $stmtCount = $pdo->query(
        "SELECT COUNT(*) FROM anggota"
    );
}

$totalData = (int) $stmtCount->fetchColumn();

$totalPages = max(
    1,
    (int) ceil($totalData / $perPage)
);

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}

// AMBIL DATA
if ($q !== '') {

    $stmt = $pdo->prepare(
        "SELECT *
         FROM anggota
         WHERE nama ILIKE :q
            OR no_anggota ILIKE :q
            OR alamat ILIKE :q
            OR no_hp ILIKE :q
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(
        ':q',
        '%' . $q . '%'
    );

    $stmt->bindValue(
        ':limit',
        $perPage,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':offset',
        $offset,
        PDO::PARAM_INT
    );

    $stmt->execute();

} else {

    $stmt = $pdo->prepare(
        "SELECT *
         FROM anggota
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(
        ':limit',
        $perPage,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':offset',
        $offset,
        PDO::PARAM_INT
    );

    $stmt->execute();
}

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

        <!-- SEARCH -->

        <form method="get">

            <input
                type="search"
                name="q"
                placeholder="Cari peminjam..."
                value="<?= htmlspecialchars($q) ?>"
            >

            <button type="submit">
                Cari
            </button>

            <?php if ($q !== ''): ?>

                <a href="/anggota/list.php">
                    Reset
                </a>

            <?php endif; ?>

        </form>

        <p>
            <a href="/anggota/tambah.php">
                + Tambah Peminjam
            </a>
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
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php if (empty($daftarPeminjam)): ?>

                    <tr>
                        <td colspan="6">
                            Data tidak ditemukan.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarPeminjam as $i => $peminjam): ?>

                        <tr>

                            <td>
                                <?= $offset + $i + 1 ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['no_anggota']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['alamat'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($peminjam['no_hp'] ?? '-') ?>
                            </td>

                            <td>

                                <a href="/anggota/edit.php?id=<?= $peminjam['id'] ?>">
                                    Edit
                                </a>

                                <form
                                    class="form-hapus"
                                    method="post"
                                    action="/anggota/hapus.php"
                                    style="display:inline;"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $peminjam['id'] ?>"
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

        <?php endif; ?>

    </section>
</main>

>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
<?php include __DIR__ . '/../includes/footer.php'; ?>