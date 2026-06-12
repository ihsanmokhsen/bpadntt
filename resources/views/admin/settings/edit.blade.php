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
                                            step="any"
                                        @endif
                                        @if (!empty($field['format']))
                                            data-format="{{ $field['format'] }}"
                                        @endif
                                    >
                                    @if (!empty($field['format']) && $field['format'] === 'currency')
                                        <span class="currency-preview" data-for="{{ $field['name'] }}">Rp 0</span>
                                    @elseif (!empty($field['format']) && $field['format'] === 'percent')
                                        <span class="currency-preview" data-for="{{ $field['name'] }}">0%</span>
                                    @endif
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

    <script>
    (function () {
        function formatRupiah(num) {
            if (!num || isNaN(num)) return 'Rp 0';
            var abs = Math.abs(num);
            if (abs >= 1e12) return 'Rp ' + (num / 1e12).toFixed(2).replace('.', ',') + ' T';
            if (abs >= 1e9) return 'Rp ' + (num / 1e9).toFixed(2).replace('.', ',') + ' M';
            if (abs >= 1e6) return 'Rp ' + (num / 1e6).toFixed(2).replace('.', ',') + ' Jt';
            return 'Rp ' + num.toLocaleString('id-ID');
        }

        function formatPercent(num) {
            if (!num || isNaN(num)) return '0%';
            return num.toLocaleString('id-ID', {maximumFractionDigits: 2}) + '%';
        }

        function updatePreview(input) {
            var fmt = input.dataset.format;
            var name = input.name;
            var preview = document.querySelector('.currency-preview[data-for="' + name + '"]');
            if (!preview) return;
            var val = parseFloat(input.value);
            if (fmt === 'currency') preview.textContent = formatRupiah(val);
            else if (fmt === 'percent') preview.textContent = formatPercent(val);
        }

        document.querySelectorAll('input[data-format]').forEach(function (input) {
            updatePreview(input);
            input.addEventListener('input', function () { updatePreview(input); });
            input.addEventListener('change', function () { updatePreview(input); });
        });
    })();
    </script>
@endsection
