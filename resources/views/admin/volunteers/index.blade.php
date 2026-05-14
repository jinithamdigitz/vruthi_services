@extends('layouts.admin')

@section('title', 'Volunteers Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Volunteers Management</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.volunteers.export') }}" class="btn btn-success">
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
                            <p class="text-muted mb-2">Total Volunteers</p>
                            <h4 class="mb-0">{{ $totalVolunteers }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-users text-success fs-2"></i>
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
                            <h4 class="mb-0">{{ $pendingVolunteers }}</h4>
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
                            <p class="text-muted mb-2">Approved</p>
                            <h4 class="mb-0">{{ $approvedVolunteers }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-success fs-2"></i>
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
                            <p class="text-muted mb-2">This Month</p>
                            <h4 class="mb-0">{{ $thisMonthVolunteers }}</h4>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar text-info fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.volunteers.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Search by name, email, location...">
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cause" class="form-label">Preferred Cause</label>
                        <select class="form-select" id="cause" name="cause">
                            <option value="">All Causes</option>
                            <option value="Collection Drive" {{ request('cause') == 'Collection Drive' ? 'selected' : '' }}>Collection Drive</option>
                            <option value="E-waste Awareness" {{ request('cause') == 'E-waste Awareness' ? 'selected' : '' }}>E-waste Awareness</option>
                            <option value="Educational Sessions" {{ request('cause') == 'Educational Sessions' ? 'selected' : '' }}>Educational Sessions</option>
                            <option value="Corporate Events" {{ request('cause') == 'Corporate Events' ? 'selected' : '' }}>Corporate Events</option>
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
                            <a href="{{ route('admin.volunteers.index') }}" class="btn btn-light">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Volunteers Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-centered table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Preferred Causes</th>
                            <th>GDPR Consent</th>
                            <th>Status</th>
                            <th>Registered Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($volunteers as $volunteer)
                        <tr>
                            <td>{{ $volunteer->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success bg-opacity-10 text-success rounded-circle">
                                                {{ substr($volunteer->name, 0, 1) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        {{ $volunteer->name }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $volunteer->email }}</td>
                            <td>{{ $volunteer->phone }}</td>
                            <td>{{ $volunteer->location }}</td>
                            <td>
                                @foreach($volunteer->preferred_causes as $cause)
                                    <span class="badge bg-success bg-opacity-10 text-success mb-1">{{ $cause }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($volunteer->gdpr_consent)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $volunteer->status == 'approved' ? 'success' : ($volunteer->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($volunteer->status) }}
                                </span>
                            </td>
                            <td>{{ $volunteer->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="hstack gap-2">
                                    <a href="{{ route('admin.volunteers.show', $volunteer->id) }}" 
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
                                                <form action="{{ route('admin.volunteers.status', $volunteer->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="dropdown-item text-success">
                                                        <i class="fas fa-check me-2"></i>Approve
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.volunteers.status', $volunteer->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-times me-2"></i>Reject
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.volunteers.destroy', $volunteer->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('Are you sure you want to delete this volunteer?')">
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
                                    <i class="fas fa-users fa-2x mb-3"></i>
                                    <h5>No volunteers found</h5>
                                    <p>No volunteer registrations match your current filters.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($volunteers->hasPages())
            <div class="row mt-3">
                <div class="col-sm-12">
                    {{ $volunteers->links() }}
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
        const action = status === 'approved' ? 'approve' : 'reject';
        if(!confirm(`Are you sure you want to ${action} this volunteer?`)) {
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
</style>
@endsection