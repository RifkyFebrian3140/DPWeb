# Camp Gear - Jobsheet 7

## Perubahan dari Jobsheet 6
- Halaman HTML diubah menjadi PHP.
- Header dan footer dipusatkan di `includes/header.php` dan `includes/footer.php`.
- Form menggunakan `method="post"` dan diproses oleh `proses_tambah.php`.
- Validasi dilakukan di sisi server menggunakan PHP.
- Data alat dan peminjam dirender dengan `foreach` dari `$_SESSION`.
- Pesan hasil proses ditampilkan melalui flash message.
- Data awal Jobsheet 6 dipertahankan sebagai data awal session. Data baru hanya tersimpan sementara di session, belum ke database.
- File Fetch API dan JSON yang khusus dipakai Jobsheet 6 dihapus.

## Cara menjalankan
1. Pastikan PHP sudah terpasang.
2. Buka terminal di folder `Jobsheet 7`.
3. Jalankan: `php -S localhost:8000`
4. Buka: `http://localhost:8000/index.php`

## Catatan
- Gunakan PHP server, bukan membuka file langsung dengan `file://`.
- Data session bersifat sementara. Jobsheet 8 dapat mengganti penyimpanan session dengan database.
- Validasi server tetap berjalan meskipun JavaScript dinonaktifkan.
