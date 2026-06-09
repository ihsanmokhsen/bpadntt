@extends('layouts.app')

@section('title', 'Login Admin - BPAD NTT')

@section('content')
    <section class="auth-wrap">
        <div class="auth-copy">
            <p class="eyebrow">Administrasi website</p>
            <h1>Masuk ke dashboard BPAD</h1>
            <p>Sesi, validasi, pembatasan percobaan login, dan perlindungan CSRF sekarang ditangani oleh Laravel.</p>
        </div>

        <form class="auth-form" method="post" action="{{ route('login.store') }}">
            @csrf

            <label for="username">Username</label>
            <input id="username" name="username" value="{{ old('username') }}" autocomplete="username" required autofocus>
            @error('username')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label class="check-row">
                <input name="remember" type="checkbox" value="1">
                <span>Ingat sesi login</span>
            </label>

            <button class="button" type="submit">Masuk</button>
        </form>
    </section>
@endsection
