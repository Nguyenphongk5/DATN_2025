@extends('layouts.user')

@section('content')
<div class="container py-5">
    <!-- Tiêu đề -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">👤 Profile Settings</h2>
        <p class="text-muted mb-0">Manage your account settings and preferences</p>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-pills mb-4 justify-content-center" id="profileTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-avatar" data-bs-toggle="pill" data-bs-target="#pane-avatar" type="button" role="tab">Avatar</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-info" data-bs-toggle="pill" data-bs-target="#pane-info" type="button" role="tab">Information</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-password" data-bs-toggle="pill" data-bs-target="#pane-password" type="button" role="tab">Password</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-danger" id="tab-delete" data-bs-toggle="pill" data-bs-target="#pane-delete" type="button" role="tab">Danger Zone</button>
        </li>
    </ul>

    <!-- Nội dung tab -->
    <div class="tab-content bg-white shadow rounded-4 p-4" id="profileTabContent">

        <div class="tab-pane fade show active" id="pane-avatar" role="tabpanel">
            <h5 class="fw-bold mb-3">Update Profile Picture</h5>
            <div class="col-md-8">
                @include('profile.partials.update-profile-avatar')
            </div>
        </div>

        <div class="tab-pane fade" id="pane-info" role="tabpanel">
            <h5 class="fw-bold mb-3">Update Personal Information</h5>
            <div class="col-md-8">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="tab-pane fade" id="pane-password" role="tabpanel">
            <h5 class="fw-bold mb-3">Change Password</h5>
            <div class="col-md-8">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="tab-pane fade" id="pane-delete" role="tabpanel">
            <h5 class="fw-bold text-danger mb-3">Delete Account</h5>
            <div class="col-md-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Nếu có session('status') thì tạo 1 toast tự động hiển thị
    @if (session('status'))
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 m-4 show';
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ✅ {{ session('status') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
    @endif
</script>
@endpush
