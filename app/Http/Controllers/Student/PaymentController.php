<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAccount;
class PaymentController extends Controller
{
   public function index()
{
    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    $account = StudentAccount::where(
        'student_id',
        $student->id
    )->first();

    $payments = Payment::where(
        'student_id',
        $student->id
    )
    ->latest()
    ->paginate(10);

    $totalPaid = Payment::where(
        'student_id',
        $student->id
    )->sum('amount');

    $paymentCount = Payment::where(
        'student_id',
        $student->id
    )->count();

    $lastPayment = Payment::where(
        'student_id',
        $student->id
    )
    ->latest()
    ->first();

    return view(
        'student.payments.index',
        compact(
            'payments',
            'account',
            'totalPaid',
            'paymentCount',
            'lastPayment'
        )
    );
}

   public function receipt(Payment $payment)
{
    $student = Student::where(
        'user_id',
        Auth::id()
    )->first();

    // Prevent students from downloading other students' receipts
    if (!$student || $payment->student_id != $student->id) {
        abort(403);
    }

    $pdf = Pdf::loadView(
        'student.payments.receipt',
        compact('payment', 'student')
    );

    return $pdf->download(
        'Receipt-' . $payment->id . '.pdf'
    );
}
}