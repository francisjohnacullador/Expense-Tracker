<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-dark py-3" data-bs-theme="dark">
    <div class="container">
        <!-- Logo and App Name -->
        <a class="navbar-brand d-flex align-items-center fw-bold gap-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-top rounded">
            My Wallet
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Links (Shown only when logged in) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transactions.create') }}">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories') }}">Categories</a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Links (Authentication Control) -->
            <div class="d-flex align-items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3">Register</a>
                @endguest

                @auth
                    <a href="{{ route('profile') }}" class="btn btn-outline-light btn-sm px-3 rounded-3 me-2">
                        <i class="bi bi-person-circle me-1 text-primary"></i>{{ Auth::user()->name }}
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm px-3">Log Out</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>