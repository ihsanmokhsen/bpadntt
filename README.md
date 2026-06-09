# Website BPAD NTT - Laravel

Aplikasi baru BPAD NTT berbasis Laravel dan PostgreSQL. Proyek ini dibangun berdampingan dengan website HTML/Supabase lama agar proses migrasi tidak mengganggu website aktif.

## Status Saat Ini

- Laravel 13 dan PHP 8.5
- Struktur PostgreSQL untuk konten, pengaturan, media, PPID, pengguna, session, dan audit log
- Login admin memakai session Laravel, CSRF, dan rate limiting
- Seluruh tampilan publik lama sudah menjadi halaman Blade dan route Laravel
- Konten publik membaca API Laravel, tanpa koneksi langsung ke Supabase
- Dashboard pemeriksaan awal
- Docker Compose untuk Laravel, PostgreSQL, dan Adminer
- SQLite dipakai sementara agar aplikasi bisa dijalankan sebelum Docker dipasang
- Aset visual website lama sudah disalin ke `public/assets`

## Menjalankan Sekarang Tanpa Docker

```bash
./bpad local
```

Buka:

```text
Website: http://127.0.0.1:8000
Admin:   http://127.0.0.1:8000/admin/login
```

## Menjalankan Setelah Docker Terpasang

```bash
./bpad start
```

Buka:

```text
Website:  http://127.0.0.1:8000
Admin:    http://127.0.0.1:8000/admin/login
Database: http://127.0.0.1:8080
```

Data PostgreSQL tersimpan di Docker volume. `./bpad stop` tidak menghapus data.

## Perintah Sederhana

```bash
./bpad local
./bpad start
./bpad stop
./bpad status
./bpad logs
./bpad test
./bpad migrate
./bpad admin
./bpad backup
```

## Keamanan

- Jangan commit file `.env`.
- Ganti password database di `compose.yaml` sebelum produksi.
- Buat akun admin menggunakan `./bpad admin`.
- Jangan memakai `APP_DEBUG=true` di VPS produksi.
- PostgreSQL produksi tidak boleh dibuka langsung ke internet.

## Tahap Migrasi

Lihat [MIGRATION_PLAN.md](MIGRATION_PLAN.md) untuk urutan pemindahan website lama dan data Supabase.
