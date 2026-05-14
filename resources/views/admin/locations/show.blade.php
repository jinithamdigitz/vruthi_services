@extends('layouts.admin')

@section('content')
    <div class="container card card-primary p-3">

        <h1>View Location</h1>

        <div class="mb-3">
            <label class="fw-bold">ID</label>
            <p class="form-control">{{ $location->id }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Location Name</label>
            <p class="form-control">{{ $location->location }}</p>
        </div>

        <a href="{{ route('admin.locations.edit', $location->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('admin.locations.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </div>
@endsection