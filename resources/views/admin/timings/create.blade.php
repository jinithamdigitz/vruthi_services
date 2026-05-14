{{-- resources/views/admin/timings/create.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Timing</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.timings.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Timing Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g., Monday: 9AM - 7PM" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save Timing</button>
                        <a href="{{ route('admin.timings.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection