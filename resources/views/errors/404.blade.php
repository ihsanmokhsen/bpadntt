<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 – Halaman Tidak Ditemukan | BPAD NTT</title>
  <meta name="description" content="Halaman yang Anda cari tidak ditemukan. Kembali ke beranda BPAD NTT.">
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Source Sans 3',sans-serif;background:#0a1628;color:#fff;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:2rem}
    .error-code{font-size:clamp(5rem,15vw,10rem);font-weight:700;background:linear-gradient(135deg,#d4af37,#f5d76e);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1}
    .error-icon{font-size:3rem;color:#d4af37;margin:1rem 0}
    .error-title{font-size:clamp(1.2rem,3vw,1.8rem);font-weight:600;margin-bottom:.5rem}
    .error-desc{font-size:1.1rem;color:#94a3b8;max-width:480px;margin:0 auto 2rem}
    .error-actions{display:flex;gap:1rem;flex-wrap:wrap;justify-content:center}
    .error-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.5rem;border-radius:8px;font-size:1rem;font-weight:600;text-decoration:none;transition:all .2s}
    .error-btn-primary{background:#d4af37;color:#0a1628}
    .error-btn-primary:hover{background:#f5d76e}
    .error-btn-secondary{border:1px solid #334155;color:#94a3b8}
    .error-btn-secondary:hover{border-color:#d4af37;color:#fff}
    .error-brand{margin-top:3rem;opacity:.5;font-size:.85rem}
    .error-brand img{width:32px;height:32px;vertical-align:middle;margin-right:.5rem;border-radius:50%}
  </style>
</head>
<body>
  <div class="error-code">404</div>
  <div class="error-icon"><i class="ti ti-map-search"></i></div>
  <h1 class="error-title">Halaman Tidak Ditemukan</h1>
  <p class="error-desc">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan. Silakan kembali ke beranda atau telusuri menu lainnya.</p>
  <div class="error-actions">
    <a href="/" class="error-btn error-btn-primary"><i class="ti ti-home"></i> Kembali ke Beranda</a>
    <a href="/layanan" class="error-btn error-btn-secondary"><i class="ti ti-list-check"></i> Layanan</a>
    <a href="/berita" class="error-btn error-btn-secondary"><i class="ti ti-news"></i> Berita</a>
  </div>
  <div class="error-brand">
    <img src="/assets/logo.png" alt="Logo BPAD NTT" loading="lazy">
    BPAD NTT &copy; {{ date('Y') }}
  </div>
</body>
</html>
