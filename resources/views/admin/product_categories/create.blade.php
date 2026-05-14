@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Product Category</h1>

    <form action="{{ route('admin.product-categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
