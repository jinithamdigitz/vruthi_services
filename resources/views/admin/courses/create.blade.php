@extends('layouts.admin')

@section('content')

<div class="container card card-primary p-4">

    <h1 class="mb-4">Create Course</h1>

    <form action="{{ route('admin.courses.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- Course Name -->
        <div class="mb-3">

            <label class="form-label">
                Course Name
            </label>

            <input type="text"
                   name="course_name"
                   value="{{ old('course_name') }}"
                   class="form-control">

            @error('course_name')

                <small class="text-danger">
                    {{ $message }}
                </small>

            @enderror

        </div>

        <!-- Description -->
        <div class="mb-3">

            <label class="form-label">
                Description
            </label>

            <textarea name="description"
                      class="form-control"
                      rows="6">{{ old('description') }}</textarea>

            @error('description')

                <small class="text-danger">
                    {{ $message }}
                </small>

            @enderror

        </div>

        <!-- Duration -->
        <div class="mb-3">

            <label class="form-label">
                Duration
            </label>

            <input type="text"
                   name="duration"
                   value="{{ old('duration') }}"
                   class="form-control">

            @error('duration')

                <small class="text-danger">
                    {{ $message }}
                </small>

            @enderror

        </div>

        <!-- Image -->
        <div class="mb-3">

            <label class="form-label">
                Course Image
            </label>

            <input type="file"
                   name="image"
                   class="form-control">

            @error('image')

                <small class="text-danger">
                    {{ $message }}
                </small>

            @enderror

        </div>

        <!-- Keyword -->
        <div class="mb-3">

            <label class="form-label">
                Keyword
            </label>

            <input type="text"
                   name="keyword"
                   value="{{ old('keyword') }}"
                   class="form-control">

        </div>

        <!-- Buttons -->
        <button class="btn btn-success">

            Save Course

        </button>

        <a href="{{ route('admin.courses.index') }}"
           class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection