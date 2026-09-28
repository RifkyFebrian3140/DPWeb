<?php
session_start();

require __DIR__ . '/includes/koneksi.php';

$page_title = "Beranda";

$totalAlat = $pdo
    ->query("SELECT COUNT(*) FROM alat")
    ->fetchColumn();

$totalPeminjam = $pdo
    ->query("SELECT COUNT(*) FROM anggota")
    ->fetchColumn();

include __DIR__ . '/includes/header.php';
?>

<main>
    <section>
        <h2>Selamat Datang di Sistem Peminjaman Alat Kemah</h2>
        <p>
            Aplikasi sederhana untuk mengelola data alat kemah
            dan data peminjam.
        </p>
    </section>

    <section>
        <h2>Ringkasan Data</h2>

        <article>
            <h3>Total Alat Kemah</h3>
            <p><?= htmlspecialchars((string) $totalAlat) ?></p>
            <a href="/alatkemah/list.php">
                Lihat Data Alat
            </a>
        </article>

        <article>
            <h3>Total Peminjam</h3>
            <p><?= htmlspecialchars((string) $totalPeminjam) ?></p>
            <a href="/anggota/list.php">
                Lihat Data Peminjam
            </a>
        </article>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>