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
  <title>Pengumuman – BPAD NTT</title>
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
</head>
<body>
@include('public.partials.header', ['active' => 'pengumuman'])

@include('public.partials.pad-today')

<section class="ppid-hero page-hero page-hero-pengumuman" aria-labelledby="pengumumanHeroTitle">
  <div class="ppid-hero-bg" aria-hidden="true"></div>
  <div class="ppid-hero-inner">
    <div class="ppid-hero-copy">
      <div class="ppid-kicker"><i class="ti ti-speakerphone"></i> Pengumuman BPAD</div>
      <h1 id="pengumumanHeroTitle">Pengumuman Resmi dan Agenda Kegiatan</h1>
      <p>Informasi resmi, agenda layanan, dan kegiatan terbaru BPAD NTT yang diperbarui dari database publik.</p>
      <div class="ppid-hero-actions">
        <a href="#pengumuman" class="ppid-primary-btn"><i class="ti ti-bell"></i> Lihat Pengumuman</a>
        <a href="#agendaList" class="ppid-secondary-btn"><i class="ti ti-calendar-event"></i> Agenda Kegiatan</a>
      </div>
    </div>
    <div class="ppid-hero-panel" aria-label="Ringkasan pengumuman BPAD">
      <span class="ppid-panel-label">Informasi Publik</span>
      <strong>Terbaru ke terlama</strong>
      <p>Pengumuman dan agenda sudah diurutkan berdasarkan tanggal terbaru agar mudah dipresentasikan dan dipantau.</p>
      <div class="ppid-panel-meta">
        <span><i class="ti ti-sort-descending"></i> Urutan terbaru</span>
        <span><i class="ti ti-database"></i> Sumber database</span>
      </div>
    </div>
  </div>
</section>

<!--
  HALAMAN PENGUMUMAN
  Daftar pengumuman dan agenda tidak ditulis langsung di sini.
  Elemen #pengumumanList dan #agendaList akan diisi otomatis
  dari data/pengumuman.json dan data/agenda.json oleh js/main.js.
-->
<section class="section-alt" id="pengumuman">
  <div class="section-hdr">
    <div class="section-hdr-left">
      <div class="section-eyebrow"><i class="ti ti-bell"></i> Informasi Publik</div>
      <div class="section-title">Daftar Pengumuman dan Agenda BPAD</div>
    </div>
  </div>
  <div class="pgm-grid">
    <div class="pgm-card">
      <h3 class="pgm-card-title"><i class="ti ti-speakerphone"></i> Pengumuman Resmi</h3>
      <ul class="pgm-list" id="pengumumanList"></ul>
    </div>
    <div class="pgm-card">
      <h3 class="pgm-card-title"><i class="ti ti-calendar-event"></i> Agenda Kegiatan</h3>
      <ul class="pgm-list" id="agendaList"></ul>
    </div>
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
