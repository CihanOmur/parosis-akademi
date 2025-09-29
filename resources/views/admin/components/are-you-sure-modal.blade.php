@props([
    'id' => Str::random(8),
    'title' => 'Silmek istediğine emin misin?',
    'message' => 'İlgili bütün veriler silinecek. Devam etmek istediğine emin misin?',
    'confirmButtonText' => 'Sil',
    'cancelButtonText' => 'İptal',
    'route' => '#',
])

<div id="are-you-sure-modal-{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden p-4">

    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->


        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 flex flex-col gap-2">
            <div class="flex items-start gap-4">
                <div class="bg-red-100 text-red-600 p-2.5 rounded-full flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12" y2="16"></line>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $title }}</h3>
                    <p class="text-gray-500">{{ $message }}</p>
                </div>
            </div>
            <form action="{{ $route }}" method="post" id="are-you-sure-form-{{ $id }}">
                @csrf
                @method('DELETE')
            </form>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="submit" form="are-you-sure-form-{{ $id }}"
                    class="bg-red-600 text-white font-medium py-2 px-5 rounded-lg flex items-center gap-2 hover:bg-red-700 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                        </path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    {{ $confirmButtonText }}
                </button>
                <button type="button" data-modal-hide="are-you-sure-modal-{{ $id }}"
                    class="bg-gray-200 text-gray-800 font-medium py-2 px-5 rounded-lg hover:bg-gray-300 transition-colors cursor-pointer">{{ $cancelButtonText }}</button>

            </div>
        </div>

    </div>
</div>
