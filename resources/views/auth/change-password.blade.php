<!-- resources/views/auth/change-password.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container-fluid profile-container">
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="nav-content">
            <div class="greeting">
                <h2>Change Password</h2>
                <p>Update your account password</p>
            </div>
            <div class="nav-buttons">
                <a href="{{ route('profile') }}" class="nav-btn">
                    <i class="bi bi-person-circle"></i>
                    <span>My Profile</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="nav-btn">
                    <i class="bi bi-pencil-square"></i>
                    <span>Edit Profile</span>
                </a>
                <a href="{{ route('profile.reports') }}" class="nav-btn">
                    <i class="bi bi-graph-up"></i>
                    <span>Donation Reports</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-btn logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper">
            <div class="dashboard-card">
                <h2 class="mb-4">Change Password</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.user.change-password') }}">
                    @csrf

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <!-- Current Password -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label">Current Password *</label>
                                <input type="password" id="current_password" name="current_password" 
                                       class="form-control form-control-lg" required>
                                @error('current_password')
                                <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-4">
                                <label for="new_password" class="form-label">New Password *</label>
                                <input type="password" id="new_password" name="new_password" 
                                       class="form-control form-control-lg" required>
                                <small class="form-text text-muted">
                                    Password must be at least 8 characters long.
                                </small>
                                @error('new_password')
                                <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password *</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                       class="form-control form-control-lg" required>
                                @error('new_password_confirmation')
                                <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-actions mt-5 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-key me-2"></i>Change Password
                                </button>
                                <a href="{{ route('profile') }}" class="btn btn-secondary btn-lg ms-2">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
:root {
    --enved-primary: #164A25;
    --enved-secondary: #00AA55;
    --enved-light: #e8f5e8;
    --enved-dark: #0d3518;
    --enved-gradient: linear-gradient(135deg, var(--enved-primary) 0%, var(--enved-secondary) 100%);
}

.profile-container {
    min-height: 100vh;
    background: #f8fdf8;
}

/* Top Navigation */
.top-nav {
    background: white;
    box-shadow: 0 2px 10px rgba(22, 74, 37, 0.1);
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 100;
}

.nav-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.greeting h2 {
    color: var(--enved-primary);
    font-weight: 700;
    margin: 0;
    font-size: 1.8rem;
}

.greeting p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.nav-buttons {
    display: flex;
    gap: 10px;
}

.nav-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: white;
    color: var(--enved-primary);
    text-decoration: none;
    border-radius: 8px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-btn:hover {
    background: var(--enved-light);
    border-color: var(--enved-secondary);
    transform: translateY(-2px);
}

.nav-btn.active {
    background: var(--enved-gradient);
    color: white;
    box-shadow: 0 4px 12px rgba(22, 74, 37, 0.2);
}

.nav-btn.logout-btn:hover {
    background: #ffe6e6;
    border-color: #ff4444;
    color: #cc0000;
}

/* Main Content */
.main-content {
    padding: 30px 20px;
}

.content-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

/* Dashboard Card */
.dashboard-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 5px 20px rgba(22, 74, 37, 0.1);
    border: 1px solid #e8f5e8;
}

.dashboard-card h2 {
    color: var(--enved-primary);
    font-weight: 700;
    border-bottom: 2px solid var(--enved-light);
    padding-bottom: 15px;
}

/* Form Controls */
.form-control-lg {
    border: 2px solid #e8f5e8;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: var(--enved-secondary);
    box-shadow: 0 0 0 0.2rem rgba(0, 170, 85, 0.1);
}

.form-label {
    font-weight: 600;
    color: var(--enved-primary);
    margin-bottom: 8px;
}

.form-text {
    color: #6c757d;
    font-size: 0.875rem;
    margin-top: 5px;
}

/* Buttons */
.btn-primary {
    background: var(--enved-gradient);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.3);
}

.btn-secondary {
    background: #6c757d;
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

/* Error Messages */
.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

/* Form Actions */
.form-actions {
    border-top: 2px solid var(--enved-light);
}

/* Alerts */
.alert {
    border: none;
    border-radius: 8px;
    padding: 15px 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

/* Responsive */
@media (max-width: 768px) {
    .nav-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .nav-buttons {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .main-content {
        padding: 20px 15px;
    }
    
    .dashboard-card {
        padding: 25px;
    }
    
    .greeting h2 {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .nav-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .nav-btn {
        width: 100%;
        justify-content: center;
    }
    
    .dashboard-card {
        padding: 20px;
    }
    
    .btn-lg {
        padding: 10px 20px;
        font-size: 0.9rem;
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
@endsection