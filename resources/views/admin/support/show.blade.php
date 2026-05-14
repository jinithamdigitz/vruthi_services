@extends('layouts.admin')

@section('title', 'Support Message Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Message Details #{{ $support->id }}</h3>
                    <a href="{{ route('admin.support.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Name:</strong> {{ $support->name }}<br>
                            <strong>Email:</strong> {{ $support->email }}<br>
                            <strong>Phone:</strong> {{ $support->phone ?? 'N/A' }}<br>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong> 
                            <span class="{{ $support->status_badge }}">
                                {{ ucfirst(str_replace('_', ' ', $support->status)) }}
                            </span><br>
                            <strong>Submitted:</strong> {{ $support->created_at->format('M d, Y H:i') }}<br>
                            <strong>Last Updated:</strong> {{ $support->updated_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <strong>Subject:</strong>
                            <p class="font-weight-bold h5 text-primary">{{ $support->subject }}</p>
                            
                            <strong>Message:</strong>
                            <div class="border p-3 bg-light rounded mt-2">
                                {{ $support->message }}
                            </div>
                        </div>
                    </div>

                    @if($support->admin_notes)
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <strong>Admin Notes:</strong>
                            <div class="border p-3 bg-warning bg-opacity-10 rounded mt-2">
                                {{ $support->admin_notes }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.support.edit', $support->id) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-edit"></i> Update Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection