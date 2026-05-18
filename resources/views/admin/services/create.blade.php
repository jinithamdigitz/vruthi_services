@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Service</h1>
    
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5"></textarea>
        </div>
        
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Keyword</label>
            <input type="text" name="keyword" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection