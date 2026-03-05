<!--...::: Header Start :::... -->
@php
    $navbarInfo = $navbarInfo ?? \App\Models\Pages\Navbar\NavbarPageInfo::first();
    $footerInfo = $footerInfo ?? \App\Models\Pages\Footer\FooterPageInfo::first();
    $contactInfo = $contactInfo ?? \App\Models\Pages\Contact\ContactPageInfo::first();
    $locale = app()->getLocale();
@endphp
<div class="{{ ($headerStyle ?? 'inner') === 'home' ? 'absolute left-0 top-0 z-20 w-full' : 'relative z-20' }}">
    <!-- Header Top Area -->
    <div class="{{ ($headerStyle ?? 'inner') === 'home' ? 'bg-transparent' : 'bg-[#fbfbfb]' }} py-4">
        <div class="container-expand">
            <div class="flex items-center gap-x-6 lg:gap-x-10 xl:gap-x-[76px]">
                <!-- Header Logo -->
                <a href="{{ route('front.home') }}" class="inline-flex">
                    @if(!empty($globalSettings['logos']['header_logo']))
                        <img src="{{ asset($globalSettings['logos']['header_logo']) }}" alt="logo" width="137" height="33" />
                    @elseif($footerInfo?->logo)
                        <img src="{{ asset($footerInfo->logo) }}" alt="logo" width="137" height="33" />
                    @else
                        <img src="{{ asset('assets-front/img/logo-parosis-akademi.svg') }}" alt="logo" width="137" height="33" />
                    @endif
                </a>
                <!-- Header Right Block -->
                <div class="flex flex-1 items-center justify-end gap-x-4 lg:gap-x-9">
                    <!-- Search Block -->
                    @if($navbarInfo?->show_search ?? true)
                    <div id="headerSearchWrap" class="relative hidden w-full max-w-xl flex-1 md:flex">
                        <form action="{{ route('front.search') }}" method="get" class="relative w-full group">
                            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/>
                                </svg>
                            </span>
                            <input type="search" name="q" id="headerSearchInput" autocomplete="off"
                                   placeholder="{{ $navbarInfo?->getTranslation('search_placeholder', $locale) ?: 'Kursunuzu arayın...' }}"
                                   class="w-full rounded-full border border-slate-200 bg-white py-3 pl-11 pr-28 text-sm text-colorBlackPearl outline-none placeholder:text-slate-400 focus:border-colorPurpleBlue focus:ring-2 focus:ring-colorPurpleBlue/20 transition-all" />
                            <button type="submit"
                                    class="absolute right-1.5 top-1/2 -translate-y-1/2 inline-flex items-center gap-2 rounded-full bg-colorPurpleBlue px-5 py-2 text-sm font-medium text-white shadow-sm hover:bg-colorBlackPearl hover:shadow-md transition-all">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/>
                                </svg>
                                <span class="hidden xl:inline">{{ $navbarInfo?->getTranslation('search_button_text', $locale) ?: 'Ara' }}</span>
                            </button>
                        </form>
                        {{-- Dropdown --}}
                        <div id="headerSearchDropdown" style="display:none"
                             class="absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl transition-all duration-200"></div>
                    </div>
                    <script>
                    (function(){
                        const input    = document.getElementById('headerSearchInput');
                        const dropdown = document.getElementById('headerSearchDropdown');
                        const wrap     = document.getElementById('headerSearchWrap');
                        if (!input || !dropdown) return;

                        const SUGGEST_URL = '{{ route("front.search.suggest") }}';
                        const SEARCH_URL  = '{{ route("front.search") }}';

                        let timer = null, activeIdx = -1, items = [];

                        function esc(str) {
                            if (!str) return '';
                            var d = document.createElement('div');
                            d.appendChild(document.createTextNode(str));
                            return d.innerHTML;
                        }

                        const badgeMap = {
                            course:  { label:'Kurs',    cls:'background:rgba(99,62,255,.1);color:#6340FF' },
                            blog:    { label:'Blog',    cls:'background:#fef3c7;color:#b45309' },
                            teacher: { label:'Eğitmen', cls:'background:#d1fae5;color:#047857' }
                        };

                        function hide() { dropdown.style.display = 'none'; }
                        function show() { dropdown.style.display = 'block'; }

                        function render(results, allUrl) {
                            items = results;
                            activeIdx = -1;
                            if (!results.length) {
                                dropdown.innerHTML = '<div style="padding:20px;text-align:center"><svg style="margin:0 auto 8px;width:32px;height:32px;color:#cbd5e1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg><p style="font-size:14px;color:#64748b">Sonuç bulunamadı</p></div>';
                                show();
                                return;
                            }

                            let html = '';
                            results.forEach(function(item, idx) {
                                const badge = badgeMap[item.type] || badgeMap.course;
                                html += '<a href="'+ esc(item.url) +'" data-idx="'+ idx +'" class="search-suggest-item" style="display:flex;align-items:center;gap:14px;padding:10px 20px;text-decoration:none;color:inherit;border-bottom:1px solid #f1f5f9;transition:background .15s">';
                                // thumb
                                html += '<div style="width:40px;height:40px;border-radius:8px;overflow:hidden;background:#f1f5f9;flex-shrink:0;display:flex;align-items:center;justify-content:center">';
                                if (item.image) {
                                    html += '<img src="'+ esc(item.image) +'" style="width:100%;height:100%;object-fit:cover" />';
                                } else {
                                    html += '<svg style="width:20px;height:20px;color:#cbd5e1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/></svg>';
                                }
                                html += '</div>';
                                // text
                                html += '<div style="flex:1;min-width:0">';
                                html += '<p style="font-size:14px;font-weight:600;color:#263238;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin:0">' + esc(item.label) + '</p>';
                                if (item.desc) html += '<p style="font-size:12px;color:#94a3b8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin:2px 0 0">' + esc(item.desc) + '</p>';
                                html += '</div>';
                                // badge
                                html += '<span style="flex-shrink:0;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:500;' + badge.cls + '">' + badge.label + '</span>';
                                html += '</a>';
                            });
                            // see all
                            html += '<a href="'+ esc(allUrl) +'" style="display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 20px;font-size:14px;font-weight:500;color:#6340FF;text-decoration:none;border-top:1px solid #f1f5f9;transition:background .15s" onmouseover="this.style.background=\'#f8fafc\'" onmouseout="this.style.background=\'\'">Tüm sonuçları gör <svg style="width:16px;height:16px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg></a>';
                            dropdown.innerHTML = html;
                            show();
                            // hover
                            dropdown.querySelectorAll('.search-suggest-item').forEach(function(el) {
                                el.addEventListener('mouseenter', function() {
                                    highlightIdx(parseInt(el.dataset.idx));
                                });
                            });
                        }

                        function renderLoading() {
                            dropdown.innerHTML = '<div style="display:flex;align-items:center;gap:12px;padding:16px 20px"><svg style="width:20px;height:20px;animation:spin 1s linear infinite;color:#6340FF" fill="none" viewBox="0 0 24 24"><circle style="opacity:.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path style="opacity:.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg><span style="font-size:14px;color:#94a3b8">Aranıyor...</span></div>';
                            show();
                        }

                        function highlightIdx(idx) {
                            var els = dropdown.querySelectorAll('.search-suggest-item');
                            els.forEach(function(el, i) { el.style.background = i === idx ? '#f8fafc' : ''; });
                            activeIdx = idx;
                        }

                        async function doSearch() {
                            var q = input.value.trim();
                            if (q.length < 2) { hide(); return; }
                            renderLoading();
                            try {
                                var res = await fetch(SUGGEST_URL + '?q=' + encodeURIComponent(q));
                                var data = await res.json();
                                render(data.results || [], data.allUrl || SEARCH_URL + '?q=' + encodeURIComponent(q));
                            } catch(e) { hide(); }
                        }

                        input.addEventListener('input', function() {
                            clearTimeout(timer);
                            timer = setTimeout(doSearch, 350);
                        });

                        input.addEventListener('focus', function() {
                            if (items.length && input.value.trim().length >= 2) show();
                        });

                        input.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') { hide(); return; }
                            var els = dropdown.querySelectorAll('.search-suggest-item');
                            if (!els.length) return;
                            if (e.key === 'ArrowDown') {
                                e.preventDefault();
                                highlightIdx(Math.min(activeIdx + 1, els.length - 1));
                            } else if (e.key === 'ArrowUp') {
                                e.preventDefault();
                                highlightIdx(Math.max(activeIdx - 1, 0));
                            } else if (e.key === 'Enter' && activeIdx >= 0 && els[activeIdx]) {
                                e.preventDefault();
                                window.location.href = els[activeIdx].href;
                            }
                        });

                        document.addEventListener('click', function(e) {
                            if (!wrap.contains(e.target)) hide();
                        });

                        // spin keyframes
                        if (!document.getElementById('searchSpinCSS')) {
                            var style = document.createElement('style');
                            style.id = 'searchSpinCSS';
                            style.textContent = '@keyframes spin{to{transform:rotate(360deg)}}';
                            document.head.appendChild(style);
                        }
                    })();
                    </script>
                    @endif
                    <!-- Search Block -->

                    <!-- Social Links -->
                    @if($navbarInfo?->show_social_links ?? true)
                    <div class="hidden items-center gap-x-3.5 xl:flex">
                        @foreach($footerInfo?->social_links ?? [] as $social)
                            @if(!empty($social['url']))
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['name'] ?? 'social' }}">
                                @if(!empty($social['icon']))
                                    <img src="{{ asset($social['icon']) }}" alt="{{ $social['name'] ?? 'social' }}" width="20" height="20" class="h-auto w-[17px]" />
                                @else
                                    <span class="text-xs text-colorBlackPearl">{{ Str::limit($social['name'] ?? '', 2) }}</span>
                                @endif
                            </a>
                            @endif
                        @endforeach
                    </div>
                    @endif

                    <!-- User Event -->
                    <div class="flex items-center gap-x-2.5">
                        @if($navbarInfo?->show_register_button ?? true)
                        <button class="hidden h-10 rounded-[50Px] bg-colorBrightGold px-6 text-sm font-medium leading-none text-colorBlackPearl hover:shadow sm:inline-block" onclick="signupBtn()">
                            {{ $navbarInfo?->getTranslation('register_button_text', $locale) ?: 'Kayıt Ol' }}
                        </button>
                        @endif
                        @if($navbarInfo?->show_login_button ?? true)
                        <button class="h-10 rounded-[50Px] bg-gradient-to-t from-[#D7E1D8] to-white px-6 text-sm font-medium leading-none text-colorBlackPearl hover:shadow" onclick="signinBtn()">
                            {{ $navbarInfo?->getTranslation('login_button_text', $locale) ?: 'Giriş Yap' }}
                        </button>
                        @endif
                        <!-- Responsive Offcanvas Menu Button -->
                        <div class="site-header inline-block lg:hidden">
                            <button id="openBtn" class="hamburger-menu mobile-menu-trigger">
                                <span class="bg-colorBlackPearl before:bg-colorBlackPearl after:bg-colorBlackPearl"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Top Area -->

    <!-- Header Bottom Area -->
    <header class="site-header bg-white py-0 shadow-[0_4px_30px_16px] shadow-[#070229]/5 {{ ($headerStyle ?? 'inner') === 'home' ? 'z-50' : '' }}">
        <div class="container-expand">
            <div class="flex justify-between text-sm font-medium leading-none text-[#263238]">
                <!-- Header Navigation -->
                <div class="menu-block-wrapper">
                    <div class="menu-overlay"></div>
                    <nav class="menu-block" id="append-menu-header">
                        <div class="mobile-menu-head">
                            <div class="go-back">
                                <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90" />
                            </div>
                            <div class="current-menu-title"></div>
                            <div class="mobile-menu-close">&times;</div>
                        </div>
                        <ul class="site-menu-main">
                            @foreach($navMenuItems ?? [] as $item)
                                @php $hasChildren = $item->children->isNotEmpty(); @endphp
                                <li class="nav-item{{ $hasChildren ? ' nav-item-has-children' : '' }}">
                                    <a href="{{ $item->url }}" {!! $item->target === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '' !!} class="nav-link-item{{ $hasChildren ? ' drop-trigger' : '' }} rounded-none border border-transparent text-colorBlackPearl">{{ $item->label }}
                                        @if($hasChildren)
                                            <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="chevron" width="9" height="5" class="-rotate-90 lg:rotate-0" />
                                        @endif
                                    </a>
                                    @if($hasChildren)
                                        <ul class="sub-menu">
                                            @foreach($item->children as $child)
                                                @php $childHasChildren = $child->children->isNotEmpty(); @endphp
                                                <li class="sub-menu--item{{ $childHasChildren ? ' nav-item-has-children' : '' }}">
                                                    <a href="{{ $child->url }}" {!! $child->target === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '' !!}{{ $childHasChildren ? ' data-menu-get=h3' : '' }} class="{{ $childHasChildren ? 'drop-trigger' : '' }}">{{ $child->label }}
                                                        @if($childHasChildren)
                                                            <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="chevron" width="9" height="5" class="-rotate-90" />
                                                        @endif
                                                    </a>
                                                    @if($childHasChildren)
                                                        <ul class="sub-menu shape-none">
                                                            @foreach($child->children as $sub)
                                                                <li class="sub-menu--item">
                                                                    <a href="{{ $sub->url }}" {!! $sub->target === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '' !!}>{{ $sub->label }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <!-- Header Navigation -->

                <!-- Right Block -->
                <div class="flex flex-1 flex-row items-center justify-between gap-x-9 gap-y-3 py-5 lg:justify-end lg:py-0">
                    <div class="flex flex-col gap-x-4 sm:flex-row sm:items-center">
                        @php $phone = $contactInfo?->phone_1 ?? '+532 321 33 33'; @endphp
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-sm text-[#263238]">{{ $phone }}</a>
                        <div class="h-[5px] w-[5px] flex-1 rounded-[50%] bg-[#263238]/30"></div>
                        <a href="mailto:{{ $contactInfo?->email_1 ?? 'info@parosisakademi.com' }}" class="text-sm text-[#263238]">{{ $contactInfo?->email_1 ?? 'info@parosisakademi.com' }}</a>
                    </div>
                    <div class="flex items-center justify-between gap-x-5">
                        <!-- Cart Button -->
                        @if($navbarInfo?->show_cart_button ?? true)
                        <button class="relative" onclick="openCartSidebar()">
                            <img src="{{ asset('assets-front/img/icons/icon-grey-bag.svg') }}" alt="icon-grey-bag" width="21" height="21" />
                            <span id="cart-badge" class="absolute left-2 top-full inline-flex h-[18px] min-w-[18px] -translate-y-3 items-center justify-center rounded-[50%] bg-colorPurpleBlue text-sm font-normal leading-none text-white {{ ($globalCartCount ?? 0) == 0 ? 'hidden' : '' }}">{{ $globalCartCount ?? 0 }}</span>
                        </button>
                        @endif
                        <!-- Side Info Button -->
                        @if($navbarInfo?->show_side_info_button ?? true)
                        <button onclick="sideInfoBtn()">
                            <img src="{{ asset('assets-front/img/icons/icon-grey-menu-3-line.svg') }}" alt="icon-grey-menu-3-line" width="20" height="20" />
                        </button>
                        @endif
                    </div>
                </div>
                <!-- Right Block -->
            </div>
        </div>
    </header>
    <!-- Header Bottom Area -->
</div>
<!--...::: Header End :::... -->
