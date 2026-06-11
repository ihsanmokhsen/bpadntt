@extends('layouts.app')

@section('title', 'Tambah Galeri - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Galeri Baru</p>
            <h1>Tambah Galeri</h1>
            <p>Upload foto atau tambahkan gambar dari Instagram untuk ditampilkan di halaman Galeri.</p>
        </div>
    </section>

    <section class="content-section">
        <form class="content-editor" method="post" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.galleries._form', ['submitLabel' => 'Simpan Galeri'])
        </form>
    </section>
@endsection
