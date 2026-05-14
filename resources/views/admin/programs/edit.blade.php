@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Program</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
    @endif

    <!-- Program Update Form -->
    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $program->title) }}" maxlength="250" required>
        </div>

        <div class="form-group">
            <label>Created Date:</label>
            <input type="datetime-local" name="created_date" class="form-control" value="{{ old('created_date', \Carbon\Carbon::parse($program->created_date)->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control" maxlength="2500">{{ old('description', $program->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Image:</label>
            @if($program->image)
                <div>
                    <img src="{{ asset('storage/' . $program->image) }}" alt="Program Image" width="120" />
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="form-control">
        </div>

        <div class="form-group">
            <label>Video ID:</label>
            <input type="text" name="video_id" class="form-control" value="{{ old('video_id', $program->video_id) }}" maxlength="75">
        </div>

        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $program->start_date) }}">
        </div>

        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $program->end_date) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Program</button>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <hr>

    <!-- Multiple Images Section -->
    <h2>Multiple Images</h2>

    <!-- Display uploaded extra images -->
    <div class="row">
        @foreach($program->multipleImages as $image)
            <div class="col-md-3 mb-2">
                <img src="{{ asset('storage/' . $image->name) }}" alt="Program Image" class="img-thumbnail" style="height:100px; width:100px;">
            </div>
        @endforeach
    </div>

    <!-- Separate Form to Upload Multiple Images -->
    <form action="{{ route('admin.programs.images.store', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Upload Multiple Images</label>
        <input type="file" name="images[]" class="form-control mb-2" multiple required accept="image/*">
        <button type="submit" class="btn btn-success">Upload Images</button>
    </form>

</div>
@endsection
