@extends('show.layouts.app')

@section('title', 'Customer Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/loing.css') }}">

<div class="login-container">
    <div class="login-card">
        <h2>Customer Login</h2>

        <!-- Show errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('customer.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="register-link">
            <small>Don't have an account? 
                <a href="{{ route('customer.register') }}">Register now</a>
            </small>
        </div>
    </div>
</div>
@endsection