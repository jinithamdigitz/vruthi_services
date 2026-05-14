@extends('layouts.admin')

@section('title', 'View Course')

@section('content')

<div class="container mt-4">

    <div class="card">

        <!-- Header -->
        <div class="card-header">

            <h4>
                {{ $course->course_name }}
            </h4>

        </div>

        <!-- Body -->
        <div class="card-body">

            <!-- Meta Info -->
            <p>
                <strong>Duration:</strong>
                {{ $course->duration }}
            </p>

            <p>
                <strong>Keyword:</strong>
                {{ $course->keyword ?? '—' }}
            </p>

            <p>
                <strong>Created:</strong>
                {{ $course->created_at?->format('d M Y, H:i') }}
            </p>

            <hr>

            <!-- Description -->
            @if($course->description)

                <div class="mb-4">

                    <div class="p-3 border rounded bg-light">

                        {!! $course->description !!}

                    </div>

                </div>

            @endif

            <!-- Featured Image -->
            @if($course->image)

                <div class="mt-4">

                    <strong>Course Image:</strong>

                    <br>

                    <img src="{{ asset($course->image) }}"
                         alt="Course Image"
                         class="img-fluid mt-2"
                         style="max-width: 400px;">

                </div>

            @endif

        </div>

        <!-- Footer -->
        <div class="card-footer text-end">

            <a href="{{ route('admin.courses.index') }}"
               class="btn btn-secondary">

                Back

            </a>

            <a href="{{ route('admin.courses.edit', $course->id) }}"
               class="btn btn-primary">

                Edit

            </a>

            <form action="{{ route('admin.courses.destroy', $course->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Delete this course?');">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger">

                    Delete

                </button>

            </form>

        </div>

    </div>

</div>

@endsection