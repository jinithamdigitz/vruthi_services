{{-- resources/views/career-jobs/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Career Job Details')
@section('header', 'Career Job Details')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('career-jobs.index') }}">Career Jobs</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
<style>
    .details-card {
        background: #2d2d2d;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .details-card .card-header {
        background: linear-gradient(135deg, #ff6b00 0%, #cc5500 100%);
        padding: 20px;
        border-bottom: none;
    }
    
    .details-card .card-header h3 {
        color: white;
        margin: 0;
        font-weight: 600;
    }
    
    .details-card .card-body {
        background: #2d2d2d;
        padding: 30px;
    }
    
    .info-row {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #404040;
    }
    
    .info-label {
        color: #ff6b00;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    
    .info-value {
        color: #e0e0e0;
        font-size: 16px;
        line-height: 1.6;
    }
    
    .badge-active {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }
    
    .badge-inactive {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }
    
    .btn-back {
        background: #404040;
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .btn-back:hover {
        background: #505050;
        transform: translateY(-2px);
        color: white;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #ff6b00 0%, #cc5500 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        margin-left: 10px;
        transition: all 0.3s;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,107,0,0.3);
        color: white;
    }
    
    .slug-text {
        background: #1a1a1a;
        padding: 5px 10px;
        border-radius: 5px;
        font-family: monospace;
        display: inline-block;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card details-card">
                <div class="card-header">
                    <h3><i class="bi bi-info-circle"></i> Career Job Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Job Title</div>
                                <div class="info-value">
                                    <strong>{{ $careerJob->title }}</strong>
                                </div>
                            </div>
                            
                            <div class="info-row">
                                <div class="info-label">Slug</div>
                                <div class="info-value">
                                    <span class="slug-text">{{ $careerJob->slug }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row">
                                <div class="info-label">Department</div>
                                <div class="info-value">{{ $careerJob->department }}</div>
                            </div>
                            
                            <div class="info-row">
                                <div class="info-label">Location</div>
                                <div class="info-value">
                                    <i class="bi bi-geo-alt"></i> {{ $careerJob->location }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Employment Type</div>
                                <div class="info-value">{!! $careerJob->employment_type_badge !!}</div>
                            </div>
                            
                            <div class="info-row">
                                <div class="info-label">Experience Required</div>
                                <div class="info-value">{{ $careerJob->experience }} years</div>
                            </div>
                            
                            <div class="info-row">
                                <div class="info-label">Status</div>
                                <div class="info-value">{!! $careerJob->status_badge !!}</div>
                            </div>
                            
                            <div class="info-row">
                                <div class="info-label">Created Date</div>
                                <div class="info-value">{{ $careerJob->created_date->format('F d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Short Description</div>
                        <div class="info-value">{{ $careerJob->short_description }}</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Full Description</div>
                        <div class="info-value">
                            {!! nl2br(e($careerJob->description)) !!}
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Additional Information</div>
                        <div class="info-value">
                            <strong>Created at:</strong> {{ $careerJob->created_at->format('F d, Y H:i:s') }}<br>
                            <strong>Last updated:</strong> {{ $careerJob->updated_at->format('F d, Y H:i:s') }}
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('career-jobs.index') }}" class="btn btn-back">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('career-jobs.edit', $careerJob) }}" class="btn btn-edit">
                            <i class="bi bi-pencil"></i> Edit Career Job
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection