@php
    $siteName = ($settings ?? collect())->get('site.name', 'Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur');
    $siteShortName = ($settings ?? collect())->get('site.short_name', 'BPAD NTT');
    $contactEmail = ($settings ?? collect())->get('contact.email', 'bapenda@nttprov.go.id');
    $contactPhone = ($settings ?? collect())->get('contact.phone', '-');
    $contactAddress = ($settings ?? collect())->get('contact.address', 'Jl. El Tari No.52, Oebobo, Kota Kupang');
    $contactHoursWeekday = ($settings ?? collect())->get('contact.hours.weekday', '07.30 - 15.30 WITA');
    $contactHoursFriday = ($settings ?? collect())->get('contact.hours.friday', '07.30 - 11.30 WITA');
    $instagramUrl = ($settings ?? collect())->get('social.instagram.url', 'https://www.instagram.com/bpad_ntt/');
    $facebookUrl = ($settings ?? collect())->get('social.facebook.url', 'https://www.facebook.com/bpadntt');
    $youtubeUrl = ($settings ?? collect())->get('social.youtube.url', '');
    $xUrl = ($settings ?? collect())->get('social.x.url', '');
    $copyrightYear = ($settings ?? collect())->get('site.copyright_year', now()->year);
@endphp

<footer>
  <div class="footer-main">
    <div class="footer-col">
      <div class="footer-brand">
        <img src="/assets/logo.png" alt="Logo BPAD NTT">
        <div>
          <h4>{{ $siteShortName }}</h4>
          <p>{{ $siteName }}.</p>
        </div>
      </div>
    </div>
    <div class="footer-col">
      <h4>Navigasi</h4>
      <a href="/profil">Profil</a>
      <a href="/layanan">Layanan</a>
      <a href="/galeri">Galeri</a>
      <a href="/ppid">PPID</a>
      <a href="/berita">Berita</a>
      <a href="/pengumuman">Pengumuman</a>
    </div>
    <div class="footer-col">
      <h4>Aplikasi</h4>
      <a href="https://magangbpad.netlify.app/" target="_blank" rel="noopener">Magang Hub</a>
      <a href="https://play.google.com/store/apps/details?id=com.iwana.betantt&hl=id" target="_blank" rel="noopener">Pro NTT</a>
      <a href="https://research.ihsanmokhsen.com/kastau-tim-siber-landing.html" target="_blank" rel="noopener">Kastau Tim Siber</a>
      <a href="https://forms.gle/z5ru8iL955ekdrmK7" target="_blank" rel="noopener">Kotak Saran (SKM)</a>
      <a href="https://forms.gle/Us5L3Peh8N1L99iq7" target="_blank" rel="noopener">Buku Tamu</a>
      <a href="{{ $instagramUrl }}" target="_blank" rel="noopener">Instagram BPAD NTT</a>
      @if ($facebookUrl)
        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener">Facebook BPAD NTT</a>
      @endif
      @if ($youtubeUrl)
        <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener">YouTube BPAD NTT</a>
      @endif
      @if ($xUrl)
        <a href="{{ $xUrl }}" target="_blank" rel="noopener">X BPAD NTT</a>
      @endif
    </div>
    <div class="footer-col">
      <h4>Kontak</h4>
      <p>{{ $contactAddress }}</p>
      <p>{{ $contactEmail }}</p>
      <p>{{ $contactHoursWeekday }}</p>
      <p>Jumat: {{ $contactHoursFriday }}</p>
      @if ($contactPhone !== '-')
        <p>{{ $contactPhone }}</p>
      @endif
    </div>
  </div>
  <div class="footer-bottom">
    <p>© {{ $copyrightYear }} {{ $siteName }}</p>
    <p>
      <a href="#">Kebijakan Privasi</a> &nbsp;·&nbsp;
      <a href="#">Aksesibilitas</a> &nbsp;·&nbsp;
      <a href="#">Peta Situs</a> &nbsp;·&nbsp;
      <a class="footer-login-link" href="/admin/login"><i class="ti ti-lock"></i> Login Admin</a>
    </p>
  </div>
</footer>
