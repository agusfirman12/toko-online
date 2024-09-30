<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand fs-4" wire:navigate href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <x-nav-link :active="request()->routeIs('home')" :href="route('home')">Home</x-nav-link>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" wire:navigate
                                    href="{{ route('products.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" wire:navigate href="{{ route('products') }}">All Category</a></li>
                    </ul>
                </li>
                <x-nav-link :active="request()->routeIs('history')" :href="route('history')">History</x-nav-link>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <i id="icon" onclick="toggleTheme()" class="bi bi-sun fs-4 me-3" role="button"></i>
                <a href="{{ route('cart') }}" wire:navigate id="cart"
                    class="position-relative me-3 text-decoration-none text-white">
                    <i class="bi bi-cart4 fs-3"></i>
                    @if ($totalItems > 0)
                        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger"
                            style="top: 10px">
                            {{ $totalItems }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif
                </a>
                @auth
                    <div class="dropdown">
                        <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} <i class="bi bi-caret-down-fill"></i>
                        </button>

                        <ul class="dropdown-menu">
                            @if (Auth::user()->HasRole('admin'))
                                <li><a class="dropdown-item" wire:navigate
                                        href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @elseif(Auth::User()->HasRole('seller'))
                                <li><a class="dropdown-item" wire:navigate
                                        href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                            @else
                                <li><a class="dropdown-item" wire:navigate href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <x-nav-link :href="route('register')">Register</x-nav-link>
                    <x-nav-link :href="route('login')">Login</x-nav-link>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script>
    function toggleTheme() {
        const theme = document.documentElement.getAttribute('data-bs-theme');
        if (theme === 'dark') {
            document.getElementById('icon').className = 'bi bi-moon fs-4 me-3';
            document.getElementById('cart').className = 'position-relative me-3 text-decoration-none text-dark';
            document.getElementById
            document.documentElement.setAttribute('data-bs-theme', 'light');
        } else {
            document.getElementById('icon').className = 'bi bi-sun fs-4 me-3';
            document.getElementById('cart').className = 'position-relative me-3 text-decoration-none text-white';
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        }
    }
</script>
