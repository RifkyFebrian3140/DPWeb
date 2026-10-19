<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: /auth/register.php'); exit; }
require __DIR__ . '/../includes/koneksi.php';
$nama = trim((string)($_POST['nama'] ?? ''));
$username = trim((string)($_POST['username'] ?? ''));
$password = (string)($_POST['password'] ?? '');
$konfirmasi = (string)($_POST['konfirmasi_password'] ?? '');
if ($nama === '' || $username === '' || strlen($password) < 8 || $password !== $konfirmasi) {
    $_SESSION['flash'] = ['type'=>'error','message'=>'Data tidak valid. Pastikan password minimal 8 karakter dan kedua password sama.'];
    header('Location: /auth/register.php'); exit;
}
try {
    $stmt = $pdo->prepare('INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)');
    $stmt->execute([':nama'=>$nama, ':username'=>$username, ':password'=>password_hash($password, PASSWORD_DEFAULT), ':role'=>'petugas']);
    $_SESSION['flash'] = ['type'=>'success','message'=>'Registrasi berhasil. Silakan login.'];
    header('Location: /auth/login.php'); exit;
} catch (PDOException $e) {
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = ['type'=>'error','message'=>'Username sudah digunakan. Silakan pilih username lain.'];
        header('Location: /auth/register.php'); exit;
    }
    error_log('Register gagal: '.$e->getMessage());
    http_response_code(500); exit('Registrasi gagal. Periksa koneksi database.');
}
