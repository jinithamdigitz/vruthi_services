@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Order Details</h1>

    <p><strong>ID:</strong> {{ $order->id }}</p>

    <p><strong>Name:</strong> {{ $order->name }}</p>
    <p><strong>Address:</strong>{{ $order->address }}</p>
    <p><strong>Amount:</strong> {{ $order->amount }}</p>
    <p><strong>Email ID:</strong> {{ $order->email_id }}</p>
    <p><strong>Phone Number:</strong> {{ $order->phonenumber }}</p>



    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection