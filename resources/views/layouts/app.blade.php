<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @php
        $siteName = ($settings ?? collect())->get('site.name', config('app.name'));
        $siteShortName = ($settings ?? collect())->get('site.short_name', 'BPAD NTT');
        $siteTagline = ($settings ?? collect())->get('site.tagline', 'Melayani dengan transparan dan akuntabel');
        $copyrightYear = ($settings ?? collect())->get('site.copyright_year', now()->year);
    @endphp

    <header class="site-header">
        <a class="brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo BPAD NTT" loading="lazy">
            <span>
                <strong>{{ $siteShortName }}</strong>
                <small>{{ $siteTagline }}</small>
            </span>
        </a>

        <nav aria-label="Navigasi utama">
            <a href="{{ route('home') }}">Beranda</a>
            @auth
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.settings.edit') }}">Pengaturan</a>
                <a href="{{ route('admin.posts.index') }}">Konten</a>
                <a href="{{ route('admin.ppid-documents.index') }}">PPID</a>
                <form method="post" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}">Admin</a>
            @endauth
        </nav>
    </header>

    @if (app()->environment('local'))
        <div class="local-banner">
            Lingkungan lokal Laravel aktif. Website lama tidak terpengaruh.
        </div>
    @endif

    <main>
        @if (session('success'))
            <div class="flash-message">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ $copyrightYear }} {{ $siteName }}</p>
    </footer>
</body>
</html>
