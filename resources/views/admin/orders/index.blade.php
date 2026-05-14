@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Orders List</h1>

    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>

                <th>Name</th>
                <th>address</th>

                <th>Amount</th>
                <th>Email ID</th>
                <th>Phone Number</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>

                <td>{{ $order->name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->email_id }}</td>
                <td>{{ $order->phonenumber }}</td>


                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this order?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection