<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!empty($_SESSION['user_id'])) { header('Location: /index.php'); exit; }
$page_title = 'Login Petugas - Camp Gear';
require __DIR__ . '/../includes/header.php';
?>
<main>
<section class="page-heading"><p class="eyebrow">AKSES PENGELOLAAN</p><h1>Login Petugas</h1><p>Masuk untuk mengelola alat kemah dan data peminjam.</p></section>
<section class="panel form-panel">
<form class="data-form" method="post" action="/auth/proses_login.php">
<div class="form-group"><label for="username">Username</label><input id="username" name="username" required autocomplete="username"></div>
<div class="form-group"><label for="password">Password</label><input type="password" id="password" name="password" required autocomplete="current-password"></div>
<div class="form-actions"><button class="btn btn-primary" type="submit">Login</button><a class="btn btn-secondary" href="/auth/register.php">Buat akun</a></div>
</form>
</section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
