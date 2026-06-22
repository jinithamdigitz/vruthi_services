@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> Service Details
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <!-- ID -->
                        <tr>
                            <th width="150">ID</th>
                            <td>{{ $service->id }} 
                                @if(!$service->is_active)
                                    <span class="badge badge-danger ml-2">Inactive</span>
                                @else
                                    <span class="badge badge-success ml-2">Active</span>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- Title -->
                        <tr>
                            <th>Title</th>
                            <td>
                                {{ $service->title }}
                                @if($service->show_html)
                                    <span class="badge badge-warning ml-2">
                                        <i class="fas fa-code"></i> HTML Enabled
                                    </span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- Slug -->
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $service->slug }}</code></td>
                        </tr>
                        
                        <!-- Sort Order -->
                        <tr>
                            <th>Sort Order</th>
                            <td>
                                <span class="badge badge-info">
                                    <i class="fas fa-sort-numeric-down"></i> {{ $service->sort_order ?? 0 }}
                                </span>
                             </td>
                        </tr>
                        
                        <!-- Short Description -->
                        <tr>
                            <th>Short Description</th>
                            <td>
                                @if($service->short_description)
                                    <div class="text-info">
                                        <i class="fas fa-info-circle"></i> 
                                        {{ $service->short_description }}
                                    </div>
                                @else
                                    <span class="text-muted">— No short description provided —</span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- Icon Image -->
                        <tr>
                            <th>Icon Image</th>
                            <td>
                                @if($service->icon_image)
                                    <img src="{{ asset($service->icon_image) }}" 
                                         alt="{{ $service->title }}" 
                                         style="width: 64px; height: 64px; object-fit: contain; border-radius: 8px;">
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-file-image"></i> 
                                        {{ basename($service->icon_image) }}
                                    </small>
                                @else
                                    <span class="text-muted">No icon uploaded</span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- Main Image -->
                        <tr>
                            <th>Main Image</th>
                            <td>
                                @if($service->image)
                                    <img src="{{ asset($service->image) }}" 
                                         alt="{{ $service->title }}" 
                                         style="max-width: 300px; height: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-file-image"></i> 
                                        {{ basename($service->image) }}
                                    </small>
                                @else
                                    <span class="text-muted">No image uploaded</span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- Full Description -->
                        <tr>
                            <th>Full Description</th>
                            <td>
                                @if($service->body)
                                    @if($service->show_html)
                                        <div class="html-content">
                                            {!! $service->body !!}
                                        </div>
                                    @else
                                        <div class="plain-text">
                                            {{ nl2br(e($service->body)) }}
                                        </div>
                                    @endif
                                @else
                                    <span class="text-muted">— No description provided —</span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- Features & Benefits -->
                        <tr>
                            <th>Features & Benefits</th>
                            <td>
                                @if($service->features)
                                    @if($service->show_html && strpos($service->features, '<') !== false)
                                        <div class="html-content">
                                            {!! $service->features !!}
                                        </div>
                                    @else
                                        <div class="features-list">
                                            @php
                                                $features = explode("\n", trim($service->features));
                                            @endphp
                                            @foreach($features as $feature)
                                                @if(trim($feature))
                                                    <div class="feature-item">
                                                        <i class="fas fa-check-circle text-success"></i> 
                                                        {{ trim($feature) }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <span class="text-muted">— No features provided —</span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- SEO Keywords -->
                        <tr>
                            <th>SEO Keywords</th>
                            <td>
                                @if($service->keyword)
                                    @php
                                        $keywords = explode(',', $service->keyword);
                                    @endphp
                                    @foreach($keywords as $keyword)
                                        <span class="badge badge-secondary mr-1">
                                            <i class="fas fa-tag"></i> {{ trim($keyword) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted">— No keywords set —</span>
                                @endif
                             </td>
                        </tr>
                        
                        <!-- Created At -->
                        <tr>
                            <th>Created At</th>
                            <td>
                                <i class="fas fa-calendar-alt"></i> 
                                {{ $service->created_at->format('d M Y, h:i A') }}
                             </td>
                        </tr>
                        
                        <!-- Last Updated -->
                        <tr>
                            <th>Last Updated</th>
                            <td>
                                <i class="fas fa-clock"></i> 
                                {{ $service->updated_at->format('d M Y, h:i A') }}
                                @if($service->created_at != $service->updated_at)
                                    <small class="text-muted">(Edited)</small>
                                @endif
                             </td>
                        </tr>
                    </table>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Service
                    </a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete \"{{ $service->title }}\"? This action cannot be undone.')">
                            <i class="fas fa-trash-alt"></i> Delete Service
                        </button>
                    </form>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Status Card -->
            <div class="card card-{{ $service->is_active ? 'success' : 'danger' }} mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-{{ $service->is_active ? 'check-circle' : 'times-circle' }}"></i> 
                        Service Status
                    </h3>
                </div>
                <div class="card-body text-center">
                    @if($service->is_active)
                        <h4 class="text-success">
                            <i class="fas fa-check-circle fa-2x"></i>
                            <br>Active
                        </h4>
                        <p class="text-muted">This service is visible on the frontend website.</p>
                    @else
                        <h4 class="text-danger">
                            <i class="fas fa-times-circle fa-2x"></i>
                            <br>Inactive
                        </h4>
                        <p class="text-muted">This service is hidden from the frontend website.</p>
                    @endif
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i> Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('admin.services.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle text-success"></i> Create New Service
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-list text-primary"></i> View All Services
                        </a>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit text-warning"></i> Edit This Service
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Service Info Card -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> Service Info
                    </h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-hashtag text-info"></i> 
                            <strong>ID:</strong> {{ $service->id }}
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-link text-info"></i> 
                            <strong>Slug:</strong> 
                            <code>{{ $service->slug }}</code>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-sort-numeric-down text-info"></i> 
                            <strong>Sort Order:</strong> 
                            {{ $service->sort_order ?? 0 }}
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-code text-info"></i> 
                            <strong>HTML Editor:</strong> 
                            @if($service->show_html)
                                <span class="badge badge-success">Enabled</span>
                            @else
                                <span class="badge badge-secondary">Disabled</span>
                            @endif
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-calendar text-info"></i> 
                            <strong>Created:</strong> 
                            {{ $service->created_at->diffForHumans() }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Preview Link Card (if active) -->
            @if($service->is_active)
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-external-link-alt"></i> Preview
                    </h3>
                </div>
                <div class="card-body text-center">
                    <a href="{{ url('/service/' . $service->slug) }}" target="_blank" class="btn btn-primary btn-block">
                        <i class="fas fa-eye"></i> View on Frontend
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .html-content {
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
        background: #f9f9f9;
        border-radius: 4px;
    }
    
    .html-content img {
        max-width: 100%;
        height: auto;
    }
    
    .plain-text {
        line-height: 1.8;
        white-space: pre-wrap;
    }
    
    .features-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .feature-item {
        padding: 6px 0;
        border-bottom: 1px solid #eee;
    }
    
    .feature-item:last-child {
        border-bottom: none;
    }
    
    .badge {
        font-size: 11px;
        padding: 4px 8px;
    }
    
    .table th {
        background-color: #f8f9fc;
        font-weight: 600;
    }
    
    .card-footer .btn {
        margin-right: 8px;
    }
    
    .list-group-item i {
        width: 24px;
    }
    
</style>
@endpush