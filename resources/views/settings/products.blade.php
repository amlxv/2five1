@extends('layouts.settings')

@section('title', 'My Products')
@section('setting-title', 'My Products')
@section('setting-description', 'Here you can manage your products.')

@section('setting-content')


    @if (count($products) == 0)
        <div class="px-3">
            <div class="alert alert-warning pb-0">
                <p>You don't have any products yet.</p>
            </div>

        </div>
    @else
        @foreach ($products as $product)
            <div class="mb-2">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col">
                                <h5 class="card-title"><span
                                        class="badge {{ $product->status == 'active' ? 'bg-theme-darker' : 'bg-danger' }} me-1 p-2 text-capitalize fw-bold"><small>{{ $product->status == 'active' ? 'Active' : 'Drafted' }}</small></span>
                                    {{ $product->name }} </h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        {{ $product->quantity > 0 ? $product->quantity . ' items left' : 'Out of stock' }}
                                    </small>
                                </p>
                            </div>
                            <div class="col-auto">
                                <div class="float-right">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$loop->last)
                    <hr>
                @endif
            </div>
        @endforeach
    @endif


@endsection

@push('page-actions')
    <div class="text-center">
        <a href="{{ route('products.create') }}" class="btn btn-theme">
            <i class="fa-solid fa-plus me-2"></i>
            Add Product
        </a>
    </div>
@endpush
