@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="p-4 mt-3 mt-md-5">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3 p-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email.." required value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-unlock-keyhole"></i></span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter your password.." required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input me-2">
                            <label for="remember" class="form-label">Remember me</label>
                        </div>
                        <div class="">
                            <small>
                                <a href="/forgot-password" class="text-theme-darker">Forgot
                                    Password?</a>
                            </small>
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
                        <button type="submit" class="btn btn-theme w-100">Take me in!</button>
                    </div>
                    <div class="mb-2">
                        <p>
                            <small class="text-muted">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-theme-darker">
                                    Register now!
                                </a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
