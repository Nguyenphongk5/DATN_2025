@extends('layouts.user')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 160px); background-color: #f8f9fa;">
    <div class="card shadow-lg rounded-4 p-5" style="width: 100%; max-width: 500px;">
        <div class="text-center mb-4">
            <h1 class="fw-bold display-6 mb-1 text-primary">Welcome Back 👋</h1>
            <p class="text-muted fs-6">Login to your account to continue</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success text-center py-2">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-3">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="form-label fs-6 fw-semibold">Email address</label>
                <input id="email" name="email" type="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label fs-6 fw-semibold">Password</label>
                <input id="password" name="password" type="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                    required placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember + Forgot -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-decoration-none small" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill">Log In</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <span class="text-muted">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Create one</a>
        </div>
    </div>
</div>
@endsection
