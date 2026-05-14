@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Transactions</h2>

    <a href="{{ route('admin.transactions.create') }}" class="btn btn-success mb-3">Create Transaction</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Transaction Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->from }}</td>
                <td>{{ $transaction->to }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->transaction_code }}</td>
                <td>
                    <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}
</div>
@endsection