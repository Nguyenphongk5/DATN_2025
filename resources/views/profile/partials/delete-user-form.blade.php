<section class="mb-5">
    <div class="card border-danger shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="card-title text-danger fw-bold">🗑️ Delete Account</h5>
            <p class="card-text text-muted">
                Once your account is deleted, all of its data will be permanently removed. Please download any data you want to keep before proceeding.
            </p>

            <!-- Trigger Delete Modal -->
            <button type="button" class="btn btn-outline-danger rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                Delete Account
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">⚠️ Confirm Deletion</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Enter your password</label>
                            <input type="password" id="password" name="password"
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                   placeholder="Password" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger rounded-pill">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
