@extends('layouts.admin')

@section('title', 'Edit Support Message')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Support Message #{{ $support->id }}</h3>
                    <a href="{{ route('admin.support.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.support.update', $support->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-4">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select name="status" id="status" class="form-control form-select" required>
                                <option value="new" {{ $support->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ $support->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $support->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $support->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="admin_notes" class="form-label fw-bold">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" class="form-control" 
                                      rows="4" placeholder="Add internal notes or follow-up information...">{{ old('admin_notes', $support->admin_notes) }}</textarea>
                            <small class="form-text text-muted">These notes are for internal use only and won't be visible to the user.</small>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save"></i> Update Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Message Information</h3>
                </div>
                <div class="card-body">
                    <p><strong>From:</strong> {{ $support->name }}</p>
                    <p><strong>Email:</strong> {{ $support->email }}</p>
                    <p><strong>Phone:</strong> {{ $support->phone ?? 'N/A' }}</p>
                    <p><strong>Subject:</strong> {{ $support->subject }}</p>
                    <p><strong>Original Message:</strong></p>
                    <div class="border p-2 bg-light rounded">
                        {{ Str::limit($support->message, 150) }}
                    </div>
                    <p class="mt-2"><strong>Submitted:</strong> {{ $support->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection