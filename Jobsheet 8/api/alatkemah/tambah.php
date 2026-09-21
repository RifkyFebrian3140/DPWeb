<?php
session_start();

$page_title = "Tambah Alat Kemah";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<main>
    <section>
        <h2>Tambah Alat Kemah</h2>

        <?php if ($flash): ?>
            <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['pesan']) ?>
            </p>
        <?php endif; ?>

        <form id="form-tambah" method="post"
              action="/alatkemah/proses_tambah.php">

            <p>
                <label for="nama_alat">Nama Alat</label><br>
                <input
                    type="text"
                    id="nama_alat"
                    name="nama_alat"
                    required
                >
            </p>

            <p>
                <label for="kategori">Kategori</label><br>
                <input
                    type="text"
                    id="kategori"
                    name="kategori"
                    placeholder="Contoh: Tenda, Peralatan Masak"
                >
            </p>

            <p>
                <label for="stok">Stok</label><br>
                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    value="0"
                    required
                >
            </p>

            <p>
                <label for="kondisi">Kondisi</label><br>
                <select id="kondisi" name="kondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak Ringan">Rusak Ringan</option>
                    <option value="Rusak Berat">Rusak Berat</option>
                </select>
            </p>

            <p>
                <button type="submit">Simpan Alat</button>
                <a href="/alatkemah/list.php">Kembali</a>
            </p>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>