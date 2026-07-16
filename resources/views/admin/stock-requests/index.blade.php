@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Stok Bildirim Talepleri</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Stokta olmayan ürünler için müşteri talepleri</p>
    </div>
@endsection

@section('content')
<div class="p-6 lg:p-8 space-y-4">
    {{-- Filtreler --}}
    <form method="GET" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4 flex flex-wrap items-end gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">E-posta ara</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="ornek@parosis.com"
                   class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
        </div>
        <div class="min-w-[220px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Ürün</label>
            <select name="product_id" class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
                <option value="">Tüm ürünler</option>
                @foreach($products as $p)
                    <option value="{{ $p->id }}" @selected(request('product_id') == $p->id)>
                        {{ is_string($p->name) ? $p->name : ($p->name['tr'] ?? $p->name['en'] ?? '#'.$p->id) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="min-w-[160px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Durum</label>
            <select name="status" class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
                <option value="">Hepsi</option>
                <option value="pending" @selected(request('status') === 'pending')>Bekleyen</option>
                <option value="notified" @selected(request('status') === 'notified')>Bildirildi</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="h-10 px-5 rounded-lg bg-slate-900 dark:bg-fuchsia-600 text-white text-sm font-medium hover:opacity-90 transition">Filtrele</button>
            <a href="{{ route('stock-requests.index') }}" class="h-10 px-4 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition inline-flex items-center">Sıfırla</a>
        </div>
    </form>

    {{-- Liste --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px]">
                <thead class="bg-slate-50 dark:bg-slate-700/40">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ürün</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">E-posta</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Not</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tarih</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Durum</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse($items as $r)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                            <td class="px-6 py-4 text-sm text-slate-500">#{{ $r->id }}</td>
                            <td class="px-6 py-4">
                                @php $pname = $r->product?->name; @endphp
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-200">
                                    {{ is_string($pname) ? $pname : ($pname['tr'] ?? $pname['en'] ?? '#'.$r->product_id) }}
                                </div>
                                <div class="text-xs text-slate-400">Ürün #{{ $r->product_id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="mailto:{{ $r->email }}" class="text-sm text-fuchsia-600 dark:text-fuchsia-400 hover:underline">{{ $r->email }}</a>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <span class="text-sm text-slate-600 dark:text-slate-400 truncate block" title="{{ $r->note }}">
                                    {{ $r->note ?: '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $r->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($r->notified_at)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-medium">
                                        ✓ Bildirildi
                                    </span>
                                    <div class="text-xs text-slate-400 mt-1">{{ $r->notified_at->format('d.m.Y') }}</div>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 text-xs font-medium">
                                        ● Bekleyen
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    @can('shop')
                                        @if(!$r->notified_at)
                                            <form action="{{ route('stock-requests.markNotified', $r->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-lg transition-all"
                                                        title="Bildirildi olarak işaretle">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                    @can('shop_delete')
                                        <form action="{{ route('stock-requests.destroy', $r->id) }}" method="POST" class="inline"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', {
                                                  title: 'Talebi Sil',
                                                  message: '{{ addslashes($r->email) }} tarafından yapılan talebi silmek istediğinize emin misiniz?',
                                                  form: $el
                                              })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all"
                                                    title="Sil">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-slate-500 dark:text-slate-400">
                                Henüz stok bildirim talebi yok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $items->links() }}
</div>
@endsection
