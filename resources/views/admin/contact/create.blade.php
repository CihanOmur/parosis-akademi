@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'İletişim Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection
@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <form class="lg:w-1/2 w-full" action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <div class="mb-6">
                    <label for="phone_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefon
                        Başlığı</label>
                    <input type="text" name="phone_title" id="phone_title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Başlık girin" value="{{ $contact->phone_title }}">
                </div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefon Numaraları</label>
                <div id="phone-numbers-wrapper" class="space-y-4 ">
                    @if ($contact->phones->count() > 0)
                        @foreach ($contact->phones as $phoneItem)
                            <div class="phone-numbers-item flex items-center gap-4">
                                <div class="w-full">
                                    <input type="text" name="phone_numbers[{{ $loop->index }}][phone]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Telefon Numarası" value="{{ $phoneItem->phone }}">
                                </div>
                                <button type="button"
                                    class="remove-phone-number text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                            </div>
                        @endforeach
                    @else
                        <div class="phone-numbers-item flex items-center gap-4">
                            <div class="w-full">
                                <input type="text" name="phone_numbers[0][phone]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Telefon Numarası">
                            </div>
                            <button type="button"
                                class="remove-phone-number text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                        </div>
                    @endif

                </div>

                <div class="flex justify-end">
                    <button type="button" id="add-phone-number"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Ekle
                    </button>
                </div>

                <div class="mb-6">
                    <label for="email_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-posta
                        Başlığı</label>
                    <input type="text" name="email_title" id="email_title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Başlık girin" value="{{ $contact->email_title }}">
                </div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-posta Adresleri</label>
                <div id="email-addresses-wrapper" class="space-y-4 ">
                    @if ($contact->mails->count() > 0)
                        @foreach ($contact->mails as $emailItem)
                            <div class="email-addresses-item flex items-center gap-4">
                                <div class="w-full">
                                    <input type="email" name="email_addresses[{{ $loop->index }}][email]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="E-posta Adresi" value="{{ $emailItem->email }}">
                                </div>
                                <button type="button"
                                    class="remove-email-address text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                            </div>
                        @endforeach
                    @else
                        <div class="email-addresses-item flex items-center gap-4">
                            <div class="w-full">
                                <input type="email" name="email_addresses[0][email]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="E-posta Adresi">
                            </div>
                            <button type="button"
                                class="remove-email-address text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                        </div>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="button" id="add-email-address"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Ekle
                    </button>
                </div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresler</label>
                <div id="addresses-wrapper" class="space-y-4 ">
                    @if ($contact->addresses->count() > 0)
                        @foreach ($contact->addresses as $addressItem)
                            <div class="email-addresses-item flex items-center gap-4">
                                <div class="w-1/2">
                                    <input type="text" name="addresses[{{ $loop->index }}][title]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Adres Başlığı" value="{{ $addressItem->title }}">
                                </div>
                                <div class="w-1/2">
                                    <input type="text" name="addresses[{{ $loop->index }}][address]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Adres" value="{{ $addressItem->address }}">
                                </div>
                                <button type="button"
                                    class="remove-address text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                            </div>
                        @endforeach
                    @else
                        <div class="addresses-item flex items-center gap-4">

                            <div class="w-1/2">
                                <input type="text" name="addresses[0][title]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Adres Başlığı">
                            </div>
                            <div class="w-1/2">
                                <input type="text" name="addresses[0][address]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Adres">
                            </div>
                            <button type="button"
                                class="remove-address text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                        </div>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="button" id="add-address"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Ekle
                    </button>
                </div>
                <div class="mb-6">
                    <label for="phone_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maps
                        Url</label>
                    <input type="text" name="maps_url" id="maps_url" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Maps URL girin" value="{{ $contact->maps_section }}">
                </div>

                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let indexAddress = {{ $contact->addresses->count() + 1 }};

        $('#add-address').on('click', function() {
            const field = `
                <div class="addresses-item flex items-center gap-4">
                    <div class="w-1/2">
                        <input type="text" name="addresses[${indexAddress}][title]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Adres Başlığı">
                    </div>
                    <div class="w-1/2">
                        <input type="text" name="addresses[${indexAddress}][address]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Adres">
                    </div>


                    <button type="button"
                        class="remove-address text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                </div>
            `;
            $('#addresses-wrapper').append(field);
            indexAddress++;
        });

        $(document).on('click', '.remove-address', function() {
            $(this).closest('.addresses-item').remove();
            if ($('#addresses-wrapper .addresses-item').length === 0) {
                $('#add-address').click();
            }
        });
    </script>
    <script>
        let indexPhone = {{ $contact->phones->count() + 1 }};

        $('#add-phone-number').on('click', function() {
            const field = `
                            <div class="phone-numbers-item flex items-center gap-4">
                                <div class="w-full">
                                    <input type="text" name="phone_numbers[${indexPhone}][phone]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Telefon Numarası">
                                </div>


                                <button type="button"
                                    class="remove-phone-number text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                            </div>
                        `;
            $('#phone-numbers-wrapper').append(field);
            indexPhone++;
        });

        $(document).on('click', '.remove-phone-number', function() {
            $(this).closest('.phone-numbers-item').remove();
            if ($('#phone-numbers-wrapper .phone-numbers-item').length === 0) {
                $('#add-phone-number').click();
            }
        });
    </script>
    <script>
        let indexEmail = {{ $contact->mails->count() + 1 }};

        $('#add-email-address').on('click', function() {
            const field = `
                            <div class="email-addresses-item flex items-center gap-4">
                                <div class="w-full">
                                    <input type="email" name="email_addresses[${indexEmail}][email]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="E-posta Adresi">
                                </div>


                                <button type="button"
                                    class="remove-email-address text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                            </div>
                        `;
            $('#email-addresses-wrapper').append(field);
            indexEmail++;
        });

        $(document).on('click', '.remove-email-address', function() {
            $(this).closest('.email-addresses-item').remove();
            if ($('#email-addresses-wrapper .email-addresses-item').length === 0) {
                $('#add-email-address').click();
            }
        });
    </script>
@endsection
