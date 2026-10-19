<?php
require_once __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/init.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$nama = trim($_POST['nama_alat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$stokInput = trim((string)($_POST['stok'] ?? ''));
$kondisi = trim($_POST['kondisi'] ?? '');
$kategoriValid = ['Tenda', 'Perlengkapan Tidur', 'Memasak', 'Penerangan', 'Lainnya', 'Tas', 'Pendakian', 'Pakaian', 'Pelindung'];
$kondisiValid = ['Baik', 'Perlu Dicek', 'Rusak'];

if ($nama === '' || !in_array($kategori, $kategoriValid, true) ||
    $stokInput === '' || filter_var($stokInput, FILTER_VALIDATE_INT) === false ||
    (int)$stokInput < 0 || !in_array($kondisi, $kondisiValid, true)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menyimpan alat. Periksa semua isian dan pastikan stok bilangan bulat minimal 0.'];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO alat (nama_alat, kategori, stok, kondisi)
         VALUES (:nama_alat, :kategori, :stok, :kondisi)
         RETURNING id'
    );
    $stmt->execute([
        ':nama_alat' => $nama,
        ':kategori' => $kategori,
        ':stok' => (int)$stokInput,
        ':kondisi' => $kondisi,
    ]);
    $idBaru = $stmt->fetchColumn();
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data alat kemah berhasil ditambahkan (ID ' . $idBaru . ').'];
} catch (PDOException $e) {
    error_log('Gagal menambahkan alat: ' . $e->getMessage());
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Data alat gagal disimpan ke database. Periksa koneksi dan struktur tabel.'];
}

header('Location: list.php');
exit;
