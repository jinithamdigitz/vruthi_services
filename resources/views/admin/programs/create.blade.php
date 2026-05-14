@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Program</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label>Title:</label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" maxlength="250" required>
        </div>

        <div class="form-group">
          <label>Created Date:</label>
          <input type="datetime-local" name="created_date" class="form-control" value="{{ old('created_date') }}">
        </div>

        <div class="form-group">
          <label>Start Date:</label>
          <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
        </div>

        <div class="form-group">
          <label>End Date:</label>
          <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
        </div>

        <div class="form-group">
          <label>Description:</label>
          <textarea name="description" class="form-control" maxlength="2500">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
          <label>Image:</label>
          <input type="file" name="image" accept="image/*" class="form-control">
        </div>
        <div class="form-group">
          <label>Upload Extra Images:</label>
          <input type="file" name="extra_images[]" multiple class="form-control" accept="image/*">
          <small class="form-text text-muted">You can select multiple images.</small>
        </div>

        <div class="form-group">
          <label>Video ID:</label>
          <input type="text" name="video_id" class="form-control" value="{{ old('video_id') }}" maxlength="75">
        </div>

        <button type="submit" class="btn btn-success">Save Program</button>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
