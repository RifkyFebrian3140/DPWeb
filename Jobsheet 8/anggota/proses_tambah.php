<?php
require __DIR__ . '/../includes/init.php';
require __DIR__ . '/../includes/koneksi.php';

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

try {
    $stmt = $pdo->prepare(
        'INSERT INTO anggota (nama, nomor_identitas, telepon, alamat)
         VALUES (:nama, :nomor_identitas, :telepon, :alamat)
         RETURNING id'
    );
    $stmt->execute([
        ':nama' => $nama,
        ':nomor_identitas' => $identitas,
        ':telepon' => $telepon,
        ':alamat' => $alamat,
    ]);
    $idBaru = $stmt->fetchColumn();
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data peminjam berhasil ditambahkan (ID ' . $idBaru . ').'];
} catch (PDOException $e) {
    error_log('Gagal menambahkan anggota: ' . $e->getMessage());
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Nomor identitas sudah digunakan.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Data peminjam gagal disimpan ke database. Periksa koneksi dan struktur tabel.'];
    }
}

header('Location: list.php');
exit;
