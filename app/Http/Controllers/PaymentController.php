<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student.user')->latest()->get();

        $totalPayments = Payment::count();

        $totalCollected = Payment::sum('amount');

        $pendingPayments = Payment::where('status','Pending')->count();

      return view('admin.payments.index', compact(
       'payments',
       'totalPayments',
       'totalCollected',
       'pendingPayments'
    ));

    }

    public function create()
    {
        $students = Student::with('user')->get();

        return view('admin.payments.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'transaction_reference' => 'required',
            'payment_date' => 'required'
        ]);

        Payment::create([
            'student_id' => $request->student_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_reference' => $request->transaction_reference,
            'payment_date' => $request->payment_date,
            'status' => 'Completed'
        ]);

        return redirect('/payments')
            ->with('success', 'Payment recorded successfully');
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