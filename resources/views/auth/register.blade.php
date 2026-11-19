@extends('layouts.app')

@section('title', 'Register')

@section('body-class', 'auth-page')

@section('content')
<div class="card form-card" style="margin:0 auto;">
    <h2>Buat akun baru</h2>
    <p class="muted" style="margin-top:0;">Daftar untuk mulai menulis dan mengelola berita.</p>

    @if ($errors->any())
        <div class="error" style="margin-top:16px;">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" style="margin-top:18px;">
        @csrf

        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
               required autofocus placeholder="Nama kamu">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               required placeholder="nama@example.com">

        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               required placeholder="Minimal 8 karakter">
        <p class="form-hint">Gunakan minimal 8 karakter.</p>

        <label for="password_confirmation">Ulangi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               required placeholder="Ketik ulang password">

        <div class="form-actions">
            <button type="submit" style="width:100%;">Daftar</button>
        </div>

        <p class="form-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
    </form>
</div>
@endsection
