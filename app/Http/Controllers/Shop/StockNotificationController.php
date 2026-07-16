<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\StockNotificationRequest;
use Illuminate\Http\Request;

class StockNotificationController extends Controller
{
    // Front: haber ver formunu kaydet
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'email'      => 'required|email|max:255',
            'note'       => 'nullable|string|max:500',
        ]);

        StockNotificationRequest::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Talebiniz alındı. Ürün stoklarımıza girdiğinde e-posta ile haber vereceğiz.',
        ]);
    }

    // Panel: liste
    public function index(Request $request)
    {
        $q = StockNotificationRequest::with('product')
            ->when($request->q, fn($qb, $s) => $qb->where('email', 'like', "%{$s}%"))
            ->when($request->product_id, fn($qb, $id) => $qb->where('product_id', $id))
            ->when($request->status === 'notified', fn($qb) => $qb->whereNotNull('notified_at'))
            ->when($request->status === 'pending', fn($qb) => $qb->whereNull('notified_at'))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->only('q', 'product_id', 'status'));

        $products = Product::orderBy('sort_order')->get(['id', 'name']);

        return view('admin.stock-requests.index', compact('q', 'products'))->with('items', $q);
    }

    // Panel: tekil sil
    public function destroy($id)
    {
        StockNotificationRequest::findOrFail($id)->delete();
        return back()->with('success', 'Talep silindi.');
    }

    // Panel: notified olarak isaretle (opsiyonel)
    public function markNotified($id)
    {
        $r = StockNotificationRequest::findOrFail($id);
        $r->notified_at = now();
        $r->save();
        return back()->with('success', 'Bildirim gonderildi olarak isaretlendi.');
    }
}
