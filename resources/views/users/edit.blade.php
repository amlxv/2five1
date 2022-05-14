@extends('layouts.settings')

@section('title', 'Manage Users')
@section('setting-title', 'Manage Users')
@section('setting-description', 'Manage users and their roles.')

@section('setting-content')
    <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <fieldset class="border p-4 rounded-3">
            <legend class="float-none w-auto px-4 fs-6">Personal Informations</legend>
            <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
                <div class="rounded-circle text-center" style="height: 120px; width: 120px;">
                    <input type="file" class="d-none" name="avatar" id="avatar" aria-describedby="avatarHelp">
                    <label for="avatar">
                        <img class="rounded-circle border border-white"
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
                        aria-describedby="emailHelp">
                </div>
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
                    <select name="type" id="type" class="form-select">
                        <option value="buyer" {{ $user->type == 'buyer' ? 'selected' : '' }}>Buyer</option>
                        <option value="both" {{ $user->type == 'both' ? 'selected' : '' }}>Buyer & Seller</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="type" class="form-label">Account Role</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                    <select name="role" id="role" class="form-select">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Normal User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset class="border p-4 rounded-3 my-3">
            <legend class="float-none w-auto px-4 fs-6">Shop Informations</legend>
            <div class="mb-3">
                <label for="shop_name" class="form-label">Shop Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-shop"></i></span>
                    <input type="text" name="shop_name" id="shop_name" class="form-control"
                        value="{{ $user->shop_name }}" placeholder="Enter your Shop Name..">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="shop_avatar">Shop Image</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                    <input class="form-control" type="file" name="shop_avatar" id="shop_avatar">
                </div>
            </div>
        </fieldset>

        <div class="mb-1 text-end">
            <button class="btn btn-theme px-5" type="submit">Save</button>
        </div>
    </form>
@endsection

@push('page-actions')
    <div class="text-center ms-0 ms-md-3">
        <a href="{{ route('users.index') }}" class="btn btn-danger py-2 text-nowrap">
            <i class="fa-solid fa-angle-left me-2"></i>
            Back
        </a>
    </div>
@endpush
