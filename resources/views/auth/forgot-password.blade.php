@extends('layouts.app')

@section('content')
    <div class="p-4 mt-3 mt-md-5">
        <form action="/forgot-password" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3 p-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Reset Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope-open"></i></span>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email.." required value="{{ old('email') }}">
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
                        <button type="submit" class="btn btn-theme w-100">Recover My Account!</button>
                    </div>
                    <div class="mb-2">
                        <p>
                            <small class="text-muted">
                                The password reset link will be sent to your email address. If you don't receive the email,
                                please check your spam folder.
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
