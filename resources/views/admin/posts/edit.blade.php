@extends('layouts.app')

@section('title', 'Edit Konten - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Edit Konten</p>
            <h1>{{ $post->title }}</h1>
            <p>Perubahan yang disimpan langsung digunakan oleh halaman publik Laravel.</p>
        </div>
        <span class="status-pill">{{ $post->status === 'published' ? 'Terbit' : 'Draft' }}</span>
    </section>

    <section class="content-section">
        <form class="content-editor" method="post" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('admin.posts._form', ['submitLabel' => 'Simpan Perubahan'])
        </form>

        <form class="delete-panel" method="post" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Hapus konten ini secara permanen?')">
            @csrf
            @method('delete')
            <div>
                <strong>Hapus konten</strong>
                <p>Konten yang dihapus tidak dapat dipulihkan dari dashboard.</p>
            </div>
            <button class="button button-danger" type="submit">Hapus Permanen</button>
        </form>
    </section>
@endsection
