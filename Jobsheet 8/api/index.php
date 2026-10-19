<?php
// Front controller: serves CSS/JS and routes PHP pages for Vercel.
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rawurldecode($path);

// Serve assets through the PHP function so they do not depend on a public/ folder.
$assets = [
    '/assets/css/style.css' => [__DIR__ . '/../assets/css/style.css', 'text/css; charset=utf-8'],
    '/assets/js/apps.js' => [__DIR__ . '/../assets/js/apps.js', 'application/javascript; charset=utf-8'],
];
if (isset($assets[$path])) {
    [$file, $contentType] = $assets[$path];
    if (!is_file($file)) {
        http_response_code(404);
        exit('Asset tidak ditemukan');
    }
    header('Content-Type: ' . $contentType);
    header('Cache-Control: public, max-age=3600');
    readfile($file);
    exit;
}

$routes = [
    '/' => 'index.php',
    '/index.php' => 'index.php',
    '/alatkemah' => 'alatkemah/list.php',
    '/alatkemah/' => 'alatkemah/list.php',
    '/alatkemah/list.php' => 'alatkemah/list.php',
    '/alatkemah/tambah.php' => 'alatkemah/tambah.php',
    '/alatkemah/proses_tambah.php' => 'alatkemah/proses_tambah.php',
    '/anggota' => 'anggota/list.php',
    '/anggota/' => 'anggota/list.php',
    '/anggota/list.php' => 'anggota/list.php',
    '/anggota/tambah.php' => 'anggota/tambah.php',
    '/anggota/proses_tambah.php' => 'anggota/proses_tambah.php',
];

if (!isset($routes[$path])) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    exit('Halaman tidak ditemukan');
}
require __DIR__ . '/../' . $routes[$path];
