<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if ($nama === '' || $noAnggota === '') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Nama dan nomor anggota wajib diisi.'
    ];

    header('Location: /anggota/tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO anggota (nama, no_anggota, alamat, no_hp)
         VALUES (:nama, :no_anggota, :alamat, :no_hp)"
    );

    $stmt->execute([
        'nama' => $nama,
        'no_anggota' => $noAnggota,
        'alamat' => $alamat !== '' ? $alamat : null,
        'no_hp' => $noHp !== '' ? $noHp : null
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Data peminjam berhasil ditambahkan.'
    ];

    header('Location: /anggota/list.php');
    exit;

} catch (PDOException $e) {
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Nomor anggota sudah terdaftar. Gunakan nomor lain.'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Data peminjam gagal disimpan.'
        ];
    }

    header('Location: /anggota/tambah.php');
    exit;
}