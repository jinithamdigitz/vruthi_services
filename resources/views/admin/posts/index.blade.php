@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3">New Post</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Keywords</th> {{-- Changed from SEO Status --}}
                <th>Published</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" width="60">
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name ?? '-' }}</td>
                <td>
                    @if($post->keywords->count() > 0)
                        @foreach($post->keywords->take(3) as $keyword)
                            <span class="badge bg-info">{{ $keyword->keyword }}</span>
                        @endforeach
                        @if($post->keywords->count() > 3)
                            <span class="badge bg-secondary">+{{ $post->keywords->count() - 3 }}</span>
                        @endif
                    @else
                        <span class="badge bg-secondary">No keywords</span>
                    @endif
                </td>
                <td>{{ $post->published ? 'Yes' : 'No' }}</td>
                <td>{{ $post->featured ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No posts yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection