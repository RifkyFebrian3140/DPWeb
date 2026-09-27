<?php

session_start();

require __DIR__ . '/../includes/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare(
    "SELECT * FROM anggota WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$peminjam = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$peminjam) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Data peminjam tidak ditemukan.'
    ];

    header('Location: /anggota/list.php');
    exit;
}

$page_title = "Edit Peminjam";

include __DIR__ . '/../includes/header.php';
?>

<main>
    <section>

        <h2>Edit Peminjam</h2>

        <form method="post" action="/anggota/proses_edit.php">

            <input
                type="hidden"
                name="id"
                value="<?= $peminjam['id'] ?>"
            >

            <p>
                <label for="nama">
                    Nama Peminjam
                </label><br>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="<?= htmlspecialchars($peminjam['nama']) ?>"
                    required
                >
            </p>

            <p>
                <label for="no_anggota">
                    Nomor Anggota
                </label><br>

                <input
                    type="text"
                    id="no_anggota"
                    name="no_anggota"
                    value="<?= htmlspecialchars($peminjam['no_anggota']) ?>"
                    required
                >
            </p>

            <p>
                <label for="alamat">
                    Alamat
                </label><br>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                ><?= htmlspecialchars($peminjam['alamat'] ?? '') ?></textarea>
            </p>

            <p>
                <label for="no_hp">
                    Nomor HP
                </label><br>

                <input
                    type="text"
                    id="no_hp"
                    name="no_hp"
                    value="<?= htmlspecialchars($peminjam['no_hp'] ?? '') ?>"
                >
            </p>

            <p>

                <button type="submit">
                    Simpan Perubahan
                </button>

                <a href="/anggota/list.php">
                    Kembali
                </a>

            </p>

        </form>

    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>