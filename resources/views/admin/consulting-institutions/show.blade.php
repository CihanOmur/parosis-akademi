@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('consultingInstitutions.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $institution->name }}</h1>
            <div class="flex items-center gap-3 mt-1">
                <p class="text-sm text-slate-500 dark:text-slate-400">Bu kuruma ait sertifikalar</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold
                             bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">
                    {{ $institution->certificates_count }} sertifika
                </span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if($institution->contact_email || $institution->contact_phone || $institution->notes)
        <div class="mb-5 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                @if($institution->contact_email)
                    <div>
                        <div class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">E-posta</div>
                        <div class="text-slate-700 dark:text-slate-200 font-medium">{{ $institution->contact_email }}</div>
                    </div>
                @endif
                @if($institution->contact_phone)
                    <div>
                        <div class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">Telefon</div>
                        <div class="text-slate-700 dark:text-slate-200 font-medium">{{ $institution->contact_phone }}</div>
                    </div>
                @endif
                @if($institution->notes)
                    <div class="md:col-span-3">
                        <div class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">Notlar</div>
                        <div class="text-slate-700 dark:text-slate-200">{{ $institution->notes }}</div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Öğrenci</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sertifika</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Branş</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-36">Veriliş Tarihi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24 text-center">Detay</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($certificates as $cert)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                @if($cert->student)
                                    <a href="{{ route('students.certificates', $cert->student->id) }}"
                                       class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                        {{ $cert->student->full_name ?? '—' }}
                                    </a>
                                @else
                                    <span class="text-slate-400 italic">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">
                                {{ $cert->name }}
                                @if($cert->certificate_number)
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">No: {{ $cert->certificate_number }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                {{ $cert->category?->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                {{ \Carbon\Carbon::parse($cert->issue_date)->format('d.m.Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($cert->student)
                                    <a href="{{ route('students.certificates', $cert->student->id) }}"
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
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Bu kuruma ait henüz sertifika kaydı yok.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($certificates->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50">
                {{ $certificates->links() }}
            </div>
        @endif
    </div>
@endsection
