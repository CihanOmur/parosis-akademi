@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Site Ayarları</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sitenizin genel yapılandırmasını yönetin</p>
    </div>
@endsection

@section('content')
<div x-data="{ activeTab: '{{ request('tab', 'general') }}' }">

    {{-- Tab Navigation --}}
    <div class="flex flex-wrap gap-1 p-1.5 bg-slate-100 dark:bg-slate-800 rounded-2xl mb-6 overflow-x-auto">
        <button @click="activeTab = 'general'"
                :class="activeTab === 'general' ? 'bg-white dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
            Genel
        </button>
        <button @click="activeTab = 'logos'"
                :class="activeTab === 'logos' ? 'bg-white dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3 16.5V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v10.5Z"/></svg>
            Logolar
        </button>
        <button @click="activeTab = 'seo'"
                :class="activeTab === 'seo' ? 'bg-white dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
            SEO
        </button>
        <button @click="activeTab = 'mail'"
                :class="activeTab === 'mail' ? 'bg-white dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
            E-posta
        </button>
        <button @click="activeTab = 'social'"
                :class="activeTab === 'social' ? 'bg-white dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/></svg>
            Sosyal Medya
        </button>
        <button @click="activeTab = 'advanced'"
                :class="activeTab === 'advanced' ? 'bg-white dark:bg-slate-700 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700'"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/></svg>
            Gelişmiş
        </button>
    </div>

    {{-- Tab Panels --}}
    <div x-show="activeTab === 'general'" x-transition.opacity>
        @include('admin.settings.partials.tab-general')
    </div>
    <div x-show="activeTab === 'logos'" x-transition.opacity>
        @include('admin.settings.partials.tab-logos')
    </div>
    <div x-show="activeTab === 'seo'" x-transition.opacity>
        @include('admin.settings.partials.tab-seo')
    </div>
    <div x-show="activeTab === 'mail'" x-transition.opacity>
        @include('admin.settings.partials.tab-mail')
    </div>
    <div x-show="activeTab === 'social'" x-transition.opacity>
        @include('admin.settings.partials.tab-social')
    </div>
    <div x-show="activeTab === 'advanced'" x-transition.opacity>
        @include('admin.settings.partials.tab-advanced')
    </div>

</div>
@endsection
