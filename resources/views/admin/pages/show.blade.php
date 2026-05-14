@extends('layouts.admin')

@section('title', 'View Post')

@section('content')
<div class="container mt-4">
    <div class="card">

        <!-- Header -->
        <div class="card-header">
            <h4>{{ $post->title }}</h4>
        </div>

        <!-- Body -->
        <div class="card-body">

            <!-- Meta Info -->
            <p><strong>Category:</strong> {{ $post->category->name ?? '—' }}</p>
            <p><strong>Author:</strong> {{ $post->user->name ?? '—' }}</p>
            <p><strong>Slug:</strong> {{ $post->slug }}</p>
            <p><strong>Created:</strong> {{ $post->created_at?->format('d M Y, H:i') }}</p>

            <hr>

            <!-- Main Content -->
            @if($post->body)
                <div class="mb-4">
                    <div class="p-3 border rounded bg-light">
                        {!! $post->body !!}
                    </div>
                </div>
            @endif

            <!-- Section One -->
            @if($post->section_one_left || $post->section_one_right)
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100">
                            {!! $post->section_one_left !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100">
                            {!! $post->section_one_right !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Section Two -->
            @if($post->section_two_left || $post->section_two_right)
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100">
                            {!! $post->section_two_left !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100">
                            {!! $post->section_two_right !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Featured Image -->
            @if($post->image)
                <div class="mt-4">
                    <strong>Featured Image:</strong><br>
                    <img src="{{ asset($post->image) }}" alt="Post Image" class="img-fluid mt-2" style="max-width: 400px;">
                </div>
            @endif

            <!-- Video -->
            @if($post->video_url)
                <div class="mt-4">
                    <strong>Video:</strong><br>
                    <a href="{{ $post->video_url }}" target="_blank">
                        {{ $post->video_url }}
                    </a>
                </div>
            @endif

        </div>

        <!-- Keywords -->
        @if($post->keywords && $post->keywords->count() > 0)
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">🔑 SEO Keywords</h5>
                </div>
                <div class="card-body">
                    @foreach($post->keywords as $keyword)
                        <span class="badge bg-primary me-1 p-2">
                            {{ $keyword->keyword }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Footer -->
        <div class="card-footer text-end">
            <!-- ✅ FIXED HERE -->
            <a href="{{ route('admin.page.index', $post->slug) }}" class="btn btn-secondary">Back</a>

            <a href="{{ route('admin.page.edit', $post->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('admin.page.destroy', $post->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Delete this post?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
</div>
@endsection