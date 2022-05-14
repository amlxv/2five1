@extends('layouts.settings')

@section('title', 'Edit Categories')
@section('setting-title', 'Edit Categories')
@section('setting-description', 'Manage categories available for the products.')

@section('setting-content')
    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"
                    placeholder="Enter the name..">
            </div>
        </div>
        <div class="mb-4">
            <label for="status" class="form-label">Status</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-gear"></i></span>
                <select name="status" id="status" class="form-select">
                    <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Drafted</option>
                </select>
            </div>
        </div>


        <div class="mb-1 text-end">
            <button class="btn btn-theme px-5" type="submit">Save</button>
        </div>
    </form>
@endsection

@push('page-actions')
    <div class="text-center ms-0 ms-md-3">
        <a href="{{ route('categories.index') }}" class="btn btn-danger py-2 text-nowrap">
            <i class="fa-solid fa-angle-left me-2"></i>
            Back
        </a>
    </div>
@endpush
