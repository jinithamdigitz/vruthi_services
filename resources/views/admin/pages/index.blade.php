@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <a href="{{ route('admin.page.create', $slug) }}" class="btn btn-primary">
        Create New Post
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    @if($post->image)
                        <img src="{{ asset($post->image) }}" width="60">
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name ?? '-' }}</td>
                <td>{{ $post->published ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.page.show', $post->id) }}" class="btn btn-sm btn-warning">View</a>
                    <a href="{{ route('admin.page.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <form action="{{ route('admin.page.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No posts yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection