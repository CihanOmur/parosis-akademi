@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('competitions.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $competition->name }}</h1>
            <div class="flex items-center gap-3 mt-1 flex-wrap text-xs">
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full font-semibold
                             bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">
                    {{ $competition->participants_count }} öğrenci
                </span>
                @if($competition->country_city)
                    <span class="text-slate-500 dark:text-slate-400">📍 {{ $competition->country_city }}</span>
                @endif
                @if($competition->date_range)
                    <span class="text-slate-500 dark:text-slate-400">🗓 {{ $competition->date_range }}</span>
                @endif
            </div>
        </div>
    </div>
@endsection

@php
    $statusBadge = [
        'parent_consent' => [
            'bekliyor'      => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'alindi'        => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'teslim_edildi' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
        ],
        'visa' => [
            'gerekli_degil' => 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300',
            'basvuruldu'    => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'onaylandi'     => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
            'reddedildi'    => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
        ],
        'payment' => [
            'bekliyor' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'kismi'    => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'odendi'   => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
        ],
    ];
@endphp

@section('content')
<div x-data="{ attachOpen: false }">

    {{-- Üst meta + Öğrenci Ata --}}
    <div class="mb-5 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div class="flex-1 min-w-0 space-y-2">
                @if($competition->organizer)
                    <div class="text-sm text-slate-600 dark:text-slate-300"><strong>Düzenleyen:</strong> {{ $competition->organizer }}</div>
                @endif
                @if($competition->internal_deadline)
                    <div class="text-sm text-amber-700 dark:text-amber-400"><strong>Kurum içi son kayıt:</strong> {{ $competition->internal_deadline->format('d.m.Y') }}</div>
                @endif
                @if($competition->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-1 pt-1">
                        @foreach($competition->categories as $cat)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-fuchsia-50 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">
                                {{ $cat->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
                @if($competition->description)
                    <p class="text-sm text-slate-500 dark:text-slate-400 pt-2 whitespace-pre-line">{{ $competition->description }}</p>
                @endif
            </div>
            <button type="button" @click="attachOpen = true"
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           bg-gradient-to-r from-fuchsia-500 to-purple-600
                           hover:from-fuchsia-600 hover:to-purple-700
                           text-white font-semibold text-sm rounded-xl
                           shadow-lg shadow-fuchsia-500/25 transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 1 1-8 0 4 4 0 0 1 8 0ZM3 20a6 6 0 0 1 12 0v1H3v-1Z"/>
                </svg>
                Öğrenci Ata (toplu)
            </button>
        </div>
    </div>

    {{-- Kombinasyon Filtreleri --}}
    <div class="mb-5 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4">
        <form method="GET" class="flex flex-col sm:flex-row sm:items-end gap-3">
            <div class="flex-1 min-w-0">
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Kategori</label>
                <select name="category_id" class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    <option value="">Tümü</option>
                    @foreach($competition->categories as $cat)
                        <option value="{{ $cat->id }}" {{ (int) request('category_id') === $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-0">
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Vize Durumu</label>
                <select name="visa_status" class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    <option value="">Tümü</option>
                    @foreach($statusOptions['visa'] as $key => $label)
                        <option value="{{ $key }}" {{ request('visa_status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-0">
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Ödeme Durumu</label>
                <select name="payment_status" class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    <option value="">Tümü</option>
                    @foreach($statusOptions['payment'] as $key => $label)
                        <option value="{{ $key }}" {{ request('payment_status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    Filtrele
                </button>
                @if(request()->hasAny(['category_id','visa_status','payment_status']))
                    <a href="{{ route('competitions.show', $competition->id) }}" class="inline-flex items-center px-3 py-2 text-sm text-slate-500 hover:text-slate-700 rounded-xl border border-slate-200 dark:border-slate-600">Temizle</a>
                @endif
            </div>
        </form>
    </div>

    {{-- Katılımcı tablosu --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Öğrenci / Takım</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Veli İzin</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24 text-center">Pasaport</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Vize</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödeme</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sonuç</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24 text-center">Detay</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($entries as $entry)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                @if($entry->student)
                                    <a href="{{ route('students.competitions', $entry->student->id) }}"
                                       class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                        {{ $entry->student->full_name }}
                                    </a>
                                @else
                                    <span class="text-slate-400 italic">—</span>
                                @endif
                                @if($entry->team_name)
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Takım: {{ $entry->team_name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($entry->category)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-fuchsia-50 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">
                                        {{ $entry->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 italic">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['parent_consent'][$entry->parent_consent_status] ?? '' }}">
                                    {{ $entry->parent_consent_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($entry->passport_valid_6m)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400" title="6 ay geçerli">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                        OK
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['visa'][$entry->visa_status] ?? '' }}">
                                    {{ $entry->visa_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['payment'][$entry->payment_status] ?? '' }}">
                                    {{ $entry->payment_label }}
                                </span>
                                @if($entry->payment_amount)
                                    <div class="text-[10px] text-slate-400 mt-0.5">
                                        {{ number_format($entry->payment_amount, 2, ',', '.') }} {{ $entry->payment_currency }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                @if($entry->result_rank)
                                    <span class="inline-flex items-center gap-1">
                                        <span class="text-base font-bold text-fuchsia-600">{{ $entry->result_rank }}.</span>
                                        {{ $entry->result_label }}
                                    </span>
                                @elseif($entry->result_label)
                                    {{ $entry->result_label }}
                                @else
                                    <span class="text-slate-400 italic text-xs">—</span>
                                @endif
                                @if($entry->result_file && $entry->student)
                                    <a href="{{ route('students.competitions.resultFile', [$entry->student->id, $entry->id]) }}" class="ml-1 inline-flex text-blue-600 hover:underline" title="Sertifika/madalya dosyası">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z"/></svg>
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($entry->student)
                                    <a href="{{ route('students.competitions', $entry->student->id) }}"
                                       class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all"
                                       title="Öğrenci profilinde aç">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <p class="text-slate-500 dark:text-slate-400">
                                    @if(request()->hasAny(['category_id','visa_status','payment_status']))
                                        Bu filtrelere uyan kayıt bulunamadı.
                                    @else
                                        Bu yarışmaya henüz öğrenci atanmamış.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($entries->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50">
                {{ $entries->links() }}
            </div>
        @endif
    </div>

    {{-- ÇOKLU ÖĞRENCİ ATAMA MODALI --}}
    <div x-show="attachOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="height: 100dvh"
         @keydown.escape.window="attachOpen = false">
        <div @click.outside="attachOpen = false"
             class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
             style="max-height: calc(100dvh - 2rem);">
            <form action="{{ route('competitions.attachStudents', $competition->id) }}" method="POST" class="flex flex-col flex-1 min-h-0 overflow-hidden">
                @csrf
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex-shrink-0">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Öğrenci Ata</h3>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $competition->name }}</p>
                    </div>
                    <button type="button" @click="attachOpen = false" class="p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-5" style="min-height: 0;">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Öğrenci(ler)</label>
                        <select name="student_ids[]" id="attach-students" multiple required class="w-full">
                            @foreach(\App\Models\Student\Student::where('registration_type', 2)->orderBy('full_name')->get() as $st)
                                <option value="{{ $st->id }}">{{ $st->full_name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[11px] text-slate-400 mt-1">İsim yazarak arayın, çoklu seçim için tıklayın</p>
                    </div>

                    @if($competition->categories->isNotEmpty())
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Katılacağı Kategori (opsiyonel)</label>
                            <select name="competition_category_id" class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                <option value="">Belirtilmedi</option>
                                @foreach($competition->categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Takım Adı (opsiyonel)</label>
                        <input type="text" name="team_name" maxlength="200" placeholder="Örn: Robokids Alpha"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-2 flex-shrink-0">
                    <button type="button" @click="attachOpen = false" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">İptal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 rounded-xl shadow-md shadow-fuchsia-500/25 transition-all">Ata</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<style>
    .ts-control { border-radius: 0.75rem !important; padding: 0.5rem 0.75rem !important; min-height: 42px; }
    .ts-control .item { background: linear-gradient(to right, rgb(217 70 239), rgb(147 51 234)) !important; color: white !important; border-radius: 0.5rem !important; padding: 0.125rem 0.5rem !important; font-size: 0.75rem !important; }
    .ts-dropdown { border-radius: 0.75rem !important; }
</style>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.getElementById('attach-students');
        if (el) new TomSelect(el, { plugins: ['remove_button'], placeholder: 'Öğrenci arayın...' });
    });
</script>
@endsection
