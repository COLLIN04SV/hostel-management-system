<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptController extends Controller
{
    public function index()
    {
        $student = Student::where(
            'user_id',
            auth()->id()
        )->first();

        $payments = Payment::where(
            'student_id',
            $student->id
        )
        ->latest()
        ->paginate(10);

        return view(
            'student.receipts.index',
            compact('payments')
        );
    }

    public function download(Payment $payment)
    {
        $student = Student::where(
            'user_id',
            auth()->id()
        )->first();

        if (!$student || $payment->student_id != $student->id) {
            abort(403);
        }

        $pdf = Pdf::loadView(
            'student.payments.receipt',
            compact('payment', 'student')
        );

        return $pdf->download(
            'Receipt-'.$payment->id.'.pdf'
        );
    }
}