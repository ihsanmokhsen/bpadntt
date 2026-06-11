@php
    $imgUrl = null;
    if ($gallery->image_path) {
        $imgUrl = str_starts_with($gallery->image_path, '/') || preg_match('/^https?:/i', $gallery->image_path)
            ? $gallery->image_path
            : \Illuminate\Support\Facades\Storage::disk('public')->url($gallery->image_path);
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

<div class="editor-layout">
    <div class="form-panel">
        <label>
            <span>Judul</span>
            <input name="title" value="{{ old('title', $gallery->title) }}" maxlength="200" required placeholder="Contoh: Kunjungan Kepala Daerah">
            <small>Judul singkat yang menjelaskan isi foto atau gambar.</small>
        </label>

        <label>
            <span>Caption</span>
            <textarea name="caption" rows="4" placeholder="Deskripsi atau keterangan foto...">{{ old('caption', $gallery->caption) }}</textarea>
            <small>Keterangan yang ditampilkan di bawah foto pada halaman Galeri.</small>
        </label>

        <label>
            <span>URL Gambar (opsional)</span>
            <input name="image_path_url" value="{{ old('image_path_url', $gallery->image_path) }}" maxlength="2000" placeholder="/assets/instagram-01.jpg atau https://...">
            <small>Isi URL jika menggunakan gambar yang sudah ada. Untuk upload baru, gunakan kolom di sebelah kanan.</small>
        </label>

        <label>
            <span>Tautan Instagram (opsional)</span>
            <input name="instagram_url" type="url" value="{{ old('instagram_url', $gallery->instagram_url) }}" maxlength="2000" placeholder="https://www.instagram.com/p/...">
            <small>Link ke postingan Instagram asli jika foto ini berasal dari akun Instagram BPAD NTT.</small>
        </label>
    </div>

    <aside class="form-panel form-sidebar">
        <label>
            <span>Tipe Media</span>
            <select name="media_type">
                <option value="photo" @selected(old('media_type', $gallery->media_type) === 'photo')>Foto</option>
                <option value="video" @selected(old('media_type', $gallery->media_type) === 'video')>Video</option>
            </select>
            <small>Pilih Video jika gambar ini merupakan thumbnail dari konten video.</small>
        </label>

        <label>
            <span>Upload Gambar</span>
            <input name="image_file" type="file" accept="image/jpeg,image/jpg,image/png,image/webp">
            <small>Format: JPG, PNG, WebP. Maksimal 5 MB.</small>
        </label>

        <label>
            <span>Urutan Tampil</span>
            <input name="sort_order" type="number" value="{{ old('sort_order', $gallery->sort_order) }}" min="0" max="9999">
            <small>Angka lebih kecil ditampilkan lebih dahulu. Gunakan 0 jika tidak membutuhkan urutan khusus.</small>
        </label>

        <label class="inline-check">
            <input name="is_published" type="checkbox" value="1" @checked(old('is_published', $gallery->is_published))>
            <span>Dipublikasi di halaman Galeri</span>
        </label>
        <small class="standalone-help">Hilangkan centang untuk menyimpan sebagai draft yang tidak ditampilkan ke publik.</small>

        @if ($imgUrl)
            <div class="cover-preview-admin">
                <span>Gambar saat ini</span>
                <img src="{{ $imgUrl }}" alt="{{ $gallery->title }}" style="width:100%;max-height:200px;object-fit:cover;border-radius:8px;">
                @if (! str_starts_with($gallery->image_path, '/') && ! preg_match('/^https?:/i', $gallery->image_path))
                    <label class="inline-check">
                        <input name="remove_image" type="checkbox" value="1">
                        <span>Hapus gambar saat menyimpan</span>
                    </label>
                @endif
            </div>
        @endif
    </aside>
</div>

<div class="editor-actions">
    <button class="button" type="submit">{{ $submitLabel }}</button>
    <a class="button button-secondary" href="{{ route('admin.galleries.index') }}">Kembali</a>
</div>
