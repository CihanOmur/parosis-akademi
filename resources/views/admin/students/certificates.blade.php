@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('students.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $student->full_name }}</h1>
            <div class="flex items-center gap-3 mt-1">
                <p class="text-sm text-slate-500 dark:text-slate-400">Sertifikalar</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                    {{ $student->is_active == '1' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $student->is_active == '1' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                    {{ $student->is_active == '1' ? 'Aktif' : 'Pasif' }}
                </span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="mb-5">
        @include('admin.components.tab-menu-student')
    </div>

    @include('admin.students.partials.certificates-tab')
@endsection
