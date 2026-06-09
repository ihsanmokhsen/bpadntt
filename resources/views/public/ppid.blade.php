<!DOCTYPE html>
<html lang="id">
<head>
@php
  $settingsValue = $settings ?? collect();
  $settingsMap = $settingsValue instanceof \Illuminate\Support\Collection ? $settingsValue : collect($settingsValue);
  $siteShortName = $settingsMap->get('site.short_name', 'BPAD NTT');
  $siteName = $settingsMap->get('site.name', 'Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur');
  $siteTagline = $settingsMap->get('site.tagline', 'Melayani dengan transparan dan akuntabel');
  $ppidRequestUrl = $settingsMap->get('form.ppid_request.url', 'https://forms.gle/sLJVuwdGrZnQTJ3N7');
  $ppidObjectionUrl = $settingsMap->get('form.ppid_objection.url', '');
  $docRows = $ppidDocuments ?? collect();
  $docRowsCollection = $docRows instanceof \Illuminate\Support\Collection ? $docRows : collect($docRows);
  $initialPpidDocuments = $docRowsCollection->map(function ($document) {
    $filePath = $document->file_path ?? null;
    $fileUrl = '';

    if ($filePath) {
      $fileUrl = str_starts_with($filePath, '/') || preg_match('/^https?:/i', $filePath)
        ? $filePath
        : \Illuminate\Support\Facades\Storage::disk('public')->url($filePath);
    }

    return [
      'id' => (string) $document->id,
      'title' => $document->title,
      'category' => $document->category,
      'year' => (string) $document->document_year,
      'format' => $document->file_format ?: 'PDF',
      'size' => $document->file_size ?: '-',
      'updatedAt' => optional($document->published_at ?? $document->updated_at)->format('Y-m-d'),
      'description' => $document->description ?: '',
      'source' => $document->source === 'local' ? 'Penyimpanan BPAD' : 'Tautan eksternal',
      'url' => $fileUrl ?: ($document->external_url ?: ($document->preview_url ?: '#dokumen-belum-tersedia')),
    ];
  })->values();
@endphp
  <!--
    BAGIAN HEAD
    Berisi metadata dasar halaman, judul tab browser, favicon,
    font Google, icon Tabler, dan file CSS utama.
  -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPID – {{ $siteShortName }}</title>
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
</head>
<body>
@include('public.partials.header', ['active' => 'ppid'])

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

