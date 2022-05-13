@extends('layouts.settings')

@section('title', 'Edit Products')
@section('setting-title', 'Edit Product')
@section('setting-description', $product->name)

@section('setting-content')

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter the product name.."
                    aria-describedby="productNameHelper" value="{{ old('name') ?? $product->name }}" required>
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
                    required>{{ old('description') ?? $product->description }}</textarea>
            </div>
            <div class="form-text" id="productDescriptionHelper">
                Minimum 40 characters. Maximum 5000 characters.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="image">Featured Image</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                <input class="form-control" type="file" name="image" id="image">
            </div>
            <div class="form-text" id="productImageHelper">
                Optional. Leave if no changes. Maximum file size is 2MB. Allowed file types are: jpeg, jpg, png
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
                        <option {{ (old('category') ?? $product->category) == $category->id ? 'selected' : '' }}
                            value="{{ $category->id }}">
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
                    aria-describedby="productSKUHelper" value="{{ old('sku') ?? $product->sku }}">
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
                    aria-describedby="productQuantityHelper" value="{{ old('quantity') ?? $product->quantity }}" required>
            </div>
            <div class="form-text" id="productQuantityHelper">
                Minimum 1 quantity.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="price">Price Per Item</label>
            <div class="input-group">
                <span class="input-group-text">RM</span>
                <input class="form-control" type="number" name="price" id="price" placeholder="Enter the price per item.."
                    aria-describedby="productPriceHelper" value="{{ old('price') ?? $product->price }}" step="0.01"
                    required>
            </div>
            <div class="form-text" id="productPriceHelper">
                Price can only be in numeric. e.g. 10.00
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="status">Status</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
                <select class="form-select" name="status" id="status" aria-describedby="productStatusHelper" required>
                    <option {{ (old('status') ?? $product->status) == 'active' ? 'selected' : '' }} value="active">
                        Active</option>
                    <option {{ (old('status') ?? $product->status) != 'active' ? 'selected' : '' }} value="inactive">
                        Draft</option>
                </select>
            </div>
            <div class="form-text" id="productStatusHelper">
                The product will be visible to the public when
                it is active.
            </div>
        </div>

        <div class="mb-1">
            <button type="submit" class="btn btn-theme px-5">Save</button>
        </div>
    </form>

    <form action="{{ route('products.destroy', $product->id) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="text-end">
            <button type="submit" class="btn me-4 text-danger shadow-none px-0">
                <i class="fa-solid fa-xmark me-2"></i> Remove Product
            </button>
        </div>
    </form>

@endsection

@push('page-actions')
    <div class="text-center ms-0 ms-md-3">
        <a href="{{ route('products.index') }}" class="btn btn-danger py-2 text-nowrap">
            <i class="fa-solid fa-angle-left me-2"></i>
            Back
        </a>
    </div>
@endpush
