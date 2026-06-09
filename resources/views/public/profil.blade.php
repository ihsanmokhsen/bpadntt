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
  <title>Profil – BPAD NTT</title>
  <link rel="icon" type="image/png" href="/assets/logo.png">
  <link rel="apple-touch-icon" href="/assets/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=20260604-glass-header">
</head>
<body>
@include('public.partials.header', ['active' => 'profil'])

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

<section class="ppid-hero page-hero page-hero-profil" aria-labelledby="profilHeroTitle">
  <div class="ppid-hero-bg" aria-hidden="true"></div>
  <div class="ppid-hero-inner">
    <div class="ppid-hero-copy">
      <div class="ppid-kicker"><i class="ti ti-building-bank"></i> Profil BPAD NTT</div>
      <h1 id="profilHeroTitle">Profil Badan Pendapatan dan Aset Daerah</h1>
      <p>Mengenal visi, misi, tugas fungsi, dan struktur organisasi BPAD Provinsi Nusa Tenggara Timur.</p>
      <div class="ppid-hero-actions">
        <a href="#profil" class="ppid-primary-btn"><i class="ti ti-target"></i> Visi & Misi</a>
        <a href="#struktur-organisasi" class="ppid-secondary-btn"><i class="ti ti-sitemap"></i> Struktur Organisasi</a>
      </div>
    </div>
    <div class="ppid-hero-panel" aria-label="Ringkasan profil BPAD">
      <span class="ppid-panel-label">Profil Instansi</span>
      <strong>Transparan dan akuntabel</strong>
      <p>Halaman profil menyiapkan konteks kelembagaan sebelum masuk ke rincian tugas, fungsi, dan susunan organisasi.</p>
      <div class="ppid-panel-meta">
        <span><i class="ti ti-eye"></i> Visi misi</span>
        <span><i class="ti ti-list-check"></i> Tugas dan fungsi</span>
      </div>
    </div>
  </div>
</section>

<!--
  PROFIL: VISI MISI
  Bagian awal profil instansi.
-->
<section class="section-alt" id="profil">
  <div class="section-hdr">
    <div class="section-hdr-left">
      <div class="section-eyebrow"><i class="ti ti-target"></i> Profil Instansi</div>
      <div class="section-title">Visi & Misi BPAD</div>
    </div>
  </div>
  <div class="visi-grid">
    <div class="visi-card featured">
      <div class="visi-label"><i class="ti ti-eye"></i> Visi</div>
      <div class="visi-text">"Terwujudnya Pengelolaan Pendapatan dan Aset Daerah yang Profesional, Transparan, dan Akuntabel demi Mendukung Pembangunan NTT yang Sejahtera."</div>
    </div>
    <div class="visi-card">
      <div class="visi-label"><i class="ti ti-list-check"></i> Misi</div>
      <ul class="misi-list">
        <li><i class="ti ti-check"></i> Meningkatkan kapasitas dan profesionalisme sumber daya aparatur</li>
        <li><i class="ti ti-check"></i> Mengoptimalkan pengelolaan pendapatan daerah secara akuntabel</li>
        <li><i class="ti ti-check"></i> Melaksanakan tertib administrasi dan inventarisasi aset daerah</li>
        <li><i class="ti ti-check"></i> Mengembangkan sistem informasi berbasis teknologi modern</li>
        <li><i class="ti ti-check"></i> Meningkatkan pelayanan prima kepada masyarakat dan wajib pajak</li>
      </ul>
    </div>
  </div>
</section>

<!--
  PROFIL: TUGAS, FUNGSI, DAN STRUKTUR
  Konten profil yang lebih panjang. Bagian ini masih statis
  karena jarang berubah.
