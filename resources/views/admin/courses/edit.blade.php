@extends('layouts.admin')

@section('content')

<div class="container card card-primary p-4">

    <h1 class="mb-4">Edit Course</h1>

    <form action="{{ route('admin.courses.update', $course->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Course Name -->
        <div class="mb-3">

            <label class="form-label">
                Course Name
            </label>

            <input type="text"
                   name="course_name"
                   value="{{ old('course_name', $course->course_name) }}"
                   class="form-control">

        </div>

        <!-- Description -->
        <div class="mb-3">

            <label class="form-label">
                Description
            </label>

            <textarea name="description"
                      class="form-control"
                      rows="6">{{ old('description', $course->description) }}</textarea>

        </div>

        <!-- Duration -->
        <div class="mb-3">

            <label class="form-label">
                Duration
            </label>

            <input type="text"
                   name="duration"
                   value="{{ old('duration', $course->duration) }}"
                   class="form-control">

        </div>

        <!-- Existing Image -->
        <div class="mb-3">

            <img src="{{ asset($course->image) }}"
                 width="120">

        </div>

        <!-- New Image -->
        <div class="mb-3">

            <label class="form-label">
                Update Image
            </label>

            <input type="file"
                   name="image"
                   class="form-control">

        </div>

        <!-- Keyword -->
        <div class="mb-3">

            <label class="form-label">
                Keyword
            </label>

            <input type="text"
                   name="keyword"
                   value="{{ old('keyword', $course->keyword) }}"
                   class="form-control">

        </div>

        <!-- Buttons -->
        <button class="btn btn-success">

            Update Course

        </button>

        <a href="{{ route('admin.courses.index') }}"
           class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection