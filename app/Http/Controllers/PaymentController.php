<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Notification;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   public function index()
{
   $totalPayments = Payment::count();

$accounts = StudentAccount::with([
    'student.user',
    'payments'
])
->latest()
->paginate(10);

$totalCollected = StudentAccount::sum('amount_paid');

$pendingPayments = StudentAccount::where('status', '!=', 'Completed')->count();

$completedPayments = StudentAccount::where('status', 'Completed')->count();
    return view(
        'admin.payments.index',
        compact(
            'accounts',
            'totalPayments',
            'totalCollected',
            'pendingPayments',
            'completedPayments'
        )
    );
}

    public function create()
    {
        $students = Student::with([
            'user',
            'account'
        ])
        ->whereHas('account', function ($q) {
            $q->where('status', '!=', 'Completed');
        })
        ->get();

        return view(
            'admin.payments.create',
            compact('students')
        );
    }

   public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required',
        'transaction_reference' => 'required',
        'payment_date' => 'required|date',
    ]);

    // Get the student's financial account
    $account = StudentAccount::where(
        'student_id',
        $request->student_id
    )->first();

    if (!$account) {
        return back()->with(
            'error',
            'Student account not found.'
        );
    }

    // Save payment record
    Payment::create([
        'student_id'            => $request->student_id,
        'student_account_id'    => $account->id,
        'amount'                => $request->amount,
        'payment_method'        => $request->payment_method,
        'transaction_reference' => $request->transaction_reference,
        'payment_date'          => $request->payment_date,
        'status'                => 'Completed',
    ]);

    $student = Student::with('user')->find($request->student_id);

    Notification::create([

    'title' => 'Payment Received',

    'message' =>
        $student->user->name .
        ' paid KSh ' .
        number_format($request->amount),

    'type' => 'payment'

    ]);

    // Update student account
    $account->amount_paid += $request->amount;

    $account->balance = max(
        0,
        $account->room_fee - $account->amount_paid
    );

    if ($account->balance == 0) {
        $account->status = 'Completed';
    } elseif ($account->amount_paid > 0) {
        $account->status = 'Partial';
    } else {
        $account->status = 'Pending';
    }

    $account->save();

    return redirect()
        ->route('payments.index')
        ->with(
            'success',
            'Payment recorded successfully.'
        );
}

    public function edit(Payment $payment)
    {
        $students = Student::all();

        return view(
            'admin.payments.edit',
            compact(
                'payment',
                'students'
            )
        );
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'transaction_reference' => 'required',
            'payment_date' => 'required|date',
        ]);

        $payment->update($request->all());

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment updated successfully.'
            );
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment deleted successfully.'
            );
    }
}