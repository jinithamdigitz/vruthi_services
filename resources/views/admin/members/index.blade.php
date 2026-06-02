@extends('layouts.admin')

@section('title', 'Manage Members')

@section('content')
<div class="container">
    <h1>Members</h1>
    <a href="{{ route('admin.members.create') }}" class="btn btn-primary mb-3">Add New Member</a>

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
                <th>Name</th>
                <th>Designation</th>
                <th>Slug</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>
                    @if($member->image && file_exists(public_path($member->image)))
                        <img src="{{ asset($member->image) }}" width="60" height="60" style="object-fit: cover; border-radius: 50%;">
                    @else
                        <img src="https://ui-avatars.com/api/?background=C8622A&color=fff&name={{ urlencode($member->name) }}" width="60" height="60" style="border-radius: 50%;">
                    @endif
                </td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->designation ?? '-' }}</td>
                <td>{{ $member->slug }}</td>
                <td>{{ $member->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this member?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No members yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $members->links() }}
</div>
@endsection