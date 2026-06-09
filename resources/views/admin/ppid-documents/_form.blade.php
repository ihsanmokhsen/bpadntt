@php
    $storedFileUrl = null;
    if ($document->file_path) {
        $storedFileUrl = str_starts_with($document->file_path, '/') || preg_match('/^https?:/i', $document->file_path)
            ? $document->file_path
            : \Illuminate\Support\Facades\Storage::disk('public')->url($document->file_path);
    }
@endphp

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

@include('admin.partials.operator-guide', [
    'title' => 'Cara memilih Sumber Dokumen',
    'items' => [
        'Pilih Local jika operator mengunggah file melalui kolom Upload File.',
        'Pilih Drive jika file berada di Google Drive, lalu isi tautannya pada kolom File Lokal / URL Drive.',
        'Pilih External jika file atau halaman dokumen berada pada website lain, lalu isi URL Eksternal.',
        'URL Preview bersifat opsional dan digunakan jika alamat untuk melihat dokumen berbeda dari alamat unduhan.',
    ],
])

<div class="editor-layout">
    <div class="form-panel">
        <div class="form-grid">
            <label>
                <span>Kategori</span>
                <input name="category" value="{{ old('category', $document->category) }}" maxlength="100" list="ppidCategoryOptions" placeholder="Contoh: Berkala" required>
                <datalist id="ppidCategoryOptions">
                    <option value="Berkala"></option>
                    <option value="Setiap Saat"></option>
                    <option value="Serta Merta"></option>
                    <option value="Dikecualikan"></option>
                    <option value="DIP"></option>
                    <option value="SOP"></option>
                    <option value="Profil PPID"></option>
                    <option value="Laporan Layanan Informasi"></option>
                </datalist>
                <small>Kelompok layanan informasi publik tempat dokumen ditampilkan.</small>
            </label>
            <label>
                <span>Tahun Dokumen</span>
                <input name="document_year" type="number" value="{{ old('document_year', $document->document_year) }}" min="1900" max="{{ now()->year + 5 }}" required>
                <small>Tahun penerbitan atau periode yang dibahas dokumen.</small>
            </label>
        </div>

        <label>
            <span>Judul Dokumen</span>
            <input name="title" value="{{ old('title', $document->title) }}" maxlength="200" required>
            <small>Nama dokumen yang akan terlihat oleh pengunjung.</small>
        </label>

        <div class="form-grid">
            <label>
                <span>Format File</span>
                <input name="file_format" value="{{ old('file_format', $document->file_format) }}" maxlength="20" placeholder="PDF" required>
                <small>Contoh: PDF, DOCX, XLSX, JPG.</small>
            </label>
            <label>
                <span>Ukuran File</span>
                <input name="file_size" value="{{ old('file_size', $document->file_size) }}" maxlength="50" placeholder="2.4 MB">
                <small>Informasi ukuran untuk pengunjung, contoh: 2.4 MB.</small>
            </label>
        </div>

        <label>
            <span>Deskripsi</span>
            <textarea name="description" rows="6">{{ old('description', $document->description) }}</textarea>
            <small>Jelaskan isi atau kegunaan dokumen secara singkat.</small>
        </label>

        <label>
            <span>File Lokal / URL Drive</span>
            <input name="file_path_url" value="{{ old('file_path_url', $document->file_path) }}" maxlength="2000" placeholder="Upload file atau isi URL Google Drive">
            <small>Isi tautan Google Drive jika sumbernya Drive. Untuk Local, gunakan Upload File di sebelah kanan.</small>
        </label>

        <div class="form-grid">
            <label>
                <span>URL Eksternal</span>
                <input name="external_url" type="url" value="{{ old('external_url', $document->external_url) }}" maxlength="2000" placeholder="https://...">
                <small>Alamat dokumen pada situs lain jika sumber dipilih External.</small>
            </label>
            <label>
                <span>URL Preview</span>
                <input name="preview_url" type="url" value="{{ old('preview_url', $document->preview_url) }}" maxlength="2000" placeholder="https://...">
                <small>Opsional: alamat khusus untuk melihat dokumen sebelum diunduh.</small>
            </label>
        </div>
    </div>

    <aside class="form-panel form-sidebar">
        <label>
            <span>Sumber Dokumen</span>
            <select name="source" required>
                <option value="local" @selected(old('source', $document->source) === 'local')>Local - Server BPAD</option>
                <option value="drive" @selected(old('source', $document->source) === 'drive')>Drive - Google Drive</option>
                <option value="external" @selected(old('source', $document->source) === 'external')>External - Situs lain</option>
            </select>
            <small>Menunjukkan lokasi asli tempat file dokumen disimpan.</small>
        </label>

        <label>
            <span>Upload File</span>
            <input name="document_file" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,image/*,application/pdf">
            <small>Ukuran maksimal 25 MB.</small>
        </label>

        <label>
            <span>Urutan Tampil</span>
            <input name="sort_order" type="number" value="{{ old('sort_order', $document->sort_order) }}" min="0" max="9999">
            <small>Angka lebih kecil ditampilkan lebih dahulu. Gunakan 0 jika tidak membutuhkan urutan khusus.</small>
        </label>

        <label>
            <span>Tanggal Publikasi</span>
            <input name="published_at" type="datetime-local" value="{{ old('published_at', $document->published_at?->format('Y-m-d\TH:i')) }}">
            <small>Tanggal yang ditampilkan sebagai waktu publikasi dokumen.</small>
        </label>

        <label class="inline-check">
            <input name="is_public" type="checkbox" value="1" @checked(old('is_public', $document->is_public))>
            <span>Dokumen tampil di website publik</span>
        </label>
        <small class="standalone-help">Hilangkan centang untuk menyimpan dokumen sebagai arsip privat di dashboard.</small>

        @if ($storedFileUrl || $document->external_url || $document->preview_url)
            <div class="cover-preview-admin">
                <span>Referensi saat ini</span>
                @if ($storedFileUrl)
                    <a href="{{ $storedFileUrl }}" target="_blank" rel="noopener">{{ $storedFileUrl }}</a>
                @endif
                @if ($document->external_url)
                    <a href="{{ $document->external_url }}" target="_blank" rel="noopener">External: {{ $document->external_url }}</a>
                @endif
                @if ($document->preview_url)
                    <a href="{{ $document->preview_url }}" target="_blank" rel="noopener">Preview: {{ $document->preview_url }}</a>
                @endif
                @if ($storedFileUrl && ! str_starts_with($document->file_path, '/') && ! preg_match('/^https?:/i', $document->file_path))
                    <label class="inline-check">
                        <input name="remove_file" type="checkbox" value="1">
                        <span>Hapus file lokal saat menyimpan</span>
                    </label>
                @endif
            </div>
        @endif

        <div class="editor-help">
            <strong>Catatan publikasi</strong>
            <p>Isi `file_path_url` untuk tautan Drive atau biarkan kosong jika file diunggah ke storage publik.</p>
        </div>
    </aside>
</div>

<div class="editor-actions">
    <button class="button" type="submit">{{ $submitLabel }}</button>
    <a class="button button-secondary" href="{{ route('admin.ppid-documents.index') }}">Kembali</a>
</div>
