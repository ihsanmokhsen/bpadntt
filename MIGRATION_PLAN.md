# Rencana Migrasi Website BPAD NTT

Website lama tetap aktif sampai seluruh tahap berikut selesai dan disetujui.

## Tahap 1 - Fondasi

- [x] Membuat proyek Laravel terpisah
- [x] Menyiapkan Docker Compose dan PostgreSQL
- [x] Membuat tabel domain BPAD
- [x] Menyiapkan login admin Laravel
- [x] Menyiapkan audit log dasar
- [x] Menyalin aset visual tanpa mengubah sumber

## Tahap 2 - Halaman Publik

- [x] Membuat halaman Blade dari desain website lama
- [x] Memindahkan beranda
- [x] Memindahkan profil dan layanan
- [x] Memindahkan berita, pengumuman, dan agenda
- [x] Memindahkan PPID dan galeri
- [x] Mempertahankan video hardcoded sesuai keputusan

## Tahap 3 - Dashboard Admin

- [x] CRUD berita, pengumuman, dan agenda
- [x] Upload dan pengelolaan gambar lokal
- [ ] Pengaturan website
- [ ] Dokumen PPID
- [ ] Manajemen pengguna dan audit aktivitas

## Tahap 4 - Migrasi Data

- [ ] Memeriksa format backup Supabase
- [ ] Membuat perintah import
- [ ] Mengimpor pengguna tanpa session lama
- [ ] Mengimpor konten, pengaturan, dan metadata PPID
- [ ] Memindahkan gambar base64 menjadi file lokal
- [ ] Membandingkan jumlah dan isi data

## Tahap 5 - Produksi

- [ ] Uji keamanan, responsif, dan performa
- [ ] Backup final Supabase
- [ ] Impor data final ke PostgreSQL VPS
- [ ] Konfigurasi HTTPS, firewall, dan backup eksternal
- [ ] Arahkan domain setelah persetujuan
- [ ] Hentikan Supabase hanya setelah masa observasi
