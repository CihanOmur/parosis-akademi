<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student\Student;
use App\Models\Student\StudentPayments;
use Illuminate\Http\Request;

class StudentPaymentController extends Controller
{
    public function payment(Request $request, $id)
    {
        $payment = StudentPayments::with(['installments', 'student'])->findOrFail($id);

        return view('admin.students-payments.create', [
            'payment' => $payment
        ]);
    }

    public function paymentUpdate(Request $request, $id)
    {
        $payment = StudentPayments::with(['installments', 'student'])->findOrFail($id);

        if ($request->isMethod('post')) {
            $payment->update([
                'installment_count' => $request->installments ? count($request->installments) : 0,
                'total_price'       => $request->total_payment,
                'total_payed_price' => collect($request->installments)->sum(fn($i) => $i['payed_price'] ?? 0),
                'start_date'        => $request->start_date,
            ]);

            if ($request->has('installments')) {
                $payment->installments()->delete();
                foreach ($request->installments as $index => $inst) {
                    $payment->installments()->create([
                        'student_payment_id' => $payment->id,
                        'student_id'        => $payment->student_id,
                        'order'             => $index + 1,
                        'payment_date'      => $inst['payment_date'] ?? null,
                        'installment_price' => $inst['installment_price'] ?? 0,
                        'payed_price'       => $inst['payed_price'] ?? 0,
                        'payment_type'      => $inst['payment_type'] ?? 'Nakit',
                        'payyed_date'       => $inst['payyed_date'] ?? null,
                        'note'             => $inst['note'] ?? null,
                    ]);
                }
            }

            return redirect()->route('students.allPayments', ['id' => $payment->student_id])->with('success', 'Ödeme ve taksitler başarıyla güncellendi.');
        }

        return view('admin.students-payments.create', compact('payment'))->with('success', 'Ödeme ve taksitler başarıyla güncellendi.');
    }

    public function allPayments($id)
    {
        $student = Student::where('registration_type', '2')->findOrFail($id);
        $payments = StudentPayments::with(['installments', 'class'])->where('student_id', $student->id)->orderBy('created_at', 'ASC')->get();
        $normalCount = Student::where('registration_type', 2)->count();
        $preCount = Student::where('registration_type', 1)->count();

        return view('admin.students-payments.payments', [
            'student' => $student,
            'payments' => $payments,
            'normalCount' => $normalCount,
            'preCount' => $preCount
        ]);
    }
}
