<!-- Sign In Block -->
<div class="signin-block fixed left-1/2 top-1/2 z-50 hidden -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white px-6 py-[30px] sm:px-[75px] lg:py-10 xl:py-[60px]">
    <button class="absolute right-5 top-5 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
        &times;
    </button>
    <img src="{{ asset('assets-front/img/logo-small.png') }}" alt="logo" width="117" height="28" class="mx-auto" />
    <div class="my-7 text-center">
        <h2 class="mb-3">Giriş Yap</h2>
        <p>
            Hesabınız yok mu?
            <button class="signup-text-btn text-colorPurpleBlue" onclick="signupTextBtn()">
                Kayıt Ol
            </button>
        </p>
    </div>
    <form action="#" method="post" class="grid w-80 grid-cols-1 gap-y-[22px] sm:w-[374px]">
        <input type="text" placeholder="Kullanıcı adınızı girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="password" placeholder="Şifrenizi girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <label for="check-box-signin" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
            <span class="relative">
                <input type="checkbox" name="check-box-signin" id="check-box-signin" class="peer opacity-0" />
                <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
            </span>
            Beni hatırla
        </label>
        <div>
            <button type="submit" class="btn btn-primary is-icon group">
                Giriş Yap
                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
            </button>
        </div>
    </form>
    <span class="mb-7 mt-8 block text-center">Veya şununla giriş yapın</span>
    <div class="flex justify-center gap-2.5">
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-colorJasper/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-google.svg') }}" alt="icon-origin-google" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#1977F3]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-facebook.svg') }}" alt="icon-origin-facebook" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#0077B5]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-linkedin.svg') }}" alt="icon-origin-linkedin" width="24" height="24" />
        </button>
    </div>
</div>
<!-- Sign In Block -->

<!-- Sign Up Block -->
<div class="signup-block fixed left-1/2 top-1/2 z-50 hidden -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white px-6 py-[30px] sm:px-[75px] lg:py-10 xl:py-[60px]">
    <button class="absolute right-5 top-5 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
        &times;
    </button>
    <img src="{{ asset('assets-front/img/logo-small.png') }}" alt="logo" width="117" height="28" class="mx-auto" />
    <div class="my-7 text-center">
        <h2 class="mb-3">Kayıt Ol</h2>
        <p>
            Zaten hesabınız var mı?
            <button class="text-colorPurpleBlue" onclick="signinTextBtn()">
                Giriş Yap
            </button>
        </p>
    </div>
    <form action="#" method="post" class="grid w-80 grid-cols-1 gap-y-[22px] sm:w-[374px]">
        <input type="text" placeholder="Adınızı girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="text" placeholder="Kullanıcı adı girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="email" placeholder="E-posta girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="password" placeholder="Şifre girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <label for="check-box-signup" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
            <span class="relative">
                <input type="checkbox" name="check-box-signup" id="check-box-signup" class="peer opacity-0" />
                <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
            </span>
            <strong class="font-medium text-colorBlackPearl/65">Gizlilik Politikası</strong>'nı kabul ediyorum
        </label>
        <div>
            <button type="submit" class="btn btn-primary is-icon group">
                Kayıt Ol
                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
            </button>
        </div>
    </form>
    <span class="mb-7 mt-8 block text-center">Veya şununla kayıt olun</span>
    <div class="flex justify-center gap-2.5">
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-colorJasper/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-google.svg') }}" alt="icon-origin-google" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#1977F3]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-facebook.svg') }}" alt="icon-origin-facebook" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#0077B5]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-linkedin.svg') }}" alt="icon-origin-linkedin" width="24" height="24" />
        </button>
    </div>
</div>
<!-- Sign Up Block -->

<!-- Cart Sidebar -->
<div id="cartSidebarOverlay" style="display:none; position:fixed; inset:0; z-index:9998; background:rgba(0,0,0,.5); transition:opacity .3s; opacity:0;" onclick="closeCartSidebar()"></div>
<div id="cartSidebar" style="position:fixed; right:0; top:0; z-index:9999; height:100vh; width:420px; max-width:90vw; background:#fff; box-shadow:-4px 0 24px rgba(0,0,0,.12); transform:translateX(100%); transition:transform .3s ease; display:flex; flex-direction:column;">
    <!-- Header -->
    <div style="display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-bottom:1px solid #eee;">
        <div style="display:flex; align-items:center; gap:12px; font-size:18px; font-weight:700; color:#263238;">
            <img src="{{ asset('assets-front/img/icons/icon-grey-bag.svg') }}" alt="bag" width="21" height="21" />
            Sepetim
            <span id="sidebar-cart-count" style="display:inline-flex; align-items:center; justify-content:center; min-width:24px; height:24px; padding:0 6px; border-radius:50px; background:#6340FF; color:#fff; font-size:12px; font-weight:600;">{{ $globalCartCount ?? 0 }}</span>
        </div>
        <button onclick="closeCartSidebar()" style="width:32px; height:32px; border:none; background:none; cursor:pointer; font-size:24px; color:#999; display:flex; align-items:center; justify-content:center;">&times;</button>
    </div>

    <!-- Items -->
    <div id="sidebar-cart-items" style="flex:1; overflow-y:auto; padding:16px 24px;">
        @php $cart = $globalCart ?? []; @endphp
        @if(count($cart) === 0)
        <div id="sidebar-cart-empty" style="display:flex; flex-direction:column; align-items:center; justify-content:center; padding:64px 0; text-align:center;">
            <svg style="width:64px; height:64px; color:#ddd; margin-bottom:16px;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
            </svg>
            <p style="font-size:14px; color:#999;">Sepetiniz boş</p>
            <a href="{{ route('front.products') }}" onclick="closeCartSidebar()" style="margin-top:16px; font-size:14px; font-weight:600; color:#6340FF; text-decoration:none;">Alışverişe Başla</a>
        </div>
        @else
        @foreach($cart as $key => $item)
        <div id="sidebar-item-{{ $key }}" style="display:flex; gap:14px; padding:12px; margin-bottom:12px; background:#FAF9F6; border-radius:12px; transition:all .2s;">
            <a href="{{ route('front.product.details', $item['product_id']) }}" onclick="closeCartSidebar()" style="width:72px; height:72px; flex-shrink:0; border-radius:8px; overflow:hidden; display:block;">
                @if(!empty($item['image']))
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:100%; height:100%; object-fit:cover;" />
                @else
                    <div style="width:100%; height:100%; background:#e5e7eb; display:flex; align-items:center; justify-content:center;">
                        <svg style="width:24px; height:24px; color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12"/></svg>
                    </div>
                @endif
            </a>
            <div style="flex:1; display:flex; flex-direction:column; justify-content:center; gap:6px; overflow:hidden;">
                <a href="{{ route('front.product.details', $item['product_id']) }}" onclick="closeCartSidebar()" style="font-size:14px; font-weight:700; color:#263238; text-decoration:none; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $item['name'] }}</a>
                @if(!empty($item['variant_info']) && is_array($item['variant_info']))
                <p style="font-size:11px; color:#888; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                    @foreach($item['variant_info'] as $attrName => $valName)
                        {{ $attrName }}: {{ $valName }}@if(!$loop->last), @endif
                    @endforeach
                </p>
                @endif
                <div style="display:flex; align-items:center; justify-content:space-between; gap:8px;">
                    <span style="font-size:14px; font-weight:600; color:#6340FF;" id="sidebar-price-{{ $key }}">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</span>
                    <!-- +/- Controls -->
                    <div style="display:inline-flex; align-items:center; gap:0; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden;">
                        <button type="button" onclick="sidebarQty('{{ $key }}', -1)" style="width:28px; height:28px; border:none; background:#f9fafb; cursor:pointer; font-size:16px; font-weight:600; color:#666; display:flex; align-items:center; justify-content:center; transition:background .15s;" onmouseover="this.style.background='#eee'" onmouseout="this.style.background='#f9fafb'">&minus;</button>
                        <span id="sidebar-qty-{{ $key }}" style="width:32px; height:28px; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; color:#263238; background:#fff; border-left:1px solid #e5e7eb; border-right:1px solid #e5e7eb;">{{ $item['quantity'] }}</span>
                        <button type="button" onclick="sidebarQty('{{ $key }}', 1)" style="width:28px; height:28px; border:none; background:#f9fafb; cursor:pointer; font-size:16px; font-weight:600; color:#666; display:flex; align-items:center; justify-content:center; transition:background .15s;" onmouseover="this.style.background='#eee'" onmouseout="this.style.background='#f9fafb'">+</button>
                    </div>
                </div>
            </div>
            <button type="button" onclick="removeFromSidebar('{{ $key }}')" style="width:24px; height:24px; flex-shrink:0; align-self:start; margin-top:2px; border:none; background:none; cursor:pointer; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#ccc; transition:all .2s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#ccc'">
                <svg style="width:14px; height:14px;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endforeach
        @endif
    </div>

    <!-- Footer -->
    <div id="sidebar-cart-footer" style="padding:20px 24px; border-top:1px solid #eee; background:#fff; {{ count($cart) === 0 ? 'display:none;' : '' }}">
        <!-- Coupon -->
        <div id="sidebarCouponSection" style="margin-bottom:14px;">
            @php $sidebarCoupon = session('coupon'); @endphp
            <div id="sidebarCouponApplied" style="{{ $sidebarCoupon ? '' : 'display:none;' }} background:#f0fdf4; border-radius:10px; padding:10px 14px; margin-bottom:10px;">
                <div style="display:flex; align-items:center; justify-content:space-between;">
                    <div style="display:flex; align-items:center; gap:6px;">
                        <svg style="width:14px; height:14px; color:#22c55e;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
                        <span id="sidebarCouponCode" style="font-size:13px; font-weight:700; color:#15803d;">{{ $sidebarCoupon['code'] ?? '' }}</span>
                    </div>
                    <button type="button" onclick="sidebarRemoveCoupon()" style="border:none; background:none; cursor:pointer; font-size:12px; font-weight:600; color:#ef4444;">Kaldır</button>
                </div>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-top:6px;">
                    <span style="font-size:12px; color:#16a34a;">İndirim</span>
                    <span id="sidebarDiscountAmount" style="font-size:13px; font-weight:600; color:#16a34a;">{{ $sidebarCoupon ? '-' . number_format($globalCouponDiscount ?? 0, 2, ',', '.') . ' ₺' : '' }}</span>
                </div>
            </div>
            <div id="sidebarCouponInput" style="{{ $sidebarCoupon ? 'display:none;' : '' }}">
                <div style="display:flex; gap:8px;">
                    <input type="text" id="sidebarCouponCode_input" placeholder="Kupon kodu" style="flex:1; padding:9px 12px; border:2px solid #e5e7eb; border-radius:10px; font-size:13px; font-weight:500; text-transform:uppercase; outline:none; background:#fafafa; transition:border-color .2s;" onfocus="this.style.borderColor='#6340FF'" onblur="this.style.borderColor='#e5e7eb'" />
                    <button type="button" id="sidebarCouponApplyBtn" onclick="sidebarApplyCoupon()" style="padding:9px 14px; border:none; border-radius:10px; background:#263238; color:#fff; font-size:12px; font-weight:700; cursor:pointer; transition:background .2s; white-space:nowrap;" onmouseover="this.style.background='#6340FF'" onmouseout="this.style.background='#263238'">Uygula</button>
                </div>
                <p id="sidebarCouponError" style="display:none; margin-top:6px; font-size:12px; color:#ef4444; font-weight:500;"></p>
            </div>
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
            <span style="font-size:14px; color:#888;">Toplam</span>
            <span id="sidebar-cart-total" style="font-size:20px; font-weight:700; color:#263238;">{{ number_format($globalCartTotal ?? 0, 2, ',', '.') }} ₺</span>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <a href="{{ route('front.cart') }}" onclick="closeCartSidebar()" style="display:inline-flex; align-items:center; justify-content:center; padding:12px 16px; border:2px solid #ddd; border-radius:50px; font-size:14px; font-weight:600; color:#263238; text-decoration:none; transition:all .2s;" onmouseover="this.style.borderColor='#999'" onmouseout="this.style.borderColor='#ddd'">Sepete Git</a>
            <a href="{{ route('front.checkout') }}" onclick="closeCartSidebar()" style="display:inline-flex; align-items:center; justify-content:center; padding:12px 16px; border:none; border-radius:50px; font-size:14px; font-weight:600; color:#fff; background:#6340FF; text-decoration:none; transition:all .2s;" onmouseover="this.style.background='#263238'" onmouseout="this.style.background='#6340FF'">Ödeme Yap</a>
        </div>
    </div>
