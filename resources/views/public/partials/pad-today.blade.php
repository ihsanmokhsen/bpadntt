<!--
  DATA PAD HARI INI
  Komponen ringkas sebelum hero. Nilai bisa dikonfigurasi melalui Pengaturan Website.
-->
<section class="pad-today" aria-label="Data Pendapatan Asli Daerah hari ini">
  <div class="pad-today-inner">
    <div class="pad-today-head">
      <span class="pad-live-dot"></span>
      <strong>PAD Hari Ini</strong>
    </div>
    <div class="pad-today-line">
      <span>Realisasi: <strong>{{ ($settings ?? collect())->get('pad.realisasi.value', 'Rp --') }}</strong></span>
      <span>Target 2026: <strong>{{ ($settings ?? collect())->get('pad.target_text', 'Rp 2,8T') }}</strong></span>
      <span>Realisasi: <strong>{{ ($settings ?? collect())->get('pad.percentage', '--%') }}</strong></span>
      <span id="padUpdateDate">{{ ($settings ?? collect())->get('pad.updated_at', 'Update hari ini') }}</span>
      <span class="pad-status">{{ ($settings ?? collect())->get('pad.status', 'Menunggu data resmi') }}</span>
    </div>
  </div>
</section>
