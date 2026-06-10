@extends('layouts.app')

@section('title', 'Pengaturan Website - BPAD NTT')

@section('content')
    <section class="admin-heading">
        <div>
            <p class="eyebrow">Web Setting</p>
            <h1>Pengaturan Website</h1>
            <p>Kelola identitas situs, kontak resmi, dan tautan layanan dari satu tempat.</p>
        </div>
        <span class="status-pill">{{ $count }} pengaturan aktif</span>
    </section>

    <section class="content-section">
        @include('admin.partials.operator-guide', [
            'title' => 'Pengaturan ini memengaruhi halaman publik',
            'items' => [
                'Isi URL lengkap dengan awalan https:// untuk media sosial dan formulir PPID.',
                'Path gambar lokal dapat ditulis seperti /assets/nama-gambar.png.',
                'Periksa beranda dan halaman PPID setelah menyimpan perubahan.',
            ],
        ])

        <form class="content-editor" method="post" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('put')

            @if ($errors->any())
                <div class="validation-errors">
                    <strong>Periksa kembali isian berikut:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="settings-grid">
                @foreach ($sections as $section)
                    <section class="form-panel">
                        <div class="section-heading">
                            <div>
                                <p class="eyebrow">{{ $section['title'] }}</p>
                                <h2>{{ $section['description'] }}</h2>
                            </div>
                        </div>

                        <div class="form-grid form-grid-settings">
                            @foreach ($section['fields'] as $field)
                                <label class="setting-field">
                                    <span>{{ $field['label'] }}</span>
                                    <input
                                        name="{{ $field['name'] }}"
                                        type="{{ $field['type'] }}"
                                        value="{{ old($field['name'], $values[$field['name']] ?? '') }}"
                                        placeholder="{{ $field['placeholder'] }}"
                                        @if ($field['type'] === 'number')
                                            inputmode="numeric"
                                        @endif
                                    >
                                    <small>{{ $field['help'] }}</small>
                                </label>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>

            <div class="editor-actions">
                <button class="button" type="submit">Simpan Pengaturan</button>
                <button class="button button-secondary" form="reset-defaults-form" type="submit">Isi Default Pengaturan</button>
                <a class="button button-secondary" href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
            </div>
        </form>

        <form id="reset-defaults-form" method="post" action="{{ route('admin.settings.reset') }}" onsubmit="return confirm('Apakah kamu yakin ingin mengembalikan semua pengaturan ke nilai default?');">
            @csrf
        </form>
    </section>
@endsection