</div>
<script>
var _cartCsrf = '{{ csrf_token() }}';
var _cartUpdateUrl = '{{ route("front.cart.update") }}';
var _cartRemoveUrl = '{{ route("front.cart.remove") }}';

function openCartSidebar() {
    var sidebar = document.getElementById('cartSidebar');
    var overlay = document.getElementById('cartSidebarOverlay');
    if (!sidebar || !overlay) return;
    overlay.style.display = 'block';
    setTimeout(function() { overlay.style.opacity = '1'; sidebar.style.transform = 'translateX(0)'; }, 10);
    document.body.style.overflow = 'hidden';
}

function closeCartSidebar() {
    var sidebar = document.getElementById('cartSidebar');
    var overlay = document.getElementById('cartSidebarOverlay');
    if (!sidebar || !overlay) return;
    sidebar.style.transform = 'translateX(100%)';
    overlay.style.opacity = '0';
    setTimeout(function() { overlay.style.display = 'none'; }, 300);
    document.body.style.overflow = '';
}

function _formatTL(n) {
    return parseFloat(n).toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' ₺';
}

function _updateGlobals(data) {
    var badge = document.getElementById('cart-badge');
    if (badge) { badge.textContent = data.cart_count; badge.classList.toggle('hidden', data.cart_count === 0); }
    var sc = document.getElementById('sidebar-cart-count');
    if (sc) sc.textContent = data.cart_count;
    var tot = document.getElementById('sidebar-cart-total');
    if (tot) tot.textContent = _formatTL(data.cart_total);
}

