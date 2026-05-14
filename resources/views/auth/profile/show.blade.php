@extends('layouts.main')

@section('title', 'My Profile')

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
                        <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action active">
                            <i class="bi bi-person me-2"></i>Profile Overview
                        </a>
                        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                         <a href="{{ route('frontend.profits.index') }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('frontend.profits.*') ? 'active' : '' }}">
        <i class="bi bi-graph-up me-2"></i>My Profits
    </a>
                      
                       
                        <!-- Add more menu items as needed -->
                        <div class="list-group-item text-muted small">
                            QUICK LINKS
                        </div>
                        <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-house me-2"></i>Back to Home
                        </a>
                        <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action">
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
                    <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>My Profile</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Profile Information -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="profile-icon-large mx-auto mb-3">
                                {{ substr($user->name, 0, 1) }}{{ substr($user->name, strpos($user->name, ' ') + 1, 1) ?? '' }}
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-3">{{ $user->name }}</h3>
                            <p class="text-muted mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                <strong>Email:</strong> {{ $user->email }}
                            </p>
                            <p class="text-muted mb-2">
                                <i class="bi bi-calendar me-2"></i>
                                <strong>Member since:</strong> {{ $user->created_at->format('M d, Y') }}
                            </p>
                            <p class="text-muted mb-0">
                                <i class="bi bi-clock me-2"></i>
                                <strong>Last updated:</strong> {{ $user->updated_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Account Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Account Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-5 fw-bold text-muted">Full Name:</div>
                                        <div class="col-sm-7">{{ $user->name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-5 fw-bold text-muted">Email Address:</div>
                                        <div class="col-sm-7">{{ $user->email }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-5 fw-bold text-muted">Account Status:</div>
                                        <div class="col-sm-7">
                                            <span class="badge bg-success">Active</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5 fw-bold text-muted">Account Type:</div>
                                        <div class="col-sm-7">
                                            <span class="badge bg-primary">Regular User</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="bi bi-shield-check me-2"></i>Security</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-7 fw-bold text-muted">Password Last Updated:</div>
                                        <div class="col-sm-5">
                                            {{ $user->updated_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-7 fw-bold text-muted">Two-Factor Authentication:</div>
                                        <div class="col-sm-5">
                                            <span class="badge bg-warning">Disabled</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7 fw-bold text-muted">Email Verification:</div>
                                        <div class="col-sm-5">
                                            <span class="badge bg-success">Verified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Profile
                                </a>
                                <a href="{{ route('profile.edit') }}#password" class="btn btn-outline-primary">
                                    <i class="bi bi-shield-lock me-2"></i>Change Password
                                </a>
                                <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-house me-2"></i>Back to Home
                                </a>
                                <a href="{{ route('profile.show') }}" class="btn btn-outline-info">
                                    <i class="bi bi-speedometer2 me-2"></i>Go to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-icon-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

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

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.1) !important;
}

.badge {
    font-size: 0.75em;
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
    
    .profile-icon-large {
        width: 80px;
        height: 80px;
        font-size: 1.5rem;
    }
}
</style>
@endsection