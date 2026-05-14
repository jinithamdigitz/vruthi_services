@extends('layouts.admin') {{-- or layouts.admin if you have one --}}

@section('content')
<div class="container">
    <div class="card card-primary panel panel-default">
        <div class="card-header">
            <h3 class="card-title">Add Post Category</h3>
        </div>

        <form action="{{ route('admin.post-categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter category name"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

               

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save
                </button>
                <a href="{{ route('admin.post-categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
