@extends('layouts.settings')

@section('title', 'My Shop')
@section('setting-title', 'My Shop')
@section('setting-description', 'Update your shop information')

@section('setting-content')

    <form action="{{ '/shop/' . Auth::user()->id }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
            <div class="rounded-circle text-center" style="height: 120px; width: 120px;">
                <input type="file" class="d-none" name="shop_avatar" id="shop_avatar"
                    aria-describedby="shop_avatarHelp">
                <label for="shop_avatar">
                    <img class="rounded-circle border border-white"
                        src="{{ !$user->shop_avatar ? asset('images/avatars/shop-default.png') : asset($user->shop_avatar) }}"
                        alt="Shop Icon" style="height: 120px; width: 120px;">
                </label>
            </div>
            <div class="form-text mt-3">
                <label for="shop_avatar" class="btn btn-white border">
                    Select Image
                </label>
            </div>
        </div>
        <div class="mb-4">
            <label for="shop_name" class="form-label">Shop Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-shop"></i></span>
                <input type="text" name="shop_name" id="shop_name" class="form-control"
                    value="{{ $user->shop_name ?? old('shop_name') }}" placeholder="Enter your Shop Name..">
            </div>
        </div>
        <div class="mb-1 text-end">
            <button class="btn btn-theme px-5" type="submit">Save</button>
        </div>
    </form>

@endsection
