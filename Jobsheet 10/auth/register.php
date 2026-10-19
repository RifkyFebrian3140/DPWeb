<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!empty($_SESSION['user_id'])) {
    header('Location: /index.php'); exit;
}
$page_title = 'Register Petugas - Camp Gear';
require __DIR__ . '/../includes/header.php';
?>
<main>
<section class="page-heading"><p class="eyebrow">AKUN PETUGAS</p><h1>Register</h1><p>Buat akun petugas Camp Gear.</p></section>
<section class="panel form-panel">
<form class="data-form" method="post" action="/auth/proses_register.php">
<div class="form-group"><label for="nama">Nama</label><input id="nama" name="nama" required maxlength="150" autocomplete="name"></div>
<div class="form-group"><label for="username">Username</label><input id="username" name="username" required maxlength="80" autocomplete="username"></div>
<div class="form-group"><label for="password">Password</label><input type="password" id="password" name="password" required minlength="8" autocomplete="new-password"></div>
<div class="form-group"><label for="konfirmasi_password">Konfirmasi Password</label><input type="password" id="konfirmasi_password" name="konfirmasi_password" required minlength="8" autocomplete="new-password"></div>
<div class="form-actions"><button class="btn btn-primary" type="submit">Daftar</button><a class="btn btn-secondary" href="/auth/login.php">Sudah punya akun?</a></div>
</form>
</section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
