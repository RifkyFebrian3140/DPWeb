<?php
require_once __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/init.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Method Not Allowed'); }
require __DIR__ . '/../includes/koneksi.php';
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID tidak valid.'); }
$nama = trim($_POST['nama'] ?? '');
$identitas = trim($_POST['nomor_identitas'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
if ($nama === '' || $identitas === '' || $telepon === '' || $alamat === '') { $_SESSION['flash']=['type'=>'error','message'=>'Semua kolom wajib diisi.']; header('Location: edit.php?id='.$id); exit; }
$stmt = $pdo->prepare('UPDATE anggota SET nama=:nama, nomor_identitas=:nomor_identitas, telepon=:telepon, alamat=:alamat WHERE id=:id');
try { $stmt->execute([':nama'=>$nama, ':nomor_identitas'=>$identitas, ':telepon'=>$telepon, ':alamat'=>$alamat, ':id'=>$id]); } catch (PDOException $e) { error_log($e->getMessage()); $_SESSION['flash']=['type'=>'error','message'=>'Gagal memperbarui data. Nomor identitas mungkin sudah digunakan.']; header('Location: edit.php?id='.$id); exit; }
$_SESSION['flash'] = ['type'=>'success','message'=>'Data berhasil diperbarui.'];
header('Location: list.php');
exit;
