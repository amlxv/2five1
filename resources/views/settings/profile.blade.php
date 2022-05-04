@extends('layouts.settings')

@section('title', 'Profile')
@section('setting-title', 'My Account')
@section('setting-description', 'Update your account information')

@section('setting-content')
    <form action="{{ '/profile/' . Auth::user()->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
            <div class="rounded-circle text-center" style="height: 120px; width: 120px;">
                <input type="file" class="d-none" name="avatar" id="avatar" aria-describedby="avatarHelp">
                <label for="avatar">
                    <img class="rounded-circle border"
                        src="{{ !$user->avatar ? asset('images/avatars/default.png') : asset($user->avatar) }}"
                        alt="Profile Picture" style="height: 120px; width: 120px;">
                </label>
            </div>
            <div class="form-text mt-3">
                <label for="avatar" class="btn btn-white border">
                    Select Image
                </label>
            </div>
        </div>

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
                    aria-describedby="emailHelp" disabled>
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
        <div class="mb-4">
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
@endsection
