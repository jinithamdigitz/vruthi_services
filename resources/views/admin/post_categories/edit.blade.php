@extends('layouts.admin') {{-- or layouts.admin if you keep a separate admin layout --}}

@section('content')
<div class="container">
    <div class="card card-primary panel panel-default">
        <div class="card-header">
            <h3 class="card-title">Edit Post Category</h3>
        </div>

        <form action="{{ route('admin.post-categories.update', $postCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $postCategory->name) }}"
                        placeholder="Enter category name"
                    >
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.post-categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
