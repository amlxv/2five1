@extends('layouts.settings')

@section('title', 'Add Products')
@section('setting-title', 'Add New Products')
@section('setting-description', 'Here you can add new products.')

@section('setting-content')

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter the product name.."
                    aria-describedby="productNameHelper" value="{{ old('name') }}" required>
            </div>
            <div class="form-text" id="productNameHelper">
                Minimum 14 characters.
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-pencil-alt"></i></span>
                <textarea name="description" id="description" class="form-control" rows="5"
                    placeholder="Describe about the product here.." aria-describedby="productDescriptionHelper"
                    required>{{ old('description') }}</textarea>
            </div>
            <div class="form-text" id="productDescriptionHelper">
                Minimum 40 characters. Maximum 255 characters.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="image">Featured Image</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                <input class="form-control" type="file" name="image" id="image" required>
            </div>
            <div class="form-text" id="productImageHelper">
                Maximum file size is 2MB. Allowed file types are: jpeg, jpg, png
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="category">Category</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-folder"></i></span>
                <select class="form-select" name="category" id="category" aria-describedby="productCategoryHelper"
                    required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-text" id="productCategoryHelper">
                The category is managed by the admin. You can only select one category.
            </div>
        </div>

        <div class="mb-3">
            <label for="sku" class="form-label">Stock-Keeping Unit (SKU)</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-fingerprint"></i></span>
                <input type="text" name="sku" id="sku" class="form-control" placeholder="Enter the product SKU.."
                    aria-describedby="productSKUHelper" value="{{ old('sku') }}">
            </div>
            <div class="form-text" id="productSKUHelper">
                Optional. Maximum 21 characters.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="quantity">Quantity</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-cube"></i></span>
                <input class="form-control" type="number" name="quantity" id="quantity" placeholder="Enter the quantity.."
                    value="{{ old('quantity') }}" required>
            </div>
            <div class="form-text" id="productPriceHelper">
                Minimum 1 quantity.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="price">Price Per Item</label>
            <div class="input-group">
                <span class="input-group-text">RM</span>
                <input class="form-control" type="number" name="price" id="price" placeholder="Enter the price per item.."
                    aria-describedby="productPriceHelper" value="{{ old('price') }}" required>
            </div>
            <div class="form-text" id="productPriceHelper">
                Price can only be in decimal format. e.g. 10.00
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="status">Status</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
                <select class="form-select" name="status" id="status" aria-describedby="productStatusHelper" required>
                    <option selected value="active">Active</option>
                    <option value="inactive">Draft</option>
                </select>
            </div>
            <div class="form-text" id="productStatusHelper">
                The product will be visible to the public when
                it is active.
            </div>
        </div>

        <div class="mb-1 text-end">
            <button class="btn btn-theme px-5" type="submit">Save</button>
        </div>
    </form>

@endsection

@push('page-actions')
    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-danger py-2">
            <i class="fa-solid fa-angle-left me-2"></i>
            Back
        </a>
    </div>
@endpush
