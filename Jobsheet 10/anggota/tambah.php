<<<<<<< HEAD
<?php

require __DIR__ . '/../includes/auth.php';

$page_title = "Tambah Peminjam";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<main>
    <section>
        <h2>Tambah Peminjam</h2>

        <?php if ($flash): ?>
            <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['pesan']) ?>
            </p>
        <?php endif; ?>

        <form method="post" action="/anggota/proses_tambah.php">
            <p>
                <label for="nama">Nama Peminjam</label><br>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    required
                >
            </p>

            <p>
                <label for="no_anggota">Nomor Anggota</label><br>
                <input
                    type="text"
                    id="no_anggota"
                    name="no_anggota"
                    required
                >
            </p>

            <p>
                <label for="alamat">Alamat</label><br>
                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                ></textarea>
            </p>

            <p>
                <label for="no_hp">Nomor HP</label><br>
                <input
                    type="text"
                    id="no_hp"
                    name="no_hp"
                >
            </p>

            <p>
                <button type="submit">Simpan Peminjam</button>
                <a href="/anggota/list.php">Kembali</a>
            </p>
        </form>
    </section>
</main>

=======
<?php

require __DIR__ . '/../includes/auth.php';

$page_title = "Tambah Peminjam";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<main>
    <section>
        <h2>Tambah Peminjam</h2>

        <?php if ($flash): ?>
            <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['pesan']) ?>
            </p>
        <?php endif; ?>

        <form method="post" action="/anggota/proses_tambah.php">
            <p>
                <label for="nama">Nama Peminjam</label><br>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    required
                >
            </p>

            <p>
                <label for="no_anggota">Nomor Anggota</label><br>
                <input
                    type="text"
                    id="no_anggota"
                    name="no_anggota"
                    required
                >
            </p>

            <p>
                <label for="alamat">Alamat</label><br>
                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                ></textarea>
            </p>

            <p>
                <label for="no_hp">Nomor HP</label><br>
                <input
                    type="text"
                    id="no_hp"
                    name="no_hp"
                >
            </p>

            <p>
                <button type="submit">Simpan Peminjam</button>
                <a href="/anggota/list.php">Kembali</a>
            </p>
        </form>
    </section>
</main>

>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
<?php include __DIR__ . '/../includes/footer.php'; ?>