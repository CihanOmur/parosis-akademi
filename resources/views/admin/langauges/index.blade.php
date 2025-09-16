@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Dil Listesi' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection
@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Başlık
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Local
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Durum
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($languages as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-blue-600 whitespace-nowrap ">
                                    {{ $item->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->locale }}
                                </td>

                                <td>

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="{{ $item->id }}"
                                            class="sr-only peer status-toggle" data-id="{{ $item->id }}"
                                            {{ $item->is_active == '1' ? 'checked' : '' }}>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            id="status-label{{ $item->id }}">
                                            {{ $item->is_active == '1' ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </label>


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.querySelectorAll('.status-toggle').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let itemId = this.dataset.id;
                let itemContent = $('#status-label' + itemId);

                console.log(itemContent);

                axios.post('/languages/update', {
                        id: itemId,
                    })
                    .then(function(response) {
                        console.log(response);
                        console.log(response.data.status);

                        if (response.data.status == '0') {
                            showToast('error', response.data.message);

                        } else if (response.data.status == '1') {
                            showToast('success', response.data.message);

                            itemContent.text(response.data.action);
                        }
                    })
                    .catch(function(error) {
                        console.error('Hata oluştu', error);
                    });
            });
        });
    </script>
@endsection
