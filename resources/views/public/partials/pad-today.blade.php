<!--
  DATA PAD HARI INI
  Komponen ringkas sebelum hero. Nilai bisa dikonfigurasi melalui Pengaturan Website.
-->
@php
    $formatRupiah = function ($raw) {
        if (!$raw || !is_numeric($raw)) return 'Rp --';
        $num = (float) $raw;
        $abs = abs($num);
        if ($abs >= 1e12) return 'Rp ' . number_format($num / 1e12, 2, ',', '.') . ' T';
        if ($abs >= 1e9)  return 'Rp ' . number_format($num / 1e9, 2, ',', '.') . ' M';
        if ($abs >= 1e6)  return 'Rp ' . number_format($num / 1e6, 2, ',', '.') . ' Jt';
        return 'Rp ' . number_format($num, 0, ',', '.');
    };
    $formatPercent = function ($raw) {
        if (!$raw || !is_numeric($raw)) return '--%';
        return number_format((float) $raw, 2, ',', '') . '%';
    };
    $realisasiRaw = ($settings ?? collect())->get('pad.realisasi.value');
    $targetRaw    = ($settings ?? collect())->get('pad.target_text');
    $percentRaw   = ($settings ?? collect())->get('pad.percentage');
@endphp
<section class="pad-today" aria-label="Data Pendapatan Asli Daerah hari ini">
  <div class="pad-today-inner">
    <div class="pad-today-head">
      <span class="pad-live-dot"></span>
      <strong>PAD Hari Ini</strong>
    </div>
    <div class="pad-today-line">
      <span>Realisasi: <strong>{{ $formatRupiah($realisasiRaw) }}</strong></span>
      <span>Target 2026: <strong>{{ $formatRupiah($targetRaw) }}</strong></span>
      <span>Persentase: <strong>{{ $formatPercent($percentRaw) }}</strong></span>
      <span id="padUpdateDate">{{ ($settings ?? collect())->get('pad.updated_at', 'Update hari ini') }}</span>
      <span class="pad-status">{{ ($settings ?? collect())->get('pad.status', 'Menunggu data resmi') }}</span>
    </div>
  </div>
</section>
