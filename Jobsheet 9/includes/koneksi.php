<?php
// Kredensial database diatur melalui Environment Variables (lokal/Vercel).
$host = getenv('DB_HOST') ?: '';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'postgres';
$user = getenv('DB_USER') ?: '';
$pass = getenv('DB_PASS') ?: '';
$sslmode = getenv('DB_SSLMODE') ?: 'require';

if ($host === '' || $user === '' || $pass === '') {
    http_response_code(500);
    exit('Konfigurasi database belum lengkap. Atur DB_HOST, DB_USER, dan DB_PASS pada environment variables.');
}

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname};sslmode={$sslmode}";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log('Koneksi PostgreSQL gagal: ' . $e->getMessage());
    http_response_code(500);
    exit('Koneksi database gagal. Periksa environment variables dan dukungan pdo_pgsql.');
}
