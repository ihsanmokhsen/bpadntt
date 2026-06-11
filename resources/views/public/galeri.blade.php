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
  <meta name="description" content="Dokumentasi kegiatan, agenda lapangan, dan publikasi resmi BPAD NTT melalui foto dan video.">
  <meta property="og:title" content="Galeri – BPAD NTT">
  <meta property="og:description" content="Dokumentasi kegiatan BPAD NTT melalui foto dan video resmi.">
  <meta property="og:image" content="https://bpadntt.cloud/assets/logo.png">
  <meta property="og:url" content="https://bpadntt.cloud/galeri">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
</head>
<body>
@include('public.partials.header', ['active' => 'galeri'])

@include('public.partials.pad-today')

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
  Menampilkan dokumentasi kegiatan BPAD NTT dari database.
  Admin dapat menambahkan foto/video melalui dashboard Kelola Galeri.
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
    @forelse ($galleries as $gallery)
      @php
        $imgUrl = $gallery->image_path
          ? (str_starts_with($gallery->image_path, '/') || preg_match('/^https?:/i', $gallery->image_path)
            ? $gallery->image_path
            : \Illuminate\Support\Facades\Storage::disk('public')->url($gallery->image_path))
          : '/assets/logo.png';
        $linkUrl = $gallery->instagram_url ?: '#';
        $linkTarget = $gallery->instagram_url ? '_blank' : '_self';
        $isVideo = $gallery->media_type === 'video';
        $dateStr = $gallery->created_at ? $gallery->created_at->translatedFormat('j M Y') : '';
        $typeLabel = $isVideo ? 'Reels' : 'Foto';
      @endphp
      <a class="gallery-card{{ $isVideo ? ' is-video' : '' }}" href="{{ $linkUrl }}" target="{{ $linkTarget }}" rel="{{ $linkTarget === '_blank' ? 'noopener' : '' }}">
        <img src="{{ $imgUrl }}" alt="{{ $gallery->title }}" loading="lazy">
        @if ($isVideo)
          <div class="gallery-play"><i class="ti ti-player-play-filled"></i></div>
        @endif
        <div class="gallery-caption">
          <span>
            @if ($gallery->instagram_url)
              <i class="ti ti-brand-instagram"></i>
            @else
              <i class="ti ti-camera"></i>
            @endif
            {{ $dateStr }} · {{ $typeLabel }}
          </span>
          <strong>{{ $gallery->title }}</strong>
          @if ($gallery->caption)
            <p>{{ Str::limit($gallery->caption, 80) }}</p>
          @endif
        </div>
      </a>
    @empty
      <div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;color:#94a3b8;">
        <i class="ti ti-photo-off" style="font-size:3rem;display:block;margin-bottom:1rem;"></i>
        <p>Belum ada galeri yang tersedia saat ini.</p>
      </div>
    @endforelse
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
