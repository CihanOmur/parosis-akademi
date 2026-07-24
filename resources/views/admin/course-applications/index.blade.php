@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kurs Başvuruları</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Online kurs başvuru talepleri</p>
    </div>
@endsection

@section('content')
<div class="p-6 lg:p-8 space-y-4">
    {{-- Filtreler --}}
    <form method="GET" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4 flex flex-wrap items-end gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Ara (ad/veli/tel/email)</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Ahmet, 5321234567..."
                   class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
        </div>
        <div class="min-w-[220px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Kurs</label>
            <select name="course_id" class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
                <option value="">Tüm kurslar</option>
                @foreach($courses as $c)
                    <option value="{{ $c->id }}" @selected(request('course_id') == $c->id)>
                        {{ is_string($c->title) ? $c->title : ($c->title['tr'] ?? $c->title['en'] ?? '#'.$c->id) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="min-w-[160px]">
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Durum</label>
            <select name="status" class="w-full h-10 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-3 text-sm outline-none focus:ring-2 focus:ring-fuchsia-500/60">
                <option value="">Hepsi</option>
                <option value="pending" @selected(request('status') === 'pending')>Bekleyen</option>
                <option value="contacted" @selected(request('status') === 'contacted')>İletişime geçildi</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="h-10 px-5 rounded-lg bg-slate-900 dark:bg-fuchsia-600 text-white text-sm font-medium hover:opacity-90 transition">Filtrele</button>
            <a href="{{ route('course-applications.index') }}" class="h-10 px-4 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition inline-flex items-center">Sıfırla</a>
        </div>
    </form>

    {{-- Liste --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1100px]">
                <thead class="bg-slate-50 dark:bg-slate-700/40">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kurs</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Öğrenci</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Okul/Sınıf</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Veli</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İletişim</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tarih</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Durum</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse($applications as $a)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                            <td class="px-4 py-3 text-sm text-slate-500">#{{ $a->id }}</td>
                            <td class="px-4 py-3">
                                @php $cname = $a->course?->title; @endphp
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-200">
                                    {{ is_string($cname) ? $cname : ($cname['tr'] ?? $cname['en'] ?? '—') }}
                                </div>
                                @if($a->course_id)
                                    <div class="text-xs text-slate-400">#{{ $a->course_id }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $a->student_name }}</div>
                                <div class="text-xs text-slate-400">{{ $a->student_age }} yaş</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm text-slate-700 dark:text-slate-300">{{ $a->school }}</div>
                                <div class="text-xs text-slate-400">{{ $a->grade }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-700 dark:text-slate-300">{{ $a->parent_name }}</td>
                            <td class="px-4 py-3">
                                <a href="tel:{{ $a->phone }}" class="block text-sm text-fuchsia-600 dark:text-fuchsia-400 hover:underline">{{ $a->phone }}</a>
                                @if($a->email)
                                    <a href="mailto:{{ $a->email }}" class="block text-xs text-slate-500 hover:underline">{{ $a->email }}</a>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-500">
                                {{ $a->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                @if($a->status === 'contacted')
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 dark:bg-emerald-900/40 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:text-emerald-300">
                                        ✓ Görüşüldü
                                    </span>
                                    @if($a->contacted_at)
                                        <div class="mt-1 text-[10px] text-slate-400">{{ $a->contacted_at->format('d.m.Y H:i') }}</div>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 dark:bg-amber-900/40 px-2.5 py-1 text-xs font-medium text-amber-700 dark:text-amber-300">
                                        Bekliyor
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <x-action-menu>
                                    @if($a->status !== 'contacted')
                                        <form action="{{ route('course-applications.contacted', $a->id) }}" method="POST" class="am-form">
                                            @csrf
                                            <button type="submit" class="am-item">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                                İletişime geçildi
                                            </button>
                                        </form>
                                        <div class="am-divider"></div>
                                    @endif
                                    <form action="{{ route('course-applications.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Bu başvuruyu silmek istediğinize emin misiniz?');" class="am-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="am-item am-danger">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                            Sil
                                        </button>
                                    </form>
                                </x-action-menu>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-sm text-slate-500">
                                Henüz başvuru bulunmuyor.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
