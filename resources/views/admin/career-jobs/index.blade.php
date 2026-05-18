{{-- resources/views/career-jobs/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Career Jobs')
@section('header', 'Career Job Management')
@section('breadcrumbs')
    <li class="breadcrumb-item active">Career Jobs</li>
@endsection

@section('content')

<style>
.table thead th
{
	color: #C76E00 !important;
}

</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Job Listings</h3>
                <div class="card-tools">
                    <a href="{{ route('career-jobs.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Create New
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('career-jobs.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="title" class="form-control form-control-sm" 
                                   placeholder="Search by title..." value="{{ request('title') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="date_from" class="form-control form-control-sm" 
                                   value="{{ request('date_from') }}" placeholder="Date From">
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="date_to" class="form-control form-control-sm" 
                                   value="{{ request('date_to') }}" placeholder="Date To">
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control form-control-sm">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-search"></i> Filter
                            </button>
                            <a href="{{ route('career-jobs.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-repeat"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Jobs Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Title</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Experience</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($careerJobs as $careerJob)
                            <tr>
                                <td>{{ $careerJob->id }}</td>
                                <td>
                                    {{ $careerJob->title }}
                                    <br>
                                    <small class="text-muted">{{ $careerJob->slug }}</small>
                                </td>
                                <td>{{ $careerJob->department }}</td>
                                <td>{{ $careerJob->location }}</td>
                                <td>
                                    @php
                                        $typeColors = [
                                            'full-time' => 'primary',
                                            'part-time' => 'info',
                                            'contract' => 'warning',
                                            'freelance' => 'secondary',
                                            'internship' => 'dark'
                                        ];
                                        $typeColor = $typeColors[$careerJob->employment_type] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-{{ $typeColor }}">
                                        {{ ucfirst($careerJob->employment_type) }}
                                    </span>
                                </td>
                                <td>{{ $careerJob->experience }} years</td>
                                <td>
                                    @if($careerJob->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $careerJob->created_date->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('career-jobs.show', $careerJob) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('career-jobs.edit', $careerJob) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('career-jobs.destroy', $careerJob) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No career jobs found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $careerJobs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection