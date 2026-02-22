<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student\Student;
use App\Models\Student\StudentPayments;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentDocumentController extends Controller
{
    public function downloadRegistrationForm(Request $request)
    {
        $student = Student::with(['guardians', 'emergencyContact', 'lessonClass'])->where('registration_type', '2')->findOrFail($request->student_id);

        $pdf = Pdf::loadView('admin.students.registration-form', compact('student'))->setOptions(['defaultFont' => 'DejaVu Sans'])->setPaper('a4', 'portrait');
        return $pdf->download($student->full_name . '-kayıt-formu' . '.pdf');
    }

    public function downloadContract(Request $request)
    {
        $student = Student::with(['guardians', 'emergencyContact', 'lessonClass', 'payments'])->where('registration_type', '2')->findOrFail($request->student_id);

        $pdf = Pdf::loadView('admin.students.contract', compact('student'))->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ])->setPaper('a4', 'portrait');
        return $pdf->download($student->full_name . '-sözleşme' . '.pdf');
    }

    public function downloadPayment(Request $request)
    {
        $student = Student::with(['guardians'])->where('registration_type', '2')->findOrFail($request->student_id);
        $payment = StudentPayments::with(['installments'])->findOrFail($request->payment_id);

        $pdf = Pdf::loadView('admin.students.payment-contract', [
            'student' => $student,
            'payment' => $payment
        ])->setOptions(['defaultFont' => 'DejaVu Sans'])->setPaper('a4', 'portrait');
        return $pdf->download($student->full_name . '-ödeme-planı' . '.pdf');
    }
}
