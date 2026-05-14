@extends('layouts.admin')

@section('title', 'Donation Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #164A25, #00AA55);">
                    <h3 class="card-title text-white">Donation Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-light btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Reports
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Donation Information -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Donation Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="40%">Order ID:</th>
                                                    <td><code>#{{ $donation->id }}</code></td>
                                                </tr>
                                                <tr>
                                                    <th>Donor Name:</th>
                                                    <td>{{ $donation->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email:</th>
                                                    <td>{{ $donation->email_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>{{ $donation->phonenumber }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Amount:</th>
                                                    <td class="font-weight-bold text-success">₹{{ number_format($donation->amount, 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="40%">Order Status:</th>
                                                    <td>
                                                        <span class="badge badge-{{ 
                                                            $donation->order_status == 'completed' ? 'success' : 
                                                            ($donation->order_status == 'pending' ? 'warning' : 
                                                            ($donation->order_status == 'created' ? 'info' : 'danger')) 
                                                        }}">
                                                            {{ ucfirst($donation->order_status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Status:</th>
                                                    <td>
                                                        <span class="badge badge-{{ 
                                                            $donation->payment_status == 'success' ? 'success' : 
                                                            ($donation->payment_status == 'pending' ? 'warning' : 'danger') 
                                                        }}">
                                                            {{ $donation->payment_status ? ucfirst($donation->payment_status) : 'N/A' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Donor Type:</th>
                                                    <td>
                                                        @if($donation->donor_type)
                                                            <span class="badge bg-info">{{ $donation->donor_type }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>GDPR Consent:</th>
                                                    <td>
                                                        @if($donation->gdpr_consent)
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-secondary">No</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Additional Information -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            @if($donation->preferred_cause)
                                            <div class="mb-3">
                                                <strong>Preferred Cause:</strong>
                                                <span class="text-primary">{{ $donation->preferred_cause }}</span>
                                            </div>
                                            @endif

                                            @if($donation->message)
                                            <div class="mb-3">
                                                <strong>Message:</strong>
                                                <div class="card bg-light mt-1">
                                                    <div class="card-body">
                                                        {{ $donation->message }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($donation->address)
                                            <div class="mb-3">
                                                <strong>Address:</strong>
                                                <div class="card bg-light mt-1">
                                                    <div class="card-body">
                                                        {{ $donation->address }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment & System Information -->
                        <div class="col-md-4">
                            <!-- Payment Information -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Payment Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Razorpay Order ID:</th>
                                            <td>
                                                @if($donation->razorpay_order_id)
                                                    <code>{{ $donation->razorpay_order_id }}</code>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Razorpay Payment ID:</th>
                                            <td>
                                                @if($donation->razorpay_payment_id)
                                                    <code>{{ $donation->razorpay_payment_id }}</code>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Payment Signature:</th>
                                            <td>
                                                @if($donation->razorpay_signature)
                                                    <small><code>{{ substr($donation->razorpay_signature, 0, 20) }}...</code></small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- System Information -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">System Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Created:</th>
                                            <td>{{ $donation->created_at->format('M d, Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated:</th>
                                            <td>{{ $donation->updated_at->format('M d, Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Days Since:</th>
                                            <td>{{ $donation->created_at->diffInDays(now()) }} days</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="card mt-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $donation->email_id }}" class="btn btn-outline-primary">
                                            <i class="fa fa-envelope"></i> Email Donor
                                        </a>
                                        <a href="tel:{{ $donation->phonenumber }}" class="btn btn-outline-success">
                                            <i class="fa fa-phone"></i> Call Donor
                                        </a>
                                        <a href="{{ route('admin.donations.export') }}?ids[]={{ $donation->id }}" 
                                           class="btn btn-outline-info">
                                            <i class="fa fa-download"></i> Export This
                                        </a>
                                    </div>
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

@push('styles')
<style>
.badge.badge-success { background-color: #28a745; }
.badge.badge-warning { background-color: #ffc107; color: #212529; }
.badge.badge-danger { background-color: #dc3545; }
.badge.badge-info { background-color: #17a2b8; }

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.table-borderless th {
    font-weight: 600;
    color: #164A25;
}

.code {
    font-family: 'Courier New', monospace;
    background-color: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 0.875em;
}
</style>
@endpush