<div class="nav-wrap">
    <nav class="nav" aria-label="Navigasi Utama">
        <a href="{{ route('home') }}" class="brand">
            <span class="mark">
                <img src="{{ asset('images/logo.svg') }}" alt="" width="18" height="18">
            </span>
            <span class="wordmark">
                Nusa News
                <small>Portal Berita</small>
            </span>
        </a>

        <div class="nav-menu">
            <a href="{{ route('home') }}"
               class="navlink {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="navlink {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('articles.index') }}"
                   class="navlink {{ request()->routeIs('articles.*') ? 'active' : '' }}">Artikel</a>
            @endauth
        </div>

        @auth
            <div class="right">
                <span class="greeting">
                    <span class="avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-ghost btn-pill">Logout</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="right">
                <a href="{{ route('login') }}"
                   class="navlink {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                <a href="{{ route('register') }}" class="btn btn-pill">Daftar</a>
            </div>
        @endguest
    </nav>
</div>
