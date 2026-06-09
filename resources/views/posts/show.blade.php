@extends('layouts.app')

@section('title', $post->title . ' - BPAD NTT')

@section('content')
    <article class="post-detail">
        <p class="eyebrow">{{ $post->category ?: ucfirst($post->type) }}</p>
        <h1>{{ $post->title }}</h1>
        <p class="post-meta">{{ optional($post->published_at)->translatedFormat('d F Y, H:i') }}</p>

        @if ($post->cover_image_path)
            <img src="{{ $post->cover_image_path }}" alt="{{ $post->title }}">
        @endif

        <p class="lead">{{ $post->summary }}</p>
        <div class="article-body">{!! nl2br(e($post->content)) !!}</div>
    </article>
@endsection
