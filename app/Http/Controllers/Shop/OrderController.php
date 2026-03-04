<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $status = request('status');
        $search = request('q');

        $query = Order::withCount('items')->orderByDesc('created_at');

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->appends(request()->only('status', 'q'));

        return view('admin.orders.index', compact('orders', 'status', 'search'));
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;

        if ($request->filled('admin_note')) {
            $order->admin_note = $request->admin_note;
        }

        $order->save();

        return redirect()->route('orders.show', $id)
            ->with('success', 'Sipariş durumu güncellendi.');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Sipariş silindi.');
    }
}
