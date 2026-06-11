<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $post->title }} – BPAD NTT</title>
  <meta name="description" content="{{ Str::limit($post->summary ?: strip_tags($post->content), 160) }}">
  <meta property="og:title" content="{{ $post->title }}">
  <meta property="og:description" content="{{ Str::limit($post->summary ?: strip_tags($post->content), 200) }}">
  <meta property="og:image" content="{{ $post->cover_image_path ? (str_starts_with($post->cover_image_path, '/') || preg_match('/^https?:/i', $post->cover_image_path) ? $post->cover_image_path : \Illuminate\Support\Facades\Storage::disk('public')->url($post->cover_image_path)) : 'https://bpadntt.cloud/assets/logo.png' }}">
  <meta property="og:url" content="{{ url('/berita/' . $post->slug) }}">
  <meta property="og:type" content="article">
  <meta property="og:site_name" content="BPAD NTT">
  <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
  <meta property="article:section" content="{{ $post->category ?: ucfirst($post->type) }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $post->title }}">
  <meta name="twitter:description" content="{{ Str::limit($post->summary ?: strip_tags($post->content), 200) }}">
  <meta name="twitter:image" content="{{ $post->cover_image_path ? (str_starts_with($post->cover_image_path, '/') || preg_match('/^https?:/i', $post->cover_image_path) ? $post->cover_image_path : \Illuminate\Support\Facades\Storage::disk('public')->url($post->cover_image_path)) : 'https://bpadntt.cloud/assets/logo.png' }}">
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
  <style>
    .post-article { max-width: 820px; margin: 0 auto; padding: 3rem 1.5rem; }
    .post-article .post-eyebrow { font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; color: #c9a84c; margin-bottom: .5rem; }
    .post-article h1 { font-family: 'Playfair Display', serif; font-size: clamp(1.6rem, 4vw, 2.4rem); font-weight: 700; line-height: 1.25; margin: 0 0 1rem; color: #0a1628; }
    .post-article .post-meta { color: #64748b; font-size: .9rem; margin-bottom: 1.5rem; }
    .post-article .post-cover { width: 100%; border-radius: 12px; margin-bottom: 2rem; object-fit: cover; max-height: 440px; }
    .post-article .post-summary { font-size: 1.15rem; color: #334155; line-height: 1.7; margin-bottom: 1.5rem; font-weight: 400; }
    .post-article .post-content { font-size: 1rem; line-height: 1.85; color: #1e293b; }
    .post-article .post-content p { margin-bottom: 1.2rem; }

    .share-bar { display: flex; flex-wrap: wrap; gap: .6rem; align-items: center; margin: 2.5rem 0 1rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; }
    .share-bar span { font-weight: 600; font-size: .9rem; color: #475569; margin-right: .5rem; }
    .share-btn { display: inline-flex; align-items: center; gap: .4rem; padding: .55rem 1rem; border-radius: 8px; font-size: .85rem; font-weight: 600; color: #fff; text-decoration: none; transition: opacity .2s; border: none; cursor: pointer; }
    .share-btn:hover { opacity: .85; }
    .share-btn i { font-size: 1.15rem; }
    .share-wa { background: #25D366; }
    .share-fb { background: #1877F2; }
    .share-tw { background: #000; }
    .share-tg { background: #0088cc; }
    .share-copy { background: #64748b; }
    .share-copy.copied { background: #16a34a; }

    .post-back { display: inline-flex; align-items: center; gap: .3rem; font-size: .9rem; color: #c9a84c; text-decoration: none; font-weight: 600; margin-bottom: 1.5rem; }
    .post-back:hover { color: #a88a30; }
  </style>
</head>
<body>
@include('public.partials.header', ['active' => 'berita'])

@include('public.partials.pad-today')

@php
  $coverUrl = $post->cover_image_path
    ? (str_starts_with($post->cover_image_path, '/') || preg_match('/^https?:/i', $post->cover_image_path)
      ? $post->cover_image_path
      : \Illuminate\Support\Facades\Storage::disk('public')->url($post->cover_image_path))
    : null;
  $shareUrl = url('/berita/' . $post->slug);
  $shareText = $post->title . ' – BPAD NTT';
@endphp

<section class="post-article">
  <a href="{{ route('berita') }}" class="post-back"><i class="ti ti-arrow-left"></i> Kembali ke Berita</a>

  <div class="post-eyebrow">{{ $post->category ?: ucfirst($post->type) }}</div>
  <h1>{{ $post->title }}</h1>
  <p class="post-meta">
    <i class="ti ti-calendar"></i>
    {{ optional($post->published_at)->translatedFormat('d F Y') }}
    · {{ optional($post->published_at)->format('H:i') }} WITA
  </p>

  @if ($coverUrl)
    <img src="{{ $coverUrl }}" alt="{{ $post->title }}" class="post-cover">
  @endif

  @if ($post->summary)
    <p class="post-summary">{{ $post->summary }}</p>
  @endif

  <div class="post-content">
    {!! nl2br(e($post->content)) !!}
  </div>

  <div class="share-bar">
    <span><i class="ti ti-share-2"></i> Bagikan:</span>

    <a class="share-btn share-wa" href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp">
      <i class="ti ti-brand-whatsapp"></i> WhatsApp
    </a>

    <a class="share-btn share-fb" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook">
      <i class="ti ti-brand-facebook"></i> Facebook
    </a>

    <a class="share-btn share-tw" href="https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Bagikan ke X/Twitter">
      <i class="ti ti-brand-x"></i> X / Twitter
    </a>

    <a class="share-btn share-tg" href="https://t.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" target="_blank" rel="noopener" aria-label="Bagikan ke Telegram">
      <i class="ti ti-brand-telegram"></i> Telegram
    </a>

    <button class="share-btn share-copy" id="copyLinkBtn" data-url="{{ $shareUrl }}" aria-label="Salin tautan">
      <i class="ti ti-link"></i> Salin Link
    </button>
  </div>
</section>

@include('public.partials.contact-bar')
@include('public.partials.footer')

<script src="/js/public-data.js?v=20260603-dbsource1"></script>
<script src="/js/main.js?v=20260603-dbsource1"></script>
<script>
document.getElementById('copyLinkBtn').addEventListener('click', function() {
  const url = this.dataset.url;
  navigator.clipboard.writeText(url).then(() => {
    this.classList.add('copied');
    this.innerHTML = '<i class="ti ti-check"></i> Tersalin!';
    setTimeout(() => {
      this.classList.remove('copied');
      this.innerHTML = '<i class="ti ti-link"></i> Salin Link';
    }, 2000);
  });
});
</script>
</body>
</html>
