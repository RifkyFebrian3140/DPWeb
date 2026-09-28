<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /alatkemah/list.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID alat tidak valid.'
    ];

    header('Location: /alatkemah/list.php');
    exit;
}

$stmt = $pdo->prepare(
    "DELETE FROM alat WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Data alat kemah berhasil dihapus.'
];

header('Location: /alatkemah/list.php');
exit;