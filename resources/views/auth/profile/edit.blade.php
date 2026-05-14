@extends('layouts.main')

@section('title', 'Edit Profile')

@section('content')
<div class="container-fluid py-4 profilecard">
    <div class="row">
        <!-- Left Side Menu -->
        <div class="col-md-3 col-lg-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="bi bi-person-circle me-2"></i>My Account</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-person me-2"></i>Profile Overview
                        </a>
                        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action active">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-shield-lock me-2"></i>Security
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-bell me-2"></i>Notifications
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-credit-card me-2"></i>Billing
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                        <!-- Add more menu items as needed -->
                        <div class="list-group-item text-muted small">
                            QUICK LINKS
                        </div>
                        <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-house me-2"></i>Back to Home
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Profile</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information Section -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-person me-2"></i>Personal Information</h5>
                            
                            <!-- Name Field -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Change Section -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-shield-lock me-2"></i>Change Password</h5>
                            <p class="text-muted small mb-3">Leave password fields blank if you don't want to change your password.</p>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- Current Password -->
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" name="current_password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- New Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Confirm New Password -->
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" 
                                               id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Profile
                            </a>
                            <div>
                                <button type="reset" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border: none;
    padding: 1rem 1.5rem;
}

.list-group-item {
    border: none;
    padding: 1rem 1.5rem;
    color: #495057;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}

.list-group-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    font-weight: 600;
}

.list-group-item:first-child {
    border-radius: 0;
}

.list-group-item:last-child {
    border-radius: 0 0 12px 12px;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 10px 25px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.1) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-md-3 {
        margin-bottom: 1.5rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .list-group-item {
        padding: 0.75rem 1rem;
    }
}
</style>
@endsection