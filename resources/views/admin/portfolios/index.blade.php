@extends('layouts.admin')

@section('title', 'Portfolios')

@section('content')
<div class="container">
    <h1>Portfolios</h1>
    <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary mb-3">Add New Portfolio</a>

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
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Location</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($portfolios as $portfolio)
            <tr>
                <td>{{ $portfolio->id }}</td>
                <td>
                    @if($portfolio->image)
                        <img src="{{ asset($portfolio->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 4px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td><strong>{{ $portfolio->title }}</strong></td>
                <td>{{ $portfolio->category->name ?? '-' }}</td>
                <td>{{ $portfolio->location ?? '-' }}</td>
                <td>{{ $portfolio->slug }}</td>
                <td>
                    <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this portfolio?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No portfolios yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $portfolios->links() }}
</div>
@endsection