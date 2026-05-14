@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Category Details</h1>
    <p><strong>Name:</strong> {{ $product_category->name }}</p>
    @if($product_category->image)
        <img src="{{ asset($product_category->image) }}" width="120">
    @endif
    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
