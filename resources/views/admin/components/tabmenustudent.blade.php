<div class="text-sm mb-6 font-medium text-center text-gray-500">
    <ul class="flex flex-wrap -mb-px">
        <li class="me-2">
            <a href="{{ route('students.edit', $student->id) }}"
                class="inline-block p-4 border-b-2 rounded-t-lg {{ Route::is('students.edit', $student->id) ? 'border-blue-600 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                aria-current="page">Kayıt
                Bilgileri</a>
        </li>
        <li class="me-2">
            <a href="{{ route('students.allPayments', $student->id) }}"
                class="inline-block p-4 border-b-2 rounded-t-lg {{ Route::is('students.allPayments', $student->id) ? 'border-blue-600 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">Ödeme
                Bilgileri</a>
        </li>
        {{-- <li class="me-2">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Evraklar</a>
        </li> --}}

    </ul>
</div>
