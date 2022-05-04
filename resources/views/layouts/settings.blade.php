@extends('layouts.app')

@section('content')
    <div class="row p-4 my-3 mb-5 justify-content-center">
        <div class="row col-lg-2 rounded p-3 mb-4 mb-md-0 me-md-5 text-center text-lg-start">
            <div class="">
                <a href="/profile"
                    class="d-block mb-3 {{ request()->is('profile*') ? 'text-theme text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                        class="fa-solid fa-user me-2"></i>My
                    Account</a>
                <a href="#"
                    class="d-block mb-3 {{ request()->is('my-purchase*') ? 'text-theme text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                        class="fa-solid fa-receipt me-2"></i>My
                    Purchase</a>
                <a href="#"
                    class="d-block mb-3 {{ request()->is('my-shop*') ? 'text-theme text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                        class="fa-solid fa-sack-dollar me-2"></i>My
                    Shop</a>
                <a href="/become-seller"
                    class="d-block mb-3 {{ request()->is('become-seller*') ? 'text-theme text-decoration-underline' : 'text-decoration-none text-black' }}"><i
                        class="fa-solid fa-hand-holding-dollar me-2"></i>Apply
                    Seller</a>
            </div>
        </div>

        <div class="row col-md rounded p-4 bg-white rounded-3 border shadow-sm">
            <div class="mb-3">
                <h5 class="">@yield('setting-title')</h5>
                <p class="form-text">@yield('setting-description')</p>

                @if (!$user->email_verified_at)
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
