@extends('layouts.app')

@section('content')
    <div class="d-flex flex-wrap justify-content-center pb-4">
        @foreach ($products as $product)
            <a href="{{ route('marketplace.show', $product->id) }}" class="text-decoration-none">
                <div class="card m-2 rounded-3 overflow-hidden" style="width: 16rem;">
                    <img src="{{ asset($product->image) }}" class="card-img-top rounded-3" alt="{{ $product->name }}">
                    <div class="card-body">
                        <p class="card-text text-dark">{{ Str::limit($product->name, 40) }}</p>
                        <p class="text-muted">
                            {{ $product->quantity > 0 ? $product->quantity . ' items left' : 'Out of stock' }}
                        </p>
                        <div class="d-flex card-text justify-content-between text-end">
                            <div class="text-dark">RM {{ $product->price }}</div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
