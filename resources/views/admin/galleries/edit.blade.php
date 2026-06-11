@extends('layouts.app')

@section('title', 'Edit Galeri - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Edit Galeri</p>
            <h1>{{ $gallery->title }}</h1>
            <p>Perubahan gambar dan caption akan langsung tampil di halaman Galeri publik.</p>
        </div>
        <span class="status-pill">{{ $gallery->is_published ? 'Dipublikasi' : 'Draft' }}</span>
    </section>

    <section class="content-section">
        <form class="content-editor" method="post" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('admin.galleries._form', ['submitLabel' => 'Simpan Perubahan'])
        </form>

        <form class="delete-panel" method="post" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Hapus galeri ini secara permanen?')">
            @csrf
            @method('delete')
            <div>
                <strong>Hapus galeri</strong>
                <p>Galeri yang dihapus tidak dapat dipulihkan dari dashboard.</p>
            </div>
            <button class="button button-danger" type="submit">Hapus Permanen</button>
        </form>
    </section>
@endsection
