@php
    $coverUrl = null;
    if ($post->cover_image_path) {
        $coverUrl = str_starts_with($post->cover_image_path, '/') || preg_match('/^https?:/i', $post->cover_image_path)
            ? $post->cover_image_path
            : \Illuminate\Support\Facades\Storage::disk('public')->url($post->cover_image_path);
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
    'title' => 'Petunjuk pengisian konten',
    'items' => [
        'Simpan sebagai Draft jika konten masih perlu diperiksa.',
        'Slug URL boleh dikosongkan karena sistem akan membuatnya otomatis dari judul.',
        'Ringkasan tampil sebagai pengantar singkat, sedangkan Isi Konten memuat informasi lengkap.',
        'Gunakan salah satu sumber cover: upload gambar atau URL gambar.',
    ],
])

<div class="editor-layout">
    <div class="form-panel">
        <div class="form-grid">
            <label>
                <span>Tipe konten</span>
                <select name="type" required>
                    <option value="berita" @selected(old('type', $post->type) === 'berita')>Berita</option>
                    <option value="pengumuman" @selected(old('type', $post->type) === 'pengumuman')>Pengumuman</option>
                    <option value="agenda" @selected(old('type', $post->type) === 'agenda')>Agenda</option>
                </select>
                <small>Pilih lokasi konten akan ditampilkan: berita, pengumuman, atau agenda.</small>
            </label>

            <label>
                <span>Status</span>
                <select name="status" required>
                    <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $post->status) === 'published')>Terbit</option>
                </select>
                <small>Draft belum terlihat publik. Terbit akan menampilkan konten sesuai tanggal publikasi.</small>
            </label>
        </div>

        <label>
            <span>Judul</span>
            <input name="title" value="{{ old('title', $post->title) }}" maxlength="200" required>
            <small>Gunakan judul yang ringkas dan mudah dipahami pengunjung.</small>
        </label>

        <div class="form-grid">
            <label>
                <span>Slug URL</span>
                <input name="slug" value="{{ old('slug', $post->slug) }}" maxlength="220" placeholder="Otomatis dari judul jika kosong">
                <small>Bagian alamat halaman setelah domain. Kosongkan untuk dibuat otomatis.</small>
            </label>
            <label>
                <span>Kategori</span>
                <input name="category" value="{{ old('category', $post->category) }}" maxlength="80" placeholder="Contoh: Kegiatan">
                <small>Kelompok topik untuk membantu pengunjung mengenali isi konten.</small>
            </label>
        </div>

        <label>
            <span>Ringkasan</span>
            <textarea name="summary" rows="4" maxlength="2000">{{ old('summary', $post->summary) }}</textarea>
            <small>Ringkasan pendek yang dapat tampil pada kartu atau daftar konten.</small>
        </label>

        <label>
            <span>Isi konten</span>
            <textarea name="content" rows="12">{{ old('content', $post->content) }}</textarea>
            <small>Tulis informasi lengkap yang akan dibaca pengunjung.</small>
        </label>
    </div>

    <aside class="form-panel form-sidebar">
        <label>
            <span>Tanggal publikasi</span>
            <input name="published_at" type="datetime-local" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
            <small>Menentukan waktu konten mulai dianggap terbit.</small>
        </label>

        <label>
            <span>Upload cover</span>
            <input name="cover_image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
            <small>JPG, PNG, atau WEBP. Maksimal 6 MB.</small>
        </label>

        <label>
            <span>Atau URL cover</span>
            <input name="cover_image_url" type="url" value="{{ old('cover_image_url') }}" placeholder="https://...">
            <small>Gunakan jika gambar berasal dari internet. Upload cover lebih disarankan untuk kestabilan.</small>
        </label>

        @if ($coverUrl)
            <div class="cover-preview-admin">
                <span>Cover saat ini</span>
                <img src="{{ $coverUrl }}" alt="Cover {{ $post->title }}">
                <label class="inline-check">
                    <input name="remove_cover" type="checkbox" value="1">
                    <span>Hapus cover saat disimpan</span>
                </label>
            </div>
        @endif

        <div class="editor-help">
            <strong>Catatan publikasi</strong>
            <p>Draft tidak tampil di website. Pilih Terbit agar konten muncul setelah tanggal publikasi.</p>
        </div>
    </aside>
</div>

<div class="editor-actions">
    <button class="button" type="submit">{{ $submitLabel }}</button>
    <a class="button button-secondary" href="{{ route('admin.posts.index') }}">Kembali</a>
</div>
