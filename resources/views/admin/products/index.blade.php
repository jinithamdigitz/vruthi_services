@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered">
        <thead>
            <tr><th>#</th><th>Name</th><th>Category</th><th>Image</th><th>Actions</th></tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category?->name }}</td>
                <td>@if($product->image)<img src="{{ asset($product->image) }}" width="50">@endif</td>
                <td>
                    <a href="{{ route('admin.products.show',$product) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.products.edit',$product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy',$product) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
