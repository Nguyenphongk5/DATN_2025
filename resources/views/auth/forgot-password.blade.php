@extends('layouts.user')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 160px); background-color: #f8f9fa;">
    <div class="card shadow-lg rounded-4 p-5" style="width: 100%; max-width: 520px;">
        <div class="text-center mb-4">
            <h1 class="fw-bold display-6 text-primary">Forgot Password?</h1>
            <p class="text-muted fs-6">
                No problem. Enter your email and we’ll send you a link to reset your password.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success text-center py-2 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email') }}"
                    required autofocus
                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                    placeholder="you@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
