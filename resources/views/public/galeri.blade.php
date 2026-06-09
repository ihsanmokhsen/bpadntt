<!DOCTYPE html>
<html lang="id">
<head>
  <!--
    BAGIAN HEAD
    Berisi metadata dasar halaman, judul tab browser, favicon,
    font Google, icon Tabler, dan file CSS utama.
  -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galeri – BPAD NTT</title>
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
</head>
<body>
@include('public.partials.header', ['active' => 'galeri'])

<!--
  DATA PAD HARI INI
  Komponen ringkas sebelum hero. Nilai realisasi masih placeholder
  agar aman sampai tersedia sumber data resmi/API/database.
-->
<section class="pad-today" aria-label="Data Pendapatan Asli Daerah hari ini">
  <div class="pad-today-inner">
    <div class="pad-today-head">
      <span class="pad-live-dot"></span>
      <strong>PAD Hari Ini</strong>
    </div>
    <div class="pad-today-line">
      <span>Realisasi: <strong>Rp --</strong></span>
      <span>Target 2026: <strong>Rp 2,8T</strong></span>
      <span>Realisasi: <strong>--%</strong></span>
      <span id="padUpdateDate">Update hari ini</span>
      <span class="pad-status">Menunggu data resmi</span>
    </div>
  </div>
</section>

<section class="ppid-hero page-hero page-hero-galeri" aria-labelledby="galeriHeroTitle">
  <div class="ppid-hero-bg" aria-hidden="true"></div>
  <div class="ppid-hero-inner">
    <div class="ppid-hero-copy">
      <div class="ppid-kicker"><i class="ti ti-photo"></i> Galeri BPAD NTT</div>
      <h1 id="galeriHeroTitle">Dokumentasi Kegiatan BPAD NTT</h1>
      <p>Ruang visual untuk melihat dokumentasi kegiatan, agenda lapangan, dan publikasi resmi BPAD NTT.</p>
      <div class="ppid-hero-actions">
        <a href="#galeri" class="ppid-primary-btn"><i class="ti ti-photo-search"></i> Lihat Galeri</a>
        <a href="https://www.instagram.com/bpad_ntt/" target="_blank" rel="noopener" class="ppid-secondary-btn"><i class="ti ti-brand-instagram"></i> Instagram</a>
      </div>
    </div>
    <div class="ppid-hero-panel" aria-label="Ringkasan galeri BPAD">
      <span class="ppid-panel-label">Dokumentasi</span>
      <strong>Visual kegiatan resmi</strong>
      <p>Galeri membantu memperlihatkan aktivitas institusi secara lebih hidup saat presentasi maupun publikasi.</p>
      <div class="ppid-panel-meta">
        <span><i class="ti ti-camera"></i> Foto kegiatan</span>
        <span><i class="ti ti-brand-instagram"></i> Tautan Instagram</span>
      </div>
    </div>
  </div>
</section>

<!--
  GALERI KEGIATAN
  Menampilkan dokumentasi kegiatan BPAD NTT yang terhubung
  dengan akun Instagram resmi BPAD NTT.
