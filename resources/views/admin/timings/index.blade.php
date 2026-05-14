{{-- resources/views/admin/timings/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Timings Management</h3>
                    <a href="{{ route('admin.timings.create') }}" class="btn btn-primary float-right">Add New Timing</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($timings as $timing)
                                <tr>
                                    <td>{{ $timing->id }}</td>
                                    <td>{{ $timing->title }}</td>
                                    <td>{{ $timing->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.timings.edit', $timing->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.timings.destroy', $timing->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No timings found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection