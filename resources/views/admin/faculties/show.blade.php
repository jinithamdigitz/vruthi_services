@extends('layouts.admin')

@section('title', 'View Faculty')

@section('content')
<div class="container mt-4">
    <div class="card">

        <!-- Header -->
        <div class="card-header">
            <h4>{{ $faculty->title }}</h4>
        </div>

        <!-- Body -->
        <div class="card-body">

            <!-- Meta Info -->
            <p><strong>ID:</strong> {{ $faculty->id }}</p>
            <p><strong>Keyword:</strong> {{ $faculty->keyword ?? '—' }}</p>
            <p><strong>Qualification:</strong> {{ $faculty->qualification ?? '—' }}</p>
            <p><strong>Experience:</strong> {{ $faculty->experience ?? '—' }}</p>
            <p><strong>Created:</strong> {{ $faculty->created_at?->format('d M Y, H:i') }}</p>
            <p><strong>Last Updated:</strong> {{ $faculty->updated_at?->format('d M Y, H:i') }}</p>

            <hr>

            <!-- Description Content -->
            @if($faculty->description)
                <div class="mb-4">
                    <strong>Description:</strong>
                    <div class="p-3 border rounded bg-light mt-2">
                        {!! nl2br(e($faculty->description)) !!}
                    </div>
                </div>
            @endif

            <!-- Featured Image -->
            @if($faculty->image)
                <div class="mt-4">
                    <strong>Profile Image:</strong><br>
                    <img src="{{ $faculty->image_url }}" alt="Faculty Image" class="img-fluid mt-2" style="max-width: 300px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                </div>
            @endif

        </div>

        <!-- Footer -->
        <div class="card-footer text-end">
            <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">Back</a>

            <a href="{{ route('admin.faculties.edit', $faculty->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('admin.faculties.destroy', $faculty->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Delete this faculty?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
</div>
@endsection