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
  <title>Layanan – BPAD NTT</title>
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
</head>
<body>
@include('public.partials.header', ['active' => 'layanan'])

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

<section class="ppid-hero page-hero page-hero-layanan" aria-labelledby="layananHeroTitle">
  <div class="ppid-hero-bg" aria-hidden="true"></div>
  <div class="ppid-hero-inner">
    <div class="ppid-hero-copy">
      <div class="ppid-kicker"><i class="ti ti-grid-dots"></i> Layanan BPAD NTT</div>
      <h1 id="layananHeroTitle">Layanan Pendapatan dan Aset Daerah</h1>
      <p>Akses informasi layanan pajak daerah, pengelolaan aset, konsultasi, dan kanal pelayanan digital BPAD NTT.</p>
      <div class="ppid-hero-actions">
        <a href="#layanan" class="ppid-primary-btn"><i class="ti ti-list-check"></i> Lihat Layanan</a>
        <a href="#kontak" class="ppid-secondary-btn"><i class="ti ti-headset"></i> Kontak Pelayanan</a>
      </div>
    </div>
    <div class="ppid-hero-panel" aria-label="Ringkasan layanan BPAD">
      <span class="ppid-panel-label">Kanal Layanan</span>
      <strong>Pelayanan publik terarah</strong>
      <p>Daftar layanan disusun untuk membantu masyarakat menemukan kebutuhan administrasi pendapatan dan aset daerah.</p>
      <div class="ppid-panel-meta">
        <span><i class="ti ti-car"></i> Pajak kendaraan</span>
        <span><i class="ti ti-building"></i> Pengelolaan aset</span>
      </div>
    </div>
  </div>
</section>

<!--
  LAYANAN
  Daftar layanan utama BPAD. Saat ini masih statis di HTML.
-->
<section class="section" id="layanan">
  <div class="section-hdr">
    <div class="section-hdr-left">
      <div class="section-eyebrow"><i class="ti ti-grid-dots"></i> Layanan Kami</div>
      <div class="section-title">Layanan Unggulan BPAD</div>
    </div>
    <a href="#" class="see-all">Lihat Semua Layanan <i class="ti ti-arrow-right"></i></a>
  </div>
  <div class="layanan-grid">
    <div class="layanan-card">
      <div class="layanan-icon ic-blue"><i class="ti ti-car"></i></div>
      <div class="layanan-name">Pajak Kendaraan Bermotor</div>
      <div class="layanan-desc">Pembayaran & perpanjangan STNK kendaraan bermotor roda dua dan empat</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-amber"><i class="ti ti-file-invoice"></i></div>
      <div class="layanan-name">BBNKB</div>
      <div class="layanan-desc">Bea Balik Nama Kendaraan Bermotor untuk perpindahan kepemilikan</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-teal"><i class="ti ti-droplet"></i></div>
      <div class="layanan-name">Pajak Air Permukaan</div>
      <div class="layanan-desc">Pengelolaan pajak atas pengambilan dan pemanfaatan air permukaan</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-red"><i class="ti ti-report"></i></div>
      <div class="layanan-name">Pajak Rokok</div>
      <div class="layanan-desc">Administrasi dan pengelolaan pajak rokok daerah sesuai peraturan</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-purple"><i class="ti ti-building"></i></div>
      <div class="layanan-name">Pengelolaan Aset Daerah</div>
      <div class="layanan-desc">Inventarisasi, pemanfaatan, dan penatausahaan aset milik daerah</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-green"><i class="ti ti-device-mobile"></i></div>
      <div class="layanan-name">e-Samsat Online</div>
      <div class="layanan-desc">Pembayaran pajak kendaraan bermotor secara online melalui aplikasi</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-navy"><i class="ti ti-certificate"></i></div>
      <div class="layanan-name">NPWPD</div>
      <div class="layanan-desc">Penerbitan Nomor Pokok Wajib Pajak Daerah bagi wajib pajak baru</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-pink"><i class="ti ti-receipt"></i></div>
      <div class="layanan-name">Retribusi Daerah</div>
      <div class="layanan-desc">Pengelolaan retribusi jasa umum dan jasa usaha milik pemerintah daerah</div>
    </div>
    <div class="layanan-card">
      <div class="layanan-icon ic-amber"><i class="ti ti-headset"></i></div>
      <div class="layanan-name">Konsultasi Pajak</div>
      <div class="layanan-desc">Layanan konsultasi dan informasi perpajakan daerah bagi masyarakat</div>
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
