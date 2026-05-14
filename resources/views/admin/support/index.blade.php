@extends('layouts.admin')

@section('title', 'Support Messages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Support Messages</h3>
                    <div class="card-tools">
                        <span class="badge bg-primary">New: {{ \App\Models\SupportMessage::where('status', 'new')->count() }}</span>
                        <span class="badge bg-success ml-2">Resolved: {{ \App\Models\SupportMessage::where('status', 'resolved')->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Search and Filter Form -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Search & Filter</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.support.index') }}" id="filterForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search" class="form-label">Search</label>
                                            <input type="text" name="search" id="search" class="form-control" 
                                                   placeholder="Search by name, email, subject..." 
                                                   value="{{ request('search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">All Status</option>
                                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" 
                                                   value="{{ request('start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" 
                                                   value="{{ request('end_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="sort" class="form-label">Sort By</label>
                                            <select name="sort" id="sort" class="form-control">
                                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-label">&nbsp;</label>
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-search"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if(request()->hasAny(['search', 'status', 'start_date', 'end_date', 'sort']))
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <a href="{{ route('admin.support.index') }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-times"></i> Clear Filters
                                        </a>
                                        <small class="text-muted ms-2">
                                            Showing {{ $messages->total() }} results
                                            @if(request('search'))
                                                for "{{ request('search') }}"
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ Str::limit($message->subject, 50) }}</td>
                                    <td>
                                        <span class="{{ $message->status_badge }}">
                                            {{ ucfirst(str_replace('_', ' ', $message->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.support.show', $message->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.support.edit', $message->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.support.destroy', $message->id) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                        @if(request()->hasAny(['search', 'status', 'start_date', 'end_date']))
                                            No support messages found matching your criteria.
                                        @else
                                            No support messages found.
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} entries
                        </div>
                        <div>
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.table th {
    border-top: none;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when sort changes
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    // Set default end date to today
    const endDate = document.getElementById('end_date');
    if (!endDate.value) {
        const today = new Date().toISOString().split('T')[0];
        endDate.value = today;
    }

    // Set default start date to 30 days ago
    const startDate = document.getElementById('start_date');
    if (!startDate.value) {
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
        startDate.value = thirtyDaysAgo.toISOString().split('T')[0];
    }

    // Validate date range
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        const start = document.getElementById('start_date').value;
        const end = document.getElementById('end_date').value;
        
        if (start && end && start > end) {
            e.preventDefault();
            alert('Start date cannot be after end date.');
            return false;
        }
    });
});
</script>
@endsection