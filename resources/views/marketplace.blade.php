@extends('layouts.app')

@section('content')
    @auth
        You're logged! {{ auth()->user()->name }}

        <form action="/logout" method="post">
            @csrf
            <button class="btn btn-secondary" type="submit">Logout</button>
        </form>


    @endauth

    @guest
        You're not logged!
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endguest
@endsection