function _showEmpty() {
    var c = document.getElementById('sidebar-cart-items');
    if (c) c.innerHTML = '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:64px 0;text-align:center;"><svg style="width:64px;height:64px;color:#ddd;margin-bottom:16px;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/></svg><p style="font-size:14px;color:#999;">Sepetiniz boş</p></div>';
    var f = document.getElementById('sidebar-cart-footer');
    if (f) f.style.display = 'none';
}

function sidebarQty(key, delta) {
    var qtyEl = document.getElementById('sidebar-qty-' + key);
    if (!qtyEl) return;
    var cur = parseInt(qtyEl.textContent) || 1;
    var next = cur + delta;
    if (next < 1) { removeFromSidebar(key); return; }
    qtyEl.textContent = next;

    fetch(_cartUpdateUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _cartCsrf, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ key: key, quantity: next })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 1) {
            qtyEl.textContent = data.quantity;
            var priceEl = document.getElementById('sidebar-price-' + key);
            if (priceEl) priceEl.textContent = _formatTL(data.item_total);
            _updateGlobals(data);
        }
    });
}

function _sidebarAddItem(data) {
    var container = document.getElementById('sidebar-cart-items');
    if (!container) return;
    // Remove empty state if present
    var emptyEl = document.getElementById('sidebar-cart-empty');
    if (emptyEl) emptyEl.remove();
    // Show footer
    var footer = document.getElementById('sidebar-cart-footer');
    if (footer) footer.style.display = '';

    var key = data.item.key;
    var existing = document.getElementById('sidebar-item-' + key);
    if (existing) {
        // Update quantity and price
        var qtyEl = document.getElementById('sidebar-qty-' + key);
        if (qtyEl) qtyEl.textContent = data.item.quantity;
        var priceEl = document.getElementById('sidebar-price-' + key);
        if (priceEl) priceEl.textContent = _formatTL(data.item.line_total);
        // Flash highlight
        existing.style.background = '#EDE9FE';
        setTimeout(function() { existing.style.background = '#FAF9F6'; }, 600);
    } else {
        // Build variant info text
        var variantText = '';
        if (data.item.variant_info && typeof data.item.variant_info === 'object') {
            var parts = [];
            for (var attr in data.item.variant_info) {
                parts.push(attr + ': ' + data.item.variant_info[attr]);
            }
            variantText = parts.join(', ');
        }
        var imgHtml = data.item.image
            ? '<img src="' + data.item.image + '" alt="" style="width:100%;height:100%;object-fit:cover;" />'
            : '<div style="width:100%;height:100%;background:#e5e7eb;display:flex;align-items:center;justify-content:center;"><svg style="width:24px;height:24px;color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12"/></svg></div>';

        var html = '<div id="sidebar-item-' + key + '" style="display:flex;gap:14px;padding:12px;margin-bottom:12px;background:#EDE9FE;border-radius:12px;transition:all .3s;">'
            + '<div style="width:72px;height:72px;flex-shrink:0;border-radius:8px;overflow:hidden;">' + imgHtml + '</div>'
            + '<div style="flex:1;display:flex;flex-direction:column;justify-content:center;gap:6px;overflow:hidden;">'
            + '<span style="font-size:14px;font-weight:700;color:#263238;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + data.item.name + '</span>'
            + (variantText ? '<p style="font-size:11px;color:#888;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + variantText + '</p>' : '')
            + '<div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">'
            + '<span style="font-size:14px;font-weight:600;color:#6340FF;" id="sidebar-price-' + key + '">' + _formatTL(data.item.line_total) + '</span>'
            + '<div style="display:inline-flex;align-items:center;gap:0;border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">'
            + '<button type="button" onclick="sidebarQty(\'' + key + '\',-1)" style="width:28px;height:28px;border:none;background:#f9fafb;cursor:pointer;font-size:16px;font-weight:600;color:#666;display:flex;align-items:center;justify-content:center;">&minus;</button>'
            + '<span id="sidebar-qty-' + key + '" style="width:32px;height:28px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:#263238;background:#fff;border-left:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">' + data.item.quantity + '</span>'
            + '<button type="button" onclick="sidebarQty(\'' + key + '\',1)" style="width:28px;height:28px;border:none;background:#f9fafb;cursor:pointer;font-size:16px;font-weight:600;color:#666;display:flex;align-items:center;justify-content:center;">+</button>'
            + '</div></div></div>'
            + '<button type="button" onclick="removeFromSidebar(\'' + key + '\')" style="width:24px;height:24px;flex-shrink:0;align-self:start;margin-top:2px;border:none;background:none;cursor:pointer;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#ccc;">'
            + '<svg style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg></button></div>';

        container.insertAdjacentHTML('afterbegin', html);
        // Fade to normal bg
        setTimeout(function() {
            var el = document.getElementById('sidebar-item-' + key);
            if (el) el.style.background = '#FAF9F6';
        }, 600);
    }
    _updateGlobals(data);
}

function removeFromSidebar(key) {
    var item = document.getElementById('sidebar-item-' + key);
    if (item) { item.style.opacity = '0.4'; item.style.pointerEvents = 'none'; }

    fetch(_cartRemoveUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _cartCsrf, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ key: key })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 1) {
            if (item) { item.style.height = item.offsetHeight + 'px'; item.offsetHeight; item.style.height = '0'; item.style.padding = '0'; item.style.margin = '0'; item.style.overflow = 'hidden'; setTimeout(function() { item.remove(); }, 200); }
            _updateGlobals(data);
            if (data.cart_count === 0) _showEmpty();
        }
    })
    .catch(function() { if (item) { item.style.opacity = '1'; item.style.pointerEvents = ''; } });
}

