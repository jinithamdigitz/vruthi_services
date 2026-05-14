@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Event</h1>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" maxlength="250" required>
      </div>

      <div class="form-group">
        <label>Created Date:</label>
        <input type="datetime-local" name="created_date" class="form-control" value="{{ old('created_date') }}">
      </div>

      <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" maxlength="2500">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label>Main Image:</label>
        <input type="file" name="image" accept="image/*" class="form-control">
      </div>

      <div class="form-group">
        <label>Upload Multiple Images:</label>
        <input type="file" name="multiple_images[]" multiple class="form-control" accept="image/*">
        <small>You can select multiple images.</small>
      </div>

      <button type="submit" class="btn btn-success">Create Event</button>
      <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
