@extends('layouts.admin')

@section('content')
    <div class="container card card-primary p-3">

        <h1>Edit Location</h1>

        <form action="{{ route('admin.locations.update', $location->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- LOCATION NAME --}}
            <div class="mb-3">
                <label>Location Name</label>
                <input type="text"
                       name="location"
                       value="{{ old('location', $location->location) }}"
                       class="form-control">

                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success">Update</button>

            <a href="{{ route('admin.locations.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
@endsection