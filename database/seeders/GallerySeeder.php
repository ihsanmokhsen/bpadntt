<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Dokumentasi Kegiatan BPAD NTT',
                'caption' => 'Dokumentasi kegiatan resmi BPAD Provinsi Nusa Tenggara Timur.',
                'image_path' => '/assets/instagram-01.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYeKbN9ExgZ/',
                'media_type' => 'photo',
                'sort_order' => 1,
                'created_at' => '2026-05-18 10:00:00',
            ],
            [
                'title' => 'Rakor Samsat NTT 2026: Kolaborasi dan Inovasi',
                'caption' => 'Rapat koordinasi Samsat NTT 2026 untuk kolaborasi dan inovasi pelayanan pajak daerah.',
                'image_path' => '/assets/instagram-02.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYgqbQzEzoj/',
                'media_type' => 'photo',
                'sort_order' => 2,
                'created_at' => '2026-05-19 10:00:00',
            ],
            [
                'title' => 'Rapat dan Arahan Internal BPAD NTT',
                'caption' => 'Rapat internal dan arahan untuk peningkatan kinerja BPAD NTT.',
                'image_path' => '/assets/instagram-03.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYezpNHE8ca/',
                'media_type' => 'photo',
                'sort_order' => 3,
                'created_at' => '2026-05-18 10:00:00',
            ],
            [
                'title' => 'Agenda Kegiatan BPAD NTT',
                'caption' => 'Agenda kegiatan resmi BPAD Provinsi NTT.',
                'image_path' => '/assets/instagram-04.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYeFeXbE3BV/',
                'media_type' => 'photo',
                'sort_order' => 4,
                'created_at' => '2026-05-18 10:00:00',
            ],
            [
                'title' => 'Publikasi Resmi BPAD NTT',
                'caption' => 'Publikasi resmi dari Badan Pendapatan dan Aset Daerah Provinsi NTT.',
                'image_path' => '/assets/instagram-05.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYd94qPz0Dc/',
                'media_type' => 'photo',
                'sort_order' => 5,
                'created_at' => '2026-05-18 10:00:00',
            ],
            [
                'title' => 'Keluarga Besar BPAD NTT Berduka Cita',
                'caption' => 'Ucapan duka cita dari keluarga besar BPAD Provinsi NTT.',
                'image_path' => '/assets/instagram-06.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYdiFe2kwZr/',
                'media_type' => 'photo',
                'sort_order' => 6,
                'created_at' => '2026-05-18 10:00:00',
            ],
            [
                'title' => 'Samsat Keliling UPTD Kabupaten Kupang',
                'caption' => 'Layanan Samsat Keliling UPTD Kabupaten Kupang untuk mendekatkan pelayanan pajak.',
                'image_path' => '/assets/instagram-07.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYZVHfMExaT/',
                'media_type' => 'photo',
                'sort_order' => 7,
                'created_at' => '2026-05-16 10:00:00',
            ],
            [
                'title' => 'Rapat Tindak Lanjut Optimalisasi PAD',
                'caption' => 'Rapat tindak lanjut untuk optimalisasi Pendapatan Asli Daerah Provinsi NTT.',
                'image_path' => '/assets/instagram-08.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYZUyMrE4_s/',
                'media_type' => 'photo',
                'sort_order' => 8,
                'created_at' => '2026-05-16 10:00:00',
            ],
            [
                'title' => 'Selamat Memperingati Hari Kenaikan Yesus Kristus',
                'caption' => 'Selamat memperingati Hari Kenaikan Yesus Kristus bagi seluruh umat Kristiani.',
                'image_path' => '/assets/instagram-09.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYTbl8DzfHL/',
                'media_type' => 'photo',
                'sort_order' => 9,
                'created_at' => '2026-05-14 10:00:00',
            ],
            [
                'title' => 'Informasi Pergub NTT Nomor 13 Tahun 2025',
                'caption' => 'Sosialisasi Peraturan Gubernur NTT Nomor 13 Tahun 2025 tentang optimalisasi pajak daerah.',
                'image_path' => '/assets/instagram-10.jpg',
                'instagram_url' => 'https://www.instagram.com/p/DYN_vmVE8Yz/',
                'media_type' => 'photo',
                'sort_order' => 10,
                'created_at' => '2026-05-12 10:00:00',
            ],
            [
                'title' => 'Pembayaran Pajak Kendaraan Lewat SIGNAL',
                'caption' => 'Informasi cara pembayaran pajak kendaraan bermotor melalui aplikasi SIGNAL.',
                'image_path' => '/assets/instagram-11.jpg',
                'instagram_url' => 'https://www.instagram.com/reel/DYHe563C4UJ/',
                'media_type' => 'video',
                'sort_order' => 11,
                'created_at' => '2026-05-09 10:00:00',
            ],
            [
                'title' => 'Identifikasi dan Penilaian Aset Dinas Kominfo NTT',
                'caption' => 'Kegiatan identifikasi dan penilaian aset di Dinas Kominfo Provinsi NTT.',
                'image_path' => '/assets/instagram-12.jpg',
                'instagram_url' => 'https://www.instagram.com/reel/DYCReRcz-Ej/',
                'media_type' => 'video',
                'sort_order' => 12,
                'created_at' => '2026-05-07 10:00:00',
            ],
        ];

        foreach ($items as $item) {
            Gallery::updateOrCreate(
                ['image_path' => $item['image_path']],
                array_merge($item, ['is_published' => true])
            );
        }
    }
}
