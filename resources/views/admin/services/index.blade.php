@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-concierge-bell"></i> Services Management
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add New Service
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="8%">Icon</th>
                                    <th width="30%">Title & Description</th>
                                    <th width="12%">Short Desc</th>
                                    <th width="10%">Image</th>
                                    <th width="8%">Sort</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                <tr class="{{ !$service->is_active ? 'bg-light' : '' }}">
                                    <td class="text-center">
                                        {{ $service->id }}
                                        @if(!$service->is_active)
                                            <br>
                                            <span class="badge badge-danger mt-1">Inactive</span>
                                        @endif
                                    </td>
                                    
                                    {{-- Icon Column --}}
                                    <td class="text-center">
                                        @if($service->icon_image)
                                            <img src="{{ asset($service->icon_image) }}" 
                                                 alt="{{ $service->title }}" 
                                                 width="40" height="40" 
                                                 style="object-fit: contain; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-image fa-2x"></i>
                                            </span>
                                        @endif
                                    </td>
                                    
                                    {{-- Title & Description Column --}}
                                    <td>
                                        <strong>{{ $service->title }}</strong>
                                        @if($service->show_html)
                                            <span class="badge badge-warning ml-1">
                                                <i class="fas fa-code"></i> HTML
                                            </span>
                                        @endif
                                        @if($service->body)
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-align-left"></i> 
                                                {{ Str::limit(strip_tags($service->body), 80) }}
                                            </small>
                                        @endif
                                        @if($service->features)
                                            <br>
                                            <small class="text-success">
                                                <i class="fas fa-list-ul"></i> 
                                                {{ Str::limit(strip_tags($service->features), 50) }}
                                            </small>
                                        @endif
                                        @if($service->keyword)
                                            <br>
                                            <small class="text-info">
                                                <i class="fas fa-tag"></i> Keywords: {{ Str::limit($service->keyword, 40) }}
                                            </small>
                                        @endif
                                    </td>
                                    
                                    {{-- Short Description Column --}}
                                    <td>
                                        @if($service->short_description)
                                            <span class="text-info">
                                                <i class="fas fa-check-circle"></i> Yes
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                {{ Str::limit($service->short_description, 40) }}
                                            </small>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    
                                    {{-- Main Image Column --}}
                                    <td class="text-center">
                                        @if($service->image)
                                            <img src="{{ asset($service->image) }}" 
                                                 alt="{{ $service->title }}" 
                                                 width="50" height="50" 
                                                 style="object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    
                                    {{-- Sort Order Column --}}
                                    <td class="text-center">
                                        <span class="badge badge-info">
                                            <i class="fas fa-sort-numeric-down"></i> {{ $service->sort_order ?? 0 }}
                                        </span>
                                    </td>
                                    
                                    {{-- Actions Column --}}
                                    <td class="text-center">
                                        {{-- View Button --}}
                                        <a href="{{ route('admin.services.show', $service->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           title="View Details"
                                           style="display: inline-block; margin: 2px;">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.services.edit', $service->id) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Edit Service"
                                           style="display: inline-block; margin: 2px;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        
                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" 
                                              method="POST" 
                                              style="display: inline-block; margin: 2px;"
                                              onsubmit="return confirm('Are you sure you want to delete {{ addslashes($service->title) }}? This action cannot be undone.');">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Service">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="fas fa-database fa-3x mb-3 d-block"></i>
                                        No services found. 
                                        <a href="{{ route('admin.services.create') }}">Create your first service</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Button hover effects
    $('.btn').hover(
        function() {
            $(this).css('transform', 'translateY(-1px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});

// Toastr configuration (if used)
if (typeof toastr !== 'undefined') {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
    };
}
</script>
@endpush

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    
    /* Button styling */
    .btn-sm {
        padding: 5px 12px;
        font-size: 12px;
        border-radius: 4px;
    }
    
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    
    .btn:hover {
        filter: brightness(0.95);
        transition: all 0.2s ease;
    }
    
    .badge {
        font-size: 10px;
        padding: 3px 6px;
        border-radius: 10px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    /* Inactive row styling */
    .bg-light {
        background-color: #f8f9fa !important;
        opacity: 0.85;
    }
    
    /* Table row hover effect */
    .table tbody tr:hover {
        background-color: #f0f8ff !important;
        transition: background-color 0.3s ease;
    }
    
    /* Actions column buttons container */
    .text-center .btn,
    .text-center form {
        display: inline-block !important;
        margin: 2px !important;
    }
</style>
@endpush