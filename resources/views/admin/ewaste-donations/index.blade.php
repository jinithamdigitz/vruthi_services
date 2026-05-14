@extends('layouts.admin')

@section('title', 'E-Waste Donations Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">E-Waste Donations Management</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.ewaste-donations.export') }}" class="btn btn-success">
                        <i class="fas fa-download me-1"></i> Export CSV
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-2">Total Donations</p>
                            <h4 class="mb-0">{{ $totalDonations }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-recycle text-success fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-2">Pending</p>
                            <h4 class="mb-0">{{ $pendingDonations }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-warning fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-2">Scheduled</p>
                            <h4 class="mb-0">{{ $scheduledDonations }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-check text-info fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-2">Completed</p>
                            <h4 class="mb-0">{{ $completedDonations }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-success fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.ewaste-donations.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Search by name, email, location, waste type...">
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                        <label for="start_date" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="end_date" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-12">
                        <div class="hstack gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('admin.ewaste-donations.index') }}" class="btn btn-light">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-centered table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Donor</th>
                            <th>Contact</th>
                            <th>Donor Type</th>
                            <th>Pickup Location</th>
                            <th>Waste Type</th>
                            <th>GDPR Consent</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success bg-opacity-10 text-success rounded-circle">
                                                {{ substr($donation->name, 0, 1) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $donation->name }}</h6>
                                        <small class="text-muted">{{ $donation->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $donation->phone }}</td>
                            <td>
                                <span class="badge {{ $donation->donor_type_badge }}">
                                    @if($donation->donor_type == 'Individual/Residential')
                                        Individual
                                    @elseif($donation->donor_type == 'Association/Education')
                                        Association
                                    @elseif($donation->donor_type == 'Institution/Corporate/Commercial')
                                        Corporate
                                    @else
                                        Establishment
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 200px;" 
                                      title="{{ $donation->pickup_location }}">
                                    {{ \Illuminate\Support\Str::limit($donation->pickup_location, 50) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 200px;" 
                                      title="{{ $donation->waste_type }}">
                                    {{ \Illuminate\Support\Str::limit($donation->waste_type, 50) }}
                                </span>
                            </td>
                            <td>
                                @if($donation->gdpr_consent)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'approved' => 'info',
                                        'scheduled' => 'primary', 
                                        'completed' => 'success',
                                        'cancelled' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$donation->status] ?? 'secondary' }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td>{{ $donation->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="hstack gap-2">
                                    <a href="{{ route('admin.ewaste-donations.show', $donation->id) }}" 
                                       class="btn btn-sm btn-light" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('admin.ewaste-donations.status', $donation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="dropdown-item text-info">
                                                        <i class="fas fa-check me-2"></i>Approve
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.ewaste-donations.status', $donation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="scheduled">
                                                    <button type="submit" class="dropdown-item text-primary">
                                                        <i class="fas fa-calendar me-2"></i>Schedule Pickup
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.ewaste-donations.status', $donation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="dropdown-item text-success">
                                                        <i class="fas fa-check-double me-2"></i>Mark Complete
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.ewaste-donations.status', $donation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-times me-2"></i>Cancel
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.ewaste-donations.destroy', $donation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('Are you sure you want to delete this donation?')">
                                                        <i class="fas fa-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-recycle fa-2x mb-3"></i>
                                    <h5>No e-waste donations found</h5>
                                    <p>No donation requests match your current filters.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($donations->hasPages())
            <div class="row mt-3">
                <div class="col-sm-12">
                    {{ $donations->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto-submit form when date range changes
    $('#start_date, #end_date').change(function() {
        if($('#start_date').val() && $('#end_date').val()) {
            $('#filterForm').submit();
        }
    });

    // Status change confirmation
    $('form[action*="status"]').on('submit', function(e) {
        const status = $(this).find('input[name="status"]').val();
        const action = $(this).find('button').text().trim();
        if(!confirm(`Are you sure you want to ${action} this donation?`)) {
            e.preventDefault();
        }
    });

    // Reset end date if start date is after end date
    $('#start_date').change(function() {
        const startDate = new Date($(this).val());
        const endDate = new Date($('#end_date').val());
        
        if($('#end_date').val() && startDate > endDate) {
            $('#end_date').val('');
        }
    });
});
</script>
@endsection

@section('styles')
<style>
.card-height-100 {
    height: 100%;
}
.avatar-title {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}
.badge {
    font-size: 0.75em;
}
.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}
.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
@endsection