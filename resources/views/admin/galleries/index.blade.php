@extends('layouts.app')

@section('title', 'Kelola Galeri - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Dashboard Admin</p>
            <h1>Kelola Galeri</h1>
            <p>Kelola foto, gambar, dan konten visual yang ditampilkan di halaman Galeri publik.</p>
        </div>
        <a class="button" href="{{ route('admin.galleries.create') }}">Tambah Galeri</a>
    </section>

    <section class="content-section">
        @include('admin.partials.operator-guide', [
            'title' => 'Cara menambahkan galeri',
            'items' => [
                'Upload gambar langsung dari komputer untuk menyimpannya di server BPAD.',
                'Atau isi URL Gambar untuk menggunakan gambar yang sudah ada di /assets/ atau URL eksternal.',
                'Tautan Instagram bersifat opsional, digunakan untuk mengarahkan pengunjung ke postingan Instagram asli.',
                'Urutan Tampil mengatur urutan foto di halaman publik (angka lebih kecil tampil lebih dulu).',
            ],
        ])

        <form class="filter-bar" method="get" action="{{ route('admin.galleries.index') }}">
            <label>
                <span>Cari</span>
                <input name="search" value="{{ $search }}" placeholder="Judul atau caption">
            </label>
            <label>
                <span>Status</span>
                <select name="status">
                    <option value="">Semua status</option>
                    <option value="published" @selected($status === 'published')>Dipublikasi</option>
                    <option value="draft" @selected($status === 'draft')>Draft</option>
                </select>
            </label>
            <button class="button" type="submit">Terapkan</button>
            <a class="button button-secondary" href="{{ route('admin.galleries.index') }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:60px">Foto</th>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $gallery)
                        @php
                            $imgUrl = $gallery->image_path
                                ? (str_starts_with($gallery->image_path, '/') || preg_match('/^https?:/i', $gallery->image_path)
                                    ? $gallery->image_path
                                    : \Illuminate\Support\Facades\Storage::disk('public')->url($gallery->image_path))
                                : null;
                        @endphp
                        <tr>
                            <td>
                                @if ($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $gallery->title }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;">
                                @else
                                    <span style="color:#888;font-size:12px;">-</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $gallery->title }}</strong>
                                <small class="table-subtext">{{ Str::limit($gallery->caption, 60) ?: '-' }}</small>
                            </td>
                            <td>
                                <span class="content-status content-status-{{ $gallery->media_type === 'video' ? 'draft' : 'published' }}">
                                    {{ ucfirst($gallery->media_type) }}
                                </span>
                            </td>
                            <td>{{ $gallery->sort_order }}</td>
                            <td>
                                <span class="content-status content-status-{{ $gallery->is_published ? 'published' : 'draft' }}">
                                    {{ $gallery->is_published ? 'Dipublikasi' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}">Edit</a>
                                    @if ($gallery->instagram_url)
                                        <a href="{{ $gallery->instagram_url }}" target="_blank" rel="noopener">Instagram</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada galeri yang sesuai filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($galleries->hasPages())
            <nav class="pagination" aria-label="Navigasi halaman galeri">
                @if ($galleries->previousPageUrl())
                    <a href="{{ $galleries->previousPageUrl() }}">Sebelumnya</a>
                @endif
                <span>Halaman {{ $galleries->currentPage() }} dari {{ $galleries->lastPage() }}</span>
                @if ($galleries->nextPageUrl())
                    <a href="{{ $galleries->nextPageUrl() }}">Berikutnya</a>
                @endif
            </nav>
        @endif
    </section>
@endsection
