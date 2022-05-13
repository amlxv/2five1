@extends('layouts.app')

@section('content')
    <div class="my-2 mx-3 mx-lg-0 px-3 px-lg-0 bg-white p-4 rounded-3">
        <div class="mb-5 d-flex flex-column flex-lg-row justify-content-start align-items-center align-items-lg-start px-3">
            <div class="me-0 me-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="height: 20rem">
            </div>
            <div class="">
                <div class="mb-2">
                    <h5 class="">{{ $product->name }}</h5>
                </div>
                <p class="text-muted">
                    {{ $product->quantity > 0 ? $product->quantity . ' items left' : 'Out of stock' }}
                </p>
                <div class="d-flex justify-content-between">
                    <div class="fs-2 fw-bold text-theme-darker">RM {{ $product->price }}</div>
                </div>
                <div class="d-flex my-3 align-items-center">
                    <div class=""><img src="{{ asset($seller->shop_avatar) }}" alt="" style="width: 2.5rem">
                    </div>
                    <div class="fs-6 text-dark ms-2">
                        {{ $seller->shop_name }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('buy.show', $product->id) }}" class="btn btn-theme fw-bold px-4">
                        <i class="fa-solid fa-cart-shopping me-2"></i>
                        Buy Now
                    </a>
                    <button class="btn shadow-none"><i class="fa-solid fa-circle-question text-muted"></i></button>
                </div>
                <div class="">
                    @if (session('success'))
                        <div class="mt-3 me-2">
                            <div class="alert alert-success fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mt-3 me-2">
                            <div class="alert alert-danger fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="px-3">
            <h5 class="mb-3 text-decoration-underline">Product Description</h5>
            <p class="description">{{ $product->description }}</p>
        </div>
    </div>
@endsection
