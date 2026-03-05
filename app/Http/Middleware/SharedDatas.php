<?php

namespace App\Http\Middleware;

use App\Models\Languages\Languages;
use App\Models\MenuItem;
use App\Models\Pages\Contact\ContactPageInfo;
use App\Models\Pages\Footer\FooterPageInfo;
use App\Models\Pages\Navbar\NavbarPageInfo;
use App\Models\Shop\Coupon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SharedDatas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $activeLanguages = Languages::where('status', 1)->where('is_active', 1)->select('id', 'locale', 'name', 'is_default')->get();
        $defaultLanguage = $activeLanguages->firstWhere('is_default', 1)
            ?? Languages::where('status', 1)->where('is_default', 1)->select('id', 'locale', 'name', 'is_default')->first();
        $navbarInfo = NavbarPageInfo::first();
        $footerInfo = FooterPageInfo::first();
        $contactInfo = ContactPageInfo::first();
        $navMenuItems = MenuItem::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order')
                  ->with(['children' => function ($q2) {
                      $q2->where('is_active', true)->orderBy('sort_order');
                  }]);
            }])
            ->orderBy('sort_order')
            ->get();

        $cart = session('cart', []);
        $cartCount = collect($cart)->sum('quantity');
        $cartSubtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $globalCouponDiscount = 0;
        $couponSession = session('coupon');
        if ($couponSession && !empty($cart)) {
            $couponModel = Coupon::find($couponSession['id']);
            if ($couponModel && $couponModel->isValid($cartSubtotal)) {
                $globalCouponDiscount = $couponModel->calculateDiscount($cartSubtotal);
            }
        }
        $cartTotal = max(0, $cartSubtotal - $globalCouponDiscount);

        view()->share([
            'activeLanguages' => $activeLanguages,
            'defaultLanguage' => $defaultLanguage,
            'navbarInfo' => $navbarInfo,
            'footerInfo' => $footerInfo,
            'contactInfo' => $contactInfo,
            'navMenuItems' => $navMenuItems,
            'globalCart' => $cart,
            'globalCartCount' => $cartCount,
            'globalCartTotal' => $cartTotal,
            'globalCouponDiscount' => $globalCouponDiscount,
        ]);
        return $next($request);
    }
}