// Sidebar coupon
var _couponApplyUrl = '{{ route("front.coupon.apply") }}';
var _couponRemoveUrl = '{{ route("front.coupon.remove") }}';

var _sidebarCouponInput = document.getElementById('sidebarCouponCode_input');
if (_sidebarCouponInput) {
    _sidebarCouponInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); sidebarApplyCoupon(); }
    });
}

function sidebarApplyCoupon() {
    var code = document.getElementById('sidebarCouponCode_input').value.trim();
    if (!code) return;
    var btn = document.getElementById('sidebarCouponApplyBtn');
    var errEl = document.getElementById('sidebarCouponError');
    btn.disabled = true; btn.textContent = '...';
    errEl.style.display = 'none';

    fetch(_couponApplyUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _cartCsrf, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        body: JSON.stringify({ code: code })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        btn.disabled = false; btn.textContent = 'Uygula';
        if (data.status === 1) {
            document.getElementById('sidebarCouponCode').textContent = data.code;
            document.getElementById('sidebarDiscountAmount').textContent = '-' + data.discount_formatted + ' ₺';
            document.getElementById('sidebarCouponApplied').style.display = '';
            document.getElementById('sidebarCouponInput').style.display = 'none';
            document.getElementById('sidebar-cart-total').textContent = data.total_formatted + ' ₺';
            // Sync other pages if open
            var cartTotal = document.getElementById('cartTotal');
            if (cartTotal) cartTotal.textContent = data.total_formatted + ' ₺';
            var couponApplied = document.getElementById('couponApplied');
            if (couponApplied) {
                document.getElementById('couponCodeLabel').textContent = data.code;
                document.getElementById('couponDiscountLabel').textContent = '-' + data.discount_formatted + ' ₺';
                couponApplied.style.display = '';
                var ci = document.getElementById('couponInput');
                if (ci) ci.style.display = 'none';
            }
        } else {
            errEl.textContent = data.message;
            errEl.style.display = '';
        }
    })
    .catch(function() {
        btn.disabled = false; btn.textContent = 'Uygula';
        errEl.textContent = 'Bir hata oluştu.';
        errEl.style.display = '';
    });
}

