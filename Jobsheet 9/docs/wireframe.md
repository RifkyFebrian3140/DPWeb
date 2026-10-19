# Wireframe & User Flow - Camp Gear

Sub-CPMK: Merancang UI/UX aplikasi (proyek).

Dokumen ini berisi rancangan fitur Login, Dashboard Petugas, Peminjaman, Pengembalian, dan Riwayat yang akan dikembangkan pada jobsheet berikutnya.

## Aktor
- **Tamu**: dapat melihat halaman beranda, daftar alat kemah, dan daftar peminjam.
- **Petugas**: login untuk mengelola data alat, anggota, dan transaksi peminjaman.

## User Flow - Peminjaman Alat

```text
[Petugas Login] -> [Dashboard] -> [Pilih Peminjam]
        -> [Pilih Alat] -> [Isi Jumlah] -> [Simpan]
        -> [Stok Berkurang] -> [Kembali ke Dashboard]
```

## User Flow - Pengembalian Alat

```text
[Dashboard] -> [Pilih Pengembalian] -> [Cari Transaksi]
        -> [Konfirmasi Pengembalian] -> [Stok Bertambah]
        -> [Kembali ke Dashboard]
```

## Wireframe: Halaman Login

```text
+----------------------------------+
|            CAMP GEAR             |
|----------------------------------|
|          Login Petugas            |
|                                  |
|  Username : [____________]       |
|  Password : [____________]       |
|                                  |
|            [ Masuk ]              |
+----------------------------------+
```

## Wireframe: Dashboard Petugas

```text
+------------------------------------------+
| CAMP GEAR       Beranda | Alat | Anggota |
|------------------------------------------|
| Total Alat | Total Peminjam | Dipinjam   |
|------------------------------------------|
| [Peminjaman Baru] [Pengembalian]         |
|                                          |
| Transaksi Terbaru                        |
| Peminjam | Alat | Tanggal | Status       |
+------------------------------------------+
```

## Wireframe: Form Peminjaman

```text
+----------------------------------+
|        Peminjaman Alat           |
|----------------------------------|
| Peminjam : [Pilih Anggota]       |
| Alat     : [Pilih Alat]          |
| Jumlah   : [__________]          |
| Tanggal  : [__________]          |
|                                  |
|          [ Simpan ]              |
+----------------------------------+
```

## Wireframe: Form Pengembalian

```text
+----------------------------------+
|       Pengembalian Alat          |
|----------------------------------|
| Cari Transaksi: [___________]    |
|                                  |
| Peminjam | Alat | Tanggal        |
| Status   | [Kembalikan]          |
+----------------------------------+
```

## Wireframe: Riwayat Peminjaman

```text
+------------------------------------------+
|          Riwayat Peminjaman              |
|------------------------------------------|
| Cari: [Nama Peminjam atau Alat]          |
|------------------------------------------|
| Peminjam | Alat | Tgl Pinjam | Status    |
| Andi     | Tenda| 10/10/2026 | Selesai   |
| Budi     | Matras| 11/10/2026| Dipinjam  |
+------------------------------------------+
```

## Konsistensi dengan Desain yang Sudah Berjalan
- Warna, navbar, tabel, dan kartu mengikuti desain `assets/css/style.css` dari Jobsheet 2 dan 3.
- Fitur login dan transaksi akan dikembangkan pada jobsheet berikutnya.
- Alat dengan stok kosong tidak dapat dipinjam.
- Stok alat bertambah kembali setelah pengembalian diproses.

## Kesimpulan
Wireframe dan user flow ini menjadi acuan untuk pengembangan fitur Camp Gear pada jobsheet berikutnya.
