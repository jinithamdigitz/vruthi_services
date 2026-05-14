@extends('layouts.main')

@section('content')
<div class="container-fluid profile-container">
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="nav-content">
            <div class="greeting">
                <h2>Hello, {{ Auth::user()->name }}!</h2>
                <p>Welcome to your dashboard</p>
            </div>
            <div class="nav-buttons">
                <a href="{{ route('profile') }}" class="nav-btn active">
                    <i class="bi bi-person-circle"></i>
                    <span>My Profile</span>
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
                @if(Auth::user()->cover_image)
                <img src="{{ asset(Auth::user()->cover_image) }}" alt="Cover Image" class="cover-image">
                @endif

                <div class="profile-section">
                    <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('default-avatar.png') }}" alt="User" />
                    <div>
                        <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                        <p class="mb-1">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->locations)
                        <p class="mb-0"><strong>Location:</strong> {{ Auth::user()->locations }}</p>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm mt-2">Edit Profile</a>
                    </div>
                </div>

                @if(Auth::user()->description)
                <div class="description-box mt-4">
                    <h6 class="fw-bold mb-2">About Me</h6>
                    <p class="mb-0">{{ Auth::user()->description }}</p>
                </div>
                @endif

                <!-- Quick Stats -->
                <div class="quick-stats mt-4">
                    <h6 class="fw-bold mb-3">Quick Overview</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="quick-stat-card">
                                <i class="bi bi-cash-coin"></i>
                                <div>
                                    <h5>₹{{ number_format($totalDonations, 2) }}</h5>
                                    <p>Total Donated</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quick-stat-card">
                                <i class="bi bi-heart-fill"></i>
                                <div>
                                    <h5>{{ $successfulDonations }}</h5>
                                    <p>Total Donations</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quick-stat-card">
                                <i class="bi bi-calendar-check"></i>
                                <div>
                                    <h5>{{ $thisMonthDonations }}</h5>
                                    <p>This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    max-width: 1000px;
    margin: 0 auto;
}

/* Dashboard Card */
.dashboard-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(22, 74, 37, 0.1);
    border: 1px solid #e8f5e8;
}

/* Profile Section */
.profile-section {
    display: flex;
    align-items: center;
    gap: 25px;
    padding: 20px 0;
    border-bottom: 1px solid #e8f5e8;
}

.profile-section img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid var(--enved-secondary);
    object-fit: cover;
}

.profile-section h4 {
    color: var(--enved-primary);
    font-weight: 700;
}

.profile-section p {
    color: #666;
    margin-bottom: 5px;
}

/* Buttons */
.btn-primary {
    background: var(--enved-gradient);
    border: none;
    padding: 8px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(22, 74, 37, 0.3);
}

/* Description Box */
.description-box {
    background: linear-gradient(135deg, #f8fdf8 0%, #e8f5e8 100%);
    border: 1px solid var(--enved-secondary);
    border-radius: 10px;
    padding: 20px;
}

.description-box h6 {
    color: var(--enved-primary);
}

/* Quick Stats */
.quick-stats {
    border-top: 1px solid #e8f5e8;
    padding-top: 25px;
}

.quick-stats h6 {
    color: var(--enved-primary);
}

.quick-stat-card {
    background: linear-gradient(135deg, #ffffff 0%, var(--enved-light) 100%);
    border: 1px solid #e8f5e8;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s ease;
}

.quick-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.1);
    border-color: var(--enved-secondary);
}

.quick-stat-card i {
    font-size: 2rem;
    color: var(--enved-secondary);
}

.quick-stat-card h5 {
    color: var(--enved-primary);
    font-weight: 700;
    margin: 0;
}

.quick-stat-card p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

/* Cover Image */
.cover-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 20px;
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
    
    .profile-section {
        flex-direction: column;
        text-align: center;
    }
    
    .quick-stat-card {
        margin-bottom: 15px;
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
}
</style>
@endsection