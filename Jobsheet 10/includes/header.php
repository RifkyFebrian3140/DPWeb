<<<<<<< HEAD
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($page_title)) {
    $page_title = "Sistem Peminjaman Alat Kemah";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header>
    <h1>Sistem Peminjaman Alat Kemah</h1>

    <nav>
        <a href="/index.php">Beranda</a>
        <a href="/alatkemah/list.php">Data Alat Kemah</a>
        <a href="/anggota/list.php">Data Peminjam</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <span>
                Petugas: <?= htmlspecialchars($_SESSION['nama']) ?>
            </span>

            <a href="/auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="/auth/login.php">Login</a>
        <?php endif; ?>
    </nav>
=======
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($page_title)) {
    $page_title = "Sistem Peminjaman Alat Kemah";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header>
    <h1>Sistem Peminjaman Alat Kemah</h1>

    <nav>
        <a href="/index.php">Beranda</a>
        <a href="/alatkemah/list.php">Data Alat Kemah</a>
        <a href="/anggota/list.php">Data Peminjam</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <span>
                Petugas: <?= htmlspecialchars($_SESSION['nama']) ?>
            </span>

            <a href="/auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="/auth/login.php">Login</a>
        <?php endif; ?>
    </nav>
>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
</header>