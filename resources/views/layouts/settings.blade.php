@extends('layouts.app')

@section('content')
    <div class="row px-4 py-0 py-lg-4 mt-0 mt-lg-3 mb-5 justify-content-center">
        <div class="row col-lg-2 rounded p-3 mb-4 mb-md-0 me-md-5 text-center text-lg-start">
            <div class="">
                @if (Auth::user()->role == 'admin')
                    <div class="">
                        <a href="{{ route('users.index') }}"
                            class="d-block mb-3 text-nowrap {{ request()->is('users*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                                class="fa-solid fa-users-gear me-2"></i>Users
                            <span class="badge bg-success ms-2"><i class="fa-solid fa-wrench"></i></span>
                        </a>
                        <a href="{{ route('categories.index') }}"
                            class="d-block mb-3 text-nowrap {{ request()->is('categories*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                                class="fa-solid fa-bars-staggered me-2"></i>Categories
                            <span class="badge bg-success ms-2"><i class="fa-solid fa-wrench"></i></span>
                        </a>
                        <hr>
                    </div>
                @endif
                <a href="{{ route('profile.index') }}"
                    class="d-block mb-3 {{ request()->is('profile*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                        class="fa-solid fa-user me-2"></i>My
                    Account</a>
                <a href="{{ route('purchases.index') }}"
                    class="d-block mb-3 {{ request()->is('purchase*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                        class="fa-solid fa-receipt me-2"></i>My
                    Purchase</a>
                @if (Auth::user()->type == 'both')
                    <a href="{{ route('shop.index') }}"
                        class="d-block mb-3 {{ request()->is('shop*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                            class="fa-solid fa-sack-dollar me-2"></i>My
                        Shop</a>
                    <a href="{{ route('products.index') }}"
                        class="d-block mb-3 {{ request()->is('products*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                            class="fa-solid fa-cubes me-2"></i></i>My
                        Products</a>
                @else
                    <a href="{{ route('become-seller.index') }}"
                        class="d-block mb-3 {{ request()->is('become-seller*') ? 'text-theme-darker text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                            class="fa-solid fa-hand-holding-dollar me-2"></i>Apply
                        Seller</a>
                @endif
            </div>
        </div>

        <div class="row col-md rounded p-4 bg-white rounded-3 border shadow-sm">
            <div class="mb-3">
                <div class="d-flex justify-content-between align-md-items-center flex-column flex-md-row">
                    <div class="">
                        <h5 class="">@yield('setting-title')</h5>
                        <p class="form-text">@yield('setting-description')</p>
                    </div>
                    @stack('page-actions')
                </div>

                @if (!Auth::user()->email_verified_at)
                    <div class="alert alert-danger">
                        Your <strong>email address</strong> is not verified. Please verify your email address to continue.

                        <form action="/email/verification-notification" method="post">
                            @csrf

                            @if (session('status') == 'verification-link-sent')
                                <div class="text-success text-decoration-underline">A new email verification link has been
                                    emailed to you!</div>
                            @else
                                <button type="submit" class="btn btn-link px-0">Resend email verification link</button>
                            @endif
                        </form>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <hr>
            </div>
            @yield('setting-content')
        </div>
    </div>

@endsection
