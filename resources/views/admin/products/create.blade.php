@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="product_category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected(old('product_category_id')==$id)>{{ $name }}</option>
                @endforeach
            </select>
            @error('product_category_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
         {{-- Gallery Images --}}
        <div class="mb-3">
            <label>Gallery Images</label>
            <input type="file" name="gallery[]" class="form-control" multiple id="galleryInput">
            <div id="galleryPreview" class="mt-2 d-flex flex-wrap"></div>
        </div>
        <button class="btn btn-success">Save</button>
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
