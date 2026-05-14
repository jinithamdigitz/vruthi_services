@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Faculties</h1>
        <a href="{{ route('admin.faculties.create') }}" class="btn btn-primary">
            Create New Faculty
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Keyword</th>
                <th>Qualification</th>
                <th>Experience</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($faculties as $faculty)
            <tr>
                <td>
                    @if($faculty->image)
                    <img src="{{ asset('storage/' . $faculty->image) }}" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                    @else
                    <img src="{{ asset('default-avatar.jpg') }}" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                    @endif
                </td>
                <td>{{ $faculty->title }}</td>
                <td>{{ $faculty->keyword ?? '-' }}</td>
                <td>{{ Str::limit($faculty->qualification, 50) ?? '-' }}</td>
                <td>{{ $faculty->experience ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.faculties.show', $faculty->id) }}" class="btn btn-sm btn-warning">View</a>
                    <a href="{{ route('admin.faculties.edit', $faculty->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.faculties.destroy', $faculty->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this faculty?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No faculties yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $faculties->links() }}
</div>
@endsection