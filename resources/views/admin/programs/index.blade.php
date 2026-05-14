@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Programs List</h1>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary mb-3">Add New Program</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created Date</th>
            <th>Description</th>
            <th>Image</th>
            <th>Video ID</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($programs as $program)
          <tr>
            <td>{{ $program->id }}</td>
            <td>{{ $program->title }}</td>
            <td>{{ $program->created_date }}</td>
            <td>{{ Str::limit($program->description, 50) }}</td>
            <td>
              @if($program->image)
                <img src="{{ asset($program->image) }}" alt="Program Image" />

              @endif
            </td>
            <td>{{ $program->video_id }}</td>
            <td>
              <a href="{{ route('admin.programs.show', $program->id) }}" class="btn btn-info btn-sm">View</a>
              <a href="{{ route('admin.programs.edit', $program->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
@endsection
