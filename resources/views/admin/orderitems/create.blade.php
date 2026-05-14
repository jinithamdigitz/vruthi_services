@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Order Item</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.orderitems.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                <option value="">Select Order</option>
                @foreach($orders as $order)
                <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                    {{ $order->id }} - {{ $order->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
        </div>
        <br>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('admin.orderitems.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection