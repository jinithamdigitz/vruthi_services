@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs"></i> Services
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add New Service
                        </a>
                    </div>
                </div>
                
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th width="80">Icon</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th width="80">Image</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td class="text-center">
                                    @if($service->icon_image)
                                        <img src="{{ asset($service->icon_image) }}" 
                                             alt="{{ $service->title }}" 
                                             style="width: 40px; height: 40px; object-fit: contain;">
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $service->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($service->body, 50) }}</small>
                                </td>
                                <td>
                                    <code>{{ $service->slug }}</code>
                                </td>
                                <td>
                                    @if($service->image)
                                        <img src="{{ asset($service->image) }}" 
                                             alt="{{ $service->title }}" 
                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.services.show', $service->id) }}" 
                                           class="btn btn-info" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.services.edit', $service->id) }}" 
                                           class="btn btn-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-danger" 
                                                title="Delete"
                                                onclick="confirmDelete({{ $service->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <form id="delete-form-{{ $service->id }}" 
                                          action="{{ route('admin.services.destroy', $service->id) }}" 
                                          method="POST" 
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle"></i> No services found.
                                        <a href="{{ route('admin.services.create') }}" class="alert-link">Create your first service</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $services->links() }}
                    </div>
                    <div class="float-left">
                        <small class="text-muted">
                            Total: {{ $services->total() }} service(s)
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush

@push('styles')
<style>
    .table td {
        vertical-align: middle;
    }
    .btn-group-sm .btn {
        margin: 0 2px;
    }
    code {
        background: #f4f4f4;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 11px;
    }
</style>
@endpush
@endsection