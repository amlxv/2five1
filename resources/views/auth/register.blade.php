@extends('layouts.app')

@section('content')
    <div class="px-4 py-2">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3 p-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name.."
                                required value="{{ old('name') }}">
                        </div>
                    </div>
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Re-enter your password.." required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="">
                            <input type="checkbox" name="tac" id="tac" class="form-check-input me-2">
                            <label for="tac" class="form-label">I agree to the <a href="#"
                                    class="text-theme-darker">Terms &
                                    Conditions</a></label>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger fade show" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="mb-2">
                        <button type="submit" class="btn btn-theme w-100">Create My Account!</button>
                    </div>
                    <div class="mb-2">
                        <p>
                            <small class="text-muted">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-theme-darker">
                                    Login now!
                                </a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
