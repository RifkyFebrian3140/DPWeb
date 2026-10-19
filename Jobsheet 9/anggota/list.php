<?php
require __DIR__ . '/../includes/init.php';
require __DIR__ . '/../includes/koneksi.php';
$q = trim((string)($_GET['q'] ?? ''));
$page = max(1, filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT) ?: 1);
$perPage = 5;
$where = $q !== '' ? ' WHERE (nama ILIKE :kw OR nomor_identitas ILIKE :kw OR telepon ILIKE :kw OR alamat ILIKE :kw)' : '';
$countStmt = $pdo->prepare('SELECT COUNT(*) FROM anggota' . $where);
if ($q !== '') $countStmt->execute([':kw' => '%' . $q . '%']); else $countStmt->execute();
$total = (int)$countStmt->fetchColumn();
$totalPages = max(1, (int)ceil($total / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$sql = 'SELECT * FROM anggota' . $where . ' ORDER BY id DESC LIMIT :lim OFFSET :off';
$stmt = $pdo->prepare($sql);
if ($q !== '') $stmt->bindValue(':kw', '%' . $q . '%', PDO::PARAM_STR);
$stmt->bindValue(':lim', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':off', $offset, PDO::PARAM_INT);
$stmt->execute();
$items = $stmt->fetchAll();
$page_title = 'Data Peminjam - Camp Gear';
$active_page = 'anggota';
require __DIR__ . '/../includes/header.php';
?>
<main>
<section class="page-heading"><p class="eyebrow">MANAJEMEN ANGGOTA</p><h1>Data Peminjam</h1><p>Kelola data melalui database PostgreSQL.</p></section>
<section class="panel">
<div class="panel-heading"><div><h2>Daftar Data Peminjam</h2><p>Pencarian server-side dan pagination, 5 data per halaman.</p></div><a href="tambah.php" class="btn btn-primary">+ Tambah Peminjam</a></div>
<form method="get" action="list.php" class="search-form">
<label for="search-input">Cari data</label>
<div class="search-controls"><input type="search" id="search-input" name="q" value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?>" placeholder="Ketik kata kunci..."><button class="btn btn-primary" type="submit">Cari</button><?php if ($q !== ''): ?><a class="btn btn-secondary" href="list.php">Reset</a><?php endif; ?></div>
</form>
<div class="table-responsive"><table><thead><tr><th>No.</th><th>Nama</th><th>Nomor Identitas</th><th>Nomor Telepon</th><th>Alamat</th><th>Aksi</th></tr></thead><tbody>
<?php if (!$items): ?><tr><td colspan="6">Data tidak ditemukan.</td></tr>
<?php else: foreach ($items as $index => $item): ?><tr><td><?= $offset + $index + 1 ?></td><td><?= htmlspecialchars((string)$item['nama'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string)$item['nomor_identitas'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string)$item['telepon'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string)$item['alamat'], ENT_QUOTES, 'UTF-8') ?></td><td class="action-buttons"><a class="btn btn-secondary" href="edit.php?id=<?= (int)$item['id'] ?>">Edit</a><form class="form-hapus" method="post" action="hapus.php"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button type="submit" class="btn btn-danger">Hapus</button></form></td></tr><?php endforeach; endif; ?>
</tbody></table></div>
<div class="pagination"><span>Halaman <?= $page ?> dari <?= $totalPages ?> (<?= $total ?> data)</span><div><?php if ($page > 1): ?><a class="btn btn-secondary" href="?q=<?= rawurlencode($q) ?>&page=<?= $page-1 ?>">Sebelumnya</a><?php endif; ?><?php if ($page < $totalPages): ?><a class="btn btn-secondary" href="?q=<?= rawurlencode($q) ?>&page=<?= $page+1 ?>">Berikutnya</a><?php endif; ?></div></div>
</section><div class="back-link"><a href="../index.php" class="text-link">&larr; Kembali ke Beranda</a></div></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
