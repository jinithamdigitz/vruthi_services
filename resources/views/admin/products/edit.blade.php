@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="product_category_id" class="form-control">
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected(old('product_category_id', $product->product_category_id)==$id)>{{ $name }}</option>
                @endforeach
            </select>
            @error('product_category_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($product->image)
                <img src="{{ asset($product->image) }}" width="80" class="mt-2">
            @endif
        </div>

        {{-- Existing Gallery --}}
{{-- Existing Images --}}
@if($product->images->count())
<div class="mb-3">
    <label>Existing Images</label>
    <div class="d-flex flex-wrap">
        @foreach($product->images as $img)
            <div class="me-3 mb-2 text-center">
                <img src="{{ asset('storage/'.$img->path) }}" 
                     style="width:80px;height:80px;object-fit:cover;">
                <div>
                    <label class="small">
                        <input type="checkbox" name="delete_images[]" value="{{ $img->id }}">
                        Remove
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Upload New --}}
<div class="mb-3">
    <label>Add New Images</label>
    <input type="file" name="images[]" class="form-control" multiple id="galleryInput">
    <div id="galleryPreview" class="mt-2 d-flex flex-wrap"></div>
</div>


        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('galleryInput').addEventListener('change', function (e) {
    const preview = document.getElementById('galleryPreview');
    preview.innerHTML = '';
    for (const file of e.target.files) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const img = document.createElement('img');
            img.src = ev.target.result;
            img.classList.add('me-2', 'mb-2');
            img.style.width = '80px';
            img.style.height = '80px';
            img.style.objectFit = 'cover';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush

