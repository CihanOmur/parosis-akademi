@extends('admin.layouts.app')
@section('content')
    <div class="rounded-lg mb-4">
        <div class="w-full bg-white py-10 px-8 rounded-lg">
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
                        <input type="date" id="start_date"
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
                            <div>Durum</div>
                        </div>

                        @foreach ($payment->installments as $i => $inst)
                            <div class="grid grid-cols-6 gap-4 mb-2 p-3 border rounded-lg bg-gray-50">
                                <div>#{{ $i + 1 }}</div>
                                <div>
                                    <input type="date" name="installments[{{ $i }}][payment_date]"
                                        value="{{ \Carbon\Carbon::parse($inst->payment_date)->format('Y-m-d') }}"
                                        class="border rounded-lg p-1 w-full">
                                </div>
                                <div>
                                    <input type="number" step="0.01"
                                        name="installments[{{ $i }}][installment_price]"
                                        value="{{ $inst->installment_price }}" class="border rounded-lg p-1 w-full">
                                </div>
                                <div>
                                    <input type="number" step="0.01"
                                        name="installments[{{ $i }}][payed_price]"
                                        value="{{ $inst->payed_price }}" class="border rounded-lg p-1 w-full">
                                </div>
                                <div>
                                    <input type="text" name="installments[{{ $i }}][payment_type]"
                                        value="{{ $inst->payment_type }}" class="border rounded-lg p-1 w-full">
                                </div>
                                <div>
                                    <select name="installments[{{ $i }}][status]"
                                        class="border rounded-lg p-1 w-full">
                                        <option value="0" {{ $inst->status == 0 ? 'selected' : '' }}>Ödenmedi</option>
                                        <option value="1" {{ $inst->status == 1 ? 'selected' : '' }}>Ödendi</option>
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
            $container.empty();
            if (!totalPayment || !count || !startDate) return;

            let installmentAmount = (totalPayment / count).toFixed(2);
            let currentDate = new Date(startDate);

            let header = `<div class="grid grid-cols-6 gap-4 mb-2 font-semibold text-gray-700">
                    <div>#</div><div>Tarih</div><div>Ödenecek Tutar</div>
                    <div>Ödenen Tutar</div><div>Ödeme Türü</div><div>Durum</div>
                  </div>`;
            $container.append(header);

            for (let i = 0; i < count; i++) {
                if (i > 0) currentDate.setMonth(currentDate.getMonth() + 1);
                let dateStr = currentDate.toISOString().split('T')[0];

                let row = `<div class="grid grid-cols-6 gap-4 mb-2 p-3 border rounded-lg bg-gray-50">
            <div>#${i+1}</div>
            <div><input type="date" name="installments[${i}][payment_date]" value="${dateStr}" class="border rounded-lg p-1 w-full"></div>
            <div><input type="number" step="0.01" name="installments[${i}][installment_price]" value="${installmentAmount}" class="border rounded-lg p-1 w-full"></div>
            <div><input type="number" step="0.01" name="installments[${i}][payed_price]" value="0" class="border rounded-lg p-1 w-full"></div>
            <div><input type="text" name="installments[${i}][payment_type]" value="Nakit" class="border rounded-lg p-1 w-full"></div>
            <div>
                <select name="installments[${i}][status]" class="border rounded-lg p-1 w-full">
                    <option value="0" selected>Ödenmedi</option>
                    <option value="1">Ödendi</option>
                </select>
            </div>
        </div>`;
                $container.append(row);
            }
        }

        $("#total_payment, #installments_count, #start_date").on("input change", generateInstallments);
    </script>
@endsection
