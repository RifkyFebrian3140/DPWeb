<?php
// Guard akses: wajib dipanggil sebelum output HTML.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    $loginUrl = '/auth/login.php';
    header('Location: ' . $loginUrl, true, 302);
    exit;
}
