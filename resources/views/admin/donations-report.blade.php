@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #164A25, #00AA55);">
                    <h3 class="card-title text-white">Donation Reports</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.donations.export') }}?{{ http_build_query(request()->query()) }}" 
                           class="btn btn-light btn-sm">
                            <i class="fa fa-download"></i> Export CSV
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Filter Donations</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.donations.index') }}" method="GET" class="row g-3 align-items-end">
                                        <div class="col-md-2">
                                            <label for="start_date" class="form-label">From Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                                   value="{{ request('start_date') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="end_date" class="form-label">To Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                                   value="{{ request('end_date') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="status" class="form-label">Order Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="">All Status</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="created" {{ request('status') == 'created' ? 'selected' : '' }}>Created</option>
                                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="payment_status" class="form-label">Payment Status</label>
                                            <select class="form-select" id="payment_status" name="payment_status">
                                                <option value="">All Payments</option>
                                                <option value="success" {{ request('payment_status') == 'success' ? 'selected' : '' }}>Success</option>
                                                <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="donor_type" class="form-label">Donor Type</label>
                                            <select class="form-select" id="donor_type" name="donor_type">
                                                <option value="">All Types</option>
                                                <option value="Individual/Residential" {{ request('donor_type') == 'Individual/Residential' ? 'selected' : '' }}>Individual</option>
                                                <option value="Association/Education" {{ request('donor_type') == 'Association/Education' ? 'selected' : '' }}>Association/Education</option>
                                                <option value="Institution/Corporate/Commercial" {{ request('donor_type') == 'Institution/Corporate/Commercial' ? 'selected' : '' }}>Corporate</option>
                                                <option value="Establishment" {{ request('donor_type') == 'Establishment' ? 'selected' : '' }}>Establishment</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                                                <a href="{{ route('admin.donations.index') }}" class="btn btn-outline-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Quick Date Filters -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.donations.index', ['start_date' => today()->format('Y-m-d'), 'end_date' => today()->format('Y-m-d')]) }}" 
                                                   class="btn btn-outline-primary btn-sm {{ request('start_date') == today()->format('Y-m-d') && request('end_date') == today()->format('Y-m-d') ? 'active' : '' }}">
                                                    Today
                                                </a>
                                                <a href="{{ route('admin.donations.index', ['start_date' => today()->subDays(7)->format('Y-m-d')]) }}" 
                                                   class="btn btn-outline-primary btn-sm {{ request('start_date') == today()->subDays(7)->format('Y-m-d') ? 'active' : '' }}">
                                                    Last 7 Days
                                                </a>
                                                <a href="{{ route('admin.donations.index', ['start_date' => today()->subDays(30)->format('Y-m-d')]) }}" 
                                                   class="btn btn-outline-primary btn-sm {{ request('start_date') == today()->subDays(30)->format('Y-m-d') ? 'active' : '' }}">
                                                    Last 30 Days
                                                </a>
                                                <a href="{{ route('admin.donations.index', ['start_date' => today()->startOfMonth()->format('Y-m-d')]) }}" 
                                                   class="btn btn-outline-primary btn-sm {{ request('start_date') == today()->startOfMonth()->format('Y-m-d') ? 'active' : '' }}">
                                                    This Month
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Statistics Cards -->
                    <div class="row mb-4">
                        <!-- Existing Statistics -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Total Donations</h6>
                                            <h3>₹{{ number_format($stats['totalAmount'], 2) }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-rupee-sign fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Successful</h6>
                                            <h3>{{ $stats['successfulCount'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Pending</h6>
                                            <h3>{{ $stats['pendingCount'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Failed</h6>
                                            <h3>{{ $stats['failedCount'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-times-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Money Donation Statistics -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Money Donations</h6>
                                            <h3>{{ $stats['moneyDonationsCount'] }}</h3>
                                            <small>₹{{ number_format($stats['moneyDonationsAmount'], 2) }}</small>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-money-bill-wave fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card text-white bg-secondary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">GDPR Consent</h6>
                                            <h3>{{ $stats['gdprConsentCount'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-shield-alt fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Statistics Row -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0">Donations by Donor Type</h6>
                                </div>
                                <div class="card-body">
                                    @if($donorTypeStats->count() > 0)
                                        @foreach($donorTypeStats as $type => $amount)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>{{ $type }}</span>
                                            <span class="badge bg-primary">₹{{ number_format($amount, 2) }}</span>
                                        </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">No donor type data available</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0">Donations by Cause</h6>
                                </div>
                                <div class="card-body">
                                    @if($causeStats->count() > 0)
                                        @foreach($causeStats as $cause => $amount)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>{{ $cause }}</span>
                                            <span class="badge bg-success">₹{{ number_format($amount, 2) }}</span>
                                        </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">No cause data available</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Donations Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Donor Name</th>
                                    <th>Email</th>
                                    <th>Amount</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Donor Type</th>
                                    <th>Preferred Cause</th>
                                    <th>GDPR</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as $donation)
                                <tr>
                                    <td><code>{{ $donation->id }}</code></td>
                                    <td>{{ $donation->name }}</td>
                                    <td>{{ $donation->email_id }}</td>
                                    <td class="font-weight-bold text-success">₹{{ number_format($donation->amount, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ 
                                            $donation->order_status == 'completed' ? 'success' : 
                                            ($donation->order_status == 'pending' ? 'warning' : 
                                            ($donation->order_status == 'created' ? 'info' : 'danger')) 
                                        }}">
                                            {{ ucfirst($donation->order_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ 
                                            $donation->payment_status == 'success' ? 'success' : 
                                            ($donation->payment_status == 'pending' ? 'warning' : 'danger') 
                                        }}">
                                            {{ $donation->payment_status ? ucfirst($donation->payment_status) : 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($donation->donor_type)
                                            <span class="badge bg-info">{{ $donation->donor_type }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($donation->preferred_cause)
                                            <small class="text-primary">{{ $donation->preferred_cause }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($donation->gdpr_consent)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>{{ $donation->phonenumber }}</td>
                                    <td>{{ $donation->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.donations.show', $donation->id) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="View Details">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (same as before) -->
                    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                        <div class="text-muted">
                            Showing {{ $donations->firstItem() ?? 0 }} to {{ $donations->lastItem() ?? 0 }} of {{ $donations->total() }} entries
                        </div>
                        
                        {{ $donations->appends(request()->query())->links() }}
                        
                        <div class="d-flex align-items-center">
                            <label for="perPage" class="me-2 mb-0 small">Show:</label>
                            <select class="form-select form-select-sm" id="perPage" onchange="changePerPage(this.value)" style="width: auto;">
                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.badge.badge-success
{
	background-color: #28a745;
}
/* Custom Badge Styles */
.badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}

.badge-success {
    color: #fff;
    background-color: #28a745;
}

.badge-warning {
    color: #212529;
    background-color: #ffc107;
}

.badge-danger {
    color: #fff;
    background-color: #dc3545;
}

.badge-info {
    color: #fff;
    background-color: #17a2b8;
}

.badge-primary {
    color: #fff;
    background-color: #007bff;
}

.badge-secondary {
    color: #fff;
    background-color: #6c757d;
}

/* Card and Table Styles */
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}
.card-header {
    border-bottom: 1px solid #e3e6f0;
}

.table th {
    border-top: none;
    background-color: #f8f9fc;
    color: #164A25;
    font-weight: 600;
}

.table-dark th {
    background-color: #343a40;
    color: white;
}

.btn-group .btn.active {
    background-color: #164A25;
    border-color: #164A25;
    color: white;
}

/* Table row hover effect */
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        align-items: start !important;
        gap: 15px;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .row.mb-4 > div {
        margin-bottom: 15px;
    }
}

/* Custom pagination styling */
.pagination .page-item.active .page-link {
    background-color: #164A25;
    border-color: #164A25;
}

.pagination .page-link {
    color: #164A25;
    border: 1px solid #dee2e6;
}

.pagination .page-link:hover {
    color: #00AA55;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

/* Statistics cards hover effect */
.card.text-white:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}
</style>
@endpush

@push('scripts')
<script>
// Your existing JavaScript remains the same
document.addEventListener('DOMContentLoaded', function() {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    if (startDate && endDate) {
        startDate.addEventListener('change', function() {
            if (this.value && !endDate.value) {
                endDate.value = new Date().toISOString().split('T')[0];
            }
        });
    }

    if (!startDate.value && !endDate.value) {
        startDate.value = new Date().toISOString().split('T')[0];
        endDate.value = new Date().toISOString().split('T')[0];
    }
});

function changePerPage(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>
@endpush