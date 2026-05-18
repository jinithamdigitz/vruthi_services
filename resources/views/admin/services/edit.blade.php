@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Service</h1>
    
    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
        </div>
        
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5">{{ $service->body }}</textarea>
        </div>
        
        <div class="form-group">
            <label>Current Image</label>
            @if($service->image)
                <img src="{{ asset($service->image) }}" width="100">
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Keyword</label>
            <input type="text" name="keyword" class="form-control" value="{{ $service->keyword }}">
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection