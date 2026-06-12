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
  <title>BPAD – Badan Pendapatan dan Aset Daerah Provinsi NTT</title>
  <meta name="description" content="Website resmi Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur. Informasi layanan pajak daerah, pengelolaan aset, PPID, dan berita terkini BPAD NTT.">
  <meta property="og:title" content="BPAD – Badan Pendapatan dan Aset Daerah Provinsi NTT">
  <meta property="og:description" content="Optimalisasi Pendapatan Daerah & Pengelolaan Aset. Memberikan pelayanan prima dalam pengelolaan pendapatan daerah dan aset untuk NTT yang berkeadilan.">
  <meta property="og:image" content="https://bpadntt.cloud/assets/logo.png">
  <meta property="og:url" content="https://bpadntt.cloud/">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260611-thumb1">
  <link rel="stylesheet" href="/css/news-widget.css?v=20260525-modal1">
</head>
<body class="home-page">
@include('public.partials.header', ['active' => 'home'])

@include('public.partials.pad-today')

<!--
  HERO
  Bagian pembuka website. Background gambar diatur dari CSS:
  css/style.css pada class .hero.
-->
@php
  $heroTitle = ($settings ?? collect())->get('hero.title', 'Optimalisasi Pendapatan Daerah & Pengelolaan Aset');
  $heroDescription = ($settings ?? collect())->get('hero.description', '“Pendapatan Terjaga, Aset Tertata” menjadi komitmen utama BPAD Provinsi Nusa Tenggara Timur dalam mewujudkan tata kelola keuangan daerah yang transparan, akuntabel, dan berkelanjutan.');
  $heroSlides = [
    ($settings ?? collect())->get('hero.slide.2', '/assets/herox.jpeg'),
    ($settings ?? collect())->get('hero.slide.4', '/assets/heroy.jpeg'),
  ];
@endphp

<section class="hero">
  <div class="hero-slider" id="heroSlider">
    @foreach ($heroSlides as $index => $slide)
      <div class="hero-slide @if ($index === 0) is-active @endif" style="background-image:url('{{ $slide }}');"></div>
    @endforeach
  </div>
  <div class="hero-overlay"></div>
  <div class="hero-deco1"></div>
  <div class="hero-deco2"></div>
  <div class="hero-deco3"></div>
  <div class="hero-inner">
    <h2>{{ $heroTitle }}</h2>
    <p>{{ $heroDescription }}</p>
    <div class="hero-btns">
      <a href="{{ route('layanan') }}" class="btn-gold"><i class="ti ti-list-check"></i> Lihat Layanan</a>
      <a href="{{ route('profil') }}" class="btn-ghost"><i class="ti ti-info-circle"></i> Tentang Kami</a>
    </div>
  </div>
  <button class="hero-nav hero-prev" id="heroPrev" type="button" aria-label="Slide sebelumnya">
    <i class="ti ti-chevron-left"></i>
  </button>
  <button class="hero-nav hero-next" id="heroNext" type="button" aria-label="Slide berikutnya">
    <i class="ti ti-chevron-right"></i>
  </button>
  <div class="hero-dots" id="heroDots" aria-label="Pilih slide hero"></div>
</section>

<!--
  PORTAL BERITA MODERN
  Komponen modular setelah hero. Isi widget dibuat oleh
  js/news-widget.js dari data contoh yang nantinya bisa diganti API.
-->
<section class="nw-news-widget" id="portal-berita" aria-label="Portal Berita BPAD NTT">
  <div class="nw-news-shell" id="newsWidgetRoot">
    <div class="nw-skeleton nw-skeleton-hero"></div>
    <div class="nw-skeleton-row">
      <div class="nw-skeleton"></div>
      <div class="nw-skeleton"></div>
      <div class="nw-skeleton"></div>
    </div>
  </div>
</section>

<!--
  STATS STRIP
  Ringkasan angka penting yang tampil tepat setelah hero.
-->
<div class="stats-strip">
  <div class="stat-item">
    <div class="stat-num">Rp 2,8T</div>
    <div class="stat-label">Target PAD 2026</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">12+</div>
    <div class="stat-label">Jenis Pajak Daerah</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">22</div>
    <div class="stat-label">Kab/Kota Wilayah</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">80%</div>
    <div class="stat-label">Kepuasan Wajib Pajak</div>
    <div class="stat-note">Berdasarkan Laporan SKM 2025</div>
  </div>
</div>

<!--
  QUICK LINKS
  Shortcut ke bagian-bagian yang paling sering dibuka pengunjung.
-->
<section class="quick-links">
  <div class="quick-links-inner">
    <a class="quick-link" href="/layanan"><i class="ti ti-receipt-tax"></i> Layanan</a>
    <a class="quick-link" href="/ppid"><i class="ti ti-file-search"></i> PPID</a>
    <a class="quick-link" href="/profil"><i class="ti ti-map-2"></i> UPTD</a>
    <a class="quick-link" href="/berita"><i class="ti ti-news"></i> Berita</a>
    <a class="quick-link" href="/pengumuman"><i class="ti ti-bell"></i> Pengumuman</a>
  </div>
</section>

<!--
  INFO / KONTAK
  Berisi alamat lengkap, kontak, sosial media, jam layanan,
  dan peta lokasi Google Maps.
-->
<div class="info-bar" id="kontak">
  <div class="info-block">
    <h3><i class="ti ti-map-pin"></i> Alamat Kantor</h3>
    <p>
      {{ ($settings ?? collect())->get('contact.address', 'Jl. El Tari No.52, Oebobo, Kota Kupang') }}<br>
      Nusa Tenggara Timur<br>
      85111 — Indonesia
    </p>
  </div>
  <div class="info-block">
    <h3><i class="ti ti-headset"></i> Hubungi Kami</h3>
    <p>
      <a href="mailto:{{ ($settings ?? collect())->get('contact.email', 'bapenda@nttprov.go.id') }}">{{ ($settings ?? collect())->get('contact.email', 'bapenda@nttprov.go.id') }}</a>
    </p>
    <div class="sosmed">
      <a href="{{ ($settings ?? collect())->get('social.facebook.url', 'https://www.facebook.com/bpadntt') }}" title="Facebook" target="_blank" rel="noopener"><i class="ti ti-brand-facebook"></i></a>
      <a href="{{ ($settings ?? collect())->get('social.instagram.url', 'https://www.instagram.com/bpad_ntt/') }}" title="Instagram" target="_blank" rel="noopener"><i class="ti ti-brand-instagram"></i></a>
      <a href="{{ ($settings ?? collect())->get('social.youtube.url', '#') }}" title="YouTube" target="_blank" rel="noopener"><i class="ti ti-brand-youtube"></i></a>
      <a href="{{ ($settings ?? collect())->get('social.x.url', '#') }}" title="Twitter/X" target="_blank" rel="noopener"><i class="ti ti-brand-x"></i></a>
    </div>
  </div>
  <div class="info-block">
    <h3><i class="ti ti-clock"></i> Jam Pelayanan</h3>
    <p>
      Senin – Kamis:<br>{{ ($settings ?? collect())->get('contact.hours.weekday', '07.30 - 15.30 WITA') }}<br><br>
      Jumat:<br>{{ ($settings ?? collect())->get('contact.hours.friday', '07.30 - 11.30 WITA') }}
    </p>
  </div>
  <div class="map-block">
    <iframe
      title="Peta Lokasi BPAD NTT"
      src="https://www.google.com/maps?q=Jl.%20El%20Tari%20No.52%2C%20Oebobo%2C%20Kec.%20Oebobo%2C%20Kota%20Kupang%2C%20Nusa%20Tenggara%20Timur%2085111&output=embed"
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
    <a class="map-link" href="https://www.google.com/maps/search/?api=1&query=Jl.%20El%20Tari%20No.52%2C%20Oebobo%2C%20Kec.%20Oebobo%2C%20Kota%20Kupang%2C%20Nusa%20Tenggara%20Timur%2085111" target="_blank" rel="noopener">
      <i class="ti ti-map-2"></i> Buka di Google Maps
    </a>
  </div>
</div>

@include('public.partials.footer')

<!--
  SCRIPT UTAMA
  File ini mengatur menu mobile, dropdown Aplikasi,
  dan membaca data JSON untuk PPID, Berita, dan Pengumuman.
-->
<script src="/js/public-data.js?v=20260611-share1"></script>
<script src="/js/main.js?v=20260611-thumb1"></script>
<script src="/js/news-widget.js?v=20260611-share1"></script>

</body>
</html>
