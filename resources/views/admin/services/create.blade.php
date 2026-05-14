@extends('layouts.admin')

@section('content')
<div class="container card card-primary p-3">

    <h1>Create Service</h1>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
       

        @csrf


        {{-- TITLE --}}

        <div class="mb-3">

            <label>Title</label>

            <input type="text" name="title" value="{{ old('title') }}" class="form-control">

            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>



        {{-- DESCRIPTION --}}

        <div class="mb-3">

            <label>Description</label>

            <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>

        </div>

        {{-- TEXT 1 --}}
        <div class="mb-3">
            <label>Text 1</label>
            <textarea name="text1" class="form-control">{{ old('text1') }}</textarea>
        </div>

        {{-- TEXT 2 --}}
        <div class="mb-3">
            <label>Text 2</label>
            <textarea name="text2" class="form-control">{{ old('text2') }}</textarea>
        </div>

        {{-- TEXT 3 --}}
        <div class="mb-3">
            <label>Text 3</label>
            <textarea name="text3" class="form-control">{{ old('text3') }}</textarea>
        </div>



        {{-- IMAGE --}}

        <div class="mb-3">

            <label>Image</label>

            <input type="file" name="image" class="form-control">

        </div>

        <div class="form-group">
    <label>Service Gallery Images</label>
    <input type="file" name="gallery[]" multiple class="form-control">
</div>



        <button class="btn btn-success">Save</button>

        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">

            Cancel

        </a>


    </form>

</div>
@endsection