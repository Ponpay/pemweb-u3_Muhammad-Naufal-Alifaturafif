@extends('layouts.app')

@section('title', $article->title)

@section('content')
<article class="card">
    <a href="{{ route('articles.index') }}" class="muted" style="font-size:13.5px;">&larr; Semua artikel</a>

    <h1 style="margin:14px 0 10px;">{{ $article->title }}</h1>

    <p class="news-meta" style="margin-bottom:0;">
        <span class="badge">{{ $article->user->name }}</span>
        <span class="sep">&bull;</span>
        <span>{{ $article->created_at->format('d M Y') }}</span>
    </p>

    <img class="article-hero-img"
         src="{{ $article->image_url }}"
         alt="Gambar untuk {{ $article->title }}">

    <div class="article-body">
        {!! nl2br(e($article->body)) !!}
    </div>

    <div class="article-footer">
        <a href="{{ route('home') }}" class="btn btn-ghost btn-sm">&larr; Kembali ke Home</a>
        <a href="{{ route('articles.index') }}" class="btn btn-ghost btn-sm">Lihat semua artikel</a>

        @auth
            @if ($article->user_id === auth()->id())
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm">Edit artikel ini</a>
            @endif
        @endauth
    </div>
</article>
@endsection
