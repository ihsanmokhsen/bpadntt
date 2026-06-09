@php
    $siteShortName = ($settings ?? collect())->get('site.short_name', 'BPAD NTT');
    $siteTagline = ($settings ?? collect())->get('site.tagline', 'Melayani dengan transparan dan akuntabel');
    $contactEmail = ($settings ?? collect())->get('contact.email', 'bapenda@nttprov.go.id');
    $contactAddress = ($settings ?? collect())->get('contact.address', 'Jl. El Tari No.52, Oebobo, Kota Kupang');
    $contactHoursWeekday = ($settings ?? collect())->get('contact.hours.weekday', '07.30 - 15.30 WITA');
    $contactHoursFriday = ($settings ?? collect())->get('contact.hours.friday', '07.30 - 11.30 WITA');
@endphp

<div class="topbar">
  <div class="topbar-left">
    <span><i class="ti ti-mail"></i> {{ $contactEmail }}</span>
  </div>
  <div class="topbar-right">
    <span><i class="ti ti-clock"></i> Senin – Kamis: {{ $contactHoursWeekday }}</span>
    <span><i class="ti ti-clock"></i> Jumat: {{ $contactHoursFriday }}</span>
    <span><i class="ti ti-map-pin"></i> {{ $contactAddress }}</span>
  </div>
</div>

<nav class="navbar" id="navbar">
  <div class="logo-area">
    <div class="logo-img"><img src="/assets/logo.png" alt="Logo BPAD NTT"></div>
    <div class="logo-text">
      <h1>{{ $siteShortName }}</h1>
      <p>{{ $siteTagline }}</p>
    </div>
  </div>
  <div class="nav-links">
    <a href="/" @class(['active' => $active === 'home'])>Beranda</a>
    <a href="/profil" @class(['active' => $active === 'profil'])>Profil</a>
    <a href="/layanan" @class(['active' => $active === 'layanan'])>Layanan</a>
    <div class="nav-dropdown" id="appDropdown">
      <button class="nav-drop-toggle" type="button" onclick="toggleAppMenu(event)">
        Aplikasi <i class="ti ti-chevron-down"></i>
      </button>
      <div class="dropdown-menu" id="appMenu">
        <a href="https://magangbpad.netlify.app/" target="_blank" rel="noopener"><i class="ti ti-briefcase"></i> Magang Hub</a>
        <a href="https://play.google.com/store/apps/details?id=com.iwana.betantt&hl=id" target="_blank" rel="noopener"><i class="ti ti-apps"></i> Pro NTT</a>
        <a href="https://research.ihsanmokhsen.com/kastau-tim-siber-landing.html" target="_blank" rel="noopener"><i class="ti ti-shield-lock"></i> Kastau Tim Siber</a>
        <a href="https://forms.gle/z5ru8iL955ekdrmK7" target="_blank" rel="noopener"><i class="ti ti-message-2"></i> Kotak Saran (SKM)</a>
        <a href="https://forms.gle/Us5L3Peh8N1L99iq7" target="_blank" rel="noopener"><i class="ti ti-book-2"></i> Buku Tamu</a>
      </div>
    </div>
    <a href="/galeri" @class(['active' => $active === 'galeri'])>Galeri</a>
    <a href="/ppid" @class(['active' => $active === 'ppid'])>PPID</a>
    <a href="/berita" @class(['active' => $active === 'berita'])>Berita</a>
    <a href="/pengumuman" @class(['active' => $active === 'pengumuman'])>Pengumuman</a>
    <form class="nav-search" id="navSearchForm" role="search" aria-label="Pencarian menu cepat">
      <i class="ti ti-search"></i>
      <input id="navSearchInput" type="search" placeholder="Cari menu..." autocomplete="off" aria-label="Cari menu">
    </form>
    <a href="/#kontak" class="nav-cta"><i class="ti ti-phone-call"></i> Hubungi Kami</a>
  </div>
  <div class="hamburger" onclick="toggleMenu()"><i class="ti ti-menu-2"></i></div>
  <div class="mobile-menu" id="mobileMenu">
    <a href="/">Beranda</a>
    <a href="/profil">Profil</a>
    <a href="/layanan">Layanan</a>
    <a href="https://magangbpad.netlify.app/" target="_blank" rel="noopener">Magang Hub</a>
    <a href="https://play.google.com/store/apps/details?id=com.iwana.betantt&hl=id" target="_blank" rel="noopener">Pro NTT</a>
    <a href="https://research.ihsanmokhsen.com/kastau-tim-siber-landing.html" target="_blank" rel="noopener">Kastau Tim Siber</a>
    <a href="https://forms.gle/z5ru8iL955ekdrmK7" target="_blank" rel="noopener">Kotak Saran (SKM)</a>
    <a href="https://forms.gle/Us5L3Peh8N1L99iq7" target="_blank" rel="noopener">Buku Tamu</a>
    <a href="/galeri">Galeri</a>
    <a href="/ppid">PPID</a>
    <a href="/berita">Berita</a>
    <a href="/pengumuman">Pengumuman</a>
    <a href="/#kontak">Hubungi Kami</a>
  </div>
</nav>
