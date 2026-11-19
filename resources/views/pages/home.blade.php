@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero">
    <span class="hero-chip"><span class="pulse"></span> Live &middot; Portal Berita</span>

    <h1 style="font-size:29px; max-width:560px; line-height:1.22; margin-bottom:10px;">Berita terkini, dalam satu tempat.</h1>
    <p>Portal berita sederhana berbasis Laravel. Seluruh berita di bawah dibaca langsung dari tabel <code style="background:rgba(255,255,255,.2);color:#fff;">articles</code>.</p>

    @guest
        <div class="hero-actions">
            <a href="{{ route('login') }}" class="btn btn-white btn-pill">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-white btn-pill">Buat akun</a>
        </div>
    @endguest

    @auth
        <div class="hero-actions">
            <a href="{{ route('articles.create') }}" class="btn btn-white btn-pill">+ Tulis berita</a>
            <a href="{{ route('articles.index') }}" class="btn btn-white btn-pill">Kelola artikel</a>
        </div>
    @endauth

    <div class="hero-stats">
        <div>
            <div class="st-num">{{ $articles->count() }}</div>
            <div class="st-lbl">Berita terbaru</div>
        </div>
        <div>
            <div class="st-num">{{ $articles->unique('user_id')->count() }}</div>
            <div class="st-lbl">Penulis aktif</div>
        </div>
        <div>
            <div class="st-num">{{ $articles->max('created_at') ? $articles->max('created_at')->format('d M') : '—' }}</div>
            <div class="st-lbl">Update terakhir</div>
        </div>
    </div>
</section>

<section style="margin-top:24px;">
    <div class="list-head" style="margin-bottom:0;">
        <div>
            <h2 style="margin:0; font-size:19px;">Berita Terbaru</h2>
            <p class="muted" style="margin:2px 0 0; font-size:13px;">Pilihan terbaru dari seluruh penulis.</p>
        </div>
        <a href="{{ route('articles.index') }}" class="btn btn-ghost btn-pill btn-sm">Lihat semua &rarr;</a>
    </div>

    @if ($articles->isNotEmpty())
        <div class="news-grid">
            @foreach ($articles as $article)
                <article class="news-card">
                    <img class="news-thumb"
                         src="{{ $article->image_url }}"
                         alt="Gambar {{ $article->title }}"
                         loading="lazy">

                    <div class="news-body">
                        <h4 class="news-title">
                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        </h4>

                        <p class="news-meta">
                            <span class="avatar" style="width:18px;height:18px;font-size:9px;">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($article->user->name,0,1)) }}</span>
                            <span>{{ $article->user->name }}</span>
                            <span class="sep">&bull;</span>
                            <span>{{ $article->created_at->format('d M Y') }}</span>
                        </p>

                        <p class="news-excerpt">
                            {{ \Illuminate\Support\Str::limit($article->body, 130) }}
                        </p>

                        <a href="{{ route('articles.show', $article) }}" class="read-more">
                            Baca selengkapnya <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="card" style="text-align:center; padding: 40px 0; margin-top:16px;">
            <p class="muted" style="margin:0 0 14px;">Belum ada berita yang tersedia.</p>
            @auth
                <a href="{{ route('articles.create') }}" class="btn">+ Tulis berita pertama</a>
            @endauth
        </div>
    @endif
</section>
@endsection
