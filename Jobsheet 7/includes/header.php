<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$folder = basename(dirname($_SERVER['SCRIPT_NAME']));
$base = in_array($folder, ['alatkemah', 'anggota'], true) ? '../' : '';
$page_title = $page_title ?? 'Camp Gear';
$active_page = $active_page ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
    <script src="<?= $base ?>assets/js/apps.js" defer></script>
</head>
<body>
<header>
    <a href="<?= $base ?>index.php" class="logo">CAMP <span>GEAR</span></a>
    <button type="button" class="nav-toggle-label" aria-expanded="false">☰ Menu</button>
    <nav>
        <ul>
            <li><a href="<?= $base ?>index.php" class="<?= $active_page === 'home' ? 'active' : '' ?>">Beranda</a></li>
            <li><a href="<?= $base ?>alatkemah/list.php" class="<?= $active_page === 'alat' ? 'active' : '' ?>">Data Alat Kemah</a></li>
            <li><a href="<?= $base ?>anggota/list.php" class="<?= $active_page === 'anggota' ? 'active' : '' ?>">Data Peminjam</a></li>
        </ul>
    </nav>
</header>
<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash-message" role="status">
        <?= htmlspecialchars($_SESSION['flash']['message'], ENT_QUOTES, 'UTF-8') ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
