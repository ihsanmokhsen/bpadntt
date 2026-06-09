@extends('layouts.app')

@section('title', 'Beranda - BPAD NTT')

@section('content')
    <section class="welcome-band">
        <div>
            <p class="eyebrow">Fondasi aplikasi baru</p>
            <h1>{{ $settings->get('site.name', 'Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur') }}</h1>
            <p>{{ $settings->get('site.tagline', 'Melayani dengan transparan dan akuntabel') }}</p>
        </div>
        <div class="architecture">
            <strong>Arsitektur aktif</strong>
            <span>Laravel</span>
            <span>PostgreSQL siap melalui Docker</span>
            <span>Session admin Laravel</span>
        </div>
    </section>

    <section class="content-section">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Data aplikasi</p>
                <h2>Konten BPAD</h2>
            </div>
            <a class="button" href="{{ route('login') }}">Buka Admin</a>
        </div>

        <div class="metric-grid">
            <article><strong>{{ $counts['berita'] }}</strong><span>Berita</span></article>
            <article><strong>{{ $counts['pengumuman'] }}</strong><span>Pengumuman</span></article>
            <article><strong>{{ $counts['agenda'] }}</strong><span>Agenda</span></article>
            <article><strong>{{ $counts['ppid'] }}</strong><span>Dokumen PPID</span></article>
        </div>
    </section>

    <section class="content-section">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Publikasi</p>
                <h2>Berita terbaru</h2>
            </div>
        </div>

        <div class="post-grid">
            @forelse ($latestPosts as $post)
                <article class="post-card">
                    <p class="post-meta">{{ $post->category ?: 'Berita' }} · {{ optional($post->published_at)->translatedFormat('d M Y') }}</p>
                    <h3><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                    <p>{{ $post->summary }}</p>
                </article>
            @empty
                <div class="empty-state">
                    Belum ada berita di database Laravel. Data Supabase akan diimpor pada tahap migrasi berikutnya.
                </div>
            @endforelse
        </div>
    </section>
@endsection
