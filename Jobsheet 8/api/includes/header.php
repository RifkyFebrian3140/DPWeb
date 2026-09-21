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
    </nav>
</header>