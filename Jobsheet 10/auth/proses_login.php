<<<<<<< HEAD
<?php

require_once '../includes/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    die('Username dan password wajib diisi.');
}

$stmt = $pdo->prepare("
    SELECT id, nama, username, password, role
    FROM users
    WHERE username = :username
");

$stmt->execute([
    ':username' => $username
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Username atau password salah.');
}

if (!password_verify($password, $user['password'])) {
    die('Username atau password salah.');
}

/* Login berhasil */
session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['nama'] = $user['nama'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

header('Location: ../index.php');
=======
<?php

require_once '../includes/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    die('Username dan password wajib diisi.');
}

$stmt = $pdo->prepare("
    SELECT id, nama, username, password, role
    FROM users
    WHERE username = :username
");

$stmt->execute([
    ':username' => $username
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Username atau password salah.');
}

if (!password_verify($password, $user['password'])) {
    die('Username atau password salah.');
}

/* Login berhasil */
session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['nama'] = $user['nama'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

header('Location: ../index.php');
>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
exit;