<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
{
    $payments = Payment::with('student.user')
        ->latest()
        ->paginate(10);

    $totalPayments = Payment::count();

    $totalCollected = Payment::where(
        'status',
        'Completed'
    )->sum('amount');

    $pendingPayments = Payment::where(
        'status',
        'Pending'
    )->count();

    $completedPayments = Payment::where(
        'status',
        'Completed'
    )->count();

    return view(
        'admin.payments.index',
        compact(
            'payments',
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
            'payments'
        ])
        ->whereHas('payments', function ($query) {

            $query->where('status', 'Pending');

        })
        ->orderBy('registration_number')
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
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required',
        'transaction_reference' => 'required',
        'payment_date' => 'required|date'
    ]);

    $payment = Payment::where('student_id', $request->student_id)
        ->where('status', 'Pending')
        ->latest()
        ->first();

    if (!$payment || $payment->status === 'Completed') {

        return back()->with(
            'error',
            'No pending payment found for the selected student.'
        );

    }

    $payment->update([

        'amount' => $request->amount,

        'payment_method' => $request->payment_method,

        'transaction_reference' => $request->transaction_reference,

        'payment_date' => $request->payment_date,

        'status' => 'Completed'

    ]);

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

    return view('admin.payments.edit', compact('payment', 'students'));
    }

public function update(Request $request, Payment $payment)
{
    $request->validate([
        'student_id' => 'required',
        'amount' => 'required',
        'payment_method' => 'required',
        'payment_date' => 'required',
    ]);

    $payment->update([
        'student_id' => $request->student_id,
        'amount' => $request->amount,
        'payment_method' => $request->payment_method,
        'transaction_reference' => $request->transaction_reference,
        'payment_date' => $request->payment_date,
    ]);

    return redirect()->route('payments.index')
        ->with('success', 'Payment updated successfully');
}

public function destroy(Payment $payment)
{
    $payment->delete();

    return redirect()->route('payments.index')
        ->with('success', 'Payment deleted successfully');
}
}