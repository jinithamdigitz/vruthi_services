@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Solar Calculator Results</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Daily Consumption</th>
                                <th>Monthly Bill</th>
                                <th>System Type</th>
                                <th>Estimated Savings</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($solarCalculators as $key => $item)
                                <tr>
                                    <td>{{ $solarCalculators->firstItem() + $key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->location ?? '-' }}</td>
                                    <td>{{ $item->contact_number }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->daily_consumption ?? 0 }} KWh</td>
                                    <td>₹ {{ number_format($item->monthly_bill ?? 0, 2) }}</td>
                                    <td>{{ $item->system_type ?? '-' }}</td>
                                    <td>₹ {{ number_format($item->estimated_savings ?? 0, 2) }}</td>
                                    <td>{{ $item->created_at ? $item->created_at->format('d M Y h:i A') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.solar_calculators.show', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted">No solar calculator data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $solarCalculators->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
