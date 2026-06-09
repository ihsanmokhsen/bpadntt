@extends('layouts.app')

@section('title', 'Kelola Konten - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Dashboard Admin</p>
            <h1>Kelola Konten Website</h1>
            <p>Berita, pengumuman, dan agenda dikelola langsung melalui Laravel.</p>
        </div>
        <a class="button" href="{{ route('admin.posts.create') }}">Tambah Konten</a>
    </section>

    <section class="content-section">
        @include('admin.partials.operator-guide', [
            'title' => 'Mengelola konten',
            'items' => [
                'Berita berisi publikasi kegiatan atau informasi terbaru.',
                'Pengumuman berisi pemberitahuan resmi, sedangkan Agenda berisi jadwal kegiatan.',
                'Konten berstatus Draft belum tampil untuk pengunjung. Pilih Terbit agar tampil di website.',
            ],
        ])

        <form class="filter-bar" method="get" action="{{ route('admin.posts.index') }}">
            <label>
                <span>Cari</span>
                <input name="search" value="{{ $search }}" placeholder="Judul atau kategori">
            </label>
            <label>
                <span>Tipe</span>
                <select name="type">
                    <option value="">Semua tipe</option>
                    <option value="berita" @selected($type === 'berita')>Berita</option>
                    <option value="pengumuman" @selected($type === 'pengumuman')>Pengumuman</option>
                    <option value="agenda" @selected($type === 'agenda')>Agenda</option>
                </select>
            </label>
            <label>
                <span>Status</span>
                <select name="status">
                    <option value="">Semua status</option>
                    <option value="published" @selected($status === 'published')>Terbit</option>
                    <option value="draft" @selected($status === 'draft')>Draft</option>
                </select>
            </label>
            <button class="button" type="submit">Terapkan</button>
            <a class="button button-secondary" href="{{ route('admin.posts.index') }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Publikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>
                                <strong>{{ $post->title }}</strong>
                                <small class="table-subtext">{{ $post->slug }}</small>
                            </td>
                            <td>{{ ucfirst($post->type) }}</td>
                            <td>
                                <span class="content-status content-status-{{ $post->status }}">
                                    {{ $post->status === 'published' ? 'Terbit' : 'Draft' }}
                                </span>
                            </td>
                            <td>{{ $post->published_at?->format('d-m-Y H:i') ?: '-' }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                                    @if ($post->status === 'published')
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank" rel="noopener">Lihat</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Belum ada konten yang sesuai filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <nav class="pagination" aria-label="Navigasi halaman konten">
                @if ($posts->previousPageUrl())
                    <a href="{{ $posts->previousPageUrl() }}">Sebelumnya</a>
                @endif
                <span>Halaman {{ $posts->currentPage() }} dari {{ $posts->lastPage() }}</span>
                @if ($posts->nextPageUrl())
                    <a href="{{ $posts->nextPageUrl() }}">Berikutnya</a>
                @endif
            </nav>
        @endif
    </section>
@endsection
