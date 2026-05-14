@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Product Details</h1>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Category:</strong> {{ $product->category?->name }}</p>
    @if($product->image)
        <img src="{{ asset($product->image) }}" width="120">
    @endif
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
