@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Transaction Details</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $transaction->id }}</td>
        </tr>
        <tr>
            <th>From</th>
            <td>{{ $transaction->from }}</td>
        </tr>
        <tr>
            <th>To</th>
            <td>{{ $transaction->to }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>{{ $transaction->amount }}</td>
        </tr>
        <tr>
            <th>Transaction Code</th>
            <td>{{ $transaction->transaction_code }}</td>
        </tr>
    </table>

    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection