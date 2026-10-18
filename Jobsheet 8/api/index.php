<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => 'index.php',
    '/index.php' => 'index.php',

    '/alatkemah/list.php' => 'alatkemah/list.php',
    '/alatkemah/tambah.php' => 'alatkemah/tambah.php',
    '/alatkemah/proses_tambah.php' => 'alatkemah/proses_tambah.php',

    '/anggota/list.php' => 'anggota/list.php',
    '/anggota/tambah.php' => 'anggota/tambah.php',
    '/anggota/proses_tambah.php' => 'anggota/proses_tambah.php',
];

if (!isset($routes[$path])) {
    http_response_code(404);
    exit('Halaman tidak ditemukan');
}

require __DIR__ . '/../' . $routes[$path];
