@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="card form-card">
    <h2>Edit Artikel</h2>
    <p class="muted" style="margin-top:0;">Perbarui data berita. Kosongkan URL gambar untuk kembali memakai placeholder.</p>

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

    <form action="{{ route('articles.update', $article) }}" method="POST" style="margin-top:18px;">
        @csrf
        @method('PUT')

        <label for="title">Judul Artikel</label>
        <input type="text" id="title" name="title"
               value="{{ old('title', $article->title) }}"
               required placeholder="Masukkan judul berita">

        <label for="image">URL Gambar <span class="muted" style="font-weight:400;">(opsional)</span></label>
        <input type="url" id="image" name="image"
               value="{{ old('image', $article->image) }}"
               placeholder="https://example.com/gambar.jpg">

        <p class="form-hint">Pratinjau gambar saat ini:</p>
        <img src="{{ $article->image_url }}" alt="Gambar artikel"
             style="width:100%; max-width:420px; max-height:230px; object-fit:cover; border-radius:12px; margin:10px 0 4px; box-shadow:0 2px 10px rgba(15,23,42,.1);">

        <label for="body">Isi Berita</label>
        <textarea id="body" name="body" rows="8"
                  required>{{ old('body', $article->body) }}</textarea>

        <div class="form-actions">
            <button type="submit">Update Artikel</button>
            <a href="{{ route('articles.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
