@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="dash-head">
    <div>
        <p class="dash-eyebrow">Dashboard</p>
        <h1 style="font-size:24px; margin:2px 0 4px;">Halo, {{ $user->name }}</h1>
        <p class="muted" style="margin:0; font-size:13.5px;">Ringkasan aktivitas artikel kamu di Nusa News.</p>
    </div>
    <a href="{{ route('articles.create') }}" class="btn btn-pill">+ Artikel Baru</a>
</section>

<section class="stat-grid">
    <div class="stat-card">
        <div class="stat-ico" style="background:#eef0fe; color:#4f46e5;">&#128196;</div>
        <div>
            <div class="stat-lbl">Total Artikel</div>
            <div class="stat-value">{{ $totalArticles }}</div>
            <div class="stat-sub">Seluruh artikel di sistem</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-ico" style="background:#ecfdf5; color:#059669;">&#9998;</div>
        <div>
            <div class="stat-lbl">Artikel Kamu</div>
            <div class="stat-value">{{ $myArticles }}</div>
            <div class="stat-sub">Ditulis oleh akun ini</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-ico" style="background:#eff6ff; color:#0284c7;">&#128100;</div>
        <div>
            <div class="stat-lbl">Kontribusi</div>
            <div class="stat-value">
                {{ $totalArticles > 0 ? round($myArticles / $totalArticles * 100) : 0 }}<span style="font-size:16px;">%</span>
            </div>
            <div class="stat-sub">Porsi dari total artikel</div>
        </div>
    </div>
</section>

<div class="dash-cols">
    <section class="card">
        <div class="list-head" style="margin-bottom:4px;">
            <h3 style="margin:0; font-size:15px;">Artikel Terbaru</h3>
            <a href="{{ route('articles.index') }}" class="muted" style="font-size:13px;">Semua &rarr;</a>
        </div>

        @if ($latestArticles->isNotEmpty())
            <ul class="mini-list">
                @foreach ($latestArticles as $article)
                    <li>
                        <img src="{{ $article->image_url }}" alt="" loading="lazy">
                        <div style="min-width:0;">
                            <a href="{{ route('articles.show', $article) }}" class="mini-title">
                                {{ $article->title }}
                            </a>
                            <div class="mini-meta">
                                {{ $article->user->name }} &middot; {{ $article->created_at->format('d M Y') }}
                                @if ($article->user_id === $user->id)
                                    <span class="badge" style="font-size:10px; padding:1px 7px;">milikmu</span>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="muted" style="font-size:13.5px;">Belum ada artikel yang bisa ditampilkan.</p>
        @endif
    </section>

    <div>
        <section class="card">
            <h3 style="margin:0 0 10px; font-size:15px;">Aksi Cepat</h3>
            <ul class="quick-actions">
                <li><a href="{{ route('articles.create') }}"><span class="qa-ico">+</span> Tambah Artikel</a></li>
                <li><a href="{{ route('articles.index') }}"><span class="qa-ico">&#9776;</span> Semua Artikel</a></li>
                <li><a href="{{ route('home') }}"><span class="qa-ico">&#8962;</span> Halaman Home</a></li>
            </ul>
        </section>

        <section class="card" style="margin-top:18px;">
            <h3 style="margin:0 0 12px; font-size:15px;">Info Akun</h3>
            <div class="info-row">
                <span class="info-lbl">Nama</span>
                <span class="info-val">{{ $user->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Email</span>
                <span class="info-val">{{ $user->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Terdaftar</span>
                <span class="info-val">{{ $user->created_at?->format('d M Y') ?? '—' }}</span>
            </div>
        </section>
    </div>
</div>
@endsection
