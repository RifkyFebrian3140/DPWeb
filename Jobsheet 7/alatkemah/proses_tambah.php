<?php
session_start();
require __DIR__ . '/../includes/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$nama = trim($_POST['nama_alat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$stokInput = trim((string)($_POST['stok'] ?? ''));
$kondisi = trim($_POST['kondisi'] ?? '');
$kategoriValid = ['Tenda', 'Perlengkapan Tidur', 'Memasak', 'Penerangan', 'Lainnya'];
$kondisiValid = ['Baik', 'Perlu Dicek', 'Rusak'];

if ($nama === '' || !in_array($kategori, $kategoriValid, true) ||
    $stokInput === '' || filter_var($stokInput, FILTER_VALIDATE_INT) === false ||
    (int)$stokInput < 0 || !in_array($kondisi, $kondisiValid, true)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menyimpan alat. Periksa semua isian dan pastikan stok bilangan bulat minimal 0.'];
    header('Location: tambah.php');
    exit;
}

$ids = array_column($_SESSION['alat'], 'id');
$_SESSION['alat'][] = [
    'id' => $ids ? max($ids) + 1 : 1,
    'nama_alat' => $nama,
    'kategori' => $kategori,
    'stok' => (int)$stokInput,
    'kondisi' => $kondisi,
];
$_SESSION['flash'] = ['type' => 'success', 'message' => 'Data alat kemah berhasil ditambahkan.'];
header('Location: list.php');
exit;
