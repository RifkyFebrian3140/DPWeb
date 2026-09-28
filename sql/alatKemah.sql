CREATE TABLE IF NOT EXISTS alat (
    id SERIAL PRIMARY KEY,
    nama_alat VARCHAR(150) NOT NULL,
    kategori VARCHAR(100),
    stok INTEGER NOT NULL DEFAULT 0 CHECK (stok >= 0),
    kondisi VARCHAR(50) NOT NULL DEFAULT 'Baik'
);

CREATE TABLE IF NOT EXISTS peminjaman (
    id SERIAL PRIMARY KEY,
    anggota_id INTEGER REFERENCES anggota(id),
    alat_id INTEGER NOT NULL REFERENCES alat(id),
    jumlah INTEGER NOT NULL CHECK (jumlah > 0),
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Dipinjam'
);