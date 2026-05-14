@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Order Item</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.orderitems.update', $orderitem->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                @foreach($orders as $order)
                <option value="{{ $order->id }}" {{ $orderitem->order_id == $order->id ? 'selected' : '' }}>
                    {{ $order->id }} - {{ $order->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $orderitem->amount) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.orderitems.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection