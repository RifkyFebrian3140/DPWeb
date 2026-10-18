<?php

$root = dirname(__DIR__);

$requestPath = parse_url(
    $_SERVER['REQUEST_URI'] ?? '/',
    PHP_URL_PATH
);

if ($requestPath === '/') {
    $requestPath = '/index.php';
}

$allowedPages = [
    '/index.php',
    '/alatkemah/list.php',
    '/alatkemah/tambah.php',
    '/alatkemah/proses_tambah.php',
    '/anggota/list.php',
    '/anggota/tambah.php',
    '/anggota/proses_tambah.php',
];

if (!in_array($requestPath, $allowedPages, true)) {
    http_response_code(404);
    exit('404 - Halaman tidak ditemukan');
}

$file = $root . $requestPath;

if (!is_file($file)) {
    http_response_code(404);
    exit('404 - File tidak ditemukan');
}

// Pertahankan path asli agar menu dan aset
// dapat menentukan lokasi halaman dengan benar.
$_SERVER['SCRIPT_NAME'] = $requestPath;

require $file;
