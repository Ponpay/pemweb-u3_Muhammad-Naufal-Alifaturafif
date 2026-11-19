# Nusa News — Portal Berita Laravel

Aplikasi portal berita sederhana berbasis **Laravel 12** dengan autentikasi dan CRUD artikel.
Dibuat untuk memenuhi tugas Praktikum Pemrograman Web (Modul II & Modul III) —
Prodi Teknologi Informasi, Fakultas Sains dan Teknologi, UIN Ar-Raniry Banda Aceh.

## Fitur

- **Autentikasi** — register, login, logout, proteksi halaman dengan middleware `auth` dan `guest`
- **CRUD Artikel** — tambah, lihat, ubah, hapus artikel dengan validasi input
- **Hak akses pemilik** — hanya penulis yang dapat mengubah atau menghapus artikelnya (HTTP 403 untuk pengguna lain)
- **Slug otomatis** — alamat artikel memakai slug yang stabil dan tidak berubah saat diedit
- **Gambar placeholder** — jika URL gambar dikosongkan, sistem memakai gambar placeholder otomatis
- **Dashboard** — statistik total artikel, artikel milik pengguna, dan persentase kontribusi
- **Pagination** — daftar artikel dibagi 10 per halaman
- **Responsif** — tata letak menyesuaikan layar desktop dan ponsel
- **Halaman error kustom** — 403 dan 404 memakai desain aplikasi

## Kebutuhan

| Komponen | Versi |
|---|---|
| PHP | 8.2 atau lebih baru |
| Composer | 2.x |
| MySQL | 8.x (atau SQLite) |
| Laravel | 12.x |

## Instalasi

```bash
# 1. Ambil dependensi
composer install

# 2. Salin konfigurasi
cp .env.example .env

# 3. Buat application key
php artisan key:generate

# 4. Atur koneksi database di .env
#    DB_CONNECTION=mysql
#    DB_DATABASE=praktikum_web
#    DB_USERNAME=root
#    DB_PASSWORD=

# 5. Buat database bernama praktikum_web
#    (lewat HeidiSQL / phpMyAdmin / mysql CLI)

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Jalankan server
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Akun Uji

Seeder membuat satu akun beserta 12 artikel contoh:

| Email | Password |
|---|---|
| `praktikan@example.com` | `password` |

## Struktur Penting

```
app/
  Http/Controllers/
    ArticleController.php      CRUD artikel + validasi + cek pemilik
    AuthController.php         register, login, logout
    DashboardController.php    statistik dashboard
    HomeController.php         6 berita terbaru
  Models/
    Article.php                relasi ke User, slug binding, accessor image_url
    User.php                   relasi hasMany Article
database/
  migrations/*_create_articles_table.php
  factories/ArticleFactory.php
  seeders/DatabaseSeeder.php
resources/views/
  layouts/app.blade.php        layout utama + seluruh CSS
  partials/nav.blade.php       navigasi
  pages/home.blade.php         beranda
  pages/dashboard.blade.php    dashboard
  articles/index|show|create|edit.blade.php
  auth/login|register.blade.php
  errors/403|404.blade.php
routes/web.php
```

## Rute Utama

| Method | URI | Nama | Akses |
|---|---|---|---|
| GET | `/` | `home` | Publik |
| GET/POST | `/login` | `login` | Tamu |
| GET/POST | `/register` | `register` | Tamu |
| POST | `/logout` | `logout` | Login |
| GET | `/dashboard` | `dashboard` | Login |
| GET | `/articles` | `articles.index` | Login |
| GET | `/articles/create` | `articles.create` | Login |
| POST | `/articles` | `articles.store` | Login |
| GET | `/articles/{article}` | `articles.show` | Publik |
| GET | `/articles/{article}/edit` | `articles.edit` | Login + pemilik |
| PUT/PATCH | `/articles/{article}` | `articles.update` | Login + pemilik |
| DELETE | `/articles/{article}` | `articles.destroy` | Login + pemilik |

## Catatan

File `.env` tidak disertakan dalam repositori karena memuat konfigurasi rahasia.
Gunakan `.env.example` sebagai acuan lalu sesuaikan dengan lingkungan masing-masing.
