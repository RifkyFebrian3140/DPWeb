<?php
require_once __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/init.php';
require __DIR__ . '/../includes/koneksi.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { http_response_code(400); exit('ID tidak valid.'); }
$stmt = $pdo->prepare('SELECT * FROM alat WHERE id = :id');
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();
if (!$row) { http_response_code(404); exit('Data tidak ditemukan.'); }
$page_title = 'Edit Data Alat Kemah - Camp Gear';
$active_page = 'alat';
require __DIR__ . '/../includes/header.php';
?>
<main>
<section class="page-heading"><p class="eyebrow">CAMP GEAR</p><h1>Edit Data Alat Kemah</h1><p>Perbarui data yang dipilih.</p></section>
<section class="panel form-panel">
<form class="data-form" method="post" action="proses_edit.php">
<input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
<div class="form-group"><label for="nama_alat">Nama Alat</label><input type="text" id="nama_alat" name="nama_alat" value="<?= htmlspecialchars((string)$row['nama_alat'], ENT_QUOTES, 'UTF-8') ?>"  required></div><div class="form-group"><label for="kategori">Kategori</label><select id="kategori" name="kategori" required><?php foreach (['Tenda','Perlengkapan Tidur','Memasak','Penerangan','Lainnya','Tas','Pendakian','Pakaian','Pelindung'] as $option): ?><option value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>" <?= $row['kategori'] === $option ? 'selected' : '' ?>><?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div><div class="form-group"><label for="stok">Stok</label><input type="number" id="stok" name="stok" value="<?= htmlspecialchars((string)$row['stok'], ENT_QUOTES, 'UTF-8') ?>" min="0" step="1" required></div><div class="form-group"><label for="kondisi">Kondisi</label><select id="kondisi" name="kondisi" required><?php foreach (['Baik','Perlu Dicek','Rusak'] as $option): ?><option value="<?= $option ?>" <?= $row['kondisi'] === $option ? 'selected' : '' ?>><?= $option ?></option><?php endforeach; ?></select></div>
<div class="form-actions"><button type="submit" class="btn btn-primary">Simpan Perubahan</button><a href="list.php" class="btn btn-secondary">Batal</a></div>
</form></section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
