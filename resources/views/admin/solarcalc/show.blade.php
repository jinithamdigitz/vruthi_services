@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Solar Calculator Detail View</h2>
        <a href="{{ route('admin.solar_calculators.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Submission Details</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">

                <div class="col-md-6">
                    <label class="fw-bold">Name</label>
                    <div class="border rounded p-2 bg-light">{{ $solarCalculator->name }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Location</label>
                    <div class="border rounded p-2 bg-light">{{ $solarCalculator->location ?? '-' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Contact Number</label>
                    <div class="border rounded p-2 bg-light">{{ $solarCalculator->contact_number }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Email</label>
                    <div class="border rounded p-2 bg-light">{{ $solarCalculator->email ?? '-' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Daily Consumption</label>
                    <div class="border rounded p-2 bg-light">{{ $solarCalculator->daily_consumption ?? 0 }} KWh</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Monthly Electricity Bill</label>
                    <div class="border rounded p-2 bg-light">₹ {{ number_format($solarCalculator->monthly_bill ?? 0, 2) }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">System Type</label>
                    <div class="border rounded p-2 bg-light">{{ $solarCalculator->system_type ?? '-' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Estimated Savings</label>
                    <div class="border rounded p-2 bg-light text-success fw-bold">
                        ₹ {{ number_format($solarCalculator->estimated_savings ?? 0, 2) }} / Year
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Created At</label>
                    <div class="border rounded p-2 bg-light">
                        {{ $solarCalculator->created_at ? $solarCalculator->created_at->format('d M Y h:i A') : '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Updated At</label>
                    <div class="border rounded p-2 bg-light">
                        {{ $solarCalculator->updated_at ? $solarCalculator->updated_at->format('d M Y h:i A') : '-' }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection