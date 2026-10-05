<<<<<<< HEAD
<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_POST['id'] ?? 0);

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if ($id <= 0 || $nama === '' || $noAnggota === '') {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Nama dan nomor anggota wajib diisi.'
    ];

    header('Location: /anggota/edit.php?id=' . $id);
    exit;
}

try {

    $stmt = $pdo->prepare(
        "UPDATE anggota
         SET nama = :nama,
             no_anggota = :no_anggota,
             alamat = :alamat,
             no_hp = :no_hp
         WHERE id = :id"
    );

    $stmt->execute([
        'nama' => $nama,
        'no_anggota' => $noAnggota,
        'alamat' => $alamat !== '' ? $alamat : null,
        'no_hp' => $noHp !== '' ? $noHp : null,
        'id' => $id
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Data peminjam berhasil diperbarui.'
    ];

    header('Location: /anggota/list.php');
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === '23505') {

        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Nomor anggota sudah terdaftar.'
        ];

    } else {

        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Data peminjam gagal diperbarui.'
        ];
    }

    header('Location: /anggota/edit.php?id=' . $id);
    exit;
=======
<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_POST['id'] ?? 0);

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if ($id <= 0 || $nama === '' || $noAnggota === '') {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Nama dan nomor anggota wajib diisi.'
    ];

    header('Location: /anggota/edit.php?id=' . $id);
    exit;
}

try {

    $stmt = $pdo->prepare(
        "UPDATE anggota
         SET nama = :nama,
             no_anggota = :no_anggota,
             alamat = :alamat,
             no_hp = :no_hp
         WHERE id = :id"
    );

    $stmt->execute([
        'nama' => $nama,
        'no_anggota' => $noAnggota,
        'alamat' => $alamat !== '' ? $alamat : null,
        'no_hp' => $noHp !== '' ? $noHp : null,
        'id' => $id
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Data peminjam berhasil diperbarui.'
    ];

    header('Location: /anggota/list.php');
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === '23505') {

        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Nomor anggota sudah terdaftar.'
        ];

    } else {

        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Data peminjam gagal diperbarui.'
        ];
    }

    header('Location: /anggota/edit.php?id=' . $id);
    exit;
>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
}