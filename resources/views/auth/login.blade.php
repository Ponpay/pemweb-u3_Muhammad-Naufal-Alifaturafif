@extends('layouts.app')

@section('title', 'Login')

@section('body-class', 'auth-page')

@section('content')
<div class="card form-card" style="margin:0 auto;">
    <h2>Masuk ke akun</h2>
    <p class="muted" style="margin-top:0;">Silakan masuk untuk mengelola berita.</p>

    @if ($errors->any())
        <div class="error" style="margin-top:16px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" style="margin-top:18px;">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               required autofocus placeholder="nama@example.com">

        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               required placeholder="Masukkan password">

        <div class="checkbox-row">
            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Ingat saya</label>
        </div>

        <div class="form-actions">
            <button type="submit" style="width:100%;">Masuk</button>
        </div>

        <p class="form-footer">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
    </form>
</div>
@endsection
