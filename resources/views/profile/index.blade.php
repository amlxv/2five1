@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <div class="row p-4 my-3 mb-5 justify-content-center">
        <div class="row col-md-3 rounded p-3 mb-4 mb-md-0 me-md-5">
            <div class="">
                <a href="/profile"
                    class="d-block mb-3 {{ request()->is('profile*') ? 'text-theme text-decoration-underline' : '' }}"><i
                        class="fa-solid fa-user me-2"></i>My
                    Account</a>
                <a href="#" class="d-block mb-3 text-decoration-none text-black"><i class="fa-solid fa-receipt me-2"></i>My
                    Purchase</a>
                <a href="#" class="d-block mb-3 text-decoration-none text-black"><i class="fa-solid fa-shop ms-n1 me-2"></i>My
                    Shop</a>
            </div>
        </div>

        <div class="row col-md rounded p-4 bg-white rounded border shadow-sm">
            <div class="mb-3">
                <h5 class="">My Profile</h5>
                <p class="form-text">Manage and protect your account</p>

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

            <form action="{{ '/profile/' . Auth::user()->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                            placeholder="Enter your name..">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope-open"></i></span>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                            disabled>
                    </div>
                    <div id="emailHelp" class="form-text">The email address cannot be changed.</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}"
                            placeholder="Enter your phone number..">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}"
                            placeholder="Enter your address..">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Account Type</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user-gear"></i></span>
                        <input type="text" name="type" id="type" class="form-control text-capitalize"
                            value="{{ $user->type == 'both' ? 'Buyer & Seller' : $user->type }}" disabled>
                    </div>
                </div>
                <div class="mb-1 text-end">
                    <button class="btn btn-theme px-5" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
