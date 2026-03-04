@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Menu Ogeleri</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Navigasyon menusunu yonetin — surukle, iceri/disari tasi</p>
    </div>
    <a href="{{ route('menu-items.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Menu Ogesi
    </a>
@endsection

@section('content')
    <div>
        {{-- Root sortable --}}
        <div id="sortable-root" class="space-y-3">
            @forelse($menuItems as $rootItem)
                <div class="menu-group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50" data-id="{{ $rootItem->id }}">

                    {{-- Root item header --}}
                    <div class="flex items-center gap-3 px-5 py-3.5 bg-gradient-to-r from-slate-50 to-white dark:from-slate-800 dark:to-slate-800 rounded-2xl">
                        {{-- Drag --}}
                        <div class="drag-handle-root cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-500 dark:text-slate-600 dark:hover:text-slate-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                            </svg>
                        </div>
                        {{-- Label --}}
                        <a href="{{ route('menu-items.edit', $rootItem->id) }}"
                           class="flex-1 min-w-0 font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors truncate">
                            {{ $rootItem->label }}
                        </a>
                        {{-- URL badge --}}
                        <span class="hidden sm:inline-flex px-2.5 py-1 bg-slate-100 dark:bg-slate-700 rounded-lg text-xs font-mono text-slate-500 dark:text-slate-400 flex-shrink-0">
                            {{ $rootItem->url }}
                        </span>
                        {{-- Actions --}}
                        @include('admin.menu-items._actions', ['item' => $rootItem, 'level' => 0])
                    </div>

                    {{-- Level 1 children --}}
                    @if($rootItem->children->count())
                        <div id="sortable-children-{{ $rootItem->id }}" class="sortable-children mx-4 mb-4 mt-1 space-y-2 border-l-2 border-fuchsia-200 dark:border-fuchsia-800/40 pl-4" data-parent-id="{{ $rootItem->id }}">
                            @foreach($rootItem->children as $child)
                                <div class="menu-child bg-slate-50 dark:bg-slate-700/40 rounded-xl border border-slate-200/60 dark:border-slate-600/40" data-id="{{ $child->id }}">

                                    <div class="flex items-center gap-2.5 px-4 py-3 rounded-xl">
                                        {{-- Drag --}}
                                        <div class="drag-handle-child cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-500 dark:text-slate-500 dark:hover:text-slate-400 flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                                            </svg>
                                        </div>
                                        {{-- Label --}}
                                        <a href="{{ route('menu-items.edit', $child->id) }}"
                                           class="flex-1 min-w-0 font-medium text-sm text-slate-800 dark:text-slate-200 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors truncate">
                                            {{ $child->label }}
                                        </a>
                                        {{-- URL badge --}}
                                        <span class="hidden sm:inline-flex px-2 py-0.5 bg-white dark:bg-slate-700 rounded-md text-[11px] font-mono text-slate-400 dark:text-slate-500 flex-shrink-0">
                                            {{ $child->url }}
                                        </span>
                                        {{-- Actions --}}
                                        @include('admin.menu-items._actions', ['item' => $child, 'level' => 1])
                                    </div>

                                    {{-- Level 2 grandchildren --}}
                                    @if($child->children->count())
                                        <div id="sortable-children-{{ $child->id }}" class="sortable-children mx-3 mb-3 space-y-1.5 border-l-2 border-purple-200 dark:border-purple-800/30 pl-3" data-parent-id="{{ $child->id }}">
                                            @foreach($child->children as $sub)
                                                <div class="menu-sub bg-white dark:bg-slate-700/60 rounded-lg border border-slate-200/40 dark:border-slate-600/30" data-id="{{ $sub->id }}">
                                                    <div class="flex items-center gap-2 px-3 py-2.5 rounded-lg">
                                                        {{-- Drag --}}
                                                        <div class="drag-handle-sub cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-400 dark:text-slate-500 dark:hover:text-slate-400 flex-shrink-0">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                                                            </svg>
                                                        </div>
                                                        {{-- Label --}}
                                                        <a href="{{ route('menu-items.edit', $sub->id) }}"
                                                           class="flex-1 min-w-0 text-sm text-slate-700 dark:text-slate-300 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors truncate">
                                                            {{ $sub->label }}
                                                        </a>
                                                        {{-- URL --}}
                                                        <span class="hidden sm:inline-flex px-2 py-0.5 bg-slate-50 dark:bg-slate-800 rounded text-[11px] font-mono text-slate-400 dark:text-slate-500 flex-shrink-0">
                                                            {{ $sub->url }}
                                                        </span>
                                                        {{-- Actions --}}
                                                        @include('admin.menu-items._actions', ['item' => $sub, 'level' => 2])
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 px-6 py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400">Henuz menu ogesi eklenmemis.</p>
                        <a href="{{ route('menu-items.create') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium">
                            Ilk menu ogesini ekleyin
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
(function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    let sortableInstances = [];

    // ── Sortable baslatma ──────────────────────────────────────────
    function initAllSortables() {
        // Onceki instance'lari temizle
        sortableInstances.forEach(function (s) { try { s.destroy(); } catch(e) {} });
        sortableInstances = [];

        // Root seviye
        var root = document.getElementById('sortable-root');
        if (root && root.querySelectorAll('.menu-group').length > 0) {
            sortableInstances.push(
                Sortable.create(root, {
                    handle: '.drag-handle-root',
                    draggable: '.menu-group',
                    animation: 200,
                    ghostClass: 'opacity-30',
                    forceFallback: true,
                    onChoose: function (evt) {
                        evt.item.classList.add('ring-2', 'ring-fuchsia-400', 'rounded-2xl');
                    },
                    onUnchoose: function (evt) {
                        evt.item.classList.remove('ring-2', 'ring-fuchsia-400', 'rounded-2xl');
                    },
                    onEnd: function () {
                        var ids = [];
                        root.querySelectorAll(':scope > .menu-group').forEach(function (el) {
                            ids.push(parseInt(el.dataset.id));
                        });
                        saveOrder(ids);
                    }
                })
            );
        }

        // Alt seviye container'lari
        document.querySelectorAll('.sortable-children').forEach(function (container) {
            var isLevel2 = container.closest('.menu-child') !== null;
            var handleCls = isLevel2 ? '.drag-handle-sub' : '.drag-handle-child';
            var dragCls = isLevel2 ? '.menu-sub' : '.menu-child';

            sortableInstances.push(
                Sortable.create(container, {
                    handle: handleCls,
                    draggable: dragCls,
                    animation: 200,
                    ghostClass: 'opacity-30',
                    forceFallback: true,
                    onChoose: function (evt) {
                        evt.item.classList.add('ring-2', 'ring-fuchsia-300', 'rounded-xl');
                    },
                    onUnchoose: function (evt) {
                        evt.item.classList.remove('ring-2', 'ring-fuchsia-300', 'rounded-xl');
                    },
                    onEnd: function () {
                        var ids = [];
                        var selector = ':scope > ' + dragCls;
                        container.querySelectorAll(selector).forEach(function (el) {
                            ids.push(parseInt(el.dataset.id));
                        });
                        saveOrder(ids);
                    }
                })
            );
        });
    }

    // ── Siralama kaydet ────────────────────────────────────────────
    function saveOrder(ids) {
        axios.post('{{ route("menu-items.updateOrder") }}', {
            order: ids,
            _token: csrfToken
        })
        .then(function (r) {
            if (r.data.status === 1) showToast('success', r.data.message);
            else showToast('error', r.data.message || 'Hata');
        })
        .catch(function () {
            showToast('error', 'Siralama kaydedilemedi.');
        });
    }

    // ── Indent / Outdent ───────────────────────────────────────────
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.btn-indent, .btn-outdent');
        if (!btn) return;

        var id = btn.dataset.id;
        var action = btn.classList.contains('btn-indent') ? 'indent' : 'outdent';

        btn.classList.add('opacity-50', 'pointer-events-none');

        axios.post('/panel/menu-items/' + id + '/' + action, { _token: csrfToken })
            .then(function (r) {
                if (r.data.status === 1) {
                    showToast('success', r.data.message);
                    // Sayfayi yenile (DOM degisikligi karmasik, reload daha guvenli)
                    setTimeout(function () { location.reload(); }, 300);
                } else {
                    showToast('error', r.data.message);
                    btn.classList.remove('opacity-50', 'pointer-events-none');
                }
            })
            .catch(function () {
                showToast('error', 'Bir hata olustu.');
                btn.classList.remove('opacity-50', 'pointer-events-none');
            });
    });

    // ── Toggle aktif/pasif ─────────────────────────────────────────
    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('status-toggle')) return;

        var checkbox = e.target;
        var itemId = checkbox.dataset.id;
        var prevState = !checkbox.checked;

        axios.post('/panel/menu-items/' + itemId + '/toggle', { _token: csrfToken })
            .then(function (r) {
                if (r.data.status === 1) {
                    showToast('success', r.data.message);
                } else {
                    showToast('error', r.data.message);
                    checkbox.checked = prevState;
                }
            })
            .catch(function () {
                showToast('error', 'Bir hata olustu.');
                checkbox.checked = prevState;
            });
    });

    // ── Baslat ─────────────────────────────────────────────────────
    initAllSortables();
})();
</script>
@endsection
