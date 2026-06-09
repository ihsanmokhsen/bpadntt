@extends('layouts.app')

@section('title', 'Edit PPID - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Edit Dokumen</p>
            <h1>{{ $document->title }}</h1>
            <p>Perubahan metadata dan tautan dokumen akan langsung dipakai di halaman publik PPID.</p>
        </div>
        <span class="status-pill">{{ $document->is_public ? 'Publik' : 'Privat' }}</span>
    </section>

    <section class="content-section">
        <form class="content-editor" method="post" action="{{ route('admin.ppid-documents.update', $document) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('admin.ppid-documents._form', ['submitLabel' => 'Simpan Perubahan'])
        </form>

        <form class="delete-panel" method="post" action="{{ route('admin.ppid-documents.destroy', $document) }}" onsubmit="return confirm('Hapus dokumen ini secara permanen?')">
            @csrf
            @method('delete')
            <div>
                <strong>Hapus dokumen</strong>
                <p>Dokumen yang dihapus tidak dapat dipulihkan dari dashboard.</p>
            </div>
            <button class="button button-danger" type="submit">Hapus Permanen</button>
        </form>
    </section>
@endsection
