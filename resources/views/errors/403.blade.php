@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('body-class', 'auth-page')

@section('content')
<div class="card" style="max-width:520px; margin:0 auto; text-align:center;">
    <div style="font-size:44px; font-weight:800; letter-spacing:-2px; color:var(--primary); line-height:1;">
        {{ $exception->getStatusCode() ?? 403 }}
    </div>
    <h2 style="margin:14px 0 8px; font-size:22px;">Akses Ditolak</h2>
    <p class="muted" style="margin:0 0 22px;">
        {{ $exception->getMessage() ?: 'Kamu tidak berhak mengakses halaman ini.' }}
    </p>

    <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap;">
        <a href="{{ route('articles.index') }}" class="btn btn-pill">Kembali ke Artikel</a>
        <a href="{{ route('home') }}" class="btn btn-ghost btn-pill">Halaman Home</a>
    </div>
</div>
@endsection