function sidebarRemoveCoupon() {
    fetch(_couponRemoveUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _cartCsrf, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 1) {
            document.getElementById('sidebarCouponApplied').style.display = 'none';
            document.getElementById('sidebarCouponInput').style.display = '';
            document.getElementById('sidebarCouponCode_input').value = '';
            document.getElementById('sidebar-cart-total').textContent = data.total_formatted + ' ₺';
            // Sync cart page if open
            var cartTotal = document.getElementById('cartTotal');
            if (cartTotal) cartTotal.textContent = data.total_formatted + ' ₺';
            var couponApplied = document.getElementById('couponApplied');
            if (couponApplied) {
                couponApplied.style.display = 'none';
                var ci = document.getElementById('couponInput');
                if (ci) ci.style.display = '';
            }
        }
    });
}
</script>
<!-- Cart Sidebar -->

<!-- Offcanvas - Info -->
<div class="menu-info fixed right-0 top-0 z-50 flex h-full w-80 translate-x-full flex-col overflow-y-clip bg-white px-6 py-2 transition-all duration-300 sm:w-96">
    <div>
        <button class="absolute right-0 top-0 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
            &times;
        </button>
        <a href="{{ route('front.home') }}"><img src="{{ asset('assets-front/img/logo-parosis-akademi.svg') }}" alt="logo" width="137" height="33" /></a>
    </div>
    <div class="mt-10">
        <ul class="grid grid-cols-1 gap-y-10">
            <li>
                <h4 class="mb-3">Bizi Takip Edin:</h4>
                <div class="flex items-center gap-x-3.5">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="facebook">
                        <img src="{{ asset('assets-front/img/icons/icon-dark-facebook.svg') }}" alt="icon-dark-facebook" width="20" height="20" class="h-auto w-[17px]" />
                    </a>
                    <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" aria-label="twitter">
                        <img src="{{ asset('assets-front/img/icons/icon-dark-twitter.svg') }}" alt="icon-dark-twitter" width="21" height="20" class="h-auto w-[17px]" />
                    </a>
                    <a href="https://www.dribbble.com" target="_blank" rel="noopener noreferrer" aria-label="dribbble">
                        <img src="{{ asset('assets-front/img/icons/icon-dark-dribbble.svg') }}" alt="icon-dark-dribbble" width="21" height="20" class="h-auto w-[17px]" />
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" aria-label="instagram">
                        <img src="{{ asset('assets-front/img/icons/icon-dark-instagram.svg') }}" alt="icon-dark-instagram" width="21" height="20" class="h-auto w-[17px]" />
                    </a>
                </div>
            </li>
            <li>
                <h4 class="mb-3">Bize Ulaşın:</h4>
                <ul class="flex flex-col gap-y-3">
                    <li class="inline-flex gap-x-6">
                        <div class="h-7 w-auto">
                            <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="icon-purple-phone-ring" width="28" height="28" />
                        </div>
                        <div class="flex-1">
                            <span class="block">7/24 Destek</span>
                            <a href="tel:+5323213333" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">+532 321 33 33</a>
                        </div>
                    </li>
                    <li class="inline-flex gap-x-6">
                        <div class="h-7 w-auto">
                            <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="icon-purple-mail-open" width="28" height="28" />
                        </div>
                        <div class="flex-1">
                            <span class="block">Mesaj Gönderin</span>
                            <a href="mailto:info@parosisakademi.com" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">info@parosisakademi.com</a>
                        </div>
                    </li>
                    <li class="inline-flex gap-x-6">
                        <div class="h-7 w-auto">
                            <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="icon-purple-location" width="28" height="28" />
                        </div>
                        <div class="flex-1">
                            <span class="block">Adresimiz</span>
                            <address class="font-title text-xl not-italic text-colorBlackPearl">
                                Istanbul, Turkiye
                            </address>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <h4 class="mb-3">Abone Olun:</h4>
                <form action="#" method="post" class="relative mt-4 text-sm font-medium">
                    <input type="email" class="w-full rounded-[50px] border border-colorPurpleBlue bg-white px-7 py-2.5 outline-none" placeholder="E-posta girin" />
                    <button type="submit" class="mt-4 inline-flex h-11 items-center justify-center gap-x-6 rounded-[50px] border border-colorPurpleBlue bg-colorPurpleBlue px-7 text-white hover:bg-[#4533bb]">
                        Abone Ol
                        <img src="{{ asset('assets-front/img/icons/icon-white-arrow-right.svg') }}" alt="icon-white-arrow-right" width="24" height="16" />
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- Offcanvas - Info -->
