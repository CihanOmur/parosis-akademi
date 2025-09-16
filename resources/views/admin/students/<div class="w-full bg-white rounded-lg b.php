{{-- Allergy --}}
                <div class="w-full bg-white rounded-lg border border-gray-200">
    <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
        <h3 class="text-md font-semibold text-gray-900 ">Alerjisi Var Mı?</h3>
    </div>
    <div class="py-10 px-5">
        <div class="mb-0">
            <div class="flex items-center justify-start gap-4 ">
                                <div class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                    <input type="radio" name="has_allergy" value="1" id="has_allergy" {{ old('has_allergy') == '1' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500  focus:ring-2 cursor-pointer">
                                    <label for="has_allergy" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Evet</label>
                                </div>
                                <div class="text-red-500 mt-2">
                                    @error('has_allergy')
                                        {{ $message }}
                                    @enderror

                                </div>
                                <div class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                    <input type="radio" name="has_allergy" value="2" checked id="no_allergy" {{ old('has_allergy') == '2' ? 'checked' : '' }}  class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500  focus:ring-2 cursor-pointer">
                                    <label for="no_allergy" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Hayır</label>
                                </div>
                                <div class="text-red-500 mt-2">
                                    @error('has_allergy')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                </div>
                <div id="allergy_detail_field" class="hidden mb-0 mt-6">
                    <input type="text" name="allergy_detail" placeholder="Alerji Detayları"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('allergy_detail') }}">
                    <div class="text-red-500 mt-2">
                        @error('allergy_detail')
                            {{ $message }}
                        @enderror

                    </div>
                </div>

    </div>
</div>