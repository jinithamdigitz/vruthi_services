@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Order</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $order->name) }}" maxlength="255" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $order->address) }}" maxlength="255" required>
        </div>


        <div class="form-group">
            <label>Email ID</label>
            <input type="email" name="email_id" class="form-control" value="{{ old('email_id', $order->email_id) }}" maxlength="255" required>
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $order->amount) }}" required>
        </div>



        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phonenumber" class="form-control" value="{{ old('phonenumber', $order->phonenumber) }}" maxlength="20" required>
        </div>

        
        <br>
        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection