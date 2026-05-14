@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $event->name) }}" maxlength="250" required>
      </div>

      <div class="form-group">
        <label>Created Date:</label>
        <input type="datetime-local" name="created_date" class="form-control" value="{{ old('created_date', \Carbon\Carbon::parse($event->created_date)->format('Y-m-d\TH:i')) }}">
      </div>

      <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" maxlength="2500">{{ old('description', $event->description) }}</textarea>
      </div>

      <div class="form-group">
        <label>Main Image:</label>
        @if($event->image)
          <div>
            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" width="120" />
          </div>
        @endif
        <input type="file" name="image" accept="image/*" class="form-control">
      </div>

      <div class="form-group">
        <label>Upload Multiple Images:</label>
        <input type="file" name="multiple_images[]" multiple class="form-control" accept="image/*">
        <small>You can select multiple images.</small>
      </div>

      <button type="submit" class="btn btn-primary">Update Event</button>
      <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <h2>Multiple Images</h2>
    <div class="row">
      @foreach($event->multipleImages as $image)
        <div class="col-md-3 mb-2">
          <img src="{{ asset('storage/' . $image->name) }}" alt="Multiple Image" class="img-thumbnail" style="height:100px; width:100px;">
        </div>
      @endforeach
    </div>

</div>
@endsection
