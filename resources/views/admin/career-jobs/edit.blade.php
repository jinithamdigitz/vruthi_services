{{-- resources/views/career-jobs/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Career Job')
@section('header', 'Edit Career Job')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('career-jobs.index') }}">Career Jobs</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<style>
    .form-card {
        background: #2d2d2d;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    
    .form-card .card-header {
        background: linear-gradient(135deg, #ff6b00 0%, #cc5500 100%);
        padding: 15px 20px;
        border-bottom: none;
    }
    
    .form-card .card-header h3 {
        color: white;
        margin: 0;
        font-weight: 600;
    }
    
    .form-card .card-body {
        background: #2d2d2d;
        padding: 30px;
    }
    
    .form-label {
        color: #ff6b00;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .required:after {
        content: " *";
        color: #ff6b00;
        font-weight: bold;
    }
    
    .form-control, .form-select {
        background: #1a1a1a;
        border: 1px solid #404040;
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        background: #1a1a1a;
        border-color: #ff6b00;
        box-shadow: 0 0 0 0.2rem rgba(255,107,0,0.25);
        color: #ffffff;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #ff6b00 0%, #cc5500 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 40px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,107,0,0.3);
        color: white;
    }
    
    .btn-cancel {
        background: #404040;
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 40px;
        border-radius: 8px;
        margin-left: 10px;
        transition: all 0.3s;
    }
    
    .btn-cancel:hover {
        background: #505050;
        transform: translateY(-2px);
        color: white;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card form-card">
                <div class="card-header">
                    <h3><i class="bi bi-pencil-square"></i> Edit Career Job: {{ $careerJob->title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('career-jobs.update', $careerJob) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $careerJob->title) }}" required>
                                <div class="help-text">Enter the job position title</div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Department</label>
                                <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" 
                                       value="{{ old('department', $careerJob->department) }}" required>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Location</label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                                       value="{{ old('location', $careerJob->location) }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Employment Type</label>
                                <select name="employment_type" class="form-select @error('employment_type') is-invalid @enderror" required>
                                    <option value="full-time" {{ old('employment_type', $careerJob->employment_type) == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part-time" {{ old('employment_type', $careerJob->employment_type) == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="contract" {{ old('employment_type', $careerJob->employment_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="freelance" {{ old('employment_type', $careerJob->employment_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="internship" {{ old('employment_type', $careerJob->employment_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                                @error('employment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Experience (Years)</label>
                                <input type="number" name="experience" class="form-control @error('experience') is-invalid @enderror" 
                                       value="{{ old('experience', $careerJob->experience) }}" min="0" max="50" required>
                                @error('experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Created Date</label>
                                <input type="date" name="created_date" class="form-control @error('created_date') is-invalid @enderror" 
                                       value="{{ old('created_date', $careerJob->created_date->format('Y-m-d')) }}" required>
                                @error('created_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label required">Short Description</label>
                            <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" 
                                      rows="3" required>{{ old('short_description', $careerJob->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label required">Full Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="10" required>{{ old('description', $careerJob->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="status" class="form-check-input" value="1" 
                                       {{ old('status', $careerJob->status) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" style="color: #e0e0e0;">
                                    Active (Publish this job)
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-save"></i> Update Career Job
                            </button>
                            <a href="{{ route('career-jobs.index') }}" class="btn btn-cancel">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection