<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Coupon;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderByDesc('id')->paginate(20);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'                => 'required|string|max:50|unique:coupons,code',
            'type'                => 'required|in:percentage,fixed',
            'value'               => 'required|numeric|min:0.01',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit'         => 'nullable|integer|min:1',
            'starts_at'           => 'nullable|date',
            'expires_at'          => 'nullable|date|after_or_equal:starts_at',
        ], ValidationMessageService::getMessages('coupon_store'));

        Coupon::create([
            'code'                => strtoupper(trim($request->code)),
            'type'                => $request->type,
            'value'               => $request->value,
            'min_order_amount'    => $request->min_order_amount ?? 0,
            'max_discount_amount' => $request->max_discount_amount,
            'usage_limit'         => $request->usage_limit,
            'starts_at'           => $request->starts_at,
            'expires_at'          => $request->expires_at,
            'is_active'           => true,
        ]);

        return redirect()->route('coupons.index')
            ->with('success', 'Kupon başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code'                => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'type'                => 'required|in:percentage,fixed',
            'value'               => 'required|numeric|min:0.01',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit'         => 'nullable|integer|min:1',
            'starts_at'           => 'nullable|date',
            'expires_at'          => 'nullable|date|after_or_equal:starts_at',
        ], ValidationMessageService::getMessages('coupon_update'));

        $coupon->update([
            'code'                => strtoupper(trim($request->code)),
            'type'                => $request->type,
            'value'               => $request->value,
            'min_order_amount'    => $request->min_order_amount ?? 0,
            'max_discount_amount' => $request->max_discount_amount,
            'usage_limit'         => $request->usage_limit,
            'starts_at'           => $request->starts_at,
            'expires_at'          => $request->expires_at,
        ]);

        return redirect()->route('coupons.index')
            ->with('success', 'Kupon başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')
            ->with('success', 'Kupon silindi.');
    }

    public function toggleActive($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->is_active = ! $coupon->is_active;
        $coupon->save();

        return response()->json([
            'status'  => 1,
            'message' => $coupon->is_active ? 'Kupon aktif edildi.' : 'Kupon pasif edildi.',
            'action'  => $coupon->is_active ? 'Aktif' : 'Pasif',
        ]);
    }
}