-->
<section class="section-alt gallery-page" id="galeri">
  <div class="section-hdr">
    <div class="section-hdr-left">
      <div class="section-eyebrow"><i class="ti ti-photo"></i> Galeri Kegiatan</div>
      <div class="section-title">Dokumentasi Kegiatan BPAD NTT</div>
    </div>
    <a href="https://www.instagram.com/bpad_ntt/" target="_blank" rel="noopener" class="see-all">Lihat Instagram <i class="ti ti-arrow-up-right"></i></a>
  </div>

  <div class="gallery-grid">
    <a class="gallery-card" href="https://www.instagram.com/p/DYeKbN9ExgZ/" target="_blank" rel="noopener">
      <img src="/assets/instagram-01.jpg" alt="Dokumentasi kegiatan BPAD NTT" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 18 Mei 2026 · Foto</span>
        <strong>Dokumentasi Kegiatan BPAD NTT</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYgqbQzEzoj/" target="_blank" rel="noopener">
      <img src="/assets/instagram-02.jpg" alt="Rakor Samsat NTT 2026" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 19 Mei 2026 · Foto</span>
        <strong>Rakor Samsat NTT 2026: Kolaborasi dan Inovasi</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYezpNHE8ca/" target="_blank" rel="noopener">
      <img src="/assets/instagram-03.jpg" alt="Rapat internal BPAD NTT" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 18 Mei 2026 · Foto</span>
        <strong>Rapat dan Arahan Internal BPAD NTT</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYeFeXbE3BV/" target="_blank" rel="noopener">
      <img src="/assets/instagram-04.jpg" alt="Agenda kegiatan BPAD NTT" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 18 Mei 2026 · Foto</span>
        <strong>Agenda Kegiatan BPAD NTT</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYd94qPz0Dc/" target="_blank" rel="noopener">
      <img src="/assets/instagram-05.jpg" alt="Publikasi BPAD NTT" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 18 Mei 2026 · Foto</span>
        <strong>Publikasi Resmi BPAD NTT</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYdiFe2kwZr/" target="_blank" rel="noopener">
      <img src="/assets/instagram-06.jpg" alt="Ucapan duka cita BPAD NTT" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 18 Mei 2026 · Foto</span>
        <strong>Keluarga Besar BPAD NTT Berduka Cita</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYZVHfMExaT/" target="_blank" rel="noopener">
      <img src="/assets/instagram-07.jpg" alt="Samsat Keliling UPTD Kabupaten Kupang" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 16 Mei 2026 · Foto</span>
        <strong>Samsat Keliling UPTD Kabupaten Kupang</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYZUyMrE4_s/" target="_blank" rel="noopener">
      <img src="/assets/instagram-08.jpg" alt="Rapat tindak lanjut optimalisasi PAD" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 16 Mei 2026 · Foto</span>
        <strong>Rapat Tindak Lanjut Optimalisasi PAD</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYTbl8DzfHL/" target="_blank" rel="noopener">
      <img src="/assets/instagram-09.jpg" alt="Hari Kenaikan Yesus Kristus" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 14 Mei 2026 · Foto</span>
        <strong>Selamat Memperingati Hari Kenaikan Yesus Kristus</strong>
      </div>
    </a>
    <a class="gallery-card" href="https://www.instagram.com/p/DYN_vmVE8Yz/" target="_blank" rel="noopener">
      <img src="/assets/instagram-10.jpg" alt="Sosialisasi Pergub NTT Nomor 13 Tahun 2025" loading="lazy">
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 12 Mei 2026 · Foto</span>
        <strong>Informasi Pergub NTT Nomor 13 Tahun 2025</strong>
      </div>
    </a>
    <a class="gallery-card is-video" href="https://www.instagram.com/reel/DYHe563C4UJ/" target="_blank" rel="noopener">
      <img src="/assets/instagram-11.jpg" alt="Informasi pembayaran pajak kendaraan lewat SIGNAL" loading="lazy">
      <div class="gallery-play"><i class="ti ti-player-play-filled"></i></div>
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 9 Mei 2026 · Reels</span>
        <strong>Pembayaran Pajak Kendaraan Lewat SIGNAL</strong>
      </div>
    </a>
    <a class="gallery-card is-video" href="https://www.instagram.com/reel/DYCReRcz-Ej/" target="_blank" rel="noopener">
      <img src="/assets/instagram-12.jpg" alt="Identifikasi dan penilaian aset di Dinas Kominfo NTT" loading="lazy">
      <div class="gallery-play"><i class="ti ti-player-play-filled"></i></div>
      <div class="gallery-caption">
        <span><i class="ti ti-brand-instagram"></i> 7 Mei 2026 · Reels</span>
        <strong>Identifikasi dan Penilaian Aset Dinas Kominfo NTT</strong>
      </div>
    </a>
  </div>
</section>

@include('public.partials.contact-bar')
@include('public.partials.footer')

<!--
  SCRIPT UTAMA
  File ini mengatur menu mobile, dropdown Aplikasi,
  dan membaca data JSON untuk konten halaman.
-->
<script src="/js/public-data.js?v=20260603-dbsource1"></script>
<script src="/js/main.js?v=20260603-dbsource1"></script>

</body>
</html>
