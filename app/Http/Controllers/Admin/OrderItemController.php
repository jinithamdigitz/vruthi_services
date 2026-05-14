<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('order')->paginate(10);
        return view('admin.orderitems.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order::all();
        return view('admin.orderitems.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
        ]);

        OrderItem::create($validated);

        return redirect()->route('admin.orderitems.index')->with('success', 'Order item created.');
    }

    public function show(OrderItem $orderitem)
    {
        return view('admin.orderitems.show', compact('orderitem'));
    }

    public function edit(OrderItem $orderitem)
    {
        $orders = Order::all();
        return view('admin.orderitems.edit', compact('orderitem', 'orders'));
    }

    public function update(Request $request, OrderItem $orderitem)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
        ]);

        $orderitem->update($validated);
        return redirect()->route('admin.orderitems.index')->with('success', 'Order item updated.');
    }

    public function destroy(OrderItem $orderitem)
    {
        $orderitem->delete();
        return redirect()->route('admin.orderitems.index')->with('success', 'Order item deleted.');
    }
}
