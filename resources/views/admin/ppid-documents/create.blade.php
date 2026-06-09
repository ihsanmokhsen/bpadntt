@extends('layouts.app')

@section('title', 'Tambah PPID - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Dokumen Baru</p>
            <h1>Tambah Dokumen PPID</h1>
            <p>Isi metadata, sumber file, dan status publikasi dokumen.</p>
        </div>
    </section>

    <section class="content-section">
        <form class="content-editor" method="post" action="{{ route('admin.ppid-documents.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.ppid-documents._form', ['submitLabel' => 'Simpan Dokumen'])
        </form>
    </section>
@endsection
