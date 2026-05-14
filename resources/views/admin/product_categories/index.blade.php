@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Product Categories</h1>
    <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered">
        <thead>
            <tr><th>#</th><th>Name</th><th>Image</th><th>Actions</th></tr>
        </thead>
        <tbody>
        @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>@if($cat->image)<img src="{{ asset($cat->image) }}" width="50">@endif</td>
                <td>
                    <a href="{{ route('admin.product-categories.show',$cat) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.product-categories.edit',$cat) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.product-categories.destroy',$cat) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
