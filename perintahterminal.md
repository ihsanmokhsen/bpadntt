# Perintah Terminal Laravel BPAD NTT

## Masuk ke Folder Proyek

```bash
cd "/Users/ihsanmokhsen/Documents/@Project Sistem Informasi/webbpadntt-laravel"
```

## Menjalankan Aplikasi

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Akses aplikasi melalui:

- Website publik: <http://127.0.0.1:8000>
- Login admin: <http://127.0.0.1:8000/admin/login>

Untuk menghentikan server, tekan `Ctrl + C` pada terminal.

## Database

Menjalankan migration:

```bash
php artisan migrate
```

Mengisi data awal:

```bash
php artisan db:seed
```

Menjalankan seeder pengaturan website:

```bash
php artisan db:seed --class=Database\\Seeders\\WebsiteSettingSeeder
```

Melihat status migration:

```bash
php artisan migrate:status
```

Menghapus seluruh tabel, lalu menjalankan migration dan seeder ulang:

```bash
php artisan migrate:fresh --seed
```

> Peringatan: `migrate:fresh --seed` menghapus seluruh data database.

## Membuat atau Memperbarui Admin

```bash
php artisan bpad:admin \
  --username=admin \
  --email=admin@bpadntt.local \
  --name="Administrator BPAD" \
  --password="PasswordBaru"
```

Gunakan password yang kuat dan jangan menyimpannya di Git.

## Tinker dan Pemeriksaan Database

Membuka console Laravel:

```bash
php artisan tinker
```

Contoh melihat jumlah dokumen PPID melalui Tinker:

```php
App\Models\PpidDocument::count();
```

Contoh melihat pengaturan website:

```php
App\Models\WebsiteSetting::orderBy('key')->get(['key', 'value']);
```

Keluar dari Tinker:

```text
exit
```

## Cache Laravel

Membersihkan seluruh cache:

```bash
php artisan optimize:clear
```

Membuat cache untuk produksi:

```bash
php artisan optimize
```

Membersihkan cache view:

```bash
php artisan view:clear
```

Membersihkan cache route:

```bash
php artisan route:clear
```

Membersihkan cache konfigurasi:

```bash
php artisan config:clear
```

## Route dan Informasi Aplikasi

Melihat semua route:

```bash
php artisan route:list
```

Melihat route PPID:

```bash
php artisan route:list | grep ppid
```

Melihat informasi aplikasi:

```bash
php artisan about
```

## Storage dan Upload File

Membuat symbolic link storage publik:

```bash
php artisan storage:link
```

File upload publik akan tersedia melalui folder:

```text
public/storage
```

## Membuat Komponen Laravel

Membuat controller:

```bash
php artisan make:controller NamaController
```

Membuat model dan migration:

```bash
php artisan make:model NamaModel -m
```

Membuat form request:

```bash
php artisan make:request NamaRequest
```

Membuat seeder:

```bash
php artisan make:seeder NamaSeeder
```

Membuat migration:

```bash
php artisan make:migration create_nama_table
```

## Pengujian dan Pemeriksaan Sintaks

Menjalankan seluruh pengujian:

```bash
php artisan test
```

Memeriksa sintaks satu file PHP:

```bash
php -l app/Http/Controllers/PpidController.php
```

## Perintah Git Dasar

Melihat perubahan:

```bash
git status
```

Melihat detail perubahan:

```bash
git diff
```

Menambahkan perubahan ke staging:

```bash
git add .
```

Membuat commit:

```bash
git commit -m "Jelaskan perubahan"
```

