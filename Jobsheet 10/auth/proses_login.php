<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /auth/login.php'); exit; }
require __DIR__ . '/../includes/koneksi.php';
$username = trim((string)($_POST['username'] ?? ''));
$password = (string)($_POST['password'] ?? '');
$stmt = $pdo->prepare('SELECT id, nama, username, password, role FROM users WHERE username = :username LIMIT 1');
$stmt->execute([':username'=>$username]);
$user = $stmt->fetch();
if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['flash'] = ['type'=>'error','message'=>'Username atau password salah.'];
    header('Location: /auth/login.php'); exit;
}
session_regenerate_id(true);
$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['user_nama'] = $user['nama'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];
$_SESSION['flash'] = ['type'=>'success','message'=>'Login berhasil. Selamat datang, '.$user['nama'].'.'];
header('Location: /index.php'); exit;
