@extends('layouts.admin')

@section('title', 'E-Waste Donation Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">E-Waste Donation Details</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.ewaste-donations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Donations
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <!-- Donation Information Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <div class="avatar-lg">
                                <div class="avatar-title bg-success bg-opacity-10 text-success rounded-circle fs-2">
                                    <i class="fas fa-recycle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">{{ $ewasteDonation->name }}</h5>
                            <p class="text-muted mb-0">{{ $ewasteDonation->email }}</p>
                            <div class="mt-2">
                                <span class="badge bg-{{ $ewasteDonation->donor_type_badge }} me-2">
                                    @if($ewasteDonation->donor_type == 'Individual/Residential')
                                        Individual/Residential
                                    @elseif($ewasteDonation->donor_type == 'Association/Education')
                                        Association/Education
                                    @elseif($ewasteDonation->donor_type == 'Institution/Corporate/Commercial')
                                        Institution/Corporate/Commercial
                                    @else
                                        Establishment
                                    @endif
                                </span>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'approved' => 'info',
                                        'scheduled' => 'primary', 
                                        'completed' => 'success',
                                        'cancelled' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$ewasteDonation->status] ?? 'secondary' }} fs-6">
                                    {{ ucfirst($ewasteDonation->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <p class="text-muted mb-0">{{ $ewasteDonation->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <p class="text-muted mb-0">{{ $ewasteDonation->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Donor Type</label>
                                <p class="text-muted mb-0">{{ $ewasteDonation->donor_type }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Request Date</label>
                                <p class="text-muted mb-0">{{ $ewasteDonation->created_at->format('F d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pickup Location</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="mb-0">{{ $ewasteDonation->pickup_location }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Waste Type Description</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="mb-0">{{ $ewasteDonation->waste_type }}</p>
                            </div>
                        </div>
                    </div>

                    @if($ewasteDonation->message)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Additional Message</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="mb-0">{{ $ewasteDonation->message }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">GDPR Consent</label>
                                <div>
                                    @if($ewasteDonation->gdpr_consent)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Given
                                        </span>
                                        <small class="text-muted d-block mt-1">Consented on {{ $ewasteDonation->created_at->format('M d, Y') }}</small>
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
                                <p class="text-muted mb-0">{{ $ewasteDonation->updated_at->format('F d, Y \a\t h:i A') }}</p>
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
                            @if($ewasteDonation->status != 'approved')
                            <form action="{{ route('admin.ewaste-donations.status', $ewasteDonation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-info w-100">
                                    <i class="fas fa-check me-1"></i> Approve Donation
                                </button>
                            </form>
                            @endif

                            @if($ewasteDonation->status != 'scheduled')
                            <form action="{{ route('admin.ewaste-donations.status', $ewasteDonation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="scheduled">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-calendar me-1"></i> Schedule Pickup
                                </button>
                            </form>
                            @endif

                            @if($ewasteDonation->status != 'completed')
                            <form action="{{ route('admin.ewaste-donations.status', $ewasteDonation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check-double me-1"></i> Mark Complete
                                </button>
                            </form>
                            @endif

                            @if($ewasteDonation->status != 'cancelled')
                            <form action="{{ route('admin.ewaste-donations.status', $ewasteDonation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-1"></i> Cancel Donation
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Contact Donor</label>
                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $ewasteDonation->email }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-1"></i> Send Email
                            </a>
                            <a href="tel:{{ $ewasteDonation->phone }}" class="btn btn-outline-success">
                                <i class="fas fa-phone me-1"></i> Call Donor
                            </a>
                        </div>
                    </div>

                    <!-- Map Location -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Pickup Location</label>
                        <div class="text-center">
                            <a href="https://maps.google.com/?q={{ urlencode($ewasteDonation->pickup_location) }}" 
                               target="_blank" class="btn btn-outline-info w-100">
                                <i class="fas fa-map-marker-alt me-1"></i> View on Map
                            </a>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="border-top pt-3">
                        <label class="form-label fw-semibold text-danger">Danger Zone</label>
                        <form action="{{ route('admin.ewaste-donations.destroy', $ewasteDonation->id) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" 
                                    onclick="return confirm('Are you sure you want to delete this donation? This action cannot be undone.')">
                                <i class="fas fa-trash me-1"></i> Delete Donation
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Donation Info Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Donation Information</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Donation ID:</strong></td>
                                <td>#{{ $ewasteDonation->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Reference:</strong></td>
                                <td>EW{{ $ewasteDonation->id }}{{ $ewasteDonation->created_at->format('Ymd') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Days Since Request:</strong></td>
                                <td>{{ $ewasteDonation->created_at->diffInDays(now()) }} days</td>
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