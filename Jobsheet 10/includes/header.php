<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = $page_title ?? 'Camp Gear';
$active_page = $active_page ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/apps.js" defer></script>
</head>
<body>
<header>
    <a href="/index.php" class="logo">CAMP <span>GEAR</span></a>

    <button
        type="button"
        class="nav-toggle-label"
        aria-expanded="false"
    >
        ☰ Menu
    </button>

    <nav>
        <ul>
            <li>
                <a
                    href="/index.php"
                    class="<?= $active_page === 'home' ? 'active' : '' ?>"
                >
                    Beranda
                </a>
            </li>

            <li>
                <a
                    href="/alatkemah/list.php"
                    class="<?= $active_page === 'alat' ? 'active' : '' ?>"
                >
                    Data Alat Kemah
                </a>
            </li>

            <li>
                <a
                    href="/anggota/list.php"
                    class="<?= $active_page === 'anggota' ? 'active' : '' ?>"
                >
                    Data Peminjam
                </a>
            </li>
            <?php if (!empty($_SESSION['user_id'])): ?>
                <li class="nav-user">
                    <span>Petugas: <?= htmlspecialchars((string)($_SESSION['user_nama'] ?? $_SESSION['username'] ?? 'Pengguna'), ENT_QUOTES, 'UTF-8') ?></span>
                </li>
                <li><a href="/auth/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/auth/login.php">Login</a></li>
                <li><a href="/auth/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash-message <?= htmlspecialchars($_SESSION['flash']['type'] ?? 'success', ENT_QUOTES, 'UTF-8') ?>" role="status">
        <?= htmlspecialchars(
            $_SESSION['flash']['message'],
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </div>

    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
