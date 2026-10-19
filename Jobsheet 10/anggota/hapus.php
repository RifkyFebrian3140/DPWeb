<?php
require_once __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/init.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Method Not Allowed'); }
require __DIR__ . '/../includes/koneksi.php';
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { $_SESSION['flash']=['type'=>'error','message'=>'ID tidak valid.']; header('Location: list.php'); exit; }
$stmt = $pdo->prepare('DELETE FROM anggota WHERE id = :id');
$stmt->execute([':id'=>$id]);
$_SESSION['flash'] = ['type'=>'success','message'=>$stmt->rowCount() ? 'Data berhasil dihapus.' : 'Data tidak ditemukan.'];
header('Location: list.php');
exit;
