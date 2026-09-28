<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: /anggota/list.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID peminjam tidak valid.'
    ];

    header('Location: /anggota/list.php');
    exit;
}

$stmt = $pdo->prepare(
    "DELETE FROM anggota WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Data peminjam berhasil dihapus.'
];

header('Location: /anggota/list.php');
exit;