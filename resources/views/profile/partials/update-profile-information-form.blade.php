<section class="mb-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="card-title fw-bold text-primary">👤 Profile Information</h5>
            <p class="card-text text-muted">Update your name and email address.</p>

            <!-- Resend verification form -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <!-- Profile update form -->
            <form method="POST" action="{{ route('profile.update') }}" class="mt-4">
                @csrf
                @method('patch')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Full Name</label>
                    <input id="name" name="name" type="text" class="form-control form-control-lg rounded-3 shadow-sm @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control form-control-lg rounded-3 shadow-sm @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3">
                            <p class="text-sm text-warning">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to re-send the verification email.') }}</button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-success small fw-semibold">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save</button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success small fw-semibold ms-3">✔ Profile saved.</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
