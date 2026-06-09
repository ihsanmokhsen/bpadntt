@php
    $contactAddress = ($settings ?? collect())->get('contact.address', 'Jl. El Tari No.52, Oebobo, Kota Kupang');
    $contactEmail = ($settings ?? collect())->get('contact.email', 'bapenda@nttprov.go.id');
    $facebookUrl = ($settings ?? collect())->get('social.facebook.url', 'https://www.facebook.com/bpadntt');
    $instagramUrl = ($settings ?? collect())->get('social.instagram.url', 'https://www.instagram.com/bpad_ntt/');
    $youtubeUrl = ($settings ?? collect())->get('social.youtube.url', '');
    $xUrl = ($settings ?? collect())->get('social.x.url', '');
    $contactHoursWeekday = ($settings ?? collect())->get('contact.hours.weekday', '07.30 - 15.30 WITA');
    $contactHoursFriday = ($settings ?? collect())->get('contact.hours.friday', '07.30 - 11.30 WITA');
@endphp

<div class="info-bar" id="kontak">
  <div class="info-block">
    <h3><i class="ti ti-map-pin"></i> Alamat Kantor</h3>
    <p>
      {{ $contactAddress }}<br>
      Kec. Oebobo, Kota Kupang<br>
      Nusa Tenggara Timur<br>
      85111 — Indonesia
    </p>
  </div>
  <div class="info-block">
    <h3><i class="ti ti-headset"></i> Hubungi Kami</h3>
    <p>
      <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
    </p>
    <div class="sosmed">
      <a href="{{ $facebookUrl }}" title="Facebook" target="_blank" rel="noopener"><i class="ti ti-brand-facebook"></i></a>
      <a href="{{ $instagramUrl }}" title="Instagram" target="_blank" rel="noopener"><i class="ti ti-brand-instagram"></i></a>
      @if ($youtubeUrl)
        <a href="{{ $youtubeUrl }}" title="YouTube" target="_blank" rel="noopener"><i class="ti ti-brand-youtube"></i></a>
      @endif
      @if ($xUrl)
        <a href="{{ $xUrl }}" title="Twitter/X" target="_blank" rel="noopener"><i class="ti ti-brand-x"></i></a>
      @endif
    </div>
  </div>
  <div class="info-block">
    <h3><i class="ti ti-clock"></i> Jam Pelayanan</h3>
    <p>
      Senin – Kamis:<br>{{ $contactHoursWeekday }}<br><br>
      Jumat:<br>{{ $contactHoursFriday }}
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
