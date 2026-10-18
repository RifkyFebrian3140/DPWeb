<?php
$page_title = 'Camp Gear - Beranda';
$active_page = 'home';
require __DIR__ . '/includes/header.php';
?>
<main>
    <section class="hero">
        <p class="eyebrow">PERLENGKAPAN PETUALANGAN</p>
        <h1>Explore More.<br><span>Worry Less.</span></h1>
        <p class="hero-description">
            Kelola perlengkapan kemah dengan mudah. Siapkan peralatan,
            atur data peminjam, dan mulai petualanganmu.
        </p>
        <div class="hero-actions">
            <a href="alatkemah/list.php" class="btn btn-primary">Lihat Alat Kemah</a>
            <a href="anggota/list.php" class="btn btn-secondary">Data Peminjam</a>
        </div>
    </section>
    <section class="content-section">
        <div class="section-heading">
            <p class="eyebrow">MENU UTAMA</p>
            <h2>Pengelolaan Camp Gear</h2>
            <p>Pilih menu untuk melihat dan mengelola data.</p>
        </div>
        <div class="stats-grid">
            <article class="stat-card">
                <span class="stat-icon">01</span>
                <h3>Data Alat Kemah</h3>
                <p>Lihat daftar perlengkapan dan jumlah stok.</p>
                <a href="alatkemah/list.php" class="text-link">Buka data &rarr;</a>
            </article>
            <article class="stat-card">
                <span class="stat-icon">02</span>
                <h3>Data Peminjam</h3>
                <p>Lihat informasi anggota peminjam alat.</p>
                <a href="anggota/list.php" class="text-link">Buka data &rarr;</a>
            </article>
            <article class="stat-card">
                <span class="stat-icon">03</span>
                <h3>Persiapan Kemah</h3>
                <p>Pastikan perlengkapan tersedia sebelum digunakan.</p>
                <a href="alatkemah/list.php" class="text-link">Cek perlengkapan &rarr;</a>
            </article>
        </div>
    </section>
    <section class="notice">
        <div>
            <p class="eyebrow">CAMP GEAR</p>
            <h2>Petualangan dimulai dari persiapan.</h2>
            <p>Kelola perlengkapanmu agar perjalanan lebih terencana.</p>
        </div>
        <a href="alatkemah/tambah.php" class="btn btn-primary">+ Tambah Alat</a>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
