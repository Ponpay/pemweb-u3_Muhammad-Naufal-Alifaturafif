<div class="nav-wrap">
    <nav class="nav" aria-label="Navigasi Utama">
        <a href="{{ route('home') }}" class="brand">
            <span class="mark">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 5.5h9.5a3 3 0 0 1 3 3V19H7a3 3 0 0 1-3-3V5.5Z" stroke="#fff" stroke-width="1.7" stroke-linejoin="round"/>
                    <path d="M8 9.5h5M8 13h5M16.5 8.5H18a2 2 0 0 1 2 2V19" stroke="#fff" stroke-width="1.7" stroke-linecap="round"/>
                </svg>
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
