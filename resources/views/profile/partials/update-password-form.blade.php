<section class="mb-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="card-title fw-bold text-primary">🔐 Update Password</h5>
            <p class="card-text text-muted">Use a strong password to keep your account secure.</p>

            <form method="POST" action="{{ route('password.update') }}" class="mt-4">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div class="mb-4">
                    <label for="update_password_current_password" class="form-label fw-semibold">Current Password</label>
                    <input type="password" name="current_password" id="update_password_current_password" autocomplete="current-password"
                           class="form-control form-control-lg rounded-3 shadow-sm @error('current_password', 'updatePassword') is-invalid @enderror">
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="update_password_password" class="form-label fw-semibold">New Password</label>
                    <input type="password" name="password" id="update_password_password" autocomplete="new-password"
                           class="form-control form-control-lg rounded-3 shadow-sm @error('password', 'updatePassword') is-invalid @enderror">
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="update_password_password_confirmation" autocomplete="new-password"
                           class="form-control form-control-lg rounded-3 shadow-sm @error('password_confirmation', 'updatePassword') is-invalid @enderror">
                    @error('password_confirmation', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-warning rounded-pill px-4">Save</button>

                    @if (session('status') === 'password-updated')
                        <span class="text-success small fw-semibold ms-3">✔ Password updated!</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
