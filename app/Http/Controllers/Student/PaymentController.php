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

  public function pay(\Illuminate\Http\Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required'
    ]);

    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    if (!$student) {

        return back()->with(
            'error',
            'Student not found.'
        );

    }

    $account = StudentAccount::where(
        'student_id',
        $student->id
    )->first();

    if (!$account) {

        return back()->with(
            'error',
            'Student account not found.'
        );

    }

    // Prevent overpayment
    if ($request->amount > $account->balance) {

        return back()->with(
            'error',
            'Amount exceeds outstanding balance.'
        );

    }

    // Generate fake transaction reference
    $reference = strtoupper(
        $request->payment_method
    ) . '-' . now()->format('YmdHis') . rand(100,999);

    Payment::create([

        'student_id' => $student->id,

        'student_account_id' => $account->id,

        'amount' => $request->amount,

        'payment_method' => $request->payment_method,

        'transaction_reference' => $reference,

        'payment_date' => now(),

        'status' => 'Completed',

    ]);

    // Update account

    $account->amount_paid += $request->amount;

    $account->balance -= $request->amount;

    $account->updateStatus();

    return redirect()
        ->route('student.payments')
        ->with(
            'success',
            'Payment processed successfully. Transaction Ref: '.$reference
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