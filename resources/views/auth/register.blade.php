@extends('layouts.user')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 160px); background-color: #f8f9fa;">
    <div class="card shadow-lg rounded-4 p-5" style="width: 100%; max-width: 520px;">
        <div class="text-center mb-4">
            <h1 class="fw-bold display-6 mb-1 text-primary">Create Account ✨</h1>
            <p class="text-muted fs-6">Register to get started</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="form-control form-control-lg @error('name') is-invalid @enderror" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control form-control-lg @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input id="password" type="password" name="password"
                       class="form-control form-control-lg @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Already registered + Submit -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('login') }}" class="small text-decoration-none">Already have an account?</a>
                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
