@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Order Items List</h1>

    <a href="{{ route('admin.orderitems.create') }}" class="btn btn-primary mb-3">Add New Order Item</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Order Name</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->order->name ?? '' }}</td>
                <td>{{ $item->amount }}</td>
                <td>
                    <a href="{{ route('admin.orderitems.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.orderitems.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.orderitems.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this order item?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orderItems->links() }}
</div>
@endsection