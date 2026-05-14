@extends('layouts.admin')

@section('title', 'Volunteer Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Volunteer Details</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.volunteers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Volunteers
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <!-- Volunteer Information Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <div class="avatar-lg">
                                <div class="avatar-title bg-success bg-opacity-10 text-success rounded-circle fs-2">
                                    {{ substr($volunteer->name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">{{ $volunteer->name }}</h5>
                            <p class="text-muted mb-0">{{ $volunteer->email }}</p>
                            <div class="mt-2">
                                <span class="badge bg-{{ $volunteer->status == 'approved' ? 'success' : ($volunteer->status == 'pending' ? 'warning' : 'danger') }} fs-6">
                                    {{ ucfirst($volunteer->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <p class="text-muted mb-0">{{ $volunteer->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <p class="text-muted mb-0">{{ $volunteer->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Preferred Location</label>
                                <p class="text-muted mb-0">{{ $volunteer->location }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Registration Date</label>
                                <p class="text-muted mb-0">{{ $volunteer->created_at->format('F d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Preferred Causes</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($volunteer->preferred_causes as $cause)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 p-2">
                                    <i class="fas fa-{{ $cause == 'Collection Drive' ? 'recycle' : ($cause == 'E-waste Awareness' ? 'microphone' : ($cause == 'Educational Sessions' ? 'graduation-cap' : 'briefcase')) }} me-1"></i>
                                    {{ $cause }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">GDPR Consent</label>
                                <div>
                                    @if($volunteer->gdpr_consent)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Given
                                        </span>
                                        <small class="text-muted d-block mt-1">Consented on {{ $volunteer->created_at->format('M d, Y') }}</small>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>Not Given
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Last Updated</label>
                                <p class="text-muted mb-0">{{ $volunteer->updated_at->format('F d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <!-- Actions Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                    
                    <!-- Status Update -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Update Status</label>
                        <div class="d-grid gap-2">
                            @if($volunteer->status != 'approved')
                            <form action="{{ route('admin.volunteers.status', $volunteer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check me-1"></i> Approve Volunteer
                                </button>
                            </form>
                            @endif

                            @if($volunteer->status != 'rejected')
                            <form action="{{ route('admin.volunteers.status', $volunteer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-1"></i> Reject Volunteer
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Contact Volunteer</label>
                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $volunteer->email }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-1"></i> Send Email
                            </a>
                            <a href="tel:{{ $volunteer->phone }}" class="btn btn-outline-success">
                                <i class="fas fa-phone me-1"></i> Call Volunteer
                            </a>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="border-top pt-3">
                        <label class="form-label fw-semibold text-danger">Danger Zone</label>
                        <form action="{{ route('admin.volunteers.destroy', $volunteer->id) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" 
                                    onclick="return confirm('Are you sure you want to delete this volunteer? This action cannot be undone.')">
                                <i class="fas fa-trash me-1"></i> Delete Volunteer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Registration Info Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Registration Information</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Volunteer ID:</strong></td>
                                <td>#{{ $volunteer->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>IP Address:</strong></td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td><strong>User Agent:</strong></td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td><strong>Registration Source:</strong></td>
                                <td>Website Form</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.avatar-lg {
    width: 80px;
    height: 80px;
}
.avatar-title {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 2rem;
}
.badge {
    font-size: 0.75em;
}
</style>
@endsection