<main class="ppid-page" id="ppid">
  <section class="ppid-hero" aria-labelledby="ppidHeroTitle">
    <div class="ppid-hero-bg" aria-hidden="true"></div>
    <div class="ppid-hero-inner">
      <div class="ppid-hero-copy">
        <div class="ppid-kicker"><i class="ti ti-file-search"></i> PPID {{ $siteShortName }}</div>
        <h1 id="ppidHeroTitle">Pejabat Pengelola Informasi dan Dokumentasi</h1>
        <p>{{ $siteTagline }}</p>
        <div class="ppid-hero-actions">
          <a href="#ppid-permohonan" class="ppid-primary-btn"><i class="ti ti-send"></i> Permohonan Informasi</a>
          <a href="#ppid-keberatan" class="ppid-secondary-btn"><i class="ti ti-alert-circle"></i> Pengajuan Keberatan</a>
        </div>
      </div>
      <div class="ppid-hero-panel" aria-label="Ringkasan layanan PPID">
        <span class="ppid-panel-label">Status Layanan</span>
        <strong>Portal PPID Aktif</strong>
        <p>Metadata dokumen tersimpan di database Laravel, sedangkan file dapat diarahkan ke storage lokal, Google Drive, atau tautan eksternal.</p>
        <div class="ppid-panel-meta">
          <span><i class="ti ti-clock"></i> 10 hari kerja</span>
          <span><i class="ti ti-shield-check"></i> Terverifikasi PPID</span>
        </div>
      </div>
    </div>
  </section>

  <nav class="ppid-subnav" aria-label="Sub menu PPID">
    <a href="#ppid-profil">Profil PPID</a>
    <a href="#ppid-dokumen" data-ppid-nav-category="Berkala">Informasi Berkala</a>
    <a href="#ppid-dokumen" data-ppid-nav-category="Setiap Saat">Informasi Setiap Saat</a>
    <a href="#ppid-dokumen" data-ppid-nav-category="Serta Merta">Informasi Serta Merta</a>
    <a href="#ppid-dokumen" data-ppid-nav-category="Dikecualikan">Informasi Dikecualikan</a>
    <a href="#ppid-dokumen" data-ppid-nav-category="DIP">Daftar Informasi Publik (DIP)</a>
    <a href="#ppid-dokumen" data-ppid-nav-category="SOP">SOP Pelayanan</a>
    <a href="#ppid-permohonan">Permohonan Informasi</a>
    <a href="#ppid-keberatan">Pengajuan Keberatan</a>
    <a href="#ppid-laporan">Laporan Layanan Informasi</a>
  </nav>

  <section class="ppid-section ppid-stats" aria-label="Dashboard statistik PPID">
    <div class="ppid-stat-card">
      <span>Jumlah Dokumen</span>
      <strong>{{ number_format($ppidStats['total'] ?? 0) }}</strong>
      <small>Dokumen aktif di database</small>
    </div>
    <div class="ppid-stat-card">
      <span>Dokumen Tahun Ini</span>
      <strong>{{ number_format($ppidStats['this_year'] ?? 0) }}</strong>
      <small>{{ now()->year }}</small>
    </div>
    <div class="ppid-stat-card">
      <span>Kategori Aktif</span>
      <strong>{{ number_format($ppidStats['categories'] ?? 0) }}</strong>
      <small>Terbaca dari metadata dokumen</small>
    </div>
    <div class="ppid-stat-card">
      <span>Jenis Penyimpanan</span>
      <strong>{{ number_format($ppidStats['sources'] ?? 0) }}</strong>
      <small>Server BPAD, Google Drive, atau situs lain</small>
    </div>
  </section>

  <section class="ppid-section" aria-labelledby="ppidKategoriTitle">
    <div class="ppid-section-head">
      <span class="ppid-kicker"><i class="ti ti-layout-grid"></i> Informasi Publik</span>
      <h2 id="ppidKategoriTitle">Kategori layanan dan dokumen PPID</h2>
      <p>Pilih kategori untuk melihat daftar dokumen. Metadata dikelola di database Laravel, sedangkan file asli bisa diarahkan ke storage lokal atau Google Drive.</p>
    </div>
    <div class="ppid-category-grid">
      <button class="ppid-category-card" type="button" data-ppid-category="Berkala">
        <i class="ti ti-calendar-stats"></i>
        <strong>Informasi Berkala</strong>
        <span>{{ number_format($docRowsCollection->where('category', 'Berkala')->count()) }} dokumen rutin.</span>
      </button>
      <button class="ppid-category-card" type="button" data-ppid-category="Setiap Saat">
        <i class="ti ti-folder-open"></i>
        <strong>Informasi Setiap Saat</strong>
        <span>{{ number_format($docRowsCollection->where('category', 'Setiap Saat')->count()) }} dokumen siap diminta.</span>
      </button>
      <button class="ppid-category-card" type="button" data-ppid-category="Serta Merta">
        <i class="ti ti-speakerphone"></i>
        <strong>Informasi Serta Merta</strong>
        <span>{{ number_format($docRowsCollection->where('category', 'Serta Merta')->count()) }} informasi darurat atau penting.</span>
      </button>
      <button class="ppid-category-card" type="button" data-ppid-category="Dikecualikan">
        <i class="ti ti-lock-square"></i>
        <strong>Informasi Dikecualikan</strong>
        <span>{{ number_format($docRowsCollection->where('category', 'Dikecualikan')->count()) }} dokumen terbatas.</span>
      </button>
      <button class="ppid-category-card" type="button" data-ppid-category="DIP">
        <i class="ti ti-list-details"></i>
        <strong>DIP</strong>
        <span>{{ number_format($docRowsCollection->where('category', 'DIP')->count()) }} dokumen daftar informasi publik.</span>
      </button>
      <button class="ppid-category-card" type="button" data-ppid-category="SOP">
        <i class="ti ti-clipboard-list"></i>
        <strong>SOP Pelayanan</strong>
        <span>{{ number_format($docRowsCollection->where('category', 'SOP')->count()) }} dokumen prosedur layanan.</span>
      </button>
    </div>
  </section>

  <section class="ppid-section ppid-docs" id="ppid-dokumen" aria-labelledby="ppidDokumenTitle">
    <div class="ppid-section-head">
      <span class="ppid-kicker"><i class="ti ti-database-search"></i> Sistem Dokumen Modern</span>
      <h2 id="ppidDokumenTitle">Daftar dokumen PPID</h2>
      <p>Tabel ini siap membaca metadata dari database Laravel dan memakai storage lokal, Google Drive, atau tautan eksternal sebagai sumber file dokumen.</p>
    </div>

    <div class="ppid-doc-toolbar">
      <label class="ppid-search-box">
        <i class="ti ti-search"></i>
        <input id="ppidDocSearch" type="search" placeholder="Cari dokumen..." autocomplete="off">
      </label>
      <label>
        <span>Tahun</span>
        <select id="ppidYearFilter">
          <option value="">Semua Tahun</option>
          @foreach ($ppidYears ?? [] as $year)
            <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
      </label>
      <label>
        <span>Kategori</span>
        <select id="ppidCategoryFilter">
          <option value="">Semua Kategori</option>
          @foreach ($ppidCategories ?? [] as $category)
            <option value="{{ $category }}">{{ $category }}</option>
          @endforeach
        </select>
      </label>
    </div>

    <div class="ppid-doc-layout">
      <div class="ppid-table-wrap">
        <table class="ppid-doc-table">
          <thead>
            <tr>
              <th>Dokumen</th>
              <th>Kategori</th>
              <th>Tahun</th>
              <th>Format</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="ppidDocumentRows">
            @forelse ($docRowsCollection as $document)
              @php
                $filePath = $document->file_path ?? null;
                $fileUrl = '';
                if ($filePath) {
                  $fileUrl = str_starts_with($filePath, '/') || preg_match('/^https?:/i', $filePath)
                    ? $filePath
                    : \Illuminate\Support\Facades\Storage::disk('public')->url($filePath);
                }
                $downloadUrl = $fileUrl ?: ($document->external_url ?: ($document->preview_url ?: '#dokumen-belum-tersedia'));
              @endphp
              <tr>
                <td>
                  <div class="ppid-doc-title">
                    <strong>{{ $document->title }}</strong>
                    <span>Update {{ optional($document->published_at ?? $document->updated_at)?->format('d M Y') ?? '-' }} - {{ $document->file_size ?: '-' }}</span>
                  </div>
                </td>
                <td><span class="ppid-doc-badge">{{ $document->category }}</span></td>
                <td>{{ $document->document_year }}</td>
                <td>{{ $document->file_format }}</td>
                <td>
                  <div class="ppid-doc-actions">
                    <button type="button" data-ppid-preview="{{ $document->id }}"><i class="ti ti-eye"></i> Preview</button>
                    <a href="{{ $downloadUrl }}" data-ppid-download="{{ $document->id }}"><i class="ti ti-download"></i> Download</a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td class="ppid-empty-row" colspan="5">Belum ada dokumen PPID di database.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <aside class="ppid-preview-panel" id="ppidPreviewPanel" aria-live="polite">
        <span class="ppid-panel-label">Preview Dokumen</span>
        @if ($docRowsCollection->isNotEmpty())
          @php $firstDocument = $docRowsCollection->first(); @endphp
          <h3>{{ $firstDocument->title }}</h3>
          <p>{{ $firstDocument->description }}</p>
          <div class="ppid-preview-meta">
            <span><strong>Kategori:</strong> {{ $firstDocument->category }}</span>
            <span><strong>Tahun:</strong> {{ $firstDocument->document_year }}</span>
            <span><strong>Format:</strong> {{ $firstDocument->file_format }} - {{ $firstDocument->file_size ?: '-' }}</span>
            <span><strong>Sumber:</strong> {{ $firstDocument->source === 'local' ? 'Penyimpanan BPAD' : 'Tautan eksternal' }}</span>
          </div>
        @else
          <h3>Pilih tombol preview</h3>
          <p>Detail dokumen akan tampil di sini setelah data diisi ke database.</p>
        @endif
      </aside>
    </div>
  </section>

  <section class="ppid-section ppid-forms" aria-label="Form layanan PPID">
    <article class="ppid-form-card ppid-form-link-card" id="ppid-permohonan">
      <div class="ppid-section-head compact">
        <span class="ppid-kicker"><i class="ti ti-mail-forward"></i> Form Online</span>
        <h2>Permohonan Informasi</h2>
      </div>
      <p class="ppid-form-intro">Pengisian data pemohon dilakukan melalui Google Form agar respons langsung masuk ke Google Sheets operator PPID.</p>
      <ul class="ppid-form-field-list" aria-label="Field permohonan informasi">
        <li>Nama</li>
        <li>Email</li>
        <li>Nomor HP</li>
        <li>Alamat</li>
        <li>Informasi yang diminta</li>
        <li>Tujuan penggunaan informasi</li>
      </ul>
      <a class="ppid-primary-btn ppid-form-link" href="{{ $ppidRequestUrl }}" target="_blank" rel="noopener" data-setting-href="form.ppid_request.url" data-ppid-form-link>
        <i class="ti ti-brand-google-drive"></i> Buka Google Form
      </a>
      <p class="ppid-form-note">Link dapat diganti dari web settings key <strong>form.ppid_request.url</strong>.</p>
    </article>

    <article class="ppid-form-card ppid-form-link-card" id="ppid-keberatan">
      <div class="ppid-section-head compact">
        <span class="ppid-kicker"><i class="ti ti-alert-triangle"></i> Form Keberatan</span>
        <h2>Pengajuan Keberatan</h2>
      </div>
      <p class="ppid-form-intro">Pengajuan keberatan juga diarahkan ke Google Form terpisah agar rekapnya mudah dipantau oleh petugas.</p>
      <ul class="ppid-form-field-list" aria-label="Field pengajuan keberatan">
        <li>Nomor permohonan</li>
        <li>Alasan keberatan</li>
        <li>Kronologi</li>
      </ul>
      <a class="ppid-secondary-btn solid ppid-form-link" href="{{ $ppidObjectionUrl ?: '#form-keberatan-belum-diisi' }}" target="_blank" rel="noopener" data-setting-href="form.ppid_objection.url" data-ppid-form-link>
        <i class="ti ti-file-alert"></i> Buka Google Form Keberatan
      </a>
      <p class="ppid-form-note">Isi web settings key <strong>form.ppid_objection.url</strong> setelah Google Form keberatan dibuat.</p>
    </article>
  </section>

  <section class="ppid-section ppid-timeline" aria-labelledby="ppidTimelineTitle">
    <div class="ppid-section-head">
      <span class="ppid-kicker"><i class="ti ti-route"></i> Alur Pelayanan</span>
      <h2 id="ppidTimelineTitle">Timeline layanan informasi</h2>
    </div>
    <ol class="ppid-timeline-list">
      <li><span>1</span><strong>Permohonan Masuk</strong><p>Pemohon mengisi form dan melengkapi identitas.</p></li>
      <li><span>2</span><strong>Verifikasi</strong><p>Petugas memeriksa kelengkapan data dan kategori informasi.</p></li>
      <li><span>3</span><strong>Proses PPID</strong><p>PPID menyiapkan dokumen atau jawaban resmi.</p></li>
      <li><span>4</span><strong>Informasi Dikirim</strong><p>Informasi diberikan melalui kanal yang dipilih pemohon.</p></li>
    </ol>
  </section>

  <section class="ppid-section ppid-profile" id="ppid-profil" aria-labelledby="ppidProfilTitle">
    <div class="ppid-section-head">
      <span class="ppid-kicker"><i class="ti ti-building-bank"></i> Profil PPID</span>
      <h2 id="ppidProfilTitle">Struktur, visi misi, tugas fungsi, dan SK PPID</h2>
    </div>
    <div class="ppid-profile-grid">
      <article class="ppid-info-card">
        <h3>Struktur Organisasi</h3>
        <p>Atasan PPID, PPID Pelaksana, bidang pelayanan informasi, bidang dokumentasi, dan bidang penyelesaian sengketa informasi.</p>
      </article>
      <article class="ppid-info-card">
        <h3>Visi Misi</h3>
        <p>Mendukung keterbukaan informasi publik yang akurat, mudah diakses, dan responsif bagi masyarakat NTT.</p>
      </article>
      <article class="ppid-info-card">
        <h3>Tugas Fungsi</h3>
        <p>Mengelola, mendokumentasikan, menyediakan, dan melayani permintaan informasi publik di lingkungan BPAD NTT.</p>
      </article>
      <article class="ppid-info-card">
        <h3>SK PPID</h3>
        <p>Dokumen keputusan PPID disiapkan sebagai rujukan organisasi dan tanggung jawab pelayanan informasi publik.</p>
      </article>
    </div>
  </section>

  <section class="ppid-section" aria-labelledby="ppidHukumTitle">
    <div class="ppid-section-head">
      <span class="ppid-kicker"><i class="ti ti-scale"></i> Dasar Hukum</span>
      <h2 id="ppidHukumTitle">Regulasi keterbukaan informasi publik</h2>
    </div>
    <div class="ppid-legal-grid">
      <article><i class="ti ti-gavel"></i><strong>UU KIP</strong><span>Undang-Undang Keterbukaan Informasi Publik</span></article>
      <article><i class="ti ti-file-certificate"></i><strong>PERKI No.1 Tahun 2021</strong><span>Standar layanan informasi publik</span></article>
      <article><i class="ti ti-building-community"></i><strong>Pergub</strong><span>Regulasi daerah terkait layanan informasi</span></article>
      <article><i class="ti ti-license"></i><strong>SK PPID</strong><span>Penetapan pejabat dan struktur PPID</span></article>
    </div>
  </section>

  <section class="ppid-section ppid-integration" id="ppid-laporan" aria-labelledby="ppidIntegrasiTitle">
    <div>
      <span class="ppid-kicker"><i class="ti ti-plug-connected"></i> Integrasi Dokumen</span>
      <h2 id="ppidIntegrasiTitle">Siap untuk storage lokal, Google Drive, dan Google Forms</h2>
      <p>Metadata dokumen tersimpan di database Laravel, file dapat diarahkan ke storage lokal atau Google Drive, dan form layanan memakai tautan yang bisa diganti dari web settings.</p>
    </div>
    <div class="ppid-source-grid">
      <span><i class="ti ti-database"></i> Database Laravel: metadata dokumen</span>
      <span><i class="ti ti-brand-google-drive"></i> Google Drive: file dokumen</span>
      <span><i class="ti ti-forms"></i> Google Forms: permohonan dan keberatan</span>
    </div>
  </section>
</main>

@include('public.partials.contact-bar')
@include('public.partials.footer')

<!--
  SCRIPT UTAMA
  File ini mengatur menu mobile, dropdown Aplikasi,
  dan membaca data JSON untuk konten halaman.
-->
  <script src="/js/public-data.js?v=20260603-dbsource1"></script>
  <script>
    window.BPAD_PPID_INITIAL_DOCUMENTS = @json($initialPpidDocuments);
  </script>
  <script src="/js/main.js?v=20260603-dbsource1"></script>

</body>
</html>
