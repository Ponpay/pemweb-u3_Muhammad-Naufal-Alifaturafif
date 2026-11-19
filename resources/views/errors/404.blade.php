@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('body-class', 'auth-page')

@section('content')
<div class="card" style="max-width:520px; margin:0 auto; text-align:center;">
    <div style="font-size:44px; font-weight:800; letter-spacing:-2px; color:var(--primary); line-height:1;">
        404
    </div>
    <h2 style="margin:14px 0 8px; font-size:22px;">Halaman Tidak Ditemukan</h2>
    <p class="muted" style="margin:0 0 22px;">
        Alamat yang kamu tuju tidak tersedia atau artikelnya sudah dihapus.
    </p>

    <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap;">
        <a href="{{ route('home') }}" class="btn btn-pill">Halaman Home</a>
        <a href="{{ route('articles.index') }}" class="btn btn-ghost btn-pill">Lihat Artikel</a>
    </div>
</div>
@endsection
