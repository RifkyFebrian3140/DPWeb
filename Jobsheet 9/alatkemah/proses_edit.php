<?php
require __DIR__ . '/../includes/init.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Method Not Allowed'); }
require __DIR__ . '/../includes/koneksi.php';
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID tidak valid.'); }
$nama = trim($_POST['nama_alat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$stok = filter_var($_POST['stok'] ?? null, FILTER_VALIDATE_INT);
$kondisi = trim($_POST['kondisi'] ?? '');
if ($nama === '' || !in_array($kategori, ['Tenda','Perlengkapan Tidur','Memasak','Penerangan','Lainnya','Tas','Pendakian','Pakaian','Pelindung'], true) || $stok === false || $stok === null || $stok < 0 || !in_array($kondisi, ['Baik','Perlu Dicek','Rusak'], true)) { $_SESSION['flash']=['type'=>'error','message'=>'Isian alat tidak valid.']; header('Location: edit.php?id='.$id); exit; }
$stmt = $pdo->prepare('UPDATE alat SET nama_alat=:nama, kategori=:kategori, stok=:stok, kondisi=:kondisi WHERE id=:id');
$stmt->execute([':nama'=>$nama, ':kategori'=>$kategori, ':stok'=>$stok, ':kondisi'=>$kondisi, ':id'=>$id]);
$_SESSION['flash'] = ['type'=>'success','message'=>'Data berhasil diperbarui.'];
header('Location: list.php');
exit;
