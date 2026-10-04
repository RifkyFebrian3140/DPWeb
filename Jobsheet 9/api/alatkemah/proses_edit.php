<?php

session_start();

require __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_POST['id'] ?? 0);

$namaAlat = trim($_POST['nama_alat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$stok = $_POST['stok'] ?? '';
$kondisi = trim($_POST['kondisi'] ?? '');

$errors = [];

if ($id <= 0) {
    $errors[] = 'ID alat tidak valid.';
}

if ($namaAlat === '') {
    $errors[] = 'Nama alat wajib diisi.';
}

if (!filter_var($stok, FILTER_VALIDATE_INT) || (int) $stok < 0) {
    $errors[] = 'Stok harus berupa bilangan bulat dan tidak boleh negatif.';
}

$kondisiValid = [
    'Baik',
    'Rusak Ringan',
    'Rusak Berat'
];

if (!in_array($kondisi, $kondisiValid, true)) {
    $errors[] = 'Kondisi alat tidak valid.';
}

if (!empty($errors)) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: /alatkemah/edit.php?id=' . $id);
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE alat
     SET nama_alat = :nama_alat,
         kategori = :kategori,
         stok = :stok,
         kondisi = :kondisi
     WHERE id = :id"
);

$stmt->execute([
    'nama_alat' => $namaAlat,
    'kategori' => $kategori !== '' ? $kategori : null,
    'stok' => (int) $stok,
    'kondisi' => $kondisi,
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Data alat kemah berhasil diperbarui.'
];

header('Location: /alatkemah/list.php');
exit;