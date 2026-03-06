@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Doğrulama Mesajları</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Her form için doğrulama hata mesajlarını özelleştirin</p>
    </div>
    <a href="{{ route('settings.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
        Site Ayarları
    </a>
@endsection

@section('content')
<div x-data="{
    activeModule: '{{ $activeModule }}',
    activeForm: '{{ $activeForm }}',
    search: ''
}">

    <div class="flex flex-col lg:flex-row gap-6">

        {{-- Sol Panel: Modül & Form Listesi --}}
        <div class="lg:w-72 flex-shrink-0">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden sticky top-4">
                <div class="p-4 border-b border-slate-200 dark:border-slate-700">
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                        <input type="text" x-model="search" placeholder="Form ara..."
                               class="w-full pl-10 pr-3 py-2 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                    </div>
                </div>
                <nav class="p-2 max-h-[calc(100vh-14rem)] overflow-y-auto">
                    @foreach($modules as $moduleKey => $module)
                    <div class="mb-1" x-data="{ open: activeModule === '{{ $moduleKey }}' }">
                        <button @click="open = !open; activeModule = '{{ $moduleKey }}'"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-sm font-semibold transition-all"
                                :class="activeModule === '{{ $moduleKey }}' ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50'">
                            <span>{{ $module['label'] }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-collapse class="ml-2 mt-1 space-y-0.5">
                            @foreach($module['forms'] as $formKey => $form)
                            <button @click="activeForm = '{{ $formKey }}'"
                                    x-show="search === '' || '{{ strtolower($form['label']) }}'.includes(search.toLowerCase())"
                                    class="w-full text-left px-3 py-1.5 rounded-lg text-xs transition-all truncate"
                                    :class="activeForm === '{{ $formKey }}' ? 'bg-fuchsia-100 dark:bg-fuchsia-500/20 text-fuchsia-700 dark:text-fuchsia-300 font-medium' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-700'">
                                @php
                                    $hasOverrides = !empty(array_diff_assoc($formMessages[$formKey] ?? [], $formDefaults[$formKey] ?? []));
                                @endphp
                                {{ $form['label'] }}
                                @if($hasOverrides)
                                    <span class="inline-block w-1.5 h-1.5 bg-amber-400 rounded-full ml-1"></span>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </nav>
            </div>
        </div>

        {{-- Sağ Panel: Form Mesajları --}}
        <div class="flex-1 min-w-0">
            @foreach($modules as $moduleKey => $module)
                @foreach($module['forms'] as $formKey => $form)
                <div x-show="activeForm === '{{ $formKey }}'" x-transition.opacity>
                    <form method="POST" action="{{ route('settings.validationMessages.updateForm', $formKey) }}">
                        @csrf

                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/80 border-b border-slate-200 dark:border-slate-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-base font-semibold text-slate-900 dark:text-white">{{ $form['label'] }}</h2>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ count($form['fields']) }} alan</p>
                                    </div>
                                    @if(!empty(array_diff_assoc($formMessages[$formKey] ?? [], $formDefaults[$formKey] ?? [])))
                                        <span class="inline-flex items-center px-2 py-1 text-[10px] font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-full">
                                            Özelleştirilmiş
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                @foreach($form['fields'] as $fieldKey => $field)
                                <div class="px-6 py-4">
                                    <div class="flex items-center gap-2 mb-3">
                                        <code class="text-xs font-mono px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 rounded-lg">{{ $fieldKey }}</code>
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $field['label'] }}</span>
                                    </div>
                                    <div class="space-y-2 ml-2">
                                        @foreach($field['rules'] as $rule)
                                            @php
                                                $msgKey = "{$fieldKey}.{$rule}";
                                                $currentValue = $formMessages[$formKey][$msgKey] ?? '';
                                                $defaultValue = $formDefaults[$formKey][$msgKey] ?? '';
                                                $isOverridden = $currentValue !== $defaultValue;
                                            @endphp
                                            @if($defaultValue !== '')
                                            <div class="flex items-start gap-3">
                                                <div class="w-28 flex-shrink-0 pt-2">
                                                    <span class="inline-flex items-center gap-1">
                                                        <code class="text-[11px] font-mono px-1.5 py-0.5 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded">{{ $rule }}</code>
                                                        @if($isOverridden)
                                                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full flex-shrink-0"></span>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <input type="text"
                                                           name="messages[{{ $msgKey }}]"
                                                           value="{{ $currentValue }}"
                                                           class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all {{ $isOverridden ? 'ring-amber-300 dark:ring-amber-600' : '' }}"
                                                           placeholder="{{ $defaultValue }}">
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="button"
                                    onclick="if(confirm('Bu formun tüm mesajlarını varsayılanlara sıfırlamak istediğinize emin misiniz?')) document.getElementById('reset-{{ $formKey }}').submit()"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>
                                Varsayılana Sıfırla
                            </button>
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                Kaydet
                            </button>
                        </div>
                    </form>

                    <form id="reset-{{ $formKey }}" method="POST" action="{{ route('settings.validationMessages.resetForm', $formKey) }}" class="hidden">
                        @csrf
                    </form>
                </div>
                @endforeach
            @endforeach

            {{-- Boş durum --}}
            <div x-show="activeForm === ''" x-transition.opacity>
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-300 mb-2">Form Seçin</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Sol menüden düzenlemek istediğiniz formu seçin</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
