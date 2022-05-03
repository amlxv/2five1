@extends('layouts.app')

@section('content')
    <div class="p-4 mt-3 mt-md-5">
        <form action="/reset-password" method="post">
            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3 p-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Reset Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope-open"></i></span>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email.." required value="{{ request()->email }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-unlock-keyhole"></i></span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter your password.." required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">New Password Confirmation</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Re-enter your password.." required>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger fade show" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-2">
                        <button type="submit" class="btn btn-theme w-100">Create New Password</button>
                    </div>
                    <div class="mb-2">
                        <p>
                            <small class="text-muted">
                                This reset password session will expire in {{ config('auth.passwords.users.expire') }}
                                minutes. If you don't reset your password within that time, you will need to request a new
                                password reset.
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
