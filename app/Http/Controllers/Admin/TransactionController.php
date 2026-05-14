<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    
    public function create()
    {
        return view('admin.transactions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'transaction_code' => 'required|string|max:255|unique:transactions',
            'amount' => 'required|numeric',
        ]);

        Transaction::create($request->all());

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction created successfully.');
    }


    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }


    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

 
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'transaction_code' => 'required|string|max:255|unique:transactions,transaction_code,' . $transaction->id,
            'amount' => 'required|numeric',
        ]);

        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}
