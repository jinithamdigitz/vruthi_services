@extends('layouts.main')

@section('content')
<div class="container-fluid profile-container">
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="nav-content">
            <div class="greeting">
                <h2>Hello, {{ Auth::user()->name }}!</h2>
                <p>View your donation reports and history</p>
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
                <a href="{{ route('profile.reports') }}" class="nav-btn active">
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
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1">Donation Reports</h2>
                            <p class="text-muted mb-0">View and filter your donation history</p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Filter Reports</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.reports') }}" method="GET">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label for="start_date" class="form-label">From Date</label>
                                        <input type="date" class="form-control form-control-lg" id="start_date" name="start_date" 
                                               value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_date" class="form-label">To Date</label>
                                        <input type="date" class="form-control form-control-lg" id="end_date" name="end_date" 
                                               value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select form-control-lg" id="status" name="status">
                                            <option value="">All Status</option>
                                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="created" {{ request('status') == 'created' ? 'selected' : '' }}>Created</option>
                                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary w-100 me-2">Apply Filter</button>
                                        <a href="{{ route('profile.reports') }}" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card primary">
                        <div class="stat-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Total Amount</div>
                            <div class="stat-value">₹{{ number_format($totalAmount, 2) }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card success">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Total Donations</div>
                            <div class="stat-value">{{ $totalDonations }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card info">
                        <div class="stat-icon">
                            <i class="bi bi-funnel"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Filtered Results</div>
                            <div class="stat-value">{{ $filteredCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card warning">
                        <div class="stat-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Successful</div>
                            <div class="stat-value">{{ $successfulCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donations Table -->
            <div class="row">
                <div class="col-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Donation History</h5>
                                <span class="badge">{{ $donations->total() }} records</span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($donations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Order ID</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Payment Method</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($donations as $donation)
                                        <tr>
                                            <td>{{ $donation->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <code class="text-muted">{{ Str::limit($donation->id, 10) }}</code>
                                            </td>
                                            <td class="fw-bold text-success">₹{{ number_format($donation->amount, 2) }}</td>
                                            <td>
                                                <span class="status-badge 
                                                    @if($donation->order_status == 'completed') completed
                                                    @elseif($donation->order_status == 'created') created
                                                    @else failed
                                                    @endif">
                                                    {{ ucfirst($donation->order_status) }}
                                                </span>
                                            </td>
                                            <td>Razorpay</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#donationModal{{ $donation->id }}">
                                                    <i class="bi bi-eye me-1"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Showing {{ $donations->firstItem() }} to {{ $donations->lastItem() }} of {{ $donations->total() }} results
                                </div>
                                <nav>
                                    {{ $donations->appends(request()->query())->links() }}
                                </nav>
                            </div>
                            @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <h5 class="text-muted mt-3">No donations found</h5>
                                <p class="text-muted">No donations match your current filter criteria.</p>
                                <a href="{{ route('donate.form') }}" class="btn btn-primary">
                                    <i class="bi bi-heart me-1"></i> Make a Donation
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Donation Detail Modals -->
@foreach($donations as $donation)
<div class="modal fade" id="donationModal{{ $donation->id }}" tabindex="-1" aria-labelledby="donationModalLabel{{ $donation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Order ID:</strong></td>
                                <td><code>{{ $donation->id }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td class="fw-bold text-success">₹{{ number_format($donation->amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="status-badge 
                                        @if($donation->order_status == 'completed') completed
                                        @elseif($donation->order_status == 'created') created
                                        @else failed
                                        @endif">
                                        {{ ucfirst($donation->order_status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Date:</strong></td>
                                <td>{{ $donation->created_at->format('F j, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $donation->email_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $donation->phonenumber }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if($donation->address)
                <div class="row mt-3">
                    <div class="col-12">
                        <strong>Address:</strong>
                        <p class="mt-1">{{ $donation->address }}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
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
    max-width: 1400px;
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

/* Dashboard Card */
.dashboard-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(22, 74, 37, 0.1);
    border: 1px solid #e8f5e8;
    margin-bottom: 25px;
}

.dashboard-card .card-header {
    background: transparent;
    border-bottom: 2px solid var(--enved-light);
    padding: 0 0 20px 0;
    margin-bottom: 20px;
}

.dashboard-card .card-title {
    color: var(--enved-primary);
    font-weight: 600;
    margin: 0;
}

/* Statistics Cards */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(22, 74, 37, 0.08);
    border: 1px solid #e8f5e8;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(22, 74, 37, 0.12);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
}

.stat-card.primary .stat-icon {
    background: var(--enved-gradient);
    color: white;
}

.stat-card.success .stat-icon {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.stat-card.info .stat-icon {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    color: white;
}

.stat-card.warning .stat-icon {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

.stat-content {
    flex: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: #666;
    font-weight: 500;
    margin-bottom: 5px;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--enved-primary);
    line-height: 1;
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

/* Buttons */
.btn-primary {
    background: var(--enved-gradient);
    border: none;
    padding: 12px 25px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.3);
}

.btn-outline-primary {
    border: 2px solid var(--enved-primary);
    color: var(--enved-primary);
    background: transparent;
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: var(--enved-primary);
    color: white;
    transform: translateY(-2px);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
    background: transparent;
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
}

/* Table Styles */
.table th {
    border-top: none;
    font-weight: 600;
    background-color: #f8f9fa;
    color: var(--enved-primary);
    padding: 15px 12px;
    border-bottom: 2px solid var(--enved-light);
}

.table td {
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #e8f5e8;
}

.table tbody tr:hover {
    background-color: #f8fdf8;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
}

.status-badge.completed {
    background: #d4edda;
    color: #155724;
}

.status-badge.created {
    background: #d1ecf1;
    color: #0c5460;
}

.status-badge.failed {
    background: #f8d7da;
    color: #721c24;
}

/* Badge */
.badge {
    background: var(--enved-gradient);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
}

/* Modal Styles */
.modal-content {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.modal-header {
    background: var(--enved-gradient);
    color: white;
    border-radius: 15px 15px 0 0;
    padding: 20px 25px;
    border-bottom: none;
}

.modal-title {
    font-weight: 600;
    margin: 0;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    border-top: 1px solid #e8f5e8;
    padding: 20px 25px;
    border-radius: 0 0 15px 15px;
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
        padding: 20px;
    }
    
    .stat-card {
        flex-direction: column;
        text-align: center;
        gap: 15px;
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
        padding: 15px;
    }
    
    .btn {
        padding: 10px 15px;
        font-size: 0.9rem;
    }
    
    .stat-value {
        font-size: 1.5rem;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-set end date to today if start date is selected
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    if (startDate && endDate) {
        startDate.addEventListener('change', function() {
            if (this.value && !endDate.value) {
                endDate.value = new Date().toISOString().split('T')[0];
            }
        });
    }
});
</script>
@endsection