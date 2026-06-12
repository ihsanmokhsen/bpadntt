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
        $isVideo = $gallery->media_type === 'video';
        $dateStr = $gallery->created_at ? $gallery->created_at->translatedFormat('j M Y') : '';
        $typeLabel = $isVideo ? 'Reels' : 'Foto';
      @endphp
      <div class="gallery-card{{ $isVideo ? ' is-video' : '' }}"
           role="button" tabindex="0"
           data-img="{{ $imgUrl }}"
           data-title="{{ $gallery->title }}"
           data-caption="{{ $gallery->caption }}"
           data-date="{{ $dateStr }}"
           data-type="{{ $typeLabel }}"
           data-instagram="{{ $gallery->instagram_url }}">
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
      </div>
    @empty
      <div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;color:#94a3b8;">
        <i class="ti ti-photo-off" style="font-size:3rem;display:block;margin-bottom:1rem;"></i>
        <p>Belum ada galeri yang tersedia saat ini.</p>
      </div>
    @endforelse
  </div>
</section>

<!--
  LIGHTBOX
  Popup foto fullscreen dengan navigasi prev/next.
-->
<div class="lightbox" id="lightbox" aria-hidden="true">
  <div class="lightbox-overlay" id="lightboxOverlay"></div>
  <button class="lightbox-close" id="lightboxClose" type="button" aria-label="Tutup">
    <i class="ti ti-x"></i>
  </button>
  <button class="lightbox-nav lightbox-prev" id="lightboxPrev" type="button" aria-label="Sebelumnya">
    <i class="ti ti-chevron-left"></i>
  </button>
  <button class="lightbox-nav lightbox-next" id="lightboxNext" type="button" aria-label="Berikutnya">
    <i class="ti ti-chevron-right"></i>
  </button>
  <div class="lightbox-content">
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <div class="lightbox-info" id="lightboxInfo">
      <div class="lightbox-meta">
        <span class="lightbox-date" id="lightboxDate"></span>
        <span class="lightbox-type" id="lightboxType"></span>
      </div>
      <h3 class="lightbox-title" id="lightboxTitle"></h3>
      <p class="lightbox-caption" id="lightboxCaption"></p>
      <a class="lightbox-ig" id="lightboxIg" href="#" target="_blank" rel="noopener" style="display:none">
        <i class="ti ti-brand-instagram"></i> Lihat di Instagram
      </a>
    </div>
  </div>
</div>

@include('public.partials.contact-bar')
@include('public.partials.footer')

<!--
  SCRIPT UTAMA
  File ini mengatur menu mobile, dropdown Aplikasi,
  dan membaca data JSON untuk konten halaman.
-->
<script src="/js/public-data.js?v=20260603-dbsource1"></script>
<script src="/js/main.js?v=20260603-dbsource1"></script>

<script>
(function () {
  var cards = Array.from(document.querySelectorAll('.gallery-card'));
  if (!cards.length) return;

  var lb      = document.getElementById('lightbox');
  var lbImg   = document.getElementById('lightboxImg');
  var lbTitle = document.getElementById('lightboxTitle');
  var lbCap   = document.getElementById('lightboxCaption');
  var lbDate  = document.getElementById('lightboxDate');
  var lbType  = document.getElementById('lightboxType');
  var lbIg    = document.getElementById('lightboxIg');
  var current = 0;

  function open(idx) {
    var c = cards[idx];
    if (!c) return;
    current = idx;
    lbImg.src = c.dataset.img;
    lbImg.alt = c.dataset.title || '';
    lbTitle.textContent = c.dataset.title || '';
    lbCap.textContent = c.dataset.caption || '';
    lbDate.textContent = c.dataset.date || '';
    lbType.textContent = c.dataset.type || '';
    if (c.dataset.instagram) {
      lbIg.href = c.dataset.instagram;
      lbIg.style.display = '';
    } else {
      lbIg.style.display = 'none';
    }
    lb.classList.add('is-open');
    lb.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function close() {
    lb.classList.remove('is-open');
    lb.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  function nav(dir) {
    var next = (current + dir + cards.length) % cards.length;
    open(next);
  }

  cards.forEach(function (card, i) {
    card.addEventListener('click', function () { open(i); });
    card.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(i); }
    });
  });

  document.getElementById('lightboxClose').addEventListener('click', close);
  document.getElementById('lightboxOverlay').addEventListener('click', close);
  document.getElementById('lightboxPrev').addEventListener('click', function () { nav(-1); });
  document.getElementById('lightboxNext').addEventListener('click', function () { nav(1); });

  document.addEventListener('keydown', function (e) {
    if (!lb.classList.contains('is-open')) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowLeft') nav(-1);
    if (e.key === 'ArrowRight') nav(1);
  });
})();
</script>

</body>
</html>
