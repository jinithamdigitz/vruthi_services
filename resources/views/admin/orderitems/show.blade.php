@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Order Item Details</h1>

    <p><strong>ID:</strong> {{ $orderitem->id }}</p>
    <p><strong>Order:</strong> {{ $orderitem->order->name ?? 'N/A' }}</p>
    <p><strong>Amount:</strong> {{ $orderitem->amount }}</p>

    <a href="{{ route('admin.orderitems.index') }}" class="btn btn-secondary mt-3">Back to Order Items</a>
</div>
@endsection