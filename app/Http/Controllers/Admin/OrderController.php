<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderByDesc('id')->paginate(10); 
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
  
            'amount' => 'required|numeric',
            'name' => 'required|string|max:255',
            'program_id' => 'nullable|integer',
            'email_id' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
        ]);

        Order::create($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
           
            'amount' => 'required|numeric',
            'name' => 'required|string|max:255',
            'program_id' => 'nullable|integer',
            'email_id' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
            
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
