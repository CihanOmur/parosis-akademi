@extends('admin.layouts.app')
@section('content')
    <div class="rounded-lg mb-4">
        @if ($payment)
            <div class="w-full bg-white rounded-lg border border-gray-200 mb-4">
                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">
                        Taksit Bilgileri
                    </h3>
                </div>
                <div class="py-10 px-5">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <!-- Baldem -->
                        <div class="p-4 bg-blue-50 rounded-lg shadow-sm">
                            <div class="text-sm text-gray-500">Toplam Tutar</div>
                            <div class="text-lg font-bold text-gray-800">{{ $payment->total_price }} ₺</div>
                        </div>

                        <!-- Kalan Ödenecek -->
                        <div class="p-4 bg-yellow-50 rounded-lg shadow-sm">
                            <div class="text-sm text-gray-500">Kalan Tutar</div>
                            <div class="text-lg font-bold text-gray-800">
                                {{ $payment->total_price - $payment->total_payed_price }} ₺</div>
                        </div>

                        <!-- Ödenen -->
                        <div class="p-4 bg-green-50 rounded-lg shadow-sm">
                            <div class="text-sm text-gray-500">Ödenen Tutar</div>
                            <div class="text-lg font-bold text-gray-800">
                                {{ $payment->total_payed_price }} ₺</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="w-full bg-white py-10 px-8 rounded-lg border border-gray-200">
            <form class="w-full" action="{{ route('students.paymentUpdate', ['id' => $payment->id]) }}" method="POST">
                @csrf

                <div class="grid grid-cols-3 gap-4">
                    <div class="mb-6">
                        <label>Ödeme Tutarı</label>
                        <input type="number" id="total_payment" name="total_payment" step="0.01"
                            value="{{ old('total_payment', $payment->total_price ?? '') }}"
                            class="border rounded-lg p-2.5 w-full">
                    </div>
                    <div class="mb-6">
                        <label>Taksit Sayısı</label>
                        <input type="number" id="installments_count"
                            value="{{ old('installments_count', $payment->installments->count() ?? '') }}"
                            class="border rounded-lg p-2.5 w-full">
                    </div>
                    <div class="mb-6">
                        <label>Başlangıç Tarihi</label>
                        <input type="date" id="start_date" name="start_date"
                            value="{{ old('start_date', optional($payment->installments->first())->payment_date ? \Carbon\Carbon::parse($payment->installments->first()->payment_date)->format('Y-m-d') : '') }}"
                            class="border rounded-lg p-2.5 w-full">
                    </div>
                </div>

                <div id="installments_container" class="mt-6">
                    @if ($payment->installments && $payment->installments->count())
                        <div class="grid grid-cols-6 gap-4 mb-2 font-semibold text-gray-700">
                            <div>#</div>
                            <div>Tarih</div>
                            <div>Ödenecek Tutar</div>
                            <div>Ödenen Tutar</div>
                            <div>Ödeme Türü</div>
                        </div>

                        @foreach ($payment->installments as $i => $inst)
                            <div
                                class="grid grid-cols-6 gap-4 mb-2 p-3 border rounded-lg {{ $inst->payed_price > 0 && $inst->payed_price >= $inst->installment_price ? 'bg-green-100' : 'bg-gray-50' }}">
                                <div>#{{ $i + 1 }}</div>
                                <div>
                                    <input type="date" name="installments[{{ $i }}][payment_date]"
                                        value="{{ \Carbon\Carbon::parse($inst->payment_date)->format('Y-m-d') }}">
                                </div>
                                <div>
                                    <input type="number" step="0.01"
                                        name="installments[{{ $i }}][installment_price]"
                                        value="{{ $inst->installment_price }}" class="border rounded-lg p-1 w-full">
                                </div>
                                <div>
                                    <input type="date" name="installments[{{ $i }}][payyed_date]"
                                        value="{{ \Carbon\Carbon::parse($inst->payyed_date)->format('Y-m-d') }}">
                                </div>
                                <div>
                                    <input type="number" step="0.01"
                                        name="installments[{{ $i }}][payed_price]"
                                        value="{{ $inst->payed_price == 0 ? '0,00' : $inst->payed_price }}"
                                        class="border rounded-lg p-1 w-full">
                                </div>

                                <div>
                                    <select name="installments[{{ $i }}][payment_type]"
                                        class="border rounded-lg p-1 w-full">
                                        <option value="Nakit" {{ $inst->payment_type == 'Nakit' ? 'selected' : '' }}>Nakit
                                        </option>
                                        <option value="Havale" {{ $inst->payment_type == 'Havale' ? 'selected' : '' }}>
                                            Havale
                                        </option>
                                        <option value="Kredi Kartı/Banka"
                                            {{ $inst->payment_type == 'Banka' ? 'selected' : '' }}>Kredi Kartı/Banka
                                        </option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Kaydet</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function generateInstallments() {
            let totalPayment = parseFloat($("#total_payment").val()) || 0;
            let count = parseInt($("#installments_count").val()) || 0;
            let startDate = $("#start_date").val();
            let $container = $("#installments_container");
            if (!totalPayment || !count || !startDate) return;

            let installments = @json($payment->installments);
            let paidInstallments = installments.filter(inst => parseFloat(inst.payed_price) > 0);
            let unpaidInstallments = installments.filter(inst => parseFloat(inst.payed_price) === 0);

            // Ödenmemiş taksit sayısını yeni count ile eşleştir
            let remainingUnpaidCount = count - paidInstallments.length;
            if (remainingUnpaidCount < 0) remainingUnpaidCount = 0;

            // Fazla/az taksitleri ayarla
            if (unpaidInstallments.length > remainingUnpaidCount) {
                unpaidInstallments = unpaidInstallments.slice(0, remainingUnpaidCount);
            } else if (unpaidInstallments.length < remainingUnpaidCount) {
                let addCount = remainingUnpaidCount - unpaidInstallments.length;
                for (let i = 0; i < addCount; i++) {
                    unpaidInstallments.push({
                        id: installments.length + i,
                        payed_price: 0,
                        installment_price: 0,
                        payment_date: startDate,
                        payment_type: 'Nakit',
                        status: 0,
                        payyed_date: null,
                    });
                }
            }

            $container.empty();

            let header = `<div class="grid grid-cols-6 gap-4 mb-2 font-semibold text-gray-700">
            <div>#</div><div>Tarih</div><div>Ödenecek Tutar</div>
            <div>Ödenen Tarih</div><div>Ödenen Tutar</div><div>Ödeme Türü</div>
        </div>`;
            $container.append(header);

            // Tüm taksitleri birleştir: ödenmiş + ödenmemiş
            let allInstallments = [...paidInstallments, ...unpaidInstallments];

            // Kalan toplam tutar
            let remainingAmount = totalPayment - paidInstallments.reduce((sum, inst) => sum + parseFloat(inst.payed_price ||
                0), 0);
            let newAmount = (remainingUnpaidCount ? (remainingAmount / remainingUnpaidCount).toFixed(2) : 0);

            let currentDate = new Date(startDate);

            allInstallments.forEach((inst, i) => {
                if (i > 0) currentDate.setMonth(currentDate.getMonth() + 1);
                let dateStr = currentDate.toISOString().split('T')[0];
                let dateStrPayed = inst.payyed_date ? inst.payyed_date.split('T')[0] : '';

                // Satırın rengini belirle
                let paid = Number(inst.payed_price);
                let total = Number(inst.installment_price || newAmount);
                let rowBgClass = '';

                if (paid >= total) {
                    rowBgClass = 'bg-green-100'; // tam ödenmiş
                } else if (paid > 0 && paid < total) {
                    rowBgClass = 'bg-red-100'; // kısmen ödenmiş
                } else {
                    rowBgClass = 'bg-gray-50'; // hiç ödenmemiş
                }

                let installmentPrice = paid > 0 ? inst.installment_price : newAmount;

                let row = `<div class="grid grid-cols-6 gap-4 mb-2 p-3 border rounded-lg ${rowBgClass}">
                        <div>#${i + 1}</div>
                        <div><input type="date" name="installments[${i}][payment_date]" value="${dateStr}" class="border rounded-lg p-1 w-full" ></div>
                        <div><input type="number" step="0.01" name="installments[${i}][installment_price]" value="${installmentPrice}" class="border rounded-lg p-1 w-full" ></div>
                        <div><input type="date" name="installments[${i}][payyed_date]" value="${dateStrPayed}" class="border rounded-lg p-1 w-full" ></div>
                        <div><input type="number" step="0.01" name="installments[${i}][payed_price]" value="${inst.payed_price || '0.00'}" class="border rounded-lg p-1 w-full" ></div>
                        <div>
                            <select name="installments[${i}][payment_type]" class="border rounded-lg p-1 w-full">
                                <option value="Nakit" ${inst.payment_type == "Nakit" ? 'selected' : ''}>Nakit</option>
                                <option value="Havale" ${inst.payment_type == "Havale" ? 'selected' : ''}>Havale</option>
                                <option value="Kredi Kartı/Banka" ${inst.payment_type == "Kredi Kartı/Banka" ? 'selected' : ''}>Kredi Kartı/Banka</option>
                            </select>
                        </div>
                    </div>`;

                $container.append(row);
            });
        }

        $("#total_payment, #installments_count, #start_date").on("input change", generateInstallments);
        $(document).ready(generateInstallments);
    </script>

@endsection
