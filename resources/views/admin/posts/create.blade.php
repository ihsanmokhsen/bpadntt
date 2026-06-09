@extends('layouts.app')

@section('title', 'Tambah Konten - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Konten Baru</p>
            <h1>Tambah Konten Website</h1>
            <p>Isi konten, simpan sebagai draft, atau langsung terbitkan.</p>
        </div>
    </section>

    <section class="content-section">
        <form class="content-editor" method="post" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.posts._form', ['submitLabel' => 'Simpan Konten'])
        </form>
    </section>
@endsection
