<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare(
    "SELECT * FROM alat WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$alat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alat) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Data alat tidak ditemukan.'
    ];

    header('Location: /alatkemah/list.php');
    exit;
}

$page_title = "Edit Alat Kemah";
include __DIR__ . '/../includes/header.php';
?>

<main>
    <section>

        <h2>Edit Alat Kemah</h2>

        <form method="post" action="/alatkemah/proses_edit.php">

            <input
                type="hidden"
                name="id"
                value="<?= $alat['id'] ?>"
            >

            <p>
                <label for="nama_alat">Nama Alat</label><br>

                <input
                    type="text"
                    id="nama_alat"
                    name="nama_alat"
                    value="<?= htmlspecialchars($alat['nama_alat']) ?>"
                    required
                >
            </p>

            <p>
                <label for="kategori">Kategori</label><br>

                <input
                    type="text"
                    id="kategori"
                    name="kategori"
                    value="<?= htmlspecialchars($alat['kategori'] ?? '') ?>"
                >
            </p>

            <p>
                <label for="stok">Stok</label><br>

                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    value="<?= htmlspecialchars((string) $alat['stok']) ?>"
                    required
                >
            </p>

            <p>
                <label for="kondisi">Kondisi</label><br>

                <select id="kondisi" name="kondisi" required>

                    <option value="Baik"
                        <?= $alat['kondisi'] === 'Baik' ? 'selected' : '' ?>>
                        Baik
                    </option>

                    <option value="Rusak Ringan"
                        <?= $alat['kondisi'] === 'Rusak Ringan' ? 'selected' : '' ?>>
                        Rusak Ringan
                    </option>

                    <option value="Rusak Berat"
                        <?= $alat['kondisi'] === 'Rusak Berat' ? 'selected' : '' ?>>
                        Rusak Berat
                    </option>

                </select>
            </p>

            <p>
                <button type="submit">
                    Simpan Perubahan
                </button>

                <a href="/alatkemah/list.php">
                    Kembali
                </a>
            </p>

        </form>

    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>