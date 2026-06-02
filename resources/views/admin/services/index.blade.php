@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Add New Service</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Icon</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Actions</th>
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
                             width="40" height="40" style="object-fit: contain;">
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    <strong>{{ $service->title }}</strong>
                    <br>
                    <small class="text-muted">{{ Str::limit($service->body, 50) }}</small>
                </td>
                <td>{{ $service->slug }}</td>
                <td>
                    @if($service->image)
                        <img src="{{ asset($service->image) }}" 
                             alt="{{ $service->title }}" 
                             width="50" height="50" style="object-fit: cover; border-radius: 4px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this service?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No services yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $services->links() }}
</div>
@endsection