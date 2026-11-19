@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="card form-card">
    <h2>Tulis Artikel Baru</h2>
    <p class="muted" style="margin-top:0;">Gambar bersifat opsional. Jika URL dikosongkan, sistem memakai gambar placeholder otomatis.</p>

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

    <form action="{{ route('articles.store') }}" method="POST" style="margin-top:18px;">
        @csrf

        <label for="title">Judul Artikel</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}"
               required placeholder="Contoh: Perkembangan Teknologi Informasi di Aceh">

        <label for="image">URL Gambar <span class="muted" style="font-weight:400;">(opsional)</span></label>
        <input type="url" id="image" name="image" value="{{ old('image') }}"
               placeholder="https://example.com/gambar.jpg">
        <p class="form-hint">Kosongkan untuk memakai gambar placeholder dari <code>picsum.photos</code>.</p>

        <label for="body">Isi Berita</label>
        <textarea id="body" name="body" rows="8" required
                  placeholder="Tulis isi berita di sini...">{{ old('body') }}</textarea>

        <div class="form-actions">
            <button type="submit">Simpan Artikel</button>
            <a href="{{ route('articles.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
