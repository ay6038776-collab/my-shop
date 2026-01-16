@extends('show.layouts.app')
    
@section('title', 'Customer Register')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<div class="register-container">
    <div class="register-card">
        <h2>Create Account</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        

        <!-- Registration Form -->
        <form method="POST" action="{{ route('customer.register.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="btn-register">Register</button>
        </form>

        <div class="login-link">
            <small>Already have an account? <a href="{{ route('customer.login') }}">Login here</a></small>
        </div>
    </div>
</div>
@endsection