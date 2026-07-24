@props(['href', 'title' => 'Geri Dön'])
<a href="{{ $href }}"
   class="inline-flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:border-fuchsia-300 dark:hover:border-fuchsia-500 transition-colors"
   title="{{ $title }}" aria-label="{{ $title }}">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
    </svg>
</a>
