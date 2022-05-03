<nav class="navbar navbar-expand-lg navbar-light bg-transparent shadow-none p-0">
    <div class="container-fluid mx-lg-3 p-2">

        {{-- Toggle Button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavItems"
            aria-controls="navbarNavItems" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        {{-- Brand --}}
        <a class="navbar-brand mt-2 mt-lg-0" href="/">
            <img src="https://i.imgur.com/X2rrcad.png" height="60" alt="Website Logo" loading="lazy" />
        </a>

        {{-- Collapsible Wrapper --}}
        <div class="collapse navbar-collapse" id="navbarNavItems">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Marketplace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Become a Seller</a>
                </li>
            </ul>
        </div>

        {{-- Right Side --}}
        <div class="d-flex align-items-center">

            @guest
                <a href="/register" class="btn btn-outline-theme me-2 px-4">Get Started!</a>
                <a href="/login" class="btn btn-outline-light text-body px-4"><i
                        class="fa-solid fa-arrow-right-to-bracket me-2"></i>Sign In</a>
            @endguest

            @auth

                Hi, {{ Auth::user()->name }}!

                <form action="/logout" method="post">
                    @csrf
                    <button class="btn" type="submit">Logout</button>
                </form>
            @endauth

        </div>
        {{-- End of Right Side --}}
    </div>
</nav>
