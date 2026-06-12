# Catatan Update — 12 Juni 2026

## 1. Hero (Beranda)
- Menghapus logo "Ayo Bangun NTT" dari bagian hero halaman depan.

## 2. Galeri Admin — Urutan Otomatis
- Menghapus field **Urutan Tampil** (sort_order) dari form dan tabel admin galeri.
- Galeri kini otomatis diurutkan berdasarkan tanggal pembuatan (dari lama ke baru).
- Kolom "Urutan" di tabel diganti menjadi "Tanggal" (format `dd/mm/yyyy`).

## 3. Layanan BPAD NTT — Penambahan Detail
- Setiap kartu layanan kini memiliki 3 bullet point rincian sub-layanan.
- Contoh: Pajak Kendaraan Bermotor → pelayanan Samsat, perpanjangan STNK, pengecekan online.

## 4. Bar "PAD Hari Ini" — Terpisah dari Hero
- Bar info PAD kini berdiri sendiri, tidak lagi tergabung/overlap dengan hero.
- Diberi background gelap (`linear-gradient`) agar terlihat jelas sebagai section terpisah.
- CSS hero disesuaikan (margin-top dan padding-top).

## 5. PAD Hari Ini — Format Mata Uang Otomatis
- Field **Realisasi PAD**, **Target PAD**, dan **Persentase** diubah dari teks bebas menjadi **input angka**.
- Admin cukup mengetik angka mentah (contoh: `150000000000`), format Rupiah muncul otomatis sebagai preview.
- Preview format: `Rp 150,00 M`, `Rp 2,80 T`, `5,36%`.
- Di halaman publik, nilai ditampilkan dengan format Indonesia yang konsisten (M = Miliar, T = Triliun, Jt = Juta).
- Seeder diperbarui: default target = `2800000000000` (angka mentah, bukan "Rp 2,8T").

## 6. Profil — Bagan Struktur Organisasi
- Gambar bagan struktur organisasi BPAD NTT ditambahkan tepat di bawah heading "C. Struktur Organisasi".
- File: `/assets/struktur-organisasi.png`
- Ditampilkan dalam card putih dengan sudut membulat, responsif di mobile.

## 7. Profil — Grid Foto Pimpinan (Riwayat Pimpinan)
- Daftar teks "Kepala Dinas dari Tahun ke Tahun" diganti menjadi **grid kartu foto**.
- 15 pimpinan ditampilkan dengan foto, nama, jabatan, dan periode.
- 14 foto berhasil dipetakan dari folder `pimpinan bpad/`, 1 tanpa foto (Welly Katipana) menampilkan placeholder icon.
- Semua foto menggunakan proporsi **3:4** (`aspect-ratio`) dengan `object-fit: cover` agar seragam.
- Responsif: 5 kolom di desktop, 2 kolom di mobile.
- Foto disimpan di `/assets/pimpinan/`.

## 8. Profil — Sambutan Kepala BPAD
- Section baru "Sambutan Kepala BPAD Provinsi NTT" ditambahkan **sebelum** Profil Instansi / Visi & Misi.
- Menampilkan foto Kepala BPAD saat ini (Johny Ericson Ataupah, SP. MM) di sebelah kiri dan teks sambutan di kanan.
- Dilengkapi nama dan jabatan sebagai tanda tangan.
- Responsif: di mobile foto pindah ke atas dan mengecil.

## 9. Galeri Publik — Lightbox (Popup Foto)
- Klik foto di galeri kini membuka **popup fullscreen** (lightbox) dengan foto ukuran besar.
- Fitur:
  - Navigasi **prev/next** dengan tombol panah atau keyboard (← →)
  - **Escape** untuk menutup, klik overlay atau tombol X
  - Menampilkan judul, tanggal, tipe (Foto/Reels), dan caption
  - Tombol **"Lihat di Instagram"** muncul jika ada link IG (gradient warna IG)
  - Jika tidak ada link IG, foto hanya bisa dilihat di popup tanpa redirect
- Responsif: ukuran tombol dan gambar menyesuaikan di mobile.

---

## File yang Diubah

### Backend (PHP)
| File | Perubahan |
|------|-----------|
| `app/Http/Controllers/Admin/GalleryController.php` | Hapus sort_order, orderBy created_at |
| `app/Http/Controllers/Admin/WebsiteSettingController.php` | Field PAD → number, format preview, fix slice |
| `app/Http/Controllers/GalleryPublicController.php` | orderBy created_at |
| `app/Http/Requests/Admin/GalleryRequest.php` | Hapus validasi sort_order |
| `app/Http/Requests/Admin/WebsiteSettingRequest.php` | Validasi numerik PAD |
| `database/seeders/WebsiteSettingSeeder.php` | Default PAD angka mentah |

### Frontend (Blade)
| File | Perubahan |
|------|-----------|
| `resources/views/public/index.blade.php` | Hapus logo Ayo Bangun NTT |
| `resources/views/public/layanan.blade.php` | Tambah detail bullet point |
| `resources/views/public/partials/pad-today.blade.php` | Format Rupiah otomatis |
| `resources/views/public/profil.blade.php` | Sambutan, org chart, pimpinan grid |
| `resources/views/public/galeri.blade.php` | Lightbox popup |
| `resources/views/admin/galleries/_form.blade.php` | Hapus field Urutan Tampil |
| `resources/views/admin/galleries/index.blade.php` | Kolom Tanggal ganti Urutan |
| `resources/views/admin/settings/edit.blade.php` | Input angka + preview JS |

### Aset & Style
| File | Perubahan |
|------|-----------|
| `public/css/style.css` | Lightbox, sambutan, pimpinan, struktur-bagan, PAD bar, layanan-detail |
| `public/css/app.css` | Style currency-preview admin |
| `public/assets/pimpinan/` | 14 foto pimpinan (baru) |
| `public/assets/struktur-organisasi.png` | Bagan struktur organisasi (baru) |
