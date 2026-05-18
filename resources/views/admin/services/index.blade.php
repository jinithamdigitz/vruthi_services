@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Services</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->title }}</td>
                <td>{{ $service->slug }}</td>
                <td>
                    @if($service->image)
                        <img src="{{ asset($service->image) }}" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $services->links() }}
</div>
@endsection