<?php
session_start();
require __DIR__ . '/../includes/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$identitas = trim($_POST['nomor_identitas'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');

if ($nama === '' || $identitas === '' || $telepon === '' || $alamat === '') {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menyimpan peminjam. Semua kolom wajib diisi.'];
    header('Location: tambah.php');
    exit;
}

foreach ($_SESSION['anggota'] as $anggota) {
    if (strcasecmp($anggota['nomor_identitas'], $identitas) === 0) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Nomor identitas sudah digunakan.'];
        header('Location: tambah.php');
        exit;
    }
}

$ids = array_column($_SESSION['anggota'], 'id');
$_SESSION['anggota'][] = [
    'id' => $ids ? max($ids) + 1 : 1,
    'nama' => $nama,
    'nomor_identitas' => $identitas,
    'telepon' => $telepon,
    'alamat' => $alamat,
];
$_SESSION['flash'] = ['type' => 'success', 'message' => 'Data peminjam berhasil ditambahkan.'];
header('Location: list.php');
exit;
