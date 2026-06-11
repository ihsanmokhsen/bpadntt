@extends('layouts.app')

@section('title', 'Dashboard Admin - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Dashboard Laravel</p>
            <h1>Selamat datang, {{ auth()->user()->name }}</h1>
            <p>Fondasi admin sudah memakai session Laravel dan database aplikasi sendiri.</p>
        </div>
        <span class="status-pill">Akun aktif</span>
    </section>

    <section class="content-section">
        @include('admin.partials.operator-guide', [
            'title' => 'Mulai dari menu sesuai kebutuhan',
            'items' => [
                'Web Setting dipakai untuk identitas situs, hero, kontak, media sosial, dan tautan formulir PPID.',
                'Kelola Konten dipakai untuk berita, pengumuman, dan agenda.',
                'Kelola PPID dipakai untuk dokumen informasi publik dan tautan unduhannya.',
                'Kelola Galeri dipakai untuk mengelola foto dan video kegiatan BPAD NTT.',
                'Gunakan Lihat Website setelah menyimpan untuk memeriksa hasil pada halaman publik.',
            ],
        ])

        <div class="section-heading">
            <div>
                <p class="eyebrow">Pengelolaan Website</p>
                <h2>Aksi cepat</h2>
            </div>
        </div>

        <div class="action-grid">
            <a href="{{ route('admin.posts.create') }}">
                <strong>Tambah Konten</strong>
                <span>Buat berita, pengumuman, atau agenda baru.</span>
            </a>
            <a href="{{ route('admin.settings.edit') }}">
                <strong>Web Setting</strong>
                <span>Ubah nama situs, kontak resmi, dan tautan PPID.</span>
            </a>
            <a href="{{ route('admin.posts.index') }}">
                <strong>Kelola Konten</strong>
                <span>Edit, terbitkan, cari, atau hapus konten.</span>
            </a>
            <a href="{{ route('admin.ppid-documents.index') }}">
                <strong>Kelola PPID</strong>
                <span>Atur dokumen publik, kategori, dan tautan unduhan.</span>
            </a>
            <a href="{{ route('admin.galleries.index') }}">
                <strong>Kelola Galeri</strong>
                <span>Upload foto kegiatan atau tautkan dari Instagram.</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" rel="noopener">
                <strong>Lihat Website</strong>
                <span>Periksa hasil perubahan di halaman publik.</span>
            </a>
        </div>
    </section>

    <section class="content-section">
        <div class="metric-grid">
            <article><strong>{{ $counts['posts'] }}</strong><span>Semua konten</span></article>
            <article><strong>{{ $counts['published'] }}</strong><span>Terbit</span></article>
            <article><strong>{{ $counts['settings'] }}</strong><span>Pengaturan</span></article>
            <article><strong>{{ $counts['ppid'] }}</strong><span>Dokumen PPID</span></article>
            <article><strong>{{ $counts['galleries'] }}</strong><span>Galeri</span></article>
            <article><strong>{{ $counts['media'] }}</strong><span>Media lokal</span></article>
        </div>
    </section>

    <section class="content-section">
        @include('admin.partials.operator-guide', [
            'title' => 'Tentang aktivitas terbaru',
            'items' => [
                'Tabel ini mencatat perubahan penting yang dilakukan melalui dashboard admin.',
                'Alamat IP membantu mengenali asal akses saat diperlukan pemeriksaan keamanan.',
            ],
        ])

        <div class="section-heading">
            <div>
                <p class="eyebrow">Keamanan</p>
                <h2>Aktivitas terbaru</h2>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Alamat IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $log->user?->username ?: '-' }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->ip_address ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Belum ada aktivitas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
