@extends('layouts.admin')

@section('content')
    <div class="container card card-primary p-3">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Locations</h1>
            <a href="{{ route('admin.locations.create') }}" class="btn btn-success">
                Add Location
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Location Name</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->location }}</td>
                        <td>
                            <a href="{{ route('admin.locations.show', $location->id) }}"
                               class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="{{ route('admin.locations.edit', $location->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.locations.destroy', $location->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No locations found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection