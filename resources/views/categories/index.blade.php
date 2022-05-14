@extends('layouts.settings')

@section('title', 'Manage Categories')
@section('setting-title', 'Manage Categories')
@section('setting-description', 'Manage categories available for the products.')

@section('setting-content')
    <div class="table-responsive">
        <table class="table">
            <thead class="text-theme-darker">
                <th>
                    No.
                </th>
                <th>
                    Name
                </th>
                <th>
                    Status
                </th>
                <th>
                    Actions
                </th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ Str::limit($category->name, 20) }}
                        </td>
                        <td class="text-capitalize">
                            @if ($category->status == 'active')
                                <span class="badge bg-primary">
                                    {{ $category->status }}
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    {{ $category->status }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" type="button"
                                class="btn btn-theme py-1">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('page-actions')
    <div class="text-center ms-0 ms-md-3">
        <a href="{{ route('categories.create') }}" class="btn btn-theme py-2 text-nowrap">
            <i class="fa-solid fa-add me-2"></i>
            Add New
        </a>
    </div>
@endpush
