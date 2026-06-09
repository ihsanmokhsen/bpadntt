@extends('layouts.app')

@section('title', 'Kelola PPID - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Dashboard Admin</p>
            <h1>Kelola Dokumen PPID</h1>
            <p>Dokumen publik, tautan drive, dan metadata PPID dikelola dari database Laravel.</p>
        </div>
        <a class="button" href="{{ route('admin.ppid-documents.create') }}">Tambah Dokumen</a>
    </section>

    <section class="content-section">
        @include('admin.partials.operator-guide', [
            'title' => 'Arti sumber dokumen PPID',
            'items' => [
                'Local: file diunggah dan disimpan langsung pada server website BPAD.',
                'Drive: dokumen disimpan di Google Drive dan website menggunakan tautan Drive.',
                'External: dokumen berada di website atau layanan lain di luar server BPAD dan Google Drive.',
                'Status Privat menyimpan dokumen di dashboard tanpa menampilkannya kepada publik.',
            ],
        ])

        <form class="filter-bar" method="get" action="{{ route('admin.ppid-documents.index') }}">
            <label>
                <span>Cari</span>
                <input name="search" value="{{ $search }}" placeholder="Judul atau deskripsi">
            </label>
            <label>
                <span>Kategori</span>
                <input name="category" value="{{ $category }}" placeholder="Contoh: Berkala">
            </label>
            <label>
                <span>Tahun</span>
                <input name="year" type="number" value="{{ $year }}" placeholder="2026">
            </label>
            <label>
                <span>Sumber</span>
                <select name="source">
                    <option value="">Semua sumber</option>
                    <option value="local" @selected($source === 'local')>Local - Server BPAD</option>
                    <option value="drive" @selected($source === 'drive')>Drive - Google Drive</option>
                    <option value="external" @selected($source === 'external')>External - Situs lain</option>
                </select>
            </label>
            <label>
                <span>Publik</span>
                <select name="status">
                    <option value="">Semua status</option>
                    <option value="public" @selected($status === 'public')>Publik</option>
                    <option value="private" @selected($status === 'private')>Privat</option>
                </select>
            </label>
            <button class="button" type="submit">Terapkan</button>
            <a class="button button-secondary" href="{{ route('admin.ppid-documents.index') }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Dokumen</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Sumber</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                            <td>
                                <strong>{{ $document->title }}</strong>
                                <small class="table-subtext">{{ $document->file_format }} · {{ $document->file_size ?: '-' }}</small>
                            </td>
                            <td>{{ $document->category }}</td>
                            <td>{{ $document->document_year }}</td>
                            <td>
                                {{ match ($document->source) {
                                    'local' => 'Local - Server BPAD',
                                    'drive' => 'Drive - Google Drive',
                                    'external' => 'External - Situs lain',
                                    default => ucfirst($document->source),
                                } }}
                            </td>
                            <td>
                                <span class="content-status content-status-{{ $document->is_public ? 'published' : 'draft' }}">
                                    {{ $document->is_public ? 'Publik' : 'Privat' }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.ppid-documents.edit', $document) }}">Edit</a>
                                    @if ($document->preview_url || $document->external_url || $document->file_path)
                                        <a href="{{ $document->preview_url ?: ($document->external_url ?: $document->file_path) }}" target="_blank" rel="noopener">Lihat</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada dokumen PPID yang sesuai filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($documents->hasPages())
            <nav class="pagination" aria-label="Navigasi halaman dokumen PPID">
                @if ($documents->previousPageUrl())
                    <a href="{{ $documents->previousPageUrl() }}">Sebelumnya</a>
                @endif
                <span>Halaman {{ $documents->currentPage() }} dari {{ $documents->lastPage() }}</span>
                @if ($documents->nextPageUrl())
                    <a href="{{ $documents->nextPageUrl() }}">Berikutnya</a>
                @endif
            </nav>
        @endif
    </section>
@endsection
