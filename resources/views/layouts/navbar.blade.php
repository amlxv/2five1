<nav class="navbar navbar-expand-lg navbar-light bg-transparent shadow-none p-0">
    <div class="container-fluid mx-lg-3 p-2">
        {{-- Brand --}}
        <a class="navbar-brand mt-2 mt-lg-0" href="/">
            <img src="{{ asset('images/brands/logo.png') }}" height="60" alt="Website Logo" />
        </a>

        {{-- Right Side --}}
        <div class="d-flex align-items-center justify-content-center">

            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-theme me-2 px-4">Get Started!</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light text-body px-4"><i
                        class="fa-solid fa-arrow-right-to-bracket me-2"></i>Sign In</a>
            @endguest

            @auth
                <!-- Avatar Menu Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-transparent shadow-none" type="button" id="navbarDropdownMenuAvatar" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ !Auth::user()->avatar ? asset('images/avatars/default.png') : asset(Auth::user()->avatar) }}"
                            class="rounded-circle" height="35px" alt="Black and White Portrait of a Man" loading="lazy" />
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a class="dropdown-item" href="{{ route('users.index') }}">Admin Center</a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('marketplace.index') }}">Marketplace</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">My Account</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('shop.index') }}">My Shop</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

        </div>
        {{-- End of Right Side --}}
    </div>
</nav>
