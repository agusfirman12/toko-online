<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand fs-4" wire:navigate href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                @if (auth()->user()->hasRole('admin'))
                    <x-nav-link :active="request()->routeIs('admin.dahsboard')" :href="route('admin.dashboard')">Dashboard</x-nav-link>
                @else
                    <x-nav-link :active="request()->routeIs('dashboard')" :href="route('dashboard')">Dashboard</x-nav-link>
                @endif
                @if (auth()->user()->hasRole('admin'))
                    <x-nav-link :active="request()->routeIs('users')" :href="route('admin.users')" wire:navigate>Users</x-nav-link>
                @endif
                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('seller'))
                    <x-nav-link :active="request()->routeIs('products')" :href="route('admin.products')">Products</x-nav-link>
                @endif

            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <i id="icon" onclick="toggleTheme()" class="bi bi-sun fs-4 me-3" role="button"></i>
                @auth
                    <div class="dropdown">
                        <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} <i class="bi bi-caret-down-fill"></i>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
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
            document.getElementById
            document.documentElement.setAttribute('data-bs-theme', 'light');
        } else {
            document.getElementById('icon').className = 'bi bi-sun fs-4 me-3';
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        }
    }
</script>
