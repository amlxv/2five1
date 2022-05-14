@extends('layouts.settings')

@section('title', 'Manage Users')
@section('setting-title', 'Manage Users')
@section('setting-description', 'Manage users and their roles.')

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
                    Type
                </th>
                <th>
                    Role
                </th>
                <th>
                    Actions
                </th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ Str::limit($user->name, 20) }}
                        </td>
                        <td class="text-capitalize">
                            {{ $user->type }}
                        </td>
                        <td class="text-capitalize">
                            @if ($user->role == 'admin')
                                <span class="badge bg-primary">
                                    {{ $user->role }}
                                </span>
                            @else
                                <span class="badge bg-success">
                                    {{ $user->role }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" type="button" class="btn btn-theme py-1">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
