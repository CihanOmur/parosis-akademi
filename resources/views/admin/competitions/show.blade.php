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
            <div class="flex items-center gap-3 mt-1 flex-wrap">
                <p class="text-sm text-slate-500 dark:text-slate-400">Katılan öğrenciler</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold
                             bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">
                    {{ $competition->participants_count }} öğrenci
                </span>
                @if($competition->start_date)
                    <span class="text-xs text-slate-400">
                        {{ $competition->start_date->format('d.m.Y') }}{{ $competition->end_date ? ' → ' . $competition->end_date->format('d.m.Y') : '' }}
                    </span>
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
        'passport' => [
            'yok'            => 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300',
            'var'            => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'kontrol_edildi' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
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
    @if($competition->description)
        <div class="mb-5 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
            <div class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">Açıklama</div>
            <div class="text-sm text-slate-700 dark:text-slate-200 whitespace-pre-line">{{ $competition->description }}</div>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Öğrenci</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Veli İzin</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pasaport</th>
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
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['parent_consent'][$entry->parent_consent_status] ?? '' }}">
                                    {{ $entry->parent_consent_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['passport'][$entry->passport_status] ?? '' }}">
                                    {{ $entry->passport_label }}
                                </span>
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
                                    <span class="text-slate-400 italic text-xs">Sonuç girilmedi</span>
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
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Bu yarışmaya henüz öğrenci atanmamış.</p>
                                </div>
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
@endsection
