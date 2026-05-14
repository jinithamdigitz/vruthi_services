@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>Edit Service</h1>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}" class="form-control" required>
        </div>

        {{-- Description --}}
        <div class="form-group mt-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
        </div>

        {{-- Text Fields --}}
        <div class="form-group mt-3">
            <label>Text 1</label>
            <textarea name="text1" class="form-control" rows="3">{{ old('text1', $service->text1) }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label>Text 2</label>
            <textarea name="text2" class="form-control" rows="3">{{ old('text2', $service->text2) }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label>Text 3</label>
            <textarea name="text3" class="form-control" rows="3">{{ old('text3', $service->text3) }}</textarea>
        </div>

        {{-- Current Main Image --}}
        <div class="form-group mt-3">
            <label>Current Image</label>
            <br>
            @if ($service->image)
                <img src="{{ asset('uploads/services/' . $service->image) }}" width="120" style="border-radius:8px">
            @else
                <p>No image uploaded</p>
            @endif
        </div>

        {{-- Change Main Image --}}
        <div class="form-group mt-3">
            <label>Change Main Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        {{-- Existing Gallery Images --}}
        @if($service->images->count() > 0)
        <div class="form-group mt-3">
            <label>Existing Gallery Images</label>
            <div class="row">
                @foreach ($service->images as $img)
                    <div class="col-3 text-center mb-2">
                        <img src="{{ asset('uploads/service-gallery/' . $img->image) }}" class="img-fluid rounded mb-1" style="height:100px; object-fit:cover;">
                        {{-- Optional: Add a remove checkbox --}}
                        <div>
                            <input type="checkbox" name="remove_gallery[]" value="{{ $img->id }}"> Remove
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Add New Gallery Images --}}
        <div class="form-group mt-3">
            <label>Add Gallery Images</label>
            <input type="file" name="gallery[]" multiple class="form-control">
        </div>

        <br>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>

    </form>

</div>
@endsection