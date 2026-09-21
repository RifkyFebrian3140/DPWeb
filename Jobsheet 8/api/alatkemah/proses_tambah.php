<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

// Ambil data dari form
$namaAlat = trim($_POST['nama_alat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$stok = $_POST['stok'] ?? '';
$kondisi = trim($_POST['kondisi'] ?? 'Baik');

// Validasi
$errors = [];

if ($namaAlat === '') {
    $errors[] = 'Nama alat wajib diisi.';
}

if (!filter_var($stok, FILTER_VALIDATE_INT) || (int) $stok < 0) {
    $errors[] = 'Stok harus berupa bilangan bulat dan tidak boleh negatif.';
}

$kondisiValid = ['Baik', 'Rusak Ringan', 'Rusak Berat'];

if (!in_array($kondisi, $kondisiValid, true)) {
    $errors[] = 'Kondisi alat tidak valid.';
}

// Jika validasi gagal, kembali ke form
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: /alatkemah/tambah.php');
    exit;
}

// Simpan ke database
$stmt = $pdo->prepare(
    "INSERT INTO alat (nama_alat, kategori, stok, kondisi)
     VALUES (:nama_alat, :kategori, :stok, :kondisi)"
);

$stmt->execute([
    'nama_alat' => $namaAlat,
    'kategori' => $kategori !== '' ? $kategori : null,
    'stok' => (int) $stok,
    'kondisi' => $kondisi
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Data alat kemah berhasil ditambahkan.'
];

header('Location: /alatkemah/list.php');
exit;