-->
<section class="section profil-detail" id="struktur-organisasi">
  <div class="section-hdr">
    <div class="section-hdr-left">
      <div class="section-eyebrow"><i class="ti ti-sitemap"></i> Organisasi</div>
      <div class="section-title">Tugas, Fungsi, dan Struktur Organisasi</div>
    </div>
  </div>

  <div class="profil-note">
    Struktur organisasi Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur ditetapkan berdasarkan Peraturan Gubernur Provinsi Nusa Tenggara Timur Nomor 96 Tahun 2023 tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi serta Tata Kerja Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur.
  </div>

  <div class="detail-grid">
    <div class="detail-card primary">
      <div class="detail-label">A. Tugas Pokok</div>
      <p>Badan Pendapatan dan Aset Daerah mempunyai tugas membantu Gubernur dalam melaksanakan fungsi penunjang urusan pemerintahan di bidang pendapatan dan aset daerah yang menjadi kewenangan daerah.</p>
    </div>
    <div class="detail-card">
      <div class="detail-label">B. Fungsi</div>
      <ul class="detail-list">
        <li>Penyusunan kebijakan teknis di bidang pendapatan dan aset daerah.</li>
        <li>Pelaksanaan dukungan teknis di bidang pendapatan dan aset daerah.</li>
        <li>Pemantauan, evaluasi, dan pelaporan pelaksanaan kegiatan pendapatan dan aset daerah.</li>
        <li>Pembinaan teknis penyelenggaraan fungsi penunjang urusan pemerintahan daerah di bidang pendapatan dan aset daerah.</li>
        <li>Pelaksanaan fungsi lain yang diberikan oleh Gubernur sesuai dengan tugas dan fungsinya.</li>
      </ul>
    </div>
  </div>

  <div class="struktur-wrap">
    <div class="section-title small-title">C. Struktur Organisasi</div>
    <div class="struktur-grid">
      <div class="detail-card">
        <div class="detail-label">1. Unsur Pimpinan</div>
        <h3>Kepala Badan</h3>
        <p>Merumuskan program kerja Badan Pendapatan dan Aset Daerah yang mencakup kesekretariatan, pajak dan retribusi daerah, pengelolaan kekayaan daerah yang dipisahkan, pendapatan asli daerah lainnya yang sah, dana perimbangan, analisa kebutuhan dan penatausahaan aset, serta pemanfaatan, pemindahtanganan, dan pengamanan aset.</p>
      </div>
      <div class="detail-card">
        <div class="detail-label">2. Unsur Penunjang Pimpinan</div>
        <h3>Sekretariat</h3>
        <ul class="detail-list">
          <li>Sekretaris merencanakan, mengendalikan, dan mengevaluasi administrasi program, keuangan, kepegawaian, dan umum.</li>
          <li>Sub Bagian Keuangan melaksanakan pengelolaan keuangan secara transparan dan akuntabel.</li>
          <li>Sub Bagian Kepegawaian dan Umum mengelola administrasi kepegawaian, perlengkapan, tata usaha, dan urusan rumah tangga kantor.</li>
        </ul>
      </div>
      <div class="detail-card">
        <div class="detail-label">3. Unsur Pelaksana Teknis</div>
        <h3>Bidang</h3>
        <ul class="detail-list">
          <li>Bidang Pendapatan I mengelola PKB, BBNKB, PBBKB, dan Pajak Rokok.</li>
          <li>Bidang Pendapatan II mengelola retribusi daerah, kekayaan daerah, dana perimbangan, dan pendapatan daerah lainnya yang sah.</li>
          <li>Bidang Analisa Kebutuhan dan Penatausahaan Aset mengelola analisa kebutuhan, pengadaan, penatausahaan, penilaian, dan pencatatan aset daerah.</li>
          <li>Bidang Pemanfaatan, Pemindahtanganan, dan Pengamanan Aset mengelola pemanfaatan, pemindahtanganan, penghapusan, pengamanan, dan sengketa aset.</li>
        </ul>
      </div>
      <div class="detail-card">
        <div class="detail-label">4. UPTD</div>
        <h3>Unit Pelaksana Teknis Daerah</h3>
        <p>UPTD BPAD tersebar di 22 kabupaten/kota di Provinsi Nusa Tenggara Timur dengan tugas melaksanakan pemungutan pajak daerah, mengelola administrasi perpajakan daerah, serta melakukan verifikasi dan penagihan pajak.</p>
        <p>Struktur UPTD terdiri dari Kepala UPTD, Sub Bagian Tata Usaha, Seksi Penetapan dan Penagihan, serta Seksi Verifikasi.</p>
      </div>
      <div class="detail-card">
        <div class="detail-label">5. Kelompok Jabatan Fungsional</div>
        <h3>Tenaga Profesional</h3>
        <ul class="detail-list">
          <li>Analis Perencana Ahli Muda.</li>
          <li>Penilai Pemerintah Ahli Muda.</li>
          <li>Analis Keuangan Pusat dan Daerah Ahli Muda.</li>
          <li>Analis Kebijakan Ahli Muda.</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="history-grid">
    <div class="detail-card">
      <div class="detail-label">Riwayat Pimpinan</div>
      <h3>Kepala Dinas dari Tahun ke Tahun</h3>
      <ol class="history-list">
        <li>Piet A Tallo - Kepala Dinas Penda Tk.I NTT (15-03-1974 s/d 12-09-1983)</li>
        <li>Drs. Joachim Reo (1983-1988)</li>
        <li>Alo Jong Joko (1988-1993)</li>
        <li>Joachim Reo (1993-1999)</li>
        <li>Drs. Gaspar Parang Ehok (1999-2002)</li>
        <li>Drs. Alex Babies (2002-2007)</li>
        <li>L O Wila Huky (2007-2008)</li>
        <li>Plt. Welly Katipana (2008, masa transisi)</li>
        <li>Frans Salem (2008-2010)</li>
        <li>Emanuel Kara (2010-2014)</li>
        <li>Obaldus Toda - Dispenda (2014-2017)</li>
        <li>Hali Lanan Elias - BPPKAD (2017-2019)</li>
        <li>Zet Libing - BPAD (2019-2021)</li>
        <li>Alexon Lumba - BPAD (2022-2026)</li>
        <li>Johny Ericson Ataupah, SP. MM - BPAD (2026-sekarang)</li>
      </ol>
    </div>
    <div class="detail-card">
      <div class="detail-label">Sebaran Layanan</div>
      <h3>UPTD di NTT (Kabupaten/Kota)</h3>
      <div class="uptd-table-wrap">
        <table class="uptd-table">
          <thead>
            <tr>
              <th>No</th>
              <th>UPTD</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>UPTD Pendapatan Daerah Wilayah Kota Kupang</td></tr>
            <tr><td>2</td><td>UPTD Pendapatan Daerah Wilayah Kab. Kupang</td></tr>
            <tr><td>3</td><td>UPTD Pendapatan Daerah Wilayah Kab. Timor Tengah Selatan</td></tr>
            <tr><td>4</td><td>UPTD Pendapatan Daerah Wilayah Kab. Timor Tengah Utara</td></tr>
            <tr><td>5</td><td>UPTD Pendapatan Daerah Wilayah Kab. Belu</td></tr>
            <tr><td>6</td><td>UPTD Pendapatan Daerah Wilayah Kab. Rote Ndao</td></tr>
            <tr><td>7</td><td>UPTD Pendapatan Daerah Wilayah Kab. Flores Timur</td></tr>
            <tr><td>8</td><td>UPTD Pendapatan Daerah Wilayah Kab. Lembata</td></tr>
            <tr><td>9</td><td>UPTD Pendapatan Daerah Wilayah Kab. Sikka</td></tr>
            <tr><td>10</td><td>UPTD Pendapatan Daerah Wilayah Kab. Ende</td></tr>
            <tr class="uptd-extra-row"><td>11</td><td>UPTD Pendapatan Daerah Wilayah Kab. Nagekeo</td></tr>
            <tr class="uptd-extra-row"><td>12</td><td>UPTD Pendapatan Daerah Wilayah Kab. Ngada</td></tr>
            <tr class="uptd-extra-row"><td>13</td><td>UPTD Pendapatan Daerah Wilayah Kab. Manggarai Timur</td></tr>
            <tr class="uptd-extra-row"><td>14</td><td>UPTD Pendapatan Daerah Wilayah Kab. Manggarai Barat</td></tr>
            <tr class="uptd-extra-row"><td>15</td><td>UPTD Pendapatan Daerah Wilayah Kab. Manggarai</td></tr>
            <tr class="uptd-extra-row"><td>16</td><td>UPTD Pendapatan Daerah Wilayah Kab. Sumba Timur</td></tr>
            <tr class="uptd-extra-row"><td>17</td><td>UPTD Pendapatan Daerah Wilayah Kab. Sumba Tengah</td></tr>
            <tr class="uptd-extra-row"><td>18</td><td>UPTD Pendapatan Daerah Wilayah Kab. Sumba Barat</td></tr>
            <tr class="uptd-extra-row"><td>19</td><td>UPTD Pendapatan Daerah Wilayah Kab. Sumba Barat Daya</td></tr>
            <tr class="uptd-extra-row"><td>20</td><td>UPTD Pendapatan Daerah Wilayah Kab. Alor</td></tr>
            <tr class="uptd-extra-row"><td>21</td><td>UPTD Pendapatan Daerah Wilayah Kab. Malaka</td></tr>
            <tr class="uptd-extra-row"><td>22</td><td>UPTD Pendapatan Daerah Wilayah Kab. Sabu Raijua</td></tr>
          </tbody>
        </table>
      </div>
      <button class="uptd-toggle" type="button" onclick="toggleUptdRows(this)" aria-expanded="false">
        Lihat semua UPTD
      </button>
    </div>
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
