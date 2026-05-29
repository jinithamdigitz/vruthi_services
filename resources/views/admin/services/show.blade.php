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
                        <tr>
                            <th width="150">ID</th>
                            <td>{{ $service->id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $service->title }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $service->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td>
                                @if($service->icon_image)
                                    <img src="{{ asset($service->icon_image) }}" 
                                         alt="{{ $service->title }}" 
                                         style="width: 64px; height: 64px; object-fit: contain;">
                                @else
                                    <span class="text-muted">No icon uploaded</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Main Image</th>
                            <td>
                                @if($service->image)
                                    <img src="{{ asset($service->image) }}" 
                                         alt="{{ $service->title }}" 
                                         style="max-width: 300px; height: auto; border-radius: 4px;">
                                @else
                                    <span class="text-muted">No image uploaded</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! nl2br(e($service->body)) !!}</td>
                        </tr>
                        <tr>
                            <th>SEO Keyword</th>
                            <td>{{ $service->keyword ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $service->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $service->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this service?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection