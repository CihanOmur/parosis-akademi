<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\Shop\Order;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        ], ValidationMessageService::getMessages('order_status'));

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;

        if ($request->filled('admin_note')) {
            $order->admin_note = $request->admin_note;
        }

        $order->save();

        // Send status update email to customer
        if ($oldStatus !== $request->status && $order->customer_email) {
            try {
                Mail::to($order->customer_email)->send(
                    new OrderStatusMail($order, $oldStatus, $request->status)
                );
            } catch (\Exception $e) {
                \Log::error('Order status mail failed: ' . $e->getMessage());
            }
        }

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
