<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['alat'])) {
    $_SESSION['alat'] = [
        ['id' => 1, 'nama_alat' => 'Tenda Dome', 'kategori' => 'Tenda', 'stok' => 5, 'kondisi' => 'Baik'],
        ['id' => 2, 'nama_alat' => 'Sleeping Bag', 'kategori' => 'Perlengkapan Tidur', 'stok' => 8, 'kondisi' => 'Baik'],
        ['id' => 3, 'nama_alat' => 'Kompor Portable', 'kategori' => 'Memasak', 'stok' => 0, 'kondisi' => 'Perlu Dicek'],
        ['id' => 4, 'nama_alat' => 'Matras', 'kategori' => 'Perlengkapan Tidur', 'stok' => 10, 'kondisi' => 'Baik'],
        ['id' => 5, 'nama_alat' => 'Headlamp', 'kategori' => 'Penerangan', 'stok' => 7, 'kondisi' => 'Baik'],
        ['id' => 6, 'nama_alat' => 'Carrier 60L', 'kategori' => 'Tas', 'stok' => 4, 'kondisi' => 'Baik'],
        ['id' => 7, 'nama_alat' => 'Trekking Pole', 'kategori' => 'Pendakian', 'stok' => 6, 'kondisi' => 'Baik'],
        ['id' => 8, 'nama_alat' => 'Nesting', 'kategori' => 'Memasak', 'stok' => 5, 'kondisi' => 'Baik'],
        ['id' => 9, 'nama_alat' => 'Jas Hujan', 'kategori' => 'Pakaian', 'stok' => 9, 'kondisi' => 'Baik'],
        ['id' => 10, 'nama_alat' => 'Flysheet', 'kategori' => 'Pelindung', 'stok' => 3, 'kondisi' => 'Perlu Dicek'],
    ];
}
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [
        ['id' => 1, 'nama' => 'Andi Pratama', 'nomor_identitas' => 'AG001', 'telepon' => '081234567801', 'alamat' => 'Malang'],
        ['id' => 2, 'nama' => 'Budi Santoso', 'nomor_identitas' => 'AG002', 'telepon' => '081234567802', 'alamat' => 'Batu'],
        ['id' => 3, 'nama' => 'Citra Lestari', 'nomor_identitas' => 'AG003', 'telepon' => '081234567803', 'alamat' => 'Pasuruan'],
        ['id' => 4, 'nama' => 'Dimas Saputra', 'nomor_identitas' => 'AG004', 'telepon' => '081234567804', 'alamat' => 'Kepanjen'],
    ];
}
