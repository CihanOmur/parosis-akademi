 <div id="toast-container" class="fixed top-5 right-5 z-[999] space-y-2 min-w-[400px]"></div>

 <script>
     window.addEventListener('DOMContentLoaded', () => {
         @if (session('success'))
             showToast('success', '{{ session('success') }}');
         @endif

         @if (session('error'))
             showToast('error', '{{ session('error') }}');
         @endif

         @if ($errors->any())
             @foreach ($errors->all() as $error)
                 showToast('error', '{{ $error }}');
             @endforeach
         @endif
     });

     function showToast(type = 'success', message = 'Mesaj') {
         const colors = {
             success: 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
             error: 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
             info: 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
             warning: 'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200'
         };

         const icons = {
             success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />',
             error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
             info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />',
             warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.29 3.86L1.82 18a1 1 0 00.89 1.5h18.58a1 1 0 00.89-1.5L13.71 3.86a1 1 0 00-1.73 0z" />'
         };

         const toast = document.createElement('div');
         toast.className =
             `toast flex items-center w-full max-w-md p-4 mb-2 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800`;

         toast.innerHTML = `
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 rounded-lg ${colors[type]}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    ${icons[type]}
                </svg>
            </div>
            <div class="ms-3 text-sm font-normal">${message}</div>
            <button type="button"
                class="close-toast ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1l12 12M1 13L13 1" />
                </svg>
            </button>
        `;

         document.getElementById('toast-container').appendChild(toast);

         toast.querySelector('.close-toast').addEventListener('click', () => toast.remove());
         setTimeout(() => toast.remove(), 5000);
     }
 </script>
