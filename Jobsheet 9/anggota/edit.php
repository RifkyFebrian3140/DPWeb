<?php
require __DIR__ . '/../includes/init.php';
require __DIR__ . '/../includes/koneksi.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID tidak valid.'); }
$stmt = $pdo->prepare('SELECT * FROM anggota WHERE id = :id');
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();
if (!$row) { http_response_code(404); exit('Data tidak ditemukan.'); }
$page_title = 'Edit Data Peminjam - Camp Gear';
$active_page = 'anggota';
require __DIR__ . '/../includes/header.php';
?>
<main>
<section class="page-heading"><p class="eyebrow">CAMP GEAR</p><h1>Edit Data Peminjam</h1><p>Perbarui data yang dipilih.</p></section>
<section class="panel form-panel">
<form class="data-form" method="post" action="proses_edit.php">
<input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
<div class="form-group"><label for="nama">Nama Lengkap</label><input type="text" id="nama" name="nama" value="<?= htmlspecialchars((string)$row['nama'], ENT_QUOTES, 'UTF-8') ?>"  required></div><div class="form-group"><label for="nomor_identitas">Nomor Identitas</label><input type="text" id="nomor_identitas" name="nomor_identitas" value="<?= htmlspecialchars((string)$row['nomor_identitas'], ENT_QUOTES, 'UTF-8') ?>"  required></div><div class="form-group"><label for="telepon">Nomor Telepon</label><input type="tel" id="telepon" name="telepon" value="<?= htmlspecialchars((string)$row['telepon'], ENT_QUOTES, 'UTF-8') ?>"  required></div><div class="form-group"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" rows="4" required><?= htmlspecialchars((string)$row['alamat'], ENT_QUOTES, 'UTF-8') ?></textarea></div>
<div class="form-actions"><button type="submit" class="btn btn-primary">Simpan Perubahan</button><a href="list.php" class="btn btn-secondary">Batal</a></div>
</form></section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
