<div id="toast-container"
     class="fixed top-5 right-5 z-[999] flex flex-col gap-2 min-w-[320px] max-w-[420px]"
     style="pointer-events: none;"></div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        @if (session('success'))
            showToast('success', '{{ addslashes(session('success')) }}');
        @endif

        @if (session('error'))
            showToast('error', '{{ addslashes(session('error')) }}');
        @endif

        @if (session('warning'))
            showToast('warning', '{{ addslashes(session('warning')) }}');
        @endif

        @if (session('info'))
            showToast('info', '{{ addslashes(session('info')) }}');
        @endif
    });

    function showToast(type = 'success', message = 'Mesaj', duration = 5000) {
        const config = {
            success: {
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>`,
                bg: 'bg-emerald-500',
                ring: 'ring-emerald-500/20',
                bar: 'bg-emerald-400',
            },
            error: {
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>`,
                bg: 'bg-red-500',
                ring: 'ring-red-500/20',
                bar: 'bg-red-400',
            },
            warning: {
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>`,
                bg: 'bg-amber-500',
                ring: 'ring-amber-500/20',
                bar: 'bg-amber-400',
            },
            info: {
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/>`,
                bg: 'bg-blue-500',
                ring: 'ring-blue-500/20',
                bar: 'bg-blue-400',
            },
        };

        const c = config[type] || config.info;
        const container = document.getElementById('toast-container');

        const toast = document.createElement('div');
        toast.style.pointerEvents = 'all';
        toast.className = [
            'toast-item relative flex items-start gap-3 w-full',
            'bg-white dark:bg-slate-800',
            'rounded-2xl shadow-xl shadow-slate-900/10 dark:shadow-slate-950/50',
            'border border-slate-200/60 dark:border-slate-700/50',
            'p-4 overflow-hidden',
            'translate-x-full opacity-0 transition-all duration-300',
        ].join(' ');

        toast.innerHTML = `
            <div class="flex-shrink-0 w-9 h-9 rounded-xl ${c.bg} flex items-center justify-center shadow-lg ${c.ring} ring-4">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    ${c.icon}
                </svg>
            </div>
            <div class="flex-1 min-w-0 pt-0.5">
                <p class="text-sm font-medium text-slate-800 dark:text-slate-100 leading-snug">${message}</p>
            </div>
            <button type="button" class="close-toast flex-shrink-0 p-1 rounded-lg
                                         text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                                         hover:bg-slate-100 dark:hover:bg-slate-700
                                         transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 1l12 12M1 13L13 1"/>
                </svg>
            </button>
            <div class="absolute bottom-0 left-0 h-0.5 ${c.bar} toast-progress rounded-full"
                 style="width: 100%; transition: width ${duration}ms linear;"></div>
        `;

        container.appendChild(toast);

        // Giriş animasyonu
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            });
        });

        // Progress bar animasyonu
        const bar = toast.querySelector('.toast-progress');
        setTimeout(() => {
            if (bar) bar.style.width = '0%';
        }, 50);

        // Otomatik kapanma
        const timer = setTimeout(() => removeToast(toast), duration);

        // Manuel kapanma
        toast.querySelector('.close-toast').addEventListener('click', () => {
            clearTimeout(timer);
            removeToast(toast);
        });
    }

    function removeToast(toast) {
        toast.classList.add('opacity-0', 'translate-x-full', 'scale-95');
        setTimeout(() => toast.remove(), 300);
    }
</script>
