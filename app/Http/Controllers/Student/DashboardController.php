<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Allocation;
use App\Models\Notice;

class DashboardController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $student = Student::where('user_id', $user->id)
        ->with([
            'allocation.room.hostel',
            'account',
            'applications.hostel'
        ])
        ->first();

    $allocation = $student?->allocation;

    $account = $student?->account;

    $application = $student?->applications()
        ->latest()
        ->first();

    $latestNotices = Notice::latest()
        ->take(3)
        ->get();

    $recentPayments = $student
        ? $student->payments()
            ->latest()
            ->take(5)
            ->get()
        : collect();

    $daysRemaining = null;

    if ($allocation) {

      $daysPassed = $allocation->allocated_date
    ? $allocation->allocated_date->diffInDays(now())
    : 0;

        $daysRemaining = max(0, 14 - $daysPassed);
    }

    return view(
        'student.dashboard.index',
        compact(
            'user',
            'student',
            'allocation',
            'account',
            'application',
            'latestNotices',
            'recentPayments',
            'daysRemaining'
        )
    );
}

   public function room()
{
    $student = Student::where('user_id', auth()->id())
        ->with('allocation.room.hostel')
        ->first();

    return view('student.room.index', [
        'allocation' => $student?->allocation
    ]);
}

 public function payments()
{
    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    $payments = $student
        ? $student->payments()->latest()->get()
        : collect();

    return view(
        'student.payments',
        [
            'payments' => $payments,

            'totalPaid' => $payments
                ->where('status', 'Paid')
                ->sum('amount'),

            'pendingAmount' => $payments
                ->where('status', 'Pending')
                ->sum('amount'),

            'totalPayments' => $payments->count(),
        ]
    );
}

public function receipts()
{
    $student = Student::where(
        'user_id',
        auth()->id()
    )->first();

    $payments = $student
        ? $student->payments()
            ->where('status','Paid')
            ->latest()
            ->get()
        : collect();

    return view(
        'student.receipts',
        compact('payments')
    );
}

public function notices()
{
    $notices = Notice::latest()->get();

    return view(
        'student.notices',
        compact('notices')
    );
}
}