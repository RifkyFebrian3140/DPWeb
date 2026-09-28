<?php

require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi_password = $_POST['konfirmasi_password'] ?? '';

if ($nama === '' || $username === '' || $password === '') {
    die('Semua data wajib diisi.');
}

if ($password !== $konfirmasi_password) {
    die('Konfirmasi password tidak sesuai.');
}

/* Cek username */
$stmt = $pdo->prepare("
    SELECT id 
    FROM users 
    WHERE username = :username
");

$stmt->execute([
    ':username' => $username
]);

if ($stmt->fetch()) {
    die('Username sudah digunakan.');
}

/* Hash password */
$password_hash = password_hash($password, PASSWORD_DEFAULT);

/* Simpan user */
$stmt = $pdo->prepare("
    INSERT INTO users (nama, username, password, role)
    VALUES (:nama, :username, :password, :role)
");

$stmt->execute([
    ':nama' => $nama,
    ':username' => $username,
    ':password' => $password_hash,
    ':role' => 'petugas'
]);

header('Location: login.php');
exit;