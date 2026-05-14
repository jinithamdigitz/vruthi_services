@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Events List</h1>

    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Add New Event</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created Date</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->created_date }}</td>
                <td>{{ Str::limit($event->description, 50) }}</td>
                <td>
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" width="80" />
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
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
