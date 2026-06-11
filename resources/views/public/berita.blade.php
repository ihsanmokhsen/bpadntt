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
  <title>Berita – BPAD NTT</title>
  <meta name="description" content="Arsip berita resmi, publikasi kegiatan, dan informasi terbaru dari Badan Pendapatan dan Aset Daerah Provinsi NTT.">
  <meta property="og:title" content="Berita – BPAD NTT">
  <meta property="og:description" content="Arsip kabar resmi, publikasi kegiatan, dan informasi terbaru dari BPAD Provinsi NTT.">
  <meta property="og:image" content="https://bpadntt.cloud/assets/logo.png">
  <meta property="og:url" content="https://bpadntt.cloud/berita">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260611-share1">
</head>
<body>
@include('public.partials.header', ['active' => 'berita'])

@include('public.partials.pad-today')

<section class="ppid-hero page-hero page-hero-berita" aria-labelledby="beritaHeroTitle">
  <div class="ppid-hero-bg" aria-hidden="true"></div>
  <div class="ppid-hero-inner">
    <div class="ppid-hero-copy">
      <div class="ppid-kicker"><i class="ti ti-news"></i> Portal Berita BPAD</div>
      <h1 id="beritaHeroTitle">Berita dan Informasi BPAD NTT</h1>
      <p>Arsip kabar resmi, publikasi kegiatan, dan informasi terbaru dari Badan Pendapatan dan Aset Daerah Provinsi NTT.</p>
      <div class="ppid-hero-actions">
        <a href="#berita" class="ppid-primary-btn"><i class="ti ti-archive"></i> Lihat Arsip</a>
        <a href="/#portal-berita" class="ppid-secondary-btn"><i class="ti ti-layout-dashboard"></i> Portal Utama</a>
      </div>
    </div>
    <div class="ppid-hero-panel" aria-label="Ringkasan berita BPAD">
      <span class="ppid-panel-label">Arsip Publikasi</span>
      <strong>Informasi terbaru</strong>
      <p>Konten berita ditarik dari database saat tersedia dan tetap tersusun untuk pembacaan cepat.</p>
      <div class="ppid-panel-meta">
        <span><i class="ti ti-database"></i> Terhubung database</span>
        <span><i class="ti ti-calendar"></i> Urut publikasi</span>
      </div>
    </div>
  </div>
</section>

<!--
  ARSIP BERITA
  Kartu berita TIDAK ditulis langsung di sini.
  Elemen #beritaGrid akan diisi otomatis dari data/berita.json
  oleh file js/main.js.
-->
<section class="section-alt" id="berita">
  <div class="section-hdr">
    <div class="section-hdr-left">
      <div class="section-eyebrow"><i class="ti ti-archive"></i> Arsip Berita</div>
      <div class="section-title">Daftar Berita dan Informasi BPAD</div>
    </div>
    <a href="/#portal-berita" class="see-all">Kembali ke Portal Berita <i class="ti ti-arrow-up-right"></i></a>
  </div>
  <div class="berita-grid" id="beritaGrid"></div>
</section>

@include('public.partials.contact-bar')
@include('public.partials.footer')

<!--
  SCRIPT UTAMA
  File ini mengatur menu mobile, dropdown Aplikasi,
  dan membaca data JSON untuk konten halaman.
-->
<script src="/js/public-data.js?v=20260611-share1"></script>
<script src="/js/main.js?v=20260611-share1"></script>

</body>
</html>
