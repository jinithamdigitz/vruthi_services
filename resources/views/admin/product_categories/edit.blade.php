@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Category</h1>

    <form action="{{ route('admin.product-categories.update', $product_category) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product_category->name) }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($product_category->image)
                <img src="{{ asset($product_category->image) }}" width="80" class="mt-2">
            @endif
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
