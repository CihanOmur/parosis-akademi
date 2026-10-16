@extends('admin.layouts.app')

@section('page-banner')
    <div class="w-full flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">E-bülten Aboneleri</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Footer'daki "Haber Al" formundan abone olanlar · toplam {{ $totalCount }}</p>
        </div>
        @if($totalCount > 0)
        <a href="{{ route('newsletter.export') }}"
           class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-slate-900 dark:bg-fuchsia-600 text-white text-sm font-medium hover:opacity-90 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            CSV indir
        </a>
        @endif
    </div>
@endsection

@section('content')
<div class="p-6 lg:p-8 space-y-4">
    {{-- Filtre --}}
    <form method="GET" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4 flex flex-wrap items-end gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Ara (e-posta)</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="ornek@mail.com"
                   class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="h-10 px-5 rounded-lg bg-slate-900 dark:bg-fuchsia-600 text-white text-sm font-medium hover:opacity-90 transition">Filtrele</button>
            <a href="{{ route('newsletter.index') }}" class="h-10 px-4 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition inline-flex items-center">Sıfırla</a>
        </div>
    </form>

    {{-- Liste --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead class="bg-slate-50 dark:bg-slate-700/40">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">E-posta</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Dil</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Abone olma</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse($subscribers as $sub)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                            <td class="px-4 py-3">
                                <a href="mailto:{{ $sub->email }}" class="text-sm text-fuchsia-600 dark:text-fuchsia-400 hover:underline break-all">{{ $sub->email }}</a>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-500 uppercase">{{ $sub->locale ?: '—' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-500">{{ $sub->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                @can('newsletter_delete')
                                    <x-action-menu>
                                        <form action="{{ route('newsletter.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Bu aboneyi silmek istediğinize emin misiniz?');" class="am-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="am-item am-danger">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                Sil
                                            </button>
                                        </form>
                                    </x-action-menu>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-500">
                                {{ request()->filled('q') ? 'Aramaya uyan abone bulunamadı.' : 'Henüz e-bülten abonesi yok.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscribers->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{ $subscribers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
