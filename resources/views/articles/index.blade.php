@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<section class="card">
    <div class="list-head">
        <div>
            <h2>Daftar Artikel</h2>
            <p class="muted" style="margin:0;">{{ $articles->total() }} artikel tersedia.</p>
        </div>
        <a href="{{ route('articles.create') }}" class="btn">+ Artikel Baru</a>
    </div>

    @if (session('success'))
        <div class="flash" style="margin-top:16px;">
            <span>&#10003;</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($articles->isNotEmpty())
        <ul class="article-list" style="margin-top:14px;">
            @foreach ($articles as $article)
                <li>
                    <a href="{{ route('articles.show', $article) }}" class="title-link">
                        {{ $article->title }}
                    </a>
                    <span class="byline">oleh {{ $article->user->name }}</span>

                    @if ($article->user_id === auth()->id())
                        <span class="badge">milikmu</span>
                        <div class="actions">
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-ghost btn-sm">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Hapus</button>
                            </form>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

        {{ $articles->links('pagination::default') }}
    @else
        <div style="text-align:center; padding:36px 0;">
            <p class="muted" style="margin:0 0 14px;">Belum ada artikel.</p>
            <a href="{{ route('articles.create') }}" class="btn">+ Tulis artikel</a>
        </div>
    @endif
</section>
@endsection
