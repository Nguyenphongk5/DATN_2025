<section class="mb-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="card-title fw-bold text-primary">🖼️ Update Avatar</h5>
            <p class="card-text text-muted">Upload a new profile picture for your account.</p>

            <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                @method('put')

                <!-- Avatar preview -->
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle shadow" width="150" height="150" id="avatar-preview">
                </div>

                <!-- File input -->
                <div class="mb-4">
                    <label for="avatar" class="form-label fw-semibold">Choose new avatar</label>
                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(event)">
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-success rounded-pill px-4">Save</button>

                    @if (session('status') === 'avatar-updated')
                        <span class="text-success small fw-semibold">&#x2714; Avatar updated!</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('avatar-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
