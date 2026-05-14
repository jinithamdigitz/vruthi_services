@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Transaction</h2>

    <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="from" class="form-label">From</label>
            <input type="text" name="from" id="from" value="{{ old('from', $transaction->from) }}" class="form-control" required>
            @error('from') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="to" class="form-label">To</label>
            <input type="text" name="to" id="to" value="{{ old('to', $transaction->to) }}" class="form-control" required>
            @error('to') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="transaction_code" class="form-label">Transaction Code</label>
            <input type="text" name="transaction_code" id="transaction_code" value="{{ old('transaction_code', $transaction->transaction_code) }}" class="form-control" required>
            @error('transaction_code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $transaction->amount) }}" class="form-control" required>
            @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection