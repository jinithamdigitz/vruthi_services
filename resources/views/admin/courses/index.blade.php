@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Courses</h1>

        <a href="{{ route('admin.courses.create') }}"
           class="btn btn-primary">

        Create Course

        </a>
    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Image</th>

                <th>Course Name</th>

                <th>Duration</th>

                <th>Keyword</th>

                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($courses as $course)

            <tr>

                <td>

                    @if($course->image)

                        <img src="{{ asset($course->image) }}"
                             width="70">

                    @endif

                </td>

                <td>{{ $course->course_name }}</td>

                <td>{{ $course->duration }}</td>

                <td>{{ $course->keyword ?? '-' }}</td>

                <td>

                    <a href="{{ route('admin.courses.show', $course->id) }}"
                       class="btn btn-sm btn-info">
                        View
                    </a>

                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('admin.courses.destroy', $course->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Delete this course?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-sm btn-danger">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="text-center">

                    No courses found.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection