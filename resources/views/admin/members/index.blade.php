@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Üyeler</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sitede kayıt olan ziyaretçi hesapları · toplam {{ $totalCount }}</p>
    </div>
@endsection

@section('content')
<div class="p-6 lg:p-8 space-y-4">
    {{-- Filtreler --}}
    <form method="GET" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4 flex flex-wrap items-end gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Ara (ad/e-posta/telefon)</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Ayşe, ornek@mail.com, 532..."
                   class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
        </div>
        <div class="min-w-[160px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Durum</label>
            <select name="status" class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
                <option value="">Hepsi</option>
                <option value="active" @selected(request('status') === 'active')>Aktif</option>
                <option value="passive" @selected(request('status') === 'passive')>Pasif</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="h-10 px-5 rounded-lg bg-slate-900 dark:bg-fuchsia-600 text-white text-sm font-medium hover:opacity-90 transition">Filtrele</button>
            <a href="{{ route('members.index') }}" class="h-10 px-4 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition inline-flex items-center">Sıfırla</a>
        </div>
    </form>

    {{-- Liste --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px]">
                <thead class="bg-slate-50 dark:bg-slate-700/40">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Üye</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İletişim</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kayıt</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Son giriş</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Durum</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse($members as $m)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                            <td class="px-4 py-3">
                                <a href="{{ route('members.show', $m->id) }}" class="text-sm font-medium text-slate-800 dark:text-slate-200 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">{{ $m->name }}</a>
                                <div class="text-xs text-slate-400">#{{ $m->id }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <a href="mailto:{{ $m->email }}" class="block text-sm text-fuchsia-600 dark:text-fuchsia-400 hover:underline">{{ $m->email }}</a>
                                @if($m->phone)
                                    <a href="tel:{{ $m->phone }}" class="block text-xs text-slate-500 hover:underline">{{ $m->phone }}</a>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-500">{{ $m->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm text-slate-500">{{ $m->last_login_at ? $m->last_login_at->format('d.m.Y H:i') : '—' }}</td>
                            <td class="px-4 py-3">
                                @if($m->is_active)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 dark:bg-emerald-900/40 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:text-emerald-300">Aktif</span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 dark:bg-slate-700 px-2.5 py-1 text-xs font-medium text-slate-600 dark:text-slate-300">Pasif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <x-action-menu>
                                    <a href="{{ route('members.show', $m->id) }}" class="am-item">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                        Detay
                                    </a>
                                    <form action="{{ route('members.toggle', $m->id) }}" method="POST" class="am-form">
                                        @csrf
                                        <button type="submit" class="am-item">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9"/></svg>
                                            {{ $m->is_active ? 'Pasifleştir' : 'Aktifleştir' }}
                                        </button>
                                    </form>
                                    @can('member_delete')
                                        <div class="am-divider"></div>
                                        <form action="{{ route('members.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Bu üyeyi silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');" class="am-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="am-item am-danger">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                Sil
                                            </button>
                                        </form>
                                    @endcan
                                </x-action-menu>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                                {{ request()->hasAny(['q', 'status']) ? 'Filtreye uyan üye bulunamadı.' : 'Henüz kayıtlı üye yok.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
